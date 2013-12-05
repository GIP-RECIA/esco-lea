<?php
/***********************************************************/   
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.1
  // Date: 27/05/07
/***********************************************************/
require_once('../secure.php');
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
/***********************************************************/
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");

require_once("genpdf.php");

$formation = new Formation($_SESSION['id_for']);
$config_lea	= $formation->get_config_lea();

$les_imp_apprentis = unserialize($_SESSION["imp_apprenti"]);

if(isset($_GET["id_app_to_print"])) {
	$un_imp_apprenti_tmp_k = $_GET["id_app_to_print"];
	$un_imp_apprenti_tmp = $les_imp_apprentis[$un_imp_apprenti_tmp_k];
	$_SESSION["imp_apprenti_tmp"] = $les_imp_apprentis[$un_imp_apprenti_tmp_k];
	$_SESSION["un_imp_apprenti_tmp_k"] = $un_imp_apprenti_tmp_k;
} else {
	$un_imp_apprenti_tmp_k = NULL;
	$un_imp_apprenti_tmp = NULL;
	unset($_SESSION["un_imp_apprenti_tmp_k"]);
	unset($_SESSION["imp_apprenti_tmp"]);
}
?>

<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">M</span>odule d'impression - <span class="orange">&Eacute;</span>tape 3</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">

	<div id="module_imp">
	<p align="center">Attention ! La g&eacute;n&eacute;ration PDF peut prendre plusieurs minutes.</p>
<?php

if($_SESSION["imp_type_formulaire"] != "vierge") {
	echo "
			<table>
				<tr>
					<th>Apprenti</th>
					<th>Etat</th>
				</tr>";
	if(isset($les_imp_apprentis)) {
		$nbr_app_col1 = ceil(count($les_imp_apprentis)/2);
		$i = 0;

		foreach($les_imp_apprentis as $un_imp_apprenti_k => $un_imp_apprenti_v) {
	
			$un_usager = new Usager($un_imp_apprenti_v);
			$un_usager->set_detail();
			if(isset($un_imp_apprenti_tmp) && isset($un_imp_apprenti_tmp)) {
				if($un_imp_apprenti_k < $_SESSION["un_imp_apprenti_tmp_k"]) {
					echo "
						<tr>
							<td>".$un_usager->nom." ".$un_usager->prenom."</td>
							<td>Effectu&eacute;</td>
						</tr>";
				} elseif(isset($_SESSION["un_imp_apprenti_tmp_k"]) && $un_imp_apprenti_k == $_SESSION["un_imp_apprenti_tmp_k"]) {
					echo "
						<tr>
							<td>".$un_usager->nom." ".$un_usager->prenom."</td>
							<td>Veuillez patienter un instant...</td>
						</tr>";
				} else {
					echo "
						<tr>
							<td>".$un_usager->nom." ".$un_usager->prenom."</td>
							<td></td>
						</tr>";
				}
			} else {
				echo "
					<tr>
						<td>".$un_usager->nom." ".$un_usager->prenom."</td>
						<td></td>
					</tr>";
			}
		}
	}
	echo "
			</table>";
	if(isset($un_imp_apprenti_tmp_k) && array_key_exists($un_imp_apprenti_tmp_k+1, $les_imp_apprentis)) {
		$un_usager = new Usager($les_imp_apprentis[$un_imp_apprenti_tmp_k+1]);
		$un_usager->set_detail();
		echo "
		<table>
			<tr>
				<th>Etape suivante</th>
			</tr>
			<tr>
				<td><input type=\"button\" onclick=\"document.location.href='imp_livret.php?cmd=param_step_3&amp;id_app_to_print=".($un_imp_apprenti_tmp_k+1)."';\" value=\"G&eacute;n&eacute;rer le PDF pour ".$un_usager->nom." ".$un_usager->prenom."\"/></td>
			</tr>
		</table>";
	} elseif(!isset($un_imp_apprenti_tmp_k)) {
		$un_usager = new Usager($les_imp_apprentis[0]);
		$un_usager->set_detail();	
		echo "
		<table>
			<tr>
				<th>Etape suivante</th>
			</tr>
			<tr>
				<td><input type=\"button\" onclick=\"document.location.href='imp_livret.php?cmd=param_step_3&amp;id_app_to_print=0';\" value=\"G&eacute;n&eacute;rer le PDF pour ".$un_usager->nom." ".$un_usager->prenom."\"/></td>
			</tr>
		</table>";
	}
} else {
	if(isset($un_imp_apprenti_tmp_k)) {
		echo "
		<table>
			<tr>
				<th>Etape en cours de r&eacute;alisation</th>
			</tr>
			<tr>
				<td>G&eacute;n&eacute;ration du PDF...</td>
			</tr>
		</table>";
	} else {
		echo "
		<table>
			<tr>
				<th>Etape suivante</th>
			</tr>
			<tr>
				<td><input type=\"button\" onclick=\"document.location.href='imp_livret.php?cmd=param_step_3&amp;id_app_to_print=0';\" value=\"G&eacute;n&eacute;rer le PDF\"/></td>
			</tr>
		</table>";
	}
}
?>
	</div>
</div>