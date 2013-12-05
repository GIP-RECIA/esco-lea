<?php 
include_once("../secure.php");
require_once("../../config/config.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Mmaitre_apprentissage.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Informations Personnelles</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "Meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />
<!-- #EndEditable -->	
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'maitreApprentissage.css');?>" />
<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?><!-- InstanceBeginEditable name="head" --> 
<!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js');?>"></script>
			<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
	<body>
		<div id="box2" style="display:none">
		</div><div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
			<?php include($LEA_REP.'menu_maitre_apprentissage.php'); ?>	
			<div id="contenu">
    			<div id="contents">
<!-- InstanceBeginEditable name="Contenu" -->
          		<?php                               										
					if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
					else  $cmd="";			
											 
					switch ($cmd) {
						case "cons_coordonnees": 
							include('cons_coordonnees.php');  // consulter les coordonnï¿½es du maitre d'apprentissage
							break;	
						case "modif_coordonnees": 
							include('modif_coordonnees.php');  // le formulaire pour modifier les coordonnï¿½es du maitre d'apprentissage
							break;
						case "modif_coordonnees_v": 
							include('modif_coordonnees_v.php');  // valider la  modification des coordonnï¿½es du maitre d'apprentissage
							break;				  					  						  
						default : 
							include('cons_coordonnees.php');  // consulter les coordonnï¿½es du maitre d'apprentissage
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
<!-- InstanceEnd -->
</html>
