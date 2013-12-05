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
require_once($LEA_REP."modele/bdd/classe_usager.php");
/***********************************************************/

class Maitre_apprentissage extends Usager{

	var $id_ma;
	var $id_entr;

	function Maitre_apprentissage($id_ma) {
		$this->id_ma = $id_ma;
		$this->bdd = new Connexion_BDD_LEA();
		$this->id_usager=$id_ma;
	}

	/****************** les méthodes ******************************/
	/* Cette fonction parmet d'enregistrer ce maitre d'apprentissaget dans la base */

	function insert($display_error = 1) {
			
		$result = parent::insert($display_error);
			
		if ($result) {
			$sql="INSERT INTO les_maitres_apprentissage(id_ma, id_entr)
			   VALUES('$this->id_usager', '$this->id_entr')"; 

			$result = $this->bdd->executer($sql, $display_error);
			$this->id_ma=$this->id_usager;

			if(! $result) {
				parent::delete_usager();
				$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de $this->civilite $this->nom $this->prenom ";
				$this->bdd->erreurs[] = mysql_error();
			}
		}
		return $result;
	}

	function insert2($display_error = 1) {
		$sql="INSERT INTO les_maitres_apprentissage(id_ma, id_entr)
			   VALUES('$this->id_usager', '$this->id_entr')"; 
			
		$result = $this->bdd->executer($sql, $display_error);
		$this->id_ma=$this->id_usager;

		if(! $result)   parent::delete_usager();

	}

	/* Cette fonction met à jour les coordonnées de  ce maitre d'apprentissage */ 

	function update($display_error = 1) {
		$result = parent::update($display_error);
			
		if ($result) {
			$sql="UPDATE les_maitres_apprentissage
		       SET  id_entr='$this->id_entr'			
		       WHERE id_ma='$this->id_ma'";

			$result = $this->bdd->executer($sql, $display_error);
			if (!$result) {
				$this->bdd->erreurs[] = "Une erreur est survenue lors de la mise a jour de $this->civilite $this->nom $this->prenom ";
				$this->bdd->erreurs[] = mysql_error();
			}
		}
		return $result;

	}
	function update2($display_error = 1) {

			
		$sql="UPDATE les_maitres_apprentissage
		       SET  id_entr='$this->id_entr'			
		       WHERE id_ma='$this->id_ma'";

		$result = $this->bdd->executer($sql, $display_error);

	}

	/* Cette fonction renvoit la liste des identifiants des apprentis de la formation $id_for
	 suivi par ce  maitre d'apprentissage frequentant l'unité d'identifiant $id_unite 
	 si $id_unite = 0 . elle renvoit tous les apprentis (unité confondue.)
	 */

	function get_id_apprentis($id_unite='0') {


		if($id_unite != 0) {

		 $sql = "SELECT  id_app
			  	 FROM les_apprentis A, les_classes C, les_formations F
			   	 WHERE  A.id_ma ='$this->id_ma' 
			   			and A.id_cla=C.id_cla 
						and C.id_for=F.id_for
			   			and F.id_unite = '$id_unite'";			   		 	 
		}
		else {
			$sql = "SELECT  id_app
			  		FROM les_apprentis
			   		WHERE id_ma ='$this->id_ma'
					"; 
		}
			
		$result = $this->bdd->executer($sql);
			
		$les_id_apprentis = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$les_id_apprentis[] = $ligne['id_app'];
		}
		return $les_id_apprentis;
	}


	/*
	 Cette fonction renvoit la liste des apprentis de la formation d'identifiant $id_for
	 suivi par ce maître d'apprentissage
	 */

	function get_apprentis_form($id_for=0) {


		$sql = "SELECT  id_app
			  	 FROM les_apprentis A, les_classes C
			   	 WHERE  A.id_ma ='$this->id_ma' 
			   			and A.id_cla=C.id_cla 						
			   			and C.id_for = '$id_for'";			   		 	 
			
		$result = $this->bdd->executer($sql);
			
		$les_apprentis = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$apprenti = new Apprenti($ligne['id_app']);
			$apprenti->set_detail();
			$les_apprentis[] = $apprenti;
		}
			
		return $les_apprentis;
	}

	/*
	 Cette fonction renvoit la liste des formations ayant un au moins un apprenti suivi
	 par ce maître d'apprentissage
	 */

	function get_formations() {


		$sql = "SELECT distinct(C.id_for)
			  	 FROM 	les_apprentis A, les_classes C
			   	 WHERE  A.id_ma ='$this->id_ma' 
			   			and A.id_cla=C.id_cla 						
			   	";			   		 	 
			
		$result = $this->bdd->executer($sql);
			
		$les_formations = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$formation = new Formation ($ligne['id_for']);
			$formation->set_detail();
			$les_formations[] = $formation;
		}
			
		return $les_formations;
	}

	/*
	 Cette fonction 1 si ce maitre d'apprentiusage suit au moins un apprenti de
	 la formation d'identifiant $id_for
	 */

	function suivi_app_for($id_for=0) {


		$sql = "SELECT A.id_app
			  	 FROM 	les_apprentis A, les_classes C
			   	 WHERE  A.id_ma ='$this->id_ma' 
			   			and A.id_cla=C.id_cla 						
						and C.id_for='$id_for'
			   	";			   		 	 
			
		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {
			return 1;
		}
		else  return 0;
	}


	/* Cette fonction renvois l'entreprise du maitre_apprentissage*/

	function get_entreprise() {

		$sql="SELECT MA.id_entr, E.nom
				FROM les_maitres_apprentissage MA, les_entreprises E
				WHERE MA.id_entr= E.id_entr and id_ma = '$this->id_ma' 
				"; 					 

		$result = $this->bdd->executer($sql);

		$entreprise =  new Entreprise(0);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			$entreprise->id_entr = $ligne['id_entr'];
			$entreprise->nom = $ligne['nom'];
		}
		return  $entreprise;
	}

	/* Cette fonction  permet de fixer tous les attributs de la classe maitre apprentissage  */

	function set_detail(){

		parent::set_detail(); // fixer les attribus en tantque usager
			
		$sql="SELECT id_entr
			   FROM les_maitres_apprentissage 
			   WHERE id_ma='$this->id_ma'";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			$this->id_entr=$ligne['id_entr'];
		}
	}

	function is_maitre_apprentissage() {
		return true;
	}

	/* Setter de l'ID */
	function set_id($id) {
		$this->id_ma = $id;
	}

	/* Getter de l'ID */
	function get_id() {
		return $this->id_ma;
	}

	/**
	 * Fonction permettant de personnaliser l'affichage de l'objet
	 */
	public function __toString() {
		return "Maitre d'apprentissage ".parent::__toString();
	}

}//fin de classe
?>