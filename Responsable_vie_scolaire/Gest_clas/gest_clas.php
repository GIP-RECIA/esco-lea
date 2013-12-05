<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: 
/***********************************************************/

include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Mresponsable_vie_scolaire.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
		<!-- InstanceBeginEditable name="doctitle" -->
<title>LEA: Gestion des classes</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "Meta" -->
<meta name="special" content="" />

<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen"
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'responsableVieScolaire.css');?>"/>
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
    		<div id="contents">		<!-- InstanceBeginEditable name="sous_menu" -->   
	   <script language="JavaScript" type="text/javascript" src="../../javascript/stdlib.js">
      </script>	   
      <?php                                      
		
		if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
		else 						 $cmd="";			
		
		include_once("sous_menu.php");
		
		switch ($cmd) {
		
		case "nouv_form": afficher_sous_menu("cons_form");	
							include('nouv_form.php');  // le formulaire pour crï¿½er une nouvelle formation
							  break;
							  											  
        case "cons_form": afficher_sous_menu("cons_form");	
							include('cons_form.php');
							  break;
							  
        case "cons_form_det" : afficher_sous_menu("cons_form");	
								include('cons_form_det.php'); 
       						  break;
       							  					  					  							  
		case "nouv_clas" : afficher_sous_menu("nouv_clas");	
							include('nouv_clas.php'); 
							  break;
							  
	    case "modif_clas" : afficher_sous_menu("nouv_clas");	
							include('nouv_clas.php'); 
							  break;						  
   
        case "cons_clas" : afficher_sous_menu("cons_clas");	
							include('cons_clas.php'); 
							  break;
							  							  							  							  
		case "cons_app_clas" : afficher_sous_menu("cons_clas");	
								include('cons_app_clas.php'); 
							  break;
							  									  		
		case "operations" :afficher_sous_menu("operations");	 
								include('operations.php'); 
							  break;					  
							  								  					         									  					  					  					 					  					  
		default             : afficher_sous_menu("cons_form");	
								include('cons_form.php');
							 	 break;
		}
		
		?>

      <!-- InstanceEndEditable --></div>
			  <div id="bottom_box"> </div>   
		</div>	
		
		
		<?php include($LEA_REP."footer.php")?>
		
		
	</div>
	
</body>
<!-- InstanceEnd --></html>
