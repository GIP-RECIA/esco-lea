<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 26/08/05
/***********************************************************/
include_once("file:///C|/Program%20Files/EasyPHP1-8/www/connexion.php");
include_once("file:///C|/Program%20Files/EasyPHP1-8/www/stdlib.php");
include_once("../classe_formation.php");
include_once("../classe_chapitre.php");
/***********************************************************/

class Matiere{

      	var $id_mat;
        var $libelle; 
		var $sous_ue="NC";
		var $objectif="NC"; 
		var $contenu="NC";
		var $semestre="";
		var $date_maj;
		var $id_for;		
					
    function Matiere($id_mat) {
        $this->id_mat=$id_mat;
    }

/****************** les méthodes ******************************/

/* Cette fonction  permet de d'enregistrer les données de la matière dans la base*/ 
     function insert(){ 
	   if  ($this->libelle!="") { 
		   $sql="INSERT INTO les_matieres
		         (id_mat, libelle, sous_ue, objectif, contenu, semestre, date_maj, id_for)
				VALUES('', '$this->libelle', '$this->sous_ue', '$this->objectif', 
						'$this->contenu', '$this->semestre', CURDATE(), '$this->id_for')";
										
			$result = executer($sql);
			$this->id_mat=mysql_insert_id(); // identifiant de la matière créée.	
						
			return(1);
		}			 	 
	 }
	 
/* Cette fonction  permet de modifier les données de la matiere dans la base*/ 

     function update(){ 
	    
		if  ($this->libelle!="") {
		   
		   $sql="UPDATE les_matieres
		         SET libelle='$this->libelle', sous_ue='$this->sous_ue', 
				     objectif='$this->objectif',  contenu='$this->contenu',
					 semestre='$this->semestre', date_maj=CURDATE(),id_for='$this->id_for'					 					
				WHERE id_mat='$this->id_mat'";
				
			$result = executer($sql);
			
		}			 	 	 	 	 							
	 }
	 
/* Cette fonction  permet de supprimer la matière dans la base de données*/ 

     function delete(){
	       
		   $sql="DELETE FROM les_matieres		         
				 WHERE id_mat='$this->id_mat'";				
			$result = executer($sql);																					 	 	 	 	 									
	 }

/* Cette fonction  permet de supprimer  tous les chapitres de cette matière*/ 

     function delete_all_chapitres(){

   		   $sql="DELETE FROM  les_chapitres 
				 WHERE id_mat='$this->id_mat'";	   		   
			$result = executer($sql);									 	 	 	 	 									
	 }

/* Cette fonction renvoit l'identifiant de la formation de cette matière */ 
    
	 function get_id_for() {
     	
		 $sql="SELECT  id_for
			   FROM les_matieres 
			   WHERE id_mat='$this->id_mat' ";	   		   

			$result = executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {  
			return $ligne['id_for'];	
			} 
			
    }

/* Cette fonction  permet de récupérer de la base de données tous les chapitres 
de  cette matière.
*/ 

     function get_les_chapitres(){
	       
		   $sql="SELECT * 
		   		 FROM  les_chapitres		         
				 WHERE id_mat='$this->id_mat'
				 ORDER BY theme";				
			$result = executer($sql);
			
			while ($ligne = mysql_fetch_assoc($result)) {
				$chapitre=new Chapitre($ligne['id_chap']);		
				$chapitre->libelle=htmlentities($ligne['libelle'],ENT_QUOTES, "UTF-8");
				$chapitre->theme=htmlentities($ligne['theme'],ENT_QUOTES, "UTF-8");
				$chapitre->id_mat=$ligne['id_mat'];
				
				$les_chapitres[]=$chapitre;
			}
			if (isset($les_chapitres)) return $les_chapitres;	
																								 	 	 	 	 									
	 }

/* Cette fonction  permet de récupérer de la base de données tous les thèmes 
abordé par cette matière.
*/ 

     function get_les_themes(){
	       
		   $sql="SELECT distinct (theme) 
		   		 FROM  les_chapitres		         
				 WHERE id_mat='$this->id_mat'
				 ORDER BY theme";				
			$result = executer($sql);
			
			while ($ligne = mysql_fetch_assoc($result)) {
				
				
				$theme=htmlentities($ligne['theme'],ENT_QUOTES, "UTF-8");
								
				$les_themes[]=$theme;
			}
			if (isset($les_themes)) return $les_themes;	
																								 	 	 	 	 									
	 }


/* Cette fonction  permet de récupérer de la base de données tous les identifiant des enseignant 
ayant le droit de modifier les chapitre de cette matière.
*/ 
     function get_id_enseignants_autorises(){
	       
		   $sql="SELECT id_ens
		   		 FROM  les_enseignants_maj_matieres		         
				 WHERE id_mat='$this->id_mat'
				 ";				
			$result = executer($sql);
			
			while ($ligne = mysql_fetch_assoc($result)) {
				
				
				$les_id_enseignants_autorises[]=$ligne['id_ens'];
			}
			if (isset($les_id_enseignants_autorises)) return $les_id_enseignants_autorises;	
																								 	 	 	 	 									
	 }

/* 
Cette fonction  permet d'attribuer à l'enseignant d'identifiant id_ens le droit de mettre à jour 
les chapitres de cette matière
*/ 

     function insert_droit_maj($id_ens){	       		
           
		   $sql="INSERT INTO les_enseignants_maj_matieres(id_ens, id_mat)	 
				 VALUES ('$id_ens','$this->id_mat')
				 ";				
			$result =mysql_query($sql);
			if($result) return 1;
			else return 0;																											 	 	 	 	 									
	 }

/* 
Cette fonction  permet d'enlever le droit de mettre à jour 
les chapitres de cette matière de l'enseignant d'identifiant id_ens 
*/ 

     function delete_droit_maj($id_ens){
	       
		  $sql="DELETE FROM les_enseignants_maj_matieres 		   		 
				 WHERE id_mat='$this->id_mat' and id_ens='$id_ens';
				 ";				
			$result = executer($sql);           		  																														 	 	 	 	 									
	 }


/* Cette fonction  permet de fixer tous les attributs de la classe matière */ 
	
	function set_detail(){
         
		 $sql="SELECT *
		       FROM les_matieres
			   WHERE  id_mat='$this->id_mat'";	   		   

			$result = executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
						
				$this->libelle=htmlentities($ligne['libelle'],ENT_QUOTES, "UTF-8");
				$this->sous_ue=htmlentities($ligne['sous_ue'],ENT_QUOTES, "UTF-8");
				$this->objectif=htmlentities($ligne['objectif'],ENT_QUOTES, "UTF-8");
				$this->contenu=htmlentities($ligne['contenu'],ENT_QUOTES, "UTF-8");
				$this->semestre=$ligne['semestre'];
				$this->date_maj=trans_date($ligne['date_maj']);				
				$this->id_for=$ligne['id_for'];														
			}																							
	}    
	  	  
}
?>