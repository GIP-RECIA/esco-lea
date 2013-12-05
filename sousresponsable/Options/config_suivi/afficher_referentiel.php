<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant l'affichage d'un arbre d'identifiant $id_arbre passé en paramètre
/***********************************************************/
include_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/


include("../../test_responsable.php");

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

<html>
<head>
<link rel="stylesheet" href="../../../styles/enseignant.css" type="text/css">
<title>Référentiel métier </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="../../../javascript/stdlib.js">

</script>	
</head>
<body>
<?php require("../../header.php"); ?>
			<div id="top_l"></div><div id="top_m"><h1><span class="orange">A</span>ccueil</h1></div><div id="top_r"></div>
			<div id="m_contenu">
<table width="100%" height="128" border="0">
 		 <tr>
 		   <td width="328" height="14">		  
		    <span class="titre_page">
				<?php
			if ($arbre->type == "ref_entr") {
			    echo"<img src='".$LEA_URL."images/entreprise_dec.png'>";
				
			}
			elseif($arbre->type == "ref_cfa") {
			echo"<img src='".$LEA_URL."images/cfa_dec.png'>";			
			}
			
			echo"$arbre->nom"; 
			?>
		   
			</span>
		  </td>
           <td width="114"><?php afficher_boutton_imprimer();?>
           </td>
           <td width="346">&nbsp;           </td>
	 </tr>
 		 <tr>
 		   <td height="15" colspan="3"><?php include("menu_maj_referentiel.php")?>
 		   </td>
 		 </tr>
 		 <tr>
 		   <td height="31" colspan="2">
		   <?php 
		   
		   $arbre->afficher(0);
		   
		   ?>
		   </td>
           <td height="31">&nbsp;</td>
  </tr>
        <tr>
          <td height="44" colspan="3" align="center"><hr class="trait"></td>
  </tr>
</table>
</div>

</body>
</html>

	