<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 03/04/06
// Contenu: Cette page contient le formulaire de déclaration 
// 		  des travaux effectués en entreprise ou au CFA 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/classe_gestion_declaration.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
require_once ("../secure.php");
/**********************************************************/

$config_term = new Terminologie();
$config_term->set_detail();

$apprenti = new Apprenti($_SESSION['id_app']);
$apprenti->set_detail();

$classe = $apprenti->get_classe(); // la classe de l'apprenti.

if($classe->id_cla == 0) {
	afficher_msg_erreur("Vous ne suivez aucune $config_lea->appelation_classe");
	exit();
}

$formation = new Formation($classe->id_for);  // la formation de l'apprenti

$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['type_suivi']) && ( $_REQUEST['type_suivi']=="entr" || $_REQUEST['type_suivi']=="cfa" ) ) {
	// Nouvelle déclaration commencée

	$declaration = new Declaration(0);
	$declaration->id_app = $_SESSION['id_app'];
	$declaration->etat = "nv";
	$declaration->type_suivi = $_REQUEST['type_suivi'];

	$_SESSION['declaration'] = $declaration;
} elseif(isset($_SESSION['declaration'])) {
	if(isset($_REQUEST['id_periode'])){
		$_SESSION['declaration']->id_periode = $_REQUEST['id_periode'] ;
	}
	$declaration = $_SESSION['declaration'] ;
	// si $declaration->id_dec = 0 // nouvelle déclaration 
	// si $declaration->id_dec > 0 // Déclaration déja faite à modifier			
}else { afficher_msg_erreur("Aucune d&eacute;claration ne peut &ecirc;tre eff&eacute;ctu&eacute;e"); exit(); }

if(isset($declaration->id_periode))	$id_periode_select = $declaration->id_periode;
else $id_periode_select = 0;

$les_periodes = $apprenti->get_periodes_non_declarees($declaration->type_suivi, $classe->id_cla);

$les_arbres = $config_lea->get_arbres($declaration->type_suivi);

$periode = new Periode($declaration->id_periode);
$periode->set_detail();

$gest_dec = new Gestion_declaration($declaration); // classe de gestion d'une déclaration

if( $declaration->type_suivi =='entr' ) afficher_sous_menu("nouv_dec_entr");
else  afficher_sous_menu("nouv_dec_cfa");
?>
<div id="top_l"></div>
<div id="top_m"><?php 	
if($declaration->type_suivi =='entr' ) {
	$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png" >';
	echo"<h1> $img <span class=\"orange\">D</span>&eacute;claration ".$config_lea->appelation_entr."</h1>";
}elseif($declaration->type_suivi == 'cfa') {
	$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png" >';
	echo"<h1> $img <span class=\"orange\">D</span>&eacute;claration ".$config_term->terminologie_cfa."</h1>";
}
?></div>
<div id="top_r"></div>
<div id="m_contenu"><br>
<?php
if($declaration->id_dec == 0 ) { // nouvelle déclaration
	echo('<p>Les d&eacute;clarations non effectu&eacute;es : </p>');

	echo'<form action="?" method="get" >
				<input type="hidden" name="cmd" value="nouv_dec">';

	if(count($les_periodes) > 0 ) {
		echo'<select name="id_periode"  onChange="this.form.submit()">';
		echo"<option value=\"0\">------  Votre d&eacute;claration ------ </option>";
			
		foreach($les_periodes as $per )  {
			if($per ->id_periode == $id_periode_select) $selected = "selected";
			else $selected = "";

			echo"<option value='$per->id_periode' $selected> ";
			echo"$per->libelle";
			echo" </option>";
		}
		echo"</select></form>";
	}else{  afficher_msg_erreur ("Aucune p&eacute;riode ne peut &ecirc;tre d&eacute;clar&eacute;e"); }

} else  echo"P&eacute;riode  : <b> $periode->libelle </b>";

