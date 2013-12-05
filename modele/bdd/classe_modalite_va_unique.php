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

class Modalite_va_unique { // Modalité de validation à  unique réponse

      	var $id_modalite;   	  //identifiant du de la modalite
		var $libelle;            // libellé de la modalité		
		var $acteur;             // acteur concerné par cette modalité
		var $type_reponse;       // La nature de réponse attendue : texte, frequence ou   note
		var $id_arbre;           // l'identifiant de l'arbre sur lequel on applique cette modalité		
		var $bdd;
					
    function Modalite_va_unique($id_modalite) {
	
		$this->bdd = new Connexion_BDD_LEA();
        $this->id_modalite = $id_modalite;
    }

/****************** les méthodes ******************************/

/* Cette fonction d'enregistrer cette modalité dans la base */ 

     function insert(){ 

		   $sql="INSERT INTO les_modalites_va_unique (id_modalite, libelle,
		   					 acteur, type_reponse, id_arbre)
							
				VALUES('', '$this->libelle', '$this->acteur', '$this->type_reponse','$this->id_arbre'
						) ";
										
			$result = $this->bdd->executer($sql);
			$this->id_modalite = mysql_insert_id(); 

			/*
			if($this->type_reponse =='frequence' ) 
					$default_eval = 1;							
			elseif($this->type_reponse =='note' )
					$default_eval = 20;
			else return;
			
			$arbre = new Arbre($this->id_arbre); 	
			$les_feuilles = $arbre->get_feuilles() ;
			
			foreach($les_feuilles as $feuille){
				$feuille->update_evaluation_modalite_va_unique($this->id_modalite, $default_eval );		
			}	
			*/						 	 
	 }

/* Cette fonction mét à hjour cette modalite dans la base de données*/ 

     function update(){
	       
		   $sql="UPDATE  les_modalites_va_unique
				 SET  libelle = '$this->libelle', 
				 	  acteur = '$this->acteur', 
					  type_reponse = '$this->type_reponse',					 					  				 
					  id_arbre= '$this->id_arbre'
					  
				 WHERE id_modalite= '$this->id_modalite';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* Cette fonction  permet modifier les périodes de validation de cette  modalités  */ 

     function update_periodes($les_id_periode){
	       
		if(is_array($les_id_periode) && count($les_id_periode) > 0) { 
   		   
		   $sql= "DELETE FROM  les_periodes_modalite_va_unique
				  WHERE   id_modalite = '$this->id_modalite'";
				  
		   $result = $this->bdd->executer($sql);
		   
		    $sql= "INSERT INTO  les_periodes_modalite_va_unique(id_periode, id_modalite)
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
				  FROM  les_periodes A, les_periodes_modalite_va_unique B
				  WHERE   A.id_periode = B.id_periode and B.id_modalite = '$this->id_modalite'
				  ORDER BY A.rang";
				
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
				  FROM  les_periodes_modalite_va_unique 
				  WHERE id_modalite = '$this->id_modalite'";
				
			$result = $this->bdd->executer($sql);
			
			$les_id_periode = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {												
				
				$les_id_periode[] = $ligne['id_periode'];;
				
			}																							
			return $les_id_periode; 
	
	 }


/* Cette fonction  permet de supprimer cette modalité de la base de données*/ 

     function delete(){
	       
		   $sql="DELETE FROM les_modalites_va_unique					  
				 WHERE id_modalite= '$this->id_modalite';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* Cette fonction  permet de fixer tous les attributs de cette classe */ 
	
	function set_detail(){
         
		 $sql="SELECT *
		       FROM les_modalites_va_unique
			   WHERE  id_modalite ='$this->id_modalite'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
				
				$this->libelle = $ligne['libelle'];
				$this->acteur = $ligne['acteur'];
				$this->type_reponse = $ligne['type_reponse'];																										
				$this->id_arbre = $ligne['id_arbre'];
			}																							
	}    

}
?>