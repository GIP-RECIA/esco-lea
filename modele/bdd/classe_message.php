<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 04/08/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."lib/libmail.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

/***********************************************************/

class Message{

	var $id_msg; 		  //identifiant du message
	var $objet;  		  // l'objet du message
	var $message;  		  // le contenu du message
	var $date_creation;   // date et l'heur de création du message
	var $fichier_joint;  // Le fichier jont à ce message
	var $id_usager;  	  // l'usager ayant créé ce message
	var $destinataire;	  // receveur

	var $bdd; 	  		  // objet de connexion à la base de données
	var $nature;		  // nature : important | fichier | dossier
	var $dossier;	 	  // dossier du message

	var $lecture;    	  // égale OUI si ce message est déjà lu
	var $reponse;    	  // égale OUI si l'usager recevant ce message a répondu à l'expediteur
	var $suppression;	  // égale OUI si l'usager a supprimé le message (celui-ci se trouve dans la corbeille)

	function Message($id_msg = 0) {
		$this->id_msg = $id_msg;
		$this->bdd = new Connexion_BDD_LEA();
	}

	/****************** les méthodes ******************************/
	/*
	 Cette fonction permet de stocker ce message envoyé 
	 */

	function insert($les_id_usager_dest){

		$sql = "INSERT INTO les_messages(id_msg, objet, message, date_creation, fichier_joint, id_usager, dossier, nature)
		   		 VALUES('','$this->objet', '$this->message', CURRENT_TIMESTAMP() ,'$this->fichier_joint','$this->id_usager','$this->dossier','$this->nature')";
			
		$result = $this->bdd->executer($sql);
		$this->id_msg=mysql_insert_id();
			
		if(count($les_id_usager_dest) > 0) {

			$sql="INSERT INTO les_messages_recus_usagers( id_msg , id_usager , lecture, dossier)
			 		VALUES "; 

			$virgule = "";

			foreach($les_id_usager_dest as $id_usager_dest) {

				$sql.=" $virgule ( '$this->id_msg' , '$id_usager_dest' , 'NON'";
				$sql.=", '$this->dossier')";		
				$virgule = ",";
			}
			$result = $this->bdd->executer($sql);
		}
			
			

	}
	function envoyer_mail($dest, $id_from, $sujet, $message)
	{
		global $LEA_REP;
		$adressdest = "";
		foreach($dest as $id_dest) {
			$sql="select email from les_usagers where id_usager='$id_dest'";
			$result=$this->bdd->executer($sql);

      while ($ligne = mysql_fetch_assoc($result))
      {
      	$email = $ligne['email'];
        if(trim($email) != '') 
        {
        	$adressdest = $adressdest.$sep.$email.", ";
        }
      }

		}
			
		$sql="select email from les_usagers where id_usager='$id_from'";
		$result=$this->bdd->executer($sql);
			
		while ($ligne = mysql_fetch_assoc($result))
		{
			$adressfrom=$ligne['email'];
		}

		if (isset($adressdest) && $adressdest != "")
		{
			$mail= new Mail; // create the mail
			$mail->checkAddress = false;
			$mail->From( $adressfrom );
			$mail->To( $adressdest );
			$mail->Subject( $sujet );
			$mail->Body( $message, "utf-8" );	
			if (!empty($this->fichier_joint)) $mail->Attach($LEA_REP.'documents/fichiers_joints_msg/'.$this->fichier_joint);
			
			if($mail->Send()) {
				echo 'Le mail a bien été envoyé';
			} else {
				echo 'Le mail n\'a pas pu être envoyé';
			}
		}
		else echo 'Le destinataire n\'a pas d\'adresse mail valide, le mail n\'a pas pu être envoyé';
	}

	/* Cette fonction  permet de supprimer le message de la base de données*/ 

	function delete(){

		global $LEA_REP;
		$rep_fichier_joint = $LEA_REP.'documents/fichiers_joints_msg/';
			
		$this->set_detail();
			
		$sql = "DELETE FROM les_messages
				 WHERE id_msg='$this->id_msg'";				
		$result = $this->bdd->executer($sql);
			
		// suppression du fichier joint
			
		if (file_exists($rep_fichier_joint.$this->fichier_joint )) {

			@unlink($rep_fichier_joint.$this->fichier_joint);
		}

	}

	/* Cette fonction  permet de supprimer le lien entre ce message et l'usager d'identifiant $id_usager*/

