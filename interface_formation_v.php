<?php
/***********************************************************/
// Copyright ï¿½ 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.   
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 03/01/06
// Contenu: 
/***********************************************************/


if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("config/config.inc.php"))      require_once("config/config.inc.php");


require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_terminologie.php");
require_once ($LEA_REP."lib/stdlib.php");
$termino= new Terminologie();
$termino->set_detail();
/***********************************************************/
$bdd = new Connexion_BDD_LEA();
$id_for=$_REQUEST['id_for'];
$suivi="";
$rl="";
if($_REQUEST['supp_suivi_entr']=="false"){
	$suivi=$_REQUEST['supp_suivi_entr'];
}
if($_REQUEST['supp_rl']=="false"){
	$rl=$_REQUEST['supp_rl'];
}

// Definition des droits actifs et non actifs (parent, suivi en entreprise)
if($suivi!="")$suivi=$id_for;
if($rl!="")$rl=$id_for;
$sql="delete from les_droits_formations where id_for_without_suivi='$id_for' or id_for_without_parent='$id_for'";
$bdd->executer($sql);
if($suivi!="" or $rl!="") {
    $sql="insert into les_droits_formations values ('','$rl','$suivi')";
    $bdd->executer($sql);
}




if(isset($_REQUEST['droitsr'])){
	$drsr=$_REQUEST['droitsr'];
	$sql="delete from les_sous_resp_droits where id_for='$id_for'";
	$bdd->executer($sql);
	$sql="insert into les_sous_resp_droits values ('$id_for','$drsr')";
	$bdd->executer($sql);
}
$formation = new Formation($id_for);
$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['term_app']))$config_lea->appelation_app = to_sql($_REQUEST['term_app']);
if(isset($_REQUEST['term_ens']))$config_lea->appelation_ens = to_sql($_REQUEST['term_ens']);
if(isset($_REQUEST['term_classe']))$config_lea->appelation_classe = to_sql($_REQUEST['term_classe']);
if(isset($_REQUEST['term_rl']))$config_lea->appelation_rl = to_sql($_REQUEST['term_rl']);
if(isset($_REQUEST['term_ma']))$config_lea->appelation_ma = to_sql($_REQUEST['term_ma']);
if(isset($_REQUEST['term_tuteur_cfa']))$config_lea->appelation_tuteur_cfa = to_sql($_REQUEST['term_tuteur_cfa']);
if(isset($_REQUEST['term_entr']))$config_lea->appelation_entr = to_sql($_REQUEST['term_entr']);
if(isset($_REQUEST['term_suivi_cfa']))$config_lea->appelation_suivi_cfa = to_sql($_REQUEST['term_suivi_cfa']);
if(isset($_REQUEST['term_suivi_entr']))$config_lea->appelation_suivi_entr = to_sql($_REQUEST['term_suivi_entr']);

$config_lea->update();





html_refresh($_SERVER['HTTP_REFERER']);

/*
function reorganiser($tout,$truc){
if(ereg($truc,$tout)){
$retour=$truc;
$tok = strtok($tout,",");
while ($tok != false) {
	if($tok!=$truc)$retour=$retour.','.$tok;
	$tok = strtok(",");
	} 		
return $retour;
}

}*/

?>	
