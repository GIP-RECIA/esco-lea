<?php  
require_once("../config/config.inc.php");

require($LEA_REP.'modele/bdd/classe_usager.php');
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
session_name("LEA_$RNE_ETAB");
session_start();
$config_term = new Terminologie();
$config_term->set_detail();

if (!isset($_SESSION['id_ma'])){
	header('Location: '.$LEA_URL);
	exit();
}

$maitre = new Maitre_apprentissage($_SESSION['id_ma']);

if(isset($_REQUEST['id_for'])) {		
				$id_for = $_REQUEST['id_for'];				
}				
elseif(isset($_SESSION['id_for']))
				$id_for = $_SESSION['id_for'];
else {
	
	exit();
}						  	 		  		  

$formation = new Formation($id_for);
$formation->set_detail();

if(! $maitre->suivi_app_for($id_for)) {	
	html_refresh("selection_formation.php");
	exit();
}	
							  
$_SESSION['id_for'] = $id_for;

$charte = $formation->get_charte_graphique();		  		
																					
if($charte->theme !="") 	$_SESSION['options_lea']['LEA_THEME'] = $charte->theme;
if($charte->bandeau !="") 	$_SESSION['options_lea']['LEA_BACKGROUND_HEAD'] = $charte->bandeau;
if($charte->logo_cfa !="")	$_SESSION['options_lea']['LEA_LOGO_CFA'] = $charte->logo_cfa;									

$_SESSION['options_lea']['LEA_LOGO_FORMATION'] = $charte->logo;
$_SESSION['options_lea']['LEA_IMAGE_ACCUEIL']  =  $charte->img_accueil;
		  

$img_accueil = $maitre->get_valeur_attribut("img_accueil"); // l'image de la page d'accueil du maitre d'aprentissage
$rep_img = $LEA_REP."images/img_accueil/";

if ($img_accueil=="" || !file_exists ($rep_img.$img_accueil) ) {

	$url_img = $LEA_URL.'images/charte_graphique/';		
}	
else {
	$url_img = $LEA_URL.'images/img_accueil/';
	$_SESSION['options_lea']['LEA_IMAGE_ACCUEIL'] = $img_accueil;	
}  
//
$les_apprentis = $maitre->get_apprentis_form($_SESSION['id_for']);
if(isset($_REQUEST['id_app_select'])) { 
	
	$id_app_select = $_REQUEST['id_app_select'];
}
elseif(count($les_apprentis) > 0 ) $id_app_select = $les_apprentis[0]->id_app;
else $id_app_select = 0;



if($id_app_select > 0) {

	$apprenti_select = new Apprenti($id_app_select);	
	$apprenti_select->set_detail();
	$classe = $apprenti_select->get_classe();		
    $config_lea = $apprenti_select->get_config_lea();
}
//

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Mmaitre_apprentissage.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
		<!-- InstanceBeginEditable name="doctitle" -->
		
<!-- <title>LEA <?php echo($config_lea->appelation_ma);?></title> -->
<title>LEA: Accueil</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "Meta" -->
<meta name="special" content="" />
<!-- #EndEditable -->
			
		<link rel="stylesheet" type="text/css" media="screen"
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'maitreApprentissage.css');?>" />
<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?>
		<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
				<script type="text/javascript" 
				src="<?php echo($LEA_URL.'javascript/menu.js');?>">
				</script><script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
			<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
<body>
	<div id="box2" style="display:none"></div>
	<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
		
	<?php include($LEA_REP.'menu_maitre_apprentissage.php'); ?>	
		<div id="contenu">
    		<div id="contents">
    		  <!-- InstanceBeginEditable name="Contenu" -->
	<?php 		
				  
		include("../administrateur/contact/msg_non_lu.php"); 
	?> 
	<p>
	 Bienvenue sur <?php echo $config_term->terminologie_lea; ?>  en <?php echo $config_term->terminologie_formation; ?> <?php echo(to_html($formation->nom)) ?>
	</p>	
	<img src="<?php echo ($url_img.urlencode($_SESSION['options_lea']['LEA_IMAGE_ACCUEIL']) )?>" width="520" />
	<br>

       <?php 
	   /*
		 echo("<a href=\"#\" onClick=\"window.open('../modif_img_accueil_usager.php','','width=600, height=200, resizeble=yes' )\"> 
		 		<img src=\"../images/b_edit.png\" border=0 /> Modifier l'image d'accueil 
				</a>" );
		*/		
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
