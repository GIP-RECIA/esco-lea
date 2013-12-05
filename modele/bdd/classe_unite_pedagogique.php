<?php

/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 11/08/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");


require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/

class Unite_pedagogique{

	var $id_unite;
	Var $nom;
	var $adresse;
	var $email;
	var $tel_fixe1;
	var $tel_fixe2;
	var $fax;
	var $url_site;
	var $nom_contact;          // Le nom de la personne à contacter	
	var $prenom_contact;
	var $bdd;                 // objet de connexion à la base de données

	function Unite_pedagogique($id_unite) {
		$this->id_unite = $id_unite;
		$this->bdd = new Connexion_BDD_LEA();
	}

	/****************** les méthodes ******************************/

	/*
	 * Cette fonction  pemet d'enregistrer cette unité dans la bases de données. 
	 */
	function insert($display_error = 1){

		$sql="INSERT INTO
		   				les_unites_pedagogiques(
								id_unite, 
								nom, 
								adresse, 
								email, 
		   						tel_fixe1,
								tel_fixe2, 
								fax, 
								url_site, 
								nom_contact, 
								prenom_contact)
		         VALUES (		'', 
				 				'$this->nom', 
								'$this->adresse', 
								'$this->email',
				     		    '$this->tel_fixe1' , 
								'$this->tel_fixe2',
								'$this->fax', 
						 		'$this->url_site', 
								'$this->nom_contact',
								'$this->prenom_contact'
						)
				 ";

		$result = $this->bdd->executer($sql, $display_error);

		if($result) {
			$this->id_unite = mysql_insert_id(); // l'identifiant de l'unité créée
		} else {
			$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de $this->civilite $this->nom $this->prenom ";
			$this->bdd->erreurs[] = mysql_error();
		}
		return $result;
	}

	/*
	 * Cette fonction  permet de mettre à jour les coordonnées de cette unite  ainsi la liste des
	 * responsables vies scolaire de cette unité.
	 */
	function update($display_error = 1){

		$sql="UPDATE les_unites_pedagogiques
		         SET  nom = '$this->nom', 
				 	  adresse = '$this->adresse', 
					  email = '$this->email',
				      tel_fixe1 = '$this->tel_fixe1' , 
					  tel_fixe2 = '$this->tel_fixe2', 
					  fax = '$this->fax' , 
					  url_site = '$this->url_site', 
					  nom_contact = '$this->nom_contact', 
					  prenom_contact = '$this->prenom_contact'
					  
				WHERE id_unite='$this->id_unite' 	  
				 ";

		$result = $this->bdd->executer($sql, $display_error);
		if(!$result) {
			$this->bdd->erreurs[] = "Une erreur est survenue lors de la mise à jour de $this->civilite $this->nom $this->prenom ";
			$this->bdd->erreurs[] = mysql_error();
		}
		
	}

	/*
	 * Cette fonction  permet de mettre à jour la liste des responsables vie scolaire
	 * de cette unité.	
	 */
	function update_reponsables($les_id_rvs = array()){

		$sql = "DELETE FROM les_responsables_unites_pedagogiques WHERE id_unite='$this->id_unite' ";
		$result = $this->bdd->executer($sql);
			
		foreach($les_id_rvs as $id_rvs){
			$sql = "INSERT INTO les_responsables_unites_pedagogiques (id_rvs, id_unite)
					VALUES($id_rvs, '$this->id_unite') ";
			$result = $this->bdd->executer($sql);
		}

	}

	/*
	 * Cette fonction  permet de supprimer  l'unite pédagogique de la base de données
	 */
	function delete(){

		$sql = "DELETE FROM les_unites_pedagogiques
				   WHERE id_unite='$this->id_unite'";				
		$result = $this->bdd->executer($sql);
			
	}

