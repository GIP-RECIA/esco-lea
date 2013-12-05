<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 23/08/05
/***********************************************************/
include_once("../secure.php");
include_once("../../stdlib.php");
include_once("../../Modele/classe_cours.php");
include_once("../../Modele/classe_matiere.php");
include_once("../../Modele/classe_chapitre.php");
/***********************************************************/

if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; 
else $action="";

if (isset($_REQUEST['id_chap']) ) $id_chap=$_REQUEST['id_chap'];
else $id_chap=0;
	
	if ($action=="supp") {	
		$chapitre=new Chapitre($id_chap);
		$chapitre->set_detail();	
		$chapitre->delete();
		html_refresh("cours.php?cmd=cons_chap&id_mat=$chapitre->id_mat");
	}
	
	if ($action=="supp_all") {
	
		if (isset($_REQUEST['id_mat']) ) $id_mat=$_REQUEST['id_mat'];
		else $id_mat=0;	
		$matiere=new Matiere($id_mat);	
		$matiere->delete_all_chapitres();
		html_refresh("cours.php?cmd=cons_chap&id_mat=$id_mat");
	}
    if ($action=="nouv" || $action=="modif") {
				
	$chapitre=new Chapitre($id_chap);

if(get_magic_quotes_gpc()) {

	$chapitre->libelle=$_REQUEST['libelle'];
	if ($_REQUEST['new_theme']!="") $chapitre->theme=$_REQUEST['new_theme'];
	elseif (isset($_REQUEST['theme'])) $chapitre->theme=$_REQUEST['theme'];		
}else {

	$chapitre->libelle=addslashes($_REQUEST['libelle']);
	if ($_REQUEST['new_theme']!="") $chapitre->theme=addslashes($_REQUEST['new_theme']);
	elseif (isset($_REQUEST['theme'])) $chapitre->theme=addslashes($_REQUEST['theme']);		


}
	$chapitre->id_mat=$_REQUEST['id_mat'];;	
     
    if($action=="nouv") $chapitre->insert();
	else $chapitre->update();
	
	echo" 
	<script language='JavaScript'>
		window.opener.location.reload('cours.php?cmd=cons_chap&id_mat=$chapitre->id_mat');
		window.close();
	</script> ";


	} 		

?>