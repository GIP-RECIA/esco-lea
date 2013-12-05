<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06
 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/classe_gestion_declaration.php");
session_name("LEA_$RNE_ETAB");
session_start();
/**********************************************************/

if(isset($_REQUEST['id_arbre'])) $id_arbre = $_REQUEST['id_arbre'];
else exit();

if(isset($_REQUEST['les_id_noeud'])) { 
				$_SESSION['les_feuilles_declarees'][$id_arbre] = $_REQUEST['les_id_noeud'];
				
}				
else {
		
		html_refresh($LEA_URL."Apprenti/Livret/dec_feuilles.php?id_arbre=$id_arbre");
		exit();
}		

$arbre = new Arbre($id_arbre);
$arbre->set_detail();

$gest_dec = new Gestion_declaration();

$les_modalites = $_SESSION['les_modalites_suivi_guide'][$id_arbre];

?>
 <html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo($URL_THEME.'apprenti.css');?>" media="screen" />
<title> Nouvelle d&eacute;claration </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
</head>
<body>

	<div id="header">
		<?php require($LEA_REP.'header.php'); ?>
	</div>
	<div id="contenu">
	
<h1>
<?php
			if ($arbre->type == "entr") {
			    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				echo"$arbre->nom";
			}
			elseif($arbre->type == "cfa") {
			echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			echo"$arbre->nom ";
			}
?>
</h1>
<p> <?php afficher_boutton_fermer(); ?> </p>

<?php 
	
		$gest_dec->les_zones_modalite_suivi_guide($arbre, $les_modalites);
?>

</div>


</body>

</html>