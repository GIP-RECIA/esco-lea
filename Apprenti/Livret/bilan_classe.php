<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 18/06/06

//Edit progressbar($val) by Frederic GOYER 18/05/07
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_arbre.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_param_criteres.php");
/**********************************************************/
$enseignant = new Enseignant($_SESSION['id_ens']); // l'enseignant connectï¿½.

$formation = new Formation($_SESSION['id_for']); // la formation de l'enseignant connectï¿½.

$les_classes =  $formation->get_classes();

$config_lea = $formation->get_config_lea();

if (isset($_REQUEST['id_cla'])) $id_cla_select = $_REQUEST['id_cla'];
elseif(count($les_classes) > 0 ) $id_cla_select = $les_classes[0]->id_cla;
else { echo"Aucune classe n'est disponible"; exit(); }

$classe_select = new Classe($id_cla_select);
$classe_select->set_detail();

if($id_cla_select!=-1 && $classe_select->id_for != $formation->id_for) {include($LEA_REP.'erreur.php'); exit();}

$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['action'])) $action = $_REQUEST['action'];
else $action = 'A0';

if(isset($_REQUEST['id_noeud_select'])) $id_noeud_select = $_REQUEST['id_noeud_select'];
else $id_noeud_select = 0;


if(isset($_REQUEST['type_suivi']))
$type_suivi_select = $_REQUEST['type_suivi'];
else $type_suivi_select = 'cfa';


$les_arbres =  $config_lea->get_arbres($type_suivi_select);
if( count($les_arbres ) > 0 ) {

	if( ( $action=='A0' || $action=='A1' ) ) $id_arbre_select = $les_arbres[0]->id_arbre;
	elseif(isset($_REQUEST['id_arbre']))
	$id_arbre_select = $_REQUEST['id_arbre'];
	else  $id_arbre_select = 0;

	$arbre_select = new Arbre( $id_arbre_select);
	$arbre_select->set_detail();

	$les_modalites = array_merge(
	$arbre_select->get_modalites('app'),
	$arbre_select->get_modalites('tuteur_cfa'),
	$arbre_select->get_modalites('ma'),
	$arbre_select->get_modalites('ens'),
	$arbre_select->get_modalites('rl'),
	$arbre_select->get_modalites('rf')
	);

	if( ($action=='A0' || $action=='A1' || $action=='A2')  && count($les_modalites) > 0){// && $_REQUEST['id_modalite_classe'] != -1) {
		$modalite_select = $les_modalites[0];

		$id_modalite_classe_select =  $modalite_select->id_modalite .":".strtolower(get_class($modalite_select));

		//si c'est une modalité multiple(donc avec critères)
		//et si 'id_choix' est en paramêtre
		if(strtolower(get_class($modalite_select)) == 'modalite_va_multiple' && isset($_REQUEST['id_choix'])){
			$param_crit = new Param_criteres($modalite_select->id_modalite, $_REQUEST['id_choix']);
		} else{
			$param_crit = new Param_criteres($modalite_select->id_modalite);
		}
		$param_crit->set_detail();

	} elseif(isset($_REQUEST['id_modalite_classe'])  && count($les_modalites) > 0 && $_REQUEST['id_modalite_classe'] != -1) {
		$id_modalite_classe_select = $_REQUEST['id_modalite_classe'];

		list ($id_modalite, $classe_modalite)  = explode(":", $_REQUEST['id_modalite_classe']);

		if ($classe_modalite == 'modalite_va_unique') 		$modalite_select = new Modalite_va_unique($id_modalite);
		elseif ($classe_modalite == 'modalite_va_multiple') $modalite_select = new Modalite_va_multiple($id_modalite);

		$modalite_select->set_detail();

		//si c'est une modalitÃ© multiple(donc avec critÃ¨res)
		//et si 'id_choix' est en paramÃ¨tre
		if($classe_modalite == 'modalite_va_multiple' && isset($_REQUEST['id_choix'])){
			$param_crit = new Param_criteres($modalite_select->id_modalite, $_REQUEST['id_choix']);
		} else{
			$param_crit = new Param_criteres($modalite_select->id_modalite);
		}
		$param_crit->set_detail();
	}
} else{
	$id_arbre_select = 0;
	$arbre_select = new Arbre( $id_arbre_select);
}
// les fonctions
/***
 *
 */
