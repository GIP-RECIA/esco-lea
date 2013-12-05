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

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

/***********************************************************/

class Periode{

	var $id_periode;
    var $libelle;      // libelle de la période à déclarer
	var $rang;		   // rang de la période (les périodes sont classées suivant l'ordre de ce rang)
	var $suivi_cfa;    // =1 si cette période se déclare lors du suivi au cfa
	var $suivi_entr;   // =1 si cette période se déclare lors du suivi en entreprise
	var $consult_app;  // =1 si l'apprenti est autorisé à consulter cette période
	var $consult_ma;   // =1 si le maitre d'apprentissage est autorisé à consulter cette période
	var $consult_tuteur_cfa; // =1 si le tuteur cfa est autorisé à consulter cette période
	var $consult_ens; // =1 si n'importe quelle enseignant de la formation  est autorisé à consulter cette période
	var $consult_rl; // =1 si le representant légal est autorisé à consulter cette période	
	var $id_for;      // l'identifiant de la formation qui définit cette période
	var $bdd;
	
	function Periode($id_periode) {
        $this->id_periode = $id_periode;
		$this->bdd = new Connexion_BDD_LEA();		
    }

/****************** les méthodes ******************************/

/* 
	Cette fonction  permet d'enregistrer le libelle du cette periode dans la base de données
*/ 

     function insert(){

			   $sql="INSERT INTO les_periodes
		    	     (
					 id_periode, 
					 libelle, 
					 rang, 
					 suivi_cfa, 
					 suivi_entr,
					 consult_app,
					 consult_ma,
					 consult_tuteur_cfa,
					 consult_ens,					 
					 consult_rl,					 
					 id_for)
					VALUES('', 
							'$this->libelle' , 
							'$this->rang' , 
							'$this->suivi_cfa' , 
							'$this->suivi_entr' , 
							'$this->consult_app' ,
							'$this->consult_ma' ,
							'$this->consult_tuteur_cfa' ,
							'$this->consult_ens' ,					 
							'$this->consult_rl' ,
							'$this->id_for'
							)";
											
				$result = $this->bdd->executer($sql); 
				$this->id_periode = mysql_insert_id(); 
	
	 }


/* Cette fonction  mét à jour le libelle de cette période dans la base de donnée*/ 

     function update(){ 

		   $sql="UPDATE les_periodes
		         SET 
				 	libelle = '$this->libelle',
				 	rang = '$this->rang',
					suivi_cfa = '$this->suivi_cfa',
				 	suivi_entr = '$this->suivi_entr' ,								
					consult_app = '$this->consult_app' ,
					consult_ma  = '$this->consult_ma' ,
					consult_tuteur_cfa = '$this->consult_tuteur_cfa' ,
					consult_ens	= '$this->consult_ens' ,					 
					consult_rl = '$this->consult_rl' 

				WHERE id_periode ='$this->id_periode' ";
										
			$result = $this->bdd->executer($sql);				
			
	 }

/* Cette fonction  permet de supprimer cette période de la base de données
*/ 

     function delete(){           
		   
   		   $sql="DELETE FROM les_periodes        
				 WHERE id_periode ='$this->id_periode'";				
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }

/* 
	Cette fonction  permet d'ajouter la classe d'identifiant $id_cla à
	la liste des classes deveront déclarer cette période
*/ 

     function ajouter_classe($id_cla, $date_debut_cfa ="2005-01-01", $date_fin_cfa ="2015-01-01", $date_debut_entr="2005-01-01",  $date_fin_entr="2015-01-01" ){ 		  						   
		   
		   $sql = "INSERT INTO les_periodes_classes
		   						(
								 id_periode, 
								 id_cla, 
								 date_debut_cfa,
								 date_fin_cfa,
								 date_debut_entr,
								 date_fin_entr

								 )		         
				  VALUES         (
				 				  '$this->id_periode', 
								  '$id_cla',
							      '$date_debut_cfa',
							      '$date_fin_cfa',								  
							      '$date_debut_entr',								  
							      '$date_fin_entr'								  
								 )
				"; 
										
			$result = $this->bdd->executer($sql);				

			
	 }

/* 
	Cette fonction  permet modifier le calendrier de  la classe d'identifiant $id_cla 
	pour cette période
*/ 

     function update_classe($id_cla, $date_debut_cfa ="", $date_fin_cfa ="", $date_debut_entr="",  $date_fin_entr="" ){ 
		  						   
		   
		   $sql = "UPDATE les_periodes_classes
		   		   SET		
						date_debut_cfa  = '$date_debut_cfa',
						date_fin_cfa    = '$date_fin_cfa',
						date_debut_entr = '$date_debut_entr',
						date_fin_entr   = '$date_fin_entr'
						
			 	  WHERE id_periode ='$this->id_periode' and id_cla ='$id_cla'
				"; 
										
			$result = $this->bdd->executer($sql);				

			
	 }

/* 
	Cette fonction  permet supprimer la classe d'identifiant $id_cla de
	la liste des classes deveront déclarer cette période
*/ 

