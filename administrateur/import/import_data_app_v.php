<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 11/10/05
// Contenu: Ce script permet de d'enregistrer les données de tous les apprentis saisis 
//          dans fichier texte du format csv fourni en paramètre 
/***********************************************************/
ob_start();
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."lib/parserCSV/parsecsv.lib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");

/***********************************************************/
error_reporting(E_ALL ^ E_NOTICE);
ini_set("max_execution_time",3600); // la durée maximale d'exécution du script est 3600 secondes( 1 heure )

if(isset($_REQUEST['id_cla'])) $id_cla = $_REQUEST['id_cla'];
else { html_refresh("../accueil.php"); exit(); }

if(isset($_REQUEST['option_login'])) $option_login = $_REQUEST['option_login'];
else { html_refresh("../accueil.php"); exit(); }

if(isset($_REQUEST['option_mdp'])) $option_mdp = $_REQUEST['option_mdp'];
else { html_refresh("../accueil.php"); exit(); }

if(isset($_REQUEST['update'])) $update = 1;  // = 1 si les données de la base  doivent être changées par celle du fichier d'importation
else $update = 0;

$bdd = new Connexion_BDD_LEA();
$src = $_FILES['data']['tmp_name'];
$nom = $_FILES['data']['name'];
$erreur = $_FILES['data']['error'];

if($erreur) {
	afficher_msg_erreur("Erreur lors de téléchargement  du fichier à importer"); afficher_boutton_retour(); exit();
}

//$fp = fopen ("$src","r");
//$data = array();
//$ligne1 = fgetcsv ($fp, 10000, ";"); // les noms des données importées
//$row = 0;
//
//while ($ligne = fgetcsv ($fp, 10000, ";")) {
//	if(isset($ligne)&& $ligne[0]!= NULL) {
//		$nb = count($ligne);
//		for($j=0; $j < $nb; $j++ ) {
//			$key = trim( $ligne1[$j] );
//			$data[$row][$key] = $ligne[$j];
//		}
//		$row++;
//	}
//}
//fclose ($fp);

$ary[] = "UTF-8";
$ary[] = "ISO-8859-1";

$csv = new parseCSV();
$csv->delimiter = ";";
$csv->load_data($src);

if (mb_detect_encoding($csv->file_data, $ary, true) != "UTF-8") {
	$csv->file_data = iconv("ISO-8859-1", "UTF-8", $csv->file_data);
}
$data = $csv->parse_string();

// $nbl = count($data); //le nombre de lignes

// variables de statistique.

$nb_app_update = 0; // nombre d'apprentis mis à jours.
$nb_app_insert = 0; // nombre d'apprentis enregistrés.
$nb_ens_update = 0; // nombre d'enseignants tuteur mis à jours.
$nb_ens_insert = 0; // nombre d'enseignants tuteur  enregistrés.
$nb_rl_update = 0;  // nombre de representants légaux mis à jours.
$nb_rl_insert = 0;  // nombre de representants légaux  enregistrés.
$nb_ma_update = 0;  // nombre de maitres d'apprentissage mis à jours.
$nb_ma_insert = 0;  // nombre de maitres d'apprentissage enregistrés.
$nb_entr_update = 0; // nombre d'entreprises mise à jours.
$nb_entr_insert = 0; // nombre d'entreprises enregistrées.

// parcours de la table data: chaque ligne correspond à un apprenti

