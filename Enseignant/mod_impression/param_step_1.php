<?php
/***********************************************************/   
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.1
  // Date: 04/04/07
/***********************************************************/
require_once('../secure.php');
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
/***********************************************************/
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_terminologie.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_param_impression.php");

$formation = new Formation($_SESSION['id_for']);
$config_lea	= $formation->get_config_lea();
$config_term = new Terminologie();
//$congif_term->set_detail();
$les_classes =  $formation->get_classes();

/////////////////////////////////////////////////////////////////////////////////
// Les fonctions                                                               //
/////////////////////////////////////////////////////////////////////////////////

// Fonction de traï¿½age de la session
function debug() {
	$arrayofvals = array("imp_type_formulaire", "imp_select_classe", "imp_apprenti",
						"imp_type_livret","imp_type_suivi","imp_periode",
						 "grouper_type_suivi", "imp_modalite_arbre","imp_arbre");
	
	echo "<div style=\"border: 1px solid red; padding: 10px; margin: 10px; overflow: auto;\">";
	foreach($arrayofvals as $arrayofval) {
		$val = $_SESSION[$arrayofval];
		
		echo "\$_SESSION[".$arrayofval."] : <strong><pre>";
		if($arrayofval == "imp_modalite_arbre" || $arrayofval == "imp_arbre" || $arrayofval == "imp_periode" || $arrayofval == "imp_apprenti") {
			var_dump(unserialize($val));
		} else {
			var_dump($val);
		}
		echo "</pre></strong><br />";
	}
	
	echo "<pre>";
	var_dump($_SESSION);
	echo "</pre>";
	echo "</div>";
}

// Fonction de nettoyage de la session selon l'etape ï¿½ laquelle on se trouve
function clearSessionFromStep($step) {							
	switch($step) {
		// etape 0
		case "0":
			unset($_SESSION["id_param_sel"]);
			unset($_SESSION["imp_type_formulaire"]);
			unset($_SESSION["imp_select_classe"]);
			unset($_SESSION["imp_apprenti"]);
			unset($_SESSION["imp_type_livret"]);
			unset($_SESSION["imp_type_suivi"]);
			unset($_SESSION["imp_periode"]);
			unset($_SESSION["grouper_type_suivi"]);
			unset($_SESSION["imp_modalite_arbre"]);
			unset($_SESSION["imp_arbre"]);
			unset($_SESSION["imp_ordre"]);
		break;
		// etape 1
		case "1":
			unset($_SESSION["imp_select_classe"]);
			unset($_SESSION["imp_apprenti"]);
			unset($_SESSION["imp_type_livret"]);
			unset($_SESSION["imp_type_suivi"]);
			unset($_SESSION["imp_periode"]);
			unset($_SESSION["grouper_type_suivi"]);
			unset($_SESSION["imp_modalite_arbre"]);
			unset($_SESSION["imp_arbre"]);
			unset($_SESSION["imp_ordre"]);
		break;
		// etape 2
		case "2":
			unset($_SESSION["imp_apprenti"]);
			unset($_SESSION["imp_type_livret"]);
			unset($_SESSION["imp_type_suivi"]);
			unset($_SESSION["imp_periode"]);
			unset($_SESSION["grouper_type_suivi"]);
			unset($_SESSION["imp_modalite_arbre"]);
			unset($_SESSION["imp_arbre"]);
			unset($_SESSION["imp_ordre"]);
		break;
		// etape 3
		case "3":
			unset($_SESSION["imp_type_livret"]);
			unset($_SESSION["imp_type_suivi"]);
			unset($_SESSION["imp_periode"]);
			unset($_SESSION["grouper_type_suivi"]);
			unset($_SESSION["imp_modalite_arbre"]);
			unset($_SESSION["imp_arbre"]);
			unset($_SESSION["imp_ordre"]);
		break;
		// etape 4
		case "4":
			unset($_SESSION["imp_type_suivi"]);
			unset($_SESSION["imp_periode"]);
			unset($_SESSION["grouper_type_suivi"]);
			unset($_SESSION["imp_modalite_arbre"]);
			unset($_SESSION["imp_arbre"]);
			unset($_SESSION["imp_ordre"]);
		break;
		// etape 5
		case "5":
			unset($_SESSION["imp_periode"]);
			unset($_SESSION["grouper_type_suivi"]);
			unset($_SESSION["imp_modalite_arbre"]);
			unset($_SESSION["imp_arbre"]);
			unset($_SESSION["imp_ordre"]);
		break;
	}
	
	unset($_SESSION["un_imp_apprenti_tmp_k"]);
	unset($_SESSION["imp_apprenti_tmp"]);
}

function isModele() {
	return (isset($_SESSION["id_param_sel"])) ? true : false;
}

