<?php
/***********************************************************/
// Copyright ï¿½ 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 03/04/06
// Contenu: Cette page contient le formulaire de declaration
// correspondant aux travaux effectues en entreprise ou au CFA
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

include_once($LEA_REP."Maitre_apprentissage/secure.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/classe_gestion_declaration.php");

/**********************************************************/

if(isset($_SESSION['declaration'])) {
	$declaration = $_SESSION['declaration'] ;
}
else { afficher_msg_erreur("Aucune d&eacute;claration ne peut &ecirc;tre eff&eacute;ctu&eacute;e"); exit(); }

if(isset($declaration->id_periode)) {
	$id_periode_select = $declaration->id_periode;
} else {
	$id_periode_select = 0;
}

$apprenti =  new Apprenti($declaration->id_app);
$apprenti->set_detail();

$classe = $apprenti->get_classe();

$config_lea = $apprenti->get_config_lea();

$les_arbres = $config_lea->get_arbres($declaration->type_suivi);

$periode = new Periode($declaration->id_periode);
$periode->set_detail();

$gest_dec = new Gestion_declaration($declaration); // classe de gestion d'une dï¿½claration

?>
<div id="top_l"></div>
<div id="top_m"><?php 

if($declaration->type_suivi =='entr' )
$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png" >';
elseif($declaration->type_suivi == 'cfa')
$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png" >';
echo"<h1> $img <span class=\"orange\">M</span>odifier une d&eacute;claration</h1>";

?></div>
<div id="top_r"></div>

<script language="JavaScript" src="../../javascript/stdlib.js">

</script>

<br>
<br>
<br>
<br>
<?php echo"$config_lea->appelation_app : <b> $apprenti->nom $apprenti->prenom </b><br>
 			P&eacute;riode  : <b> $periode->libelle </b>"; 
if(! $periode->se_declare_par($classe->id_cla, $declaration->type_suivi, $config_lea ) ) {

	afficher_msg_erreur("Vous n'&ecirc;tes pas autoris&eacute; &agrave; faire une d&eacute;claration sur cette p&eacute;riode ");

	$tab_dates = $periode->get_calendrier($classe->id_cla);
	if(count($tab_dates) > 0 ) {
		$date_debut = $tab_dates['date_debut_'.$declaration->type_suivi] ;
		$date_fin = $tab_dates['date_fin_'.$declaration->type_suivi] ;
		echo("<br>Cette p&eacute;riode se d&eacute;clare entre le <b>". trans_date($date_debut)."</b> et le <b>". trans_date($date_fin)."</b>");
	}
	exit;
}
?>

<form name="theForm" action="nouv_dec_app_v.php" method="post"
	enctype="multipart/form-data">
<table width="572" height="126">
	<tr>
		<td width="100%" height="20"><?php
		if(count($les_arbres) > 0 ) {
			foreach($les_arbres as $arbre){
				$les_modalites = $_SESSION['les_modalites_suivi_guide'][$arbre->id_arbre];

				if(count($les_modalites) > 0 ) {
					$gest_dec->tableau_modalites_suivi_guide($arbre, $les_modalites );
				}
			}//foreach
		}
			
		?></td>
	</tr>
	<tr>
		<td><br>
		<?php

		$les_modalites_suivi_libre = $_SESSION['les_modalites_suivi_libre'];
		$gest_dec->tableau_modalites_suivi_libre($config_lea, $les_modalites_suivi_libre);
		?></td>
	</tr>
	<tr>
		<td height="19" class="center"><?php
		if (($declaration->type_suivi == 'entr' && $config_lea->app_joint_fichiers_suivi_entr) ||
		($declaration->type_suivi == 'cfa' && $config_lea->app_joint_fichiers_suivi_cfa))	{
			$gest_dec->tableau_fichier_joint();
		}
		?></td>
	</tr>
	<tr>
		<td height="35" class="center"><br>
		<input type="submit" name="valider"
			value="Valider la d&eacute;claration"></td>
	</tr>
</table>

</form>

