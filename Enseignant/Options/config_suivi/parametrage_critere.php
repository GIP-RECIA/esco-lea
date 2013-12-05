<?php
/***********************************************************/   
  // Auteur : FrÃ©dÃ©ric Goyer
  // Version : 1.0.2
  // Date: 05/07  
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php")) require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      	require_once("../config/config.inc.php");

include_once($LEA_REP."Enseignant/secure.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_param_criteres.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();
/***********************************************************/
/****  Fonction de vÃ©rif des $_SESSION
/***********************************************************/
function debug() {
	$arrayofvals = array("id_modalite_classe", "id_choix", "mode_affichage", "mode_textuel", "mode_graphique", "param_graphique");
	
	echo "<div style=\"border: 1px solid red; padding: 10px; margin: 10px; \">";
	foreach($arrayofvals as $arrayofval) {
		$val = (isset($_SESSION[$arrayofval])) ? $_SESSION[$arrayofval] : "<i>null</i>";
		echo "\$_SESSION[".$arrayofval."] : <strong>".$val."</strong><br />";
	}
	echo "</div>";
}
/***
 * 
 */
function clearsession() {
	$clearSessionArrayValue = array("id_modalite_classe", "id_choix", "mode_affichage", "mode_textuel", "mode_graphique", "param_graphique");
	foreach($clearSessionArrayValue as $ThisSessionValue) {
		unset($_SESSION[$ThisSessionValue]);
	}
}

$referer = (parse_url($_SERVER['HTTP_REFERER'])); 
if(!eregi("cmd=param_critere", $referer['query'])) {
	clearsession();
}

/***********************************************************/
/****  Smiley
/***********************************************************/
//Vidage des smiley
unset($_SESSION['bloc2']);
unset($_SESSION['bloc4']);
unset($_SESSION['bloc6']);
unset($_SESSION['bloc8']);
unset($_SESSION['nb_smiley']);
//Si validation du parametrage des smiley
if(isset($_POST['bloc2'])){
	$_SESSION['bloc2'] = $_POST['bloc2'];
	$_SESSION['param_graphique'] = $_SESSION['bloc2'];
	if(isset($_POST['bloc4'])){
		$_SESSION['bloc4'] = $_POST['bloc4'];
		$_SESSION['param_graphique'] = $_SESSION['bloc2']."|".$_SESSION['bloc4'];
		$_SESSION['nb_smiley'] = 3;
		if(isset($_POST['bloc6'])){
			$_SESSION['bloc6'] = $_POST['bloc6'];
			$_SESSION['param_graphique'] = $_SESSION['bloc2']."|".$_SESSION['bloc4']."|".$_SESSION['bloc6'];
			$_SESSION['nb_smiley'] = 4;
			if(isset($_POST['bloc8'])){
				$_SESSION['bloc8'] = $_POST['bloc8'];
				$_SESSION['param_graphique'] = $_SESSION['bloc2']."|".$_SESSION['bloc4']."|".$_SESSION['bloc6']."|".$_SESSION['bloc8'];
				$_SESSION['nb_smiley'] = 5;
			} else{
				unset($_SESSION['bloc8']);
			}
		} else{
			unset($_SESSION['bloc6']);
			unset($_SESSION['bloc8']);
		}
	} else{
		unset($_SESSION['bloc2']);
		unset($_SESSION['bloc4']);
		unset($_SESSION['bloc6']);
		unset($_SESSION['bloc8']);
		unset($_SESSION['nb_smiley']);
	}
} else{
	unset($_SESSION['bloc2']);
	unset($_SESSION['bloc4']);
	unset($_SESSION['bloc6']);
	unset($_SESSION['bloc8']);
	unset($_SESSION['nb_smiley']);		
}
/***********************************************************/
/*** Ensemble de test de controle
/***********************************************************/
//Si la modalite est choisie
if(isset($_POST["id_modalite_classe"])) {
	
	$clearSessionArrayValue = array("id_modalite_classe", "id_choix", "mode_affichage", "mode_textuel", "mode_graphique", "param_graphique");
	foreach($clearSessionArrayValue as $ThisSessionValue) {
		unset($_SESSION[$ThisSessionValue]);
	}	
	$_SESSION["id_modalite_classe"] = urldecode($_POST["id_modalite_classe"]);
}//Si le critere est choisi  
elseif (isset($_POST["id_choix"]) && isset($_SESSION["id_modalite_classe"])){
	
	$clearSessionArrayValue = array("id_choix", "mode_affichage", "mode_textuel", "mode_graphique", "param_graphique");
	foreach($clearSessionArrayValue as $ThisSessionValue) {
		unset($_SESSION[$ThisSessionValue]);
	}	
	$_SESSION["id_choix"] = urldecode($_POST["id_choix"]);
}//Si le choix d'affichage est fait
elseif (isset($_POST["mode_affichage"]) && isset($_SESSION["id_modalite_classe"])){
	
	$clearSessionArrayValue = array("mode_affichage", "mode_graphique", "param_graphique", "mode_textuel");
	foreach($clearSessionArrayValue as $ThisSessionValue) {
		unset($_SESSION[$ThisSessionValue]);
	}	
	$_SESSION["mode_affichage"] = urldecode($_POST["mode_affichage"]);
	
	switch ($_SESSION["mode_affichage"]){
		case "tout":
			$_SESSION["mode_textuel"] = "calcule";
			break;
		case "graphique":
			$_SESSION["mode_textuel"] = NULL;
			break;
		case "textuel":
			$_SESSION["mode_textuel"] = "calcule";
			break;
		case "aucun":
			$_SESSION["mode_textuel"] = NULL;
			break;
	}
}//Si le choix d'aspect graphique est choisi et si mode_affichage est "tout" ou "graphique"
elseif (isset($_POST["mode_graphique"]) && ($_SESSION["mode_affichage"] == "tout" || $_SESSION["mode_affichage"] == "graphique") && isset($_SESSION["id_modalite_classe"]) && isset($_SESSION["mode_affichage"])){
	
	$clearSessionArrayValue = array("mode_graphique", "param_graphique");
	foreach($clearSessionArrayValue as $ThisSessionValue) {
		unset($_SESSION[$ThisSessionValue]);
	}	
	$_SESSION["mode_graphique"] = urldecode($_POST["mode_graphique"]);
}//Si un parametrage est necessaire
elseif (isset($_POST["param_graphique"]) && isset($_SESSION["mode_graphique"]) && $_SESSION["mode_graphique"] == "smilies" && isset($_SESSION["id_modalite_classe"]) && isset($_SESSION["id_choix"]) && isset($_SESSION["mode_affichage"])){
	
	$clearSessionArrayValue = array("param_graphique");
	foreach($clearSessionArrayValue as $ThisSessionValue) {
		unset($_SESSION[$ThisSessionValue]);
	}	
	$_SESSION["param_graphique"] = urldecode($_POST["param_graphique"]);
}
/***********************************************************/
/****  Creation de l'arbre
/***********************************************************/
if(isset($_GET['id_arbre'])) $id_arbre = $_GET['id_arbre'];
$arbre = new Arbre($id_arbre); 
$arbre->set_detail();
/***********************************************************/
/****  Recuperation des donnees des GET
/***********************************************************/
$cmd_cmd = $_GET['cmd'];
$cmd_id_arbre = $_GET['id_arbre'];
$cmd_type_suivi= $_GET['type_suivi'];
$cmd_suivi = $_GET['suivi'];
$cmd_selmenu= $_GET['selmenu'];
/***********************************************************/
/****  Creation de la modalite choisie
/***********************************************************/
if (isset($_SESSION['id_modalite_classe']) && $_SESSION['id_modalite_classe'] != -1) {
	
	list ($id_modalite, $classe_modalite) = explode(":", $_SESSION['id_modalite_classe']);
	
	if ($classe_modalite == 'modalite_va_unique') $modalite_sel = new Modalite_va_unique($id_modalite);							
	elseif ($classe_modalite == 'modalite_va_multiple') $modalite_sel = new Modalite_va_multiple($id_modalite);
	else echo "y'a un probleme";
	
	$modalite_sel->set_detail();
}
$les_modalites = array_merge(
	$arbre->get_modalites('app'),
	$arbre->get_modalites('tuteur_cfa'),
	$arbre->get_modalites('ma'),
	$arbre->get_modalites('ens'),
	$arbre->get_modalites('rl'),
	$arbre->get_modalites('rf')	);
/***********************************************************/
/****  Affichage du menu Arbre
/***********************************************************/
include("menu_maj_arbre.php");
afficher_menu_maj_arbre('param_critere');
/***********************************************************/
?>
<script type="text/javascript" src="../../../javascript/stdlib.js"></script>
<div id="top_l"></div>
<div id="top_m">
  	<h1>
  	<?php
		if ($arbre->type == "entr") {
			echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';			
		}elseif($arbre->type == "cfa") {
			echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
		}
		echo "<span class='orange'>P</span>aram&eacute;trer l'affichage des crit&egrave;res de ".$arbre->nom;
	?>
	</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<div style='width:400px;margin-left:50px;'>
<?php if(count($les_modalites)>0){ ?>
	<form id="formModalite" 
		action="options.php?cmd=<?php echo $cmd_cmd;?>&id_arbre=<?php echo $cmd_id_arbre;?>&type_suivi=<?php echo $cmd_type_suivi;?>&suivi=<?php echo $cmd_suivi;?>&selmenu=<?php echo $cmd_selmenu;?>" 
		method="POST">
		<table>
			<tr>
				<th>I/ Modalit&eacute;</th>
			</tr>
			<tr>
				<td>Choisir une modalit&eacute; :
				<?php
					echo "<select name='id_modalite_classe' onChange='this.form.submit();'>";
					echo "<option value='-1' selected >-- S&eacute;lectionnez une modalite--</option>";
					foreach( $les_modalites  as $modalite ){
						$value = $modalite->id_modalite .":".strtolower(get_class($modalite));
						if(isset($_SESSION['id_modalite_classe']) && $_SESSION['id_modalite_classe'] == $value) {
							$selected = 'selected';
						} else{
							$selected = '';
						}
						
						if(strtolower(get_class($modalite))=='modalite_va_unique' && $modalite->type_reponse=='texte'){ 
							continue; //ignorer les modalites a reponse texte 
						}
						
						echo'<option value="'.$value.'" '.$selected.'>'.$modalite->libelle.'</option>';
					}
					echo '</select>'; 
				?>
				</td>
			</tr>
		</table>
	</form>
<?php
//Si une modalite est choisie
if(isset($_SESSION['id_modalite_classe']) && $_SESSION['id_modalite_classe'] != -1){?>
<form id="formCritere" 
		action="options.php?cmd=<?php echo $cmd_cmd;?>&id_arbre=<?php echo $cmd_id_arbre;?>&type_suivi=<?php echo $cmd_type_suivi;?>&suivi=<?php echo $cmd_suivi;?>&selmenu=<?php echo $cmd_selmenu;?>" 
		method="POST">
	<table>
		<tr>
			<th>II/ Crit&egrave;re</th>
		</tr>
		<tr>
			<td>
			 <?php
			 	if($classe_modalite == 'modalite_va_multiple'){
					echo "Choisir un crit&egrave;re :";
					$les_choix = $modalite_sel->get_choix();
					echo '<select name="id_choix" onChange="this.form.submit();">';
					echo "<option value='-1' selected >-- S&eacute;lectionnez un critere--</option>";
					foreach( $les_choix  as $choix ){
						if($_SESSION['id_choix'] == $choix->id_choix){
							$selected = 'selected';
						} else {
							$selected = '';
						}						
						echo'<option value="'. $choix->id_choix .'" '.$selected.'>'. $choix->libelle .'</option>';
					}
					echo '</select>';
				} else{
					echo "Modalit&eacute; de type \"fr&eacute;quence\" ou \"ratio\", donc sans crit&egrave;re ";
				}
				if(isset($_SESSION['id_choix'])){
					$param_crit = new Param_criteres($modalite_sel->id_modalite, $_SESSION['id_choix']);
				} else{
					$param_crit = new Param_criteres($modalite_sel->id_modalite);
				}
					$param_crit->set_detail();					 				
			?>
			</td>
		</tr>
	</table>
</form>
<?php }
//Si le critere de/ou la modalite est deja parametre
if(isset($param_crit->mode_affichage)){
	//ID CHOIX
	if(isset($_SESSION['id_choix']) && ($_SESSION['id_choix'] != $param_crit->id_choix)){
		$param_crit->id_choix = $_SESSION['id_choix'];
	}else{
		$_SESSION['id_choix'] = $param_crit->id_choix;
	}
	//MODE AFFICHAGE
	if(isset($_SESSION['mode_affichage']) && ($_SESSION['mode_affichage'] != $param_crit->mode_affichage)){
		$param_crit->mode_affichage = $_SESSION['mode_affichage'];
	}else{
		$_SESSION['mode_affichage'] = $param_crit->mode_affichage;
	}
	//MODE GRAPHIQUE
	if(isset($_SESSION['mode_graphique']) && ($_SESSION['mode_graphique'] != $param_crit->mode_graphique)){
		$param_crit->mode_graphique = $_SESSION['mode_graphique'];
	}else{
		$_SESSION['mode_graphique'] = $param_crit->mode_graphique;
	}
	//MODE TEXTUEL
	if(isset($_SESSION['mode_textuel']) && ($_SESSION['mode_textuel'] != $param_crit->mode_textuel)){
		$param_crit->mode_textuel = $_SESSION['mode_textuel'];
	}else{
		$_SESSION['mode_textuel'] = $param_crit->mode_textuel;
	}
	//PARAM GRAPHIQUE
	if(isset($_SESSION['param_graphique']) && ($_SESSION['param_graphique'] != $param_crit->param_graphique)){
		$param_crit->param_graphique = $_SESSION['param_graphique'];
	}else{
		$_SESSION['param_graphique'] = $param_crit->param_graphique;
	}
	if($_SESSION['param_graphique'] != NULL){	
		$tab = explode("|",$param_crit->param_graphique);	
		if(count($tab)>=2){
			$_SESSION['bloc2'] = $tab[0];
		}
		if(count($tab)>=2){
			$_SESSION['bloc4'] = $tab[1];
		}
		if(count($tab)>=3){
			$_SESSION['bloc6'] = $tab[2];
		}
		if(count($tab)>=4){
			$_SESSION['bloc8'] = $tab[3];
		}
		$_SESSION['nb_smiley'] = count($tab)+1;	
	}
}	
//Si un critere est choisi
if((isset($_SESSION['id_choix']) && $_SESSION['id_choix'] != -1) || isset($param_crit)){?>
<form id="formAffichage" 
		action="options.php?cmd=<?php echo $cmd_cmd;?>&id_arbre=<?php echo $cmd_id_arbre;?>&type_suivi=<?php echo $cmd_type_suivi;?>&suivi=<?php echo $cmd_suivi;?>&selmenu=<?php echo $cmd_selmenu;?>"
		method="POST">
	<table>
		<tr>
			<th>III/ Choix d'affichage</th>
		</tr>
		<tr>
		<?php
			if(isset($_SESSION['mode_affichage'])){
				$param_crit->mode_affichage = $_SESSION['mode_affichage'];
				switch($_SESSION['mode_affichage']){
					case 'tout': 
						$param_crit->afficher_graphique = true;
						$param_crit->afficher_textuel = true;
						break;
					case 'textuel':
						$param_crit->afficher_graphique = false;
						$param_crit->afficher_textuel = true;
						break;
					case 'graphique':
						$param_crit->afficher_graphique = true;
						$param_crit->afficher_textuel = false;
						break;
					case 'aucun':
						$param_crit->afficher_graphique = false;
						$param_crit->afficher_textuel = false;
						break;		
					default: 
						$param_crit->afficher_graphique = NULL;
						$param_crit->afficher_textuel = NULL;
						break;
				}//fin switch
			}///fin if
			$param_crit->afficher_radio_mode_affichage();
		?>
		</tr>
	</table>
</form>
<?php }
//Si un critere est choisi
if(isset($_SESSION['mode_affichage']) && ($_SESSION['mode_affichage'] == "tout" || $_SESSION['mode_affichage'] == "graphique")){?>
<form id="formGraphique" 
		action="options.php?cmd=<?php echo $cmd_cmd;?>&id_arbre=<?php echo $cmd_id_arbre;?>&type_suivi=<?php echo $cmd_type_suivi;?>&suivi=<?php echo $cmd_suivi;?>&selmenu=<?php echo $cmd_selmenu;?>" 
		method="POST">
	<table>
		<?php 
			echo "<th>IV/ Choix de l'affichage graphique</th>";
			if(isset($_SESSION['mode_graphique'])){
				$param_crit->mode_graphique = $_SESSION['mode_graphique'];
			}
			$param_crit->afficher_radio_mode_graphique();
		?>
	</table>
</form>	
<?php } 
if(isset($_SESSION['mode_graphique']) && $_SESSION['mode_graphique'] == "smilies"){?>
<form id="formSmiley" 
		action="options.php?cmd=<?php echo $cmd_cmd;?>&id_arbre=<?php echo $cmd_id_arbre;?>&type_suivi=<?php echo $cmd_type_suivi;?>&suivi=<?php echo $cmd_suivi;?>&selmenu=<?php echo $cmd_selmenu;?>" 
		method="POST">
	<?php include("smileys.php");?>
	<td>
		<input type="submit" value="Valider le param&eacute;trage des smiley" />
	</td>	
</form>
<?php } 
if(isset($_SESSION['mode_graphique']) || isset($_SESSION['param_graphique']) || (isset($_SESSION['mode_affichage']) &&$_SESSION['mode_affichage'] == "aucun" )){?>
<form id="formValid" 
		action="./config_suivi/parametrage_critere_v.php?cmd=<?php echo $cmd_cmd;?>&id_arbre=<?php echo $cmd_id_arbre;?>&type_suivi=<?php echo $cmd_type_suivi;?>&suivi=<?php echo $cmd_suivi;?>&selmenu=<?php echo $cmd_selmenu;?>" 
		method="POST">
	<table>
	<tr>
	<?php
		if($_SESSION['mode_affichage'] == "tout" || $_SESSION['mode_affichage'] == "graphique"){
			echo "<th>V/ Valider</th>";
		}
		if($_SESSION['mode_affichage'] == "aucun" || $_SESSION['mode_affichage'] == "textuel"){
			echo "<th>IV/ Valider</th>";
		}
	?>
	</tr>
	<tr>
		<td>
			<input type="hidden" value="OK" name="validerOK" />
			<input type="submit" value="Valider ce param&eacute;trage" />
		</td>
	</tr>
	</table>	
</form>
<?php } ?>
<?php //DERNIER BLOC PHP
	}else{ 
		echo "La partie <b>\"Validation\"</b> n'a pas &eacute;t&eacute; faite car aucune modalit&eacute; n'est cr&eacute;&eacute;e"; 
	}//debug();
?>
		<a name="baspageimp">&nbsp;</a>
		<script language="javascript" type="text/javascript">
			var doc = document.location.href.split("#");
			window.location.replace(doc[0] + "#baspageimp");
		</script>
	</div>
</div>