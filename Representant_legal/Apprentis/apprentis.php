<?php

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
include("../secure.php");

ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html
	xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<!-- InstanceBegin template="/templates/Mrepresentant_legal.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<!-- <title>LEA Repr&eacute;sentant l&eacute;gal</title> -->
<title>LEA: Suivi</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- #BeginEditable "Meta" -->
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
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/menu.js');?>">
			</script>
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
<script type="text/javascript"
	src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
</head>
<body>
<div id="box2" style="display: none"></div>
<div
	id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>"><?php include($LEA_REP.'menu_representant_legal.php'); ?>

<div id="contenu">
<div id="contents"><!-- InstanceBeginEditable name="Contenu" --> <?php                                      


if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
else 						 $cmd="";
switch ($cmd) {

	case "vos_apprentis":
		include('vos_apprentis.php');  // affichage de la liste des apprentis suivis par le maitre d'apprentissage
		break;
	case "cons_coordonnees_ens":
		include('../../Enseignant/Info_perso/cons_coordonnees.php');
		break;
	case "cons_coordonnees_ma":
		include('../../Maitre_apprentissage/Info_perso/cons_coordonnees.php');
		break;
	case "cons_dec_app":
		include('cons_dec_app.php');
		break;
	case "nouv_dec_app":
		include('nouv_dec_app.php');
		break;
	case "bilan_app" :
		include('bilan_app.php');
		break;

	default :
		include('vos_apprentis.php');
		break;

}

?> <!-- InstanceEndEditable --></div>
<div id="bottom_box"></div>
</div>

<?php include($LEA_REP."footer.php")?></div>

</body>
<!-- InstanceEnd -->
</html>
<?php
ob_end_flush();
?>