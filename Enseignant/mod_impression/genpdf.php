<?php
class GenPDF
{
	var $pdf;
	var $id_app;
	var $arrayOrdre;
	var $config_term;
	var $enseignant;
	var $acteur;
	var $apprenti;
	var $classe;
	var $formation;
	var $ma;
	var $entreprise;
	var $tuteur;
	var $tut;
	var $maitre;
	var $mon_arbre_t;
	var $nomcomplet;

	function GenPDF($id, $arrayTemp) {
		$this->id_app = $id;
		$this->arrayOrdre = explode('&', $arrayTemp);
		$this->pdf = new PDF();
		$this->recupDetail();
		$this->pdf->SetMargins(15,20,15,20);
		$this->generateInfo();
		$this->pdf->Output($this->classe->libelle."_".$this->nomcomplet.".pdf", "D");
	}
	
	function recupDetail() {
		$this->config_term = new Terminologie();
		$this->config_term->set_detail();
		
		$this->enseignant = new Enseignant($_SESSION['id_ens']);
		$this->acteur = "ens";
		
		//Instanciation d'un apprenti
		$this->apprenti = new Apprenti($this->id_app);
		$this->apprenti->set_detail();
		
		// Instanciation de la formation de l'apprenti
		$this->formation = new Formation($_SESSION['id_for']);
		$this->formation->set_detail();
		
		// Instanciation de la classe de l'apprenti
		$this->classe = new Classe($this->apprenti->id_cla);
		$this->classe->set_detail();
			
		if($_SESSION['imp_type_formulaire'] != "vierge") {
			
			// Instanciation d'un MA de l'apprenti
			$this->ma = new Maitre_apprentissage($this->apprenti->id_ma);
			$this->ma->set_detail();
			
			// Instanciation de l'entreprise du MA
			$this->entreprise = new Entreprise($this->ma->id_entr);
			$this->entreprise->set_detail();
			
			// Instanciation du tuteur CFA
			$this->tuteur = new Enseignant($this->apprenti->id_ens);
			$this->tuteur->set_detail();
			
			if($this->apprenti->id_ma > 0) {
				$this->maitre = $this->ma->nom." ".$this->ma->prenom;
			} else {
				$this->maitre = 'Non renseigne';
			}
			if($this->apprenti->id_ens > 0) {
				$this->tut = $this->tuteur->nom." ".$this->tuteur->prenom;
			} else {
				$this->tut = 'Non renseigne';
			}
			
			$this->nomcomplet = $this->apprenti->nom.'_'.$this->apprenti->prenom;
			//echo $this->nomcomplet;
			$this->pdf->setInformations($this->config_term->terminologie_lea,$this->nomcomplet);
			
			$this->pdf->AddPage();
		
		} else {
			// ici tu ne met aucune donnée nominative, car on imprime du vierge
			
			
			$this->pdf->setInformations($this->config_term->terminologie_lea,$this->nomcomplet);
			$this->pdf->AddPage();
		}
	}
	
	function generateInfo() {
		for($i=0; $i < count($this->arrayOrdre); $i++) {
			switch($this->arrayOrdre[$i]) {
				case 'couverture':
					if($_SESSION['imp_type_formulaire'] != "vierge") {
						$this->pdf->pageDeCouverture($this->config_term->terminologie_lea, $this->apprenti->nom, $this->apprenti->prenom, $this->apprenti->adresse, $this->formation->nom, $this->entreprise->nom, $this->tut, $this->maitre, $this->config_term->terminologie_classe, $this->config_term->terminologie_entr, $this->config_term->terminologie_tuteur_cfa, $this->config_term->terminologie_ma);
						$this->pdf->AddPage();
					} else {
						$this->pdf->pageDeCouverture($this->config_term->terminologie_lea, "", "", "", "", "", "", "", $this->config_term->terminologie_classe, $this->config_term->terminologie_entr, $this->config_term->terminologie_tuteur_cfa, $this->config_term->terminologie_ma);
						$this->pdf->AddPage();
					}
					break;
				case 'periode':
					if($_SESSION['imp_type_formulaire'] == "vierge") {
						$this->nomcomplet = "periode_vierge";
					}
					$this->genPeriode("all");
					break;
				case 'periodeentr':
					if($_SESSION['imp_type_formulaire'] == "vierge") {
						$this->nomcomplet = "periode_entreprise_cfa_vierge";
					}
					$this->genPeriode("entr");
					break;
				case 'periodecfa':
					if($_SESSION['imp_type_formulaire'] == "vierge") {
						$this->nomcomplet = "periode_entreprise_cfa_vierge";
					}
					$this->genPeriode("cfa");
					break;
				case 'arborescence':
					$this->genArbo();
					break;
				case 'declaration':
					$this->genDeclaration();
					break;
			}
		}
	}
	