     function supprimer_classe($id_cla){ 		  				
			
		   $sql = "DELETE FROM les_periodes_classes
		   	 	   WHERE id_periode='$this->id_periode' and id_cla='$id_cla'			
				  "; 
										
			$result = $this->bdd->executer($sql);				

			
	 }


/* 
Cette fonction renvoit un tableau contenant tous les identifiants des classes 
doiveront déclarer cette période
*/ 
    
	 function get_id_classes() {
           
		   $sql="SELECT id_cla
				 FROM  les_periodes_classes 
				 WHERE id_periode ='$this->id_periode'
				";	
				    		   
			$result = $this->bdd->executer($sql);				
			
			$les_id_classes = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
			 $les_id_classes[] = $ligne['id_cla']; 				
			}
			
			mysql_free_result($result);
			
			return $les_id_classes;			
      }	

/* 
   Cette fonction  permet de tester si les apprentis de la classes d'identifiant 
   $id_cla doivent déclarer cette période 
*/ 
	
	function est_declaree_par($id_cla){
         
		 $sql="SELECT *
		       FROM   les_periodes_classes
			   WHERE  id_periode ='$this->id_periode' and id_cla='$id_cla'  ";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
				 return 1;									
			}
			else return 0;			
	}    	  	 

/* 
  Cette fonction renvoit un tableau asociatif  contenant toutes les dates 
  correspondantes à cette période qui doit être déclarée par les apprentis de la classe
  d'identifiant $id_cla
 */ 
    
	 function get_calendrier($id_cla) {
           
		   $sql="SELECT date_debut_cfa, date_fin_cfa, date_debut_entr, date_fin_entr
				 FROM  les_periodes_classes 
				 WHERE id_periode ='$this->id_periode' and id_cla='$id_cla'
				";	
				    		   
			$result = $this->bdd->executer($sql);				
			
			$tab_dates = array();
			
			if ($ligne = mysql_fetch_assoc($result)) {

			 $tab_dates['date_debut_cfa']  = $ligne['date_debut_cfa'] ;
			 $tab_dates['date_fin_cfa']	   = $ligne['date_fin_cfa'] ;
			 $tab_dates['date_debut_entr'] = $ligne['date_debut_entr'] ;
			 $tab_dates['date_fin_entr']   = $ligne['date_fin_entr'] ;
			 			 				
			}
			
			mysql_free_result($result);
			
			return $tab_dates;			
      }	


/* 
  Cette fonction renvoit 1
  si cette  période peut être déclarée par les apprentis de la classe
  d'identifiant $id_cla lors du suivi $type_suivi
  si non  elle renvoit 0
*/ 
    
	 function se_declare_par($id_cla, $type_suivi, $config_lea) {
           
		   
		   if($type_suivi == 'cfa') {
		   			$date_debut = 'date_debut_cfa';
					$date_fin = 'date_fin_cfa';
					$delai = $config_lea->DMSA_dec_cfa;
			}
			elseif($type_suivi == 'entr') {
					$date_debut = 'date_debut_entr';
					$date_fin = 'date_fin_entr';
					$delai = $config_lea->DMSA_dec_entr;
			}
			else return 0;										
		   
		   $sql = "SELECT 	$date_debut, $date_fin
				   FROM  les_periodes_classes 
				   WHERE 
				   	id_periode ='$this->id_periode' and id_cla='$id_cla' and 
					(TO_DAYS(CURDATE()) >= TO_DAYS($date_debut) )   	 and 
					(TO_DAYS(CURDATE()) <= TO_DAYS($date_fin) + $delai )

				  ";	
			
				    		   
			$result = $this->bdd->executer($sql);				
			
			
			if ($ligne = mysql_fetch_assoc($result)) 
				 return 1;			 			 			 				
			else return 0 ;
			
      }	



/* Cette fonction  permet de récupérer le libelle de cette période
	de la base de donnéés 
*/ 
	
	function set_detail(){
         
		 $sql="SELECT *
		       FROM   les_periodes
			   WHERE  id_periode ='$this->id_periode' ";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
									
				       $this->libelle 	= $ligne['libelle'];
				       $this->rang 	  	= $ligne['rang'];
					   $this->suivi_cfa = $ligne['suivi_cfa'];
				       $this->suivi_entr = $ligne['suivi_entr'];
					   $this->consult_app = $ligne['consult_app'];
					   $this->consult_ma = $ligne['consult_ma'];					   
					   $this->consult_tuteur_cfa = $ligne['consult_tuteur_cfa'];
					   $this->consult_ens = $ligne['consult_ens'];
					   $this->consult_rl = $ligne['consult_rl'];
					   $this->id_for  	= $ligne['id_for'];				        						
										
			}			
	}    	  	 
			
}// fin de la classe 

?>
