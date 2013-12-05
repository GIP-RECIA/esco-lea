<?php 

require_once("../config/config.inc.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/classe_usager.php");
session_name("LEA_$RNE_ETAB");
session_start();

if (!isset($_SESSION['id_app'])){
	html_refresh($LEA_URL);
}

$apprenti = new Apprenti($_SESSION['id_app']);

$img_accueil = $apprenti->get_valeur_attribut("img_accueil"); // l'image de la page d'accueil de l'apprenti
$rep_img = $LEA_REP."images/img_accueil/";

$formation = new Formation($apprenti->get_id_for());
$formation->set_detail(); // la formation de l'apprenti

$_SESSION['nom_formation'] = $formation->nom;
$_SESSION['id_for'] =  $formation->id_for;

$charte = $formation->get_charte_graphique(); // charte graphique de la formation de l'apprenti

if ($img_accueil=="" || !file_exists ($rep_img.$img_accueil) ) {

	$url_img = $LEA_URL.'images/charte_graphique/';
	$img_accueil = $charte->img_accueil;
}	
else {
	$url_img = $LEA_URL.'images/img_accueil/';	
}  
								
if($charte->theme !="") 	$_SESSION['options_lea']['LEA_THEME'] = $charte->theme;
if($charte->bandeau !="") 	$_SESSION['options_lea']['LEA_BACKGROUND_HEAD'] = $charte->bandeau;
if($charte->logo_cfa !="")	$_SESSION['options_lea']['LEA_LOGO_CFA'] = $charte->logo_cfa;									

$_SESSION['options_lea']['LEA_LOGO_FORMATION'] = $charte->logo;
$_SESSION['options_lea']['LEA_IMAGE_ACCUEIL'] = $img_accueil;

$apprenti->set_detail();
$config_lea = $apprenti->get_config_lea();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Mapprenti.dwt" codeOutsideHTMLIsLocked="false" -->
			<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script><head>		
		<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Accueil</title>
		<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "Meta" -->
<meta name="special" content="" />

<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen"
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'apprenti.css');?>"/>
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
				<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
	</head>
<body>
	
	<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
		<?php include($LEA_REP.'menu_apprenti.php'); ?>
		<div id="contenu">				
    		<div id="contents">			 
		
    	<!-- InstanceBeginEditable name="sous_menu" -->   
      <p>
        <?php include("../administrateur/contact/msg_non_lu.php"); ?>
	  <p>
	  <p>
        <img src="<?php echo ($url_img.urlencode($_SESSION['options_lea']['LEA_IMAGE_ACCUEIL']) )?>" width="520" />
	  </p>
	  <p>
       <?php 
		 echo("<a href=\"#\" onClick=\"window.open('../modif_img_accueil_usager.php','','width=600, height=200, resizeble=yes' )\"> 
		 		<img src=\"../images/b_edit.png\" border=0 /> Modifier l'image d'accueil 
				</a>" );
	   ?>
      </p>
   	  <!-- InstanceEndEditable --> 
			</div>
		  <div id="bottom_box"> </div>   
		</div>			

		<?php include($LEA_REP."footer.php")?>
		
	</div>

</body>
<!-- InstanceEnd --></html>
