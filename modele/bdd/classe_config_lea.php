<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 04/03/06
  // Contenu: Cette classe gï¿½re la  configration LEA d'une formation
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_modalite_reponse_libre.php");
require_once ($LEA_REP."modele/bdd/classe_modalite_reponse_choix.php");
require_once ($LEA_REP."modele/bdd/classe_terminologie.php");

/***********************************************************/

class Config_lea{

      	var $id_config;   		   //identifiant du de la configuration
		var $suivi_entr_guide_actif = 0; // activer le suivi guidï¿½ en entreprise
		var $suivi_entr_libre_actif = 0; // activer le suivi libre en entreprise
		var $suivi_cfa_guide_actif  = 0; // activer le suivi guidï¿½ en entreprise
		var $suivi_cfa_libre_actif  = 0; // activer le suivi libre en entreprise	
		var $config_term; 	
		var $appelation_ma ;
		var $appelation_tuteur_cfa ;
		var $appelation_app ;
		var $appelation_classe;
		var $appelation_rl;
		var $appelation_ens;
		var $appelation_rf;
		var $appelation_entr;
		var $appelation_suivi_cfa ;
		var $appelation_suivi_entr;
		var $DMSA_dec_cfa = 15;  		 // durï¿½e maximale pour une signature automatique dï¿½une dï¿½claration cfa (durï¿½e d'activation d'une dï¿½claration cfa)
		var $DMSA_dec_entr = 15;  		 // durï¿½e maximale pour une signature automatique dï¿½une dï¿½claration entreprise (durï¿½e d'activation d'une dï¿½claration entreprise)		
		var $app_joint_fichiers_suivi_entr = 1; //=1 si l'apprenti est autorisï¿½ ï¿½ joindre  des fichiers lors de sa  declaration des travaux effectuï¿½s  en entreprise 
		var $app_joint_fichiers_suivi_cfa = 1;  //=1 si l'apprenti est autorisï¿½ ï¿½ joindre  des fichiers lors de sa  declaration des travaux effectuï¿½s  au cfa 		
		var $id_for;  		 			 // identifiant de la formation concernï¿½e par cette configuration
		var $bdd;
	/**
	 * Constructeur
	 */				
    function Config_lea($id_config) {
	
		$this->bdd = new Connexion_BDD_LEA();
        $this->id_config = $id_config;
        
        $this->config_term = new Terminologie();
        $this->config_term->set_detail();
        
        $this->appelation_ma = $this->config_term->terminologie_ma;
        $this->appelation_tuteur_cfa = $this->config_term->terminologie_tuteur_cfa;
        $this->appelation_app = $this->config_term->terminologie_app;
        $this->appelation_classe = $this->config_term->terminologie_classe;
        $this->appelation_rl = $this->config_term->terminologie_rl;
        $this->appelation_ens = $this->config_term->terminologie_ens;
        $this->appelation_entr = $this->config_term->terminologie_entr;
        $this->appelation_suivi_cfa = $this->config_term->terminologie_suivi_cfa;
        $this->appelation_suivi_entr = $this->config_term->terminologie_suivi_entr;
        $this->appelation_rf = $this->config_term->terminologie_rf;
    }
/****************** les mï¿½thodes ******************************/

/* Cette fonction  permet d'enregistrer les donnï¿½es  de la configuration dans la base*/ 
     function insert(){ 

		   $sql="INSERT INTO les_configs_lea (
		   						id_config, 
		   						suivi_entr_guide_actif, 
								suivi_entr_libre_actif,
		   						suivi_cfa_guide_actif, 
								suivi_cfa_libre_actif, 								
								appelation_ma, 
		   						appelation_tuteur_cfa, 
								DMSA_dec_cfa, 
								DMSA_dec_entr, 
								app_joint_fichiers_suivi_cfa, 
								app_joint_fichiers_suivi_entr, 
								id_for,
								appelation_app,
								appelation_classe,
								appelation_rl,
								appelation_ens,
								appelation_entr,
								appelation_suivi_cfa,
								appelation_suivi_entr)
							
