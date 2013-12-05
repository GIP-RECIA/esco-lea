<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 09/08/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/

class Document_administratif{

	var $id_doc; 		 		// identifiant du document administratif
    var $titre = "";         	// le titre du document
    var $commentaire = "" ;     // commentaire assicié à ce document	
	var $fichier_joint; 		// fichier joint
	var $date_maj;			    // date du mise à jour de ce document	
	var $id_categ;         	 	// l'identifiant de la categorie de ce document
	var $bdd;                	// objet de connexion à la base de données
	
	function Document_administratif($id_doc) {
        $this->id_doc = $id_doc;
		$this->bdd = new Connexion_BDD_LEA();
    }

/* Cette fonction  permet de d'enregistrer ce  document  dans la base de données*/ 

     function insert(){
	       
		   $sql="INSERT INTO les_documents_administratifs
		         (
			  	 	 id_doc, 
					 titre, 
					 commentaire, 					 
					 fichier_joint, 
					 date_maj, 
					 id_categ 
				)
				VALUES
				(
					'', 
					'$this->titre', 
					'$this->commentaire', 					
					'$this->fichier_joint', 
					CURRENT_TIMESTAMP(), 
					'$this->id_categ'
				)";
				
			$result = $this->bdd->executer($sql);
			$this->id_doc = mysql_insert_id(); // identifiant du document créé.						
				 	 	 
	 }
	 
/* Cette fonction  permet de modifier mettre à jour ce document  */ 

     function update(){
	       
		   		$sql = "UPDATE les_documents_administratifs
		     		    SET 
					  	  titre		 	= '$this->titre',
						  commentaire 	= '$this->commentaire',						  
						  fichier_joint = '$this->fichier_joint',
						  date_maj = CURRENT_TIMESTAMP,
						  id_categ 	= '$this->id_categ'
						  
			 		   WHERE id_doc='$this->id_doc' ";  
					 
			   $result = $this->bdd->executer($sql);						
				 	 	 
	 }	 
	 
/* Cette fonction  supprrime ce document */
	
	function delete(){
	
			global $LEA_REP;
			
			$sql="DELETE FROM les_documents_administratifs
			      WHERE id_doc='$this->id_doc'";
			$result = $this->bdd->executer($sql);

			//---------suppression  physique du fichier -------------
			// le reprtoire où se trouve le document à supprimer.			
		

			$filename = $LEA_REP."documents/documents_administratifs/$this->fichier_joint";
			if (file_exists($filename)) { 				
				@unlink($filename);
			}

			  			 			
	
	} // fin de la fonction
	
/* Cette foction permet de fixer tous les attributs de ce document */
	
	function set_detail(){
         
		 $sql="SELECT titre, commentaire, fichier_joint, date_maj, id_categ
		       FROM les_documents_administratifs
			   WHERE  id_doc ='$this->id_doc'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
						
				$this->titre = $ligne['titre'];
				$this->commentaire = $ligne['commentaire'];				
				$this->fichier_joint = $ligne['fichier_joint'];
				$this->date_maj = $ligne['date_maj'];
				$this->id_categ = $ligne['id_categ'];				
																			
			}																							
	}    

	
}// fin de la classe 
?>