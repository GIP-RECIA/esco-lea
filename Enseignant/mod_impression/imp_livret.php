<?php 
include_once('../secure.php');
require_once("../../config/config.inc.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
		<!-- InstanceBeginEditable name="doctitle" -->
<!--<title>LEA Enseignant</title>-->
<title>LEA: Informations Personnelles</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta http-equiv="Pragma" content="no-cache" />	
		<!-- #BeginEditable "Meta" -->
<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>"  />
		
		<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
	</head>
<body>
<?php
	if(isset($_GET["id_app_to_print"])) {
		echo "<iframe style=\"display:none; width:1px; height:1px;\" src=\"param_step_4.php\"></iframe>";
	}
?>
		
<div id="box2" style="display:none">
<?php include($LEA_REP.'Enseignant/sel_formation.php'); ?> 
</div>

<div id="conteneur">

<?php include($LEA_REP.'menu_enseignant.php'); ?>

		<div id="contenu">
    		<div id="contents">
			
   		<!-- InstanceBeginEditable name="sous_menu" --> 
		
		<?php                                      				
				
		$cmd = (isset($_GET['cmd'])) ? $_GET['cmd'] : "";
		
		switch ($cmd) {
			case "param_step_1":
				include('param_step_1.php');
				break;	
			case "param_step_3": 
				include('param_step_3.php');
		  		break;					  					  						  
			default:
				include('param_step_1.php'); 
				break;
		}
		?>
		
		<!-- InstanceEndEditable --> 
			</div>
			<div id="bottom_box"></div>   
		</div>	
	
		
		<?php include($LEA_REP."footer.php")?>
		
	
	</div>
	


</body>
<!-- InstanceEnd --></html>
