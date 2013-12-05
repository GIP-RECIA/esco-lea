<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

/***********************************************************/	


 ?>		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Madministrateur.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>				
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Mon profil</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "meta" -->
		<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"  />
		<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "
		<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "
		<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js');?>"></script>		
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>	
		<script src="../../javascript/test_formulaire.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../javascript/stdlib.js"></script>	
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
        		<?php                                      
		
					if(isset($_REQUEST['profil'])) $profil=$_REQUEST['profil'];
else $profil="app";


switch($profil){

case "app": include("nouv_usag_app.php");
			break;
case "ens": include("nouv_usag_ens.php");
			break;
case "ma": include("nouv_usag_ma.php");
			break;
case "rl": include("nouv_usag_rl.php");
			break;
case "rvs":  include("nouv_usag_rvs.php");
			break;			
case "admin": include("nouv_usag_admin.php");
			break;
default     :include("nouv_usag_app.php");
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