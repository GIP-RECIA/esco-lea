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
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Madministrateur.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>				
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Gestion des usagers</title>
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
		
					if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
					else 						 $cmd="";			
					
					include_once"sous_menu.php";
							
					switch ($cmd) {
							
						case "form_nouv_usag":							  	 
							include('form_nouv_usag.php');  // le formulaire pour crï¿½er un nouvel usager
							break;	 
							 				  		
						case "cons_liste_app": 
							afficher_sous_menu("cons_liste_app"); 
							include('cons_liste_app.php');  
							 break;	
							 		  
						case "cons_liste_ens":
							afficher_sous_menu("cons_liste_ens");  
							include('cons_liste_ens.php');  
							break;
											  
						case "cons_liste_ma": 
							afficher_sous_menu("cons_liste_ma"); 
							include('cons_liste_ma.php');  
							break;
											  
						case "cons_liste_rl": 
							afficher_sous_menu("cons_liste_rl"); 
							include('cons_liste_rl.php');  
							break;
											  
						case "cons_liste_rvs": 
							afficher_sous_menu("cons_liste_rvs"); 
							include('cons_liste_rvs.php');  
							break;
											  
						case "cons_liste_admin": 
							afficher_sous_menu("cons_liste_admin"); 
							include('cons_liste_admin.php');  
							break;					  
											  
						case "cons_app_suivis": 
							include('cons_app_suivis.php');  
							break;
											  					  					  
						case "cons_coordonnees_usager": 
							include('cons_coordonnees_usager.php');  
							break;
													
						case "cons_lea_app":  
							afficher_sous_menu("cons_liste_app"); 
							include('cons_lea_app.php');  
							break;
						case "cons_dec":    
							afficher_sous_menu("cons_liste_app"); 
							include('cons_dec.php');  // consulter la liste des dï¿½clarations suivant le type :entr ou cfa  
							break;                  //paramï¿½tre envoyï¿½ avec l'URL		
									  
						case "cons_dec_det": 
							afficher_sous_menu("cons_liste_app"); 
							include('../../Enseignant/Apprentis/cons_dec_det.php');  
							break;							  						  					  							  					  					
								
						case "import_data":  
							afficher_sous_menu("import_data"); 
							include('import_data.php');  
							 break;					  						  					  					  					  	
									  
						default : 
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
