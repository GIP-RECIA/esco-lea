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

class Document_declare{

	var $id_doc; 		 		 // identifiant du document déclaré
    var $src_doc = "";         	 // le nom du fichier sauvegardé à la base de données
    var $confidentialite = 1 ;    // confidentialité du document
	var $id_dec;         		 // l'identifiant de la déclaration 
	var $id_usager; 			// l'identifiant de l'usager ayant joint ce document
	var $bdd;                // objet de connexion à la base de données
	var $bdd_pdo;                   // objet de connexion a la BD avec le driver PDO
	
	function Document_declare($id_doc) {
        $this->id_doc = $id_doc;
				$this->bdd = new Connexion_BDD_LEA();
				$this->bdd_pdo = new Connexion_BDD_LEA_PDO();
    }

/* Cette fonction  permet de d'enregistrer ce  document  dans la base de données*/ 

     function insert(){
                // Preparation de la requete                                                                          
                $statement = 'INSERT INTO les_documents_declares (src_doc, confidentialite, id_dec, id_usager) VALUES( :srcdoc, 1, :iddec, :idusager)';
                $sth = $this->bdd_pdo->prepare( $statement );

                // Liage des parametres                                                                               
                $stringValues = array( ':srcdoc' => $this->src_doc, ':iddec' => $this->id_dec, ':idusager' => $this->id_usager );
                $this->bdd_pdo->bindValues( $sth, $stringValues );

                // Execution de la requete
                $result = $this->bdd_pdo->execute( $sth );

                // Recuperation de l'id cree pour le document                                                         
                $this->id_doc = $this->bdd_pdo->lastInsertId( 'les_documents_declares', 'id_doc' );
	 }
	 
/* Cette fonction  permet de modifier la confidentialité de ce document  */ 

     function update(){
	       
		   		$sql="UPDATE les_documents_declares
		     		  SET confidentialite='$this->confidentialite' 
			 		 WHERE id_doc='$this->id_doc' ";  
			   $result = $this->bdd->executer($sql);
			   
				 	 	 
	 }	 
/* Cette fonction  supprrime ce document */
	
	function delete(){
			global $SRC_DOCUMENTS_DECLARES;
			
			$sql="DELETE FROM les_documents_declares
			      WHERE id_doc='$this->id_doc'";
			$result = $this->bdd->executer($sql);

			//---------suppression  physique du fichier -------------
			// le reprtoire où se trouve le document à supprimer.			
		

			$filename = $SRC_DOCUMENTS_DECLARES."$this->src_doc";
			if (file_exists($filename)) { 
				
				unlink($filename);
			}

			  			 			
	
	} // fin de la fonction
	
/* Cette foction permet de fixer tous les attributs de ce document */
	
	function set_detail(){
         
		 $sql="SELECT src_doc, confidentialite, id_dec, id_usager
		       FROM les_documents_declares
			   WHERE  id_doc ='$this->id_doc'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
						
				$this->src_doc = $ligne['src_doc'];
				$this->confidentialite = $ligne['confidentialite'];															
				$this->id_dec = $ligne['id_dec'];																				
			}	$this->id_usager = $ligne['id_usager'];																																											
	}    
		 	
}// fin de la classe 
?>