//for($i=0; $i < $nbl; $i++)
foreach ($data as $ligne) 
{
	$apprenti = new Apprenti(0);
	$parent = new Representant_legal(0);
	$tuteur = new Enseignant(0);
	$entreprise  = new Entreprise(0);
	$ma = new Maitre_apprentissage(0);

	//$ligne = $data[$i];

	$apprenti->civilite 	= addslashes(trim($ligne["CIVILITE_DU_JEUNE_LONG"]));
	$apprenti->nom 			= addslashes(trim($ligne["NOM_DU_JEUNE"]));
	$apprenti->prenom 		= addslashes(trim($ligne["PRENOM_DU_JEUNE"]));
	$apprenti->profil 		= "app";

	if($existe_apprenti = $apprenti->existe()) {
		$apprenti->id_app = $apprenti->id_usager;
		$apprenti->set_detail(0);
	}

	$apprenti->civilite 	= addslashes(trim($ligne["CIVILITE_DU_JEUNE_LONG"]));
	$apprenti->nom 			= addslashes(trim($ligne["NOM_DU_JEUNE"]));
	$apprenti->prenom 		= addslashes(trim($ligne["PRENOM_DU_JEUNE"]));
	$apprenti->adresse  	= addslashes($ligne["ADRESSE1_DU_JEUNE"])."\n".
	addslashes($ligne["ADRESSE2_DU_JEUNE"])."\n".
	addslashes($ligne["CODE_POSTAL_DU_JEUNE"])."   ".
	addslashes($ligne["VILLE_DU_JEUNE"]) ;
	$apprenti->tel_fixe     = addslashes($ligne["TELEPHONE_DU_JEUNE"]);
	$apprenti->tel_mobile 	= addslashes($ligne["TELEPHONE2_DU_JEUNE"]);
	$apprenti->email		= addslashes($ligne["EMAIL_JEUNE"]);
	//$apprenti->date_nais 	= trans_date( addslashes($ligne["DATE_DE_NAISSANCE_DU_JEUNE"]) , "/" );
	$apprenti->date_nais 	= addslashes($ligne["DATE_DE_NAISSANCE_DU_JEUNE"]);
	$apprenti->no_insc 		= addslashes( $ligne["NUMERO_DU_JEUNE"] );
	$apprenti->diplomes_obtenus   	=  addslashes($ligne["DIPLOME_AV_CTR_DU_JEUNE"]);
	$apprenti->dern_classe_freq 	=  addslashes($ligne["SITUATION_ANNEE_PREC"]);

//	$apprenti->date_debut_contrat 	=  trans_date( addslashes( $ligne["DATE_DEBUT_CONTRAT"] ), "/" );
//	$apprenti->date_fin_contrat   	=  trans_date( addslashes( $ligne["DATE_FIN_CONTRAT"] ) , "/" ) ;
	$apprenti->date_debut_contrat 	=  addslashes( $ligne["DATE_DEBUT_CONTRAT"] );
	$apprenti->date_fin_contrat   	=  addslashes( $ligne["DATE_FIN_CONTRAT"] );
	$apprenti->url_site = addslashes($apprenti->url_site);
	$apprenti->login 	= addslashes($apprenti->login);
	$apprenti->mdp 		= addslashes($apprenti->mdp);
	$apprenti->no_secu  = addslashes($apprenti->no_secu);
	$apprenti->adresse_perso = addslashes($apprenti->adresse_perso);
	$apprenti->email_perso 	 = addslashes($apprenti->email_perso);
	$apprenti->tel_perso     = addslashes($apprenti->tel_perso);

	if(!$existe_apprenti) { // s'il s'agit d'un nouvel apprenti : génération automatique du login et mot de pass
		$apprenti->login = create_login($option_login,  "$apprenti->prenom " . " $apprenti->nom") ;
		$apprenti->mdp = create_mdp($option_mdp,  $apprenti->login ) ;
	}

	//print_r($apprenti); echo("<br><br>");
	$parent->civilite	= addslashes(trim($ligne["CIVILITE_DU_REPLEGAL_LONG"]));
	$parent->nom 		= addslashes(trim($ligne["NOM_DU_REPLEGAL"]));
	$parent->prenom 	= addslashes(trim($ligne["PRENOM_DU_REPLEGAL"]));
	$parent->profil		= "rl";

	if($existe_parent = $parent->existe()) {
		$parent->id_rl = $parent->id_usager;
		$parent->set_detail(0);
	}

	$parent->civilite	= addslashes(trim($ligne["CIVILITE_DU_REPLEGAL_LONG"]));
	$parent->nom 		= addslashes(trim($ligne["NOM_DU_REPLEGAL"]));
	$parent->prenom 	= addslashes(trim($ligne["PRENOM_DU_REPLEGAL"]));
	$parent->tel_fixe	= addslashes($ligne["TELEPHONE_LEGAL"]);
	$parent->tel_mobile = addslashes($ligne["TELEPHONE2_LEGAL"]);
	$parent->adresse	= addslashes($ligne["ADRESSE1_LEGAL"])."\n".
	addslashes($ligne["ADRESSE2_LEGAL"])."\n".
	addslashes($ligne["CODE_POSTAL_LEGAL"])."   ".
	addslashes($ligne["VILLE_LEGAL"]);
	$parent->email 			= addslashes($parent->email);
	$parent->url_site 		= addslashes($parent->url_site);
	$parent->login 			= addslashes($parent->login);
	$parent->mdp 			= addslashes($parent->mdp);
	$parent->profession 	= addslashes($parent->profession);
	$parent->adresse_prof 	= addslashes($parent->adresse_prof);

	if(!$existe_parent ) {
		$parent->login =create_login($option_login,  "$parent->prenom " . " $parent->nom") ;
		$parent->mdp = create_mdp($option_mdp,  $parent->login ) ;
	}

	$tuteur->civilite	 = addslashes(trim($ligne["CIVILITE_TUTEUR_CFA_LONG"]));
	$tuteur->nom		 = addslashes(trim($ligne["NOM_TUTEUR_CFA"]));
	$tuteur->prenom 	 = addslashes(trim($ligne["PRENOM_TUTEUR_CFA"]));

	unset($dr_soumis);
	$sql="select dr_soumis from les_droits where id_droit='ens'";
	$result=$bdd->executer($sql);
	while($ligne2 = mysql_fetch_assoc($result)){
		$dr_soumis=$ligne2['dr_soumis'];
	}
	$tuteur->profil 	 = empty($dr_soumis) ? "ens" : $dr_soumis;

	if($existe_tuteur = $tuteur->existe()) {
		$tuteur->id_ens = $tuteur->id_usager;
		$tuteur->set_detail();
	}

	$tuteur->civilite	 = addslashes(trim($ligne["CIVILITE_TUTEUR_CFA_LONG"]));
	$tuteur->nom		 = addslashes(trim($ligne["NOM_TUTEUR_CFA"]));
	$tuteur->prenom 	 = addslashes(trim($ligne["PRENOM_TUTEUR_CFA"]));
	$tuteur->adresse     = addslashes($ligne["ADRESSE1_TUTEUR_CFA"])."\n".
	addslashes($ligne["ADRESSE2_TUTEUR_CFA"])."\n".
	addslashes($ligne["CODE_POSTAL_TUTEUR_CFA"])."   ".
	addslashes($ligne["VILLE_TUTEUR_CFA"]);
	$tuteur->tel_fixe	=  addslashes($ligne["TELEPHONE1_TUTEUR_CFA"]);
	$tuteur->tel_mobile	=  addslashes($ligne["TELEPHONE2_TUTEUR_CFA"]);
	$tuteur->email		=  addslashes($ligne["EMAIL_TUTEUR_CFA"]);
	$tuteur->url_site 	=  addslashes($tuteur->url_site);
	$tuteur->discipline =  addslashes($tuteur->discipline);

	if(! $existe_tuteur) {
		$tuteur->login = create_login($option_login,  "$tuteur->prenom " . " $tuteur->nom") ;
		$tuteur->mdp = create_mdp($option_mdp,  $tuteur->login ) ;
	}

	$entreprise->nom 		 = addslashes(trim($ligne["RAISON_SOCIALE_ENT"]));
	$entreprise->adresse 	 = addslashes($ligne["ADRESSE1_ENT"])." \n ".addslashes($ligne["ADRESSE2_ENT"]);
	$entreprise->code_postal = addslashes($ligne["CODE_POSTAL_ENT"]);
	$entreprise->ville		 = addslashes($ligne["VILLE_ENT"]);

	$entreprise->tel_fixe1	 = addslashes($ligne["TELEPHONE_ENTREPRISE"]);
	$entreprise->tel_fixe2   = addslashes($ligne["TELEPHONE2_ENTREPRISE"]);
	$entreprise->fax		 = addslashes($ligne["FAX_ENTREPRISE"]);
	$entreprise->email		 = addslashes($ligne["EMAIL_ENTREPRISE"]);
	$entreprise->nom_contact = addslashes($ligne["NOM_DU_RESP"]);
	$entreprise->prenom_contact = addslashes($ligne["PRENOM_DU_RESP"]);
	$entreprise->nb_salaries    = addslashes($ligne["NOMBRE_DE_SALARIES"]);
	$entreprise->url_site 			= addslashes($entreprise->url_site );
	$entreprise->secteur_activite 	= addslashes($entreprise->secteur_activite );
	$entreprise->nb_apprentis 		= addslashes($entreprise->nb_apprentis );


	$ma->civilite		= addslashes(trim($ligne["CIVILITE_TUTEUR_ENT_LONG"]));
	$ma->nom			= addslashes(trim($ligne["NOM_TUTEUR_ENT"]));
	$ma->prenom			= addslashes(trim($ligne["PRENOM_TUTEUR_ENT"]));
	
	unset($dr_soumis);
	$sql="select dr_soumis from les_droits where id_droit='ma'";
	$result=$bdd->executer($sql);
	while($ligne2 = mysql_fetch_assoc($result)){
		$dr_soumis=$ligne2['dr_soumis'];
	}

	$ma->profil = empty($dr_soumis) ? "ma" : $dr_soumis;

	if($existe_maitre = $ma->existe()) {
		$ma->id_ma = $ma->id_usager;
		$ma->set_detail(0);
	}

	$ma->civilite		= addslashes(trim($ligne["CIVILITE_TUTEUR_ENT_LONG"]));
	$ma->nom			= addslashes(trim($ligne["NOM_TUTEUR_ENT"]));
	$ma->prenom			= addslashes(trim($ligne["PRENOM_TUTEUR_ENT"]));
	$ma->adresse		= addslashes($ligne["ADRESSE1_TUTEUR_ENT"])."\n".
	addslashes($ligne["ADRESSE2_TUTEUR_ENT"])."\n".
	addslashes($ligne["CODE_POSTAL_TUTEUR_ENT"])."   ".
	addslashes($ligne["VILLE_TUTEUR_ENT"]);
	$ma->tel_fixe		= addslashes($ligne["TELEPHONE_TUTEUR_ENT"]);
	$ma->tel_mobile		= addslashes($ligne["TELEPHONE2_TUTEUR_ENT"]);
	$ma->email			= addslashes($ligne["EMAIL_TUTEUR_ENT"]);
	$ma->url_site		= addslashes($ma->url_site);

	if(!$existe_maitre) {
		$ma->login = create_login($option_login,  "$ma->prenom " . " $ma->nom") ;
		$ma->mdp = create_mdp($option_mdp,  $ma->login ) ;
		$ma->id_entr = 0;
	}


	// si le nom du responsable de l'entreprise de l'apprenti est non communiqué	
	// le nom de celleci sera le nom et le  prenom du maitre d'apprentissage

	if ($entreprise->nom == "")  $entreprise->nom	= $ma->nom." ".$ma->prenom;

	/*
	 Il se pourrait que l'apprenti soit le représentant légal de lui même, 
	 Dans ce cas, on ne crée que l'apprenti 
	 */

	if($apprenti->nom == $parent->nom && $apprenti->prenom == $parent->prenom) {
		$parent->login = "";
		// $apprenti->profil .= ",rl";
	}

	if( trim($entreprise->nom) != "" ) {

		if($entreprise->existe())  {
			if($update) {
				$entreprise->update();
				$nb_entr_update++;
			}
		} else {
			$entreprise->insert();
			$nb_entr_insert++;
		}

	}


	if (trim($ma->login) != "" ) {

		$ma->id_entr = $entreprise->id_entr;

		if( $existe_maitre) {
			if($update) {
				$ma->update();
				$nb_ma_update++;
			}
		}
		else{
			$ma->insert();
			$nb_ma_insert++;

		}
	}

	if (trim($parent->login) != "" ) {
		if( $existe_parent) { // si le parent existe, son identifiant est stockés dans la variable $id_usager	
			if($update) {
				$parent->update();
				$nb_rl_update++;
			}
		} else {
			$parent->insert();
			$nb_rl_insert++;
		}
	}

	if (trim($tuteur->login) != "" ) {
		if( $existe_tuteur) {
			if($update) {
				$tuteur->update();
				$nb_ens_update++;
			}
		} else {
			$tuteur->insert();
			$nb_ens_insert++;

		}
	}

	if (trim($apprenti->login) != "") {
		if($id_cla=='all') {
			$apprenti->id_cla = 0;
		}
		else {
			$apprenti->id_cla = $id_cla;
		}

		$apprenti->id_ma  = $ma->id_ma;
		$apprenti->id_ens = $tuteur->id_ens;
		$apprenti->id_rl  = $parent->id_rl;

		if( $existe_apprenti) {
			if($update) {
				$apprenti->update();
				$nb_app_update++;
			}
		}
		else{
			$apprenti->insert();
			$nb_app_insert++;
		}

	}
	//print_r($apprenti); echo"<hr>";

}//fin  foreach