function afficher_liste_arbres($les_arbres, $id_arbre_select) {

	echo '
<select name="id_arbre" onChange="this.form.elements[\'action\'].value=\'A2\'; this.form.submit();">';	
	foreach($les_arbres as $arbre){
		if($arbre->id_arbre == $id_arbre_select ) $selected = 'selected';
		else $selected = '';
		echo'
	<option value="'.$arbre->id_arbre.'" '.$selected.' >'. $arbre->nom . '</option>';	
	}
	echo '
</select>';
}
/***
 *
 */
function afficher_liste_modalites($les_modalites, $id_modalite_classe_select) {
	global $id_noeud_select;
	global $param_crit;
	echo '
<select name="id_modalite_classe" onChange="this.form.elements[\'action\'].value=\'A3\'; 
		  document.theForm.elements[\'id_noeud_select\'].value=\''.$id_noeud_select.'\';
		  this.form.submit();">';
	echo'
	<option value="-1" >Choix de la modalit&eacute;</option>';
	foreach( $les_modalites  as $modalite ){
		$value = $modalite->id_modalite .":".strtolower(get_class($modalite));
		if($id_modalite_classe_select == $value) {
			$selected = 'selected';
		} else{
			$selected = '';
		}

		if(strtolower(get_class($modalite))=='modalite_va_unique' && $modalite->type_reponse=='texte') continue; //ignorer les modalitï¿½ ï¿½ rï¿½ponse texte 
		if((isset($param_crit)) && ($param_crit->getModeAffichage($modalite->id_modalite) == "choix" || $param_crit->getModeAffichage($modalite->id_modalite) == "tout"
		|| $param_crit->getModeAffichage($modalite->id_modalite) == "graphique" || $param_crit->getModeAffichage($modalite->id_modalite) == "textuel")){
			echo'
	<option value="'.$value.'" '.$selected.'>'. $modalite->libelle .'</option>';
		}
	}
	echo '
</select>';
}
/***
 *
 */
function afficher_liste_choix($les_choix, $id_choix_select) {
	global $id_noeud_select;
	global $param_crit;

	echo '
<select name="id_choix" onChange="this.form.elements[\'action\'].value=\'A4\'; 
		document.theForm.elements[\'id_noeud_select\'].value=\''.$id_noeud_select.'\';
		this.form.submit();">';
	echo'
	<option value="-1" >Choix du crit&egrave;re</option>';
	if(isset($_REQUEST['id_modalite_classe']) && $_REQUEST['id_modalite_classe'] != -1){
		//Boucle de remplissage de la liste dÃ©roulante
		foreach( $les_choix  as $choix ){
			if($id_choix_select == $choix->id_choix) $selected = 'selected';
			else $selected = '';

			//Recup de mode affichage
			list ($lamodalite, $classe_modalite)  = explode(":", $_REQUEST['id_modalite_classe']);
			if($param_crit->getModeAffichage($lamodalite, $choix->id_choix) == "tout" || $param_crit->getModeAffichage($lamodalite, $choix->id_choix) == "graphique" || $param_crit->getModeAffichage($lamodalite, $choix->id_choix) == "textuel"){
				echo'
	<option value="'. $choix->id_choix .'" '.$selected.'>'. $choix->libelle .'</option>';
			}
		}
	}
	echo '
</select>';
}
/***
 * Cette fonction renvoit l'evaluation du noeud racine de l'arbre representÃ© 
 * dans le tableau des noeuds ($les_eva_noeuds )
 * par consequence on met Ã  jour les evaluations de tout les noeuds descendants  de noeud racine .
 */
function eval_noeud(&$les_eva_noeuds , $id_noeud_racine) {

	global $URL_THEME;

	$src_img_arbre  = $URL_THEME."images/picto_arbre.png";
	$sum = 0;
	$nb  = 0;

	for ($x=0; $x < count($les_eva_noeuds); $x++ ) {
		if($les_eva_noeuds[$x]->id_noeud ==  $id_noeud_racine && $les_eva_noeuds[$x]->type =='feuille' )
		return $les_eva_noeuds[$x]->progression;
		if ($les_eva_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
			$nb += 1;
			if( $les_eva_noeuds[$x]->type == "feuille") {
				$sum += $les_eva_noeuds[$x]->progression;
			} else {
				$eva = eval_noeud($les_eva_noeuds, $les_eva_noeuds[$x]->id_noeud);
				$les_eva_noeuds[$x]->progression =  round($eva, 2);
				$sum += $eva;
			}
		}
	}
	if( $nb > 0 ) return ($sum/$nb);
	else return 0;
}
/***
 * cette fonction affiche les noeuds de l'arbre
 */
function afficher_arbre($id_noeud_racine, $id_noeud_select, $id_ul = NULL) {
	global $URL_THEME;
	global $arbre_select ;

	//ballayage du l'arbre
	echo "
<ul id='".$id_ul."'>";
	for ($x=0; $x < count($arbre_select->tab_noeuds); $x++ ) {
		if ($arbre_select->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
			$id = $arbre_select->tab_noeuds[$x]->id_noeud;

			$id_li = randomkeys(20);
			//
			if($arbre_select->tab_noeuds[$x]->type == "branche"){
				echo "<li class='branche'>";
			}elseif($arbre_select->tab_noeuds[$x]->type == "feuille"){
				echo "<li class='feuille'>";
			}
			//
			if( $id == $id_noeud_select ) {
				if($arbre_select->tab_noeuds[$x]->type != "feuille"){
					echo '<a class ="lienbranche" onclick="afficherMasquer(\''.$id_li.'\')">&nbsp;</a>';
				} else{
					echo'<a class ="lienfeuille">&nbsp;</a>';
				}
				echo '<br/><span class="likeA">'.$arbre_select->tab_noeuds[$x]->libelle.'</span>';
			} else {
				if($arbre_select->tab_noeuds[$x]->type != "feuille"){
					echo '<a class ="lienbranche" onclick="afficherMasquer(\''.$id_li.'\')">&nbsp;</a>';
				} else{
					echo'<a class ="lienfeuille">&nbsp;</a>';
				}

				echo '<a href="#" onClick ="document.theForm.elements[\'id_noeud_select\'].value=\''.$id.'\'; document.theForm.elements[\'action\'].value=\'A4\'; document.theForm.submit();">
				'.$arbre_select->tab_noeuds[$x]->libelle.'</a>';
			}

			afficher_arbre($arbre_select->tab_noeuds[$x]->id_noeud,  $id_noeud_select, $id_li);
			echo "	</li>";
		}
	}
	echo "</ul>";
}
/***
 * Cette fonction affiche le tableau d'evaluation des apprentis de la classe $classe
 * parraport au noeud $id_noeud_select
 */
function progression_classe($classe, $id_noeud_select) {

	global $URL_THEME;
	global $modalite_select;
	global $arbre_select;
	//
	$formation = new Formation($_SESSION['id_for']); // la formation de l'enseignant connectï¿½.
	$config_lea = $formation->get_config_lea();
	//
	$les_id_apprentis = $classe->get_id_apprentis();

	if($id_noeud_select == 0 ) $titre_tab = $arbre_select->nom;
	else {
		$noeud_select = new Noeud($id_noeud_select);
		$noeud_select->set_detail();
		$titre_tab = $noeud_select->libelle;
	}

	$tab_eval_apprentis = array();

	foreach($les_id_apprentis as $id_app){
		$apprenti  = new Apprenti($id_app);
		$apprenti->set_detail();

		if(strtolower(get_class ($modalite_select)) == 'modalite_va_multiple') {
	 	$les_choix = $modalite_select->get_choix();

			if(count($les_choix) > 0) {

				if(isset($_REQUEST['id_choix'])) $id_choix_select = $_REQUEST['id_choix'];
				else $id_choix_select = $les_choix[0]->id_choix;
					
				$les_eva_noeuds = $apprenti->evaluation_arbre_va_multiple($arbre_select, $id_choix_select);

			}//else echo"Aucun choix";

		}else  $les_eva_noeuds = $apprenti->evaluation_arbre_modalite_va_unique($arbre_select, $modalite_select);
			
		$eva = round(eval_noeud($les_eva_noeuds ,$id_noeud_select),2);
			
		$tab_eval_apprentis[ $apprenti->nom .' &nbsp '. $apprenti->prenom] = $eva;

	}
	echo'
<table>
	<tr class="titre">
		<td colspan="2">'.$titre_tab.'</td>
	</tr>
	<tr>
		<th width="60%">'.$config_lea->appelation_app.'</th>
		<th>progression</th>	
	</tr>';		 	 

	foreach($tab_eval_apprentis as $nom_prenom => $eva){
		echo"
	<tr>";
		echo "
		<td height='30'>  $nom_prenom </td>
		<td> ";
		progressbar($eva);
		echo"
		</td>
	</tr>"; 
	}
	echo'
</table>';
}
/***
 * Cette fonction affiche la bare de progression qui correspond Ã  la valeur $val
 * $val <=0	 affiche 0%
 * 0 < $val < 100 affiche val%
 */
function progressbar($val){
	global $LEA_URL;
	global $param_crit;

	if( $val <= 0 ) $width = 0;
	elseif ($val <= 100) $width = round($val);
	else $width = 100;

	if($param_crit->mode_affichage != ""){
		if($param_crit->mode_affichage !="aucun"){
			//il faut tout afficher, ou juste l'aspect graphique
			if($param_crit->mode_affichage =="tout" || $param_crit->mode_affichage =="graphique"){
				//bps: Barre de Progression Simple
				if($param_crit->mode_graphique == "bps"){
					if($width<50){
						echo "
		<div class=\"fondbarre\">
			<div class=\"barrerouge\" style=\"width: ".$width."px;\">";
						//Verif si il faut afficher le texte ou non
						if($param_crit->mode_textuel == "calcule"){
							echo $width."%
			</div>
		</div>";
						} else{
							echo "
			</div>
		</div>";
						}
					} else{
						echo "
		<div class=\"fondbarre\">
			<div class=\"barrebleu\" style=\"width: ".$width."px;\">";
						//Verif si il faut afficher le texte ou non
						if($param_crit->mode_textuel == "calcule"){
							echo $width."%
			</div>
		</div>";
						} else{
							echo "
			</div>
		</div>";
						}
					}//fin if <50
				}//fin if bps
				//bpp: Barre de Progression Ã  Paliers
				if($param_crit->mode_graphique == "bpp"){
					if($width<50){
						echo "
		<div class=\"fondbarre\">
		  	<div class=\"barrepallierrouge\" style=\"width: ".$width."px;\">";

						//Verif si il faut afficher le texte ou non
						if($param_crit->mode_textuel == "calcule"){
							echo $width."%
			</div>
		</div>";
						} else{
							echo "
			</div>
		</div>";
						}
					} else{
						echo "
		<div class=\"fondbarre\">
			<div class=\"barrepallierbleu\" style=\"width: ".$width."px;\">";

						//Verif si il faut afficher le texte ou non
						if($param_crit->mode_textuel == "calcule"){
							echo $width."%
			</div>
		</div>";
						} else{
							echo "
			</div>
		</div>";
						}
					}//fin if <50
				}//fin bpp
				//smilies: Smiley
				if($param_crit->mode_graphique == "smilies"){
					$tabParamSmil = explode("|",$param_crit->param_graphique);
					switch(count($tabParamSmil)){
						case 2:
							if($width > $tabParamSmil[0]){
								if($width > $tabParamSmil[1]){
									echo "
		<div class='smiley_5'></div>";
								}else{
									echo "
		<div class='smiley_3'></div>";
								}
							}else{
								echo "
		<div class='smiley_1'></div>";
							}
							break;
						case 3:
							if($width > $tabParamSmil[0]){
								if($width > $tabParamSmil[1]){
									if($width > $tabParamSmil[2]){
										echo "
		<div class='smiley_5'></div>";
									}else{
										echo "
		<div class='smiley_4'></div>";
									}
								}else{
									echo "
		<div class='smiley_2'></div>";
								}
							}else{
								echo "
		<div class='smiley_1'></div>";
							}
							break;
						case 4:
							if($width > $tabParamSmil[0]){
								if($width > $tabParamSmil[1]){
									if($width > $tabParamSmil[2]){
										if($width > $tabParamSmil[3]){
											echo "
		<div class='smiley_5'></div>";
										}else{
											echo "
		<div class='smiley_4'></div>";
										}
									}else{
										echo "
		<div class='smiley_3'></div>";
									}
								}else{
									echo "
		<div class='smiley_2'></div>";
								}
							}else{
								echo "
		<div class='smiley_1'></div>";
							}
							break;
					}

				}//fin smilies
			}
			//il faut afficher le pourcentage
			if($param_crit->mode_affichage =="textuel"){
				echo $width."%";
			}
		}//fin if != aucun
	} else{
		//Affichage par dÃ©faut, si le paramÃ©trage n'est pas fai
		//- Barre de Progression Simple
		//- Pourcentages
		/*if($width<50){
			echo "<div class=\"fondbarre\">
			<div class=\"barrerouge\" style=\"width: ".$width."px;\">";
			echo $width."%</div></div>";
			} else{
			echo "<div class=\"fondbarre\">
			<div class=\"barrebleu\" style=\"width: ".$width."px;\">";
			echo $width."%</div></div>";
			}*/
		echo "pas de param&eacute;trage";
	}
}
?>
<script language="JavaScript"
	type="text/javascript" src="../../javascript/stdlib.js"></script>
<div id="top_l"></div>
<div id="top_m"><?php	
if ($arbre_select->type == "entr") {
	echo'<h1><img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
} elseif($arbre_select->type == "cfa") {
	echo'<h1><img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
}
if($id_arbre_select != 0){
	echo "<span class=\"orange\">B</span>ilan : ".$arbre_select->nom."</h1>";
}else{
	?>
<h1><span class="orange">S</span>uivi par <?php echo "$config_lea->appelation_classe" ?></h1>
	<?php
}
?></div>
<div id="top_r"></div>
<div id="m_contenu">
<form name="theForm" action="" method="post"><input type="hidden"
	name="action" value="A0"> <input type="hidden" name="id_noeud_select"
	value="0">
<table border="0">
	<tr>
		<td width="16%">Choix de <?php echo($config_lea->appelation_classe); ?>
		</td>
		<td width="84%"><select name="id_cla" size="1"
			onChange="this.form.elements['action'].value= 'A'; this.form.submit();">
			<?php
			foreach($les_classes as $classe){

				if($classe->id_cla == $id_cla_select) $selected = "selected";
				else $selected = "";

				echo"<option value='$classe->id_cla' $selected > $classe->libelle </option>";
			}
			?>
		</select></td>
	</tr>
	<tr>
		<td width='20%'>Type de suivi</td>
		<td><select name="type_suivi"
			onChange="this.form.elements['action'].value= 'A0'; this.form.submit();">
			<option value="cfa"
			<?php if($type_suivi_select == 'cfa') echo'selected'; ?>><?php echo $config_lea->appelation_suivi_cfa; ?>
			</option>
			<option value="entr"
			<?php if($type_suivi_select == 'entr') echo'selected'; ?>><?php echo $config_lea->appelation_suivi_entr; ?>
			</option>
		</select></td>
		<?php
		if(count($les_arbres) > 0 )	{
			echo "
				<tr>
					<td>Choix de l'arbre </td>
					<td>";
			afficher_liste_arbres($les_arbres, $id_arbre_select);
			echo"
					</td>
				</tr>";				
			if(count($les_modalites) > 0 )	{
				echo "
				<tr>
					<td>Choix de la modalit&eacute; </td>
					<td>";
				if(isset($_REQUEST['id_modalite_classe'])){
					$id_modalite_classe_select = $_REQUEST['id_modalite_classe'];
				} else{
					$id_modalite_classe_select = -1;
				}
				afficher_liste_modalites($les_modalites, $id_modalite_classe_select);
				echo"
					</td>
				</tr>";
				if(isset($modalite_select) && strtolower(get_class ($modalite_select)) == 'modalite_va_multiple' && isset($_REQUEST['id_modalite_classe']) && $_REQUEST['id_modalite_classe'] != -1) {
					$les_choix = $modalite_select->get_choix();

					if(count($les_choix) > 0) {
						if(isset($_REQUEST['id_choix'])) $id_choix_select = $_REQUEST['id_choix'];
						else $id_choix_select = -1;

						echo "
				<tr>
					<td>Choix du crit&egrave;re </td>
					<td>";
						afficher_liste_choix($les_choix, $id_choix_select);
						echo"
					</td>
				</tr>";						 				 
						//$les_eva_noeuds = $apprenti->evaluation_arbre_va_multiple($arbre_select, $id_choix_select);
					}//else echo"Aucun choix";
				}else  ;//$les_eva_noeuds = $apprenti->evaluation_arbre_modalite_va_unique($arbre_select, $modalite_select);
			}//else  echo"Aucune modalitï¿½";
			?>

</table>
<p>NB: si vous n'avez aucune modalit&eacute; et/ou aucun crit&egrave;re,
c'est que leur affichage n'a pas &eacute;t&eacute;
param&eacute;tr&eacute;.</p>

			<?php // Affichage de deux arborescences
			if (!stristr($_SERVER['PHP_SELF'], 'multi'))
			{
				echo "
					<center><input type='button' value='Afficher deux arborescences'
					onClick=\"window.open('".$LEA_URL."Enseignant/Apprentis/multi_critere.php', '', 'left=0, top=0, scrollbars=no, resizable=yes, fullscreen=yes')\"></center>
					";
			}
			?>

<table width="100%">
	<tr>
		<th colspan="2"><?php echo" Bilan : ".$arbre_select->nom." ".$_SESSION['nom_formation'];?>
		</th>
	</tr>
	<tr>
		<td width="50%" valign="top">
		<div id="arbre"><?php
		if(count($les_modalites) > 0 )	{
			if($id_noeud_select == 0){
				echo'
<ul>
	<li class="arbre">
		<a class="lienarbre">&nbsp;</a>
		<span class="likeA"><b>'.$arbre_select->nom.'</b></span>
	</li>
</ul>';		
			} else{
				echo'
<ul>
	<li class="arbre">
		<a class="lienarbre">&nbsp;</a>
		<a href="#" onClick="document.theForm.elements[\'action\'].value=\'A4\'; document.theForm.submit()" > 
			'.$arbre_select->nom.'
		</a>
	</li>
</ul>';
			}
			afficher_arbre(0, $id_noeud_select);
		}else echo"Aucune modalit&eacute; n'est valid&eacute;e";
		?></div>
		</td>
		<td valign="top"><?php progression_classe($classe_select, $id_noeud_select); ?></td>
	</tr>
	<?php 	} else{
		echo"
<h2>Vous n'avez pas de suivi guid&eacute; pour ";
		if($type_suivi_select == 'cfa'){
			echo $config_lea->appelation_suivi_cfa;
		}elseif ($type_suivi_select == 'entr'){
			echo $config_lea->appelation_suivi_entr;
		}
		echo" </h2>
</div>";
	} ?>
</table>
</form>
</div>
