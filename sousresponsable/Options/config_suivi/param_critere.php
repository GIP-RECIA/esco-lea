<?php
/***********************************************************/   
  // Auteur : FrÃ©dÃ©ric Goyer
  // Version : 1.0.2
  // Date: 04/07  
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php")) require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      	require_once("../config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

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
/****  Creation de l'arbre
/***********************************************************/
if(isset($_REQUEST['id_arbre'])) $id_arbre = $_REQUEST['id_arbre'];
$arbre = new Arbre($id_arbre); 
$arbre->set_detail();
/***********************************************************/
/****  Recuperation des donnees des GET
/***********************************************************/
$cmd = $_GET['cmd'];
$cmd_id_arbre = $_GET['id_arbre'];
$type_suivi= $_GET['type_suivi'];
$suivi = $_GET['suivi'];
$selmenu= $_GET['selmenu'];
if(isset($_GET['id_modalite_classe'])) $cmd_id_modalite_classe = $_GET['id_modalite_classe'];
if(isset($_GET['id_choix'])) $cmd_id_choix = $_GET['id_choix']; 
/***********************************************************/
/****  Creation de la modalite choisie
/***********************************************************/
$cgoodmodalite = false;
if (isset($cmd_id_modalite_classe) && $cmd_id_modalite_classe != -1) {
	
	list ($id_modalite, $classe_modalite) = explode(":", $_GET['id_modalite_classe']);
	
	if ($classe_modalite == 'modalite_va_unique') $modalite_sel = new Modalite_va_unique($id_modalite);							
	elseif ($classe_modalite == 'modalite_va_multiple') $modalite_sel = new Modalite_va_multiple($id_modalite);
	else echo "y'a un probleme";
	
	$modalite_sel->set_detail();
	$cgoodmodalite = true;
}
$les_modalites = array_merge(
	$arbre->get_modalites('app'),
	$arbre->get_modalites('tuteur_cfa'),
	$arbre->get_modalites('ma'),
	$arbre->get_modalites('ens'),
	$arbre->get_modalites('rl'),
	$arbre->get_modalites('rf')	);
