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
require_once ($LEA_REP."modele/bdd/classe_choix_modalite_multiple.php");
/***********************************************************/

class Modalite_va_multiple{

      	var $id_modalite;   	  //identifiant du de la modalite
		var $libelle;            // libellé de la modalité		
		var $acteur;             // acteur concerné par cette modalité		
		var $type_choix = 'unique'; // unique , multiple
		var $id_arbre;           // l'identifiant de l'arbre sur lequel on applique cette modalité		
		var $bdd;
					
    function Modalite_va_multiple($id_modalite) {
	
		$this->bdd = new Connexion_BDD_LEA();
        $this->id_modalite = $id_modalite;
    }

/****************** les méthodes ******************************/

/* Cette fonction d'enregistrer cette modalité dans la base */ 

     function insert(){ 

		   $sql="INSERT INTO les_modalites_va_multiple (id_modalite, libelle, acteur, 
											 type_choix, id_arbre)
							
				VALUES('', '$this->libelle', '$this->acteur',  '$this->type_choix', '$this->id_arbre'
						) ";
										
			$result = $this->bdd->executer($sql);
			$this->id_modalite = mysql_insert_id();												

											 	 
	 }

/* Cette fonction mét à hjour cette modalite dans la base de données*/ 

     function update(){
	       
		   $sql="UPDATE  les_modalites_va_multiple
				 SET  libelle = '$this->libelle', 
				 	  acteur = '$this->acteur', 					 
					  type_choix = '$this->type_choix',					       				 
					  id_arbre= '$this->id_arbre'
					  
				 WHERE id_modalite= '$this->id_modalite';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* Cette fonction  permet modifier les périodes de validation de cette  modalités  */ 

     function update_periodes($les_id_periode){
	       
		if(is_array($les_id_periode) && count($les_id_periode) > 0) { 
   		   
		   $sql= "DELETE FROM  les_periodes_modalite_va_multiple
				  WHERE   id_modalite = '$this->id_modalite'";
				  
		   $result = $this->bdd->executer($sql);
		   
		    $sql= "INSERT INTO  les_periodes_modalite_va_multiple(id_periode, id_modalite)
				  VALUES ";
			 
			  
			  $virgule = "";
			  
			  foreach($les_id_periode as $id_periode) {
				  $sql .= " 
				  		$virgule
			    		 (
  						  '$id_periode' ,
						  '$this->id_modalite' 
						  )			 			   
						";
						
					$virgule = ",";
				}
				
				$result = $this->bdd->executer($sql);
		   
		}																					 	 	 	 	 									
	 }
	 
/* Cette fonction  la liste des périodes qui doivent être validées par cette modalité */ 

     function get_periodes(){
	          		   
		   $sql= "SELECT A.id_periode, A.libelle
				  FROM  les_periodes A, les_periodes_modalite_va_multiple B
				  WHERE   A.id_periode = B.id_periode and B.id_modalite = '$this->id_modalite'
				  ORDER BY A.rang
				  ";
				
			$result = $this->bdd->executer($sql);
			
			$les_periodes = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
				
				$periode = new Periode($ligne['id_periode']);
				$periode->libelle = $ligne['libelle'];
				$les_periodes[] = $periode;
				
			}																							
			return $les_periodes; 
	
	 }

/* Cette fonction  la liste des identifiants des périodes deveront être validées par cette modalité */ 

     function get_id_periodes(){
	          		   
		   $sql= "SELECT id_periode
				  FROM  les_periodes_modalite_va_multiple 
				  WHERE id_modalite = '$this->id_modalite'";
				
			$result = $this->bdd->executer($sql);
			
			$les_id_periode = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {												
				
				$les_id_periode[] = $ligne['id_periode'];;
				
			}																							
			return $les_id_periode; 
	
	 }

/* Cette fonction  permet supprimer cette modalité de la base de données*/ 

     function delete(){
	       
		   $sql="DELETE FROM les_modalites_va_multiple				 					  
				 WHERE id_modalite= '$this->id_modalite';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* 
	Cette fonction renvoit la  liste des coix possible de cette modalite

*/ 
    
	 function get_choix() { 
           
		  $sql="SELECT id_choix
 			 	FROM les_choix_modalite_multiple
    		 	WHERE id_modalite ='$this->id_modalite'
				";
				$result = $this->bdd->executer($sql);				
			
			$les_choix = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
			
					$choix = new Choix_modalite_multiple($ligne['id_choix']);
					$choix ->set_detail();
					$les_choix[] = $choix;
			}
			return $les_choix;
	}			


/* Cette fonction  permet de fixer tous les attributs de cette classe*/ 
	
	function set_detail(){
         
		 $sql="SELECT *
		       FROM les_modalites_va_multiple
			   WHERE  id_modalite ='$this->id_modalite'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
				
				$this->libelle = $ligne['libelle'];
				$this->acteur = $ligne['acteur'];								
				$this->type_choix = $ligne['type_choix'];																		
				$this->id_arbre = $ligne['id_arbre'];
			}																							
	}    




}
?>
