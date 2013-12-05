<?php
/***********************************************************/
  // CFA des 3 villes
  // Web: www.cfa3villes.com.
    
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.1
  // Date: 04/04/07
/***********************************************************/
require_once('../secure.php');

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

/***********************************************************/
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_param_impression.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");

$formation = new Formation($_SESSION['id_for']); // la formation selectionnee
$config_lea	= $formation->get_config_lea();
$config_term = new Terminologie();

function generationElements() {
	global $config_term;
	global $config_lea;
	
	echo '<li class="blue" id="livret_element_couverture">Page de couverture</li>';
	switch($_SESSION['imp_type_livret']) {
		case 'synthèse':
			echo '<li class="blue" id="livret_element_arborescence">Synth&egrave;se</li>';
			break;
		case 'periodes':
			if($_SESSION['imp_type_suivi'] == "entr_et_cfa") {
				if(isset($_SESSION['grouper_type_suivi']) && $_SESSION['grouper_type_suivi'] == true) {
					echo '<li class="blue" id="livret_element_periodecfa">P&eacute;riodes '.$config_term->terminologie_cfa.'</li>';
					echo '<li class="blue" id="livret_element_prediodeentr">P&eacute;riodes '.$config_lea->appelation_entr.'</li>';
				} else {
					echo '<li class="blue" id="livret_element_periode">P&eacute;riodes</li>';
				}
			} else {
				echo '<li class="blue" id="livret_element_periode">P&eacute;riodes</li>';
			}
			break;
		case 'livret_entier':
			echo '<li class="blue" id="livret_element_declaration">D&eacute;clarations</li>';
			break;
	} 
}

unset($_SESSION["un_imp_apprenti_tmp_k"]);
unset($_SESSION["imp_apprenti_tmp"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<!-- InstanceBegin template="/Templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Module d'impression</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Pragma" content="no-cache" />		
<!-- #BeginEditable "Meta" -->
		<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>"  />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
		<script type="text/javascript">
			function redirectToStep3() {
				document.location.href = "imp_livret.php?cmd=param_step_3";
			}
		
			function sortableListe() {
				Sortable.create("livret_element",
					{scroll:true,dropOnEmpty:true,containment:["livret_ordonner"],constraint:false});
				Sortable.create("livret_ordonner",
					{scroll:true,dropOnEmpty:true,containment:["livret_element"],constraint:false});
			}
							 
			function sendOrdre(ordre) {
			
				var ajax = new XHR();
				ajax.appendData('ordre', ordre);
				ajax.send("generation.php");
				ajax.complete = function (xhr) {
					redirectToStep3();
				}
			}
			
			function sendParams() {
							
				if(GEBID("nom_modele").value != "") {
					var ajax_m = new XHR();		
					ajax_m.appendData('nom_modele', GEBID("nom_modele").value);
					ajax_m.send("enr_modele.php");
					ajax_m.complete = function () {
						sendOrdre(Sortable.simpleSerialize('livret_ordonner'));
					}
				} else {
					return false;
				}
				
			}
			
		</script>
		<style type="text/css" media="screen">
			#liste {
				float: left;
				margin-left: 20px;
				margin-right: 20px;
				height: 325px;
				width: 44%;
			}
			ul.sortablelist {
			    list-style-image: none;
			    list-style-type: none;
			    margin-top: 5px;
			    margin-left: 15px;
			    padding: 0px;
			    height: 250px;
			    width: 100%;
			    border: 1px solid #0099FF;
			}
			
			ul.sortablelist li {
			    padding: 5px;
			    margin: 5px;
			    background-color: #FFFFFF; 
			    font-weight: bold;		
			    cursor: move;
			}
			
			li.blue {
				border: 1px solid #0099FF;
				color: #006699;
			}
			
			li.orange {
				border: 1px solid #FF9900;
				color: #006699;
			}
		</style>
		
	</head>
	<body>
		<div id="<?php  if(!isset($_REQUEST['imprimer'])) echo"conteneur" ?>">
		<?php include($LEA_REP.'menu_enseignant.php'); ?>
		<script type="text/javascript" src="<?php echo($LEA_URL.'lib/scriptaculous/prototype.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'lib/scriptaculous/scriptaculous.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'lib/xhr.class.js')?>"></script>
		
			<div id="contenu">
    			<div id="contents">	
					<div id="top_l"></div>
					<div id="top_m">
						<h1><span class="orange">M</span>odule d'impression - <span class="orange">&Eacute;</span>tape 2</h1>
					</div>
					<div id="top_r"></div>
					<div id="m_contenu">
						<div>
							<div id="liste">
								<h3>Elements du <?php echo $config_term->terminologie_lea; ?></h3>
								<ul class="sortablelist" id="livret_element">
									<?php generationElements(); ?>
								   	<!-- <li class="blue" id="livret_element_1">Page de couverture</li>
								   	<li class="blue" id="livret_element_2">Sommaire</li>
								   	<li class="orange" id="livret_element_3">PDF : Document 1</li>
								   	<li class="orange" id="livret_element_4">PDF : Document 2</li>
								   	<li class="orange" id="livret_element_5">PDF : Document 3</li>
								   	<li class="blue" id="livret_element_6">Synth&egrave;se</li-->
								</ul>
							</div>
							<div id="liste">
								<h3><?php echo $config_term->terminologie_lea; ?> &agrave; imprimer</h3>
								<ul class="sortablelist" id="livret_ordonner">
									
								</ul>
							</div>
						</div>
						<script type="text/javascript">
							sortableListe();
						</script>
						<table>
							<tr>
								<th>Options</th>
							</tr>
							<tr>
								<td>
									<input type='checkbox' name='imp_save_modele' id='imp_save_modele' onClick="backup_mod_imp_chps();" value='oui' />
									<label for='imp_save_modele'> Sauvegarder le mod&egrave;le d'impression</label>
									<div id='backup_mod_name' style='display: none;'>
										Nom du mod&egrave;le : <input type="text" id="nom_modele" name="nom_modele" value="" />
									</div>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<th>&Eacute;tape suivante</th>
							</tr>
							<tr>
								<td>
									<div id='backup_mod_Y' style='display: none;'>
										<input type="submit" value=" &rsaquo; G&eacute;n&eacute;rer le <?php echo $config_term->terminologie_lea; ?> et sauvegarder le mod&egrave;le d'impression" onclick="sendParams();" />
									</div>						
									<div id='backup_mod_N' style='display: block;'>
										<input type="submit" value=" &rsaquo; G&eacute;n&eacute;rer le <?php echo $config_term->terminologie_lea; ?>" onclick="sendOrdre(Sortable.simpleSerialize('livret_ordonner'))" />
									</div>
								</td>
							</tr>
						</table>
						</div>
					</div>		
				</div>
				<div id="bottom_box"> </div>
				<div id="save_modele"> </div>
			</div>	
			<?php include($LEA_REP."footer.php")?>
		</div>
	</body>
</html>