////////////////////////////////////////////////////////////////////////////////
//	Dans le cas oï¿½ le le module d'impression devrait ï¿½tre portï¿½ pour d'autres
// 	profils, le code commentï¿½ ci-dessous devrait permettre de gï¿½rer les droits
//  Si certains dysfonctionnement (donnï¿½es manquante pour un profil), c'est que
//  l'acteur courant n'a pas les droits
////////////////////////////////////////////////////////////////////////////////
/*
if(isset($_SESSION['id_app'])) {
	// L'acteur est un apprenti
	$acteur = "app";
} elseif(isset($_SESSION['id_ens'])) {
	// l'acteur est un ensignant
	$enseignant = new Enseignant($_SESSION['id_ens']);
	$enseignant_est_responsable = $enseignant->est_responsable($_SESSION['id_for']);
	$enseignant_est_tuteur = ($enseignant->id_ens == $apprenti->id_ens);
	if($enseignant_est_responsable) {
		$acteur = "";
	} elseif ($enseignant_est_tuteur) {
		$acteur ='tuteur_cfa';
	} else {
	  	$acteur ='ens';
	}
	unset($enseignant);
} elseif(isset($_SESSION['id_ma'])) {
	// L'acteur est un maitre d'apprentissage
	$acteur = "ma";
} elseif(isset($_SESSION['id_rvs'])) {
	// L'acteur est responsable de vie scolaire
	$acteur = "rvs";
}
*/

// Ici, par dï¿½faut, on considï¿½re que l'acteur est un enseignant
$acteur = "ens";

/////////////////////////////////////////////////////////////////////////////////
// Test des paramï¿½tres envoyï¿½s                                                 //
/////////////////////////////////////////////////////////////////////////////////

// On nettoie la session si:
// * On ne vient pas du module d'impression 
// * On vient de l'etape 2
// * On vient de l'etape 3
// * Un modï¿½le d'impression vient d'ï¿½tre choisi
$referer = @parse_url($_SERVER['HTTP_REFERER']); 
if(!eregi("imp_livret.php", $referer['path']) || eregi("param_step_2", $referer['path']) || (isset($referer['query']) && eregi("param_step_3", $referer['query'])) || (isset($_POST["id_param_sel"]) && $_POST["id_param_sel"] == "-1")) {
	clearSessionFromStep("0");
}

