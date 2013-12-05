<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 09/01/06
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea_pdo.php");

/***********************************************************/

class Noeud{

	var $id_noeud;
    var $libelle;
	var $id_arbre;	
	var $id_noeud_parent; 
	var $type; 
	var $niveau;			// le niveau où se trouve ce noeud	
	var $bdd;				// connexion classique a mysql
	var $bdd_pdo;			// connexion via le driver pdo
	
	function Noeud($id_noeud, $id_arbre = 0) {
        $this->id_noeud = $id_noeud;
		$this->bdd = new Connexion_BDD_LEA();
		$this->bdd_pdo = new Connexion_BDD_LEA_PDO( );
		$this->id_arbre = $id_arbre;
    }

/****************** les méthodes ******************************/

	/* 
		Cette fonction  permet d'enregistrer les données du ce noeud dans la base de données
		$id_noeud_parent: l(identifiant du noeud parent de ce noeud.
		si $id_noeud_parent <=0 : ce noeud est un noeud racine
	
	*/ 
     function insert( )
     {
		// Preparation de la requete
		$statement = 'INSERT INTO les_noeuds ( libelle, id_noeud_parent, type, id_arbre) 
				VALUES( :libelle, :idparent, :type, :idarbre)';		
		
		$sth = $this->bdd_pdo->prepare( $statement );

		// Liage des parametres
		$stringValues = array( ':libelle' => $this->libelle, ':type' => $this->type );
		$intValues = array( ':idparent' => $this->id_noeud_parent, ':idarbre' => $this->id_arbre );
		$this->bdd_pdo->bindValues( $sth, $stringValues );
		$this->bdd_pdo->bindValues( $sth, $intValues, PDO::PARAM_INT );
		
		// Execution de la requete
		$this->bdd_pdo->execute( $sth );
		
		// Recuperation de l'id du noeud cree
		$this->id_noeud = $this->bdd_pdo->lastInsertId( 'les_noeuds', 'id_noeud' );
	 }


/* Cette fonction  mét à jour le libelle de ce noeud dans la base*/ 

     function update(){ 

		   $sql="UPDATE les_noeuds
		         SET libelle='$this->libelle',
				     type='$this->type'
				WHERE id_noeud='$this->id_noeud' ";
										
			$result = $this->bdd->executer($sql);				
			
	 }

/* Cette fonction  permet de supprimer le noeud et ses branches de la base de données 
*/ 