	function genPeriode($type) {
		$this->config_term = new Terminologie();
		$this->config_term->set_detail();
		$config_lea	= $this->formation->get_config_lea();
		
		if($_SESSION["imp_type_livret"] == "periodes") {
			//on extrait tout de la variable session
			$tab_tmp = (isset($_SESSION["imp_periode"])) ? unserialize($_SESSION["imp_periode"]) : array();
			$itmp =0;
			foreach($tab_tmp as $une_periode_et_suivi) {
				if($type != "all") {
					if(ereg($type, $une_periode_et_suivi)) {
						list($une_periode_id, $une_periode_type_suivi) = explode(":", $une_periode_et_suivi);
				
						if($_SESSION['imp_type_formulaire'] != "vierge") {
							$id_declaration = $this->existe_t_il_une_Declaration($this->apprenti->id_app, $une_periode_id, $une_periode_type_suivi);
						} else {
							$id_declaration = 0;
						}
						
						if($id_declaration > 0) {
							$declaration = new Declaration($id_declaration);
							$declaration->set_detail();
							
							$date_declaration = trans_date($declaration->date_dec);
							
							$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
							
							$periode = new Periode($declaration->id_periode);
							$periode->set_detail();
					
							if($declaration->type_suivi == "cfa") {
								$value_t = "Suivi ".$this->config_term->terminologie_cfa." : ".$periode->libelle;
							} elseif  ($declaration->type_suivi == "entr"){
								$value_t = "Suivi ".$config_lea->appelation_entr." : ".$periode->libelle;
							}
							
							$this->pdf->CCell(html_entity_decode($value_t), 180, 'L', 16, array(254,169,18));
							$this->pdf->Cell(180, 5, '', 0, 1);
							
							foreach($les_arbres as $arbre){
								if($feuilles_declarees = $declaration->afficher_feuilles_declarees_pdf($arbre, $declaration->id_periode) ) {
									$this->pdf->tableauSuivi($feuilles_declarees);
								}											
							}	
							
							if($tableau_modalites_suivi_libre = $declaration->afficher_tableau_modalites_suivi_libre_pdf($config_lea, $declaration->id_periode)) {
								$this->pdf->tableauLibre($tableau_modalites_suivi_libre);
							}	
				
							//-------- Signatures ---------
							if($signatures = $declaration->afficher_signatures_pdf()) {
								//$this->pdf->tableauSignature($signatures);
							}
							
						} else {
							$declaration = new Declaration(0);
							$declaration->set_detail();
							
							$declaration->id_periode = $une_periode_id;
							$declaration->id_app = $this->apprenti->id_app;
							$declaration->type_suivi = $une_periode_type_suivi;
							
							$config_lea = $this->apprenti->get_config_lea();
							$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
							
							$declaration_vierge = new declaration_vierge($declaration);	
							
							$periode = new Periode($declaration->id_periode);
							$periode->set_detail();
							
							if($declaration->type_suivi == "cfa") {
								$value_t = "Suivi ".$this->config_term->terminologie_cfa." : ".$periode->libelle;
							} elseif  ($declaration->type_suivi == "entr"){
								$value_t = "Suivi ".$config_lea->appelation_entr." : ".$periode->libelle;
							}
							
							$this->pdf->CCell(html_entity_decode($value_t), 180, 'L', 16, array(254,169,18));
							$this->pdf->Cell(180, 5, '', 0, 1);
							
							foreach($les_arbres as $arbre) {
								$this->pdf->tableauSuiviVierge($declaration_vierge->tableau_modalites_suivi_guide($arbre, $une_periode_id));
								$this->pdf->AddPage();
							}
							
							$this->pdf->tableauLibre($declaration_vierge->tableau_modalites_suivi_libre($config_lea), "v");
								
							$this->pdf->tableauSignatureVierge($declaration->afficher_signatures_pdf(), $config_lea);
						}
						$this->pdf->AddPage();
					}
				} else {
					list($une_periode_id, $une_periode_type_suivi) = explode(":", $une_periode_et_suivi);
				
					if($_SESSION['imp_type_formulaire'] != "vierge") {
						$id_declaration = $this->existe_t_il_une_Declaration($this->apprenti->id_app, $une_periode_id, $une_periode_type_suivi);
					} else {
						$id_declaration = 0;
					}
					
					if($id_declaration > 0) {
						$declaration = new Declaration($id_declaration);
						$declaration->set_detail();
						
						$date_declaration = trans_date($declaration->date_dec);
						
						$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
						$periode = new Periode($declaration->id_periode);
						$periode->set_detail();
						
						if($declaration->type_suivi == "cfa") {
							$value_t = "Suivi ".$this->config_term->terminologie_cfa." : ".$periode->libelle;
						} elseif  ($declaration->type_suivi == "entr"){
							$value_t = "Suivi ".$config_lea->appelation_entr." : ".$periode->libelle;
						}
						$this->pdf->CCell(html_entity_decode($value_t), 180, 'L', 16, array(254,169,18));
						$this->pdf->Cell(180, 5, '', 0, 1);
						
						foreach($les_arbres as $arbre){
							if($feuilles_declarees = $declaration->afficher_feuilles_declarees_pdf($arbre, $declaration->id_periode) ) {
								$this->pdf->tableauSuivi($feuilles_declarees);
							}											
						}	
						
						//-------- Modalité
						if($tableau_modalites_suivi_libre = $declaration->afficher_tableau_modalites_suivi_libre_pdf($config_lea, $declaration->id_periode)) {
							$this->pdf->tableauLibre($tableau_modalites_suivi_libre);
						}	
			
						//-------- Signatures ---------
						if($signatures = $declaration->afficher_signatures_pdf()) {
							//$this->pdf->tableauSignature($signatures);
						}
						
					} else {
						$declaration = new Declaration(0);
						$declaration->set_detail();
						
						$declaration->id_periode = $une_periode_id;
						$declaration->id_app = $this->apprenti->id_app;
						$declaration->type_suivi = $une_periode_type_suivi;
						
						$config_lea = $this->apprenti->get_config_lea();
						$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
						
						$declaration_vierge = new declaration_vierge($declaration);	
						
						$periode = new Periode($declaration->id_periode);
						$periode->set_detail();
						
						if($declaration->type_suivi == "cfa") {
							$value_t = "Suivi ".$this->config_term->terminologie_cfa." : ".$periode->libelle;
						} elseif  ($declaration->type_suivi == "entr"){
							$value_t = "Suivi ".$config_lea->appelation_entr." : ".$periode->libelle;
						}
						
						$this->pdf->CCell(html_entity_decode($value_t), 180, 'L', 16, array(254,169,18));
						$this->pdf->Cell(180, 5, '', 0, 1);
						
						//-------- Suivi guidé
						foreach($les_arbres as $arbre) {
							$this->pdf->tableauSuiviVierge($declaration_vierge->tableau_modalites_suivi_guide($arbre, $une_periode_id));
							if (next($les_arbres)!=false) {
								$this->pdf->AddPage();
							}
						}
						
						//-------- Suivi libre ---------
						$this->pdf->tableauLibre($declaration_vierge->tableau_modalites_suivi_libre($config_lea), "v");
						
						//-------- Signatures de cette dé	
						$this->pdf->tableauSignatureVierge($declaration->afficher_signatures_pdf(), $config_lea);
					}
					if (next($tab_tmp)!=false) {
						$this->pdf->AddPage();
					}
				}
			}
		}
	}
	