					VALUES( 
							'',  
							'$this->suivi_entr_guide_actif', 
							'$this->suivi_entr_libre_actif', 
							'$this->suivi_cfa_guide_actif', 
							'$this->suivi_cfa_libre_actif', 
							'".addslashes($this->appelation_ma)."', 
							'".addslashes($this->appelation_tuteur_cfa)."', 
							'$this->DMSA_dec_cfa',
							'$this->DMSA_dec_entr', 
							'$this->app_joint_fichiers_suivi_cfa', 
							'$this->app_joint_fichiers_suivi_entr', 
							'$this->id_for',
							'".addslashes($this->appelation_app)."',
							'".addslashes($this->appelation_classe)."',
							'".addslashes($this->appelation_rl)."',
							'".addslashes($this->appelation_ens)."',
							'".addslashes($this->appelation_entr)."',
							'".addslashes($this->appelation_suivi_cfa)."',
							'".addslashes($this->appelation_suivi_entr)."') ";
										
			$result = $this->bdd->executer($sql);
			$this->id_config =mysql_insert_id(); 					 	 
	 }
/* Cette fonction  mï¿½t ï¿½ jour cette configuration */ 
     function update(){
	       
		   $sql="UPDATE  les_configs_lea
				 SET  	suivi_entr_guide_actif = '".addslashes($this->suivi_entr_guide_actif)."', 
				 	  	suivi_entr_libre_actif = '".addslashes($this->suivi_entr_libre_actif)."', 
					  	suivi_cfa_guide_actif = '".addslashes($this->suivi_cfa_guide_actif)."', 
				 	  	suivi_cfa_libre_actif = '".addslashes($this->suivi_cfa_libre_actif)."', 
					  	appelation_ma = '".addslashes($this->appelation_ma)."',					   
    				  	appelation_tuteur_cfa = '".addslashes($this->appelation_tuteur_cfa)."',
					  	DMSA_dec_cfa = '".addslashes($this->DMSA_dec_cfa)."',
					  	DMSA_dec_entr = '".addslashes($this->DMSA_dec_entr)."',
					  	app_joint_fichiers_suivi_cfa = '".addslashes($this->app_joint_fichiers_suivi_cfa)."',
					  	app_joint_fichiers_suivi_entr = '".addslashes($this->app_joint_fichiers_suivi_entr)."',
					  	id_for = '".addslashes($this->id_for)."',
					  	appelation_app = '".addslashes($this->appelation_app)."',
					  	appelation_classe = '".addslashes($this->appelation_classe)."',
						appelation_rl = '".addslashes($this->appelation_rl)."',
						appelation_ens = '".addslashes($this->appelation_ens)."',
						appelation_entr = '".addslashes($this->appelation_entr)."',
						appelation_suivi_cfa = '".addslashes($this->appelation_suivi_cfa)."',
						appelation_suivi_entr = '".addslashes($this->appelation_suivi_entr)."'
					  
				 WHERE id_config = '$this->id_config';";				
				 
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }
/* Cette fonction  permet de fixer tous les attributs de la classe Config_lea */ 
	function set_detail(){
		 $sql="SELECT *
		       FROM les_configs_lea
			   WHERE  id_config ='$this->id_config'";	   		   

			$result = $this->bdd->executer($sql);				
			
			if ($ligne = mysql_fetch_assoc($result)) {
				
				$this->suivi_entr_guide_actif = stripslashes($ligne['suivi_entr_guide_actif']);
				$this->suivi_entr_libre_actif = stripslashes($ligne['suivi_entr_libre_actif']);
				$this->suivi_cfa_guide_actif = stripslashes($ligne['suivi_cfa_guide_actif']);
				$this->suivi_cfa_libre_actif = stripslashes($ligne['suivi_cfa_libre_actif']);
				if(isset($ligne['appelation_ma']) && $ligne['appelation_ma'] != '') $this->appelation_ma = stripslashes($ligne['appelation_ma']);
				if(isset($ligne['appelation_tuteur_cfa']) && $ligne['appelation_tuteur_cfa'] != '') $this->appelation_tuteur_cfa = stripslashes($ligne['appelation_tuteur_cfa']);			
				$this->DMSA_dec_entr = stripslashes($ligne['DMSA_dec_entr']);
				$this->DMSA_dec_cfa = stripslashes($ligne['DMSA_dec_cfa']);
				$this->app_joint_fichiers_suivi_entr = stripslashes($ligne['app_joint_fichiers_suivi_entr']);
				$this->app_joint_fichiers_suivi_cfa = stripslashes($ligne['app_joint_fichiers_suivi_cfa']);
				$this->id_for = stripslashes($ligne['id_for']);
				if(isset($ligne['appelation_app']) && $ligne['appelation_app'] != '') $this->appelation_app = stripslashes($ligne['appelation_app']);
				if(isset($ligne['appelation_classe']) && $ligne['appelation_classe'] != '') $this->appelation_classe = stripslashes($ligne['appelation_classe']);
				if(isset($ligne['appelation_rl']) && $ligne['appelation_rl'] != '') $this->appelation_rl = stripslashes($ligne['appelation_rl']);
				if(isset($ligne['appelation_ens']) && $ligne['appelation_ens'] != '') $this->appelation_ens = stripslashes($ligne['appelation_ens']);
				if(isset($ligne['appelation_entr']) && $ligne['appelation_entr'] != '') $this->appelation_entr = stripslashes($ligne['appelation_entr']);
				if(isset($ligne['appelation_suivi_cfa']) && $ligne['appelation_suivi_cfa'] != '') $this->appelation_suivi_cfa = stripslashes($ligne['appelation_suivi_cfa']);
				if(isset($ligne['appelation_suivi_entr']) && $ligne['appelation_suivi_entr'] != '') $this->appelation_suivi_entr = stripslashes($ligne['appelation_suivi_entr']);
			}																							
	}
