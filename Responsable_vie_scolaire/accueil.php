<?php 

require_once("../config/config.inc.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/classe_usager.php");
require_once ($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
session_name("LEA_$RNE_ETAB");
@session_start();

if (!isset($_SESSION['id_rvs'])){
	html_refresh($LEA_URL);
}

if(isset($_REQUEST['id_unite'])) { // le responsable a sï¿½lectionnï¿½ une unitï¿½ auquelle veut se connecter
	$_SESSION['id_unite'] = $_REQUEST['id_unite'];
	$unite = new Unite_pedagogique($_REQUEST['id_unite']);
	$unite->set_detail();
	$_SESSION['nom_unite'] = $unite->nom;
}		  

if (!isset($_SESSION['id_unite'])){
	html_refresh($LEA_URL);
}

$rvs = new usager($_SESSION['id_rvs']);
$unite = new Unite_pedagogique($_SESSION['id_unite']);
$unite->set_detail();


$img_accueil = $rvs->get_valeur_attribut("img_accueil"); // l'image de la page d'accueil de l'apprenti
$rep_img = $LEA_REP."images/img_accueil/";

if ($img_accueil=="" || !file_exists ($rep_img.$img_accueil) ) {
	$url_img = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'images/default_imageDefault.png';	
}else {
	$url_img = $LEA_URL.'images/img_accueil/'.$img_accueil;	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Mresponsable_vie_scolaire.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Accueil</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "Meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'responsableVieScolaire.css');?>"/>
<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?><!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js');?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
	<body>
	<div id="box2" style="display:none"></div>	
	<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
			<?php include($LEA_REP.'menu_responsable_vie_scolaire.php'); ?>
			<div id="contenu">
				<div id="top_l"></div>
				<div id="top_m">
					<h1><span class="orange">A</span>ccueil</h1>
				</div>
				<div id="top_r"></div>
    			<div id="contents">		
<!-- InstanceBeginEditable name="sous_menu" -->        


					<div id="texte">
						<p><strong>Administration des formations</strong></p>			
						<p>
							<?php include("../administrateur/contact/msg_non_lu.php"); ?>
						</p>
        	  			<img src="<?php echo($url_img)?>" alt="Image LEA par d&eacute;faut" width="600" />
						<p>
					    	<?php echo("<img src=\"../images/b_edit.png\" border=0 /><a href=\"#\" onClick=\"window.open('../modif_img_accueil_usager.php','','width=600, height=200, resizeble=yes' )\">Modifier l'image d'accueil</a>" );?>
      					</p>
					</div>
<!-- InstanceEndEditable -->
				</div>
				<div id="bottom_box"> </div>   
			</div>
			<?php include($LEA_REP."footer.php")?>
		</div>
	</body>
<!-- InstanceEnd -->
</html>
