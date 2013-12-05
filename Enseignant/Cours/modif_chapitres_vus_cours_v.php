<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 21/09/05
  //Contenu: ce script mettre à jour les chapitres vus du cours d'identifiant id_cours.
/***********************************************************/
include_once("../secure.php");
include_once("../../Modele/classe_cours.php");
include_once("../../Modele/classe_matiere.php");
include_once("../../Modele/classe_chapitre.php");
include_once("../../stdlib.php");
/***********************************************************/

if (isset($_REQUEST['id_cours'])) $id_cours=$_REQUEST['id_cours'];
else  html_refresh(" ../../accueil.php");

if(isset($_REQUEST['les_id_chapitres_vus'])) $les_id_chapitres_vus=$_REQUEST['les_id_chapitres_vus'];
else $les_id_chapitres_vus=array();

$cours=new Cours($id_cours);
$cours->maj_chapitres_vus($les_id_chapitres_vus);

html_refresh("cours.php?cmd=cons_chapitres_vus_cours&id_cours=$cours->id_cours")

?>		