/* 
	Cette fonction renvoit la liste des arbres   crï¿½ï¿½s pour le suivi $type (entr, cfa)
	
*/ 
	 function get_arbres($type) { 
          
		  if( ($type=='cfa' && !$this->suivi_cfa_guide_actif ) ||
		  	  ($type=='entr' && !$this->suivi_entr_guide_actif ) )	 
		  	return array();
		  
		  $sql="SELECT id_arbre, nom, type, valider_all_feuilles, id_config
 			 	FROM les_arbres
    		 	WHERE id_config ='$this->id_config' and type ='$type'
				";
			$result = $this->bdd->executer($sql);				
			
			$les_arbres = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
					
					$arbre = new Arbre($ligne['id_arbre']);					
					$arbre->nom = $ligne['nom'];
					$arbre->type = $ligne['type'];
					$arbre->valider_all_feuilles = $ligne['valider_all_feuilles'];
					$arbre->id_config = $ligne['id_config'];
					
					$les_arbres[] = $arbre;	
			}
			return $les_arbres;			
      }
/* 
	Cette fonction renvoit la liste des modalitï¿½s dont la rï¿½ponse est saisie dans une zone de texte, 
	qui sont validï¿½ï¿½s par l'acteur $acteur(app, ma, tuteur_cfa, rl, ef,ens) lors du suivi 
	$type_suivi (entr ou cfa)  ï¿½ la pï¿½riode d'identifiant $id_periode
	
	Si $id_periode est nulle, la foction renvoit toutes les modalitï¿½s sans tenir compte la pï¿½riode.
*/ 
	 function get_modalites_reponse_libre($type_suivi, $acteur, $id_periode=0) { 
          
		   if( ($type_suivi=='cfa' && !$this->suivi_cfa_libre_actif ) ||
		  	  ($type_suivi=='entr' && !$this->suivi_entr_libre_actif ) )	 
		  	return array();
		  
		  if($id_periode == 0){
		 
		  $sql="SELECT id_modalite
 			 	FROM les_modalites_reponse_libre
    		 	WHERE id_config ='$this->id_config' and type_suivi ='$type_suivi' and acteur ='$acteur'
				";
		 }
		 else {  	   
		  $sql="SELECT A.id_modalite
 			 	FROM les_modalites_reponse_libre A , les_periodes_modalite_reponse_libre B
    		 	WHERE A.id_modalite= B.id_modalite and
					  id_config ='$this->id_config' and
					  type_suivi ='$type_suivi' and 
					  acteur ='$acteur' and
					  id_periode = '$id_periode'
				";
		}
			$result = $this->bdd->executer($sql);				
			
			$les_modalites_reponse_libre = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
					$modalite = new Modalite_reponse_libre($ligne['id_modalite']);
					$modalite ->set_detail();
					$les_modalites_reponse_libre[] =  $modalite;
			}
			return $les_modalites_reponse_libre;			
      }	