// si on utilise un modï¿½
if((isset($_POST["id_param_sel"]) && $_POST["id_param_sel"] != "-1") || isset($_SESSION["id_param_sel"])) {
		
	if(isset($_POST["id_param_sel"])) {
		clearSessionFromStep("0");
		// Enregistrement l'id du parametrage
		$_SESSION["id_param_sel"] = $_POST["id_param_sel"];
		
		$modele_imp = new Param_impression($_SESSION["id_param_sel"]);
		$params = unserialize($modele_imp->get_valeur_attribut("params"));
		
		// Enregistrement du type de formulaire
		$_SESSION["imp_type_formulaire"] = $params["imp_type_formulaire"];
		
	}
	
	// Si un type de formulaire est
	if(isset($_SESSION["imp_type_formulaire"]) && isset($_POST["imp_select_classe"])) {
		clearSessionFromStep("1");
		
		$modele_imp = new Param_impression($_SESSION["id_param_sel"]);
		$params = unserialize($modele_imp->get_valeur_attribut("params"));
		
		// Enregistrement du type de formulaire
		$_SESSION["imp_type_formulaire"] = $params["imp_type_formulaire"];
		// Enregistrement de l'id de la classe
		$_SESSION["imp_select_classe"] = $_POST["imp_select_classe"];
		
	}
	
	// Si une classe est sï¿½lectionnï¿½e
	if(isset($_SESSION["imp_select_classe"])) {
		
		$modele_imp = new Param_impression($_SESSION["id_param_sel"]);
		$params = unserialize($modele_imp->get_valeur_attribut("params"));
		
		clearSessionFromStep("2");
		
		// Si le formulaire a imprimer est vierge
		if($params["imp_type_formulaire"] == "vierge") {
			$classe_select = new Classe($_SESSION["imp_select_classe"]);
			$classe_select->set_detail();

			// on choisi le 1er de la classe
			$les_apprentis = $classe_select->get_apprentis();
			$un_apprenti = $les_apprentis[0];
	
			// On le passe dans un tableau linï¿½arisï¿½ pour conserver la compatibilitï¿½ avec le reste du syteme
			$tmp = array($un_apprenti->id_app);
			$_SESSION["imp_apprenti"] = serialize($tmp);
		// si il est renseignï¿½
		} else {
			// On test si un apprenti est sï¿½lectionnï¿½
			if(isset($_POST['test_app'])) {
				// si appenti(s) sï¿½lectionnï¿½(s)
				if(isset($_POST["imp_apprenti"])) {
					// On enregistre les id d'apprentis
					$tmp = array();
					foreach($_POST["imp_apprenti"] as $un_app_chkbx) {
						array_push($tmp, $un_app_chkbx);
					}				
					// On le passe dans un tableau linï¿½arisï¿½
					$_SESSION["imp_apprenti"] = serialize($tmp);
				} else {
					// pas d'appenti sï¿½lectionnï¿½
					$msg_err_app = "Vous devez s&eacute;lectionner au moins un acteur: ".$config_lea->appelation_app."";
				}
			}

			
		}
	}
	
	// Si un apprenti est sï¿½lectionnï¿½ on enregistre le reste du paramï¿½trage dans la session
	if(isset($_SESSION["imp_apprenti"])) {
		// on nettoie les paramï¿½tres par sï¿½curitï¿½
		clearSessionFromStep("3");
		
		$sessValAttr = array("imp_type_livret", "imp_type_suivi", "imp_periode",
							"grouper_type_suivi", "imp_modalite_arbre", "imp_arbre");
		
		foreach($sessValAttr as $v) {
			if(isset($params[$v])) {
				if(is_array($params[$v])) {
					$_SESSION[$v] = serialize($params[$v]);
				} else {
					$_SESSION[$v] = $params[$v];
				}
			}
		}
	}

} else {

	if(isset($_POST["imp_type_formulaire"])) {	
		clearSessionFromStep("0");
		$_SESSION["imp_type_formulaire"] = $_POST["imp_type_formulaire"];
	} elseif(isset($_POST["imp_select_classe"])) {
		clearSessionFromStep("1");
		$_SESSION["imp_select_classe"] = $_POST["imp_select_classe"];
	} elseif(isset($_POST["imp_apprenti"]) || isset($_POST['test_app'])) {
		clearSessionFromStep("2");
		if(isset($_POST["imp_apprenti"])) {
			$tmp = array();
			foreach($_POST["imp_apprenti"] as $un_app_chkbx) {
				array_push($tmp, $un_app_chkbx);
			}
			$_SESSION["imp_apprenti"] = serialize($tmp);
		} else {
			$msg_err_app = "Vous devez s&eacute;lectionner au moins un acteur: ".$config_lea->appelation_app."";
		}
	} elseif(isset($_POST["imp_type_livret"])) {
		clearSessionFromStep("3");
		$_SESSION["imp_type_livret"] = $_POST["imp_type_livret"];
	} elseif(isset($_POST["imp_type_suivi"])) {
		clearSessionFromStep("4");
		$_SESSION["imp_type_suivi"] = $_POST["imp_type_suivi"];
	} elseif(isset($_POST["imp_periode_entr"]) || isset($_POST["imp_periode_cfa"]) || isset($_POST['test_periode'])) {	
		clearSessionFromStep("5");
		if(isset($_POST["imp_periode_entr"]) || isset($_POST["imp_periode_cfa"])) {
			$tmp = array();
			if(isset($_POST["imp_periode_cfa"])) {
				foreach($_POST["imp_periode_cfa"] as $une_periode_chkbx) {
					array_push($tmp, $une_periode_chkbx.":cfa");
				}
			}
			if(isset($_POST["imp_periode_entr"])) {
				foreach($_POST["imp_periode_entr"] as $une_periode_chkbx) {
					array_push($tmp, $une_periode_chkbx.":entr");
				}
			}
			if(isset($_POST["grouper_type_suivi"])) {
				$_SESSION["grouper_type_suivi"] = "On groupe par type de suivi";
			} else {
				sort($tmp);
				foreach($tmp as $key => $val) {
					//On concatène 2 choses, l'identifiant de la période qui est le 2ième entier sur 4 octets en base 16 que l'on ré-encode en base 10
					//suivis de son type de période qui se trouve après les 2 entiers de 4 octets en base 16 (soit 8 caractères par entier).
					$tmp[$key]=hexdec(substr($val,8,8)).substr($val,16);
				}
				unset($_SESSION["grouper_type_suivi"]);
			}
			$_SESSION["imp_periode"] = serialize($tmp);
		} else {
			$msg_err_periode = "Vous devez s&eacute;lectionner au moins une p&eacute;riode";
		}
	} elseif(isset($_POST["imp_modalite_arbre"]) || isset($_POST["imp_arbre"]) || isset($_POST["test_arbre"])) {	
		clearSessionFromStep("5");
		if(isset($_POST["imp_modalite_arbre"]) || isset($_POST["imp_arbre"])) {	
			if(isset($_POST["imp_modalite_arbre"])) {
				$tmp = array();
				foreach($_POST["imp_modalite_arbre"] as $une_modalite_arbre_chkbx) {
					array_push($tmp, $une_modalite_arbre_chkbx);
				}
				$_SESSION["imp_modalite_arbre"] = serialize($tmp);
				unset($tmp);
			}
			if(isset($_POST["imp_arbre"])) {
				$tmp = array();
				foreach($_POST["imp_arbre"] as $un_arbre_chkbx) {
					array_push($tmp, $un_arbre_chkbx);
				}
				$_SESSION["imp_arbre"] = serialize($tmp);
				unset($tmp);
			}
		} else {
			$msg_err_arbre = "Vous devez s&eacute;lectionner au moins un arbre";
		}
	}
}
?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">M</span>odule d'impression - <span class="orange">&Eacute;</span>tape 1</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">

	<div id="module_imp">
