<?php

function MEFtext($text) {
	$final = array();
	$count = 0;
	$donnee = explode(' ', $text);
	for ($i=0; $i<count($donnee); $i++) {
		if (strlen($final[$count])<13) {
			if ($i==0) {
				$final[$count]=$donnee[$i];
			} else {
				$final[$count]=$final[$count].' '.$donnee[$i];
			}
		} else {
			$count++;
			$final[$count]=$donnee[$i];
		}
	}
	return $final;
}

function parserAdresse($pdf, $adresse) {
	$decalage = $pdf->getTextWidth(10,'<b>Adresse :</b> ');
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
				$pdf->addText(300,125,10,'<b>Adresse :</b> '.$ligne1);
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
				$pdf->addText(300+$decalage,110,10,$ligne2);
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
				$pdf->addText(300+$decalage,95,10,$ligne3);
			}
		}
	} else {
		$decalage = $pdf->getTextWidth(10,'<b>Adresse :</b> ');
		$pdf->addText(300,125,10,'<b>Adresse :</b> '.$tab[0]);
		$pdf->addText(300+$decalage,110,10,$tab[1]);
		$pdf->addText(300+$decalage,95,10,$tab[2]);
	}
}

function pageDeCouverture($pdf, $lea, $nom, $prenom, $adresse, $classe, $entreprise, $tuteur, $maitre, $term_classe, $term_entr, $term_tuteur, $term_ma) {
	$testurl = _REP_.'lib/pdf/intro.jpg';
	$pdf->addJpegFromFile($testurl,0,0,595);
	$pdf->selectFont(_MAINFONT_);
	$pdf->setColor(1,1,1,1);
	$tab = MEFtext($lea);
	switch(count($tab)) {
		case '1':
			$pdf->addText(330,740,24,$tab[0]);
			break;
		case '2':
			$pdf->addText(330,755,24,$tab[0]);
			$pdf->addText(330,725,24,$tab[1]);
			break;
		case '3':
			$pdf->addText(330,770,24,$tab[0]);
			$pdf->addText(330,740,24,$tab[1]);
			$pdf->addText(330,710,24,$tab[2]);
			break;
		case '4':
			$pdf->addText(330,775,24,$tab[0]);
			$pdf->addText(330,750,24,$tab[1]);
			$pdf->addText(330,725,24,$tab[2]);
			$pdf->addText(330,700,24,$tab[3]);
			break;
		case '5':
			$pdf->addText(330,779,20,$tab[0]);
			$pdf->addText(330,759,20,$tab[1]);
			$pdf->addText(330,739,20,$tab[2]);
			$pdf->addText(330,719,20,$tab[3]);
			$pdf->addText(330,699,20,$tab[4]);
			break;
		default:
			$pdf->addText(330,699,20,$tab);
			break;
	}	
	
	$pdf->selectFont(_MAINFONT_);
	$pdf->setColor(0,0,0,1);
	$pdf->addText(80,125,10,'<b>Nom :</b> '.$nom.'');
	$pdf->addText(80,110,10,'<b>Prénom :</b> '.$prenom.'');
	parserAdresse($pdf, $adresse);
	$pdf->setLineStyle(2);
	$pdf->setStrokeColor(0.8,0.8,0.8);//gris foncé
	$pdf->line(42,87,553,87);
	$pdf->addText(80,73,10,'<b>'.$term_classe.' :</b> '.$classe.'');
	$pdf->addText(300,73,10,'<b>'.$term_entr.' :</b> '.$entreprise.'');
	$pdf->addText(80,58,10,'<b>'.$term_tuteur.' :</b> '.$tuteur.'');
	$pdf->addText(300,58,10,'<b>'.$term_ma.' :</b> '.$maitre.'');
}

