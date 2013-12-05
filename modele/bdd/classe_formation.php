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
require_once ($LEA_REP."modele/bdd/classe_config_lea.php");
require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_charte_graphique.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
class Formation{

	var $id_for;
	var $nom;
	var $nb_semestres;
	var $secteur;
	var $niveau;
	var $id_ens;    		// l'idntifiant du responsable de cette formation
	var $id_unite;           // l'unité pédagogique de cette formation
	var $bdd;               // objet de connexion à la base de données
	var $erreurs;
	var $bdd_pdo;
		
	function Formation($id_for) {
		$this->id_for = $id_for;
		$this->bdd = new Connexion_BDD_LEA();
		$this->bdd_pdo = new Connexion_BDD_LEA_PDO();
	}

	/****************** les méthodes ******************************/

	/* Cette fonction  permet d'enregistrer les données de la formation dans la base*/ 

	function insert($display_error = 1) {
			

		$statement = "INSERT INTO les_formations
		         ( nom, nb_semestres, secteur, niveau, id_ens, id_unite )
		         VALUES( :nom, :nb_semestres, :secteur, :niveau, :id_ens, :id_unite )";
		$sth = $this->bdd_pdo->prepare( $statement );

		// Liage des parametres
		$stringValues = array( ':nom' => $this->nom, ':secteur' => $this->secteur, ':niveau' => $this->niveau );
		$intValues = array( ':nb_semestres' => $this->nb_semestres, ':id_ens' => $this->id_ens, ':id_unite' => $this->id_unite );
		$this->bdd_pdo->bindValues( $sth, $stringValues );
		$this->bdd_pdo->bindValues( $sth, $intValues, PDO::PARAM_INT );

		$result = $this->bdd_pdo->execute( $sth );
		if( result == TRUE ) {
			$this->id_for = $this->bdd_pdo->lastInsertId( ); // identifiant de la formation créée.
		}  else {
			$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de la formation " . nom;
		}
		return $result;
	}

	/* Cette fonction  permet de modifier les données de la formation dans la base*/ 
	 
	function update($display_error = 1) {
			
		$sql="UPDATE les_formations
		         SET	nom = '$this->nom', 
				 		nb_semestres = '$this->nb_semestres', 				      
						secteur = '$this->secteur',
						niveau = '$this->niveau', 
						id_ens = '$this->id_ens', 
					 	id_unite = '$this->id_unite'
				WHERE id_for='$this->id_for'";

		$result = $this->bdd->executer($sql, $display_error);
		if (!result) {
			$this->bdd->erreurs[] = "Une erreur est survenue lors de la mise a jour de la formation $this->nom ";
			$this->bdd->erreurs[] = mysql_error();
		}
		return $result;
	}

	/* Cette fonction  permet de supprimer cette formation de la base de données*/ 

	function delete(){

		$this->delete_all_apprentis();
		 
		$sql="DELETE FROM les_formations
				 WHERE id_for='$this->id_for'";				
		$result = $this->bdd->executer($sql);

		 
	}

	/* Cette fonction  permet de supprimer  tous les apprentis de cette formation*/

	function delete_all_apprentis(){

		$sql="SELECT A.id_app
				 FROM  les_apprentis A , les_classes B
				 WHERE A.id_cla = B.id_cla and B.id_for='$this->id_for'";	   		   

		$result = $this->bdd->executer($sql);

		while ($ligne = mysql_fetch_assoc($result)) {
				
			$apprenti=new Usager($ligne['id_app']);
			$apprenti->delete_usager();
		}
		 
	}

	/*
	 Cette fonction renvoit un tableau contenant les identifiants des classes
	 de cette formation
	 */

	function get_id_classes() {
		 
		$sql="SELECT id_cla
				 FROM  les_classes
				 WHERE id_for='$this->id_for'
				 ORDER BY libelle ";	   		   
			
		$result = $this->bdd->executer($sql);
			
		$les_id_classes = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_classes[] = $ligne['id_cla'];
		}
			
		mysql_free_result($result);
			