<?php
	if(isModele()) {
		echo "
			<p>
				Attention ! Vous venez d'appliquer un mod&egrave;le d'impression. Un mod&egrave;le n'est pas modifiable.
				Si vous souhaitez personnaliser l'impression, veuillez s&eacute;lectionner et appliquer \"Aucun mod&egrave;le\"
			</p>";
	}
	echo "
			<table>
				<tr>
					<th>I/ Param&eacute;trer une impression</th>
					<th>I/ Charger un mod&egrave;le d'impression</th>
				</tr>
				<tr>
				<form name=\"theForm0\" action=\"imp_livret.php\" method=\"post\">
					<td>";
				
				if(isset($_SESSION["imp_type_formulaire"])) {
					$checked_r = ($_SESSION["imp_type_formulaire"] == "renseigne") ? " checked='checked'" : "";
					$checked_v = ($_SESSION["imp_type_formulaire"] == "vierge") ? " checked='checked'" : "";
				} else {
					$checked_r = "";
					$checked_v = "";
				}
				
				echo "
						<input type='radio' ".((isModele()) ? "onClick=\"return false;\"" : "onClick=\"this.form.submit()\"")." id='imp_type_formulaire_r' name='imp_type_formulaire' value='renseigne' ".$checked_r." /><label for='imp_type_formulaire_r' ".((isModele()) ? "onClick=\"return false;\"" : "")."> Renseign&eacute;</label>";
				echo "
						<input type='radio' ".((isModele()) ? "onClick=\"return false;\"" : "onClick=\"this.form.submit()\"")." id='imp_type_formulaire_v' name='imp_type_formulaire' value='vierge' ".$checked_v." /><label for='imp_type_formulaire_v' ".((isModele()) ? "onClick=\"return false;\"" : "")."> Vierge</label>";
			
	echo "
					</td>
				</form>
				<form name=\"theForm0\" action=\"imp_livret.php\" method=\"post\">
					<td>";
					$modele_imp = new Param_impression();
					
	echo $modele_imp->getListParam();
	echo "
					</td>
				</form>
				</tr>
			</table>";

// -- Sï¿½lectionner un apprenti
if(isset($_SESSION["imp_type_formulaire"])) {
	echo "
		<form name=\"theForm1\" action=\"imp_livret.php\" method=\"post\">
			<table>
				<tr>
					<th>II/ S&eacute;lectionner: ".$config_lea->appelation_classe."</th>
				</tr>
				<tr>
					<td>";
	foreach($les_classes as $classe){
		if(isset($_SESSION["imp_select_classe"])) {
			$checked = ($classe->id_cla == $_SESSION["imp_select_classe"]) ? " checked='checked'" : "";
		} else {
			$checked = "";
		}
		echo "
						<input type='radio' onClick=\"this.form.submit()\" id='imp_select_classe_".$classe->id_cla."' name='imp_select_classe' value='".$classe->id_cla."' ".$checked." /><label for='imp_select_classe_".$classe->id_cla."'> ".$classe->libelle."</label><br />";
	}
	echo "
					</td>
				</tr>
			</table>
		</form>";
}



