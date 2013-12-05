<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
$bdd=new Connexion_BDD_LEA();
$id_for = $_REQUEST['id_for'];
$formation = new Formation($id_for);
$formation->set_detail();
	
	$formation->nom = to_sql($_REQUEST['nom']);
	$formation->nb_semestres = to_sql($_REQUEST['nb_semestres']);	
	$formation->secteur = to_sql($_REQUEST['secteur']);
	$formation->niveau = to_sql($_REQUEST['niveau']);
	$formation->id_ens = to_sql($_REQUEST['id_ens']);
	$formation->id_unite = to_sql($_SESSION['id_unite']);
	
		//------------------- enregistrement de la formation sur la base de données ------------------
		
	if ($id_for==0) $formation->insert();	
	else $formation->update();
if($_SESSION['suivi_entr']=="false"){
$id=$formation->id_for;
$sql="select * from les_droits_formations where id_for_without_suivi='$id'";
$res=$bdd->executer($sql);
if(mysql_num_rows($res)==0){
$sql="insert into les_droits_formations values ('','','$id') ";
$bdd->executer($sql);
}
}	
	html_refresh("gest_clas.php?cmd=cons_form");
 
?>