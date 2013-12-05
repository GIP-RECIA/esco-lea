<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 09/03/06
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

/***********************************************************/

class Charte_graphique{

	var $id_charte;
	var $logo		="default_logo.gif";   // le logo de la formation d'identifiant id_for	
	var $img_accueil="default_img_accueil.png"; // l'image de la page d'accueil
	var $bandeau 	="default_bandeau.jpg"; 		// le bandeau de la formation
	var $logo_cfa 	="default_logo_cfa.png";		// le logo du cfa de la formation d'identifiant $id_for
	var $theme 		="cub_default";			// le theme appliquï¿½e
	var $id_for;     		// l'identifiant de la formation ayan dï¿½fini cette charte
	var $bdd;
	
	function Charte_graphique($id_charte) {
        $this->id_charte = $id_charte;
		$this->bdd = new Connexion_BDD_LEA();		
    }

/****************** les mï¿½thodes ******************************/

/* 
	Cette fonction  permet d'enregistrer la charte graphique  dans la base de donnï¿½es
*/ 

     function insert(){

			   $sql="INSERT INTO les_chartes_graphiques
		    	     (id_charte, 
					  logo, 					  
					  img_accueil,
					  bandeau,
					  logo_cfa,
					  theme,
					  id_for
					  )
					VALUES('', 
						  '$this->logo' , 						  
						  '$this->img_accueil',
						  '$this->bandeau',
						  '$this->logo_cfa',
						  '$this->theme',
    					  '$this->id_for')";
											
				$result = $this->bdd->executer($sql); 
				$this->id_charte = mysql_insert_id(); 
	
	 }


/* 
	Cette fonction  remplace  l'ancienne valeur de l'attribut  $attr par la valeur $value
*/ 

     function update($attr, $value){ 

		   $sql="UPDATE les_chartes_graphiques
		         SET $attr ='$value'
				WHERE id_charte ='$this->id_charte' ";
										
			$result = $this->bdd->executer($sql);				
			
	 }

/* 
   Cette fonction  permet de rï¿½cupï¿½rer les donnï¿½es de cette charte 
   de la base de donnï¿½ï¿½s 
*/ 
	
	function set_detail(){
         
		 $sql="SELECT *
		       FROM   les_chartes_graphiques
			   WHERE  id_charte ='$this->id_charte' ";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
									
				     $this->logo = $ligne['logo'];					  
					 $this->img_accueil = $ligne['img_accueil'];					  									
				   	 $this->bandeau = $ligne['bandeau'];
					 $this->logo_cfa = $ligne['logo_cfa'];
					 $this->theme = $ligne['theme'];
					 $this->id_for = $ligne['id_for'];				        																
			}			
	}    	  	 
			
}// fin de la classe 

?>
