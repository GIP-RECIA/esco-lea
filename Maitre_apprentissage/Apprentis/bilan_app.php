<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 03/04/06

//Edit progressbar($val) by Frederic GOYER 10/05/07
/***********************************************************/
include_once("../secure.php");
require_once("../../config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_param_criteres.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_arbre.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
/*****************************************/
/***
 * Récupération de id_app, et création de l'apprenti
 */
if(isset($_REQUEST['id_app_select'])) $id_app_select = $_REQUEST['id_app_select'];
else { html_refresh($LEA_URL);}

$apprenti = new Apprenti($id_app_select );
$apprenti->set_detail();
/***
 * Vérification si le maitre apprentissage et le responsable légal
 * sont les mêmes que ceux de l'apprenti
 */
if(isset($_SESSION['id_ma']) && $apprenti->id_ma != $_SESSION['id_ma'] ) exit();
elseif(isset($_SESSION['id_rl']) && $apprenti->id_rl != $_SESSION['id_rl'] ) exit();

$classe = new Classe ($apprenti->id_cla);
$les_id_apprentis = $classe->get_id_apprentis();  // les apprentis de la classe de l'apprenti sélectionné.

$config_lea = $apprenti->get_config_lea();

if(isset($_REQUEST['action'])) $action = $_REQUEST['action'];
else $action = 'A0';
/***
 * Récupération du type de suivi
 * pour récupérer les bons arbres
 */
if(isset($_REQUEST['type_suivi']))
$type_suivi_select = $_REQUEST['type_suivi'];
else $type_suivi_select = 'entr';

$les_arbres =  $config_lea->get_arbres($type_suivi_select);

if( count($les_arbres ) > 0 ) {
	// Vérif des 'actions'
	if(($action == 'A0' || $action == 'A1')){
		$id_arbre_select = $les_arbres[0]->id_arbre;
	} elseif(isset($_REQUEST['id_arbre'])){
		$id_arbre_select = $_REQUEST['id_arbre'];
	} else{
		$id_arbre_select = 0;
	}

	$arbre_select = new Arbre( $id_arbre_select);
	$arbre_select->set_detail();
	//Récupération des modalités
	$les_modalites = array_merge(
	$arbre_select->get_modalites('app'),
	$arbre_select->get_modalites('tuteur_cfa'),
	$arbre_select->get_modalites('ma'),
	$arbre_select->get_modalites('ens'),
	$arbre_select->get_modalites('rl'),
	$arbre_select->get_modalites('rf')
	);
	if( ($action=='A0' || $action=='A1' || $action=='A2')  && count($les_modalites) > 0 ) {
		$modalite_select = $les_modalites[0];
		$id_modalite_classe_select =  $modalite_select->id_modalite .":".strtolower(get_class($modalite_select));

		//si c'est une modalité multiple(donc avec critères)
		//et si 'id_choix' est en paramètre
		if(strtolower(get_class($modalite_select)) == 'modalite_va_multiple' && isset($_REQUEST['id_choix'])){
			$param_crit = new Param_criteres($modalite_select->id_modalite, $_REQUEST['id_choix']);
		} else{
			$param_crit = new Param_criteres($modalite_select->id_modalite);
		}
		$param_crit->set_detail();
	} elseif(isset($_REQUEST['id_modalite_classe'])  && count($les_modalites) > 0) {
		$id_modalite_classe_select = $_REQUEST['id_modalite_classe'];
			
		list ($id_modalite, $classe_modalite)  = explode(":", $_REQUEST['id_modalite_classe']);

		if ($classe_modalite == 'modalite_va_unique') 		$modalite_select = new Modalite_va_unique($id_modalite);
		elseif ($classe_modalite == 'modalite_va_multiple') $modalite_select = new Modalite_va_multiple($id_modalite);

		$modalite_select->set_detail();

		//si c'est une modalité multiple(donc avec critères)
		//et si 'id_choix' est en paramètre
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
/***********************
 * FONCTION
 ***********************/
/***
 * Cette fonction recursive qui calcule les evaluations
 * des noeuds branche de l'arbre représenté par le tableau 
 * les_eva_noeuds et elle renvoit l'evaluation du son neoud racine
 */
function eval_noeud($id_noeud_racine) {

	global $LEA_URL;
	global $les_eva_noeuds ;
		
	$src_img_arbre  = $LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_arbre.png";
	$sum = 0;
	$nb  = 0;

	for ($x=0; $x < count($les_eva_noeuds); $x++ ) {
		if ($les_eva_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
			$nb += 1;
			if( $les_eva_noeuds[$x]->type == "feuille") {
				$sum += $les_eva_noeuds[$x]->progression;
			} else {
				$eva = eval_noeud($les_eva_noeuds[$x]->id_noeud);
				$les_eva_noeuds[$x]->progression =  round($eva, 2);
				$sum += $eva;
			}
		}
	}

	if( $nb > 0 ) return ($sum/$nb);
	else return 0;
}
/***********************
 * FONCTIONS D AFFICHAGE
 ***********************/
/***
 * Cette fonction affiche la liste des arbres
 */
function afficher_liste_arbres($les_arbres, $id_arbre_select) {

	echo '<select name="id_arbre" onChange="this.form.elements[\'action\'].value=\'A2\'; this.form.submit();">';

	foreach($les_arbres as $arbre){
		if($arbre->id_arbre == $id_arbre_select ) $selected = 'selected';
		else $selected = '';
		echo'<option value="'.$arbre->id_arbre.'" '.$selected.' >'. $arbre->nom . '</option>';
	}
	echo '</select>';
}
/***
 * Cette fonction affiche la liste des modalités
 */
function afficher_liste_modalites($les_modalites, $id_modalite_classe_select) {

	echo '<select name="id_modalite_classe" onChange="this.form.elements[\'action\'].value=\'A3\'; this.form.submit();">';

	foreach( $les_modalites  as $modalite ){
		$value = $modalite->id_modalite .":".strtolower(get_class($modalite));
		if($id_modalite_classe_select == $value) $selected = 'selected';
		else $selected = '';

		if(strtolower(get_class($modalite))=='modalite_va_unique' && $modalite->type_reponse=='texte')
		continue; //ignorer les modalités Ã  réponse texte 

		echo'<option value="'.$value.'" '.$selected.'>'. $modalite->libelle .'</option>';
	}
	echo '</select>';
}
/***
 * Cette fonction affiche la liste des critères (choix)
 */
function afficher_liste_choix($les_choix, $id_choix_select) {

	echo '<select name="id_choix" onChange="this.form.elements[\'action\'].value=\'A4\'; this.form.submit();">';

	foreach( $les_choix  as $choix ){
		if($id_choix_select == $choix->id_choix) $selected = 'selected';
		else $selected = '';

		echo'<option value="'. $choix->id_choix .'" '.$selected.'>'. $choix->libelle .'</option>';
	}
	echo '</select>';
}
/***
 * Cette fonction affiche les noeuds de l'arbre
 */
function afficher_arbre($id_noeud_racine, $id_ul = NULL) {

	global $LEA_URL;
	global $les_eva_noeuds ;

	$src_img_arbre  = $LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_arbre.png";

	$cgood = false;
	for ($x=0; $x < count($les_eva_noeuds); $x++ ) {
		if ($les_eva_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
			$cgood = true;
		}
	}
	//ballayage de l'arbre
	if($cgood){
		echo"<br/><br/><ul>";
		for ($x=0; $x < count($les_eva_noeuds); $x++ ) {
			if ($les_eva_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
				$id_li = randomkeys(20);
				//
				if( $les_eva_noeuds[$x]->type == "feuille") {
					echo "<li class='feuille'>";progressbar($les_eva_noeuds[$x]->progression );			
					echo '<a class ="lienfeuille">&nbsp;</a>';
					echo $les_eva_noeuds[$x]->libelle;
				} else {
					echo "<li class='branche'>";progressbar($les_eva_noeuds[$x]->progression );
					echo '<a class ="lienbranche">&nbsp;</a>';
					echo"<b>".$les_eva_noeuds[$x]->libelle."</b>";
				}//fin if == feuille
					
				afficher_arbre($les_eva_noeuds[$x]->id_noeud,$id_li);
				echo "</li>";	 
			}//fin if == $id_noeud_racine
		}//fin for
		echo"</ul>";  
	}
}
/***
 * Cette fonction affiche la barre de progression qui correspond Ã  la valeur $val
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
					}
				}
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
					}
				}//fin if bpp
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
		}
	} else{
		//Affichage par défaut, si le paramétrage n'est pas fait
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
	}
}
?>
<link
	rel="stylesheet" type="text/css" media="screen"
	href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>" />
<link
	rel="stylesheet" type="text/css" media="screen"
	href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>" />
	
<div id="top_l"></div>
<div id="top_m"><?php	
if ($arbre_select->type == "entr") {
	echo"<h1><img src='".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_suivi_entreprise.png'>";
}
elseif($arbre_select->type == "cfa") {
	echo"<h1><img src='".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_suivi_cfa.png'>";
}
if($id_arbre_select != 0){
	echo" <span class=\"orange\">B</span>ilan : $arbre_select->nom </h1>";
}
?></div>
<div id="top_r"></div>
<div id="m_contenu">
<form name="theForm" action="" method="post"><input type="hidden"
	name="action" value="A0">
<table border="0">
	<tr>
		<td width="20%"><?php echo$config_lea->appelation_app; ?></td>
		<td><?php
		$array_value = array();
		foreach($les_id_apprentis as $id) {
			$app = new Apprenti($id);
			$app->set_detail();

			$array_value[$id] = "$app->nom &nbsp; $app->prenom";
		}
		$attr = 'onChange="this.form.elements[\'action\'].value= \'A1\'; this.form.submit();"';

		if(isset($_SESSION['id_ens'])) echo ( liste_deroulante ( 'id_app_select' , $array_value , $apprenti->id_app, $attr ) );
		else echo"$apprenti->nom &nbsp; $apprenti->prenom";
		?></td>
	</tr>
	<tr>
		<td>Type de suivi</td>
		<td><select name="type_suivi"
			onChange="this.form.elements['action'].value= 'A0'; this.form.submit();">
			<option value="cfa"
			<?php if($type_suivi_select == 'cfa') echo'selected'; ?>><?php echo $config_lea->appelation_suivi_cfa; ?>
			</option>
			<option value="entr"
			<?php if($type_suivi_select == 'entr') echo'selected'; ?>><?php echo $config_lea->appelation_suivi_entr; ?>
			</option>
		</select></td>
	</tr>
	<?php
	if(count($les_arbres) > 0 )	{
		echo "<tr><td>Choix de l'arbre </td><td>";
		afficher_liste_arbres($les_arbres, $id_arbre_select);
		echo"</td></tr>";
		if(count($les_modalites) > 0 )	{
			//$id_modalite_classe_select : l'identifiant de la modalitï¿½ sï¿½lectionnï¿½ ainsi son type
			echo "<tr><td>Choix de la modalit&eacute; </td><td>";
			afficher_liste_modalites($les_modalites, $id_modalite_classe_select);
			echo"</td></tr>";
			if(strtolower(get_class ($modalite_select)) == 'modalite_va_multiple') {
				$les_choix = $modalite_select->get_choix();
				if(count($les_choix) > 0) {
					if(isset($_REQUEST['id_choix'])) $id_choix_select = $_REQUEST['id_choix'];
					else $id_choix_select = $les_choix[0]->id_choix;

					echo "<tr><td>Choix du crit&egrave;re </td><td>";
					afficher_liste_choix($les_choix, $id_choix_select);
					echo"</td></tr>";

					$les_eva_noeuds = $apprenti->evaluation_arbre_va_multiple($arbre_select, $id_choix_select);
				}//else echo"Aucun choix";
					
			}else $les_eva_noeuds = $apprenti->evaluation_arbre_modalite_va_unique($arbre_select, $modalite_select);
		}//else  echo"Aucune modalité";

		?>
</table>
</form>
<table>
	<tr>
		<th><?php echo" Bilan : ".$arbre_select->nom; ?></th>
	</tr>
	<tr>
		<td width="100%" height="58">
		<div id="arbre"><?php
		if(count($les_modalites) > 0 )	{
			echo '
<ul>
	<li class="arbre">';progressbar(round(eval_noeud(0), 2));
			echo '<a class ="lienarbre">&nbsp;</a>';							
			echo'<b>'.$arbre_select->nom.'</b>';
			echo'
	</li>
</ul>';		
			afficher_arbre(0);
		}
		else echo"Aucun bilan n'est disponible";
		?></div>
		</td>
	</tr>
</table>
		<?php
	} else{
		echo"
<h1>Vous n'avez pas de suivi guid&eacute; pour ";
		if($type_suivi_select == 'cfa'){
			echo $config_lea->appelation_suivi_cfa;
		}elseif ($type_suivi_select == 'entr'){
			echo $config_lea->appelation_suivi_entr;
		}
		echo"
</h1>
</table>
</form>";
	}
	?></div>
