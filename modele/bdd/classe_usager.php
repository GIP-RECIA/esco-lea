<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 03/08/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/classe_message.php");
require_once ($LEA_REP."modele/bdd/classe_unite_pedagogique.php");

/***********************************************************/
class Usager {

	var $id_usager;
	var $civilite;
	var $nom;
	var $prenom;
	var $adresse;
	var $tel_fixe;
	var $tel_mobile;
	var $email;
	var $url_site;
	var $profil;
	var $date_creation;
	var $date_derniere_connexion;
	var $nombre_connexions;
	var $mode_acces;  //  0: accès bloqué, 1: accès: daté par date_debut_accès et date_fin_accès , 2: accès illimité
	var $date_debut_acces;
	var $date_fin_acces;
	var $login="";
	var $mdp="";
	var $bdd; 	  // objet de connexion à la base de données
	var $erreurs;

	function Usager($id_usager=0) {

		$this->id_usager = $id_usager;
		$this->bdd = new Connexion_BDD_LEA();
	}

	/****************** les méthodes ******************************/

	/* Cette fonction permet d'enregistrer cet usager dans la base */

	function insert($display_error = 1) {

		$sql="INSERT INTO les_usagers(id_usager, civilite, nom, prenom, adresse,
		 								tel_fixe, tel_mobile, email, url_site, 
										profil, date_creation, date_derniere_connexion,
										nombre_connexions, mode_acces, ".
		($this->date_debut_acces?"date_debut_acces, ":"").
		($this->date_fin_acces?"date_fin_acces, ":"").
										" login, mdp)
			   VALUES(NULL, '$this->civilite', '".addslashes($this->nom)."', '".addslashes($this->prenom)."', '".addslashes($this->adresse)."',
			    	'$this->tel_fixe', '$this->tel_mobile', '$this->email',
					'$this->url_site', '$this->profil', CURDATE(), NULL,'0',
					'$this->mode_acces', ".($this->date_debut_acces?"'$this->date_debut_acces', ":"").
		($this->date_fin_acces?"'$this->date_fin_acces', ":"")." '$this->login', '".addslashes($this->mdp)."' )";

		$result = $this->bdd->executer($sql, $display_error);
			
		if (!is_array($this->erreurs)) $this->erreurs = array();
			
		if($result) {
			$this->id_usager = mysql_insert_id();
			$this->mail_mdp();
		}
		else {
			$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de $this->civilite $this->nom $this->prenom ";
			$this->bdd->erreurs[] = mysql_error();
		}
			
		return $result;
	}

	/* Cette fonction  met à jour les coordonnées de  cet usager */ 

	function update($display_error = 1) {
		$sql="UPDATE les_usagers
		       SET  civilite='$this->civilite', 
			   		nom='".addslashes($this->nom)."', 
					prenom='".addslashes($this->prenom)."', 
			        adresse='".addslashes($this->adresse)."', 
					tel_fixe='$this->tel_fixe', 
					tel_mobile='$this->tel_mobile', 
					email='$this->email', 
					url_site='$this->url_site', 
					profil='$this->profil',
					mode_acces='$this->mode_acces', 
					date_debut_acces='$this->date_debut_acces',
					date_fin_acces='$this->date_fin_acces',										
					login='$this->login', 
					mdp='".addslashes($this->mdp)."'
		       WHERE id_usager='$this->id_usager'"; 
			
		$result = $this->bdd->executer($sql, $display_error);
		if($result) $this->mail_mdp();
		else  {
			$this->bdd->erreurs[] = "Une erreur est survenue lors de la mise à jour de $this->civilite $this->nom $this->prenom ";
			$this->bdd->erreurs[] = mysql_error();
		}
		return $result;
	}

	/*
	 Cette fonction  met à jour la trace de connexion de l'usager, elle mét à jour 
	 le nombre de connexion ainsi sa date de la dernière connexion au lea

	 */

	function update_connexion() {

		$sql="UPDATE les_usagers
		       SET  
					nombre_connexions = nombre_connexions +1,
					date_derniere_connexion = CURRENT_TIMESTAMP()					 
		       WHERE id_usager='$this->id_usager'"; 
			
		$result = $this->bdd->executer($sql);
			
	}

	/*
	 Cette fonction  met à jour l'attribut $attribut cet usager
	 */

	function update_attribut($attribut, $valeur) {

		$sql="UPDATE les_usagers
		       SET  
		       $attribut = '$valeur'
		       WHERE id_usager='$this->id_usager'"; 
       $result = $this->bdd->executer($sql);

	}

	/*
	 Cette fonction  renvoit la valeur de l'attribut $attribut de cette usager
	 */

	function get_valeur_attribut($attribut) {

		$sql="SELECT   $attribut
				 FROM  les_usagers 
				 WHERE id_usager = '$this->id_usager'  ";	   		   

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {

			return $ligne[$attribut];

		}
		else return "";
			
	}

	/* Cette fonction permet de supprimer cet usager de la base */

	function delete_usager() {
			
		global $LEA_REP;
			
		$this->set_detail();
			
		if($this->profil == 'app') {
			$apprenti = new Apprenti($this->id_usager);
			$apprenti->set_detail();
			$apprenti->delete_parent();
			$apprenti->delete_documents_apprenti();

		}
			
		// suppression de fichiers joints avec les message de cet usager

		$sql = "SELECT  fichier_joint
				FROM	les_messages
			    WHERE id_usager = '$this->id_usager'"; 			 

		$result = $this->bdd->executer($sql);
			
		while($ligne = mysql_fetch_assoc($result)) {

			if(file_exists($LEA_REP.'documents/fichiers_joints_msg/'.$ligne['fichier_joint']))
			@unlink($LEA_REP.'documents/fichiers_joints_msg/'.$ligne['fichier_joint']);

		}
			
		// suppression de son images d'accueil

		$sql = "SELECT  img_accueil
				FROM	les_usagers
			    WHERE id_usager = '$this->id_usager'"; 			 

		$result = $this->bdd->executer($sql);
			
		if($ligne = mysql_fetch_assoc($result)) {

			if(file_exists($LEA_REP.'images/img_accueil/'.$ligne['img_accueil']))
			@unlink($LEA_REP.'images/img_accueil/'.$ligne['img_accueil']);

		}
			
		// suppression de ses documents partagés

		$sql = "SELECT  id_espace_partage, nom_fichier , lien_id_espace
				FROM	espace_partage
			    WHERE 	id_auteur_espace_partage = '$this->id_usager'"; 			 

		$result = $this->bdd->executer($sql);
			
		while($ligne = mysql_fetch_assoc($result)) {

			$fichier = $ligne['lien_id_espace'].'_'.$ligne['id_espace_partage'].'_'.$ligne['nom_fichier'];

			if(file_exists($LEA_REP.'espace_de_partage/fichiers/'.$fichier))
			@unlink($LEA_REP.'espace_de_partage/fichiers/'.$fichier);

		}
			
		// suppression de l'usager
		$sql = "DELETE FROM les_usagers where id_usager='$this->id_usager'";
		$result = $this->bdd->executer($sql);

	}

	/* Cette fonction  teste si cet usager est déjà enregistré sur la base. Si oui, elle renvoit 1
	 sinon elle envoit 0 */

	function existe(){

		$sql="SELECT id_usager
				 FROM  les_usagers 
				 WHERE nom='$this->nom' and prenom='$this->prenom' and profil='$this->profil' ";	   		   

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {
			$this->id_usager = $ligne['id_usager'];
			return 1;
		}
		else return 0;
			
	}


	/* Cette fonction  renvoit un tableau contenant tous les messagess reçus par cet usager */ 

	function get_messages_recus($pos=0,$nb=10){
			
		$sql="SELECT M.id_msg, M.objet,  M.message,  M.date_creation, M.id_usager, MR.lecture, MR.reponse
			   FROM les_messages_recus_usagers MR, les_messages M
			   WHERE MR.id_msg=M.id_msg and MR.id_usager='$this->id_usager'
			   ORDER BY M.date_creation DESC
			   LIMIT $pos, $nb";	   		   

		$result = $this->bdd->executer($sql);
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$msg = new Message($ligne['id_msg']);
			$msg->objet = $ligne['objet'];
			$msg->message = $ligne['message'];
			$msg->date_creation = $ligne['date_creation'];
			$msg->id_usager = $ligne['id_usager'];

			$msg->lecture = $ligne['lecture'];
			$msg->reponse = $ligne['reponse'];

			$les_messages[]=$msg;
		}
			
		if(isset($les_messages)) return $les_messages;
		else return NULL;
	}

