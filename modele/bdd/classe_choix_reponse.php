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

class Choix_reponse{

      	var $id_reponse;   	  //identifiant de la réponse
		var $reponse;         // la réponse		
		var $id_modalite;     // identifiant de la modalite dont on propose cette réponse
		var $bdd;
					
    function Choix_reponse($id_reponse) {
	
		$this->bdd = new Connexion_BDD_LEA();
        $this->id_reponse = $id_reponse;
    }

/****************** les méthodes ******************************/

/* Cette fonction  permet cette réponse  dans la base */ 

     function insert(){ 

		   $sql="INSERT INTO les_choix_reponse (id_reponse, reponse, id_modalite)
							
				VALUES('', '$this->reponse', '$this->id_modalite') ";
										
			$result = $this->bdd->executer($sql);
			$this->id_reponse = mysql_insert_id(); 	
									 	 
	 }

/* Cette fonction mé ajour les donnée de cette réponse dans la base de données*/ 

     function update(){
	       
		   $sql="UPDATE  les_choix_reponse
				 SET  reponse = '$this->reponse', 
				 	  id_modalite = '$this->id_modalite'
					  
				 WHERE id_reponse= '$this->id_reponse';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* Cette fonction  permet supprimer cetteréponse  de la base de données*/ 

     function delete(){
	       
		   $sql="DELETE FROM les_choix_reponse
				 WHERE id_reponse= '$this->id_reponse';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }


/* Cette fonction  permet de fixer tous les attributs cette réponse */ 
	
	function set_detail(){
         
		 $sql="SELECT *
		       FROM les_choix_reponse
			   WHERE  id_reponse ='$this->id_reponse'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
				
				$this->reponse = $ligne['reponse'];
				$this->id_modalite = $ligne['id_modalite'];
			}																							
	}    

}
?>