function miseEnPage($pdf, $nomLivret, $nomApprenti) {
	$all = $pdf->openObject();
	$pdf->saveState();
	$pdf->addText(30,815,8,$nomLivret);
	
	$decalage = $pdf->getTextWidth(8,$nomApprenti);
	$pdf->addText(571-$decalage,815,8,$nomApprenti);
	
	$pdf->setLineStyle(1);
	$pdf->setStrokeColor(0.078,0.403,0.717);//bleu
	$pdf->line(20,35,578,35);
	
	$pdf->setStrokeColor(0.996,0.662,0.07);//orange
	$pdf->line(20,812,578,812);
	
	$pdf->addText(30,27,8,'LEA - © LIUM');
	$pdf->restoreState();
	
	$pdf->closeObject();

	$pdf->addObject($all,'all');
}

function ligne_arbo($pdf, $type, $niveau, $posY, $value, $nom) {
	switch($type) {
		case 'blr':
			$pdf->addText(160+(20*$niveau),$posY-12,12,$value.'%    <b>'.$nom.'</b>');
			barre_level($pdf, 'rouge',$niveau, $posY, $value);
			break;
		case 'blb':
			$pdf->addText(160+(20*$niveau),$posY-12,12,$value.'%    <b>'.$nom.'</b>');
			barre_level($pdf, 'bleu',$niveau, $posY, $value);
			break;
		case 'bpr':
			$pdf->addText(160+(20*$niveau),$posY-12,12,$value.'%    <b>'.$nom.'</b>');
			barre_progressif($pdf, 'rouge',$niveau, $posY, $value);
			break;
		case 'bpb':
			$pdf->addText(160+(20*$niveau),$posY-12,12,$value.'%    <b>'.$nom.'</b>');
			barre_progressif($pdf, 'bleu',$niveau, $posY, $value);
			break;
		case 's3':
			$pdf->addText(80+(20*$niveau),$posY-12,12,'<b>'.$nom.'</b>');
			smiley_3($pdf, $niveau, $posY, $value);
			break;
		case 's5':
			$pdf->addText(80+(20*$niveau),$posY-12,12,'<b>'.$nom.'</b>');
			smiley_5($pdf, $niveau, $posY, $value);
			break;
	}
}

function barre_level($pdf, $color, $niveau, $posY, $value) {
	$fond = _REP_.'lib/pdf/fond.jpg';
	$bloc = _REP_.'lib/pdf/fond_pallier_'.$color.'.jpg';

	$pdf->addJpegFromFile($fond,50+(20*$niveau),$posY-16,104);
	$nbbloc = floor($value/10);
	for($i=0; $i < $nbbloc; $i++) {
		$pdf->addJpegFromFile($bloc,52+(20*$niveau)+($i*10),$posY-14,10);
	}
}

function barre_progressif($pdf, $color, $niveau, $posY, $value) {
	$fond = _REP_.'lib/pdf/fond.jpg';
	$bloc = _REP_.'lib/pdf/fond_complet_'.$color.'.jpg';

	$pdf->addJpegFromFile($fond,50+(20*$niveau),$posY-16,104);
	for($i=0; $i < $value; $i++) {
		$pdf->addJpegFromFile($bloc,52+(20*$niveau)+($i*1),$posY-14,1);
	}
}

function smiley_3($pdf, $niveau, $posY, $value) {
	$s1 = _REP_.'lib/pdf/sad.jpg';
	$s2 = _REP_.'lib/pdf/bof.jpg';
	$s3 = _REP_.'lib/pdf/happy.jpg';
	switch($value) {
		case 1:
			$pdf->addJpegFromFile($s1,50+(20*$niveau),$posY-18,104);
			break;
		case 2:
			$pdf->addJpegFromFile($s2,50+(20*$niveau),$posY-18,104);
			break;
		case 3:
			$pdf->addJpegFromFile($s3,50+(20*$niveau),$posY-18,20);
			break;
	}
}

function smiley_5($pdf, $niveau, $posY, $value) {
	$s1 = _REP_.'lib/pdf/sad.jpg';
	$s2 = _REP_.'lib/pdf/grognon.jpg';
	$s3 = _REP_.'lib/pdf/bof.jpg';
	$s4 = _REP_.'lib/pdf/cool.jpg';
	$s5 = _REP_.'lib/pdf/happy.jpg';
	switch($value) {
		case 1:
			$pdf->addJpegFromFile($s1,50+(20*$niveau),$posY-18,20);
			break;
		case 2:
			$pdf->addJpegFromFile($s2,50+(20*$niveau),$posY-18,20);
			break;
		case 3:
			$pdf->addJpegFromFile($s3,50+(20*$niveau),$posY-18,20);
			break;
		case 4:
			$pdf->addJpegFromFile($s4,50+(20*$niveau),$posY-18,20);
			break;
		case 5:
			$pdf->addJpegFromFile($s5,50+(20*$niveau),$posY-18,20);
			break;
	}
}