	function genArbo() {
		$this->config_term = new Terminologie();
		$this->config_term->set_detail();
		$config_lea	= $this->formation->get_config_lea();
		
		$les_id_arbres = (isset($_SESSION["imp_arbre"])) ? unserialize($_SESSION["imp_arbre"]) : array();
		$refs_arbres_modalites = (isset($_SESSION["imp_modalite_arbre"])) ? unserialize($_SESSION["imp_modalite_arbre"]) : array();
		
		$refs_arbres_modalites_criteres = array();
		
		foreach($refs_arbres_modalites as $ref_arbre_modalite) {
			list($id_arbre, $id_modalite, $classe_modalite) = explode(":", $ref_arbre_modalite);
			
			if($classe_modalite == 'modalite_va_multiple'){
				$modalite = new Modalite_va_multiple($id_modalite);
				$modalite->set_detail();
				
				$les_criteres = $modalite->get_choix();
				foreach( $les_criteres  as $critere ){
					$param_crit = new Param_criteres($modalite->id_modalite, $critere->id_choix);
					$param_crit->set_detail();
					
					if($param_crit->mode_affichage == "aucun" || is_null($param_crit->mode_affichage)) {
						continue;
					} else {
						$ref_arbre_modalite_critere = $id_arbre.":".$id_modalite.":".$classe_modalite.":".$critere->id_choix;
						array_push($refs_arbres_modalites_criteres, $ref_arbre_modalite_critere);
					}
				}
			} else{
				$param_crit = new Param_criteres($id_modalite);
				$param_crit->set_detail();
				
				$ref_arbre_modalite_critere = $id_arbre.":".$id_modalite.":".$classe_modalite.":NULL";
				array_push($refs_arbres_modalites_criteres, $ref_arbre_modalite_critere);
			}
		}
	
		$tableau_arbres = array_merge($les_id_arbres, $refs_arbres_modalites_criteres);
		asort($tableau_arbres);
		
		foreach($tableau_arbres as $ligne_arbre) {
			
			if(preg_match('`^([0-9]+)$`', $ligne_arbre)) {	
	
				$arbre = new Arbre($ligne_arbre);
				$arbre->set_detail();
				
				if ($arbre->type == "entr") {
			    	$titre_bilan = "¤ BILAN ".strtoupper($config_lea->appelation_entr)." : ";
				} elseif($arbre->type == "cfa") {
					$titre_bilan = "¤ BILAN ".strtoupper($this->config_term->terminologie_cfa)." : ";
				}
		
				$this->pdf->CCell(html_entity_decode($titre_bilan), 180, 'L', 16);
				$this->pdf->Cell(180, 3, '', 0, 1);
				$this->pdf->CCell("=> Arbre : ".strtoupper($arbre->nom), 180, 'L', 10, array(254,169,18));
				$this->pdf->Cell(180, 6, '', 0, 1);
				
				$this->pdf->SetFont('Times', '', 8);
				$this->pdf->setTextColor(0,0,0);
			
				unset($_SESSION["mon_arbre_a_imp"]);
				$_SESSION["mon_arbre_a_imp"] = array();
			
				$noeud["NIVEAU"] = "0";
				$noeud["TYPE"] = "noeud";
				$noeud["LIBELLE"] = $arbre->nom;
				$noeud["VALEUR"] = "";
				
				array_push($_SESSION["mon_arbre_a_imp"], $noeud);
				
				$arbre->afficher_pdf(0);
				
				$this->mon_arbre_t = $_SESSION["mon_arbre_a_imp"];
				
				foreach($this->mon_arbre_t as $noeud) {
					$noeud_val_tmp = (isset($noeud["VALEUR"])) ? $noeud["VALEUR"] : 0;
					$this->pdf->ligne_arbo("text", intval($noeud["NIVEAU"]), $noeud_val_tmp, $noeud["LIBELLE"]);
				}
				if (next($tableau_arbres)!=false) {
						$this->pdf->AddPage();
					}
				unset($this->mon_arbre_t);
	
			} else {
			
				$ref_arbre_modalite = $ligne_arbre;
				
				list($id_arbre, $id_modalite, $classe_modalite, $id_critere) = explode(":", $ref_arbre_modalite);
			
				$arbre = new Arbre($id_arbre);
				$arbre->set_detail();
		
				if ($classe_modalite == 'modalite_va_multiple' && $id_critere != "NULL") {
					$modalite = new Modalite_va_multiple($id_modalite);
					$modalite->set_detail();
					$param_crit = new Param_criteres($id_modalite, $id_critere);
					$param_crit->set_detail();
					$les_eva_noeuds = $this->apprenti->evaluation_arbre_va_multiple($arbre, $id_critere);
				} else {
					$modalite = new Modalite_va_unique($id_modalite);	
					$modalite->set_detail();
					$param_crit = new Param_criteres($id_modalite);
					$param_crit->set_detail();
					$les_eva_noeuds = $this->apprenti->evaluation_arbre_modalite_va_unique($arbre, $modalite);
				}
				
				if (isset($param_crit->mode_affichage)) {
					
					if ($arbre->type == "entr") {
				    	$titre_bilan = "¤ BILAN ".strtoupper($config_lea->appelation_entr)." : ";
					} elseif($arbre->type == "cfa") {
						$titre_bilan = "¤ BILAN ".strtoupper($this->config_term->terminologie_cfa)." : ";
					}
			
					$this->pdf->CCell(html_entity_decode($titre_bilan), 180, 'L', 16);
					$this->pdf->Cell(180, 3, '', 0, 1);
					$this->pdf->CCell("=> Arbre : ".strtoupper($arbre->nom), 180, 'L', 10, array(254,169,18));
					$this->pdf->CCell("==> Modalité : ".strtoupper($modalite->libelle), 180, 'L', 10, array(254,169,18));
					$this->pdf->Cell(180, 6, '', 0, 1);
					
					$this->pdf->SetFont('Times', '', 8);
					$this->pdf->setTextColor(0,0,0);
					
					$this->mon_arbre_t = array();
					
					$noeud["NIVEAU"] = "0";
					$noeud["TYPE"] = "noeud";
					$noeud["LIBELLE"] = $arbre->nom;
					$noeud["VALEUR"] = round($this->eval_noeud(0, $les_eva_noeuds), 2);
						
					$typeAff = "";
					$controleSmile = false;
				
					if($param_crit->mode_graphique == "smilies") {
						$controleSmile = true;
						$tabParamSmil = explode("|",$param_crit->param_graphique);
						$nbSmilies = count($tabParamSmil)+1;
						$typeAff = "s".$nbSmilies;
					} else {
						$controleSmile = false;
						$typeAff = $param_crit->mode_graphique;
						if($param_crit->mode_textuel == "calcule") {
							$typeAff .= "c";
						}
					}
					
					array_push($this->mon_arbre_t, $noeud);
					
					$this->construire_arbre(0, $les_eva_noeuds);
					
					foreach($this->mon_arbre_t as $noeud) {	
						if ($controleSmile==false) {
							if (intval($noeud["VALEUR"]) <= 50) {
								$this->pdf->ligne_arbo($typeAff."r", intval($noeud["NIVEAU"]), intval($noeud["VALEUR"]), $noeud["LIBELLE"]);
							} else {
								$this->pdf->ligne_arbo($typeAff."b", intval($noeud["NIVEAU"]), intval($noeud["VALEUR"]), $noeud["LIBELLE"]);
							}
						} else {
							$valeur = intval($noeud["VALEUR"]);
							$val = NULL;
							for($i = 0; $i < count($tabParamSmil); $i++) {
								if ($valeur < $tabParamSmil[$i]) {
									$val = $i+1;
									break;
								}
							}
							if(!isset($val)) {
								$val = count($tabParamSmil)+1;
							}
							$this->pdf->ligne_arbo($typeAff, intval($noeud["NIVEAU"]), $val, $noeud["LIBELLE"]);
						}
						
					}
					if (next($tableau_arbres)!=false) {
						$this->pdf->AddPage();
					}
				} else {
					//echo "pas cool !";
				}
				
				unset($this->mon_arbre_t);
			}
		}
	}
	
