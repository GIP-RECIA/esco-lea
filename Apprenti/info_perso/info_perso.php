<?php 
include_once('../secure.php');
require_once("../../config/config.inc.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
//
if(isset($_SESSION['id_app'])) $id_app_select=$_SESSION['id_app'];
elseif(isset($_REQUEST['id_app_select'])) $id_app_select=$_REQUEST['id_app_select'];
else exit();

$apprenti = new Apprenti($id_app_select);

if(isset($_SESSION['id_for']) &&$_SESSION['id_for']!= $apprenti->get_id_for() ) exit();

$apprenti->set_detail();
$config_lea = $apprenti->get_config_lea();

//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Mapprenti.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
		<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Infos perso</title>
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
				src="<?php echo($LEA_URL.'javascript/menu.js');?>"><script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
				</script>
			<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
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
      <?php 
	   include("sous_menu.php");
	                                        				
		if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
		else 						 $cmd="";			
		switch ($cmd) {
		
		case "cons_coordonnees": 
			afficher_sous_menu("cons_coordonnees");
			include('cons_coordonnees.php');  // coordonnees de l'apprenti
			break;
		case "modif_coordonnees": 
			afficher_sous_menu("modif_coordonnees"); 
			include('modif_coordonnees.php'); 
			break;				  					  	
		default             : 
			afficher_sous_menu("cons_coordonnees");
			include('cons_coordonnees.php');
			break;					  	        		
		}
		?>
<!-- InstanceEndEditable --> 
			</div>
		  <div id="bottom_box"> </div>   
		</div>			
		<?php include($LEA_REP."footer.php")?>	
	</div>
</body>
<!-- InstanceEnd -->
</html>