function synthese($pdf, $data) {
	/*echo '<pre>';
	var_dump($data);
	echo '</pre>';*/

	for ($i=0; $i < count($data); $i++) {
		if($i%30 == 0 && $i!= 0) {
			$pdf->ezNewPage();
		}
		$posY = (800-(24*($i%30)));
		ligne_arbo($pdf, $data[$i]['type_note'], $data[$i]['niveau'], $posY, $data[$i]['value_note'], $data[$i]['nom']);
	}
	
	/*ligne_arbo($pdf, $type, $niveau, $posY, $value);
	ligne_arbo($pdf, 'blr', 1, 800, 100);//1
	ligne_arbo($pdf, 'blb', 2, 776, 85);
	ligne_arbo($pdf, 'blr', 2, 752, 23);
	ligne_arbo($pdf, 'bpr', 3, 728, 51);
	ligne_arbo($pdf, 'bpb', 3, 704, 69);//5
	ligne_arbo($pdf, 's3', 1, 680, 3);
	ligne_arbo($pdf, 's5', 2, 656, 1);
	ligne_arbo($pdf, 's5', 3, 632, 2);
	ligne_arbo($pdf, 's5', 4, 608, 3);
	ligne_arbo($pdf, 's5', 4, 584, 4);//10
	ligne_arbo($pdf, 's5', 4, 560, 5);
	ligne_arbo($pdf, 'blr', 1, 536, 100);
	ligne_arbo($pdf, 'blb', 2, 512, 85);
	ligne_arbo($pdf, 'blr', 2, 488, 23);
	ligne_arbo($pdf, 'bpr', 3, 464, 51);//15
	ligne_arbo($pdf, 'bpb', 3, 440, 69);
	ligne_arbo($pdf, 's3', 1, 416, 3);
	ligne_arbo($pdf, 's5', 2, 392, 1);
	ligne_arbo($pdf, 's5', 3, 368, 2);
	ligne_arbo($pdf, 's5', 4, 344, 3);//20
	ligne_arbo($pdf, 's5', 4, 320, 4);
	ligne_arbo($pdf, 's5', 4, 296, 5);
	ligne_arbo($pdf, 's3', 1, 272, 3);
	ligne_arbo($pdf, 's5', 2, 248, 1);
	ligne_arbo($pdf, 's5', 3, 224, 2);//25
	ligne_arbo($pdf, 's5', 4, 200, 3);
	ligne_arbo($pdf, 's5', 4, 176, 4);
	ligne_arbo($pdf, 's5', 4, 152, 5);
	ligne_arbo($pdf, 's5', 4, 128, 3);
	ligne_arbo($pdf, 's5', 4, 104, 4);//30
	ligne_arbo($pdf, 's5', 4, 80, 5);*/
}

function generatePDF($destination, $filename) {
	$pdf =& new Cezpdf();
	pageDeCouverture($pdf, '132');

	$pdf->selectFont(_MAINFONT_);
	//$pdf->ezSetMargins(30,30,30,30);

	$pdf->ezNewPage();
	$pdf->ezStartPageNumbers(560,27,8,'','Page {PAGENUM} sur {TOTALPAGENUM}',2);
	miseEnPage($pdf, 'Livret Electronique d\'Apprentissage', 'Armand LEMARCHAND');

	$pdf->ezStream();
	/*$data = $pdf->ezOutput(1);
	$file = fopen ($destination.$filename, 'w');
	if (!$file) {
	    echo '<p>Impossible d\'ouvrir le fichier distant pour ï¿½criture.\n';
	    exit;
	}
	fputs ($file, $data);
	fclose ($file);*/
}

?>