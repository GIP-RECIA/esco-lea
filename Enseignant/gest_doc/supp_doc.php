<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_document_administratif.php");
require_once($LEA_REP."modele/bdd/classe_categorie_document.php");
/***********************************************************/
session_name("LEA_$RNE_ETAB");
session_start();

$id_doc = $_REQUEST['id_doc'];
$document = new Document_administratif($id_doc);
$document->set_detail();

$categorie = new Categorie_document($document->id_categ);
$categorie->set_detail();

$document->delete();

if(isset($_SESSION['id_ens'])) $url_gest_doc = $LEA_URL.'Enseignant/gest_doc/';
else exit();

html_refresh($url_gest_doc."gest_doc.php?cmd=cons_doc&id_categ=$document->id_categ");
?>		
