<?php
/* /!\Projet_tut/!\ Matthieu Charron - 20/06/06 
Description : Page permettant de rentrer en base les données de la création de l'espace */

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");

$bdd = new Connexion_BDD_LEA();

// Récupération de l'id du créateur du commentaire
if(isset($_SESSION['id_ma'])){
	$id=$_SESSION['id_ma'];
}
if(isset($_SESSION['id_app'])){
	$id=$_SESSION['id_app'];
}
if(isset($_SESSION['id_ens'])){
	$id=$_SESSION['id_ens'];
}
if(isset($_SESSION['id_rl'])){
	$id=$_SESSION['id_rl'];
}
// Récupération des valeurs transmisent en POST
$id_espace_partage=$_POST['id_espace_partage'];
$id_espace=$_POST['id_espace'];
$commentaire=$_POST['commentaire'];

// Mise en forme de la date
$date=date("Y-m-d H:i:s");

if(!empty($_FILES['fichier']['name'])){
	$prout=$_FILES['fichier']['name'];
	$charInterdit = array(" ", "'", "\"", "/", "\\");
	$nom = str_replace($charInterdit, "_", $prout); // le nom du fichier téléchargé  
}else{
	$nom="";
}

// On insert les variables en BDD
$sql="UPDATE espace_partage SET com_espace_partage='".addslashes($commentaire)."', date_ajout='$date' WHERE id_espace_partage=$id_espace_partage ";
$req = $bdd->executer($sql);

if($nom!=""){
		// Si le nom de fichier n'est pas vide on continue
		if(!empty($_FILES['fichier']['name'])){
			//$nom = $_FILES['fichier']['name'];// le nom du fichier téléchargé  
			$nom_bdd=$nom;
			$erreur = $_FILES['fichier']['error'];// récupération de l'erreur s'il y en a une
			
			// S'il n'y a pas d'erreur on continue
			if( !$_FILES['fichier']['error']) {
			
				// Si la taille maximale n'est pas atteinte on continue
				$taille = filesize($_FILES['fichier']['tmp_name']);
				$maxsize = get_max_size_upload();
				if($taille<=$maxsize){
				
					// On récupère les informations relatives à l'espace de partage ( id_espace, nom_espace )
					$sql2="SELECT id_espace,nom_espace FROM espace WHERE id_espace='$id_espace'";
					$req2 = $bdd->executer($sql2);
					$sel2=mysql_fetch_row($req2);
								 
					// on vérifie maintenant l'extension
					$type_file = $_FILES['fichier']['type'];
					
					// Si le fichier a pour extension "ini" ou "php" on arrete
					if( strstr($type_file, 'ini')|| strstr($type_file, 'php') ){
						 Afficher_msg_erreur(" Vous n'&ecirc;tes pas autoris&eacute; à envoyer ce type de fichier ");
						 Afficher_boutton_retour(); exit();
					}
					
					// Dossier où sera placé le fichier
					$dest_dir = "fichiers/"; 
					
					// Dossier temporaire du serveur ou est stocké le fichier
					$tmp_file = $_FILES['fichier']['tmp_name'];
					
					// Renommage du nom du fichier
					$nom=$id_espace."_".$id_espace_partage."_".$nom;
					
					if( !is_uploaded_file($tmp_file) ){
						 Afficher_msg_erreur(" Le fichier est introuvable ");
						 Afficher_boutton_retour(); exit();
					}
				
					if( !move_uploaded_file($tmp_file, $dest_dir . $nom) ){
						Afficher_msg_erreur(" Impossible de copier le fichier dans ".$content_dir);
						Afficher_boutton_retour(); exit();
					}else{
						$sql3="SELECT nom_fichier FROM espace_partage WHERE id_espace_partage='$id_espace_partage'";
						$req3 = $bdd->executer($sql3);
						$sel3=mysql_fetch_row($req3);
						$le_nom=$sel3[0];
						@unlink($LEA_REP."espace_de_partage/fichiers/".$id_espace."_".$id_espace_partage."_".$le_nom);
					}
								 
				}else{
					afficher_msg_erreur("La taille du fichier est trop importante !"); afficher_boutton_retour(); exit();
				}
				
			}else{
				afficher_msg_erreur("Erreur lors du téléchargement  du fichier à importer"); afficher_boutton_retour(); exit();
			}
		
		}
		// On insert les variables en BDD
		$sql="UPDATE espace_partage SET nom_fichier='$nom_bdd' WHERE id_espace_partage=$id_espace_partage ";
		$req = $bdd->executer($sql);
}

// Mise à jour de la variable "nouveaute_espace" de la table "acteurs_espace"
$sql="UPDATE acteurs_espace SET nouveaute_espace='1' WHERE id_espace='$id_espace' ";
$req = $bdd->executer($sql);

//redirection vers la page d'affichage des commentaires
header("Location: consult_espace.php?cmd=consulter_espace&&id_espace=".$id_espace);


?>