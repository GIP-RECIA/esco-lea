<?php
/***********************************************************/  
  // Auteur : FrÃ©dÃ©ric GOYER
  // Version : 1.0.2
  // Date: 04/07
  // Contenu: 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

/***********************************************************/
class Terminologie{
				
		var $terminologie_ma = "maitre apprentissage";
		var $terminologie_tuteur_cfa = "tuteur du CFA";
		var $terminologie_app = "apprenant";
		var $terminologie_classe = "classe";
		var $terminologie_rl = "parent";
		var $terminologie_ens = "enseignant";
		var $terminologie_entr = "entreprise";
		var $terminologie_suivi_cfa = "suivi au CFA";
		var $terminologie_suivi_entr = "suivi en entreprise";
		var $terminologie_lea = "Livret Electronique d'Apprentissage";
		var $terminologie_admin = "administrateur";
		var $terminologie_cfa = "CFA";
		var $terminologie_unit_pedag = "unite pedagogique";
		var $terminologie_rvs = "responsable vie scolaire";
		var $terminologie_formation = "formation";
		var $terminologie_rf = "responsable de la formation";
		var $bdd;
	/**
	 * Constructeur
	 */				
    function Terminologie() {
		$this->bdd = new Connexion_BDD_LEA();
		$this->set_detail();
    }
    
    /**
     * Methode
     */
	function insert(){ 
		$sql="INSERT INTO les_terminologies (
		   						 
					terminologie_ma, 
					terminologie_tuteur_cfa,
					terminologie_app, 
					terminologie_classe, 								
					terminologie_rl, 
					terminologie_ens, 
					terminologie_entr, 
					terminologie_suivi_cfa, 
					terminologie_suivi_entr, 
					terminologie_lea,
					terminologie_admin,
					terminologie_cfa,
					terminologie_unit_pedag,
					terminologie_rvs,
					terminologie_formation,
					terminologie_rf)	
				VALUES( 		 
					'".addslashes($this->terminologie_ma)."', 
					'".addslashes($this->terminologie_tuteur_cfa)."', 
					'".addslashes($this->terminologie_app)."', 
					'".addslashes($this->terminologie_classe)."', 
					'".addslashes($this->terminologie_rl)."', 
					'".addslashes($this->terminologie_ens)."', 
					'".addslashes($this->terminologie_entr)."',
					'".addslashes($this->terminologie_suivi_cfa)."', 
					'".addslashes($this->terminologie_suivi_entr)."', 
					'".addslashes($this->terminologie_lea)."', 
					'".addslashes($this->terminologie_admin)."',
					'".addslashes($this->terminologie_cfa)."',
					'".addslashes($this->terminologie_unit_pedag)."',
					'".addslashes($this->terminologie_rvs)."',
					'".addslashes($this->terminologie_formation)."',
					'".addslashes($this->terminologie_rf)."') ";
										
			$result = $this->bdd->executer($sql); 					 	 
	 }
	/*
	 * 
	 */
	function update(){
		//************
		//Verification si il y deja une ligne dans la table
		//************
		$sql="SELECT * 
			  FROM les_terminologies 
			  WHERE id = '1'";	   		   
		$result = $this->bdd->executer($sql);				
		
		if (!mysql_fetch_assoc($result)) $this->insert();
		//*************
		$sql="UPDATE  les_terminologies
			  SET  	terminologie_ma = 			'".addslashes($this->terminologie_ma)."', 
			 	  	terminologie_tuteur_cfa = 	'".addslashes($this->terminologie_tuteur_cfa)."', 
				  	terminologie_app = 			'".addslashes($this->terminologie_app)."', 
			 	  	terminologie_classe = 		'".addslashes($this->terminologie_classe)."', 
				  	terminologie_rl = 			'".addslashes($this->terminologie_rl)."',					   
   				  	terminologie_ens = 			'".addslashes($this->terminologie_ens)."',
				  	terminologie_entr = 		'".addslashes($this->terminologie_entr)."',
				  	terminologie_suivi_cfa = 	'".addslashes($this->terminologie_suivi_cfa)."',
				  	terminologie_suivi_entr = 	'".addslashes($this->terminologie_suivi_entr)."',
				  	terminologie_lea = 			'".addslashes($this->terminologie_lea)."',
				  	terminologie_admin = 		'".addslashes($this->terminologie_admin)."',
				  	terminologie_cfa = 			'".addslashes($this->terminologie_cfa)."',
				  	terminologie_unit_pedag = 	'".addslashes($this->terminologie_unit_pedag)."',
					terminologie_rvs = 			'".addslashes($this->terminologie_rvs)."',
					terminologie_formation = 	'".addslashes($this->terminologie_formation)."',
					terminologie_rf = 			'".addslashes($this->terminologie_rf)."'
			 WHERE id = '1'";				
			$result = $this->bdd->executer($sql);																					 	 	 	 	 									
	 }
	 
	/*
	 * 
	 */
	function set_detail(){
		$sql="SELECT * 
			  FROM les_terminologies 
			  WHERE id = '1'";	   		   
		$result = $this->bdd->executer($sql);				
		
		if ($ligne = mysql_fetch_assoc($result)) {
			if($ligne['terminologie_ma'] != '') 
				$this->terminologie_ma = stripslashes($ligne['terminologie_ma']);
			if($ligne['terminologie_tuteur_cfa'] != '') 
				$this->terminologie_tuteur_cfa = stripslashes($ligne['terminologie_tuteur_cfa']);			
			if($ligne['terminologie_app'] != '') 
				$this->terminologie_app = stripslashes($ligne['terminologie_app']);
			if($ligne['terminologie_classe'] != '') 
				$this->terminologie_classe = stripslashes($ligne['terminologie_classe']);
			if($ligne['terminologie_rl'] != '') 
				$this->terminologie_rl = stripslashes($ligne['terminologie_rl']);
			if($ligne['terminologie_ens'] != '') 
				$this->terminologie_ens = stripslashes($ligne['terminologie_ens']);
			if($ligne['terminologie_entr'] != '') 
				$this->terminologie_entr = stripslashes($ligne['terminologie_entr']);
			if($ligne['terminologie_suivi_cfa'] != '') 
				$this->terminologie_suivi_cfa = stripslashes($ligne['terminologie_suivi_cfa']);
			if($ligne['terminologie_suivi_entr'] != '') 
				$this->terminologie_suivi_entr = stripslashes($ligne['terminologie_suivi_entr']);
			if($ligne['terminologie_lea'] != '') 
				$this->terminologie_lea = stripslashes($ligne['terminologie_lea']);
			if($ligne['terminologie_admin'] != '') 
				$this->terminologie_admin = stripslashes($ligne['terminologie_admin']);			
			if($ligne['terminologie_cfa'] != '') 
				$this->terminologie_cfa = stripslashes($ligne['terminologie_cfa']);
			if($ligne['terminologie_unit_pedag'] != '') 
				$this->terminologie_unit_pedag = stripslashes($ligne['terminologie_unit_pedag']);
			if($ligne['terminologie_rvs'] != '') 
				$this->terminologie_rvs = stripslashes($ligne['terminologie_rvs']);
			if($ligne['terminologie_formation'] != '') 
				$this->terminologie_formation = stripslashes($ligne['terminologie_formation']);
			if($ligne['terminologie_rf'] != '') 
				$this->terminologie_rf = stripslashes($ligne['terminologie_rf']);																						
		}
	}
}
?>