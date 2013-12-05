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

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/classe_periode.php");
/***********************************************************/

class Classe{

	var $id_cla;
	var $libelle;
	var $niveau_etude;
	var $id_for;
	var $id_ens;   // le professeur principal de cette classe
	var $bdd;      // objet de connexion à la base de données

	function Classe($id_cla) {
		$this->id_cla = $id_cla;
		$this->bdd = new Connexion_BDD_LEA();
	}

	/****************** les méthodes ******************************/

	/*
	 * Cette fonction  permet de d'enregistrer les données de la classe dans la base
	 */
	function insert(){
			
		$sql="INSERT INTO les_classes
		         (id_cla, libelle, niveau_etude,  id_for, id_ens)
				VALUES('', '$this->libelle', '$this->niveau_etude', 
						'$this->id_for', '$this->id_ens')";				
		$result = $this->bdd->executer($sql);
			
		if($result) {
			$this->id_cla = mysql_insert_id();
		}
		else {
			$this->bdd->erreurs[] = "Une erreur est suvenue lors de l'enregistrement de la classe $this->libelle";
			$this->bdd->erreurs[] = mysql_error();
		}
	}


	/* 
	 * Cette fonction  permet de mettre à jour  les données de la classe sur la base
	 */ 
	function update(){
			
		$sql="UPDATE les_classes
		         SET libelle='$this->libelle', niveau_etude='$this->niveau_etude', 
					  id_for='$this->id_for', id_ens='$this->id_ens'
				 WHERE id_cla='$this->id_cla' ";

		$result =  $this->bdd->executer($sql);

		if(!$result) {
			$this->bdd->erreurs[] = "Une erreur est suvenue lors de la mise à jour de la classe $this->libelle";
			$this->bdd->erreurs[] = mysql_error();
		}
	}

	/* 
	 * Cette fonction  permet de supprimer  classe dans la base de données
	 */ 
	function delete(){

		$sql="DELETE FROM les_classes
				 WHERE id_cla='$this->id_cla'";				
		$result =  $this->bdd->executer($sql);
	}

	/* 
	 * Cette fonction renvoit l'identifiant de la formation de cette classe 
	 */
	function get_id_for() {

		$sql="SELECT  id_for
			   FROM les_classes C
			   WHERE id_cla='$this->id_cla' ";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne['id_for'];
		}
			
	}


	/* 
	 * Cette fonction  permet de basculer les apprentis inscrits à cette classe vers 
	 * la classe d'identifiant id_cla_dest
	 */
	function basculer_apprentis($id_cla_dest){
			
		$sql="UPDATE les_apprentis
		         SET   id_cla='$id_cla_dest' 
				 WHERE id_cla='$this->id_cla' ";

		$result =  $this->bdd->executer($sql);

		if(!$result)
		$this->bdd->erreurs[] = "Une erreur est suvenue lors de la mise à jour de la classe
		$this->libelle";
			
	}

	function basculer_apprentis_l($id_cla_dest,$list){
		for($i=0;$i<sizeof($list);$i++){
			$id=$list[$i];
			$sql="UPDATE les_apprentis
		         SET   id_cla='$id_cla_dest' 
				 WHERE id_cla='$this->id_cla' and id_app='$id'";

			$result =  $this->bdd->executer($sql);

			if(!$result)
			$this->bdd->erreurs[] = "Une erreur est suvenue lors de la mise à jour de la classe
			$this->libelle";
		}
	}

	/*
	 * Cette fonction renvoit un tableau contenant toutes les périodes  deveront être
	 * déclarées par les apprenti de cette classe 
	 */
	function get_periodes() {
			
		$sql="SELECT B.id_periode, B.libelle, B.suivi_cfa, B.suivi_entr, date_debut_cfa, date_fin_cfa, date_debut_entr, date_fin_entr
				 FROM  les_periodes_classes A, les_periodes B
				 WHERE A.id_periode =B.id_periode and id_cla='$this->id_cla'
				 ORDER BY B.rang
				";	
			
		$result = $this->bdd->executer($sql);
			
		$les_periodes = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$periode = new Periode($ligne['id_periode']);
			$periode->libelle = $ligne['libelle']  ;
			$periode->suivi_cfa = $ligne['suivi_cfa']  ;
			$periode->suivi_entr = $ligne['suivi_entr']  ;
			$periode->date_debut_cfa = $ligne['date_debut_cfa'] ;
			$periode->date_fin_cfa = $ligne['date_fin_cfa'] ;
			$periode->date_debut_entr = $ligne['date_debut_entr'] ;
			$periode->date_fin_entr = $ligne['date_fin_entr'] ;

			$les_periodes[] = $periode;
		}
			
		mysql_free_result($result);
			
		return $les_periodes;
	}

	/* 
	 * Cette fonction renvoit le nombre d'apprenti affectés à cette classe 
	 */ 
	function get_nb_apprentis() {
			
		$sql="SELECT COUNT(id_app) AS nb
				 FROM les_apprentis 
				 WHERE id_cla='$this->id_cla'";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne['nb'];
		}
		else return 0;

	}

	/* 
	 * Cette fonction renvoit un tableau contenant la liste d'identifiants des apprentis
	 * affectés à cette classe 
	 */ 

	function get_id_apprentis() {
			
		$sql="SELECT B.id_app
				 FROM les_usagers A , les_apprentis B
				 WHERE A.id_usager = B.id_app and B.id_cla='$this->id_cla'
				 ORDER BY A.nom
				 ";	   		     

		$result = $this->bdd->executer($sql);
			
		$les_id_app = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_app[] = $ligne['id_app'];
		}
			
		return $les_id_app;
	}

	/* 
	 * Cette fonction renvoit un tableau contenant la liste des apprentis
	 * affectés à cette classe 
	 */ 
	function get_apprentis() {
			
		$sql="SELECT B.id_app
				 FROM les_usagers A , les_apprentis B
				 WHERE A.id_usager = B.id_app and B.id_cla='$this->id_cla'
				 ORDER BY A.nom
				 ";	   		   

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
	 * Cette fonction renvoit l'identifiant du professeur  principal de la classe 
	 */
	function get_id_prof_principal() {
			
		$sql="SELECT id_ens
				 FROM  les_classes
				 WHERE id_cla='$this->id_cla'";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return	$ligne['id_ens'];
		}
		else return 0;
			
	}

	/* 
	 * Cette fonction  permet de fixer tous les attributs de la classe classe
	 */
	function set_detail(){
			
		$sql="SELECT libelle, niveau_etude,  id_for, id_ens
		       FROM les_classes
			   WHERE  id_cla='$this->id_cla'";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			$this->libelle = $ligne['libelle'];
			$this->niveau_etude = $ligne['niveau_etude'];
			$this->id_for = $ligne['id_for'];
		}
	}
	
	/**
	 * Cette fonction teste si une classe existe
	 * Elle renvoit l'id de la classe si elle existe, 0 si elle n'existe pas 
	 */
	function existe_libelle($libelle, $id_for) {
			
		$sql="SELECT id_cla FROM les_classes where libelle = '$libelle' and id_for=$id_for";
		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne['id_cla'];
		}
		return 0;
	}
	
	/*
	 * Insère l'objet en base de données s'il n'existe pas déjà, sinon met à jour.
	 * 
	 */
	function save($display_error = 1) {
		if ($this->id_cla > 0) {
			$this->update($display_error);
		} else {
			$this->insert($display_error);
		}
	}
	
	/**
	 * Fonction permettant de personnaliser l'affichage de l'objet
	 */
	public function __toString() {
		return "Classe $this->libelle";
	}
}
?>