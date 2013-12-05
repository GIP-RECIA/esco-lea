<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Ce page permet de stocker les donnees saisies concernat une nouvelle uniteepreprsie dans la base
  //          de donnnï¿½es
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
/***********************************************************/
if (isset($_REQUEST['id_unite'])) $id_unite=$_REQUEST['id_unite'];
else exit();

$unite = new Unite_pedagogique($id_unite);
$unite->nom			= to_sql($_REQUEST['nom']);			
$unite->adresse		= to_sql($_REQUEST['adresse']);
$unite->tel_fixe1	= to_sql($_REQUEST['tel_fixe1']);
$unite->tel_fixe2	= to_sql($_REQUEST['tel_fixe2']);
$unite->fax			= to_sql($_REQUEST['fax']);
$unite->email		= to_sql($_REQUEST['email']);
$unite->url_site	= to_sql($_REQUEST['url_site']);			
$unite->nom_contact = to_sql($_REQUEST['nom_contact']);						
$unite->prenom_contact= to_sql($_REQUEST['prenom_contact']);
											
if($id_unite == 0) $unite->insert(); // nouevelle unite			
else $unite->update(); // modifier l'unite d'identifiant id_unite

if(isset($_REQUEST['les_id_rvs'])) $unite->update_reponsables($_REQUEST['les_id_rvs']);

html_refresh("gest_unite.php?cmd=cons_unite");
 ?>	