		return $les_id_classes;
	}

	/* Cette fonction renvoit un tableau contenant toutes les
	 de cette formation */

	function get_classes() {
		 
		$sql="SELECT id_cla
				 FROM  les_classes
				 WHERE id_for='$this->id_for'
				 ORDER BY libelle ";	
		 
		$result = $this->bdd->executer($sql);
			
		$les_classes = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$classe=new Classe($ligne['id_cla']);
			$classe->set_detail();
			$les_classes[] = $classe;
		}
			
		mysql_free_result($result);
			
		return $les_classes;
	}

	/*
	 Cette fonction renvoit un tableau contenant toutes les périodes qui devront être
	 déclarées par les apprentis de cette formation lors du suivi $type_suivi (cfa, entr, entr_et_cfa)
	 */

	function get_periodes($type_suivi='', $acteur='', $classe='') {
		 
		$str_suivi = "";
		$str_acteur = "";

		if($type_suivi == 'cfa') 	 			$str_suivi = " AND les_periodes.suivi_cfa=1";
		elseif($type_suivi == 'entr') 			$str_suivi = " AND les_periodes.suivi_entr=1";
		elseif($type_suivi == 'entr_et_cfa') 	$str_suivi = " AND ( les_periodes.suivi_cfa=1 OR les_periodes.suivi_entr=1)";
		else 									$str_suivi = " AND ( les_periodes.suivi_cfa=1 OR les_periodes.suivi_entr=1)";

		switch($acteur){
			case 'app':
				$str_acteur = " AND les_periodes.consult_app=1";
				break;
			case 'ma':
				$str_acteur = " AND les_periodes.consult_ma=1";
				break;
			case 'tuteur_cfa':
				$str_acteur = " AND ( les_periodes.consult_tuteur_cfa=1 OR  les_periodes.consult_ens=1 )" ;
				break;
			case 'ens':
				$str_acteur = " AND les_periodes.consult_ens=1";
				break;
			case 'rl':
				$str_acteur = " AND les_periodes.consult_rl=1";
				break;
			default:
				$str_acteur = "";
		}

		if ($classe == '') {
			$clause_where = "WHERE les_periodes.id_for ='".$this->id_for."'".$str_suivi."".$str_acteur;
		} else {
			$clause_where = ", les_periodes_classes
		   		WHERE les_periodes.id_for ='".$this->id_for."'".$str_suivi."".$str_acteur."
		   		  AND les_periodes_classes.id_periode = les_periodes.id_periode
  				  AND les_periodes_classes.id_cla = ".$classe;
		}
		 
		$sql="SELECT les_periodes.id_periode
				 FROM les_periodes
				 ".$clause_where."
				 ORDER BY les_periodes.rang, les_periodes.id_periode";
		 
		$result = $this->bdd->executer($sql);
			
		$les_periodes = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$periode = new Periode($ligne['id_periode']);
			$periode->set_detail();
			$les_periodes[] = $periode;
		}

		mysql_free_result($result);
			
		return $les_periodes;
	}

	/* 	Cette fonction renvoit un tableau contenant les maitres d'apprentisage
	 suivants les apprentis de cette formation
	 */

	function get_maitres_apprentissage($pos = 0, $nb = 10000) {
		 
		$sql = "SELECT DISTINCT(A.id_ma)
				   FROM  les_apprentis A, les_usagers B, les_classes C
				   WHERE A.id_cla= C.id_cla and A.id_ma= B.id_usager  and C.id_for='$this->id_for'  
				   ORDER BY B.nom
				   LIMIT $pos, $nb";	   		   
			
		$result = $this->bdd->executer($sql);
			
		$les_ma = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$ma = new Maitre_apprentissage($ligne['id_ma']);
			$ma->set_detail();
			if(trim($ma->nom) != '' || trim($ma->prenom) != '' );
			$les_ma[] = $ma;
		}
		mysql_free_result($result);
			
		return $les_ma;
	}

	/* Cette fonction renvoit le nombre d'entreprises ayant déjà recrutés au moins un apprenti 
	 de de cette formation */



	/* 	Cette fonction renvoit un tableau contenant les entreprises ayant déjà recrutées au moins un apprenti 
	 de de cette formation
	 */

	function get_entreprises($pos, $nb) {
		 
		$sql="SELECT DISTINCT(MA.id_entr)
				 FROM  les_apprentis A, les_classes C, les_maitres_apprentissage MA
				 WHERE A.id_cla= C.id_cla and A.id_ma=MA.id_ma and C.id_for='$this->id_for'  
				 ORDER BY A.nom
				 LIMIT $pos, $nb";	   		   
		$result = $this->bdd->executer($sql);
			
		$les_entreprises = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$entreprise=new Entreprise($ligne['id_entr']);
			$entreprise->set_detail();
			$les_entreprises[]=$entreprise;
		}
		mysql_free_result($result);
			
		$les_entreprises;
	}

	/* Cette fonction renvoit le nombre d'entreprises ayant déjà recrutés au moins un apprenti 
	 de de cette formation */

	function get_nb_entreprises() {

		$sql="SELECT COUNT(DISTINCT(id_entr)) nb
				 FROM  les_apprentis A, les_classes C, les_maitres_apprentissage MA
				 WHERE A.id_cla= C.id_cla and A.id_ma=MA.id_ma and C.id_for='$this->id_for'  
				 ";	   		   

		$result = $this->bdd->executer($sql);
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne["nb"];
		}
		else return 0;
	}

	/*
	 Cette fonction renvoit un tableau contenant les identifiants des apprentis  suivant cette formation
	 */


	function get_id_apprentis($mot_cle="") {
		 
		$sql="SELECT A.id_app
				 FROM   les_usagers U, les_apprentis A, les_classes C
				 WHERE U.id_usager=A.id_app and A.id_cla = C.id_cla 
				 	  and  C.id_for='$this->id_for' and U.nom like '%$mot_cle%' 
				 ORDER BY U.nom
				";	   		   

		$result = $this->bdd->executer($sql);
			
		$les_id_app = array();

		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_app[] = $ligne['id_app'];
		}
		mysql_free_result($result);
			
		return $les_id_app;
	}

	/*
	 Cette fonction renvoit un tableau contenant la liste apprentis  suivant cette formation
	 */


	function get_apprentis($mot_cle="") {
		 
		$sql="SELECT A.id_app
				 FROM   les_usagers U, les_apprentis A, les_classes C
				 WHERE U.id_usager=A.id_app and A.id_cla = C.id_cla 
				 	  and  C.id_for='$this->id_for' and U.nom like '%$mot_cle%' 
				 ORDER BY U.nom
					  ";	   		   

		$result = $this->bdd->executer($sql);
			
		$les_apprentis = array();

		while ($ligne = mysql_fetch_assoc($result)) {
			$apprenti = new Apprenti($ligne['id_app']);
			$apprenti->set_detail();
			$les_apprentis[] = $apprenti;
		}
		mysql_free_result($result);
			
		return $les_apprentis;
	}

	/* Cette fonction renvoit l'identifiant du l'enseignant
	 responsable de cette formation, si la formation n'a pas de responsable elle renvoit 0 */

	function get_id_rf() {
		 
		$sql="SELECT id_ens
				 FROM  les_formations
				 WHERE id_for='$this->id_for'				 
				 ";	   		   
		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return	$ligne['id_ens'];
		}
		else return 0;

	}

	/* Cette fonction renvoit  l'enseignant
	 responsable de cette formation, si la formation n'a pas de responsable ell renvoit 0 */

	function get_responsable() {
		 
		$id_ens = $this->get_id_rf();
		$enseignant = new Enseignant($id_ens);
		$enseignant->set_detail();
		 
		return($enseignant);

	}

	/*
	 Cette Fonction met à jour la liste des enseignants de cette formation.
	 Elle affecte l'enseignants d'identifiant $id_ens à cette formation
	 */

	function update_les_enseignants_formations($les_id_ens = array()) {

		$sql="DELETE From les_enseignants_formations
		       WHERE id_for='$this->id_for'";			   			    					   		   

		$result = $this->bdd->executer($sql);

		foreach($les_id_ens as $id_ens) {
			$sql="INSERT INTO les_enseignants_formations(id_ens, id_for)
			       VALUES  ('$id_ens', '$this->id_for')
				   ";
			$result = $this->bdd->executer($sql);
		}
			
	}
	function update_les_sous_resp($les_id_ens = array()) {
		$sql="SELECT id_usager from les_sous_resp";
		$result = $this->bdd->executer($sql);
		while ($ligne = mysql_fetch_assoc($result)) {
			$id=$ligne['id_usager'];
			$sql2="SELECT profil from les_usagers where id_usager='$id'";
			$result2 = $this->bdd->executer($sql2);
			while($ligne2=mysql_fetch_assoc($result2)){
				if(ereg("sr",$ligne2['profil'])){
					$tok = strtok($ligne2['profil'],",");
					$profil=$tok;
					$tok = strtok(",");
					while ($tok != false) {
						if($tok!="sr")$profil=$profil.",".$tok;
						$tok = strtok(",");
					}
					$sql3="UPDATE les_usagers SET profil='$profil' WHERE id_usager='$id'";
					$this->bdd->executer($sql3);
				}

			}
		}
		$sql="DELETE From les_sous_resp
		 WHERE id_for='$this->id_for'";			   			    					   		   

		$result = $this->bdd->executer($sql);

		foreach($les_id_ens as $id_ens) {
			$sql="INSERT INTO les_sous_resp(id_usager, id_for)
			       VALUES  ('$id_ens', '$this->id_for')
				   ";
			$result = $this->bdd->executer($sql);
		}
		$this->test_resp();
	}
	function test_resp(){
		$sql="SELECT id_usager from les_sous_resp";
		$result = $this->bdd->executer($sql);
		while ($ligne = mysql_fetch_assoc($result)) {
			$id=$ligne['id_usager'];
			$sql2="SELECT profil from les_usagers where id_usager='$id'";
			$result2 = $this->bdd->executer($sql2);
			while($ligne2=mysql_fetch_assoc($result2)){
				if(!ereg("sr",$ligne2['profil'])){
					$prof=$ligne2['profil'].",sr";
					$sql3="UPDATE les_usagers SET profil='$prof' WHERE id_usager='$id'";
					$this->bdd->executer($sql3);
				}

			}
		}
	}
	/*
	 Cette fonction renvoit un tableau contenant les identifiants des enseignants  de cette formation
	 */

	function get_id_enseignants($mot_cle) {
		 
		$sql="SELECT U.id_usager
				 FROM  les_usagers U, les_enseignants_formations EF
				 WHERE U.id_usager=EF.id_ens and id_for='$this->id_for' and U.nom LIKE '%$mot_cle%'
				 ORDER BY U.nom";

		$result = $this->bdd->executer($sql);
			
		$les_id_enseignants = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$les_id_enseignants[] = $ligne['id_usager'];
		}
		mysql_free_result($result);
			
		return $les_id_enseignants;
			
	}


	/*
	 Cette fonction renvoit un tableau contenant tous les enseignants  de cette formation
	 */

	function get_enseignants($mot_cle="") {
		 
		$sql="SELECT U.id_usager, U.nom, U.prenom ,  U.tel_fixe, U.tel_mobile, U.email
				 FROM  les_usagers U, les_enseignants_formations EF
				 WHERE U.id_usager=EF.id_ens and id_for='$this->id_for' and U.nom LIKE '%$mot_cle%'
				 ORDER BY U.nom";

		$result = $this->bdd->executer($sql);
			
		$les_enseignants = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$enseignant = new Enseignant($ligne['id_usager']);
			$enseignant->nom = $ligne['nom'];
			$enseignant->prenom = $ligne['prenom'];
			$enseignant->tel_fixe = $ligne['tel_fixe'];
			$enseignant->tel_mobile = $ligne['tel_mobile'];
			$enseignant->email = $ligne['email'];
				
			$les_enseignants[] = $enseignant;
		}
		mysql_free_result($result);
			
		return $les_enseignants;
			
	}

	/*
	 Cette fonction renvoit le nombre d'enseignants  de cette formation
	 */

	function get_nb_enseignants() {
		 
		$sql="SELECT count(id_ens) as nb
				 FROM  les_enseignants_formations 
				 WHERE id_for ='$this->id_for'
				 ";
			
		$result = $this->bdd->executer($sql);
			
		if($ligne = mysql_fetch_assoc($result)) {

			return($ligne['nb']);
		}
		else return 0;
	}


	/* Cette fonction renvoit la configuration
	 du lea de cette formation */

	function get_config_lea() {
		 
		$sql= "SELECT id_config
				 FROM  les_configs_lea
				 WHERE id_for ='$this->id_for'";	   		   
			
		$result = $this->bdd->executer($sql);
			
		$config = new Config_lea(0);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			$config->id_config = $ligne['id_config'];
			$config->set_detail();
		}
		return $config;

	}

	/* Cette fonction renvoit la charte graphique de cette formation
	 du lea de cette formation */

	function get_charte_graphique() {
		 
		$sql= "SELECT id_charte
				 FROM  les_chartes_graphiques
				 WHERE id_for ='$this->id_for'";	   		   
			
		$result = $this->bdd->executer($sql);
			
		$charte = new Charte_graphique(0);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			$charte->id_charte = $ligne['id_charte'];
			$charte->set_detail();
		}
		return $charte;

	}

	/* Cette fonction  permet de fixer tous les attributs de la classe formation */

	function set_detail(){
		 
		$sql="SELECT *
			   FROM les_formations
			   WHERE  id_for='$this->id_for'";	   		   

		$result = $this->bdd->executer($sql);
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$this->nom = $ligne['nom'];
			$this->nb_semestres = $ligne['nb_semestres'];
			$this->secteur = $ligne['secteur'];
			$this->niveau = $ligne['niveau'];
			$this->id_ens = $ligne['id_ens'];
			$this->id_unite = $ligne['id_unite'];
				
		}
	}

	/*
	 Cette fonction renvoit un tableau contenant la liste des catégories 
	 des documents administratifs de cette formation
	 */
	function get_categories_documents($mot_cle="") {
		 
		$sql="SELECT id_categ, libelle
				 FROM   les_categories_documents
				 WHERE  id_for='$this->id_for'
				 ORDER BY libelle
					  ";	   		   

		$result = $this->bdd->executer($sql);
			
		$les_categories  = array();

		while ($ligne = mysql_fetch_assoc($result)) {
			$categorie = new Categorie_document($ligne['id_categ']);
			$categorie->libelle = $ligne['libelle'];
			$categorie->id_for = $this->id_for;
			$les_categories[] = $categorie;
		}
		mysql_free_result($result);
			
		return $les_categories;
	}

	/**
	 * Cette fonction teste si une formation existe
	 * Elle renvoit l'id de la formation si elle existe, 0 si elle n'existe pas 
	 */
	function existe_nom($nom, $id_unite) {
		// Preparation de la requete	
		$statement = "SELECT id_for FROM les_formations where nom = :nom and id_unite = :id_unite";
		$sth = $this->bdd_pdo->prepare( $statement );
		
		// Liage des parametres
		$stringValues = array( ':nom' => $nom );
		$intValues = array( ':id_unite' => $id_unite );
		$this->bdd_pdo->bindValues( $sth, $stringValues );
		$this->bdd_pdo->bindValues( $sth, $intValues, PDO::PARAM_INT );
		
		// Execution de la requete
		$this->bdd_pdo->execute( $sth );
		$ligne = $this->bdd_pdo->fetch( $sth, PDO::FETCH_ASSOC );

		if ( $ligne != FALSE )
		{
			return $ligne['id_for'];
		}
		return 0;
	}
	
	/**
	 * Fonction permettant de personnaliser l'affichage de l'objet
	 */
	public function __toString() {
		return "Formation $this->nom";
	}

	/*
	 * Insère l'objet en base de données s'il n'existe pas déjà, sinon met à jour.
	 * 
	 */
	function save($display_error = 1) {
		if ($this->id_for > 0) {
			$this->update($display_error);
		} else {
			$this->insert($display_error);
		}
	}


}
?>
