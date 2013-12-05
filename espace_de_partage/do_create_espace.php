<?php
/* /!\Projet_tut/!\ Julien GEORGES - 20/06/06 
Description : Page permettant de rentrer en base les données de la création de l'espace */

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");

$bdd = new Connexion_BDD_LEA();
require_once($LEA_REP.'modele/bdd/classe_message.php');
$tab = array();
//Apprentis
if(isset($_SESSION['id_app'])){
	$id=$_SESSION['id_app'];
	
	if(!empty($_POST['nom_espace'])){
		$nom_espace=to_sql($_POST['nom_espace']); //Nom de l'espace, obligatoire pour la création
		
		//Verification et ajout du tuteur si il est sélectionné dans le tableau
		if(isset($_POST['tuteur'])){
			$tab[]=$_POST['tuteur'];
		}
		//Verification et ajout du maitre d'apprentissage si il est sélectionné dans le tableau
		if(isset($_POST['ma'])){
			$tab[]=$_POST['ma'];
		}
		//Ajout des enseignants sélectionnés dans le tableau
		if(isset($_POST['enseignants'])){
			$enseignants=$_POST['enseignants'];
			foreach($enseignants as $value){
				$tab[]=$value;
			}
		}
	}
}

//Maitres d'apprentissage
if(isset($_SESSION['id_ma'])){
	$id=$_SESSION['id_ma'];
	
	if(!empty($_POST['nom_espace'])){
		$nom_espace=to_sql($_POST['nom_espace']); //Nom de l'espace, obligatoire pour la création
		
		//Ajout des apprentis sélectionnés dans le tableau
		if(isset($_POST['app'])){
			$apprentis=$_POST['app'];
			foreach($apprentis as $value){
				$tab[]=$value;
			}
		}
		//Ajout des enseignants sélectionnés dans le tableau
		if(isset($_POST['ens'])){
			$enseignants=$_POST['ens'];
			foreach($enseignants as $value){
				$tab[]=$value;
			}
		}
	}
}

