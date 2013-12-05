<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 17/11/05
  // Contenu: 
/***********************************************************/
ob_start();
include_once("../secure.php");
require_once("../../config/config.inc.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");

if ((isset($_REQUEST['cmd']) && $_REQUEST['cmd'] != "contact_app") || !isset($_REQUEST['cmd']))
	header('Location: '.$LEA_URL.'messagerie/reception.php');
/***********************************************************/
if (isset($_SESSION['id_ens'])){
	$enseignant = new Enseignant($_SESSION['id_ens']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
		<!-- InstanceBeginEditable name="doctitle" -->
<!--<title>LEA Enseignant</title>-->
<title>LEA: Contact</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "Meta" -->
<meta name="special" content="" />

<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen"
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>"  />
		<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?>
	
		<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
				<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
<body>
<div id="box2" style="display:none">
			<?php include($LEA_REP.'Enseignant/sel_formation.php'); ?>
		</div>
<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">

			<?php 
				include($LEA_REP.'menu_enseignant.php'); 
			?>

		<div id="contenu">
    		<div id="contents">	
			
   		<!-- InstanceBeginEditable name="sous_menu" -->
		<script language="JavaScript" type="text/javascript" src="../../javascript/stdlib.js">
        </script>
		<?php                                      
		
		if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
		else 						 $cmd="";			
		
		include("sous_menu.php");
				
		switch ($cmd) {								  
		
		case "contact_app": afficher_sous_menu("contact_app"); 
						  include('contact_app.php');  
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
<!-- InstanceEnd --></html>
<?php
ob_end_flush();		
?>