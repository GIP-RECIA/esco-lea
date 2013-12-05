<?php 
require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();
require_once ($LEA_REP."lib/stdlib.php");
require($LEA_REP.'modele/bdd/classe_usager.php');
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
include("./recup.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
if (!isset($_SESSION['id_admin'])){
	html_refresh($LEA_URL);
}

$usager = new Usager($_SESSION['id_admin']);
$img_accueil = $usager->get_valeur_attribut("img_accueil"); // l'image de la page d'accueil de l'apprenti
$rep_img = $LEA_REP."images/img_accueil/";

if ($img_accueil=="" || !file_exists ($rep_img.$img_accueil) ) {

	$url_img = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'images/default_imageDefault.png';	
}	
else {
	$url_img = $LEA_URL.'images/img_accueil/'.$img_accueil;	
}  

$bdd = new Connexion_BDD_LEA();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Madministrateur.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>				
		<!-- InstanceBeginEditable name="doctitle" -->
		<!-- <title>LEA Administrateur</title> -->
		<title>LEA: Import/Export paramétrage</title>
		<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />		
		<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen"
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"  />
		
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
			<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
	
<body>

	<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
		<?php include($LEA_REP.'menu_administrateur.php'); ?>
		<div id="contenu">
										
    		<div id="contents">
    		<!-- InstanceBeginEditable name="sous_menu" -->
			<div id="top_l"></div><div id="top_m"><h1><span class="orange">I</span>mporter un fichier xml de configuration</h1></div><div id="top_r"></div>
			<div id="m_contenu">
				<div id="texte">
            
      <strong> Ne mettre que des fichiers de configuration complet ( avec tous les acteurs sauf <?php echo $config_term->terminologie_rl." ou ".$config_term->terminologie_rvs ?> si vous les avez supprim&eacute et le bloc des institutions )</strong><br/><br/>
			
		      <form method="post" enctype="multipart/form-data" action="testxml2.php">
          <INPUT type=file name="nom_du_fichier">
          <INPUT type=submit value="Envoyer">
</form>
      		
				</div>
				
			</div>
<div id="top_m"><h1><span class="orange">E</span>xporter le fichier xml de configuration</h1></div><div id="top_r"></div>
			<div id="m_contenu">
				<div id="texte">
            
       			<a href="./getconf.php">Fichier de configuration du LEA</a>
			
		     
      		
				</div>
				
			</div>
			
			<!-- InstanceEndEditable -->
			</div>
					  <div id="bottom_box"> </div>   
		</div>	
				
			<?php include($LEA_REP."footer.php")?>					
		
	</div>
</body>
<!-- InstanceEnd --></html>