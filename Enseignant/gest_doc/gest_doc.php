<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
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

require_once ($LEA_REP."modele/bdd/classe_enseignant.php");
/***********************************************************/
$enseignant = new Enseignant($_SESSION['id_ens']);
$est_responsable = $enseignant->est_responsable($_SESSION['id_for']); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Gestion des documents</title>
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
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
	<body>
	<div id="box2" style="display:none">
			<?php include($LEA_REP.'Enseignant/sel_formation.php'); ?>
		</div>	<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
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
	  				<script language="JavaScript" type="text/javascript" src="../../javascript/stdlib.js"></script>
					<?php                                      		
						include_once('sous_menu.php');
					
						if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
						else 						 $cmd="";			
							
						switch ($cmd) {
							case "maj_doc":  
								if( $est_responsable ) {
									afficher_sous_menu("cons_doc");						 
									include('maj_doc.php');  
								}	
								break;	  					
							case "maj_categ":  
								if( $est_responsable ) {
									afficher_sous_menu("cons_categ");						 
									include('maj_categ.php');  
								}	
								break;					  					  
							case "cons_doc": 	
								if( $est_responsable ) {
									afficher_sous_menu("cons_doc");
								}		
								include('cons_doc.php');  
								break;				
							case "cons_categ": 	
								if( $est_responsable ) {
									afficher_sous_menu("cons_categ");
								}		
								include('cons_categ.php');  
								break;				  					  					  					  	
							default   : 	
								if( $est_responsable ) {
									afficher_sous_menu("cons_doc");
								}
								include('cons_doc.php');  				  	        	
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