// -- Sï¿½lectionner un apprenti
if(isset($_SESSION["imp_select_classe"]) && $_SESSION["imp_type_formulaire"] == "renseigne") {
	echo "
		<form name='theForm2' id='theForm2' action='imp_livret.php' method='post'>
			<input type='hidden' name='test_app' value='test' />
			<table>
				<tr>
					<th colspan='2'>III/ S&eacute;lectionner: ".$config_lea->appelation_app."</th>
				</tr>";

	if(isset($msg_err_app)) {
		echo "
				<tr>
					<td class='uneerreur' colspan='2'>
					".$msg_err_app."
					</td>
				</tr>";
	}
	
	echo "
				<tr>
					<td>";
					
	$classe_select = new Classe($_SESSION["imp_select_classe"]);
	$classe_select->set_detail();

	$tab_tmp = (isset($_SESSION["imp_apprenti"])) ? unserialize($_SESSION["imp_apprenti"]) : array();
	
	$les_apprentis = $classe_select->get_apprentis();
	$nbr_app_col1 = ceil(count($les_apprentis)/2);
	$i = 0;
	foreach($les_apprentis as $un_apprenti) {
		if(isset($_SESSION["imp_apprenti"])) {
			$checked = (in_array($un_apprenti->id_app, $tab_tmp)) ? " checked='checked'" : "";
		} else {
			$checked = "";
		}
		$un_usager = new Usager($un_apprenti->id_app);
		$un_usager->set_detail();
		
		if($i == $nbr_app_col1) {
			echo "
					</td>
					<td>";
		}

		echo "
					<input type='checkbox' name='imp_apprenti[]' id='imp_apprenti_".$i."' value='".$un_apprenti->id_app."' ".$checked." /><label for='imp_apprenti_".$i."'> ".$un_usager->nom." ".$un_usager->prenom."</label><br />";
		$i++;
	}
			
	echo "
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<div style=\"float:right;\">
							<input type=\"button\" value=\"Tout cocher\" onClick=\"GereChkbox('imp_apprenti_', 0, ".$i.", 1);\" />&nbsp;&nbsp;&nbsp;
							<input type=\"button\" value=\"Tout d&eacute;cocher\" onClick=\"GereChkbox('imp_apprenti_', 0, ".$i.", 0);\" />&nbsp;&nbsp;&nbsp;
							<input type=\"button\" value=\"Inverser la s&eacute;lection\" onClick=\"GereChkbox('imp_apprenti_', 0, ".$i.", 2);\" />
						</div>
						<div style=\"float:left;\">
							<input type=\"submit\" name=\"mod_imp_action\" value=\"Valider votre choix\" />
						</div>
					</td>
				</tr>
			</table>
		</form>";
} elseif(isset($_SESSION["imp_select_classe"]) && $_SESSION["imp_type_formulaire"] == "vierge" && !isset($_SESSION["imp_apprenti"])) {
	$classe_select = new Classe($_SESSION["imp_select_classe"]);
	$classe_select->set_detail();
										
	$les_apprentis = $classe_select->get_apprentis();
	$un_apprenti = $les_apprentis[0];
	
	clearSessionFromStep("2");
	
	$tmp = array($un_apprenti->id_app);
	$_SESSION["imp_apprenti"] = serialize($tmp);
}

// -- Sï¿½lectionner un Type de livret
if(isset($_SESSION["imp_apprenti"])) {	
	echo "
		<form name='theForm2' action='imp_livret.php' method='post'>
			<table>
				<tr>
					<th colspan='2'>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "III/" : "IV/")." S&eacute;lectionner un le formulaire &agrave; imprimer</th>
				</tr>
				<tr>
					<td>";
	
	$les_choix_type_livret = array("livret_entier" => "".$config_term->terminologie_lea." (la totalit&eacute;)", "synthèse" => "Synth&egrave;se <i>(Arbre)</i>", "periodes" => "P&eacute;riodes <i>(Suivi guid&eacute et suivi libre)</i>");
	
	if($_SESSION["imp_type_formulaire"] == "vierge") {
		unset($les_choix_type_livret['livret_entier']);
	}
	
	foreach($les_choix_type_livret as $un_choix_type_livret_key => $un_choix_type_livret_value) {
		if(isset($_SESSION["imp_type_livret"])) {
			$checked = ($un_choix_type_livret_key == $_SESSION["imp_type_livret"]) ? " checked='checked'" : "";
		} else {
			$checked = "";
		}
		echo "
						<input type='radio' ".((isModele()) ? "onClick=\"return false;\"" : "onClick=\"this.form.submit()\"")." name='imp_type_livret' id='imp_type_livret_".$un_choix_type_livret_key."' value='".$un_choix_type_livret_key."' ".$checked." /><label for='imp_type_livret_".$un_choix_type_livret_key."'".((isModele()) ? "onClick=\"return false;\"" : "")."> ".$un_choix_type_livret_value."</label><br />";
	}
		
	echo "
					</td>
				</tr>
			</table>
		</form>";
}

// -- Sï¿½lectionner un Type de suivi
if(isset($_SESSION["imp_type_livret"]) && (($_SESSION["imp_type_livret"] == "synthèse") XOR ($_SESSION["imp_type_livret"] == "periodes")) ) {	
	echo "
		<form name='theForm3' action='imp_livret.php' method='post'>
			<table>
				<tr>
					<th colspan='2'>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "IV/" : "V/")." S&eacute;lectionner un type de suivi</th>
				</tr>
				<tr>
					<td>";


	$les_choix_type_suivi = array("entr" => "".$config_lea->appelation_entr."", "cfa" => "".$config_term->terminologie_cfa."", "entr_et_cfa" => "".$config_lea->appelation_entr." et ".$config_term->terminologie_cfa."");
			
	foreach($les_choix_type_suivi as $un_choix_type_suivi_key => $un_choix_type_suivi_value) {
		if(isset($_SESSION["imp_type_suivi"])) {
			$checked = ($un_choix_type_suivi_key == $_SESSION["imp_type_suivi"]) ? " checked" : "";
		} else {
			$checked = "";
		}
		echo "
						<input type='radio' ".((isModele()) ? "onClick=\"return false;\"" : "onClick=\"this.form.submit()\"")." name='imp_type_suivi' id='imp_type_suivi_".$un_choix_type_suivi_key."' value='".$un_choix_type_suivi_key."'".$checked." /><label for='imp_type_suivi_".$un_choix_type_suivi_key."'".((isModele()) ? "onClick=\"return false;\"" : "")."> ".$un_choix_type_suivi_value."</label><br />";
	}
						
	echo "
					</td>
				</tr>
			</table>
		</form>";
}

