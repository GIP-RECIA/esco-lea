<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 04/03/06
  //Contenu: Cette Classe gère les modalités de déclarations utilsées pour faire un suivi libre
  //		  ces modalités ayant  pour réponse une liste de choix. 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_choix_reponse.php");
/***********************************************************/

class Modalite_reponse_choix{

      	var $id_modalite;   				  // identifiant du de la modalite
		var $libelle;          			  	  // le libelle la modalite
		var $acteur ;             			  // acteur concerné par cette modalite 
											  // (acteur = app => apprenti)
											  // (acteur = ma => maitre apprentissage)
											  // (acteur = tuteur_cfa => Tuteur de l'apprenti au CFA)
											  // (acteur = rl => Représentant légal de l'apprenti)
											  // (acteur = responsable => responsable de la formation de l'apprenti)												  
											  
		var $type_suivi;         			  // type_suivi = entr => modalité utilsée pour le suivi entreprise
											  // type_suivi = cfa => modalité utilsée pour le suivi au CFA		
		var $type_choix = 'unique';			  // type_choix = unique => on n'autorise pas le choix multiple 
											  // type_choix = multiple => on  le choix multiple  
		var $id_config;           
		var $bdd;
					
    function Modalite_reponse_choix($id_modalite) {
	
		$this->bdd = new Connexion_BDD_LEA();
        $this->id_modalite = $id_modalite;
    }

/****************** les méthodes ******************************/

/* Cette fonction  permet d'enrégistrer cette modalité   dans la base  de données*/ 

     function insert(){ 

		   $sql="INSERT INTO les_modalites_reponse_choix (id_modalite, libelle, acteur, type_suivi, 
		   					type_choix, id_config)
							
				VALUES('', '$this->libelle', '$this->acteur', '$this->type_suivi', '$this->type_choix',
							 '$this->id_config') ";
										
			$result = $this->bdd->executer($sql);
			$this->id_modalite = mysql_insert_id(); 	
									 	 
	 }

/* Cette fonction mét à jour les données de cette modalité dans la base de données*/ 

     function update(){
	       
		   $sql="UPDATE  les_modalites_reponse_choix
				 SET  libelle = '$this->libelle', 
				 	  acteur = '$this->acteur', 
					  type_suivi = '$this->type_suivi',
					  type_choix = '$this->type_choix',					   					 
					  id_config = '$this->id_config'
					  
				 WHERE id_modalite= '$this->id_modalite';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* Cette fonction  permet modifier les périodes de validation de cette  modalités  */ 

     function update_periodes($les_id_periode){
	       
		if(is_array($les_id_periode) && count($les_id_periode) > 0) { 
   		   
		   $sql= "DELETE FROM  les_periodes_modalite_reponse_choix
				  WHERE   id_modalite = '$this->id_modalite'";
				  
		   $result = $this->bdd->executer($sql);
		   
		    $sql= "INSERT INTO  les_periodes_modalite_reponse_choix(id_periode, id_modalite)
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
				  FROM  les_periodes A, les_periodes_modalite_reponse_choix B
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
				  FROM  les_periodes_modalite_reponse_choix 
				  WHERE id_modalite = '$this->id_modalite'";
				
			$result = $this->bdd->executer($sql);
			
			$les_id_periode = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {												
				
				$les_id_periode[] = $ligne['id_periode'];;
				
			}																							
			return $les_id_periode; 
	
	 }


/* Cette fonction  permet de  supprimer cette modalité de la base de données*/ 

     function delete(){
	       
		   $sql="DELETE FROM les_modalites_reponse_choix				 					  
				 WHERE id_modalite= '$this->id_modalite';
				 ";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* 
	Cette fonction renvoit la liste des réponses possibles (choix possibles) à cette modalité

*/ 
    
	 function get_reponses() { 
           
		  $sql="SELECT id_reponse
 			 	FROM les_choix_reponse
    		 	WHERE id_modalite ='$this->id_modalite'
				";
				$result = $this->bdd->executer($sql);				
			
			$les_reponses = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
			
					$reponse = new Choix_reponse($ligne['id_reponse']);
					$reponse ->set_detail();
					$les_reponses[] = $reponse;
			}
			return $les_reponses;
	}			

/* Cette fonction  permet de fixer tous les attributs de cette classe*/ 
	
	function set_detail(){
         
		 $sql="SELECT *
		       FROM les_modalites_reponse_choix
			   WHERE  id_modalite ='$this->id_modalite'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
				
				$this->libelle = $ligne['libelle'];
				$this->acteur = $ligne['acteur'];
				$this->type_suivi = $ligne['type_suivi'];
				$this->type_choix = $ligne['type_choix'];														
				$this->id_config = $ligne['id_config'];
			}																							
	}    



}
?>
