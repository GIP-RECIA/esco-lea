<?php
require_once("../config/config.inc.php");

include_once("secure.php");

require_once ($LEA_REP."lib/stdlib.php");
require($LEA_REP.'modele/bdd/classe_usager.php');
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
if (!isset($_SESSION['id_admin'])){
	html_refresh($LEA_URL);
}

$bdd = new Connexion_BDD_LEA();

// Logo CFA
$options = $bdd->get_options( );
$_SESSION['options_lea']['LEA_LOGO_CFA'] = $options['LEA_LOGO_CFA'];

// Bandeau CFA
$_SESSION['options_lea']['LEA_BACKGROUND_HEAD'] = $options['LEA_BACKGROUND_HEAD'];

// Theme CFA
$_SESSION['options_lea']['LEA_THEME'] = $options['LEA_THEME'];

// Image d'accueil
$usager = new Usager($_SESSION['id_admin']);
$img_accueil = $usager->get_valeur_attribut("img_accueil"); // l'image de la page d'accueil de l'apprenti
$rep_img = $LEA_REP."images/img_accueil/";

if ($img_accueil=="" || !file_exists ($rep_img.$img_accueil) ) {

	$url_img = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'images/default_imageDefault.png';
}
else {
	$url_img = $LEA_URL.'images/img_accueil/'.$img_accueil;
}




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<!-- InstanceBegin template="/Templates/Madministrateur.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<!-- <title>LEA Administrateur</title> -->
<title>LEA: Accueil</title>
<!-- InstanceEndEditable -->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!-- #BeginEditable "meta" -->
<meta name="keywords" content="" />
<meta name="special" content="" />
<!-- #EndEditable -->
<link rel="stylesheet" type="text/css" media="screen"
	href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>" />

<?php
if(isset($_REQUEST['imprimer'])) {
	echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
}
?>

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/menu.js');?>">
		</script>
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
</head>

<body>

<div
	id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>"><?php include($LEA_REP.'menu_administrateur.php'); ?>
<div id="contenu">

<div id="contents"><!-- InstanceBeginEditable name="sous_menu" -->
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">A</span>ccueil</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<div id="texte"><strong>Soyez les bienvenus au centre d'administration
	du projet <acronym title="Livret &Eacute;lectronique d'Apprentissage">LEA</acronym></strong>
						<?php include($LEA_REP."administrateur/contact/msg_non_lu.php"); ?>
	
	<img src="<?php echo($url_img)?>" alt="Image LEA par d?faut" width="600" />
	
	<br/> 
	<?php echo("<img src=\"../images/b_edit.png\" border=0 /><a href=\"#\" onClick=\"window.open('../modif_img_accueil_usager.php','','width=600, height=200, resizeble=yes')\">Modifier l'image d'accueil</a>" );?>
	</div>
</div>


<!-- InstanceEndEditable --></div>
<div id="bottom_box"></div>
</div>

<?php include($LEA_REP."footer.php")?></div>
</body>
<!-- InstanceEnd -->
</html>