//Enseignants
if(isset($_SESSION['id_ens'])){
	$id=$_SESSION['id_ens'];
	
	if(!empty($_POST['nom_espace'])){
		$nom_espace=to_sql($_POST['nom_espace']); //Nom de l'espace, obligatoire pour la création
		
		//Ajout des apprentis sélectionnés dans le tableau
		if(isset($_POST['apprentis'])){
			$apprentis=$_POST['apprentis'];
			foreach($apprentis as $value){
				$tab[]=$value;
			}
		}
		//Ajout des enseignants sélectionnés dans le tableau
		if(isset($_POST['enseignants'])){
			$enseignants=$_POST['enseignants'];
			foreach($enseignants as $value){
				$tab[]=$value;
			}
		}
	}
}
if(!empty($_POST['nom_espace'])){
	if(isset($_POST['id_espace'])){
		//MODIFICATION DE L'ESPACE
		$id_espace=$_POST['id_espace'];
		$tab[]=$id;
		$acteurs_supprimer=array();
		//Verification des modifications des acteurs
		$sql="SELECT id_acteur FROM acteurs_espace WHERE id_espace='$id_espace'"; //On récupère toutes les personnes qui étaient concernés par l'espace
		$req= $bdd->executer($sql);
		$personnes=mysql_fetch_row($req);
		while($personnes){
			$tab_old[]=$personnes[0]; //on stocke toutes les personnes concernés par l'espace dans un tableau
			$personnes=mysql_fetch_row($req);
		}
		$acteurs_supprimer = array();
		foreach($tab_old as $id_old){ //on teste si toutes les personnes qui étaient préalablement concernés par l'espace existe dans le nouveau tableau
			if(in_array($id_old, $tab)){
				
			}else{
				//Personnes supprimés
				$acteurs_supprimer[]=$id_old;
			}
		}
		$acteurs_ajouter = array();
		
		foreach($tab as $id_new){ //on teste si toutes les personnes qui sont selectionnées dans la modification de l'espace existait avant la modification
			if(in_array($id_new, $tab_old)){
				
			}else{
				//Personnes ajoutés
				$acteurs_ajouter[]=$id_new;
			}
		}
		$acteurs_inchanger = array();
		foreach($tab_old as $id_old){ //on recherche tous les acteurs inchangés pour leur envoyer un message si le titre de l'espace a changé
			if(in_array($id_old, $acteurs_supprimer)){
				
			}else{
				//Personnes ajoutés
				if($id_old!=$id){
					$acteurs_inchanger[]=$id_old;
				}
			}
		}
		
		$tabEnvoi = array();
		foreach($acteurs_ajouter as $var){
			if(in_array($var, $tabEnvoi)){
				
			}else{
				$tabEnvoi[]=$var;
			}
		}
		$msg= new Message(0);
		$msg->objet=addslashes("Vous avez été ajouté à l'espace : ".$nom_espace);
		$msg->message=addslashes("Vous avez été ajouté à l'espace : ".$nom_espace.".\n
					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.");
		$msg->id_usager=$id;
		$msg->insert($tabEnvoi); //on envoit ce message a toutes les personnes sélectionnés pour la création de l'espace


		$tabEnvoi=array();
		foreach($acteurs_supprimer as $var){
			if(in_array($var, $tabEnvoi)){
				
			}else{
				$tabEnvoi[]=$var;
			}
		}
		$msg= new Message(0);
		$msg->objet=addslashes("Vous avez été supprimé de l'espace : ".$nom_espace);
		$msg->message=addslashes("Vous avez été supprimé de l'espace : ".$nom_espace.".\n
					Contacter le créateur de l'espace pour de plus amples informations.");
		$msg->id_usager=$id;
		$msg->insert($tabEnvoi); //on envoit ce message a toutes les personnes sélectionnés pour la création de l'espace
		
		
		
		$tabEnvoi=array();
		foreach($acteurs_inchanger as $var){
			if(in_array($var, $tabEnvoi)){
				
			}else{
				$tabEnvoi[]=$var;
			}
		}

		$sql="SELECT nom_espace FROM espace WHERE id_espace='$id_espace'"; //On récupère toutes les personnes qui étaient concernés par l'espace
		$req= $bdd->executer($sql);
		$titre_espace=mysql_fetch_row($req);
		if($titre_espace[0]!=$nom_espace){
			$msg= new Message(0);
			$msg->objet=addslashes("Modification de l'espace : ".$titre_espace[0]);
			$msg->message=addslashes("L'espace ".$titre_espace[0]." a changé de nom en ".$nom_espace.".");
			$msg->id_usager=$id;
			$msg->insert($tabEnvoi); //on envoit ce message a toutes les personnes inchangé de l'espace pour les prévenir de la modification du nom de l'espace
		}

		$sql="UPDATE espace SET nom_espace='$nom_espace' WHERE id_espace='$id_espace' AND id_createur_espace='$id'";
		$req = $bdd->executer($sql);
		
		$sql="DELETE FROM acteurs_espace WHERE id_espace='$id_espace'";
		$req = $bdd->executer($sql);
	}else{
		//CREATION DE LESPACE
		/*REQUETES GLOBALES AUX BOUCLES PRECEDENTES*/
		$date=date("Y-m-d H:i:s");
		//Requete d'ajout dans la table : 'espace' a partir des données $nom_espace, $id
		//Table espace : id_espace - nom_espace - id_createur_espace - date_creation_espace
		//mysql_query("INSERT INTO espace (nom_espace, id_createur_espace, date_creation_espace) VALUES ('$nom_espace', '$id', '$date')");
		$sql="INSERT INTO espace (nom_espace, id_createur_espace, date_creation_espace) VALUES ('$nom_espace', '$id', '$date')";
		
		$req = $bdd->executer($sql);
		$id_espace=mysql_insert_id();
		$tabEnvoi=array();
		
		foreach($tab as $var){
			if(in_array($var, $tabEnvoi)){
				
			}else{
				$tabEnvoi[]=$var;
			}
		}
		$msg= new Message(0);
		$msg->objet=addslashes("Vous avez été ajouté à l'espace : ".$nom_espace);
		$msg->message=addslashes("Vous avez été ajouté à l'espace : ".$nom_espace.".\n
					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.");
		$msg->id_usager=$id;
		$msg->insert($tabEnvoi); //on envoit ce message a toutes les personnes sélectionnés pour la création de l'espace
		//!\\ voir pour pas envoyer deux fois le même message si selectionné deux fois.
	}
	//Requete d'ajout dans la table : 'acteurs_espace' a partir du tableau tab[] stockant les id des acteurs concernés
	//Table acteurs_espace : id_espace - id_acteur - nouveaute_espace
	$sql="DELETE FROM acteurs_espace WHERE id_espace='$id_espace' AND id_acteur='$id'";
	$req = $bdd->executer($sql);
	
	$sql="INSERT INTO acteurs_espace (id_espace, id_acteur, nouveaute_espace) VALUES ('$id_espace', '$id', '1')";
	$req = $bdd->executer($sql);
	
	if(isset($tab)){
		foreach($tab as $value){
			$sql="DELETE FROM acteurs_espace WHERE id_espace='$id_espace' AND id_acteur='$value'";
			$req = $bdd->executer($sql);
			//mysql_query("INSERT INTO acteurs_espace (id_espace, id_acteur, nouveaute_espace) VALUES ('$id_espace', '$value', '1')");
			$sql="INSERT INTO acteurs_espace (id_espace, id_acteur, nouveaute_espace) VALUES ('$id_espace', '$value', '1')";
			$req = $bdd->executer($sql);
		}
	}
	
	//redirection vers le bon espace de partage
	header("Location:consult_espace.php");
}else{
	//redirection vers la création de l'espace pour resaisir le titre
	header("Location:consult_espace.php?cmd=creer_espace");
}
?>