     function delete(){           
		   
   		   $sql="DELETE FROM les_noeuds		         
				 WHERE id_noeud='$this->id_noeud' OR id_noeud_parent='$this->id_noeud'";				
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* 
	Cette fonction  mét à jour l'évaluation d'une modalité à réponse numérique 
	appliquée à ce noeud feuille.

*/ 

     function update_evaluation_modalite_va_unique($id_modalite, $evaluation_max){
				
   			   $sql="DELETE FROM les_evaluations_feuilles_modalite_va_unique		    	     
					 WHERE id_modalite = '$id_modalite' and id_noeud = '$this->id_noeud'";
											
				$result = $this->bdd->executer($sql); 																		
							
			   $sql="INSERT INTO les_evaluations_feuilles_modalite_va_unique
		    	     (id_modalite, id_noeud, evaluation_max)
					VALUES('$id_modalite', '$this->id_noeud', '$evaluation_max')";
											
				$result = $this->bdd->executer($sql);		
	
	 }

/* 
	Cette fonction  renvoit l'évaluation d'une modalité à réponse numérique 
	appliquée à ce noeud feuille.

*/ 

     function get_evaluation_modalite_va_unique($id_modalite){
				   			  																									
			   $sql="SELECT evaluation_max
			   		 FROM les_evaluations_feuilles_modalite_va_unique
		    	     WHERE id_noeud = '$this->id_noeud' and id_modalite='$id_modalite'";
											
				$result = $this->bdd->executer($sql);		

				if ($ligne = mysql_fetch_assoc($result)) {
					return $ligne['evaluation_max'];					
					
				}else return 0;

	 }


/* 
	Cette fonction  mét à jour l'évaluation d'un choix de modalité multiple
	appliquée à ce noeud feulle.
*/ 

     function update_evaluation_choix($id_choix, $evaluation_max){
				
   			   $sql="DELETE FROM les_evaluations_feuilles_modalite_choix
					 WHERE id_choix = $id_choix and id_noeud = '$this->id_noeud'";
					 
											
				$result = $this->bdd->executer($sql); 																		
						

			   $sql="INSERT INTO les_evaluations_feuilles_modalite_choix
		    	     (id_choix, id_noeud, evaluation_max)
					VALUES('$id_choix', '$this->id_noeud', '$evaluation_max')";
											
				$result = $this->bdd->executer($sql);
		
	
	 }

/* 
	Cette fonction  renvoit l'évaluation d'un choix de modalité multiple
	appliquée à ce noeud feuille.

*/ 

     function get_evaluation_choix($id_choix){
				   			  																									
			   $sql="SELECT evaluation_max
			   		 FROM les_evaluations_feuilles_modalite_choix
		    	     WHERE id_noeud = '$this->id_noeud' and id_choix='$id_choix'";
											
				$result = $this->bdd->executer($sql);		

				if ($ligne = mysql_fetch_assoc($result)) {
					return $ligne['evaluation_max'];					
					
				}else return 0;

	 }


/* Cette fonction  renvoit la liste des noeuds fils de  ce noeud
 */ 

     function get_noeuds_fils($html=1){

   		   $sql="SELECT *
				 FROM  les_noeuds 
				 WHERE id_noeud_parent='$this->id_noeud' and id_arbre='$this->id_arbre'
				 ";	   		   
			$result = $this->bdd->executer($sql);				
			
			$les_noeuds_fils = array();
						
			while ($ligne = mysql_fetch_assoc($result)) {
			
						$noeud = new Noeud($ligne['id_noeud'], $ligne['id_arbre']);
						 
			 if($html)	$noeud->libelle = htmlentities($ligne['libelle'],ENT_QUOTES, "UTF-8");
			 else 		$noeud->libelle = $ligne['libelle'];
			
						$noeud->id_noeud_parent = $ligne['id_noeud_parent'];
						$noeud->type = $ligne['type'];
						$noeud->id_arbre = $this->id_arbre;
						
						$les_noeuds_fils[]=$noeud;
			}
            
		    return 	$les_noeuds_fils;																	
					 	 	 	 	 									
	 }

/* 
Cette fonction  renvoit un tableau contenant les identifiants des noeuds ascendants de ce noeud).
*/ 

     function get_id_noeuds_ascendants(){
           
		   $id=$this->id_noeud;
		  
		   $les_id_noeuds_ancetres = array();
		   
   		   do {
			     $noeud = new Noeud($id, $this->id_arbre );
				 $noeud->set_detail();
				 
				 $id = $noeud->id_noeud_parent; 
				
				 $les_id_noeuds_ancetres[]=$id;
				 				
		 } while ($id!=0);
		
		 return array_reverse($les_id_noeuds_ancetres); //les noeuds  sont classés dans l'ordre parent->fils
		 
	 }

/* 
Cette fonction  renvoit le numéro du niveau de ce noeud).
*/ 

     function get_niveau(){
           
		   $id=$this->id_noeud;
		  
		   $niveau = 0;
		   
   		   do {
			     $noeud = new Noeud($id, $this->id_arbre );
				 $noeud->set_detail();
				 
				 $id = $noeud->id_noeud_parent; 
				
				 $niveau += 1;
				 				
		 } while ($id!=0);
		
		 return $niveau;
		 
	 }

/* Cette fonction  permet de récupérer de la base de donnéés
	le libellé et l'identifiant du parent  de ce noeud  
*/ 
	
	function set_detail($html=1){
         
		 $sql="SELECT *
		       FROM les_noeuds
			   WHERE  id_noeud='$this->id_noeud' ";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
						
						$this->libelle = $ligne['libelle'];			
						$this->type = $ligne['type'];
						$this->id_arbre = $ligne['id_arbre'];			
						$this->id_noeud_parent = $ligne['id_noeud_parent'];				        						
										
			}			
	}    	  	 
			
}// fin de la classe 

?>
