<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 05/09/05

/***********************************************************/
include_once('../secure.php');
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
$apprenti = new Apprenti($_SESSION['id_app']);
$apprenti->set_detail(0);

$nom_app = $apprenti->nom;
$prenom_app = $apprenti->prenom;

$apprenti->nom = addslashes($apprenti->nom);
$apprenti->prenom = addslashes($apprenti->prenom);
$apprenti->adresse = addslashes($apprenti->adresse);
$apprenti->dern_classe_freq = addslashes($apprenti->dern_classe_freq);
$apprenti->diplomes_obtenus = addslashes($apprenti->diplomes_obtenus);
$apprenti->adresse_perso = addslashes($apprenti->adresse_perso);


	$apprenti->adresse_perso = to_sql($_REQUEST['adresse_perso']);
	$apprenti->tel_perso = to_sql($_REQUEST['tel_perso']);
	$apprenti->email_perso = to_sql($_REQUEST['email_perso']);
	$apprenti->url_site = to_sql($_REQUEST['url_site']);
	$mdp = to_sql($_REQUEST['mdp']);

if ($mdp!="") $apprenti->mdp = $mdp;

$old_src_photo = $apprenti->src_photo;

$src=$_FILES['src_photo']['tmp_name']; 
$nom=$_FILES['src_photo']['name']; // le nom de la photo telechargé
		
	$repertoireDestination = "../../Apprenti/Photos/";
              	  		
	 $filename = "$repertoireDestination"."$old_src_photo";			
			if (file_exists($filename)&& $old_src_photo!="" && $nom!="") {
				unlink($filename);
			}   
				$dest="";            				
				$nb = date("dmy-His"); 
				 
				 if ($nom!="") $dest = "photo_".$nb.".".get_extension($nom);  
			
		     if  (move_uploaded_file($src, $repertoireDestination.$dest)) 			 			 
			 $apprenti->src_photo = to_sql($dest);			 			 		

$apprenti->update();

html_refresh("info_perso.php?cmd=cons_coordonnees");

?>