// -- Sï¿½lectionner une ou plusieurs pï¿½riode
if(isset($_SESSION["imp_type_suivi"]) && $_SESSION["imp_type_livret"] == "periodes") {	
	echo "
		<form name='theForm5' action='imp_livret.php' method='post'>
			<input type='hidden' name='test_periode' value='test' />";
			
			$apprenti_sel = new Apprenti($_SESSION["imp_apprenti"]);
			$apprenti_sel->set_detail();
			$formation_app = $apprenti_sel->get_formation();
			$les_periodes = $formation->get_periodes($_SESSION["imp_type_suivi"], $acteur);	
			
			if(count($les_periodes) == 0) {
				echo "Aucune p&eacute;riode n'est associ&eacute;e &agrave;: ".$config_lea->appelation_classe."";
			} else {
				$tab_tmp = (isset($_SESSION["imp_periode"])) ? unserialize($_SESSION["imp_periode"]) : array();
				
				echo "
					<table>";
				if($_SESSION["imp_type_suivi"] == "entr_et_cfa") {
					echo "
						<tr>
							<th>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "V/" : "VI/")." P&eacute;riode ".$config_term->terminologie_cfa."</th>
							<th>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "V/" : "VI/")." P&eacute;riode ".$config_lea->appelation_entr."</th>
						</tr>";
				} elseif($_SESSION["imp_type_suivi"] == "cfa") {
					echo "
						<tr>
							<th>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "V/" : "VI/")." P&eacute;riode ".$config_term->terminologie_cfa."</th>
						</tr>";
				} elseif($_SESSION["imp_type_suivi"] == "entr") {
					echo "
						<tr>
							<th>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "V/" : "VI/")." P&eacute;riode ".$config_lea->appelation_entr."</th>
						</tr>";
				}

				if(isset($msg_err_periode)) {
					echo "
						<tr>
							<td class='uneerreur'".(($_SESSION["imp_type_suivi"] == "entr_et_cfa") ? " colspan='2'" : "").">
							".$msg_err_periode."
							</td>
						</tr>";
				}
				echo "
						<tr>
							<td>
				";
				// CFA
				$i_cfa=0;
				if($_SESSION["imp_type_suivi"] == "cfa" || $_SESSION["imp_type_suivi"] == "entr_et_cfa") {
					foreach($les_periodes as $une_periode) {
						if($une_periode->suivi_cfa == "1") {
							//echo "une_periode->suivi_cfa : ".$une_periode->suivi_cfa;
							$str = $une_periode->id_periode.":cfa";
							$checked = (in_array($str, $tab_tmp)) ? " checked='checked'" : "";
							echo "<input type='checkbox' ".((isModele()) ? "onClick=\"return false;\"" : "")." name='imp_periode_cfa[]' id='imp_periode_cfa_".$i_cfa."' value='".str_pad(dechex($une_periode->rang),8,"0",STR_PAD_LEFT).str_pad(dechex($une_periode->id_periode),8,"0",STR_PAD_LEFT)."'".$checked." /><label for='imp_periode_cfa_".$i_cfa."' ".((isModele()) ? "onClick=\"return false;\"" : "")."> ".$une_periode->libelle."</label><br />\n";
							$i_cfa++;
						}
					}
				}
				if($_SESSION["imp_type_suivi"] == "entr_et_cfa") {
					echo "
							</td>
							<td>
					";
				}
				$i_entr=0;
				if($_SESSION["imp_type_suivi"] == "entr" || $_SESSION["imp_type_suivi"] == "entr_et_cfa") {
					foreach($les_periodes as $une_periode) {
						if($une_periode->suivi_entr == "1") {
							//echo "une_periode->suivi_entr : ".$une_periode->suivi_entr;
							$str = $une_periode->id_periode.":entr";
							$checked = (in_array($str, $tab_tmp)) ? " checked='checked'" : "";
							echo "<input type='checkbox' name='imp_periode_entr[]' ".((isModele()) ? "onClick=\"return false;\"" : "")." id='imp_periode_entr_".$i_entr."' value='".str_pad(dechex($une_periode->rang),8,"0",STR_PAD_LEFT).str_pad(dechex($une_periode->id_periode),8,"0",STR_PAD_LEFT)."'".$checked." /><label for='imp_periode_entr_".$i_entr."' ".((isModele()) ? "onClick=\"return false;\"" : "")."> ".$une_periode->libelle."</label><br />\n";
							$i_entr++;
						}
					}
				}
				
				echo "
							</td>
						</tr>";
				
				if($_SESSION["imp_type_suivi"] == "entr_et_cfa") {
				$checkedgroup = (isset($_SESSION["grouper_type_suivi"])) ? " checked='checked'" : "";
				echo "
						<tr>
							<td colspan='2'>
								<input type='checkbox' ".((isModele()) ? "onClick=\"return false;\"" : "")." name='grouper_type_suivi' id='grouper_type_suivi' value='oui' ".$checkedgroup." /><label for='grouper_type_suivi' ".((isModele()) ? "onClick=\"return false;\"" : "")."> Grouper les p&eacute;riodes par type de suivi</label>
							</td>
						</tr>";
				}
				
				if(!isModele()) {
				
					echo "
						<tr>
							<td colspan='2'>
								<div style=\"float:right;\">
									<input type=\"button\" value=\"Tout cocher\" onClick=\"GereChkbox('imp_periode_entr_', 0, ".$i_entr.", 1); GereChkbox('imp_periode_cfa_', 0, ".$i_cfa.", 1);\" />&nbsp;&nbsp;&nbsp;
									<input type=\"button\" value=\"Tout d&eacute;cocher\" onClick=\"GereChkbox('imp_periode_entr_', 0, ".$i_entr.", 0); GereChkbox('imp_periode_cfa_', 0, ".$i_cfa.", 0);\" />&nbsp;&nbsp;&nbsp;
									<input type=\"button\" value=\"Inverser la s&eacute;lection\" onClick=\"GereChkbox('imp_periode_entr_', 0, ".$i_entr.", 2); GereChkbox('imp_periode_cfa_', 0, ".$i_cfa.", 2);\" />
								</div>
								<div style=\"float:left;\">
									<input type=\"submit\" name=\"mod_imp_action\" value=\"Valider votre choix\" />
								</div>
							</td>
						</tr>";
					
				}
				echo "
					</table>
					";
				
			}
	echo "
		
		</form>";
}



