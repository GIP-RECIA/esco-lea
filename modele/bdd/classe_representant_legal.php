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
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");

/***********************************************************/

class Representant_legal extends Usager{

	var $id_rl;
	var $profession;
	var $adresse_prof;

	function Representant_legal($id_rl) {
		$this->id_rl = $id_rl;
		$this->bdd = new Connexion_BDD_LEA();
		$this->id_usager = $id_rl;
	}

	/****************** les méthodes ******************************/

	/* Cette fonction parmet d'enregistrer ce représentant légal dans la base */ 

	function insert($display_error = 1) {
			
		$result = parent::insert($display_error);
			
		if ($result) {
			$sql="INSERT INTO les_representants_legaux(id_rl, profession, adresse_prof )
			   VALUES('$this->id_usager', '$this->profession', '$this->adresse_prof')"; 

			$result = $this->bdd->executer($sql, $display_error);
			$this->id_rl=$this->id_usager;

			if (!$result) {
				parent::delete_usager();
				$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de $this->civilite $this->nom $this->prenom ";
				$this->bdd->erreurs[] = mysql_error();
			}
		}
		return $result;
	}

	/* Cette fonction met à jour les coordonnées de  ce maitre d'apprentissage */ 

	function update($display_error = 1) {

		$result  =parent::update($display_error);
		if ($result) {
			$sql="UPDATE les_representants_legaux
		       SET  profession='$this->profession', adresse_prof='$this->adresse_prof' 			
		       WHERE id_rl='$this->id_rl'";			   			    					   		   
			$result = $this->bdd->executer($sql, $display_error);
			if (!$result) {
				$this->bdd->erreurs[] = "Une erreur est survenue lors de la mise a jour de $this->civilite $this->nom $this->prenom ";
				$this->bdd->erreurs[] = mysql_error();
			}
		}
		return $result;
	}

	/*
	 Cette fonction renvoit la liste des identifiants des apprentis représentés 
	 par ce parent frequentant l'unité d'identifiant $id_unite
	  
	 si $id_unite = 0 . elle renvoit tous les apprentis (unité confondue.)
	 */

	function get_id_apprentis($id_unite = 0) {

		if($id_unite != 0) {

		 $sql = "SELECT  id_app
			  	 FROM les_apprentis A, les_classes C, les_formations F
			   	 WHERE  A.id_rl ='$this->id_rl' 
			   			and A.id_cla=C.id_cla 
						and C.id_for=F.id_for
			   			and F.id_unite = '$id_unite'";			   		 	 
		}
		else {

			$sql = "SELECT  id_app
			  		FROM les_apprentis
			   		WHERE id_rl ='$this->id_rl'
					"; 

		}
			
		$result = $this->bdd->executer($sql);
			
		$les_id_apprentis = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_apprentis[] = $ligne['id_app'];
		}
			
		return $les_id_apprentis;
	}

	/* Cette fonction permet de tester si cet parent suit l'apprenti d'identifiant id_app*/

	function est_parent($id_app) {

		$sql="SELECT id_app
				FROM les_apprentis 
				WHERE id_rl = '$this->id_rl' and id_app = '$id_app'
				"; 					 

		$result = $this->bdd->executer($sql);
		if (mysql_num_rows($result)>= 1) return 1;
		else return 0;
	}

	/* Cette fonction  permet de fixer tous les attributs de la classe maitre apprentissage  */

	function set_detail(){

	 parent::set_detail(); // fixer les attribus en tantque usager
	  
	 $sql="SELECT  profession, adresse_prof
			   FROM les_representants_legaux 
			   WHERE  id_rl='$this->id_rl'";	   		   

	 $result = $this->bdd->executer($sql);
	  
	 if ($ligne = mysql_fetch_assoc($result)) {

	 	$this->profession=htmlentities($ligne['profession'],ENT_QUOTES, "UTF-8");
	 	$this->adresse_prof=htmlentities($ligne['adresse_prof'],ENT_QUOTES, "UTF-8");

	 }
	}

	function is_representant_legal() {
		return true;
	}

	/* Setter de l'ID */
	function set_id($id) {
		$this->id_rl = $id;
	}

	/* Getter de l'ID */
	function get_id() {
		return $this->id_rl;
	}

	/**
	 * Fonction permettant de personnaliser l'affichage de l'objet
	 */
	public function __toString() {
		return "Représentant légal ".parent::__toString();
	}

}//fin de classe
?>