<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06
  // Contenu: 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/classe_gestion_declaration.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
session_name("LEA_$RNE_ETAB");
session_start();
/**********************************************************/

if(isset($_SESSION['id_app'])) $id_app = $_SESSION['id_app'];
else exit();

	$apprenti = new Apprenti($id_app);
	$apprenti->set_detail();

	$tuteur_cfa = new Usager($apprenti->id_ens);
	$tuteur_cfa->set_detail();
	
	$maitre = new Usager($apprenti->id_ma);
	$maitre->set_detail();		
	
	$formation = $apprenti->get_formation();
	$unite = new Unite_pedagogique($formation->id_unite);
	$unite->set_detail();
	
	$les_periodes =  $formation->get_periodes( '','app'); // les pï¿½riodes qui peuvent ï¿½tre consultï¿½ï¿½s par l'apprenti 
	
	$charte = $formation->get_charte_graphique(); // charte graphique de la formation de l'apprenti

	$img_accueil = $charte->img_accueil;
		
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>LEA: Impression</title>
<link href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'imprimer.css');?>"  
		rel="stylesheet" type="text/css" 
/>

		
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

		<div id="contenu">
			 		
		<?php 		
		 include('imp_1ere_page.php');		 		
		?>		
		<br> 
		
		<br>
		<p>Liste de vos d&eacute;clarations </p>
		<?php
		include('imp_declaration.php');
		foreach($les_periodes as $periode){
				 afficher_declaration( $periode, 'cfa');
				 echo'<br>';
				 afficher_declaration( $periode, 'entr');
				 echo'<br><br>';				 
				 
		}
		
		
		?>
		
	
	</div>

</body>
</html>