	function delete_message_recu($id_usager){

		$sql="DELETE FROM les_messages_recus_usagers
				 WHERE id_msg='$this->id_msg' and id_usager='$id_usager'";	
		$result = $this->bdd->executer($sql);
			
		$sql="SELECT id_msg
		   		 FROM les_messages_recus_usagers		         
				 WHERE id_msg='$this->id_msg' ";		
		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) ; 	// le message est récu par autres usagers
		else $this->delete();
			
	}

	/* Cette fonction permet de modifier le statut de lecture de ce message par l'usager $id_usager*/

	function update_lecture($id_usager){

		$sql="UPDATE les_messages_recus_usagers
		   		 SET lecture='OUI'		         
				 WHERE id_msg='$this->id_msg' and id_usager='$id_usager'";				
		$result = $this->bdd->executer($sql);
		$this->lecture = 'OUI';
	}

	/* Cette fonction permet de modifier le statut de reponse à ce message par l'usager $id_usager*/ 

	function update_reponse($id_usager){

		$sql="UPDATE les_messages_recus_usagers
		   		 SET reponse='OUI'		         
				 WHERE id_msg='$this->id_msg' and id_usager='$id_usager'";				
		$result = $this->bdd->executer($sql);
		$this->reponse = 'OUI';
	}

	/* Modifie l'état du message */

	function update_suppression($id_usager, $recuperer = false)
	{
		if ($recuperer)
		{
			$sql = "UPDATE les_messages_recus_usagers
						SET suppression='NON'
						WHERE id_msg='$this->id_msg' and id_usager='$id_usager'";
			$result = $this->bdd->executer($sql);
			$this->suppression = 'NON';
		}
		else
		{
			$sql = "UPDATE les_messages_recus_usagers
						SET suppression='OUI'		         
						WHERE id_msg='$this->id_msg' and id_usager='$id_usager'";				
			$result = $this->bdd->executer($sql);
			$this->suppression = 'OUI';
		}
	}

	/* Change le dossier */

	function changer_dossier($cible, $id_usager)
	{
		$sql = "UPDATE les_messages_recus_usagers
				SET dossier='$cible'
				WHERE id_msg='$this->id_msg' and id_usager='$id_usager'";
		$result = $this->bdd->executer($sql);
		$this->dossier = $cible;
	}

	/* Cette fonction  permet de fixer tous les attributs de la classe message */

	function set_detail($id_dest = null){
			
		$sql="SELECT id_msg, objet, message, date_creation, fichier_joint, id_usager, nature, dossier
		       FROM les_messages
			   WHERE  id_msg='$this->id_msg'";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			$this->objet = $ligne['objet'];
			$this->message = $ligne['message'];
			$this->date_creation = $ligne['date_creation'];
			$this->fichier_joint = $ligne['fichier_joint'];
			$this->id_usager = $ligne['id_usager'];
			$this->nature= $ligne['nature'];
			$this->dossier= $ligne['dossier'];
		}

		$sql = "SELECT id_usager, lecture, reponse, suppression, dossier FROM les_messages_recus_usagers WHERE id_msg ='$this->id_msg'";
		if ($id_dest != null) {
			$sql .= " and id_usager = '$id_dest'";
		}
		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result))
		{
			$this->destinataire = $ligne['id_usager'];
			$this->lecture = $ligne['lecture'];
			$this->reponse = $ligne['reponse'];
			$this->suppression = $ligne['suppression'];
			if ($this->nature != 'dossier') $this->dossier= $ligne['dossier'];
		}
		while ($ligne = mysql_fetch_assoc($result)) {
			$this->destinataire = $this->destinataire.",".$ligne['id_usager'];
		}
	}

	/* Cette fonction teste si ce  message est adressé à l'usager d'identifiant $id_usager*/ 
	function recu_par($id_usager){
			
		$sql="SELECT id_usager
		       FROM les_messages_recus_usagers
			   WHERE  id_msg='$this->id_msg' and id_usager='$id_usager'";	   		   

		$result =  $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) return 1;
		else return 0;
	}

	/* Cette fonction teste si ce  message a été envoyé par l'usager d'identifiant $id_usager*/ 
	function envoye_par($id_usager){
		$sql="SELECT id_usager FROM les_messages WHERE id_msg='$this->id_msg' and id_usager='$id_usager'";
		$result =  $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) return 1;
		else return 0;
	}
	
}
?>
