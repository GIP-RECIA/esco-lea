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

class Entreprise{

      	var $id_entr;
        var $nom;  
		var $adresse;
		var $code_postal;
		var $ville;
		var $tel_fixe1;
		var $tel_fixe2;
		var $fax;
		var $email;
		var $url_site;
		var $secteur_activite;
		var $nom_contact;
		var $prenom_contact;
		var $nb_salaries;
		var $nb_apprentis;
		var $bdd;		

    function Entreprise($id_entr) {
        $this->id_entr = $id_entr;
		$this->bdd = new Connexion_BDD_LEA();
    }

/****************** les méthodes ******************************/
/* Cette fonction  permet de d'enregistrer les données de l'enreprise dans la base*/ 
     function insert($display_error = 1){
	   	    
		   $sql="INSERT INTO les_entreprises
		         (id_entr, nom, adresse, code_postal, ville, tel_fixe1, tel_fixe2, fax, email, 
				 url_site, secteur_activite, nom_contact, prenom_contact, nb_salaries, nb_apprentis)
				VALUES('', '".addslashes($this->nom)."', '".addslashes($this->adresse)."', '$this->code_postal', '".addslashes($this->ville)."',
						'$this->tel_fixe1', '$this->tel_fixe2', '$this->fax', '$this->email', 
						'$this->url_site', '$this->secteur_activite', '".addslashes($this->nom_contact)."', 
						'".addslashes($this->prenom_contact)."', '$this->nb_salaries', '$this->nb_apprentis' )";
				
			$result = $this->bdd->executer($sql, $display_error = 1);
			
			
     		if (!is_array($this->erreurs)) $this->erreurs = array();
			
			if($result) {
				$this->id_entr=mysql_insert_id(); 
			}
			else {
				$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de l'entreprise $this->nom ";
				$this->bdd->erreurs[] = mysql_error();
			}											 	 	 	 	 
	 }

	/* Cette fonction  permet de modifier les données de l'entreprise dans la base*/ 
     function update($display_error = 1){ 
	    
		if  ($this->nom!="") {
		   
		   $sql="UPDATE les_entreprises
		         SET nom='".addslashes($this->nom)."', adresse='".addslashes($this->adresse)."', 
				 	 code_postal='$this->code_postal', ville='".addslashes($this->ville)."',
				     tel_fixe1='$this->tel_fixe1',  tel_fixe2='$this->tel_fixe2',
					 fax='$this->fax', email='$this->email',url_site='$this->url_site', 
					 secteur_activite='$this->secteur_activite',  nom_contact='".addslashes($this->nom_contact)."',
					 prenom_contact='".addslashes($this->prenom_contact)."', nb_salaries='$this->nb_salaries',
					 nb_apprentis='$this->nb_apprentis'  
					
				WHERE id_entr='$this->id_entr'";
				
			$result = $this->bdd->executer($sql, $display_error = 1);
			if(!$result) {
				$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de l'entreprise $this->nom ";
				$this->bdd->erreurs[] = mysql_error();
			}											 	 	 	 	 
			
			
		}			 	 	 	 	 							
	 }

/* Cette fonction  permet de supprimer  l'entreprise de la base de données*/ 

     function delete(){
	       
		   $sql="DELETE FROM les_entreprises        
				 WHERE id_entr='$this->id_entr'";				
			$result = $this->bdd->executer($sql);																
					 	 	 	 	 									
	 }

/* Cette fonction  permet de supprimer  tous les maitre d'apprentissage de cette entreprise*/ 

     function delete_all_ma(){

   		   $sql="SELECT id_ma
				 FROM  les_maitres_apprentissage 
				 WHERE id_entr='$this->id_entr'";	   		   
			$result = $this->bdd->executer($sql);				
						
			while ($ligne = mysql_fetch_assoc($result)) {						
			 $ma = new Usager($ligne['id_ma']);
			 $ma->delete_usager();				
			}	      																						
					 	 	 	 	 									
	 }

/* Cette fonction  teste si cette entreprise est déjà enregistrée sur la base. Si oui, elle renvoit 
    1 sinon elle envoit 0 */ 