	/* 
	 * Cette fonction  permet de fixer tous les attributs de la classe unite *
	 */
	function set_detail(){
			
		$sql="SELECT *
		       FROM les_unites_pedagogiques
			   WHERE  id_unite= '$this->id_unite' ";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			$this->id_unite = $ligne['id_unite'];
			$this->nom = $ligne['nom'];
			$this->adresse = $ligne['adresse'];
			$this->email = $ligne['email'];
			$this->tel_fixe1 = $ligne['tel_fixe1'];
			$this->tel_fixe2 = $ligne['tel_fixe2'];
			$this->fax = $ligne['fax'];
			$this->url_site = $ligne['url_site'];
			$this->nom_contact = $ligne['nom_contact'];
			$this->prenom_contact = $ligne['prenom_contact'];

		}
	}

	/* 
	 * Cette fonction  renvoit la liste des identifiants des responsables vie solaire de cette unité 
	 */ 
	function get_id_responsables(){
			
		$sql = "SELECT id_rvs
		      	 FROM les_responsables_unites_pedagogiques
				 WHERE  id_unite = '$this->id_unite'  
			   ";	   		   

		$result = $this->bdd->executer($sql);
			
		$les_id_responsables = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_responsables[] = $ligne['id_rvs'];
		}
			
		return $les_id_responsables;
	}

	/* 
	 * Cette fonction  renvoit la liste des identifiant des formations gérées par cette unité 
	 */
	function get_id_formations(){
			
		$sql="SELECT id_for
		       FROM les_formations
			   WHERE  id_unite = '$this->id_unite'
			   AND id_for > 0 ";	   		   

		$result = $this->bdd->executer($sql);
			
		$les_id_formations = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_formations[] = $ligne['id_for'];
		}
			
		return $les_id_formations;
	}

	/* 
	 * Cette fonction renvoit un tableau contenant toutes les classes
	 *  de cette de cette unite 
	 */
	function get_classes() {
			
		$sql="SELECT C.id_cla, C.libelle
				 FROM  les_classes C, les_formations F
				 WHERE C.id_for=F.id_for and F.id_unite='$this->id_unite'
				 ORDER BY C.libelle ";	
			
		$result = $this->bdd->executer($sql);
			
		$les_classes = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$classe = new Classe($ligne['id_cla']);
			$classe->libelle = $ligne['libelle'];
			$les_classes[] = $classe;
		}
			
		mysql_free_result($result);
			
		return $les_classes;
	}

	/* 
	 * Cette fonction renvoit un tableau contenant la liste de tous les usagers de LEA de cette unité
	 * ayant pour profil $profil et un nom commence par  $mot_clé.
	 */
	function get_usagers($profil, $mot_cle="") {
			
		$sql="SELECT A.id_usager, A.civilite, A.nom, A.prenom, A.adresse, A.tel_fixe, A.tel_mobile,
		   				A.email, A.url_site, A.date_creation, A.date_derniere_connexion, 
						A.nombre_connexions
						";

		switch($profil) {

			case "app":
				$sql .= "FROM les_usagers A , les_apprentis B , les_classes C, les_formations D
				 		 WHERE A.id_usager = B.id_app and B.id_cla = C.id_cla and 
						 	   C.id_for = D.id_for and D.id_unite = '$this->id_unite'
						   and A.profil='app' and A.nom LIKE '$mot_cle%'		
						 ORDER BY nom"; 
				break;

			case "ens":
				$sql .= "FROM les_usagers A
				 		 WHERE A.profil='ens' and A.nom LIKE '$mot_cle%'		
			     		 ORDER BY nom"; 
				break;

			case "ma":
				$sql .= "FROM les_usagers A
				 		 WHERE A.profil='ma' and A.nom LIKE '$mot_cle%'		
			     		 ORDER BY nom"; 
				break;

			case "rl":
				$sql .= "FROM les_usagers A
				 		 WHERE A.profil='rl' and A.nom LIKE '$mot_cle%'		
			     		 ORDER BY nom"; 
				break;

			default  : 
				return array();
			break;
		}


		$result = $this->bdd->executer($sql);
		$les_usagers = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$usager = new Usager($ligne['id_usager']);
			$usager->civilite = $ligne['civilite'];
			$usager->nom = $ligne['nom'];
			$usager->prenom = $ligne['prenom'];
			$usager->adresse = $ligne['adresse'];
			$usager->tel_fixe = $ligne['tel_fixe'];
			$usager->tel_mobile = $ligne['tel_mobile'];
			$usager->email=$ligne['email'];
			$usager->url_site = $ligne['url_site'];
			$usager->date_creation = trans_date($ligne['date_creation']);
			$usager->date_derniere_connexion = trans_date_time($ligne['date_derniere_connexion']);
			$usager->nombre_connexions = $ligne['nombre_connexions'];

			$les_usagers[] = $usager;
		}
		return $les_usagers;

	}//fin de la fonction

	
	/**
	 * Cette fonction teste si une unité pédagogique existe
	 * Elle renvoit l'id de l'unité pédagogique si elle existe, 0 si elle n'existe pas 
	 */
	function existe_nom($nom) {
			
		$sql="SELECT id_unite FROM les_unites_pedagogiques where nom = '$nom'";
		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne['id_unite'];
		}
		return 0;
	}
	
	/**
	 * Fonction permettant de personnaliser l'affichage de l'objet
	 */
	public function __toString() {
		return "Unité pédagogique $this->nom";
	}
	
	/*
	 * Insère l'objet en base de données s'il n'existe pas déjà, sinon met à jour.
	 */
	function save($display_error = 1) {
		if ($this->id_unite > 0) {
			$this->update($display_error);
		} else {
			$this->insert($display_error);
		}
	}
	
}// fin de la classe

?>