<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 26/09/06
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

/***********************************************************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Mresponsable_vie_scolaire.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
		<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA Responsable vie scolaire </title>
		<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "Meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />		
		<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'responsableVieScolaire.css');?>"/>
		
		<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
				<script type="text/javascript" 
				src="<?php echo($LEA_URL.'javascript/menu.js');?>">
				</script>
	</head>
<body>
	
	<div id="conteneur">
	<?php include($LEA_REP.'menu_responsable_vie_scolaire.php'); ?>
		
		<div id="contenu">
    		<div id="contents">		<!-- InstanceBeginEditable name="sous_menu" -->
	  <script language="JavaScript" type="text/javascript" src="../../javascript/stdlib.js">
      </script>
		<?php                                      
		include_once($LEA_REP.'administrateur/gest_doc/sous_menu.php');
		
		if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
		else 						 $cmd="";			
				
		switch ($cmd) {
		
		case "maj_doc":  afficher_sous_menu("maj_doc");
							include($LEA_REP.'administrateur/gest_doc/maj_doc.php');  
							  break;		
							  					  
		case "cons_doc": afficher_sous_menu("cons_doc");
							include($LEA_REP.'administrateur/gest_doc/cons_doc.php');  
							  break;				
      							  					  					  					  	
		default             : afficher_sous_menu("cons_doc");
								include($LEA_REP.'administrateur/gest_doc/cons_doc.php');  
							  break;					  	        		
		
		}
		
		?>
        <!-- InstanceEndEditable --></div>
			  <div id="bottom_box"> </div>   
		</div>	
		
		<div id="footer">
			<?php include($LEA_REP."footer.php")?>
		</div>
		
	</div>
	
</body>
<!-- InstanceEnd --></html>
