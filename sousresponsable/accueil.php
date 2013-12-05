<?php
session_cache_expire(60);

require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if (!isset($_SESSION['id_sr'])){
	html_refresh($LEA_URL);
}

if(isset($_REQUEST['id_for']) || isset($_SESSION['id_sr'])) { 

	$enseignant = new Enseignant($_SESSION['id_sr']);
	if(!isset($_SESSION['id_for'])){
		$formation = new Formation($_REQUEST['id_for']);
		$_SESSION['id_for'] = $_REQUEST['id_for'];	
	} else{
		if(isset($_REQUEST['id_for'])) {
			$formation = new Formation($_REQUEST['id_for']);
			$_SESSION['id_for'] = $_REQUEST['id_for'];
		} else {
			$formation = new Formation($_SESSION['id_for']);
		}
	}
	
	$formation->set_detail(0); 
	$nom_formation = $formation->nom;
		  
	$_SESSION['nom_formation'] = $formation->nom;
	
	$est_enseignant_formation = $enseignant->est_sous_responsable($_SESSION['id_for'],$_SESSION['id_sr']); 
	if(!$est_enseignant_formation){															
		html_refresh("selection_formation.php?id_for=".$_SESSION['id_for']);				
		exit();
	}
	
	
	$charte = $formation->get_charte_graphique();		  		
																						
	if($charte->theme !="") 	$_SESSION['options_lea']['LEA_THEME'] = $charte->theme;
	if($charte->bandeau !="") 	$_SESSION['options_lea']['LEA_BACKGROUND_HEAD'] = $charte->bandeau;
	if($charte->logo_cfa !="")	$_SESSION['options_lea']['LEA_LOGO_CFA'] = $charte->logo_cfa;									
	
	$_SESSION['options_lea']['LEA_LOGO_FORMATION'] = $charte->logo;
	$_SESSION['options_lea']['LEA_IMAGE_ACCUEIL'] = $charte->img_accueil;
}		  

if (!isset($_SESSION['id_for'])){
	header('Location: selection_formation.php'); 
	exit(); 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<!-- InstanceBegin template="/Templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Accueil</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "Meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>"  />
<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?><!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
	</head>
	<body>			<div id="box2" style="display:none">
			<?php include($LEA_REP.'sousresponsable/sel_formation.php'); ?>
		</div>

		<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
			<?php 
				include($LEA_REP.'menu_sous_responsable.php');			 
			?>
			<div id="contenu">
    			<div id="contents">	
<!-- InstanceBeginEditable name="sous_menu" -->
					<div id="top_l"></div><div id="top_m"><h1><span class="orange">A</span>ccueil</h1></div><div id="top_r"></div>
					<div id="m_contenu">
					<div id="texte">              
		           		<strong>Bienvenue sur <?php echo $config_term->terminologie_lea; ?> en <?php echo $config_term->terminologie_formation; ?>&nbsp;<?php echo($_SESSION['nom_formation']); ?></strong><br/>      
						<?php include("../administrateur/contact/msg_non_lu.php"); ?>
		            	<img class="imgAccueil" src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($_SESSION['options_lea']['LEA_IMAGE_ACCUEIL']) )?>" />			
		       		</div></div>
<!-- InstanceEndEditable --> 
				</div>
				<div id="bottom_box"> </div>   
			</div>	
			<?php include($LEA_REP."footer.php")?>
		</div>
	</body>
<!-- InstanceEnd -->
</html>
