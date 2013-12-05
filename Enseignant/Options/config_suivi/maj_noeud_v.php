<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/08/05
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."Enseignant/secure.php");

require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else exit();

switch($action) {

case "nouv" :  	
	$noeud=new Noeud(0, $_REQUEST['id_arbre']);
	$noeud->libelle = to_sql($_REQUEST['libelle']);
	$noeud->id_noeud_parent = to_sql($_REQUEST['id_noeud_parent']);	
	if(isset($_REQUEST['type'])) 
		$noeud->type = 'feuille';
	else $noeud->type = 'branche';	
	$noeud->insert();
	
	html_refresh("../options.php?cmd=maj_arbre&id_arbre=".$noeud->id_arbre."&id_noeud=".$noeud->id_noeud_parent."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']);
																	
	break;
				
case "modif":  
	if( isset($_REQUEST['id_noeud']))  {
		$noeud=new Noeud($_REQUEST['id_noeud'], $_REQUEST['id_arbre']);
		$noeud->libelle = to_sql($_REQUEST['libelle']);
		if(isset($_REQUEST['type'])) 
			$noeud->type = 'feuille';
		else $noeud->type = 'branche';	
		$noeud->update();															
	}
	echo" <script langage='javascript'>
			window.opener.location.reload();
			window.close();
		  </script>";
	break;

case "supp":   		
	$id_noeud_actif = $_REQUEST['id_noeud_actif'];
	$noeud_actif = new Noeud($id_noeud_actif, $_REQUEST['id_arbre']);
	$les_id_noeuds_ascendants = $noeud_actif->get_id_noeuds_ascendants();
	$les_id_noeuds_ascendants[] = $id_noeud_actif;
	
	$id_noeud = $_REQUEST['id_noeud'];
	$noeud = new Noeud($id_noeud, $_REQUEST['id_arbre']);					
	$noeud->set_detail();										
	$noeud->delete();					
	
	if(in_array($id_noeud, $les_id_noeuds_ascendants)) html_refresh("../options.php?cmd=maj_arbre&id_arbre=".$noeud->id_arbre."&id_noeud=".$noeud->id_noeud_parent."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']);
	else html_refresh($_SERVER['HTTP_REFERER']);
	break;	
				
default     : 
	exit();
}
?>		