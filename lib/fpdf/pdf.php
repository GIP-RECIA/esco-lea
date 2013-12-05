<?php
header('content-type: text/html; charset: utf-8'); 

function conv($txt) {
	return iconv("UTF-8", "ISO-8859-1", $txt);
}

class PDF extends FPDF
{
	var $nomLivret;
	var $nomApprenti;

	function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='') {
		return(parent::Cell($w,$h,conv($txt),$border,$ln,$align,$fill,$link));
	}
	
	function Text($x,$y,$txt) {
		return parent::Text($x,$y,conv($txt));
	}	
	
	//En-tete
	function Header() {
		$this->SetFont('Helvetica','',8);
		$this->Text(12,11, $this->nomLivret);
		$decalage = $this->getStringWidth($this->nomApprenti);
		$this->Text(198-$decalage,11,$this->nomApprenti);
		$this->setLinewidth(0.3);
		$this->setDrawColor(254,169,18);//orange
		$this->Line(10,12,200,12);
	}

	//Pied de page
	function Footer() {
		$this->SetFont('Helvetica','',8);
		$this->setLinewidth(0.3);
		$this->setDrawColor(20,103,183);//bleu
		$this->Line(10,285,200,285);
		//$this->Text(12,288,'LEA - LIUM'); //--> c'est l'emplacement en bas a gauche de la page PDF
		$decalage = $this->getStringWidth('Page '.$this->PageNo());
		$this->Text(198-$decalage,288,'Page '.$this->PageNo());
	}
	
	function setInformations($nomLivret,$nomApprenti) {
		$this->nomLivret = $nomLivret;
		$this->nomApprenti = $nomApprenti;
	}
	
	function pageDeCouverture($lea, $nom, $prenom, $adresse, $classe, $entreprise, $tuteur, $maitre, $term_classe, $term_entr, $term_tuteur, $term_ma) {
		$testurl = _REP_.'lib/fpdf/media/intro.jpg';
		$this->Image($testurl,0,0,210,297);
		$this->SetFont('Helvetica', '', 24);
		$this->SetTextColor(255,255,255);
		$tab = $this->MEFtext($lea);
		switch(count($tab)) {
			case '1':
				$this->Text(115,36,$tab[0]);//24
				break;
			case '2':
				$this->Text(115,30,$tab[0]);//24
				$this->Text(115,42,$tab[1]);
				break;
			case '3':
				$this->Text(115,24,$tab[0]);//24
				$this->Text(115,36,$tab[1]);
				$this->Text(115,48,$tab[2]);
				break;
			case '4':
				$this->Text(115,18,$tab[0]);//24
				$this->Text(115,30,$tab[1]);
				$this->Text(115,42,$tab[2]);
				$this->Text(115,54,$tab[3]);
				break;
			default:
				$this->SetFont('Times', '', 20);
				$this->Text(115,699,$tab);//20
				break;
		}	
		
		$this->SetFont('Times', '', 8);
		$this->setTextColor(0,0,0);
		$this->Text(30,254,'Nom : '.$nom.'');
		$this->Text(30,258,html_entity_decode('Pr&eacute;nom : '.$prenom.'', ENT_QUOTES, "UTF-8"));
		$this->parserAdresse($adresse);
		$this->setLinewidth(0.5);
		$this->setDrawColor(204,204,204);//gris fonce
		$this->Line(15,265.5,195,265.5);
		$this->Text(30,271,$term_classe.' : '.$classe.'');
		$this->Text(110,271,$term_entr.' : '.$entreprise.'');
		$this->Text(30,275,$term_tuteur.' : '.$tuteur.'');
		$this->Text(110,275,$term_ma.' : '.$maitre.'');
	}
	
	function MEFtext($texteAmod) {
		$final = array();
		$count = -1;
		$donnee = explode(' ', $texteAmod);
		for ($i=0; $i<count($donnee); $i++) {
			if(isset($final[$count])){
				if ((strlen($final[$count])+ strlen($donnee[$i]) +1)< 15) {
					if ($i==0) {
						$final[$count]=$donnee[$i];
					} else {
						$final[$count]=$final[$count].' '.$donnee[$i];
					}
				} else {
					$count++;
					$final[$count]=$donnee[$i];	
				}
			} else{
				$count++;
				$final[$count]=$donnee[$i];
			}
		}
		/*echo "<pre>";
		var_dump($final);
		echo "</pre>";*/
		return $final;
	}
	
	function parserAdresse($adresse) {
		$decalage = $this->getStringWidth('Adresse : ');
		$tab = explode('<br />', nl2br($adresse));
		$nbligne = count($tab);
		$maj = false;
		if ($nbligne > 3) {
			$nbmotsparligne = ceil($nbligne/3);
			$nbtour = $nbligne%3;
			for($x=0; $x < 3; $x++) {
				if($x==0) {
					for($a=0; $a < $nbmotsparligne; $a++) {
						$ligne1 .= $tab[$a];
						if ($a != ($nbmotsparligne-1)) {
							$ligne1 .= ' - ';
						}
					}
					$this->Text(110,254,'Adresse : '.$ligne1);
					if($nbtour!=0) {
						$nbtour--;
					}
				} elseif ($x==1) {
					if($nbtour!=0) {
						for($b=0; $b < $nbmotsparligne; $b++) {
							$ligne2 .= $tab[($b+$nbmotsparligne)];
							if ($b != ($nbmotsparligne-1)) {
								$ligne2 .= ' - ';
							}
						}
						$nbtour--;
					} else {
						$nbmotsparligne--;
						$maj = true;
						for($b=0; $b < $nbmotsparligne; $b++) {
							$ligne2 .= $tab[($b+$nbmotsparligne+1)];
							if ($b != ($nbmotsparligne-1)) {
								$ligne2 .= ' - ';
							}
						}
					}
					$this->Text(110+$decalage,258,$ligne2);
				} elseif ($x==2) {
					if($nbtour!=0) {
						for($c=0; $c < $nbmotsparligne; $c++) {
							$ligne3 .= $tab[($c+$nbmotsparligne)];
							if ($c != ($nbmotsparligne-1)) {
								$ligne3 .= ' - ';
							}
						}
						$nbtour--;
					} else {
						if($maj==true) {
							for($c=0; $c < $nbmotsparligne; $c++) {
								$ligne3 .= $tab[($c+$nbmotsparligne)];
								if ($c != ($nbmotsparligne-1)) {
									$ligne3 .= ' - ';
								}
							}
						} else {
							$nbmotsparligne--;
							$maj = true;
							for($c=0; $c < $nbmotsparligne; $c++) {
								$ligne3 .= $tab[($c+$nbmotsparligne+1)];
								if ($c != ($nbmotsparligne-1)) {
									$ligne3 .= ' - ';
								}
							}
						} 
					}
					$this->Text(110+$decalage,262,$ligne3);
				}
			}
		} else {
			$decalage = $this->getStringWidth('Adresse : ');
			$this->Text(110,254,'Adresse : '.$tab[0]);
			@$this->Text(110+$decalage,258,$tab[1]);
			@$this->Text(110+$decalage,262,$tab[2]);
		}
	}
	
	function ligne_arbo($type, $niveau, $value=0, $nom) {
		$posY = $this->GetY();
		$nom = html_entity_decode($nom, ENT_QUOTES, "UTF-8");
		switch($type) {
			case 'bppcr':
				$this->Text(50+(7*$niveau),$posY+3.5,$value.'%    '.$nom);
				$this->barre_level('rouge',$niveau, $posY, $value);
				break;
			case 'bppcb':
				$this->Text(50+(7*$niveau),$posY+3.5,$value.'%    '.$nom);
				$this->barre_level('bleu',$niveau, $posY, $value);
				break;
			case 'bpscr':
				$this->Text(50+(7*$niveau),$posY+3.5,$value.'%    '.$nom);
				$this->barre_progressif('rouge',$niveau, $posY, $value);
				break;
			case 'bpscb':
				$this->Text(50+(7*$niveau),$posY+3.5,$value.'%    '.$nom);
				$this->barre_progressif('bleu',$niveau, $posY, $value);
				break;
			case 'bppr':
				$this->Text(50+(7*$niveau),$posY+3.5,$nom);
				$this->barre_level('rouge',$niveau, $posY, $value);
				break;
			case 'bppb':
				$this->Text(50+(7*$niveau),$posY+3.5,$nom);
				$this->barre_level('bleu',$niveau, $posY, $value);
				break;
			case 'bpsr':
				$this->Text(50+(7*$niveau),$posY+3.5,$nom);
				$this->barre_progressif('rouge',$niveau, $posY, $value);
				break;
			case 'bpsb':
				$this->Text(50+(7*$niveau),$posY+3.5,$nom);
				$this->barre_progressif('bleu',$niveau, $posY, $value);
				break;
			case 's3':
				$this->Text(24+(7*$niveau),$posY+3.5,$nom);
				$this->smiley_3($niveau, $posY, $value);
				break;
			case 's4':
				$this->Text(24+(7*$niveau),$posY+3.5,$nom);
				$this->smiley_4($niveau, $posY, $value);
				break;
			case 's5':
				$this->Text(24+(7*$niveau),$posY+3.5,$nom);
				$this->smiley_5($niveau, $posY, $value);
				break;
			case 'text':
				$this->Text(20+(7*$niveau),$posY,$nom);
				break;
		}
		if ($this->GetY() >= 265) {
			$this->AddPage();
		} else {
			if ($type=="text") {
				$this->SetY($this->GetY()+4);
			} else {
				$this->SetY($this->GetY()+6);
			}
		}
		
	}
	
	function barre_level($color, $niveau, $posY, $value) {
		$fond = _REP_.'lib/pdf/fond.jpg';
		$bloc = _REP_.'lib/pdf/fond_pallier_'.$color.'.jpg';
	
		$this->Image($fond,15+(7*$niveau),$posY,32);
		$nbbloc = floor($value/10);
		for($i=0; $i < $nbbloc; $i++) {
			$this->Image($bloc,16+(7*$niveau)+($i*3),$posY+0.6,3);
		}
	}
	
	function barre_progressif($color, $niveau, $posY, $value) {
		$fond = _REP_.'lib/pdf/fond.jpg';
		$bloc = _REP_.'lib/pdf/fond_complet_'.$color.'.jpg';
	
		$this->Image($fond,15+(7*$niveau),$posY,31);
		for($i=0; $i < $value; $i++) {
			$this->Image($bloc,15.5+(7*$niveau)+($i*0.3),$posY+0.6,0.3);
		}
	}
	
	function smiley_3($niveau, $posY, $value) {
		$s1 = _REP_.'lib/pdf/sad.jpg';
		$s2 = _REP_.'lib/pdf/bof.jpg';
		$s3 = _REP_.'lib/pdf/happy.jpg';
		switch($value) {
			case 1:
				$this->Image($s1,15+(7*$niveau),$posY,5);
				break;
			case 2:
				$this->Image($s2,15+(7*$niveau),$posY,5);
				break;
			case 3:
				$this->Image($s3,15+(7*$niveau),$posY,5);
				break;
		}
	}
	
	function smiley_4($niveau, $posY, $value) {
		$s1 = _REP_.'lib/pdf/sad.jpg';
		$s2 = _REP_.'lib/pdf/grognon.jpg';
		$s3 = _REP_.'lib/pdf/cool.jpg';
		$s4 = _REP_.'lib/pdf/happy.jpg';
		switch($value) {
			case 1:
				$this->Image($s1,15+(7*$niveau),$posY,5);
				break;
			case 2:
				$this->Image($s2,15+(7*$niveau),$posY,5);
				break;
			case 3:
				$this->Image($s3,15+(7*$niveau),$posY,5);
				break;
			case 4:
				$this->Image($s4,15+(7*$niveau),$posY,5);
				break;
		}
	}
	
	function smiley_5($niveau, $posY, $value) {
		$s1 = _REP_.'lib/pdf/sad.jpg';
		$s2 = _REP_.'lib/pdf/grognon.jpg';
		$s3 = _REP_.'lib/pdf/bof.jpg';
		$s4 = _REP_.'lib/pdf/cool.jpg';
		$s5 = _REP_.'lib/pdf/happy.jpg';
		switch($value) {
			case 1:
				$this->Image($s1,15+(7*$niveau),$posY,5);
				break;
			case 2:
				$this->Image($s2,15+(7*$niveau),$posY,5);
				break;
			case 3:
				$this->Image($s3,15+(7*$niveau),$posY,5);
				break;
			case 4:
				$this->Image($s4,15+(7*$niveau),$posY,5);
				break;
			case 5:
				$this->Image($s5,15+(7*$niveau),$posY,5);
				break;
		}
	}
	
	/*
	 * Fonction qui adapte le texte à la largeur de la cellule.
	 * Retourne un ARRAY contenant chacune des lignes obtenu.
	 */
	function parseTxt($data, $width) {
		$final = array();
		$j = 0;
		//Remplace nos balises par des balises <br /> 
		$data2 = preg_replace('/<!>/', '<br />', $data);
		//Remplace les retours chariot fait par l'utilisateur par des <br />
		$data3 = nl2br($data2);
		//Remplace les retours a la ligne par des espaces
		$data4 = preg_replace('/\\n/', ' ', $data3);
		//Recupere phrase par phrase l'ensemble des donnees
		$tab = explode('<br />',$data4);
		//Boucle d'affichage
		for($i=0; $i < count($tab); $i++){
			if ($this->GetStringWidth($tab[$i]) >= $width-((2*$this->cMargin))) {
				$cut = explode(' ', $tab[$i]);
				for ($k = 0; $k < count($cut); $k++) {
					//Verif si la ligne actuelle n'est pas trop grande
					if (@$this->GetStringWidth($final[$j]) >= $width-((2*$this->cMargin))) {
						$final[$j] = $cut[$k];
						$j++;
					} else {
						//Verif si c'est le premier mot
						if ($k == 0) {
							$final[$j] = $cut[$k];
						} else {
							//Verif si avec l'ajout la ligne n'est pas trop longue
							if (@$this->GetStringWidth($final[$j].' '.$cut[$k]) >= $width-((2*$this->cMargin))) {
								$j++;
								$final[$j] = $cut[$k];
							} else {
								$final[$j] = @$final[$j].' '.$cut[$k];
							}
						}
					}
				}
				$j++;
			} else {
				$final[$j] = trim($tab[$i]);
				$j++;
			}
		}
		return $final;
	}
	
	/*
	 * Fonction qui compte le nombre de ligne néccessaire pour afficher le texte dans un tableau
	 */
	function countLigne($data, $width) {
		return count($this->parseTxt($data, $width));
	}
	
	/*
	 * Fonction qui génère un tableau de suivi, en fonction des données
	 */
	function tableauSuivi($data) {
		$this->SetFont('Times', '', 8);
		$this->SetDrawColor(254,169,18);
		$this->SetLineWidth(0.3);
		$nomTab=$data["titre_tab"]["feuille"];
		
		$nbCols = (isset($data["titre_tab"]["modalite"])) ? count($data["titre_tab"]["modalite"]) : 0;
		$nbColsPage=ceil($nbCols/3);
		if(isset($data['groupes_de_feuilles']) && (count($data['groupes_de_feuilles']) > 0)) {
			for($i=0; $i < $nbColsPage; $i++) {
				$head="";
				$controleBG = 0;
				$nbdepart = $i*3;
				if($nbCols-$nbdepart >= 3) {
					$nbc = 3;
				} else {
					$nbc = $nbCols-$nbdepart;
				}
				for($z=0; $z < $nbc; $z++) {
					$head[$z][0] = $data["titre_tab"]["modalite"][$nbdepart+$z]["titre"];
					$head[$z][1] = $data["titre_tab"]["modalite"][$nbdepart+$z]["acteur"];
				}
				$this->HearderArray($data["titre_tab"]["feuille"], $head);
				foreach($data['groupes_de_feuilles'] as $periode => $categorie) {
					$this->BRows(array($periode), array(180), 1, 'L');
					foreach($categorie as $titre_cat => $ligne) {
						$titre="";
						$value="";
						$titre_temp_2 = $titre_cat;					
						for($j=0; $j < count($ligne); $j++) {
							//$titre_temp_2
							if($titre_temp_2!="") {
								$df = 5;
								switch($nbc) {
									case 1:				
										$this->NRows(array("",$titre_temp_2,""), array(5,90,85), $controleBG, 'L');
										break;
									case 2:				
										$this->NRows(array("",$titre_temp_2,""), array(5,85,90), $controleBG, 'L');
										break;
									case 3:				
										$this->NRows(array("",$titre_temp_2,""), array(5,70,105), $controleBG, 'L');
										break;
								}
							} else {
								$df = 0;
							}
							$titre = $ligne[$j]['titre'];
							for($l=0; $l < $nbc; $l++) {
								if(is_array($ligne[$j]['modalites'])) {
									$value[$l] = $this->tranformTxt($ligne[$j]['modalites'][$nbdepart+$l]);
								} else {
									$value[$l] = $ligne[$j]['modalites'];
								}
							}
							switch($nbc) {
								case 1:
									$this->XRows(array("",$titre, $value[0]), array(5+$df,90-$df,85),$data["titre_tab"]["feuille"],$head,$periode,$controleBG, array('L','L','C'));
									break;
								case 2:
									$this->XRows(array("",$titre, $value[0], $value[1]), array(5+$df,85-$df,45,45),$data["titre_tab"]["feuille"],$head,$periode,$controleBG, array('L','L','C','C'));
									break;
								case 3:
									$this->XRows(array("",$titre, $value[0], $value[1], $value[2]), array(5+$df,70-$df,35,35,35),$data["titre_tab"]["feuille"],$head,$periode,$controleBG, array('L','L','C','C','C'));
									break;
							}
							if($controleBG==0) {
								$controleBG++;
							} else {
								$controleBG=0;
							}
						}
					}
				}
				$this->Cell(180, 0.3, '', 'B', 1);
				$this->Cell(180, 10, '', 0, 1);
			}
		}
	}
	
	function tableauSuiviVierge($data) {
		$this->SetFont('Times', '', 8);
		$this->SetDrawColor(254,169,18);
		$this->SetLineWidth(0.3);
		$nomTab=$data["titre_tab"]["feuille"];
		$nbCols = (isset($data["titre_tab"]["modalite"])) ? count($data["titre_tab"]["modalite"]) : 0;
		$nbColsPage=ceil($nbCols/3);
		if(count($data['groupes_de_feuilles']) > 0) {
			for($i=0; $i < $nbColsPage; $i++) {
				$head="";
				$controleBG = 0;
				$nbdepart = $i*3;
				if($nbCols-$nbdepart >= 3) {
					$nbc = 3;
				} else {
					$nbc = $nbCols-$nbdepart;
				}
				for($z=0; $z < $nbc; $z++) {
					$head[$z][0] = $data["titre_tab"]["modalite"][$nbdepart+$z]["titre"];
					$tabActeur = explode("/", $data["titre_tab"]["modalite"][$nbdepart+$z]["acteur"]);
					$head[$z][1] = $tabActeur[0];
				}
				$this->HearderArray($data["titre_tab"]["feuille"], $head);
				foreach($data['groupes_de_feuilles'] as $periode => $categorie) {
					
					$this->BRows(array($periode), array(180), 1, 'L');
					foreach($categorie as $titre_cat => $ligne) {
						$titre="";
						$value="";
						$titre_temp_2 = $titre_cat;					
						for($j=0; $j < count($ligne); $j++) {
							if($titre_temp_2!="") {
								$df = 5;
								switch($nbc) {
									case 1:				
										$this->NRows(array("",$titre_temp_2,""), array(5,90,85), $controleBG, 'L');
										break;
									case 2:				
										$this->NRows(array("",$titre_temp_2,""), array(5,85,90), $controleBG, 'L');
										break;
									case 3:				
										$this->NRows(array("",$titre_temp_2,""), array(5,70,105), $controleBG, 'L');
										break;
								}
							} else {
								$df = 0;
							}
							$titre = $ligne[$j]['titre'];
							for($l=0; $l < $nbc; $l++) {
								if(is_array($ligne[$j]['modalites'][$nbdepart+$l])) {
									$value[$l] = $this->tranformTxt($ligne[$j]['modalites'][$nbdepart+$l]);
									$count[$l] = $ligne[$j]['modalites'][$nbdepart+$l];
								} else {
									$value[$l] = $ligne[$j]['modalites'][$nbdepart+$l];
									$count[$l] = 1;
								}
								$type[$l] = $ligne[$j]['types_modalites'][$nbdepart+$l];
							}
							switch($nbc) {
								case 1:
									$this->XRows(array("",$titre,"",$value[0]), array(5+$df,90-$df,5,80),$data["titre_tab"]["feuille"],$head,$periode,$controleBG, array('L','L','L','L'));
									$this->SetDrawColor(0,0,0);
									$this->SetFillColor(255,255,255);
									$this->SetLineWidth(0.2);
									$nbligne_titre = $this->countLigne($titre, 90-$df);
									$nbligne[0] = $this->countLigne($value[0], 80);
									if ($nbligne_titre > $nbligne[0]) {
										$decalage[0] = $nbligne_titre-$nbligne[0];
									} else {
										$decalage[0] = 0;
									}
									if ($type[0]=="unique") {
										for ($n = count($count[0]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[0][-($n-count($count[0]))], 80)-1;
											$this->Circle($this->GetX()+97, $this->GetY()-((4*(($n+$nbreligne+$decalage[0])-1))+2), 1.5, "DF");
										}
									} elseif ($type[0]=="multiple") {
										for ($n = count($count[0]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[0][-($n-count($count[0]))], 80)-1;
											$this->Rect($this->GetX()+97, $this->GetY()-((4*(($n+$nbreligne+$decalage[0])-1))+3.5), 3, 3, "DF");
										}
									}
									break;
								case 2:
									$this->XRows(array("",$titre,"",$value[0],"",$value[1]), array(5+$df,85-$df,5,40,5,40),$data["titre_tab"]["feuille"],$head,$periode,$controleBG, array('L','L','L','L','L','L'));
									$this->SetDrawColor(0,0,0);
									$this->SetFillColor(255,255,255);
									$this->SetLineWidth(0.2);
									$nbligne_titre = $this->countLigne($titre, 85-$df);
									$nbligne[0] = $this->countLigne($value[0], 40);
									$nbligne[1] = $this->countLigne($value[1], 40);
									if ($nbligne_titre > $nbligne[0]) {
										$decalage[0] = $nbligne_titre-$nbligne[0];
									} else {
										$decalage[0] = 0;
									}
									if ($nbligne_titre > $nbligne[1]) {
										$decalage[1] = $nbligne_titre-$nbligne[1];
									} else {
										$decalage[1] = 0;
									}
									if ($type[0]=="unique") {
										for ($n = count($count[0]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[0][-($n-count($count[0]))], 40)-1;
											$this->Circle($this->GetX()+92, $this->GetY()-((4*(($n+$nbreligne+$decalage[0])-1))+2), 1.5, "DF");
										}
									} elseif ($type[0]=="multiple") {
										for ($n = count($count[0]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[0][-($n-count($count[0]))], 40)-1;
											$this->Rect($this->GetX()+92, $this->GetY()-((4*(($n+$nbreligne+$decalage[0])-1))+3.5), 3, 3, "DF");
										}
									}
									if ($type[1]=="unique") {
										for ($n = count($count[1]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[1][-($n-count($count[1]))], 40)-1;
											$this->Circle($this->GetX()+137, $this->GetY()-((4*(($n+$nbreligne+$decalage[1])-1))+2), 1.5, "DF");
										}
									} elseif ($type[1]=="multiple") {
										for ($n = count($count[1]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[1][-($n-count($count[1]))], 40)-1;
											$this->Rect($this->GetX()+137, $this->GetY()-((4*(($n+$nbreligne+$decalage[1])-1))+3.5), 3, 3, "DF");
										}
									}
									break;
								case 3:
									$this->XRows(array("",$titre,"",$value[0],"",$value[1],"",$value[2]), array(5+$df,70-$df,5,30,5,30,5,30),$data["titre_tab"]["feuille"],$head,$periode,$controleBG, array('L','L','L','L','L','L','L','L'));
									$this->SetDrawColor(0,0,0);
									$this->SetFillColor(255,255,255);
									$this->SetLineWidth(0.2);
									$nbligne_titre = $this->countLigne($titre, 70-$df);
									$nbligne[0] = $this->countLigne($value[0], 30);
									$nbligne[1] = $this->countLigne($value[1], 30);
									$nbligne[2] = $this->countLigne($value[2], 30);
									if ($nbligne_titre > $nbligne[0]) {
										$decalage[0] = $nbligne_titre-$nbligne[0];
									} else {
										$decalage[0] = 0;
									}
									if ($nbligne_titre > $nbligne[1]) {
										$decalage[1] = $nbligne_titre-$nbligne[1];
									} else {
										$decalage[1] = 0;
									}
									if ($nbligne_titre > $nbligne[2]) {
										$decalage[2] = $nbligne_titre-$nbligne[2];
									} else {
										$decalage[2] = 0;
									}
									if ($type[0]=="unique") {
										for ($n = count($count[0]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[0][-($n-count($count[0]))], 40)-1;
											$this->Circle($this->GetX()+77, $this->GetY()-((4*(($n+$nbreligne+$decalage[0])-1))+2), 1.5, "DF");
										}
									} elseif ($type[0]=="multiple") {
										for ($n = count($count[0]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[0][-($n-count($count[0]))], 40)-1;
											$this->Rect($this->GetX()+77, $this->GetY()-((4*(($n+$nbreligne+$decalage[0])-1))+3.5), 3, 3, "DF");
										}
									}
									if ($type[1]=="unique") {
										for ($n = count($count[1]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[1][-($n-count($count[1]))], 40)-1;
											$this->Circle($this->GetX()+112, $this->GetY()-((4*(($n+$nbreligne+$decalage[1])-1))+2), 1.5, "DF");
										}
									} elseif ($type[1]=="multiple") {
										for ($n = count($count[1]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[1][-($n-count($count[1]))], 40)-1;
											$this->Rect($this->GetX()+112, $this->GetY()-((4*(($n+$nbreligne+$decalage[1])-1))+3.5), 3, 3, "DF");
										}
									}
									if ($type[2]=="unique") {
										for ($n = count($count[2]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[2][-($n-count($count[2]))], 40)-1;
											$this->Circle($this->GetX()+147, $this->GetY()-((4*(($n+$nbreligne+$decalage[2])-1))+2), 1.5, "DF");
										}
									} elseif ($type[2]=="multiple") {
										for ($n = count($count[2]); $n > 0; $n--) {
											$nbreligne = $this->countLigne($count[2][-($n-count($count[2]))], 40)-1;
											$this->Rect($this->GetX()+147, $this->GetY()-((4*(($n+$nbreligne+$decalage[2])-1))+3.5), 3, 3, "DF");
										}
									}
									break;
							}
							if($controleBG==0) {
								$controleBG++;
							} else {
								$controleBG=0;
							}
						}
					}
				}
				$this->Cell(180, 0.3, '', 'B', 1);
				$this->Cell(180, 10, '', 0, 1);
			}
		}
	}
	
	function tableauLibre($data, $etat="r") {	
		$this->SetFont('Times', '', 8);
		$this->SetDrawColor(254,169,18);
		$this->SetLineWidth(0.3);
		for($i = 0; $i < count($data); $i++) {
			if($etat =="v"){
				$tabActeur = explode("/", $data[$i]["auteur"]);
				$this->NRows(array($data[$i]["libelle"], $tabActeur[0]), array(130,50),0, 'C');
			} else{
				$this->NRows(array($data[$i]["libelle"], $data[$i]["auteur"]), array(130,50),0, 'C');
			}
			$this->Cell(180, 0, '', 'B', 1);
			$this->Cell(180, 0.3, '', 0, 1);
			$reponse=$data[$i]["reponse"];
			if(is_array($reponse)) {
				for($j=0; $j < count($reponse); $j++) {
					if($data[$i]["type"]=="multiple") {
						if($reponse[$j]["cochee"]==true) {
							if($j==0) {
								$this->NRows(array("", "<!>".$reponse[$j]["reponse"]), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Rect($this->GetX()+22, $this->GetY()-3.5, 3, 3, "DF");
								$this->Line($this->GetX()+22, $this->GetY()-3.5, $this->GetX()+25, $this->GetY()-0.5);
								$this->Line($this->GetX()+22, $this->GetY()-0.5, $this->GetX()+25, $this->GetY()-3.5);
							} elseif($j==count($reponse)-1) {
								$this->NRows(array("", $reponse[$j]["reponse"]."<!>"), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Rect($this->GetX()+22, $this->GetY()-7.5, 3, 3, "DF");
								$this->Line($this->GetX()+22, $this->GetY()-7.5, $this->GetX()+25, $this->GetY()-4.5);
								$this->Line($this->GetX()+22, $this->GetY()-4.5, $this->GetX()+25, $this->GetY()-7.5);
							} else {
								$this->NRows(array("", $reponse[$j]["reponse"]), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Rect($this->GetX()+22, $this->GetY()-3.5, 3, 3, "DF");
								$this->Line($this->GetX()+22, $this->GetY()-3.5, $this->GetX()+25, $this->GetY()-0.5);
								$this->Line($this->GetX()+22, $this->GetY()-0.5, $this->GetX()+25, $this->GetY()-3.5);
							}
						} else {
							if($j==0) {
								$this->NRows(array("", "<!>".$reponse[$j]["reponse"]), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Rect($this->GetX()+22, $this->GetY()-3.5, 3, 3, "DF");
							} elseif($j==count($reponse)-1) {
								$this->NRows(array("", $reponse[$j]["reponse"]."<!>"), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Rect($this->GetX()+22, $this->GetY()-7.5, 3, 3, "DF");
							} else {
								$this->NRows(array("", $reponse[$j]["reponse"]), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Rect($this->GetX()+22, $this->GetY()-3.5, 3, 3, "DF");
							}
						}
					} else {
						if($reponse[$j]["cochee"]==true) {
							if($j==0) {
								$this->NRows(array("", "<!>".$reponse[$j]["reponse"]), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(0,0,0);
								$this->SetLineWidth(0.2);
								$this->Circle($this->GetX()+22, $this->GetY()-2, 1.5, "DF");
							} elseif($j==count($reponse)-1) {
								$this->NRows(array("", $reponse[$j]["reponse"]."<!>"), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(0,0,0);
								$this->SetLineWidth(0.2);
								$this->Circle($this->GetX()+22, $this->GetY()-6, 1.5, "DF");
							} else {
								$this->NRows(array("", $reponse[$j]["reponse"]), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(0,0,0);
								$this->SetLineWidth(0.2);
								$this->Circle($this->GetX()+22, $this->GetY()-2, 1.5, "DF");
							}
						} else {
							if($j==0) {
								$this->NRows(array("", "<!>".$reponse[$j]["reponse"]), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Circle($this->GetX()+22, $this->GetY()-2, 1.5, "DF");
							} elseif($j==count($reponse)-1) {
								$this->NRows(array("", $reponse[$j]["reponse"]."<!>"), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Circle($this->GetX()+22, $this->GetY()-6, 1.5, "DF");
							} else {
								$this->NRows(array("", $reponse[$j]["reponse"]), array(40,140),1, 'L');
								$this->SetDrawColor(0,0,0);
								$this->SetFillColor(255,255,255);
								$this->SetLineWidth(0.2);
								$this->Circle($this->GetX()+22, $this->GetY()-2, 1.5, "DF");
							}
						}
					}
				}
			} else {
				if($reponse=="") {
					$this->NRows(array("","<!><!><!><!><!>",""), array(10,160,10),1, 'L');
					$this->SetDrawColor(0,0,0);
					$this->SetFillColor(255,255,255);
					$this->SetLineWidth(0.2);
					$this->Rect($this->GetX()+20, $this->GetY()-20.5,140, 17, "DF");
				} else {
					$this->NRows(array("","<!>".$reponse."<!>",""), array(10,160,10),1, 'L');
				}
			}
			$this->Cell(180, 10, '', 0, 1);
		}
		
	}
	
	function tableauSignature($data) {
		$countControle = 0;
		$this->NRows(array("", "Les signataires de la declaration"), array(10,170),0, 'L');
		$this->Cell(180, 0, '', 'B', 1);
		$this->Cell(180, 0.3, '', 0, 1);
		for($i=0; $i < count($data); $i++) {
			if($data[$i]["date"]!=NULL) {
				$this->NRows(array(""), array(180),1, 'L');
				$this->NRows(array("",$data[$i]["auteur"],$data[$i]["date"]), array(10,70,100),1, 'L');
				$countControle++;
			}
		}
		if($countControle == 0) {
			$this->NRows(array(""), array(180),1, 'L');
			$this->NRows(array("","Aucunes signatures !"), array(10,170),1, 'L');
		}
		$this->NRows(array(""), array(180),1, 'L');
	}
	
	function tableauSignatureVierge($data, $config) {
		$this->NRows(array("", "Les signataires de la declaration"), array(10,170),0, 'L');
		$this->Cell(180, 0, '', 'B', 1);
		$this->Cell(180, 0.3, '', 0, 1);
		for($i=0; $i < count($data); $i++) {
			if($data[$i]["profil"] == "app"){
				$this->NRows(array("","<!>".strtoupper($config->appelation_app)." :"), array(10,170),1, 'L');
			}
			if($data[$i]["profil"] == "ens"){
				$this->NRows(array("","<!>".strtoupper($config->appelation_ens)." :"), array(10,170),1, 'L');
			}
			if($data[$i]["profil"] == "ma"){
				$this->NRows(array("","<!>".strtoupper($config->appelation_ma)." :"), array(10,170),1, 'L');
			}
			$this->NRows(array("","Melle/Mme/M.", ", le      /     /     <!>"), array(10,70,100),1, 'L');
			$this->SetDrawColor(0,0,0);
			$this->SetFillColor(255,255,255);
			$this->SetLineWidth(0.2);
			$this->Rect($this->GetX()+120, $this->GetY()-9.5, 40, 7, "DF");
			//$this->Cell(180, 0, '', 'B', 1);
			$this->Cell(180, 0.5, '', 0, 1);
		}
	}
	
	/*
	 * Transforme un ARRAY en une chaine de caractère, séparé par <!>
	 */
	function tranformTxt($data) {
		$value = "";
		if (is_array($data)==true) {
			for($i=0; $i < count($data); $i++) {
				if ($i==0) {
					$value = $data[$i];
				} else {
					$value .= "<!>".$data[$i];
				}
			}
		} else {
			$value=$data;
		}
		return $value;
	}
	
	/*
	 * Fonction qui généré l'entete d'un tableau de suivi,
	 * en fonction du titre et des titres de colonnes
	 */
	function HearderArray($nom, $arrayCols) {
		switch(count($arrayCols)) {
			case 1:
				$mainCol = 90;
				$secondCol =90;
				break;
			case 2:
				$mainCol = 80;
				$secondCol =50;
				break;
			case 3:
				$mainCol = 75;
				$secondCol =35;
				break;
		}
		$maxValue_0 = $this->countLigne($nom, $mainCol);
		$maxValue_1 = 0;
		$maxValue_2 = 0;
		for($i=0; $i < count($arrayCols); $i++) {
			if ($maxValue_1 < $this->countLigne($arrayCols[$i][0], $secondCol))  {
				$maxValue_1 = $this->countLigne($arrayCols[$i][0], $secondCol);
			}
			if ($maxValue_2 < $this->countLigne($arrayCols[$i][1], $secondCol))  {
				$maxValue_2 = $this->countLigne($arrayCols[$i][1], $secondCol);
			}
		}
		$maxValue = $maxValue_1+$maxValue_2;
		if ($maxValue < $maxValue_0) {
			$diff = $maxValue_0-$maxValue;
			$maxValue = $maxValue_0;
			if ($diff%2 == 0) {
				$maxValue_1 += $diff/2;
				$maxValue_2 += $diff/2;
			} else {
				$maxValue_1 += floor($diff/2)+1;
				$maxValue_2 += floor($diff/2);
			}
		}
		$this->XCell($nom, $mainCol, $maxValue, 0, 0, 'L');
		for($i=0; $i < count($arrayCols); $i++) {
			if ($i == count($arrayCols)-1)  {
				$this->XCell($arrayCols[$i][0], $secondCol, $maxValue_1, 1);
			} else {
				$this->XCell($arrayCols[$i][0], $secondCol, $maxValue_1);
			}
		}
		$this->Cell($mainCol);
		$this->Cell(180-$mainCol, 0, '', 'B', 1);
		$this->Cell($mainCol);
		for($i=0; $i < count($arrayCols); $i++) {
			if ($i == count($arrayCols)-1)  {
				$this->XCell($arrayCols[$i][1], $secondCol, $maxValue_2, 1);
			} else {
				$this->XCell($arrayCols[$i][1], $secondCol, $maxValue_2);
			}
		}
		$this->Cell(180, 0, '', 'B', 1);
		$this->Cell(180, 0.3, '', 0, 1);
	}
	
	/*
	 * Fonction qui génère une Ligne de tableau, principale
	 */
	function XRows($arrayData, $arrayWidth, $nomtab, $arrayCols, $bluetitre, $bgcolor=0, $align='C') {
		if(count($arrayData) == count($arrayWidth)) {
			$maxValue=0;
			for($v=0; $v<count($arrayData); $v++) {
				$value = $this->countLigne($arrayData[$v], $arrayWidth[$v]);
				if($value > $maxValue) {
					$maxValue = $value;
				} 
			}
			if ($maxValue*3+$this->GetY() > 270) {
				$this->AddPage();
				$this->HearderArray($nomtab, $arrayCols);
				$this->BRows(array($bluetitre), array(180), 1, 'L');
			}			
			for ($j=0; $j<count($arrayData); $j++) {
				if($j == count($arrayData)-1) {
					$this->XCell($arrayData[$j], $arrayWidth[$j], $maxValue, 1, $bgcolor, $align[$j]);
				} else {
					$this->XCell($arrayData[$j], $arrayWidth[$j], $maxValue, 0, $bgcolor, $align[$j]);
				}
			}
		} else {
			echo "Erreur : XRows !";
		}
	}
	
	/*
	 * Fonction qui génère une Ligne de tableau, spéciale
	 */
	function NRows($arrayData, $arrayWidth, $bgcolor=0, $align='C') {
		if(count($arrayData) == count($arrayWidth)) {
			$maxValue=0;
			for($v=0; $v<count($arrayData); $v++) {
				$value = $this->countLigne($arrayData[$v], $arrayWidth[$v]);
				if($value > $maxValue) {
					$maxValue = $value;
				} 
			}
			if ($maxValue*4+$this->GetY() > 270) {
				$this->AddPage();
			}			
			for ($j=0; $j<count($arrayData); $j++) {
				if($j == count($arrayData)-1) {
					$this->XCell($arrayData[$j], $arrayWidth[$j], $maxValue, 1, $bgcolor, $align);
				} else {
					$this->XCell($arrayData[$j], $arrayWidth[$j], $maxValue, 0, $bgcolor, $align);
				}
			}
		} else {
			echo "Erreur : NRows !";
		}
	}
	
	/*
	 * Fonction qui génère une Ligne de tableau, titre bleu
	 */
	function BRows($arrayData, $arrayWidth, $bgcolor=0, $align='C') {
		if(count($arrayData) == count($arrayWidth)) {
			$maxValue=0;
			for($v=0; $v<count($arrayData); $v++) {
				$value = $this->countLigne($arrayData[$v], $arrayWidth[$v]);
				if($value > $maxValue) {
					$maxValue = $value;
				} 
			}
			if ($maxValue*6+$this->GetY() > 270) {
				$this->AddPage();
			}			
			for ($j=0; $j<count($arrayData); $j++) {
				if($j == count($arrayData)-1) {
					$this->BCell($arrayData[$j], $arrayWidth[$j], $maxValue, 1, $bgcolor, $align);
				} else {
					$this->BCell($arrayData[$j], $arrayWidth[$j], $maxValue, 0, $bgcolor, $align);
				}
			}
		} else {
			echo "Erreur : BRows !";
		}
	}
	
	/*
	 * Fonction qui crée une cellule à partir d'un ARRAY de texte
	 */
	function XCell($txt, $width, $nbligne=0, $ln=0, $bgcolor=0, $align='C') {
		$this->setDrawColor(254,169,18);		
		$data = $this->parseTxt($txt, $width);
		if($nbligne==0) {
			$nb_l = $this->countLigne($txt, $width);
		} else {
			$nb_l = $nbligne;
		}
		$x=$this->GetX();
		$y=$this->GetY();
		
		$h = 4;
		
		for($i=0;$i<$nb_l;$i++) {
			if(isset($data[$i])) {
				$temp_data = $data[$i];
			} else {
				$temp_data = "";
			}
			$xLine=$this->GetX();
			$yLine=$this->GetY();
			$this->SetFont('Times', '', 8);
			$this->SetTextColor(0, 0, 0);
			$this->setFillColor(231, 231, 231);
			$this->MultiCell($width, $h, $temp_data, 0, $align, $bgcolor);
			$this->SetXY($xLine, $yLine+$h);
		}
		switch($ln) {
			case 0: //a droite
				$this->SetXY($x+$width, $y);
				break;
			case 1: //debut ligne
				$this->SetXY($this->lMargin,$y+($h*$nb_l));
				break;
			case 2: //en dessous
				$this->SetXY($x,$y+($h*$nb_l)); 		
				break;
		}
	}
	
/*
	 * Fonction qui crée une cellule à partir d'un ARRAY de texte
	 */
	function BCell($txt, $width, $nbligne=0, $ln=0, $bgcolor=0, $align='C') {
		$data = $this->parseTxt($txt, $width);
		if($nbligne==0) {
			$nbligne = count($data);
		} else {
			$nbligne = $nbligne;
		}
		$x=$this->GetX();
		$y=$this->GetY();
		
		$h = 6;
		for($i=0;$i<$nbligne;$i++) {
			$xLine=$this->GetX();
			$yLine=$this->GetY();
			$this->SetFont('Times', '', 12);
			$this->setFillColor(30,164,253);
			$this->SetTextColor(255,255,255);
			@$this->MultiCell($width,$h,$data[$i],0,$align, $bgcolor);
			$this->SetXY($xLine,$yLine+$h);
		}
		switch($ln) {
			case 0: //a droite
				$this->SetXY($x+$width,$y);
				break;
			case 1: //debut ligne
				$this->SetXY($this->lMargin,$y+($h*$nbligne)); 
				break;
			case 2: //en dessous
				$this->SetXY($x,$y+($h*$nbligne)); 			
				break;
		}
	}
	
	function CCell($txt, $width, $align='C', $taillePolice, $arrayFillColor=array(30,164,253), $arrayTextColor=array(255,255,255), $nbligne=0, $ln=1, $bgcolor=1) {		
		$this->SetFont('Times', '', $taillePolice);
		$data = $this->parseTxt($txt, $width);
		if($nbligne==0) {
			$nbligne = count($data);
		} else {
			$nbligne = $nbligne;
		}
		$x=$this->GetX();
		$y=$this->GetY();
		$stx = "".$x;
		$sty = "".$y;
		//S'il n'y a pas de couverture il faut repositionner le curseur
		if($stx == "10.00125" || $sty == "10.00125"){
			$x = 13;
			$this->SetX(13);
			$y = 20;
			$this->SetY(20);
		}
		$h = 6;
		for($i=0;$i<$nbligne;$i++) {
			$xLine=$this->GetX();
			$yLine=$this->GetY();
			$this->SetFont('Times', '', $taillePolice);
			$this->setFillColor($arrayFillColor[0],$arrayFillColor[1],$arrayFillColor[2]);
			$this->SetTextColor($arrayTextColor[0],$arrayTextColor[1],$arrayTextColor[2]);
			$this->MultiCell($width,$h,$data[$i],0,$align, $bgcolor);
			$this->SetXY($xLine,$yLine+$h);
		}
		switch($ln) {
			case 0: //a droite
				$this->SetXY($x+$width,$y);
				break;
			case 1: //debut ligne
				$this->SetXY($this->lMargin,$y+($h*$nbligne)); 
				break;
			case 2: //en dessous
				$this->SetXY($x,$y+($h*$nbligne)); 			
				break;
		}
	}
	
	function Circle($x,$y,$r,$style='') {
		$this->Ellipse($x,$y,$r,$r,$style);
	}

	function Ellipse($x,$y,$rx,$ry,$style='D') {
		if($style=='F')
		  $op='f';
		elseif($style=='FD' or $style=='DF')
		  $op='B';
		else
		  $op='S';
		 $lx=4/3*(M_SQRT2-1)*$rx;
		 $ly=4/3*(M_SQRT2-1)*$ry;
		 $k=$this->k;
		 $h=$this->h;
		 $this->_out(sprintf('%.2f %.2f m %.2f %.2f %.2f %.2f %.2f %.2f c',
		  ($x+$rx)*$k,($h-$y)*$k,
		  ($x+$rx)*$k,($h-($y-$ly))*$k,
		  ($x+$lx)*$k,($h-($y-$ry))*$k,
		  $x*$k,($h-($y-$ry))*$k));
		 $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c',
		  ($x-$lx)*$k,($h-($y-$ry))*$k,
		  ($x-$rx)*$k,($h-($y-$ly))*$k,
		  ($x-$rx)*$k,($h-$y)*$k));
		 $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c',
		  ($x-$rx)*$k,($h-($y+$ly))*$k,
		  ($x-$lx)*$k,($h-($y+$ry))*$k,
		  $x*$k,($h-($y+$ry))*$k));
		 $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c %s',
		  ($x+$lx)*$k,($h-($y+$ry))*$k,
		  ($x+$rx)*$k,($h-($y+$ly))*$k,
		  ($x+$rx)*$k,($h-$y)*$k,
		  $op));
	}
}

?>