	/* Cette fonction  renvoit le nombre de messages  réçus mais non lus cet usager */ 

	function get_nb_messages_non_lus(){
			
		$sql="SELECT COUNT(M.id_msg) as nb
			   FROM les_messages_recus_usagers MR, les_messages M
			   WHERE MR.id_msg=M.id_msg and MR.id_usager='$this->id_usager' and MR.lecture='NON' and MR.suppression='NON' and MR.dossier=''
			   ";	   		   

		$result = $this->bdd->executer($sql);
			
		$les_messages = array();
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne['nb'];
		}else return 0;
			
		$les_messages;
	}


	/* Cette fonction  renvoit le nombre de messages reçus par cet usager */ 

	function get_nb_messages_recus(){
			
		$sql="SELECT Count(M.id_msg) as nb
			   FROM les_messages_recus_usagers MR, les_messages M
			   WHERE MR.id_msg=M.id_msg and MR.id_usager='$this->id_usager'";
			
		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			return ($ligne['nb']);
		}
		else return 0;
	}

	/* Cette fonction  renvoit les unités pédagogiques dérigées par cet usager  */

	function get_unites(){
			
		$sql="SELECT A.id_unite, A.nom
			   FROM   les_unites_pedagogiques A , les_responsables_unites_pedagogiques B
			   WHERE  A.id_unite = B.id_unite and B.id_rvs ='$this->id_usager'";
			
		$result = $this->bdd->executer($sql);
			
		$les_unites = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$unite = new Unite_pedagogique($ligne['id_unite']);
			$unite->nom = $ligne['nom'];

			$les_unites[] = $unite;

		}
		return $les_unites;
	}

	/* Cette fonction  permet de fixer tous les attributs de la classe usager  */

	function set_detail(){
			
		$sql="SELECT civilite, nom, prenom, adresse, tel_fixe ,tel_mobile ,email,
		              url_site,profil, date_creation, date_derniere_connexion, 
					  nombre_connexions, mode_acces, date_debut_acces, 
					  date_fin_acces,login, mdp
			   FROM les_usagers 
			   WHERE id_usager='$this->id_usager'";	   		   

		$result = $this->bdd->executer($sql);
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$this->civilite=$ligne['civilite'];
			$this->nom=$ligne['nom'];
			$this->prenom=$ligne['prenom'];
			$this->adresse=$ligne['adresse'];
			$this->tel_fixe=$ligne['tel_fixe'];
			$this->tel_mobile=$ligne['tel_mobile'];
			$this->email=$ligne['email'];
			$this->url_site=$ligne['url_site'];
			$this->profil=$ligne['profil'];
			$this->date_creation = trans_date($ligne['date_creation']);
			$this->date_derniere_connexion = trans_date_time($ligne['date_derniere_connexion']);
			$this->nombre_connexions = $ligne['nombre_connexions'];
			$this->mode_acces = $ligne['mode_acces'];
			$this->date_debut_acces = $ligne['date_debut_acces'];
			$this->date_fin_acces = $ligne['date_fin_acces'];
			$this->login = $ligne['login'];
			$this->mdp = $ligne['mdp'];

		}
	}

	/*  Cette fonction permet denvoyer un email à cette usager pour lui communiquer son login et son mot de passe */
	function mail_mdp(){

		global $LEA_URL;
		global $AUTHENTIFICATION_CAS;

		if ($AUTHENTIFICATION_CAS) return 1;
		
		$destinataire = $this->email;
		$objet = 'Connexion LEA'; // Objet du message
		$headers  = 'Content-Type: text/plain; charset="UTF-8"' . "\r\n";

		$message = "Bonjour $this->civilite $this->prenom $this->nom \r\n
			Voici vos paramètres de connexion au LEA $LEA_URL \r\n
			Identifiant  : $this->login \r\n
			Mot de passe : $this->mdp
				";

		if (@mail($destinataire, $objet, $message, $headers)){ // Envoi du message
			return 1;
		}
		else return 0;
	}

	/* fonction permet de stocker dans le fichier log de cet usager le message msg */

	function update_log($msg)
	{
		global $LEA_REP;

		$rep = $LEA_REP.'log/';

		if(file_exists($rep.$this->id_usager.'.log')){
			$fp = fopen($rep.$this->id_usager.'.log', "a");
		}
		else {
			$fp = fopen($rep.$this->id_usager.'.log', "a");
			fwrite($fp, "********************************************************\r\n\r\n");
			fwrite($fp, "Fichier log de : ".$this->civilite." ".$this->nom." ".$this->prenom." du profil : ".$this->profil."\r\n\r\n");
			fwrite($fp, "********************************************************\r\n\r\n");
		}

		fwrite($fp, $msg);
	}

	/**
	 * Cette fonction teste si un login existe
	 * Elle renvoit l'id de l'usager s'il existe, 0 s'il n'existe pas et
	 * -1 s'il existe pour un profile different de celui passé en parametre
	 *
	 */
	function existe_login($login, $profil="") {
		$sqlProfil = ($profil != "") ? "profil regexp '^([^,]+,)*$profil(,.+)*$' " : "1";
			
		$sql="SELECT id_usager, ".$sqlProfil." as profil_ok FROM les_usagers where login = '$login'";
		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			$this->id_usager = $ligne['id_usager'];
			if ($ligne['profil_ok'] == 0) return -1;
			return $ligne['id_usager'];
		}
		return 0;
	}

	function delete_all_resp($id_usager){
		$sql="DELETE FROM les_sous_resp WHERE id_usager='$id_usager'";
		$result = $this->bdd->executer($sql);

	}

	function update_sous_resp($id_usager,$id_for, $display_error = 1){

	 $sql="update les_sous_resp
			SET id_for='$id_for'
			WHERE id_usager='$id_usager'"; 
	  
	 $result = $this->bdd->executer($sql, $display_error);
	 $this->id_ens = $this->id_usager;

	}

	function insert_sous_resp($id_usager,$id_for, $display_error = 1){

	 $sql="INSERT INTO les_sous_resp(id,id_usager,id_for)
			   VALUES('','$id_usager', '$id_for')"; 
	  
	 $result = $this->bdd->executer($sql, $display_error);
	 $this->id_ens = $this->id_usager;


	}
	
	function insert_sous_resp_herite($formations, $display_error=1){
		$this->insert($display_error);
		for($j=0;$j<sizeof($formations);$j++) {
			$this->insert_sous_resp($this->id_usager,$formations[$j]);
		}
		$this->set_id($this->id_usager);
			
	}
	

	function is_admin() {
		return preg_match("/admin/", $this->profil);
	}
	function is_enseignant() {
		return false;
	}
	function is_maitre_apprentissage() {
		return false;
	}
	function is_apprenti() {
		return false;
	}
	function is_representant_legal() {
		return false;
	}
	function set_id($id) {
		$this->id_usager = $id;
	}
	function get_id() {
		return $this->id_usager;
	}

	/*
	 * Insère l'objet en base de données s'il n'existe pas déjà, sinon met à jour.
	 * 
	 */
	function save($display_error = 1) {
		if ($this->get_id() > 0) {
			$this->update($display_error);
		} else {
			$this->insert($display_error);
		}
	}

	/*
	 * Fonction permettant de personnaliser l'affichage de l'objet
	 */
	public function __toString() {
		return "$this->nom $this->prenom ($this->login)"; 
	}
}// fin de la classe
?>
