<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 06/09/05
// Contenu:  Ce script permet la mise à jours de la liste des enseignants de la formation
// 			dont l'identifiant est enregistrée dans la session.

/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("config/config.inc.php"))      require_once("config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/

include("../test_responsable.php");

$bdd = new Connexion_BDD_LEA();

$les_administrateurs = $bdd->get_usagers(0,10000, "admin"); // les administrateurs lEA
$id_usager_admin = $les_administrateurs[0]->id_usager;

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if ( isset($_REQUEST['lettre']) ) $mot_cle = $_REQUEST['lettre'];
elseif (isset($_REQUEST['mot_cle']) )  $mot_cle = $_REQUEST['mot_cle'];
else $mot_cle='A';

$tous_les_enseignants = $bdd->get_usagers(0,10000, 'ens', $mot_cle); // tous les enseignants
$nb = $bdd->get_nb_usagers("ens"); // le nombre total d'enseignants

$les_id_enseignants = $formation->get_id_enseignants($mot_cle);  // les identifiant des enseignants de la formation
?>
<div id="top_l"></div>
<div id="top_m">
<h1><span class="orange">L</span>es <?php echo $config_lea->appelation_ens ?>s de votre <?php echo $config_term->terminologie_formation; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu"><?php Afficher_recherche("options.php", $mot_cle, array("cmd" =>"modifier_liste_enseignants")); ?>

<?php
echo"Si vous constatez qu'un $config_lea->appelation_ens ne figure pas dans liste,";
afficher_boutton_ecrire_msg("&nbsp;contactez l'administrateur <acronym title=\"Livret &Eacute;lectronique d'Apprentissage\">LEA</acronym>", $id_usager_admin);
echo"<br> ";
echo("<p>". count($tous_les_enseignants)." / $nb  ".$config_lea->appelation_ens."s trouv&eacute;s </p>");

if (count($tous_les_enseignants) > 0) {

	echo"<form action=\"modifier_liste_enseignants_v.php\" method=\"post\">";

	echo"<table>
			<tr>
				<th>Nom / Pr&eacute;nom</th>
				<th>T&eacute;l&eacute;phone</th>
				<th>Cochez les ".$config_lea->appelation_ens."s de votre ".$config_term->terminologie_formation."</th>
			</tr>";
	foreach($tous_les_enseignants as $enseignant){
		if( in_array ($enseignant->id_ens, $les_id_enseignants) ) {
			$checked="checked";
			$selected='selected';
		}
		else{
			$checked = "";
			$selected='';

		}
		echo"
			<tr class=\"$selected\">
				<td class=\"nom\">$enseignant->nom &nbsp;$enseignant->prenom</td>        	
				<td>$enseignant->tel_fixe</td>
				<td><input type=\"checkbox\" name=\"les_id_ens[]\" value=\"$enseignant->id_ens\" $checked /></td>						
			</tr>";
	}//fin foreach
	echo"
			</table>
			<fieldset><input type='submit' value='Valider'></fieldset>";
	echo"</form>";
}
?></div>