	function genDeclaration() {
		$config_lea	= $this->formation->get_config_lea();
		$les_periodes = $this->formation->get_periodes("entr_et_cfa", $this->acteur);
		
		$tab_tmp = array();
		
		foreach($les_periodes as $une_periode) {
			if($une_periode->suivi_cfa == "1") {
				$mon_id_declaration = $this->apprenti->get_id_declaration($une_periode->id_periode, "cfa");
				if($mon_id_declaration > 0) {
					array_push($tab_tmp, $mon_id_declaration);
				}

			}
			if($une_periode->suivi_entr == "1") {
				$mon_id_declaration = $this->apprenti->get_id_declaration($une_periode->id_periode, "entr");
				if($mon_id_declaration > 0) {
					array_push($tab_tmp, $mon_id_declaration);
				}
			}
		}
		
		foreach($tab_tmp as $une_declaration_id) {
			
			$declaration = new Declaration($une_declaration_id);
			$declaration->set_detail();
		
			$date_declaration = trans_date($declaration->date_dec);		
			
			$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
			
			if(count($les_arbres) > 0 ) {
				foreach($les_arbres as $arbre){
					if($feuilles_declarees = $declaration->afficher_feuilles_declarees_pdf($arbre, $declaration->id_periode) ) {
						//echo "<br /><br />-------- Feuilles d&eacute;clar&eacute;e ---------<br />";
						$this->pdf->tableauSuivi($feuilles_declarees);
					}											
				}
			}	
			
			if($tableau_modalites_suivi_libre = $declaration->afficher_tableau_modalites_suivi_libre_pdf($config_lea, $declaration->id_periode)) {
				// variable contenant le tableau_modalites_suivi_libres 
				// $tableau_modalites_suivi_libre;
				//echo "<br /><br />-------- Modalit&eacute;s ---------<br />";
				$this->pdf->tableauLibre($tableau_modalites_suivi_libre);
			}
		
			if ($fichiers_joints = $declaration->afficher_fichiers_joints_pdf()) {
				// variable contenant les fichiers joints
				// $fichiers_joints
				//echo "<br /><br />-------- Fichiers joints ---------<br />";
				//svM($fichiers_joints);
			}
		
			if($signatures = $declaration->afficher_signatures_pdf()) {
				// variable contenant les signatures
				// $signatures
				//echo "<br /><br />-------- Signatures ---------<br />";
				//$this->pdf->tableauSignature($signatures);
			}
			if (next($tab_tmp)!=false) {
				$this->pdf->AddPage();
			}
		}
	}
	

