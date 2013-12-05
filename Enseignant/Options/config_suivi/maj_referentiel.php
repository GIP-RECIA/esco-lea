<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la mise  à jour d'un arbre
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

$arbre->nb_niveaux = $arbre->get_nb_niveaux(); 

// si cet arbre n'a pas de niveaux

if($arbre->nb_niveaux < 1 )html_refresh($LEA_URL."erreur.php"); 

if(isset($_REQUEST['id_noeud'])) $id_noeud = $_REQUEST['id_noeud']; 
else $id_noeud = 0;

// Ce noeud permet l'affichage de la branche de l'arbre qui conduit à ses fils.

$noeud = new Noeud($id_noeud, $id_arbre); 
$noeud->id_arbre = $id_arbre;
$noeud->set_detail();

$les_id_noeuds_ascendants = $noeud->get_id_noeuds_ascendants(); // les identifiant des noeuds ascendant de noeud actif

if( $id_noeud > 0 ) 	$les_id_noeuds_ascendants[] = $id_noeud;
		
$noeud->niveau = count($les_id_noeuds_ascendants)-1; // le niveau du noeud actif

$arbre->noeud_actif = $noeud;
$arbre->set_libelles_niveaux(); // recupérer tous les noms des niveaux de l'arbre

?>		

<html>
<head>
<link rel="stylesheet" href="../../../styles/enseignant.css" type="text/css">
<title>Référentiel métier </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="../../../javascript/stdlib.js">

</script>	
</head>
<body onLoad="document.theForm.libelle.focus()">

<?php require("../../header.php"); ?>
			<div id="top_l"></div><div id="top_m"><h1></h1></div><div id="top_r"></div>
			<div id="m_contenu">

<table width="100%" height="198" border="0">
 		 <tr>
 		   <td height="26" colspan="5">
		      <span class="titre_page">		   		
			  
           <?php
			if ($arbre->type == "ref_entr") {
			    echo"<img src='".$LEA_URL."images/entreprise_dec.png'>";
				echo"Mettre à jour le  $arbre->nom";
			}
			elseif($arbre->type == "ref_cfa") {
			echo"<img src='".$LEA_URL."images/cfa_dec.png'>";
			echo"Mettre à jour le  $arbre->nom ";
			}
			?>
	</span>
		 </td>
           <td width="23%" height="26"><?php afficher_boutton_fermer(); ?>
           </td>
	 </tr>
         <tr >
           <td height="34" colspan="6"><?php include("menu_maj_referentiel.php")?>		   </tr>
         <tr>
           <td height="41" colspan="6" align="left">
		     <?php
		   $i=0;
		   echo" Vous êtes au niveau ";
		   foreach($arbre->libelles_niveaux as $libelle){
			   $i++;	
			   echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";  
			   echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			  
			   if($noeud->niveau == $i-1 )
			   		echo"
					<img src='".$LEA_URL."images/triangle.gif' border='0' >
					<b> $libelle </b>";
			   else echo"$libelle";
		   }
		   ?>
             <hr class="trait"></td>
         </tr>
        <tr>
		  <td height="27" colspan="6" align="left">

<p>Veuillez introduire le contenu de votre <?php echo"$arbre->nom" ?></p>
		  
<?php


if( count($arbre->tab_noeuds) > 0) {

	if($id_noeud==0) echo"<b> $arbre->nom </b>";
	else echo"<a href='?id_arbre=$id_arbre' > $arbre->nom </a>";
	
}	

// affichage d'une branche de l'arbre qui conduit au noeud $noeud_actif 
// pour de mettre à jour le contenu de l'arbre

$arbre->afficher_branche($les_id_noeuds_ascendants, 0, 'maj_contenu');

?>
          </td>
	    </tr>
</table>
</div>
</body>
</html>

	