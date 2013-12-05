<?php
/* /!\Projet_tut/!\ Julien GEORGES - 21/06/06 
Description : Script permettant de supprimer un espace */

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");

$bdd = new Connexion_BDD_LEA();


$id_espace_partage=$_GET['id_espace_partage'];

if(isset($_SESSION['id_app'])){
	$id=$_SESSION['id_app'];
}
if(isset($_SESSION['id_ens'])){
	$id=$_SESSION['id_ens'];
}
if(isset($_SESSION['id_ma'])){
	$id=$_SESSION['id_ma'];
}

// Requete qui selectionne l'espace contenant le commentaire pour la redirection
$sql="SELECT * FROM espace_partage WHERE id_espace_partage='$id_espace_partage' AND id_auteur_espace_partage='$id'";
$req = $bdd->executer($sql);
$sel=mysql_fetch_row($req);
$id_espace=$sel[5];
$nom_sup=$sel[4];
if (!empty ($nom_sup)){
	$nom_sup=$id_espace."_".$id_espace_partage."_".$nom_sup;
	$nom_sup=addslashes($nom_sup);
	@unlink ("fichiers/".$nom_sup);
}
// requete qui supprime le commentaire
$sql="DELETE FROM espace_partage WHERE id_espace_partage='$id_espace_partage' AND id_auteur_espace_partage='$id'";
$req = $bdd->executer($sql);
header("Location:consult_espace.php?id_espace=$id_espace");
?>