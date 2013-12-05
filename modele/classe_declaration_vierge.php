<?php
/***********************************************************/   
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.0
  // Date: 10/05/07
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_document_declare.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
define ( "NB_CHOIX_MAX" , 3 ); 

class declaration_vierge {
	
	// Variable contenant l'objet dÃ©claration
	var $declaration;
	
	// Constructeur
	function declaration_vierge($declaration) {
		$this->declaration = $declaration;	
	}

	// Cette fonction affiche la zone de saisie qui correspond Ã  la modalite $modalite du suivi guidÃ©.
	// Fonction de base : zone_modalite_suivi_guide
	function modalite_suivi_guide($modalite, $id_noeud) {
		
		$classe = strtolower(get_class($modalite));
			
		switch($classe){
			case "modalite_va_unique" : 
				
				if($modalite->type_reponse == 'texte') {
					$r = " ";
				} else {
					$noeud = new Noeud($id_noeud);
					$noeud->set_detail();
					$note_max = $noeud->get_evaluation_modalite_va_unique($modalite->id_modalite);
					
					if($modalite->type_reponse == 'frequence') { 																													
						$r = "Au moins ".$note_max." fois sur l'ensemble des p&eacute;riodes"; 
					} elseif($modalite->type_reponse == 'note') {
						$r = "__ / ".$note_max; 		
					}
				}
			break;									
			case "modalite_va_multiple" :			
				$les_choix = $modalite->get_choix();																		
				$r = array();
					
				foreach($les_choix as $choix) {
					array_push($r, $choix->libelle);
				}
			break;	
		}
		
		// Si modalite_va_unique: String
		// Sinon: array() contenant les choix multiples
		return $r;
	} 

	// Cette fonction affiche le tableau du validation des modalitÃ©s $les_modalite de l'arbre $arbre
	function tableau_modalites_suivi_guide($arbre, $id_periode = 0) {
		
		$apprenti = new Apprenti($this->declaration->id_app);
		$apprenti->set_detail();
		
		$tuteur_cfa = new Usager($apprenti->id_ens);
		$tuteur_cfa->set_detail();
		
		$maitre = new Usager($apprenti->id_ma);
		$maitre->set_detail();
		
		$parent = new Usager($apprenti->id_rl);
		$parent->set_detail();
		
		$formation = $apprenti->get_formation();
		$responsable = new Usager($formation->id_ens);
		$responsable->set_detail();
		
		// On set dÃ©tail l'arbre qui correspond
		$arbre->set_detail();
		
		$config_lea = new Config_lea($arbre->id_config);
		$config_lea->set_detail();
		
		$les_feuilles = $arbre->get_feuilles();
		
		$les_modalites = 
			array_merge($arbre->get_modalites('app', $id_periode), 
						$arbre->get_modalites('ma', $id_periode), 
						$arbre->get_modalites('tuteur_cfa', $id_periode),
						$arbre->get_modalites('ens', $id_periode),
						$arbre->get_modalites('rl', $id_periode),
						$arbre->get_modalites('rf', $id_periode)
						 );
		//$liste = array();
		$liste2 = array();
	
		$liste2['titre_tab']['feuille'] = $arbre->get_libelle_feuille();
		
		$num = 0;		
		foreach($les_modalites as $modalite ) {		
			
			switch ($modalite->acteur){
				case 'app' : 
					$acteur = $config_lea->appelation_app.'/'.$apprenti->nom .' '. $apprenti->prenom;
				break;
				case 'tuteur_cfa' :
					$acteur = $config_lea->appelation_tuteur_cfa.'/'.$tuteur_cfa->nom .' '. $tuteur_cfa->prenom;
				break;
				case 'ma' :
					$acteur = $config_lea->appelation_ma.'/'.$maitre->nom .' '. $maitre->prenom;
				break;
				case 'rl' :
					$acteur = $config_lea->appelation_rl.'/'.$parent->nom .' '. $parent->prenom;
				break;
				case 'rf' :
					$acteur = $config_lea->appelation_rf.'/'.$responsable->nom .' '. $responsable->prenom;
				break;
				case 'ens' :
					$acteur = $config_lea->appelation_ens;
				break;			
				default :
					$acteur	='';
			}
							
			$liste2['titre_tab']['modalite'][$num] = 	array(
															"titre" => $modalite->libelle,
															"acteur" => $acteur
														);
			$num++;			
		}
		
		// lea noeuds d'arbres
		foreach($les_feuilles as $feuille){
			$les_id_noeuds_ascendants = $feuille->get_id_noeuds_ascendants();
			$libelles_noeuds = '';
			$sous_groupe = '';
			$itmp2=0;
			foreach($les_id_noeuds_ascendants as $id ){
				if($id == 0) continue;
				
				$nd = new Noeud($id, $arbre->id_arbre);
				$nd->set_detail();
				
				if($itmp2 > 0) {
					$sous_groupe .= $nd->libelle;			
					
					if(next($les_id_noeuds_ascendants)!==FALSE) {
							$sous_groupe .= " > ";
					}
				} else {
					$libelles_noeuds = $nd->libelle;
				}
				$itmp2++;
			}
			
			// on rÃ©cupÃ¨re sous forme d'un tableau les modalitÃ©s
			$modalites_tab = array();
			$types_modalites_tab = array();
			foreach($les_modalites as $modalite) {
				if(strtolower(get_class($modalite)) == "modalite_va_multiple") {								
					array_push($types_modalites_tab, (($modalite->type_choix == "unique" ) ? "unique" : "multiple"));
				} else {
					array_push($types_modalites_tab, "texte brut");
				}
				array_push($modalites_tab, $this->modalite_suivi_guide($modalite, $feuille->id_noeud));
			}
			
			// si le groupe n'existe pas on le cree
			if(!isset($liste2['groupes_de_feuilles'][$libelles_noeuds])) {
				$liste2['groupes_de_feuilles'][$libelles_noeuds] = array();
			}
			
			// si le groupe n'existe pas on le cree
			if(!isset($liste2['groupes_de_feuilles'][$libelles_noeuds][$sous_groupe])) {
				$liste2['groupes_de_feuilles'][$libelles_noeuds][$sous_groupe] = array();
			}
			
			// on formate une feuille et les modalites des acteurs associÃ©es
			$une_feuille_et_modalites = array(
											"titre" => $feuille->libelle,
											"types_modalites" => $types_modalites_tab,
											"modalites" => $modalites_tab
										);
			// ajoute $une_feuille_et_modalites au groupe auquel la feuille appartient
			$liste2['groupes_de_feuilles'][$libelles_noeuds][$sous_groupe][] = $une_feuille_et_modalites;
			
		}			
		return $liste2;
	}