if($id_periode_select > 0 ) {

	if(! $config_lea->declaration_acteur($declaration->type_suivi, 'app', $declaration->id_periode)) {
		afficher_msg_erreur("Vous  n'&ecirc;tes pas autoris&eacute; &agrave; faire une d&eacute;claration sur cette p&eacute;riode");
		exit();
	}
	if(! $periode->se_declare_par($classe->id_cla, $declaration->type_suivi, $config_lea ) ) {
		afficher_msg_erreur("Vous n'&ecirc;tes pas autoris&eacute; &agrave; faire une d&eacute;claration sur cette p&eacute;riode ");
		$tabe_dates = $periode->get_calendrier($classe->id_cla);
		if(count($tabe_dates) > 0 ) {
			if($declaration->type_suivi =='entr') {
				$date_debut = $tabe_dates['date_debut_entr'] ;
				$date_fin = $tabe_dates['date_fin_entr'] ;
			}else {
				$date_debut = $tabe_dates['date_debut_cfa'] ;
				$date_fin = $tabe_dates['date_fin_cfa'] ;
			}
			echo("<br><br> Cette p&eacute;riode se d&eacute;clare entre le <b>". trans_date($date_debut)."</b> et le <b>". trans_date($date_fin)."</b>");
		}
		exit();
	}

	?> <script language="JavaScript" src="../../../javascript/stdlib.js"></script>
<form name="theForm" action="nouv_dec_v.php" method="post"
	enctype="multipart/form-data">
<table width="572" height="128">
	<tr>
		<td width="100%" height="20"><?php
		if(count($les_arbres) > 0 ) {
			foreach($les_arbres as $arbre){
				
				// Modalites qui doivent etre renseignees
				$les_modalites_suivi_guide = $arbre->get_modalites_unique('app', $id_periode_select);
				$les_modalites_suivi_guide = array_merge($les_modalites_suivi_guide, $arbre->get_modalites_multiple('app', $id_periode_select));
				
				if($apprenti->modif_dec_ma)	{	// si l'apprenti est autorisé a valider les modalités de son maitre d'apprentissage
					$les_modalites_suivi_guide = array_merge($les_modalites_suivi_guide, $arbre->get_modalites_unique('ma', $id_periode_select));
					$les_modalites_suivi_guide = array_merge($les_modalites_suivi_guide, $arbre->get_modalites_multiple('ma', $id_periode_select));
				}
				$gest_dec->tableau_modalites_suivi_guide($arbre, $les_modalites_suivi_guide);
			}//foreach
		}
		?></td>
	</tr>
	<tr>
		<td><br>
		<?php
		$les_modalites_suivi_libre = $config_lea->get_modalites_reponse_libre($declaration->type_suivi, 'app', $id_periode_select);
		$les_modalites_suivi_libre = array_merge($les_modalites_suivi_libre, $config_lea->get_modalites_reponse_choix($declaration->type_suivi, 'app', $id_periode_select));
		if($apprenti->modif_dec_ma)
		// si l'apprenti est autorisé a valider les modalités de son maitre d'apprentissage
		{
			$les_modalites_suivi_libre = array_merge($les_modalites_suivi_libre, $config_lea->get_modalites_reponse_libre($declaration->type_suivi, 'ma', $id_periode_select));
			$les_modalites_suivi_libre = array_merge($les_modalites_suivi_libre, $config_lea->get_modalites_reponse_choix($declaration->type_suivi, 'ma', $id_periode_select));
		}
		$gest_dec->tableau_modalites_suivi_libre($config_lea, $les_modalites_suivi_libre);
		?></td>
	</tr>
	<tr>
		<td height="19" class="center"><?php
		if(($declaration->type_suivi == 'entr' && $config_lea->app_joint_fichiers_suivi_entr) ||
			($declaration->type_suivi == 'cfa' && $config_lea->app_joint_fichiers_suivi_cfa)){
			$gest_dec->tableau_fichier_joint();
		}
		?></td>
	</tr>
	<tr>
		<td height="37" class="center"><br>
		<input type="submit" name="valider"	value="Valider la d&eacute;claration"></td>
	</tr>
</table>
<p>&nbsp;</p>
</form>
		<?php } ?></div>
