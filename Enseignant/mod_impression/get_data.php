<?php
/***********************************************************/
  // CFA des 3 villes
  // Web: www.cfa3villes.com.
    
  // Auteur : Matthieu DANET & Armand LEMARCHAND
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
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
require_once($LEA_REP."modele/classe_declaration_vierge.php");
/***********************************************************/
//require_once($LEA_REP."lib/pdf/class.ezpdf.php");
//require_once($LEA_REP."lib/pdf/fonction.php");
define("FPDF_FONTPATH",$LEA_REP."lib/fpdf/font/");
require_once($LEA_REP."lib/fpdf/fpdf.php");
require_once($LEA_REP."lib/fpdf/pdf.php");
/***********************************************************/
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
define('_REP_', $LEA_REP, false);
//define('_MAINFONT_', $LEA_REP.'lib/pdf/fonts/Helvetica.afm', false);
//define('_TEXTFONT_', $LEA_REP.'lib/pdf/fonts/Times-Roman.afm', false);

function debug() {
	$arrayofvals = array("imp_select_classe", "imp_apprenti", "imp_type_livret", "imp_type_suivi", "imp_format", "imp_periode");
	
	echo "<div style=\"border: 1px solid red; padding: 10px; margin: 10px; \">";
	echo "<strong>Controle des variables Session :</strong><br />";
	foreach($arrayofvals as $arrayofval) {
		$val = (isset($_SESSION[$arrayofval])) ? $_SESSION[$arrayofval] : "<i>null</i>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;\$_SESSION[".$arrayofval."] : <strong>".$val."</strong><br />";
	}
	echo "</div>";
}

function existe_t_il_une_Declaration($f_id_app, $f_id_periode, $f_type_suivi_periode) {
	$bdd_func = new Connexion_BDD_LEA();
	
	$sql = "SELECT id_dec
			FROM les_declarations
			WHERE id_app = '".$f_id_app."' and id_periode = '".$f_id_periode."' and type_suivi = '".$f_type_suivi_periode."'";

	$result = $bdd_func->executer($sql);		
	
	if ($ligne = mysql_fetch_assoc($result)) {
	  	return $ligne["id_dec"];
	} else {
		return 0;	
	}
}
// On initialise les variables concernant l'enseignant qui est en train d'utiliser le LEA
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
$tep = unserialize($_SESSION["imp_apprenti"]);
//Instanciation d'un apprenti
$apprenti = new Apprenti($tep[0]);
$apprenti->set_detail();

// $apprenti->adresse
// $apprenti->nom
// $apprenti->prenom

// Instanciation de la classe de l'apprenti
$classe = new Classe($apprenti->id_cla);
$classe->set_detail();

// $classe->libelle

// Instanciation de la formation de l'apprenti
$formation = new Formation($_SESSION['id_for']);
$formation->set_detail();

// $formation->nom

// Instanciation d'un MA de l'apprenti
$ma = new Maitre_apprentissage($apprenti->id_ma);
$ma->set_detail();

// $ma->nom

// Instanciation de l'entreprise du MA
$entreprise = new Entreprise($ma->id_entr);
$entreprise->set_detail();

// $entreprise->nom

// Instanciation du tuteur CFA
$tuteur = new Enseignant($apprenti->id_ens);
$tuteur->set_detail();

if($apprenti->id_ma > 0) {
	$maitre = $ma->nom." ".$ma->prenom;
} else {
	$maitre = 'Non renseignÃ©';
}
if($apprenti->id_ens > 0) {
	$tut = $tuteur->nom." ".$tuteur->prenom;
} else {
	$tut = 'Non renseignÃ©';
}

$nomcomplet = $apprenti->prenom.' '.$apprenti->nom;

$pdf = new PDF();
$pdf->setInformations($config_term->terminologie_lea,$nomcomplet);
$pdf->SetDisplayMode("fullpage", "single");
//$pdf->SetAutoPageBreak(true);
$pdf->AddPage();
$pdf->pageDeCouverture($config_term->terminologie_lea, $apprenti->nom, $apprenti->prenom, $apprenti->adresse, $formation->nom, $entreprise->nom, $tut, $maitre, $config_term->terminologie_classe, $config_term->terminologie_entr, $config_term->terminologie_tuteur_cfa, $config_term->terminologie_ma);
$pdf->SetMargins(15,20,15,20);
$pdf->AddPage();
//$pdf->synthese('');
//$testArray = array(array('truc', 'm truc'), array('truc', 'm truc'), array('truc', 'm truc'));
//$pdf->tableau('Test\nbgfh\nuihds\nqshiu\nuihdi\nhsdk', $testArray);

