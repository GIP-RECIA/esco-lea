<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 21/09/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");
include_once("../../stdlib.php");
include_once("../../Modele/classe_formation.php");
include_once("../../Modele/classe_tache.php");
/***********************************************************/


if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; 
else $action="";

if (isset($_REQUEST['id_tache']) ) $id_tache=$_REQUEST['id_tache'];
else $id_tache=0;
	
	if ($action=="supp") {
		
		$tache=new Tache($id_tache);
		$id_for=$tache->get_id_for();	
		$tache->delete();
		html_refresh("cours.php?cmd=cons_mod_tach&id_for=$id_for");
	}
	
	if ($action=="supp_all") {
	
		if (isset($_REQUEST['id_for']) ) $id_for=$_REQUEST['id_for'];
		else $id_for=0;	
		$formation=new Formation($id_for);	
		$formation->delete_modele_taches();
		html_refresh("cours.php?cmd=cons_mod_tach&id_for=$id_for");
	}
	
	
    if ($action=="nouv" || $action=="modif") {
				
	$tache=new Tache($id_tache);
if(get_magic_quotes_gpc()) {
	
	$tache->libelle=$_REQUEST['libelle'];
	$tache->description=$_REQUEST['description'];
	if ($_REQUEST['new_activite']!="") $tache->activite=$_REQUEST['new_activite'];
	elseif (isset($_REQUEST['activite'])) $tache->activite=$_REQUEST['activite'];		
}
else {

	$tache->libelle=addslashes($_REQUEST['libelle']);
	$tache->description=addslashes($_REQUEST['description']);
	if ($_REQUEST['new_activite']!="") $tache->activite=addslashes($_REQUEST['new_activite']);
	elseif (isset($_REQUEST['activite'])) $tache->activite=addslashes($_REQUEST['activite']);
}

	$id_for=$_REQUEST['id_for'];	

    if($action=="nouv") $tache->insert($id_for);
	else $tache->update($id_for);
	
	echo" 
	<script language='JavaScript'>
		window.opener.location.reload('cours.php?cmd=cons_mod_tach&id_for=$id_for');
		window.close();
	</script> ";


	} 
?>			