     function existe(){

   		   $sql="SELECT id_entr
				 FROM  les_entreprises 
				 WHERE nom='".addslashes($this->nom)."'";	   		   
			$result = $this->bdd->executer($sql);				
						
			if ($ligne = mysql_fetch_assoc($result)) {						
			   $this->id_entr = $ligne['id_entr'];
			   return 1;							
			}
			else return 0;	      																						
					 	 	 	 	 									
	 }
	 	 
/* Cette fonction  permet de récupérer tous les  maitres d'apprentissage qui travaillent
   à cette  entreprise */ 

     function get_les_ma(){
	       
		   $sql="SELECT MA.id_ma, U.nom, U.prenom
		   		 FROM les_maitres_apprentissage  MA, les_usagers U    
				 WHERE MA.id_ma=U.id_usager and MA.id_entr='$this->id_entr'";				
			$result = executer($sql);				
			
			while ($ligne = mysql_fetch_assoc($result)) {
				$ma = new maitre_apprentissage($ligne['id_ma']);
				$ma->nom = $ligne['nom'];
				$ma->prenom = $ligne['prenom'];					
				$les_ma[] = $ma;				
			}	
			if(isset($les_ma)) return $les_ma;
	 }

	/* Cette fonction  permet de fixer tous les attributs de la classe Entreprise  */
	function set_detail($html = 1){
         
		 $sql="SELECT nom, adresse, code_postal, ville, tel_fixe1, tel_fixe2, fax, email, url_site, secteur_activite,
		 			  nom_contact, prenom_contact, nb_salaries, nb_apprentis		 
			   FROM les_entreprises
			   WHERE id_entr='$this->id_entr'";	   		   

			$result = $this->bdd->executer($sql);				
			
			while ($ligne = mysql_fetch_assoc($result)) {
										
if($html)		$this->nom=htmlentities($ligne['nom'],ENT_QUOTES, "UTF-8");
else 			$this->nom=$ligne['nom'];

if($html)		$this->adresse=htmlentities($ligne['adresse'],ENT_QUOTES, "UTF-8");
else 			$this->adresse=$ligne['adresse'];

				$this->tel_fixe1=$ligne['tel_fixe1'];
				$this->tel_fixe2=$ligne['tel_fixe2'];
				$this->fax=$ligne['fax'];
				$this->email=$ligne['email'];				
				$this->url_site=$ligne['url_site'];
				
if($html)		$this->secteur_activite=htmlentities($ligne['secteur_activite'],ENT_QUOTES, "UTF-8");
else 			$this->secteur_activite=$ligne['secteur_activite'];
				
				$this->code_postal = $ligne['code_postal'];
				$this->ville = $ligne['ville'];
				$this->nom_contact = $ligne['nom_contact'];
				$this->prenom_contact= $ligne['prenom_contact'];
				$this->nb_salaries = $ligne['nb_salaries'];
				$this->nb_apprentis = $ligne['nb_apprentis'];				
			}																							
	}

     function existe_deja(){

   		   $sql="SELECT id_entr
				 FROM  les_entreprises 
				 WHERE nom='".addslashes($this->nom)."' and adresse = '".addslashes($this->adresse)."'";	   		   
			$result = $this->bdd->executer($sql);				
						
			if ($ligne = mysql_fetch_assoc($result)) {						
			   return $ligne['id_entr'];							
			} else { 
				return 0;	      																						
			}
					 	 	 	 	 									
	 }
	 
	/*
	 * Insère l'objet en base de données s'il n'existe pas déjà, sinon met à jour.
	 * 
	 */
	function save($display_error = 1) {
		if ($this->id_entr > 0) {
			$this->update($display_error);
		} else {
			$this->insert($display_error);
		}
	}
	 
}//fin de classe
?>