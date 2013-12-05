<?php  
require_once("../config/config.inc.php");

require($LEA_REP.'modele/bdd/classe_usager.php');
session_name("LEA_$RNE_ETAB");
session_start();
if (!isset($_SESSION['id_rl'])){
	header('Location: '.$LEA_URL);
	exit();
}

$parent = new Usager($_SESSION['id_rl']);

$img_accueil = $parent->get_valeur_attribut("img_accueil"); // l'image de la page d'accueil de l'apprenti
$rep_img = $LEA_REP."images/img_accueil/";

if ($img_accueil=="" || !file_exists ($rep_img.$img_accueil) ) {

	$url_img = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'images/default_imageDefault.png';	
}	
else {
	$url_img = $LEA_URL.'images/img_accueil/'.$img_accueil;	
}  


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Mrepresentant_legal.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
		<!-- InstanceBeginEditable name="doctitle" -->
		<!-- <title>LEA Repr&eacute;sentant l&eacute;gal</title> -->
		<title>LEA: Accueil</title>
		<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "Meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />
		<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen"
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'representantLegal.css');?>" />		
		<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?>
		<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
			<script type="text/javascript" 
				src="<?php echo($LEA_URL.'javascript/menu.js');?>">
			</script>		
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
<body>
	<div id="box2" style="display:none"></div>
	<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
	  <?php include($LEA_REP.'menu_representant_legal.php'); ?>		
		
		<div id="contenu">
    		<div id="contents">
    		<!-- InstanceBeginEditable name="Contenu" -->
            <p>Bienvenue sur le livret &eacute;lectronique d'apprentissage 
            </p>
            <p>
              <?php 	
				  
				include("../administrateur/contact/msg_non_lu.php"); 
				?>             
            </p>
		    <img src="<?php echo($url_img)?>" alt="Image LEA par dï¿½faut" width="600" />
				
			<p>
		       <?php 
			 echo("<a href=\"#\" onClick=\"window.open('../modif_img_accueil_usager.php','','width=600, height=200, resizeble=yes' )\"> 
		 		<img src=\"../images/b_edit.png\" border=0 /> Modifier l'image d'accueil 
				</a>" );
			   ?>
      		</p>

            <div id="texteUtilisateur"></div>
			<!-- InstanceEndEditable -->
			</div>
						  <div id="bottom_box"> </div>   
		</div>	
				
		<?php include($LEA_REP."footer.php")?>
		
		
	</div>
	
</body>
<!-- InstanceEnd --></html>
