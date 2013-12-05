<?php
/***********************************************************/   
  // Auteur : FrÃ©dÃ©ric Goyer
  // Version : 1.0.2
  // Date: 05/07  
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
class Param_impression {

	var $id_param;	//BDD : BIGINT, identifiant du parametrage
	var $id_usager;	//BDD : BIGINT, identifiant de l'usager qui creer le parametrage
	var $if_for;	//BDD : BIGINT, identifiant de la formation a laquelle appartient l'usager
	var $params;	//BDD : Text, array linearise de l'ensemble des donnees necessaires
	var $libelle;	//BDD : Text, nom donne au parametrage
	var $bdd; 	   	//variable de connection
	
	/***
	 * Constructeur
	 */		
    function Param_impression($id_param = 0) {
        $this->id_param = $id_param;
		$this->bdd = new Connexion_BDD_LEA();
    }
    
	/***
	 * Cette methode permet d'enregistrer ce parametrage dans la base 
	 */ 
	function insert() {     		
		$sql = "INSERT INTO les_param_impression(
					id_param, id_usager, id_for, params, libelle)
		 		VALUES('', '$this->id_usager', '$this->id_for', '$this->params', '$this->libelle')"; 
		
		$result = $this->bdd->executer($sql);			
		
		$this->erreurs = array();
		
		if($result) {
		    $this->id_param = mysql_insert_id();
		}else {
			$this->bdd->erreurs[] = "Une erreur est suvenue lors de l'enregistrement de ".$this->libelle;
		}								
    }
    
	/***
	 * Cette methode  met a jour le parametrage
	 */	 
	function update() {  
		//Verif qu'il existe deja 
		$sql = 	"SELECT id_usager, id_for, libelle
				 FROM 	les_param_impression 
				 WHERE 	id_param = '".$this->id_param."'";
						
		$result = $this->bdd->executer($sql);			
		
		if (!mysql_fetch_assoc($result)) {
			$this->insert(); 
		} else{  		
			$sql = "UPDATE les_param_impression
		       		SET id_usager =	'".$this->id_usager."', 
			   			id_for =	'".$this->id_for."', 
						params =	'".$this->params."', 
			        	libelle =	'".$this->libelle."'
		       		WHERE id_param ='".$this->id_param."'"; 
			$result = $this->bdd->executer($sql);
		}			
    }
    		
	/***
	 * Cette methode  permet de fixer tous les attributs de la classe param_impression  
	 */ 
	function set_detail(){
		$sql = "SELECT id_usager, id_for, params, libelle
			   FROM les_param_impression 
			   WHERE id_param = '".$this->id_param."'";	   		   

		$result = $this->bdd->executer($sql);				
			
		while ($ligne = mysql_fetch_assoc($result)) {		
			$this->id_usager =	$ligne['id_usager'];				
 			$this->id_for =		$ligne['id_for'];
			$this->params =		$ligne['params'];
			$this->libelle =	$ligne['libelle'];
		}																							
	}
    
	/***
	 * Cette methode permet de supprimer ce parametrage de la base 
	 */ 
	function delete() {
		$sql = "DELETE FROM les_param_impression 
				WHERE id_param = '".$this->id_param."'";
		$result = $this->bdd->executer($sql);							
    }
    
	/***
	 * Cette fonction renvoit la valeur de l'attribut ($attribut) de ce parametrage
	 */   
	 function get_valeur_attribut($attribut) {     		
		$sql = "SELECT ".$attribut."
				FROM  les_param_impression 
				WHERE id_param = '".$this->id_param."' ";	   		   

		$result = $this->bdd->executer($sql);				
						
		if ($ligne = mysql_fetch_assoc($result)) {						
			return $ligne[$attribut];    
		}else{
			return "";
		}	      							
    }
	
	/***
	 * Cette fonction recupere la liste des parametrages existant 
	 * en fonction de la formation
	 */
	function getListParam(){
		$sql = "SELECT *
			   FROM les_param_impression 
			   WHERE id_for='".$_SESSION['id_for']."'";
		$result = $this->bdd->executer($sql);
		$tmp = '
				<form name="theForm8" action="" method="post">
					<select name="id_param_sel">
						<option value="-1">Aucun mod&egrave;le</option>';
		
		$stock_others = "";
		$stock_mine = "";
		while($ligne = mysql_fetch_assoc($result)){
			if(isset($_SESSION['id_param_sel']) && ($_SESSION['id_param_sel'] == $ligne['id_param'])){
				$selected = ' selected';
			} else{
				$selected = '';
			}
			if($ligne["id_usager"] == $_SESSION['id_ens'] || $ligne["id_usager"] == $_SESSION['id_rvs']) {
				$stock_mine .= '
						<option value=\''.$ligne["id_param"].'\''.$selected.'> '.htmlentities($ligne["libelle"], ENT_QUOTES, "UTF-8").'</option>';
			} else {
				$stock_others .= '
						<option value=\''.$ligne["id_param"].'\''.$selected.'> '.htmlentities($ligne["libelle"], ENT_QUOTES, "UTF-8").'</option>';
			}
		}

		if(!empty($stock_mine)) {
			$tmp .= "<optgroup label='Mes mod&egrave;les'>".$stock_mine."
					</optgroup>";
		}
		if(!empty($stock_others)) {
			$tmp .= "<optgroup label='Mod&egrave;les de la formation'>".$stock_others."
					</optgroup>";
		}
		$tmp .= '
					</select>
					<input type="submit" name="valider" value="Appliquer">
				</form>';
		
		return $tmp;
	}
}
?>