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
require_once($LEA_REP.'modele/bdd/classe_message.php');

$id_espace=$_GET['id_espace'];
if(isset($_SESSION['id_app'])){
	$id=$_SESSION['id_app'];
}
if(isset($_SESSION['id_ens'])){
	$id=$_SESSION['id_ens'];
}
if(isset($_SESSION['id_ma'])){
	$id=$_SESSION['id_ma'];
}
		$sql="SELECT id_espace_partage, nom_fichier FROM espace_partage WHERE lien_id_espace='$id_espace'"; //On récupère toutes les personnes qui étaient concernés par l'espace
		$req= $bdd->executer($sql);
		$fichiers=mysql_fetch_row($req);
		while($fichiers){
			if(!empty($fichiers[1])){
				$chaine=addslashes("./fichiers/".$id_espace.'_'.$fichiers[0].'_'.$fichiers[1]);
				@unlink($chaine);
			}
			$fichiers=mysql_fetch_row($req);
		}


		$sql="SELECT id_acteur FROM acteurs_espace WHERE id_espace='$id_espace'"; //On récupère toutes les personnes qui étaient concernés par l'espace
		$req= $bdd->executer($sql);
		$personnes=mysql_fetch_row($req);
		$tab = array();
		while($personnes){
			if($personnes[0]==$id){
			}else{
				$tab[]=$personnes[0]; //on stocke toutes les personnes concernés par l'espace dans un tableau
			}
			$personnes=mysql_fetch_row($req);
		}
		
		$sql="SELECT nom_espace FROM espace WHERE id_espace='$id_espace'"; //On récupère toutes les personnes qui étaient concernés par l'espace
		$req= $bdd->executer($sql);
		$nom_espace=mysql_fetch_row($req);
		
		$msg= new Message(0);
		$msg->objet=addslashes("Espace ".$nom_espace[0]." supprimé");
		$msg->message=addslashes("L'espace ".$nom_espace[0]." a été supprimé.\n
					Contacter le créateur de l'espace pour de plus amples informations.");
		$msg->id_usager=$id;
		$msg->insert($tab); //on envoit ce message a toutes les personnes sélectionnés pour la création de l'espace


	$sql="DELETE FROM espace WHERE id_espace='$id_espace' AND id_createur_espace='$id'";
	$req = $bdd->executer($sql);
	header("Location:consult_espace.php");
?>