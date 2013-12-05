<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/03/06
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
include($LEA_REP."sousresponsable/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();


if(isset($_REQUEST['acteur'])) $acteur = $_REQUEST['acteur'];
else $acteur = "app";

$les_modalites_reponse_libre = $config_lea->get_modalites_reponse_libre(to_sql($type_suivi), $acteur);
$les_modalites_reponse_choix = $config_lea->get_modalites_reponse_choix(to_sql($type_suivi), $acteur);


// Cette fonction visualise la la prï¿½sentation de la  modalite  $modalite

function afficher_modalite($modalite){
		
	global $LEA_URL;
	global $URL_THEME;
			
	$src_img_modif = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_edit.png';
	$src_img_supp =  $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_drop.png';
			
	// la classe de cette modalite
	
	$classe = strtolower(get_class($modalite)); 
		
	switch($classe){
		case "modalite_reponse_libre" : 
			$output = "<textarea  cols='30' rows='5' disabled> </textarea>";
			
			$lien_modif =
				"<a href =\"#\" onClick=\"window.open('./config_suivi/modifier_modalite_reponse_libre.php?id_modalite=$modalite->id_modalite','','width=800, height=600, scrollbars=yes, resizable =yes')\" > 
				 	Modifier cette modalit&eacute;</a>";
			$lien_supp = 
				"<a href =\"./config_suivi/modifier_modalite_reponse_libre_v.php?action=supp&id_modalite=$modalite->id_modalite\" 
				  onClick=\"return deleteConfirm('cette modalite')\"
				 > Supprimer  cette modalit&eacute; </a> ";
				 
			$les_periodes = $modalite->get_periodes();
				 
			break;
												
		case "modalite_reponse_choix" :								

			$les_reponses = $modalite->get_reponses();
			if($modalite->type_choix == 'unique' ) $type = 'radio';
			else  $type = 'checkbox';

			$output = "";
			foreach($les_reponses as $reponse) 			
			$output.=" <input type='$type' name='reponse' disabled > $reponse->reponse <br>";
			
			$lien_modif =
				"<a href ='#' onClick=\"window.open('./config_suivi/modifier_modalite_reponse_choix.php?id_modalite=$modalite->id_modalite','','width=800, height=600, scrollbars=yes, resizable =yes' )\" > 
						Modifier cette modalit&eacute;
				</a>";
			$lien_supp = 
				"<a href ='./config_suivi/modifier_modalite_reponse_choix_v.php?action=supp&id_modalite=$modalite->id_modalite' 
				  onClick='return deleteConfirm(\"cette modalite\")'
				 > Supprimer cette modalit&eacute; </a> ";
			
			$les_periodes = $modalite->get_periodes();	 
			break;
									
		default :   return;
	}	
	
	if( count($les_periodes) > 0  ) {
		$str_periodes = "<ul>";
		
		foreach ($les_periodes as $periode){
			$str_periodes .= "<li>".to_html($periode->libelle)."</li>";
		}
		$str_periodes .= "</ul>";
	} else $str_periodes = to_html("Aucune p&eacute;riode ");
									 
 	echo"
		<table>
	 		<tr class='titre'>
			 	<td  colspan='2'>
					Modalit&eacute;: $modalite->libelle "; 	
	echo"		</td>
			</tr>
			<tr>
				<th width='70%'>S'affiche comme suit</th>
				<th width='30%'>Se d&eacute;clare aux p&eacute;iodes suivantes</th>													 		
			</tr>
			<tr>
				<td>$output	</td>
				<td>
					<div style='width: 300px; height: 150px;overflow: auto;'>$str_periodes</div> 
				</td>
			</tr>
			<tr>
				<th colspan='2'>
					<img src='$src_img_modif' border='0' title='modifier'> 
					$lien_modif	 &nbsp;&nbsp;&nbsp;
					<img src='$src_img_supp' border='0' title='supprimer'> 
					$lien_supp
				</th>
			</tr>
		</table>";  	
}    
?>
<div id="contenu">
	<div id="top_l"></div>
	<div id="top_m">
		<h1>
		<?php
			if ($type_suivi == "entr") {	
			    echo'<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png">';
				echo'Environnement du '.$config_lea->appelation_suivi_entr.'';
			} else {
				echo'<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png">';
				echo'Environnement du '.$config_lea->appelation_suivi_cfa.'';
			}
		?>
			<a href="#" onclick="lightbox('aide_49', '<?php echo $LEA_URL?>')">  
				<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
			</a>
		</h1>
	</div>
	<div id="top_r"></div>
	<div id="m_contenu">
		<table >
			<tr>
				<td>Veuillez indiquer les modalit&eacute;s de saisie qui permettront &agrave; votre <?php echo $config_lea->appelation_app; ?> 
				ou aux personnes qui le suivent de saisir leurs avis sur le d&eacute;roulement 
	      		<?php 
				  	if($type_suivi =='entr') echo $config_lea->appelation_suivi_entr;
					else echo $config_lea->appelation_suivi_cfa;  
			 	?> 
				</td>
			</tr>
			<tr>
				<td class="center">
					<form name="form1" method="get" action="?<?php echo "cmd=suivi_libre_entr&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']; ?>">
						<input type="hidden" name="type_suivi" value="<?php echo $_GET['type_suivi'];?>">
						<input type="hidden" name="suivi" value="<?php echo $_GET['suivi'];?>">
						<input type="hidden" name="selmenu" value="<?php echo $_GET['selmenu'];?>">
						<input type="hidden" name="cmd" value="<?php echo $_GET['cmd'];?>">
						<p>Les modalit&eacute;s que vous voulez proposer &agrave; 
							<a href="#" onclick="lightbox('aide_08', '<?php echo $LEA_URL?>')">
								<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
							</a>
						</p>
						<p>
						<?php
							$array_values = array(											 
								'app'			=> $config_lea->appelation_app, 
								'tuteur_cfa'	=> $config_lea->appelation_tuteur_cfa,
								'ma'			=> $config_lea->appelation_ma,
								'ens'			=> $config_lea->appelation_ens,
								'rl'			=> $config_lea->appelation_rl, 
								'rf'			=> $config_term->terminologie_rf);
					
							$selected_value = (isset($_REQUEST['acteur']) ) ? $_REQUEST['acteur']:'app';
							$attr ='onChange="return this.form.submit();"';
							$name= 'acteur';
							echo liste_deroulante ( $name , $array_values , $selected_value , $attr,  $multiple = 0 , $size = 1 );
						?>
						</p>
					</form>
					<?php				
						foreach($les_modalites_reponse_libre as $modalite ) {					
							afficher_modalite($modalite);
							echo"<br>"; 					
						}									  	
						echo"<br>";				
						foreach($les_modalites_reponse_choix as $modalite ) {
							afficher_modalite($modalite);
							echo"<br>"; 
						}			
						if(count($les_modalites_reponse_libre) == 0 && count($les_modalites_reponse_choix)==0 && $acteur !="") 
							echo("Aucune modalit&eacute; n'est propos&eacute;e ");
					?><br><br>
					<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_ajouter.png') ?>">
					<a href="#" onClick="window.open('./config_suivi/creer_modalite_declaration.php?<?php echo"type_suivi=$type_suivi&acteur=$acteur" ?>' , '', 'scrollbars=yes,resizable=yes,width=800,height=600')">
						Proposer une modalit&eacute; 
				</td>
			</tr>
				</table><br>
				</div>
		</div>