	function eval_noeud($id_noeud_racine, $les_eva_noeuds) {	
		$sum = 0;
		$nb  = 0;
		  
		for ($x=0; $x < count($les_eva_noeuds); $x++ ) {
			if ($les_eva_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
				$nb += 1;	
				if( $les_eva_noeuds[$x]->type == "feuille") {			
					$sum += $les_eva_noeuds[$x]->progression;
				} else {
					$eva = $this->eval_noeud($les_eva_noeuds[$x]->id_noeud, $les_eva_noeuds);
					$les_eva_noeuds[$x]->progression =  round($eva, 2);
					$sum += $eva;
				}			
			}
		}
		 
		if( $nb > 0 ) return ($sum/$nb);
		else return 0;
	}
	
	// cette fonction affiche les noeuds de l'arbre 
	
	function construire_arbre($id_noeud_racine, $les_eva_noeuds, $mon_niveau = 0) {										
		$mon_noeud = array();
		$mon_niveau++;
		for($x=0; $x < count($les_eva_noeuds); $x++ ) {
			if($les_eva_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
	
				$mon_noeud["NIVEAU"] = $mon_niveau;
				$mon_noeud["LIBELLE"] = $les_eva_noeuds[$x]->libelle;
				
				if($les_eva_noeuds[$x]->type == "feuille") {
					$mon_noeud["TYPE"] = "feuille";
					$mon_noeud["VALEUR"] = $les_eva_noeuds[$x]->progression;
				} else {
					$mon_noeud["TYPE"] = "noeud";
					$mon_noeud["VALEUR"] = round($this->eval_noeud($les_eva_noeuds[$x]->id_noeud, $les_eva_noeuds), 2);
				}
								
				array_push($this->mon_arbre_t, $mon_noeud);
				$this->construire_arbre($les_eva_noeuds[$x]->id_noeud, $les_eva_noeuds, $mon_niveau); 
			}
		}
	}
	
	function existe_t_il_une_Declaration($f_id_app, $f_id_periode, $f_type_suivi_periode) {
		$bdd_func = new Connexion_BDD_LEA();
		
		$sql = "SELECT id_dec
				FROM les_declarations
				WHERE id_app = '".$f_id_app."' and id_periode = '".$f_id_periode."' and type_suivi = '".$f_type_suivi_periode."'";
	
		$result = $bdd_func->executer($sql);		
		
		if ($ligne = mysql_fetch_assoc($result)) {
		  	return $ligne["id_dec"];
		} else {
			return 0;	
		}
	}
}
?>