<?php
/***********************************************************/
  // CFA des 3 villes
  // Web: www.cfa3villes.com.
    
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.0
  // Date: 25/04/07
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

/***********************************************************/
class Param_criteres {

	var $id_choix; 			// BDD : int
	var $id_modalite;		// BDD : int
	var $mode_affichage;	// BDD : ENUM(tout, graphique, textuel, aucun, NULL)
	var $mode_textuel; 		// BDD : ENUM(brut, calcule, NULL)
	var $mode_graphique;	// BDD : ENUM(bpp, bps, smilies, NULL)
	var $param_graphique;	// BDD : String (array linÃ©arisÃ©, NULL)
			
	var $afficher_valeur; 	// Classe : Bool, NULL
	var $afficher_visuel; 	// Classe : Bool, NULL
	
	var $bdd;				// Connexion BDD

			
    function Param_criteres($id_modalite, $id_choix = NULL) {
		$this->bdd 			= new Connexion_BDD_LEA();
		$this->id_choix 	= $id_choix;
		$this->id_modalite 	= $id_modalite;
    }

	function insert() {
		$sql = 	"INSERT INTO les_param_criteres (
					id_modalite,
					id_choix,
					mode_affichage,
					mode_textuel,
					mode_graphique,
					param_graphique
				)
				VALUES ( 		 
					'".$this->id_modalite."',
					'".$this->id_choix."',  
					'".addslashes($this->mode_affichage)."', 
					'".addslashes($this->mode_textuel)."', 
					'".addslashes($this->mode_graphique)."', 
					'".serialize($this->param_graphique)."'
				)";
										
		$result = $this->bdd->executer($sql); 					 	 
	}

	function update() {
		$sql = 	"SELECT
					mode_affichage
				FROM
					les_param_criteres 
				WHERE
					id_modalite = '".$this->id_modalite."' AND 
					id_choix = '".$this->id_choix."'";
						
		$result = $this->bdd->executer($sql);			
		
		if (!mysql_fetch_assoc($result)) {
			$this->insert();
		} else {
			$sql = "UPDATE
						les_param_criteres
					SET 
						mode_affichage =	'".addslashes($this->mode_affichage)."', 
						mode_textuel =		'".addslashes($this->mode_textuel)."', 
						mode_graphique =	'".addslashes($this->mode_graphique)."', 
						param_graphique =	'".serialize($this->param_graphique)."'
					WHERE
						id_modalite = '".$this->id_modalite."' AND
						id_choix = '".$this->id_choix."'";				
						
			$result = $this->bdd->executer($sql);		
		}
																			 	 	 	 	 									
	 }
	 
	function set_detail() {
		$sql = 	"SELECT
					mode_affichage, mode_textuel, mode_graphique, param_graphique
				FROM
					les_param_criteres 
				WHERE
					id_modalite = '".$this->id_modalite."' AND 
					id_choix = '".$this->id_choix."'";
						
		$result = $this->bdd->executer($sql);				
		
		if ($ligne = mysql_fetch_assoc($result)) {
			$this->mode_affichage = ($ligne['mode_affichage'] != '') ? $ligne['mode_affichage'] : NULL;
			$this->mode_textuel = ($ligne['mode_textuel'] != '') ? $ligne['mode_textuel'] : NULL;
			$this->mode_graphique = ($ligne['mode_graphique'] != '') ? $ligne['mode_graphique'] : NULL;
			$this->param_graphique = ($ligne['param_graphique'] != '') ? unserialize($ligne['param_graphique']) : NULL;

			switch($this->mode_affichage) {
				case "tout":
					$this->afficher_textuel 	= TRUE;
					$this->afficher_graphique 	= TRUE;
				break;
				case "graphique":
					$this->afficher_textuel 	= FALSE;
					$this->afficher_graphique 	= TRUE;
				break;
				case "textuel":
					$this->afficher_textuel 	= TRUE;
					$this->afficher_graphique 	= FALSE;
				break;
				case "aucun":
					$this->afficher_textuel 	= FALSE;
					$this->afficher_graphique 	= FALSE;
				break;		
				default:
					$this->afficher_textuel 	= NULL;
					$this->afficher_graphique 	= NULL;
				break;	
			}
		}
	}
	
	/*
	 * **************************************************
	 * fontions d'affichage
	 * *************************************************
	 * */
	
	function afficher_radio_mode_affichage() {
	
		$tab = 	array(
					"tout" => "Graphique et textuel",
					"graphique" => "Graphique uniquement",
					"textuel" => "Textuel uniquement",
					"aucun" => "Aucun affichage"
				);
				
		foreach($tab as $key => $val) {
			$checked = ($key == $this->mode_affichage) ? "checked " : "";
			echo "
				<tr>
					<td>
						<input type=\"radio\" onChange=\"this.form.submit()\" id=\"mode_affichage_".$key."\" name=\"mode_affichage\" value=\"".$key."\" ".$checked."/>
						<label for=\"mode_affichage_".$key."\">".$val."</label><br />
					</td>
				</tr>
			";
		}

	}
	
	function afficher_radio_mode_graphique() {
		
		$tab = 	array(
					"bpp" => "Barre de progression &agrave; palier",
					"bps" => "Barre de progression simple",
					"smilies" => "Smileys"
				);
					
		foreach($tab as $key => $val) {
			$checked = ($key == $this->mode_graphique) ? "checked " : "";
			echo "
				<tr>
					<td>
						<input type=\"radio\" onChange=\"this.form.submit()\" id=\"mode_graphique_".$key."\" name=\"mode_graphique\" value=\"".$key."\" ".$checked."/>
						<label for=\"mode_graphique_".$key."\">".$val."</label><br />
					</td>
				</tr>
			";
		}
	}

	function afficher_radio_mode_textuel() {
		
		$tab = 	array(
					"brut" => "Brut",
					"calcule" => "Pourcentage",
				);
					
		foreach($tab as $key => $val) {
			$checked = ($key == $this->mode_textuel) ? "checked " : "";
			echo "
				<tr>
					<td>
						<input type=\"radio\" onChange=\"this.form.submit()\" id=\"mode_textuel_".$key."\" name=\"mode_textuel\" value=\"".$key."\" ".$checked."/>
						<label for=\"mode_textuel_".$key."\">".$val."</label><br />
					</td>
				</tr>
			";
		}
	}
	/***
	 *
	 */
	function getModeAffichage($lamodalite, $lechoix=0) {
		$sql = 	"SELECT mode_affichage 
					FROM les_param_criteres 
					WHERE id_modalite = '".$lamodalite."' 
					AND id_choix='".$lechoix."'";
								
		$result = $this->bdd->executer($sql);
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne['mode_affichage'];
		}else{
			return "choix";
		}
	}
}
?>