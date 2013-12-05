<?php 
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once($LEA_REP."modele/classe_gestion_declaration.php");

include_once('../secure.php');

require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");

if (isset($_SESSION['id_ens'])){
	$enseignant = new Enseignant($_SESSION['id_ens']);
}

ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Suivi</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "Meta" -->
		<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>"  />
				<link rel="stylesheet" type="text/css" media="screen" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>"  />
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
		</div><div  id="<?php  if(!isset($_REQUEST['imprimer'])){
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
			        <?php                                      
						include('sous_menu.php');
						
						if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
						else 						 $cmd="";	
								
						switch ($cmd) {
						
							case "cons_liste_app": 
								afficher_sous_menu('cons_liste_app');  
								include('cons_liste_app.php'); 
								break;
							case "cons_coordonnees_app": 
								afficher_sous_menu('cons_liste_app');  
								include('../../Apprenti/info_perso/cons_coordonnees.php'); 
								break;
							case "cons_coordonnees_ens": 
								afficher_sous_menu('cons_liste_app');  
								include('../Info_perso/cons_coordonnees.php'); 
								break;
							case "cons_coordonnees_ma": 
								afficher_sous_menu('cons_liste_app');  
								include('../../Maitre_apprentissage/Info_perso/cons_coordonnees.php'); 
								break;
							case "cons_coordonnees_rl": 
								afficher_sous_menu('cons_liste_app');  
								include('../../Representant_legal/Info_perso/cons_coordonnees.php'); 
								break;					  					  
							case "cons_lea_app":  	
								afficher_sous_menu('cons_liste_app');  
								include('cons_lea_app.php'); 
								break;					  					  					  								  
							case "cons_dec_app":  
								afficher_sous_menu('cons_liste_app');  
								include('cons_dec_app.php'); 
								break;
							case "nouv_dec_app": 
							 	afficher_sous_menu('cons_liste_app');
								include('nouv_dec_app.php');
								break; 	
							case "suivi_signature":
								afficher_sous_menu('suivi_signature');
								include('suivi_signature.php');
								break;	
							case "bilan_app":
								afficher_sous_menu('cons_liste_app');
								include('../../Apprenti/Livret/bilan_app.php');
								break;	
							case "bilan_classe":
								afficher_sous_menu('bilan_classe');
								include('../../Apprenti/Livret/bilan_classe.php');
								break;						  					  					  
							default  : 
								afficher_sous_menu('cons_liste_app');  
								include('cons_liste_app.php'); 
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
