<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 04/10/05
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

/***********************************************************/

class Choix_modalite_multiple{

      	var $id_choix;   	  //identifiant du choix
		var $libelle;         		
		var $id_modalite;    
		var $bdd;
					
    function Choix_modalite_multiple($id_choix) {
	
		$this->bdd = new Connexion_BDD_LEA();
        $this->id_choix = $id_choix;
    }

/****************** les méthodes ******************************/

/* Cette fonction  permet ce choix  dans la base */ 

     function insert(){ 

		   $sql="INSERT INTO les_choix_modalite_multiple (id_choix, libelle, id_modalite)
							
				VALUES('', '$this->libelle', '$this->id_modalite') ";
										
			$result = $this->bdd->executer($sql);
			$this->id_choix = mysql_insert_id(); 	
									 	 
	 }

/* Cette fonction mé ajour les donnée de ce choix  dans la base de données*/ 

     function update(){
	       
		   $sql="UPDATE  les_choix_modalite_multiple
				 SET  libelle = '$this->libelle', 
				 	  id_modalite = '$this->id_modalite'
					  
				 WHERE id_choix = '$this->id_choix';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* Cette fonction  permet supprimer ce choix   de la base de données*/ 

     function delete(){
	       
		   $sql="DELETE FROM les_choix_modalite_multiple
				 WHERE id_choix = '$this->id_choix';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }


/* Cette fonction  permet de fixer tous les attributs de ce choix */ 
	
	function set_detail(){
         
		 $sql="SELECT *
		       FROM les_choix_modalite_multiple
			   WHERE  id_choix ='$this->id_choix'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
				
				$this->libelle = $ligne['libelle'];
				$this->id_modalite = $ligne['id_modalite'];
			}																							
	}    

}
?>