/* 
	Cette fonction renvoit la liste des modalitï¿½s dont la rï¿½ponse est sï¿½lectionnï¿½e dans une liste de choix, 
	qui sont validï¿½ï¿½s par l'acteur $acteur(app, ma, tuteur_cfa, rl, ef,ens) lors du suivi 
	$type_suivi (entr ou cfa)  ï¿½ la pï¿½riode d'identifiant $id_periode
	
	Si $id_periode est nulle, la foction renvoit toutes les modalitï¿½s sans tenir compte la pï¿½riode.
*/ 
	 function get_modalites_reponse_choix($type_suivi, $acteur, $id_periode = 0) { 
          
		    if( ($type_suivi=='cfa' && !$this->suivi_cfa_libre_actif ) ||
		  	  ($type_suivi=='entr' && !$this->suivi_entr_libre_actif ) )	 
		  	return array();
		  
		  if($id_periode == 0){
		 
		  $sql="SELECT id_modalite
 			 	FROM les_modalites_reponse_choix
    		 	WHERE id_config ='$this->id_config' and type_suivi ='$type_suivi' and acteur ='$acteur'
				";

		 }
		 else {  
          		   
		  $sql="SELECT A.id_modalite
 			 	FROM les_modalites_reponse_choix A , les_periodes_modalite_reponse_choix B
    		 	WHERE A.id_modalite= B.id_modalite and
					  id_config ='$this->id_config' and
					  type_suivi ='$type_suivi' and 
					  acteur ='$acteur' and
					  id_periode = '$id_periode'
				";
		}	  
		$result = $this->bdd->executer($sql);				
		
		$les_modalites_reponse_choix = array();
		
		while ($ligne = mysql_fetch_assoc($result)) {
			$modalite = new Modalite_reponse_choix($ligne['id_modalite']);
			$modalite ->set_detail();
			$les_modalites_reponse_choix[] =  $modalite;
		}
		 return $les_modalites_reponse_choix;			
      }	
/* 
	Cette fonction renvoit la liste des modalitï¿½s ï¿½ valider par l'acteur $acteur 
	lors de suivi libre en entreprise($type_suivi = entr) ou  
	au CFA ($type_suivi = cfa).
	On sï¿½lï¿½ectionne que les modalitï¿½s deveront ï¿½tre validï¿½es pendant la pï¿½riode d'identifiant $id_periode 
	Si $id_periode est nulle, la foction renvoit toutes les modalitï¿½s sans tenir compte la pï¿½riode.
*/ 
    
	 function get_modalites($type_suivi, $acteur, $id_periode=0) { 
        
	/*	if($type_suivi=='cfa' && $this->suivi_entr_libre_actif==0) return 	 array();
		elseif($type_suivi=='entr' && $this->suivi_cfa_libre_actif==0) return array();
	*/	   
		$les_modalites_reponse_choix = $this->get_modalites_reponse_choix($type_suivi, $acteur,  $id_periode );
		$les_modalites_reponse_libre = $this->get_modalites_reponse_libre($type_suivi, $acteur,  $id_periode);
				 
		 return array_merge($les_modalites_reponse_choix, $les_modalites_reponse_libre) ;			
      }	
/* 
	Cette fonction renvoit 1  si l'acteur $acteur possede 
	au moins une modalitï¿½ ï¿½ valider lors de la dï¿½claration de la pï¿½riode $id_periode
	du suivi $type_suivi	
	
*/ 
    
	 function declaration_acteur($type_suivi, $acteur, $id_periode) { 
	 	$test = 0;
        
		if (count($this->get_modalites($type_suivi, $acteur, $id_periode)) > 0 ) return 1;
		
		$les_arbres = $this->get_arbres($type_suivi);
		
		if(count($les_arbres) > 0 ) {
			foreach($les_arbres as $arbre){
				if (count($arbre->get_modalites($acteur, $id_periode)) > 0 ) {
					return 1;	
				}
			}//foreach
		}
		return $test;
		
      }	

/* 
	Cette fonction renvoit le nom complet de l'acteur $x
*/ 
    
	 function get_nom_acteur($x='') { 
           
  		switch($x) {
		
		case "app" : return "$this->appelation_app";
					break;
		case "ma" :  return "$this->appelation_ma";
					break;
		case "tuteur_cfa" : return "$this->appelation_tuteur_cfa";
					break;
		case "ens" : return "$this->appelation_ens";
					break;			
		case "rl" : return "$this->appelation_rl";
					break;
		case "rf" : return "responsable de la formation";
					break;
		default   : return "$this->appelation_app";			
		}
	}			
}


?>