<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_categorie_document.php");
/***********************************************************/
session_name("LEA_$RNE_ETAB");
session_start();

if(isset($_SESSION['id_ens'])) $id_usager =  $_SESSION['id_ens'];
else exit();

$id_categ = $_REQUEST['id_categ'];

$categorie = new Categorie_document($id_categ);
$categorie->set_detail();
	
	$categorie->libelle = to_sql($_REQUEST['libelle']);
	$categorie->id_for = to_sql($_SESSION['id_for']);		
	
		//------------------- enregistrement de la catégorie sur la base de données ------------------
		
	if ($id_categ==0) $categorie->insert();	
	else $categorie->update();
	


if(isset($_SESSION['id_ens'])) $url_gest_doc = $LEA_URL.'Enseignant/gest_doc/';
else exit();

html_refresh($url_gest_doc."gest_doc.php?cmd=cons_categ");
 
?>