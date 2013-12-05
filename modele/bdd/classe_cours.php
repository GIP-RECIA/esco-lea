<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 04/08/05
/***********************************************************/
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/

class Cours{

	var $id_cours; //identifiant du cours
	var $id_ens;   //identifiant de l'enseignant chargé de ce cours
	var $id_cla;  // identifiant de la classe concernée par ce cours
	var $id_mat;  // identifiant de la matiere de ce cours

		
	function Cours($id_cours) {
		$this->id_cours=$id_cours;
	}

	/****************** les méthodes ******************************/

	/* Cette fonction  permet de supprimer le cours de la base de données*/ 

	function delete(){

		$sql="DELETE FROM les_cours
				 WHERE id_cours='$this->id_cours'";				
		$result = executer($sql);
	}

	/* Cette fonction  permet de récupérer dans un tableaux tous les identifiants des 
	 chapitres dèjà vus de ce  cours */ 

	function get_id_chapitres_vus(){
		 
		$sql="SELECT id_chap
		       FROM les_chapitres_vus_cours 
			   WHERE id_cours='$this->id_cours'";	   		   

		$result = executer($sql);
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$les_id_chapitres_vus[]=$ligne['id_chap'];
		}
		if(isset($les_id_chapitres_vus)) return $les_id_chapitres_vus;
	}

	/* Cette fonction mettre à jours les chapitres vus de ce cours
	 parametre : tableau d'identifiants des chapitres déclarés vus par l'enseignant de ce cours*/ 

	function maj_chapitres_vus($les_id_chapitres_vus){

		// suppression de tous les chapitres dèjà déclarés

		$sql="DELETE FROM les_chapitres_vus_cours
		  WHERE id_cours='$this->id_cours'";

	 $result = executer($sql);
	  
	 $sql="INSERT INTO les_chapitres_vus_cours(id_chap, id_cours)
	 	   VALUES  ";
	  
		$nb_chapitres=count($les_id_chapitres_vus);

		for($i=0; $i<$nb_chapitres; $i++)  {
			$id_chap=$les_id_chapitres_vus[$i];
			if ($i > 0) $virgule=" , ";
			else $virgule="";
			 
			$sql.=$virgule."('$id_chap', '$this->id_cours')";
		}

		if($nb_chapitres > 0) $result = executer($sql);
			
	}


	/* Cette fonction  permet de fixer tous les attributs de la classe cours */

	function set_detail(){
		 
		$sql="SELECT id_ens, id_cla, id_mat
		       FROM les_cours
			   WHERE  id_cours='$this->id_cours'";	   		   

		$result = executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			$this->id_ens=$ligne['id_ens'];
			$this->id_cla=$ligne['id_cla'];
			$this->id_mat=$ligne['id_mat'];
		}
	}

}
?>