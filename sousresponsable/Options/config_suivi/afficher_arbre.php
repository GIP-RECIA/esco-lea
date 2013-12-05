<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant l'affichage d'un arbre d'identifiant $id_arbre passï¿½ en paramï¿½tre
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
include($LEA_REP."sousresponsable/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['id_arbre'])) { 
			$id_arbre = $_REQUEST['id_arbre']; 			
}			
else exit(); 

$arbre = new Arbre($id_arbre);
$arbre->set_detail();

if($arbre->id_config != $config_lea->id_config) exit(); 
?>		
<script language="JavaScript" src="../../../javascript/stdlib.js"></script>	
<?php 
	include("menu_maj_arbre.php");
	afficher_menu_maj_arbre('afficher');
?>
<div id="top_l"></div>
<div id="top_m">
	<h1>
		<?php
			if ($arbre->type == "entr") {
				echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
			} elseif($arbre->type == "cfa") {
				echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			}
			echo"<span class='orange'>C</span>ontenu : $arbre->nom ";
		?>
	</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<div id="m_contenuArbre">
		<table width="75%" border="0">
  			<tr>
    			<th><?php echo"Contenu de $arbre->nom"; ?></th>
  			</tr>
  			<tr>
    			<td><?php $arbre->afficher(0); ?></td>
  			</tr>
		</table>
  	</div>
</div>

	