/***********************************************************/
include("menu_maj_arbre.php");
afficher_menu_maj_arbre('param_critere');
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
		<form id="formModalite" action="options.php" method="GET">
		<input type='hidden' name='cmd' value='<?php echo $cmd; ?>'>
		<input type='hidden' name='id_arbre' value='<?php echo $cmd_id_arbre; ?>'>
		<input type='hidden' name='type_suivi' value='<?php echo $type_suivi; ?>'>
		<input type='hidden' name='suivi' value='<?php echo $suivi; ?>'>
		<input type='hidden' name='selmenu' value='<?php echo $selmenu; ?>'>
			<table >
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
							if($cmd_id_modalite_classe == $value) $selected = 'selected';
							else $selected = '';
							
							if(strtolower(get_class($modalite))=='modalite_va_unique' && $modalite->type_reponse=='texte') continue; //ignorer les modalitï¿½ ï¿½ rï¿½ponse texte 
							
							echo'<option value="'.$value.'" '.$selected.'>'. $modalite->libelle .'</option>';
						
						}
						echo '</select>'; 
					?>
					</td>
				</tr>
			</table>
		</form>
		<?php if($cgoodmodalite){ ?>
		<form id="formCritere" action="options.php" method="GET">
			<input type='hidden' name='cmd' value='<?php echo $cmd; ?>'>
			<input type='hidden' name='id_arbre' value='<?php echo $cmd_id_arbre; ?>'>
			<input type='hidden' name='type_suivi' value='<?php echo $type_suivi; ?>'>
			<input type='hidden' name='suivi' value='<?php echo $suivi; ?>'>
			<input type='hidden' name='selmenu' value='<?php echo $selmenu; ?>'>
			<input type='hidden' name='id_modalite_classe' value='<?php echo $cmd_id_modalite_classe; ?>'>
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
									if($cmd_id_choix == $choix->id_choix){
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
							if(isset($_GET['id_choix'])){
								$param_crit = new Param_criteres($modalite_sel->id_modalite, $_GET['id_choix']);
							} else{
								$param_crit = new Param_criteres($modalite_sel->id_modalite);
							}
								$param_crit->set_detail();	 				
						?>
					</td>
				</tr>
			</table>
		</form>
		<form id="formAffich" action="options.php" method="GET">
			<input type='hidden' name='cmd' value='<?php echo $cmd; ?>'>
			<input type='hidden' name='id_arbre' value='<?php echo $cmd_id_arbre; ?>'>
			<input type='hidden' name='type_suivi' value='<?php echo $type_suivi; ?>'>
			<input type='hidden' name='suivi' value='<?php echo $suivi; ?>'>
			<input type='hidden' name='selmenu' value='<?php echo $selmenu; ?>'>
			<input type='hidden' name='id_modalite_classe' value='<?php echo $cmd_id_modalite_classe; ?>'>
			<input type='hidden' name='id_choix' value='<?php echo $param_crit->id_choix; ?>'>
			<table>
			<?php if(isset($_GET['id_choix']) || isset($param_crit)){ ?>
				<th>III/ Choix d'affichage</th>
				<?php 
					if(isset($_GET['mode_affichage']) ){
						$param_crit->mode_affichage = $_GET['mode_affichage'];
						if($_GET['mode_affichage'] != "tout"){
							switch($_GET['mode_affichage']){
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
									break;
							}//fin switch
						}//fin if
					}///fin if
					$param_crit->afficher_radio_mode_affichage(); 
			}
				?> 
			</table>
		</form>
		<?php 
			if((isset($param_crit->afficher_graphique) && $param_crit->afficher_graphique) || 
			   (isset($_GET['mode_affichage']) && 
			   ($_GET['mode_affichage'] == "tout" || $_GET['mode_affichage'] == "graphique"))
			   ){
				if(isset($_GET['mode_graphique'])){
					$param_crit->mode_graphique = $_GET['mode_graphique'];
				}
		?>
		<form id="formGraph" action="options.php" method="GET">
			<input type='hidden' name='cmd' value='<?php echo $cmd; ?>'>
			<input type='hidden' name='id_arbre' value='<?php echo $cmd_id_arbre; ?>'>
			<input type='hidden' name='type_suivi' value='<?php echo $type_suivi; ?>'>
			<input type='hidden' name='suivi' value='<?php echo $suivi; ?>'>
			<input type='hidden' name='selmenu' value='<?php echo $selmenu; ?>'>
			<input type='hidden' name='id_modalite_classe' value='<?php echo $cmd_id_modalite_classe; ?>'>
			<input type='hidden' name='id_choix' value='<?php echo $param_crit->id_choix; ?>'>
			<table>
				<?php 
					echo "<th>IV/ Choix de l'affichage graphique</th>";
					
					if(isset($_GET['mode_affichage']))
						echo "<input type='hidden' name='mode_affichage' value='".$_GET['mode_affichage']."'>";
					elseif(isset($param_crit->mode_affichage))
						echo "<input type='hidden' name='mode_affichage' value='".$param_crit->mode_affichage."'>";
					
					if(isset($_GET['mode_textuel'])) 
						echo "<input type='hidden' name='mode_textuel' value='".$_GET['mode_textuel']."'>";
					elseif(isset($param_crit->afficher_textuel) && $param_crit->afficher_textuel)
						echo "<input type='hidden' name='mode_textuel' value='".$param_crit->mode_textuel."'>";
						
					$param_crit->afficher_radio_mode_graphique();	
				?>
			</table>
		</form>
		<?php 
			}
			
			if((isset($param_crit->afficher_textuel) && $param_crit->afficher_textuel) || 
			   (isset($_GET['mode_affichage']) && 
			   ($_GET['mode_affichage'] == "tout" || $_GET['mode_affichage'] == "textuel"))
			  ){	
				if(isset($_GET['mode_textuel'])){
					$param_crit->mode_textuel = $_GET['mode_textuel'];
				}
		?>
		<form id="formText" action="options.php" method="GET">
			<input type='hidden' name='cmd' value='<?php echo $cmd; ?>'>
			<input type='hidden' name='id_arbre' value='<?php echo $cmd_id_arbre; ?>'>
			<input type='hidden' name='type_suivi' value='<?php echo $type_suivi; ?>'>
			<input type='hidden' name='suivi' value='<?php echo $suivi; ?>'>
			<input type='hidden' name='selmenu' value='<?php echo $selmenu; ?>'>
			<input type='hidden' name='id_modalite_classe' value='<?php echo $cmd_id_modalite_classe; ?>'>
			<input type='hidden' name='id_choix' value='<?php echo $param_crit->id_choix; ?>'>
			<table>
				<?php 
					if(isset($_GET['mode_graphique']) || isset($param_crit->mode_graphique)){
						echo "<th>V/ Choix de l'affichage des chiffres</th>";
						if(isset($_GET['mode_graphique']))
							echo "<input type='hidden' name='mode_graphique' value='".$_GET['mode_graphique']."'>";
						elseif(isset($param_crit->mode_graphique))
							echo "<input type='hidden' name='mode_graphique' value='".$param_crit->mode_graphique."'>";
					}elseif(isset($_GET['mode_graphique']) && $_GET['mode_affichage'] == "tout"){
						echo "<th>V/ Choix de l'affichage des chiffres</th>";
					}else{
						echo "<th>IV/ Choix de l'affichage des chiffres</th>";
					}
					
					if(isset($_GET['mode_affichage']))
						echo "<input type='hidden' name='mode_affichage' value='".$_GET['mode_affichage']."'>";
					elseif(isset($param_crit->mode_affichage))
						echo "<input type='hidden' name='mode_affichage' value='".$param_crit->mode_affichage."'>";
					
					$param_crit->afficher_radio_mode_textuel(); 
				?>
			</table>
		</form>
		<?php } ?>
		<form id="formValid" action="./config_suivi/param_critere_v.php" method="GET">
			<input type='hidden' name='cmd' value='<?php echo $cmd; ?>'>
			<input type='hidden' name='id_arbre' value='<?php echo $cmd_id_arbre; ?>'>
			<input type='hidden' name='type_suivi' value='<?php echo $type_suivi; ?>'>
			<input type='hidden' name='suivi' value='<?php echo $suivi; ?>'>
			<input type='hidden' name='selmenu' value='<?php echo $selmenu; ?>'>
			<input type='hidden' name='id_modalite_classe' value='<?php echo $cmd_id_modalite_classe; ?>'>
			<input type='hidden' name='id_choix' value='<?php echo $param_crit->id_choix; ?>'>
			<input type='hidden' name='id_modalite' value='<?php echo $param_crit->id_modalite; ?>'>
			<table>
				<tr>
					<?php 
						if(isset($_GET['mode_affichage'])){
							echo "<input type='hidden' name='mode_affichage' value='".$_GET['mode_affichage']."'>";
							$modAff = $_GET['mode_affichage'];
							if($modAff == "tout" && (isset($_GET['mode_graphique']) && isset($_GET['mode_textuel']))){
								echo "<input type='hidden' name='mode_graphique' value='".$_GET['mode_graphique']."'>";
								echo "<input type='hidden' name='mode_textuel' value='".$_GET['mode_textuel']."'>";
								echo "<th>VI/ Valider:</th>";
							}elseif($modAff == "aucun" || $modAff == NULL){
								echo "<th>IV/ Valider:</th>";
							}else{
								if(isset($_GET['mode_graphique'])) echo "<input type='hidden' name='mode_graphique' value='".$_GET['mode_graphique']."'>";
								if(isset($_GET['mode_textuel'])) echo "<input type='hidden' name='mode_textuel' value='".$_GET['mode_textuel']."'>";
								echo "<th>V/ Valider:</th>";
							}
					?>
				</tr>
				<tr>
					<td>
					<input type="submit" value="Valider ce param&eacute;trage" />
					</td>
					<?php } ?>
				</tr>
			</table>
		</form>
		<?php } ?>
		<?php }else{ 
				echo "La partie <b>\"Validation\"</b> n'a pas &eacute;t&eacute; faite car aucune modalit&eacute; n'est cr&eacute;&eacute;e"; 
			}
		?>
	</div>
</div>
