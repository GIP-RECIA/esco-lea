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
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/

class Enseignant extends Usager{

	var $id_ens;
	var $discipline;

	function Enseignant($id_ens) {
		$this->id_ens = $id_ens;
		$this->bdd = new Connexion_BDD_LEA();
		$this->id_usager = $id_ens;
	}

	/****************** les méthodes ******************************/

	/* Cette fonction parmet d'enregistrer cet enseignant dans la base */

	function insert($display_error = 1) {
			
		$result = parent::insert($display_error);
			
		if ($result) {
			$sql="INSERT INTO les_enseignants(id_ens, discipline)
				   VALUES('$this->id_usager', '$this->discipline')"; 

			$result = $this->bdd->executer($sql, $display_error);
			$this->id_ens = $this->id_usager;
			if (!$result) {
				$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de $this->civilite $this->nom $this->prenom ";
				$this->bdd->erreurs[] = mysql_error();
			}
		}
		return $result;
	}

	function delete_all_ens($id_usager){
		$sql="DELETE FROM les_enseignants WHERE id_ens='$id_usager'";
		$result = $this->bdd->executer($sql);

	}
	function insert2($display_error = 1) {
			
		$sql="INSERT INTO les_enseignants(id_ens, discipline)
			   VALUES('$this->id_usager', '$this->discipline')"; 
			
		$result = $this->bdd->executer($sql, $display_error);
		$this->id_ens = $this->id_usager;

	}
	/* Cette fonction met à jour les coordonnées de  cet enseignant */ 

	function update($display_error = 1) {
		$result = parent::update($display_error);
			
		if ($result) {
			$result = $this->update2($display_error);
			if (!$result) {
				$this->bdd->erreurs[] = "Une erreur est survenue lors de la mise a jour de $this->civilite $this->nom $this->prenom ";
				$this->bdd->erreurs[] = mysql_error();
			}
		}
		return $result;
	}
	
	function update2($display_error = 1) {
		$sql="UPDATE les_enseignants
		       SET  discipline='$this->discipline'			
		       WHERE id_ens='$this->id_ens'";

		$result = $this->bdd->executer($sql, $display_error);
		return $result;
	}


	/*
	 Cette fonction renvoit la liste des identifiants des apprentis
	 suivis par cet enseignant qui sont dans l'unité d'identifiant id_unite
	 */

	function get_id_apprentis($id_unite='0') {

		$sql="SELECT  id_app
			   FROM les_apprentis A, les_classes C, les_formations F
			   WHERE A.id_ens ='$this->id_ens' and A.id_cla=C.id_cla and C.id_for=F.id_for";

		if($id_unite > 0)	  $sql.="  and F.id_unite = '$id_unite'" ;
			
		$result = $this->bdd->executer($sql);
			
		$les_id_apprentis = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_apprentis[] = $ligne['id_app'];
		}
			
		return $les_id_apprentis;
	}

	/* Cette fonction renvoit le nombre d'apprentis suivis par cet enseignant
	 */

	function get_nb_apprentis($id_unite='0') {
			
		$sql="SELECT  COUNT(id_app) nb
			   FROM les_apprentis A, les_classes C, les_formations F
			   WHERE A.id_ens ='$this->id_ens' and A.id_cla=C.id_cla and C.id_for=F.id_for";

		if($id_unite > 0)	  $sql.="  and F.id_unite = '$id_unite'" ;
			
		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			$nb = $ligne['nb'];
			return($nb);
		}
		else return 0;
	}

	/* Cette fonction permet de tester si l'enseignant est le responsable actuel
	 de la formation d'identifiant $id_for*/

	function est_responsable($id_for) {

		$sql="SELECT  id_for
			   FROM les_formations
			   WHERE id_for='$id_for' and id_ens=$this->id_ens ";	   		   

		$result = $this->bdd->executer($sql);
			
		if (mysql_num_rows($result)>= 1) return 1;
		else return 0;
	}
	
	function est_sous_responsable($id_for,$id_usager) {

		$sql="SELECT  id_for
			   FROM les_sous_resp
			   WHERE id_for='$id_for' and id_usager=$id_usager ";	   		   

		$result = $this->bdd->executer($sql);
			
		if (mysql_num_rows($result)>= 1) return 1;
		else return 0;
	}

	/* Cette fonction permet de tester si l'enseignant est le tuteur
	 de l'apprenti d'identifiant $id_app*/

	function est_tuteur($id_app) {

		$sql="SELECT id_app
				FROM les_apprentis
				WHERE id_ens = '$this->id_ens' and id_app = '$id_app'
				"; 					 

		$result = $this->bdd->executer($sql);
			
		if (mysql_num_rows($result)>= 1) return 1;
		else return 0;
	}


	/* Cette fonction permet de tester si cet enseignant
	 est un enseignant de la formation d'identifiant $id_for

	 */

	function est_enseignant_formation($id_for) {

		$sql="SELECT id_ens
				FROM les_enseignants_formations
				WHERE id_ens = '$this->id_ens' and id_for = '$id_for'
				"; 					 

		$result = $this->bdd->executer($sql);
			
		if (mysql_num_rows($result) >= 1) return 1;
		else return 0;
	}

	/* Cette fonction  permet de fixer tous les attributs de la classe enseignant  */

	function set_detail(){
			
		parent::set_detail(); // fixer les attribus en tantque usager
			
		$sql="SELECT discipline
			   FROM les_enseignants 
			   WHERE id_ens='$this->id_ens'";	   		   

		$result = $this->bdd->executer($sql);
			
		if($ligne = mysql_fetch_assoc($result)) {

			$this->discipline = $ligne['discipline'];
		}
	}

	function is_enseignant() {
		return true;
	}

	/* Setter de l'ID */
	function set_id($id) {
		$this->id_ens = $id;
	}

	/* Getter de l'ID */
	function get_id() {
		return $this->id_ens;
	}

	/**
	 * Fonction permettant de personnaliser l'affichage de l'objet
	 */
	public function __toString() {
		return "Enseignant ".parent::__toString();
	}
}//fin de classe
?>