// Mise à jour du nombre d'apprentis des entreprises
$sql="update les_entreprises
	  set nb_apprentis = (
		select count(les_apprentis.id_app)
		from les_maitres_apprentissage, les_apprentis
		where les_maitres_apprentissage.id_entr = les_entreprises.id_entr
		  and les_apprentis.id_ma = les_maitres_apprentissage.id_ma	)";
$result=$bdd->executer($sql);


$str="
<div id=\"top_l\"></div><div id=\"top_m\"><h1><span class=\"orange\">I</span>mportation des apprentis</h1></div><div id=\"top_r\"></div>
<b>Statistique </b> <hr>
<pre>
Nombre d'apprentis mis à jours : <b> $nb_app_update </b>
Nombre d'apprentis enregistrés : <b> $nb_app_insert </b>
------------------------------------------------------------------------------
Nombre d'enseignants tuteur mis à jours : <b> $nb_ens_update </b>
Nombre d'enseignants tuteur  enregistrés: <b> $nb_ens_insert </b>
------------------------------------------------------------------------------
Nombre de representants légaux mis à jours  : <b> $nb_rl_update </b>
Nombre de representants légaux  enregistrés : <b> $nb_rl_insert </b>
------------------------------------------------------------------------------
Nombre de maitres d'apprentissage mis à jours : <b> $nb_ma_update </b>
Nombre de maitres d'apprentissage enregistrés : <b> $nb_ma_insert </b>
------------------------------------------------------------------------------
Nombre d'entreprises mise à jours : <b> $nb_entr_update </b>
Nombre d'entreprises enregistrées : <b> $nb_entr_insert </b>
</pre>";