//$pdf->Output();


$config_lea	= $formation->get_config_lea();

if($_SESSION["imp_type_livret"] == "periodes") {
	//on extrait tout de la variable session
	$tab_tmp = (isset($_SESSION["imp_periode"])) ? unserialize($_SESSION["imp_periode"]) : array();
	
	foreach($tab_tmp as $une_periode_et_suivi) {
		
		list($une_periode_id, $une_periode_type_suivi) = explode(":", $une_periode_et_suivi);
		
		if($_SESSION['imp_type_formulaire'] != "vierge") {
			// on check si une déclaration existe
			$id_declaration = existe_t_il_une_Declaration($apprenti->id_app, $une_periode_id, $une_periode_type_suivi);
		} else {
			// on simule la "non-existance d'une déclaration
			// puuisqu'on souhaite imprimer des périodes vierges
			$id_declaration = 0;
		}
		
		// la dÃ©claration existe
		if($id_declaration > 0) {
		
			// CrÃ©ation de la dÃ©claration
			$declaration = new Declaration($id_declaration);
			$declaration->set_detail();
			
			//echo "<div  style=\"background-color: #EEEEEE;\">";
			//echo "<div  style=\"background-color: #FFF000;\">";
			
			$date_declaration = trans_date($declaration->date_dec);
			//echo " ---------------------------------------------------------------------------------------------------------------<br />";
			//echo " ---------------------------------------------------------------------------------------------------------------<br />";
			//echo " la d&eacute;claration existe pour la p&eacute;riode id = ".$une_periode_id."<br />";
			//echo " Date de la d&eacute;claration : ".$date_declaration."<br />";		
			//echo " ---------------------------------------------------------------------------------------------------------------<br />";
			//echo " ---------------------------------------------------------------------------------------------------------------<br />";
			
			//echo "</div>";
			
			$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
			
			//echo "<br /><br />-------- Feuilles d&eacute;clar&eacute;e ---------<br />";
			
			foreach($les_arbres as $arbre){
				if($feuilles_declarees = $declaration->afficher_feuilles_declarees_pdf($arbre, $declaration->id_periode) ) {
					// variable contenant les feuilles dÃ©clarÃ©es 
					// $feuilles_declarees;	
						
/*					echo "
						<table>
							<tr>
								<td width='600'>".$feuilles_declarees['titre_tab']['feuille']."</td>";
						$itmp = 1;
						foreach($feuilles_declarees['titre_tab']['modalite'] as $mod) {
						echo "
								<td width='200'>".$mod['titre']."<br /><b>".$mod['acteur']."</b></td>";
						$itmp++;
						}
						
						echo "
							</tr>";
						
						if(count($feuilles_declarees['groupes_de_feuilles']) > 0) {
							foreach($feuilles_declarees['groupes_de_feuilles'] as $grp => $sous_groupes) {
								echo "
									<tr>	
										<td colspan='".$itmp."'><b>". $grp."</b></td>
									</tr>";
							
								foreach($sous_groupes as $titre_sous_groupe => $feuilles_et_modalites) {
									if(strlen($titre_sous_groupe) > 0) {
										echo "
										<tr>	
											<td colspan='".$itmp."'><b>".$titre_sous_groupe."</b></td>
										</tr>";
										$var_space = "&nbsp;&nbsp;&nbsp;&nbsp;";
									} else {
										$var_space ="";
									
										echo "
										<tr>	
											<td colspan='".$itmp."'><b>Un sous groupe mais sans titre</b></td>
										</tr>";
									}
									
									foreach($feuilles_et_modalites as $une_feuille_et_modalites) {
										//echo "<h2>Une feuille et ses modalitÃ©s</h2>";							
										//var_dump($une_feuille_et_modalites);
										echo "
										<tr>
											<td width='400'> ".$var_space." <img src=\"".$URL_THEME."images/indent.png\" alt=\"\" />".$une_feuille_et_modalites['titre']."</td>";
											
											foreach($une_feuille_et_modalites['modalites'] as $modalite_tmp) {
												if(is_string($modalite_tmp)) {
													echo "
													<td><b>".$modalite_tmp."</b></td>";
												} else {
													foreach($modalite_tmp as $val) {
														echo "
														<td><b>".$val."</b></td>";
													}
												}									
											}
										
										echo "
										</tr>";
									}
								}
							}
						}
						
					echo "
						</table>";*/
					//##############################################################################################
					//echo "<pre>";
					//var_dump($feuilles_declarees);
					//echo "</pre>";
					//$pdf->AddPage();
					$pdf->tableauSuivi($feuilles_declarees);
					//$tableau = new tableau($pdf, $feuilles_declarees);
					//$tableau->dump();
				}											
			}	
			
			//echo "<br /><br />-------- Modalit&eacute;s ---------<br />";
			if($tableau_modalites_suivi_libre = $declaration->afficher_tableau_modalites_suivi_libre_pdf($config_lea, $declaration->id_periode)) {
				//$pdf->AddPage();
				$pdf->tableauLibre($tableau_modalites_suivi_libre);
				// variable contenant le tableau_modalites_suivi_libres 
				// $tableau_modalites_suivi_libre;
				//echo "<pre>";
				//var_dump($tableau_modalites_suivi_libre);
				//echo "</pre>";
			}	

			//echo "<br /><br />-------- Fichiers joints ---------<br />";
			if($fichiers_joints = $declaration->afficher_fichiers_joints_pdf()) {
				$detail_declaration = 1;
				// variable contenant les fichiers joints
				// $fichiers_joints
				//echo "<pre>";
				//var_dump($fichiers_joints);
				//echo "</pre>";
			}

			//echo "<br /><br />-------- Signatures ---------<br />";
			if($signatures = $declaration->afficher_signatures_pdf()) {
				//$pdf->AddPage();
				$pdf->tableauSignature($signatures);
				// variable contenant les signatures
				// $signatures
				//echo "<pre>";
				//var_dump($signatures);
				//echo "</pre>";
			}
			
			//echo "</div>";
			
		} else {
			/*echo "<div  style=\"background-color: #EEEEEE;\">";
			echo "<div  style=\"background-color: #000FFF;\">";
			
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " la d&eacute;claration n'existe pas pour la p&eacute;riode id = ".$une_periode_id."<br />";
			echo " Date de la d&eacute;claration : <i>Pas encore d&eacute;clar&eacute;e</i><br />";
			echo " ".$une_periode_type_suivi."<br />";					
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			
			echo "</div>";*/
			
			$declaration = new Declaration(0);
			$declaration->set_detail();
			
			$declaration->id_periode = $une_periode_id;
			$declaration->id_app = $apprenti->id_app;
			$declaration->type_suivi = $une_periode_type_suivi;
			
			$config_lea = $apprenti->get_config_lea();
			$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
			
			$declaration_vierge = new declaration_vierge($declaration);	
			
		
			
			//echo "<br /><br />-------- Suivi guid&eacute; ---------<br />";
			//A décommenter quand la fonction fonctionnera
			//svM($declaration_vierge->tableau_modalites_suivi_libre($config_lea));
			//$pdf->tableauLibre($declaration_vierge->tableau_modalites_suivi_libre($config_lea));
			foreach($les_arbres as $arbre) {
				//svM($declaration_vierge->tableau_modalites_suivi_guide($arbre, $une_periode_id));
				$pdf->tableauSuiviVierge($declaration_vierge->tableau_modalites_suivi_guide($arbre, $une_periode_id));
				$pdf->AddPage();
			}
			
			//echo "<br /><br />-------- Suivi libre ---------<br />";
			//svM($declaration_vierge->tableau_modalites_suivi_libre($config_lea));
			$pdf->tableauLibre($declaration_vierge->tableau_modalites_suivi_libre($config_lea));
			
			//echo "<br /><br />-------- Signatures de cette déclaration ---------<br />";			
			//svM($declaration->afficher_signatures_pdf());
			$pdf->tableauSignatureVierge($declaration->afficher_signatures_pdf());
			//echo "</div>";
		}
		$pdf->AddPage();
	}
}

$pdf->Output();

?>