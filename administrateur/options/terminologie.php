<?php
/***********************************************************/  
  // Auteur : FrÃ©dÃ©ric GOYER
  // Version : 1.0.2
  // Date: 04/07
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

/***********************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Madministrateur.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>				
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Configuration</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "meta" -->
		<meta name="special" content="" />		
<!-- #EndEditable -->
		<link rel="stylesheet" media="screen" type="text/css" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"  />
		<link rel="stylesheet" media="screen" type="text/css" href="<?php echo('./schema_apprenti.css');?>"  />
		<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?>
		<link rel="stylesheet" type="text/css" media="screen" href="param/parametrage.css" />
		<!--[if lte IE 6]>
			<link media="screen" type="text/css" rel="stylesheet" href="param/parametrageIE6.css" />
		<![endif]-->
		<!--[if lte IE 7]>
			<link media="screen" type="text/css" rel="stylesheet" href="param/parametrageIE7.css" />
		<![endif]-->
		<script type="text/javascript" src="param/parametrage.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js');?>">	</script>		
	</head>
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
					<script language="JavaScript" type="text/javascript" src="../../javascript/stdlib.js"></script>
					<?php include('./terminologie_institution.php'); ?>
<!-- InstanceEndEditable -->
				</div>
				<div id="bottom_box"></div>   
			</div>	
			<?php include($LEA_REP."footer.php")?>
		</div>
	</body>
<!-- InstanceEnd -->
</html> 