//html_refresh($LEA_URL."administrateur/gest_usag/gest_usag.php?cmd=cons_liste_app&id_cla=$id_cla");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
	
		<title>LEA Administrateur</title>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<meta name="keywords" content="" />
		<meta name="special" content="" />
		<link rel="stylesheet" type="text/css"
			href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"
			media="screen" />
		<script type="text/javascript" src="/javascript/menu.js"></script>
	</head>
	<body>
	
		<div id="conteneur">
			<div id="header">
				<div id="session">
					<?php 
					$nom_admin=$_SESSION['nom_admin'];
					$prenom_admin=$_SESSION['prenom_admin'];
					echo  "<strong>Bonjour ".$prenom_admin."&nbsp;".$nom_admin."</strong>";
					if (!$AUTHENTIFICATION_CAS) {
						echo '<a href="../fermer_session.php">D&eacute;connexion</a>';
					}
					?> 
				</div>
					<?php include($LEA_REP."header.php")?>
			</div>
			<div id="contenu">
				<div id="contents">
					<?php 
					echo"$str";
					echo"<a href=\"$LEA_URL"."administrateur/gest_usag/gest_usag.php?cmd=cons_liste_app&id_cla=$id_cla". "\"\>
											Liste des apprentis importés </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					afficher_boutton_retour();
					?>
				</div>
				<div id="bottom_box"></div>
			</div>
			<div id="footer"><?php include($LEA_REP."footer.php")?></div>
		</div>
	</body>
</html>
