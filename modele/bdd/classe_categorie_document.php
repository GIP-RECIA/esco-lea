<?php
/***********************************************************/
// Copyright ï¿½ 2005-2006
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 09/10/06
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_document_administratif.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/

class Categorie_document{

	var $id_categ; 		 		// identifiant da la catï¿½gorie
    var $libelle = "";         	// le libellï¿½ de la catï¿½gorie
	var $id_for;                // l'identifiant de la formation qui a dï¿½fini cette catï¿½gorie de document
	var $bdd;                	// objet de connexion ï¿½ la base de donnï¿½es
	
	function Categorie_document($id_categ) {
        $this->id_categ = $id_categ;
		$this->bdd = new Connexion_BDD_LEA();
    }

/* 
Cette fonction  permet de d'enregistrer cette categorie  dans la base de donnï¿½es
$les_id_for : tableau des identifiants des formations concernï¿½es par cette catï¿½gorie
*/ 

     function insert(){
	       
		   $sql="INSERT INTO les_categories_documents
		         (
			  	 	 id_categ, 
					 libelle, 
					 id_for
				)
				VALUES
				(
					'', 
					'$this->libelle',
					'$this->id_for'
				)";
				
			$result = $this->bdd->executer($sql);
			$this->id_doc = mysql_insert_id(); // identifiant du document crï¿½ï¿½.
			
				 	 	 
	 }
	 
/* Cette fonction  permet de modifier mettre ï¿½ jour cette catï¿½gorie  */ 

     function update(){
	       
		   		$sql = "UPDATE les_categories_documents
		     		    SET 
					  	  libelle	 	= '$this->libelle'						  
			 		   WHERE id_categ ='$this->id_categ' ";  
					 
			   $result = $this->bdd->executer($sql);						
				 	 	 
	 }	 
	 
/* Cette fonction  supprrime cette catï¿½gorie */
	
	function delete(){				

			$les_documents =  $this->get_documents_admin();
			// suppression de tous les documents de cette catï¿½gorie	
			foreach($les_documents as $document){
				$document->delete();
			}
			
			$sql="DELETE FROM les_categories_documents
			      WHERE id_categ ='$this->id_categ'";
			$result = $this->bdd->executer($sql);
			
	} // fin de la fonction
	
/* Cette foction permet de fixer tous les attributs de cette catï¿½gorie*/
	
	function set_detail(){
         
		 $sql="SELECT libelle, id_for
		       FROM les_categories_documents
			   WHERE  id_categ ='$this->id_categ'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
						
				$this->libelle = $ligne['libelle'];
				$this->id_for = $ligne['id_for'];				
																			
			}																							
	}    

/* 
Cette foction renvoit un tableau contenent tous les  documents administratifs  qui appartiennent
ï¿½ la catï¿½gorie d'identifiant $id_categ

*/
	
	function get_documents_admin(){
		 
		 $sql = "SELECT id_doc
		         FROM les_documents_administratifs
				 WHERE id_categ = '$this->id_categ'
			     ORDER BY titre
			   
			   ";	   		   
	
			$result = $this->bdd->executer($sql);				
			
			$tab_documents = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
				$document = new Document_administratif($ligne['id_doc']);		
				$document ->set_detail();
				
				$tab_documents[] = $document;						
			}			
						
			return $tab_documents;																				
	}    
	
}// fin de la classe 
?>