if(isset($_SESSION["imp_type_suivi"]) && isset($_SESSION["imp_type_livret"]) && $_SESSION["imp_type_livret"] == "synthèse") {
	echo "
		<form name='theForm6' action='imp_livret.php' method='post'>
			<input type='hidden' name='test_arbre' value='test' />";
			
			if($_SESSION["imp_type_suivi"] == "entr_et_cfa") {					
				$les_arbres_cfa	 = $config_lea->get_arbres("entr");
				$les_arbres_entr = $config_lea->get_arbres("cfa");
				$les_arbres = array_merge($les_arbres_entr, $les_arbres_cfa);
			} else {
				$les_arbres = $config_lea->get_arbres($_SESSION["imp_type_suivi"]);
			}
			
			// Extraction des tableaux contenant les arbres et les modalitï¿½s selectionnï¿½es			$tab_tmp1 = (isset($_SESSION["imp_arbre"])) ? unserialize($_SESSION["imp_arbre"]) : array();
			$tab_tmp2 = (isset($_SESSION["imp_modalite_arbre"])) ? unserialize($_SESSION["imp_modalite_arbre"]) : array();
			
			
			$tab_affichage = array();
			$tab_affichage["entr"] = "";
			$tab_affichage["cfa"] = "";
			
			if(count($les_arbres) == 0) {
				echo "Aucun arbre n'est associ&eacute;";
			} else {
				$i = 0;
				foreach($les_arbres as $arbre){
					
					if($_SESSION["imp_type_formulaire"] == "renseigne") {
						$tab_affichage[$arbre->type] .= "<span class='titre_arbre'>".strtoupper($arbre->nom)."</span>\n";
					
						$les_modalites = array_merge(
										$arbre->get_modalites('app'),
										$arbre->get_modalites('tuteur_cfa'),
										$arbre->get_modalites('ma'),
										$arbre->get_modalites('ens'),
										$arbre->get_modalites('qrl'),
										$arbre->get_modalites('rf')
									);
						
						foreach($les_modalites as $modalite) {
							// si la rï¿½ponse est du texte alors on l'ï¿½lude
							if(strtolower(get_class($modalite)) == 'modalite_va_unique' && $modalite->type_reponse == 'texte') {
								continue;
							}
							$str = $arbre->id_arbre.":".$modalite->id_modalite.":".strtolower(get_class($modalite));
							$checked2 = (in_array($str, $tab_tmp2)) ? " checked='checked'" : "";
							$tab_affichage[$arbre->type] .= "<input type='checkbox' ".((isModele()) ? "onClick=\"return false;\"" : "")." name='imp_modalite_arbre[]' id='imp_arbre_".$i."' value='".$str."'".$checked2." /><label for='imp_arbre_".$i."' ".((isModele()) ? "onClick=\"return false;\"" : "")."> ".strtolower($modalite->libelle)."</label><br />";
							$i++;
						}
					} else {
						$checked1 = (in_array($arbre->id_arbre, $tab_tmp1)) ? " checked='checked'" : "";
						$tab_affichage[$arbre->type] .= "<input type='checkbox' ".((isModele()) ? "onClick=\"return false;\"" : "")." name='imp_arbre[]' id='imp_arbre_".$i."' value='".$arbre->id_arbre."'".$checked1." /><label for='imp_arbre_".$i."' ".((isModele()) ? "onClick=\"return false;\"" : "").">  ".strtoupper($arbre->nom)."</label><br />\n";
						$i++;
					}
	
						
				}

				echo "
					<table>";
				
				if($_SESSION["imp_type_suivi"] == "entr_et_cfa") {
					echo "
						<tr>
							<th>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "V/" : "VI/")." Arbre ".$config_term->terminologie_cfa."</th>
							<th>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "V/" : "VI/")." Arbre ".$config_lea->appelation_entr."</th>
						</tr>";
				} elseif($_SESSION["imp_type_suivi"] == "cfa") {
					echo "
						<tr>
							<th>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "V/" : "VI/")." Arbre ".$config_term->terminologie_cfa."</th>
						</tr>";
				} elseif($_SESSION["imp_type_suivi"] == "entr") {
					echo "
						<tr>
							<th>".(($_SESSION["imp_type_formulaire"] == "vierge") ? "V/" : "VI/")." Arbre ".$config_lea->appelation_entr."</th>
						</tr>";
				}
				
				if(isset($msg_err_arbre)) {
					echo "
						<tr>
							<td class='uneerreur'".(($_SESSION["imp_type_suivi"] == "entr_et_cfa") ? " colspan='2'" : "").">
							".$msg_err_arbre."
							</td>
						</tr>";
				}
				
				echo "
						<tr>
							<td>";
				// CFA
				if($_SESSION["imp_type_suivi"] == "cfa" || $_SESSION["imp_type_suivi"] == "entr_et_cfa") {
					echo ((!empty($tab_affichage["cfa"])) ? $tab_affichage["cfa"] : "Vide");
				}

				if($_SESSION["imp_type_suivi"] == "entr_et_cfa") {
					echo "
							</td>
							<td>
					";
				}
				
				if($_SESSION["imp_type_suivi"] == "entr" || $_SESSION["imp_type_suivi"] == "entr_et_cfa") {
					echo ((!empty($tab_affichage["entr"])) ? $tab_affichage["entr"] : "Vide");
				}
				
					echo "
							</td>
						</tr>";
					
				if(!isModele()) {
					echo "
						<tr>
							<td colspan='2'>
								<div style=\"float:right;\">
									<input type=\"button\" value=\"Tout cocher\" onClick=\"GereChkbox('imp_arbre_', 0, ".$i.", 1);\" />&nbsp;&nbsp;&nbsp;
									<input type=\"button\" value=\"Tout d&eacute;cocher\" onClick=\"GereChkbox('imp_arbre_', 0, ".$i.", 0);\" />&nbsp;&nbsp;&nbsp;
									<input type=\"button\" value=\"Inverser la s&eacute;lection\" onClick=\"GereChkbox('imp_arbre_', 0, ".$i.", 2);\" />
								</div>
								<div style=\"float:left;\">
									<input type=\"submit\" name=\"mod_imp_action\" value=\"Valider votre choix\" />
								</div>
							</td>
						</tr>";
				}
				echo "
					</table>
				";
			}
				
	echo "
		</form>";
}

if(( isset($_SESSION["imp_type_livret"]) && $_SESSION["imp_type_livret"] == "livret_entier" ) || isset($_SESSION["imp_modalite_arbre"]) || isset($_SESSION["imp_arbre"]) || isset($_SESSION["imp_periode"])) {
	echo "
		<table>
			<tr>
				<th>Aller &agrave; l'&eacute;tape suivante</th>
			</tr>
			<tr>
				<td><input type=\"button\" value=\" &rsaquo; Mise en page\" onClick=\"document.location.href='param_step_2.php';\" /></td>
			</tr>
		</table>";
}

//debug();
?>
		<a name="baspageimp">&nbsp;</a>
		<script language="javascript" type="text/javascript">
			var doc = document.location.href.split("#");
			window.location.replace(doc[0] + "#baspageimp");
		</script>
	</div>
</div>
