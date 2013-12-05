<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 23/09/06
  // Contenu:
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."sousresponsable/secure.php");

require_once ($LEA_REP."modele/bdd/classe_noeud.php");
require_once ($LEA_REP."modele/bdd/classe_modalite_va_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

$config_term = new Terminologie();
$config_term->set_detail();
	
$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['type_suivi'])) $type_suivi = $_REQUEST['type_suivi'];

if(isset($_REQUEST['id_arbre']))  {
	$msg_alert = '';
	
	$arbre = new Arbre($_REQUEST['id_arbre']);
	$arbre->set_detail();
	$id = $arbre->dupliquer( $config_lea->id_config, $_REQUEST['type_suivi']); //l'identifiant de l'arbre dupliquï¿½
	html_refresh("../options.php?cmd=maj_arbre&id_arbre=$id");
} else {
	if(isset($_REQUEST['valider'])) $msg_alert = "alert('Veuillez s&eacute;lectionner l\'arbre que vous voulez dupliquer.')";
}

$bdd = new Connexion_BDD_LEA();
$les_formations = $bdd->get_formations(); 

// cette fonction permet d'afficher la liste les arbres crï¿½ï¿½s 
// lors de la configuration de la formation $formation
function afficher_arbres($formation){

	global $LEA_URL;
	$config_lea = $formation->get_config_lea();
	$config_term = new Terminologie();
	$config_term->set_detail();
	
	$les_arbres_cfa  = $config_lea->get_arbres('cfa');
	$les_arbres_entr = $config_lea->get_arbres('entr');
	/*******************************************/
	$liste_arbres_cfa = "";
	
	if(count($les_arbres_cfa)) {
		foreach($les_arbres_cfa as $arbre){ 
			$liste_arbres_cfa .= "
			<input type=\"radio\" name =\"id_arbre\" value=\"$arbre->id_arbre\" > $arbre->nom <br>";
		}
		$arbre_cfa_vide = false;
	} else {
		$liste_arbres_cfa = 'Aucun arbre cr&eacute;&eacute;';
		$arbre_cfa_vide = true;
	}	
	/*******************************************/
	$liste_arbres_entr ="";
	
	if(count($les_arbres_entr)) {
		foreach($les_arbres_entr as $arbre){
			$liste_arbres_entr .= "
			<input type=\"radio\" name =\"id_arbre\"  value=\"$arbre->id_arbre\"  > $arbre->nom <br>";
		}
		$arbre_entr_vide = false;
	} else {
		$liste_arbres_entr = 'Aucun arbre n\'est cr&eacute;&eacute;';
		$arbre_entr_vide = true;
	}	
	/*******************************************/
	if($arbre_entr_vide && $arbre_cfa_vide){
	}else{
		echo'<table>
				<tr class="titre">
					<td colspan = "2">
						'.$config_term->terminologie_formation.' : '.$formation->nom .'
					</td>
				</tr>
				<tr>
					<th width="50%">'.$config_lea->appelation_suivi_cfa.'</th>
					<th>'.$config_lea->appelation_suivi_entr.'</th>
				</tr>			
				<tr>
					<td height="50">'.$liste_arbres_cfa.'</td>
					<td>'.$liste_arbres_entr.'</td>
				</tr>	
			</table>';
	}
}
?>
<div id="contenu">
	<div id="top_l"></div>
	<div id="top_m">
		<h1>
			<?php
				if ($type_suivi == "entr") {
				    echo"<img src=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_suivi_entreprise.png\">";
					echo"Dupliquer un arbre pour le suivi guid&eacute en ".$config_lea->appelation_entr;
				} else {
					echo"<img src=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_suivi_cfa.png\">";
					echo"Dupliquer un arbre pour le suivi guid&eacute en ".$config_term->terminologie_cfa;
				}
			?>	
		</h1>
	</div>
	<div id="top_r"></div>
	<div id="m_contenu">
  		<p>Veuillez s&eacute;lectionner l'arbre que vous voulez dupliquer.</p>
  		<form name='theForm' action="config_suivi/dupliquer_arbre.php?cmd=maj_arbre&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" method="post">
    		<table width="75%" height="84" border="0">
            	<tr>
                	<td height="20" colspan="2">
                	<?php
						foreach($les_formations as $formation ){		
							afficher_arbres($formation);
							echo'<br>';						
						}
					?>
                	</td>
              	</tr>
              	<tr>
                	<td width="44%">&nbsp;</td>
                	<td width="56%">
						<p><input type="submit" name="valider" value="Valider"></p>
					</td>
              	</tr>
            </table>            
		</form>
		<script language="JavaScript">	<?php echo"$msg_alert"; ?>	</script>	  
  	</div>
</div>