	// Cette fonction affiche la reponses possibles correspondant Ã  la modalite $modalite du suivi libre.
	// Fonction de base : zone_modalite_suivi_libre
	function modalite_suivi_libre($modalite){
		
		$classe = strtolower(get_class($modalite)); 

		switch($classe){
			case "modalite_reponse_libre":
				$r = "";
			break;						
			case "modalite_reponse_choix":
				$les_reponses = $modalite->get_reponses();																		
				$r = array();
					
				foreach($les_reponses as $reponse) {
					$r2 = array();
					$r2['reponse'] = $reponse->reponse;
					$r2['cochee'] = FALSE;
					
					array_push($r, $r2);
					unset($r2);
				}
			break;		
		}
		
		// Si reponse_libre: String
		// Sinon: array() contenant les reponses
		return $r;
	} 

	// Cette fonction affiche toutes les modalitÃ©s qui doivent Ãªtre validÃ©es lors du suivi libre
	function tableau_modalites_suivi_libre($config_lea){
		//
		
		$apprenti = new Apprenti($this->declaration->id_app);
		$apprenti->set_detail();
		$formation = $apprenti->get_formation();
		$tuteur_cfa = new Usager($apprenti->id_ens);
		$tuteur_cfa->set_detail();
		$maitre = new Usager($apprenti->id_ma);
		$maitre->set_detail();
		$parent = new Usager($apprenti->id_rl);
		$parent->set_detail();	
		$responsable = new Usager($formation->id_ens);
		$responsable->set_detail();	
					
		// toutes les modalitÃ©s libre qui doivent Ãªtre validÃ©es
		$all_modalites = array_merge(
					$config_lea->get_modalites($this->declaration->type_suivi, 'app',  $this->declaration->id_periode),
					$config_lea->get_modalites($this->declaration->type_suivi, 'ma', $this->declaration->id_periode), 
					$config_lea->get_modalites($this->declaration->type_suivi, 'tuteur_cfa', $this->declaration->id_periode),
					$config_lea->get_modalites($this->declaration->type_suivi, 'ens', $this->declaration->id_periode),
					$config_lea->get_modalites($this->declaration->type_suivi, 'rl', $this->declaration->id_periode),
					$config_lea->get_modalites($this->declaration->type_suivi, 'rf', $this->declaration->id_periode)
		);
		
		$liste = array();
		
		$num = 0;
		foreach($all_modalites as $modalite) {
					
			switch ($modalite->acteur){
				case 'app' : 
					$acteur = $config_lea->appelation_app.'/'.$apprenti->nom .' '. $apprenti->prenom;
				break;
				case 'tuteur_cfa' :
					$acteur = $config_lea->appelation_tuteur_cfa.'/'.$tuteur_cfa->nom .' '. $tuteur_cfa->prenom;
				break;
				case 'ma' :
					$acteur = $config_lea->appelation_ma.'/'.$maitre->nom .' '. $maitre->prenom;
				break;
				case 'rl' :
					$acteur = $config_lea->appelation_rl.'/'.$parent->nom .' '. $parent->prenom;
				break;
				case 'rf' :
					$acteur = $config_lea->appelation_rf.'/'.$responsable->nom .' '. $responsable->prenom;
				break;
				case 'ens' :
					$acteur = $config_lea->appelation_ens;
				break;				
				default:
					$acteur = '';
			}				
										
			$liste[$num]['libelle'] = $modalite->libelle;
			$liste[$num]['auteur'] = $acteur;
			if(strtolower(get_class($modalite)) == "modalite_reponse_choix") {									
				$liste[$num]['type'] = (($modalite->type_choix == "unique" ) ? "unique" : "multiple");
			} else {
				$liste[$num]['type'] = "texte brut";
			}
			$liste[$num]['reponse'] = $this->modalite_suivi_libre($modalite);
			$num++;
		}
		
		return $liste;
	}

}
?>
