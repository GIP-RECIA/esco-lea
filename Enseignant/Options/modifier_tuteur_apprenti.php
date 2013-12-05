<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Ce script permet la mise ï¿½ jours de liste des tuteurs des apprentis de la formation

/***********************************************************/
include_once("../secure.php");
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("config/config.inc.php"))      require_once("config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/

include("../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();
$les_enseignants = $formation->get_enseignants();

if ( isset($_REQUEST['lettre']) ) $mot_cle = $_REQUEST['lettre']; 
elseif (isset($_REQUEST['mot_cle']) )  $mot_cle = $_REQUEST['mot_cle'];
else $mot_cle='';
 		
	$les_apprentis = $formation->get_apprentis($mot_cle);
	$nb_apprentis= count($les_apprentis);					
	
 ?>
			<div id="top_l"></div><div id="top_m"><h1><span class="orange">L</span>es <?php echo"$config_lea->appelation_app" ?>s de votre <?php echo $config_term->terminologie_formation; ?></h1></div><div id="top_r"></div>
			<div id="m_contenu">

<?php Afficher_recherche("options.php", $mot_cle, array("cmd" =>"modifier_tuteur_apprenti")); ?>
<?php 
	if (count($les_apprentis) > 0) {
		echo"
			Liste des ".$config_lea->appelation_app."s ( $nb_apprentis )
			<table>
				
				<tr class=\"selected\">
					<th>Nom / Pr&eacute;nom</td>
					<th>$config_lea->appelation_classe</td>
					<th>$config_lea->appelation_tuteur_cfa</td>
				</tr>";
		foreach($les_apprentis as $apprenti){
		$classe = new Classe($apprenti->id_cla);
		$classe->set_detail();
		$ancre = 'a_'.$apprenti->id_app;
		
		echo "
			<tr id='$ancre'>
				<td>$apprenti->nom&nbsp;$apprenti->prenom</td>        	
				<td>$classe->libelle</td>				
				<td>
					<form action=\"modifier_tuteur_apprenti_v.php?ancre=".$ancre."\" method=\"post\">
						<select name=\"id_ens\">
							<option value=\"0\"></option>";
		foreach($les_enseignants as $enseignant){
			if($enseignant->id_ens == $apprenti->id_ens) $selected="selected";
			else $selected = "";
				echo"<option value=\"$enseignant->id_ens\" $selected> $enseignant->nom  $enseignant->prenom</option>";
		}				
		echo"</select>
			<input type=\"hidden\" name=\"id_app\" value=\"$apprenti->id_app\" />
			<input type=\"submit\" value=\"modifier\" />	
		</form>	
	</td>						
</tr>";
}//fin foreach
echo"</table>";	
}else echo"<p>Aucun ".$config_lea->appelation_app." n'est trouv&eacute;</p>";
?>
</div>