<?php

ini_set("max_execution_time",3600);

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."modele/bdd/classe_apprenti.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."modele/bdd/classe_classe.php");
require_once ($LEA_REP."modele/bdd/classe_enseignant.php");
require_once ($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once ($LEA_REP."modele/bdd/classe_representant_legal.php");
require_once ($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");

define("UNITE_PEDAGO", "peda");
define("FORMATIONS", "for");
define("CLASSES", "cla");
define("APPRENTIS", "app");
define("ENSEIGNANTS", "ens");
define("MAITRES_APPRENTISSAGE", "ma");
define("REPRESENTANTS_LEGAUX", "rl");
define("ENTREPRISE", "entr");


/*
 * Initialise un usager à partir des informations en base de données 
 */
function initialise_usager($usager, $login) {

	if ($usager->is_apprenti()) {
		$profil = "app";
	} elseif ($usager->is_enseignant()) {
		$profil = "ens";
	} elseif ($usager->is_maitre_apprentissage()) {
		$profil = "ma";
	} elseif ($usager->is_representant_legal()) {
		$profil = "rl";
	}
	$usager->set_id($usager->existe_login($login, $profil));
	if ($usager->get_id()>0) {
		$usager->set_detail();
		$usager->bdd->requete = "UPDATE";
	} else {
		$usager->login = $login;
		$usager->profil = $profil;
		$usager->mdp = $login;
		$usager->bdd->requete = "INSERT";
	}
}

/*
 * Traite la partie Usager d'un objet
 */
function traiter_usager($usager, $info) {
	// Groupe LDAP des administrateurs
	global $RACINE_GROUPE_ADMIN;

	initialise_usager($usager, $info["ENTPersonLogin"][0]);

	$civilite = isset($info["personalTitle"]) ? $info["personalTitle"][0] : NULL;
	$nom = isset($info["ENTPersonNomPatro"]) ? $info["ENTPersonNomPatro"][0] : NULL;
	$prenom = isset($info["givenName"]) ? $info["givenName"][0] : NULL;
	$adresse = (isset($info["ENTPersonAdresse"]) ? $info["ENTPersonAdresse"][0]."\n" : NULL).
	(isset($info["ENTPersonCodePostal"]) ? $info["ENTPersonCodePostal"][0]." " : NULL).
	(isset($info["ENTPersonVille"]) ? $info["ENTPersonVille"][0] : NULL);
	$telephone = isset($info["homePhone"])?$info["homePhone"][0] : NULL;
	$mobile = isset($info["mobile"])?$info["mobile"][0] : NULL;
	$mail = isset($info["mail"]) ? $info["mail"][0] : NULL;
	$login = $info["ENTPersonLogin"][0];

	if ($civilite == "Mlle" ) $civilite = "Mademoiselle";
	else if ($civilite == "Mme" ) $civilite = "Madame";
	else if ($civilite == "M" ) $civilite = "Monsieur";
	if ($civilite) $usager->civilite = $civilite;
	if ($nom) $usager->nom = $nom;
	if ($prenom) $usager->prenom = $prenom;
	if ($adresse) $usager->adresse = addslashes($adresse);
	if ($telephone) $usager->tel_fixe = $telephone;
	if ($mobile) $usager->tel_mobile = $mobile;
	if ($mail) $usager->email = $mail;

	////////////////////////////////////////////////////////////////////
	// Verification du statut d'administrateur de l'utilisateur
	////////////////////////////////////////////////////////////////////
	$is_admin = false;
	if(isset($info["isMemberOf"])) {
		foreach($info["isMemberOf"] as $isMemberOf) {
			if(preg_match('/'.$RACINE_GROUPE_ADMIN.'/', $isMemberOf)) {
				$is_admin = true;
			}
		}
	} 
	if($is_admin) {
		if (!$usager->is_admin()) {
			// Ajout du profil administrateur au profil actuel si l'utilisateur
			// n'etait pas encore declare comme administrateur
			$usager->profil = "admin," . $usager->profil;
		}
	} else {
		// Suppression du profil administrateur au profil actuel
		$usager->profil = preg_replace('/admin,?/', '', $usager->profil);
	}

	return $usager;
}

/*
 * Recherche l'id du representant legal de l'apprenti dont le dn est passé en parametre
 *  Si le representant legal n'est pas present dans la structure, il est ajouté
 */
function traiter_representant_legal($modeSimulation, $ldapconn, $dnParent, $structure) {
	$dn = "ou=people,dc=esco-centre,dc=fr";
	$edn = ldap_explode_dn($dnParent, 0);
	$uid = $edn[0];
	$filter="($uid)";
	$justthese = array("*");
	$results = ldap_search($ldapconn, $dn, $filter, $justthese);

	$entry = ldap_first_entry($ldapconn, $results);
	if (!$entry) return 0;

	$dn = ldap_get_dn($ldapconn, $entry);
	if (isset($structure[REPRESENTANTS_LEGAUX][$dn])) {
		// Le representant est déjà connu
		$rl = $structure[REPRESENTANTS_LEGAUX][$dn];
	} else {
		// Creation du representant legal
		$info = ldap_get_attributes($ldapconn, $entry);
		$rl = traiter_usager(new Representant_legal(0), $info);
		// $ma->profession = ;
		// $ma->adresse_prof = ;
		
		if (!$modeSimulation) {
			$rl->save(false);
		} else {
			$rl->id_rl = sizeof($structure[REPRESENTANTS_LEGAUX]) + 1;
		}
		$structure[REPRESENTANTS_LEGAUX][$dn] = $rl;
	}

	return $rl->id_rl;
}


function traiter_entreprise($modeSimulation, $ldapconn, $dnStruct, $structure) {
	$edn = ldap_explode_dn($dnStruct, 1);
	$siren = $edn[0];
	
	$dn = "ou=structures,dc=esco-centre,dc=fr";
	$filter="(ENTStructureSIREN=$siren)";
	$justthese = array("*");
	$results = ldap_search($ldapconn, $dn, $filter, $justthese);

	$entry = ldap_first_entry($ldapconn, $results);
	if (!$entry) return 0;
	$info = ldap_get_attributes($ldapconn, $entry);
	
	if (isset($structure[ENTREPRISE][$siren])) {
		$entr = $structure[ENTREPRISE][$siren];
	} else {
		$entr = new Entreprise(0);
	    $entr->nom = $info["ou"][0];
		$entr->adresse = isset($info["street"])?$info["street"][0] : NULL;
		$entr->id_entr = $entr->existe_deja();
		if ($entr->id_entr != 0) $entr->set_detail(0);
		
		$entr->code_postal = isset($info["postalCode"])?$info["postalCode"][0] : NULL;
		$entr->ville = isset($info["l"])?$info["l"][0] : NULL;
		$entr->tel_fixe1 = isset($info["telephoneNumber"])?$info["telephoneNumber"][0] : NULL;;
	
		if ($entr->id_entr>0) {
			$entr->bdd->requete = "UPDATE";
		} else {
			$entr->bdd->requete = "INSERT";
		}
	
		if (!$modeSimulation) {
			$entr->save(false);
		} else {
			$entr->id_entr = sizeof($structure[ENTREPRISE]) + 1; 
		}
			
		$structure[ENTREPRISE][$siren] = $entr;
	}	
	return $entr->id_entr;
}

/*
 * Recherche l'id des maitres d'apprentissages de l'apprenti dont le dn est passé en parametre
 * Si les maitres d'apprentissages ne sont pas presents dans la structure, ils sonts ajoutés
 */
function traiter_maitres_apprentissages($modeSimulation, $ldapconn, $dnApprenti, $structure) {
	// Ids des mas de l'apprenti
	$ids_mas = array();
	$dn = "ou=people,dc=esco-centre,dc=fr";
	$filter="(&(objectclass=ENTAuxTuteurStage)(ENTAuxTuteurStageEleves=$dnApprenti))";
	$justthese = array("*");
	$results = ldap_search($ldapconn, $dn, $filter, $justthese);

	$entry = ldap_first_entry($ldapconn, $results);
	if (!$entry) return $ids_mas;

	while($entry) {
		$dn = ldap_get_dn($ldapconn, $entry);
		if (isset($structure[MAITRES_APPRENTISSAGE][$dn])) {
			// Le maitre d'apprentissage est déjà connu
			$ma = $structure[MAITRES_APPRENTISSAGE][$dn];
		} else {
			// Creation du maitre d'apprentissage
			$info = ldap_get_attributes($ldapconn, $entry);
			$ma = traiter_usager(new Maitre_apprentissage(0), $info);
			$dnStruct = $info["ENTPersonStructRattach"][0];
			$ma->id_entr = traiter_entreprise($modeSimulation, $ldapconn, $dnStruct, &$structure);
				
			if (!$modeSimulation) {
				$ma->save(false);
			} 
		//	else {
		//		$ma->id_ma = sizeof($structure[MAITRES_APPRENTISSAGE]) + 1; 
		//	}
				
			$structure[MAITRES_APPRENTISSAGE][$dn] = $ma;
		}
		$entry = ldap_next_entry($ldapconn, $entry);
		$ids_mas[] = $ma->id_ma;
	}

	return $ids_mas;
}

/*
 * Traite une entrée et crée un objet Enseignant. 
 * Si l'enseignant est tuteur ou reponsable de stage d'un eleve,
 * celui-ci est mis à jour avec l'id de l'enseignant 
 */
function traiter_enseignant($modeSimulation, $synchroTuteursCfa, $ldapconn, $entry, $structure) {
	$info = ldap_get_attributes($ldapconn, $entry);
	$enseignant = traiter_usager(new Enseignant(0), $info);

	$dnEleves = array();
	if($synchroTuteursCfa) {
		if (isset($info["ENTAuxEnsRespStage"]) && isset($info["ENTAuxEnsTutStage"])) {
			$dnEleves = array_merge($info["ENTAuxEnsRespStage"], $info["ENTAuxEnsTutStage"]);
		} elseif (isset($info["ENTAuxEnsRespStage"])) {
			$dnEleves = $info["ENTAuxEnsRespStage"];
		} elseif (isset($info["ENTAuxEnsTutStage"])) {
			$dnEleves = $info["ENTAuxEnsTutStage"];
		}
		unset($dnEleves['count']);
	}

	if (!$modeSimulation) {
		$enseignant->save(false);
	} else {
		$enseignant->id_ens = sizeof($structure[ENSEIGNANTS]) + 1;
	}

	foreach ($dnEleves as $dn) {
		if (isset($structure[APPRENTIS][$dn])) {
			$structure[APPRENTIS][$dn]->id_ens = $enseignant->id_ens;
		}
	}

	return $enseignant;
}

// TODO
function traiter_classe($modeSimulation, $idClasse, $nomFormation, $structure) {
	if (!isset($idClasse) || !isset($nomFormation) ) return 0;

	$unitePedago = $structure[UNITE_PEDAGO][0];

	if (!isset($structure[FORMATIONS][$nomFormation] )) {
		$formation = new Formation(0);
		$formation->nom = $nomFormation;
		$formation->id_unite = $unitePedago->id_unite;
		$formation->id_for =  $formation->existe_nom($nomFormation, $unitePedago->id_unite);
		if ($formation->id_for <= 0) {
			if (!$modeSimulation) {
				$formation->insert();
			} else {
				$formation->bdd->requete = "INSERT";
				$formation->id_for = sizeof($structure[FORMATIONS]) + 1;
			}
		}
		$structure[FORMATIONS][$nomFormation] = $formation;
	} else {
		$formation = $structure[FORMATIONS][$nomFormation];
	}

	if (!isset($structure[CLASSES][$formation->id_unite."-".$idClasse])) {
		$classe = new Classe(0);

		$classe->id_for = $formation->id_for;
		list($dummy, $nomClasse) = split('\$', $idClasse);
		$classe->libelle = $nomClasse;
		$classe->id_cla = $classe->existe_libelle($nomClasse, $formation->id_for);
		if ($classe->id_cla <= 0) {
			if (!$modeSimulation) {
				$classe->insert();
			} else {
				$classe->bdd->requete = "INSERT";
				$classe->id_cla = sizeof($structure[CLASSES]) + 1;
			}
		}
		$structure[CLASSES][$formation->id_unite.$idClasse] = $classe;
	} else {
		$classe = $structure[CLASSES][$formation->id_unite."-".$idClasse];
	}

	return $classe->id_cla;
}

/**
 * Traite une entrée et crée un objet Apprenti. 
 */
function traiter_apprenti($modeSimulation, $ldapconn, $entry, $structure) {

	$info = ldap_get_attributes($ldapconn, $entry);
	$dnApprenti = ldap_get_dn($ldapconn, $entry);
	$apprenti = new Apprenti(0);
	traiter_usager($apprenti, $info);

	$dateDeNaissance = $info["ENTPersonDateNaissance"][0];
	$classe = isset($info["ENTEleveClasses"]) ? $info["ENTEleveClasses"][0] : "";
	$formation = isset($info["ENTEleveLibelleMEF"]) ? $info["ENTEleveLibelleMEF"][0] : "";
	$authParentale = isset($info["ENTEleveAutoriteParentale"]) ? $info["ENTEleveAutoriteParentale"][0] : "";
	
	if (isset($dateDeNaissance)) $apprenti->date_nais = $dateDeNaissance;
	$apprenti->id_cla = traiter_classe($modeSimulation, $classe, $formation, &$structure);
	$apprenti->ids_mas  = traiter_maitres_apprentissages($modeSimulation, $ldapconn, $dnApprenti, &$structure);
	if (!empty($authParentale)) {
		$apprenti->id_rl  = traiter_representant_legal($modeSimulation, $ldapconn, $authParentale, &$structure);
	}
	return $apprenti;
}

// ----------------------------------------------------------------
// ----------------------------------------------------------------
function importerLdap($modeSimulation, $synchroTuteursCfa, $uai, $hote, $port, $ldaprdn, $ldappass) {
	global $LEA_URL;
	$config_term = new Terminologie();
	$config_term->set_detail();

	$structure = array();
	$structure[UNITE_PEDAGO] =  array();
	$structure[FORMATIONS] =  array();
	$structure[CLASSES] =  array();
	$structure[APPRENTIS] =  array();
	$structure[ENSEIGNANTS] =  array();
	$structure[MAITRES_APPRENTISSAGE] =  array();
	$structure[REPRESENTANTS_LEGAUX] =  array();
	$structure[ENTREPRISE] =  array();
	
	$titre = array();
	$titre[UNITE_PEDAGO] = $config_term->terminologie_unit_pedag;
	$titre[FORMATIONS] =  $config_term->terminologie_formation;
	$titre[CLASSES] =  $config_term->terminologie_classe;
	$titre[APPRENTIS] =  $config_term->terminologie_app;
	$titre[ENSEIGNANTS] =  $config_term->terminologie_ens;
	$titre[MAITRES_APPRENTISSAGE] =  $config_term->terminologie_ma;
	$titre[REPRESENTANTS_LEGAUX] =  $config_term->terminologie_rl;
	$titre[ENTREPRISE] =  $config_term->terminologie_entr;
	
	$ldapconn = ldap_connect("ldap://".$hote, $port);
	// int ldap_bind (int identifiant [, string bind_rdn [, string bind_password]])
	if (!$ldapconn) {
		echo "<h2 class='important'>Impossible de se connecter au ldap à l'adresse '$hote' port'$port'</h2>";
		return 1;
	}
    //Connexion au serveur LDAP
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
    if (!$ldapbind) {
		echo "<h2 class='important'>Impossible de se connecter au ldap (adresse '$hote' port '$port')</h2>";
		echo "<h2 class='important'>LDAP-Error: ".to_html(ldap_error($ldapconn)). "</h2>";
		echo "<h2 class='important'>Veuillez v&eacute;rifier vos param&egrave;tres de connexion.</h2>";
	   	return 1;
    }

	
	// Recherche du dn de l'établissement
	$dn = "ou=structures,dc=esco-centre,dc=fr";
	$filter="ENTStructureUAI=$uai";
	$justthese = array("dn");
	$results = ldap_search($ldapconn, $dn, $filter, $justthese);
	
	$info = ldap_get_entries($ldapconn, $results);
	if ($info["count"] == 1) {
		$dnEtablissement = $info[0]['dn'];
	} else {
		echo "<h2 class='important'>Etablissement $uai non trouvé</h2>";
		ldap_close($ldapconn);
		return(1);
	}
	
	// ----------------------------------------------------------------
	// Recherche/création de l'unite pédagogique
	// ----------------------------------------------------------------
	$unitePedago = new Unite_pedagogique(0);
	$unitePedago->nom = $uai;
	$unitePedago->id_unite = $unitePedago->existe_nom($unitePedago->nom);
	if ($unitePedago->id_unite <= 0) {
		if ($modeSimulation) {
			$unitePedago->id_unite = 1;
			$unitePedago->bdd->requete = "INSERT";
		} else {
			$unitePedago->insert(false);
		}
	}
	$structure[UNITE_PEDAGO][0] = $unitePedago;
	
	// ----------------------------------------------------------------
	// Recherche des apprentis de l'établissement
	// ----------------------------------------------------------------
	$dn = "ou=people,dc=esco-centre,dc=fr";
	$filter="(&(objectclass=ENTEleve)(ENTPersonStructRattach=$dnEtablissement))";
	$justthese = array("*");
	$results = ldap_search($ldapconn, $dn, $filter, $justthese);
	
	// Boucle sur chaque élève de l'établissement trouvé
	$entry = ldap_first_entry($ldapconn, $results);
	while ($entry) {
		$dn = ldap_get_dn($ldapconn, $entry);
		$structure[APPRENTIS][$dn] = traiter_apprenti($modeSimulation, $ldapconn, $entry, &$structure);
		$entry = ldap_next_entry($ldapconn, $entry);
	}
	
	// ----------------------------------------------------------------
	// Recherche des enseignants de l'établissement
	// ----------------------------------------------------------------
	$dn = "ou=people,dc=esco-centre,dc=fr";
	$filter="(&(objectclass=ENTAuxEnseignant)(ENTPersonStructRattach=$dnEtablissement))";
	$justthese = array("*");
	$results = ldap_search($ldapconn, $dn, $filter, $justthese);
	
	// Boucle sur chaque enseignant de l'établissement trouvé
	$entry = ldap_first_entry($ldapconn, $results);
	while ($entry) {
		$dn = ldap_get_dn($ldapconn, $entry);
		$structure[ENSEIGNANTS][$dn] = traiter_enseignant($modeSimulation, $synchroTuteursCfa, $ldapconn, $entry, &$structure);
		$entry = ldap_next_entry($ldapconn, $entry);
	}
	
	ldap_close($ldapconn);
	
	// Sauvegarde des apprentis (a faire en dernier)
	if (!$modeSimulation) { 
		foreach ($structure[APPRENTIS] as $apprenti) {
			$apprenti->save(false);
		}
		
	// Mise à jour du nombre d'apprentis des entreprises
	$sql="update les_entreprises
		  set nb_apprentis = (
			select count(les_apprentis.id_app)
			from les_maitres_apprentissage, les_apprentis
			where les_maitres_apprentissage.id_entr = les_entreprises.id_entr
			  and les_apprentis.id_ma = les_maitres_apprentissage.id_ma	)";
	$bdd = new Connexion_BDD_LEA();
	$bdd->executer($sql);
		
	}
	// Div permettant de paginer le résultat sous forme de tab
	echo '<div id="tabs-' . $uai . '">';
	if ($modeSimulation) {
		echo "<h2 class='important'>Résultat de la simulation</h2>\n";
	} else {
		echo "<h2 class='important'>Résultat de l'importation</h2>\n";
	}
	
	// Rapport d'execution
	echo "<table>\n";
	foreach(array_keys($structure) as $key) {
		
		echo "\n";
		echo "<tr><th colspan='3'>".to_html(ucfirst($titre[$key]))."</th></tr>\n";
	
		foreach ($structure[$key] as $id=>$elt) {
	
			$sql = strtoupper($elt->bdd->requete);
			if (is_numeric(strpos($sql, "INSERT"))) {
				$operation = "Création";
			} elseif (is_numeric(strpos($sql, "UPDATE"))) {
				$operation = "Mise à jour";
			} else {
				$operation = "Déjà existant";
			}
			if (!empty($elt->bdd->erreurs)) {
				$img = "ico_fermer.png";
				$msg_err = "<br/><b>".to_html($elt->bdd->erreurs[1])."</b>";
				$operation .= "<br/><b>Erreur</b>";
			} else {
				$msg_err = "";
				$img = "ico_valider.png";
			}		
			
			$est_personne = false; 	
			switch($key) {
				case UNITE_PEDAGO:
				case FORMATIONS:
					$desc = $elt->nom;
					break;
				case CLASSES:
					$desc = $elt->libelle;
					break;
				case APPRENTIS:
				case ENSEIGNANTS:
				case MAITRES_APPRENTISSAGE:
				case REPRESENTANTS_LEGAUX:
					$est_personne = true;
					$desc = $elt->nom." ".$elt->prenom." (".$elt->login.")";
					break;
				case ENTREPRISE:
					$desc = $elt->nom." ($id)";			
					break;
			}
	
			echo "<tr>";
			echo "<td><img title='$operation' src='".$LEA_URL."images/$img'/>";
			if($est_personne && $elt->is_admin()) {
				echo "<img title='Administrateur' src='".$LEA_URL."images/administration_ico.png' />";
			}
			if($est_personne && $elt->is_apprenti() ) {
				if($elt->has_multiple_ma()) {
					echo "<img title=\"Plusieurs MA associés à l'apprenti dans le LDAP\" src='".$LEA_URL."images/multiple_ma_ico.png' />";
				}
				if($elt->id_ma_has_to_be_updated()) {
					echo "<img title='Attention ! Mise à jour du MA dans le LEA' src='".$LEA_URL."images/warning_ico.png' />";
				}
			}
			echo "</td>";
			echo "<td>".$operation."</td>";
			echo "<td>".to_html($desc).$msg_err."</td>";
			echo "</tr>\n";
		}
	}
	echo "</table><p/>\n";
	// Fin de la tab
	echo '</div>';
	return 0;
}

// Vérification des données transmises
if (!isset($_SESSION['id_admin'])){ 
	echo "<h1 class='important'>Fonctionnalité interdite, vous n'êtes pas administrateur !!!</h1>";
	exit;
}

if (isset($_POST["mode"])) {
	if ($_POST["mode"] == "simulation") {
		$modeSimulation = true;
	} else 	if ($_POST["mode"] == "execution") {
		$modeSimulation = false;
	}
}
if (!is_bool($modeSimulation)) {
	echo "<h1 class='important'>Erreur lors de l'appel : le mode d'execution n'est pas transmis</h1>";
	exit;
}

// Synchronisation des liens entre apprentis et tuteurs au CFA ?
$synchroTuteursCfa = false;
if(isset($_POST["synchro_tuteurs_cfa"])) {
	if ($_POST["synchro_tuteurs_cfa"] == "oui") {
		$synchroTuteursCfa = true;
	} 
}

// Div global contenant les tabs
echo '<div id="tabs">';

// Liste representant les titres des tabs
echo '<ul>';
echo '<li> <a href="#tabs-' . $RNE_ETAB . '">' . $RNE_ETAB . '</a></li>';
if(isset($RNE_ANTENNES)) {
	foreach($RNE_ANTENNES as $RNE) {
		echo '<li> <a href="#tabs-' . $RNE . '">' . $RNE . '</a></li>';
	}
}
echo '</ul>';

// Synchronisation de l'tablissement
importerLdap($modeSimulation, $synchroTuteursCfa, $RNE_ETAB, $LDAP_HOSTNAME, $LDAP_PORT, $LDAP_DN, $LDAP_DN_PWD);

// Si des antennes doivent etre synchronisees
if(isset($RNE_ANTENNES)) {
	foreach($RNE_ANTENNES as $RNE) {
		importerLdap($modeSimulation, $synchroTuteursCfa, $RNE, $LDAP_HOSTNAME, $LDAP_PORT, $LDAP_DN, $LDAP_DN_PWD);
	}
}

// Fin du div global contenant les tabs
echo '</div>';

?>
