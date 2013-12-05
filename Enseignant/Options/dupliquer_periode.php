<?php
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_periode.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
include("../test_responsable.php");

$config_lea = $formation->get_config_lea(); 
$les_classes = $formation->get_classes();
$periode = new Periode($_GET['id_periode']);
$periode->set_detail();
?>		
<script type="text/javascript" src="../../javascript/stdlib.js"></script>
<script>
	function controleSaisie(form) {
		if(testVide(form.nomPeriode, "nom de la période")== false) return false;
		if(testVide(form.nbJours, "nombre de jours")== false) return false;
		if(testNumeric(form.nbJours, "nombre de jours ")== false) return false;           
		if(testVide(form.rang, "rang")== false) return false;
		if(testNumeric(form.rang, "rang")== false) return false;
		if (form.rang.value <=0) {
			alert("La valeur du rang doit être supérieure à 0");
		    form.rang.select();
		    form.rang.focus();
		    return false;           		
		}
		return true;
	}
</script>

<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">D</span>uplication de la p&eacute;riode '<?php echo $periode->libelle; ?>'</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">

	<form name="formulaire" method="post" action="dupliquer_periode_v.php" onSubmit="return controleSaisie(this); ">
		<table>
			<tr class="titre">
				<td height="21" colspan="3">Cette p&eacute;riode concerne</td>
			</tr>	
			<tr>
				<td colspan="3">
					<?php
					if($periode->suivi_cfa)	echo $config_lea->appelation_suivi_cfa."<br/>";
					if($periode->suivi_entr) echo $config_lea->appelation_suivi_entr."<br/>";
					?>
					<br/>
				</td>
				
			</tr>
			<tr class="titre">
				<td height="21" colspan="3">Les usagers suivants sont autoris&eacute;s &agrave; consulter cette p&eacute;riode</td>
			</tr>	
			<tr>
				<td colspan="3">
					<?php 
					if($periode->consult_app) echo $config_lea->appelation_app."<br/>";
					if($periode->consult_ma) echo $config_lea->appelation_ma."<br/>";
					if($periode->consult_tuteur_cfa) echo $config_lea->appelation_tuteur_cfa."<br/>";
					if($periode->consult_ens) echo $config_lea->appelation_ens."<br/>";
					if($periode->consult_rl) echo $config_lea->appelation_rl."<br/>";	
					?>
					<br/>				
				</td>
			</tr>
			<tr class="titre">
				<td height="21" colspan="3">Calendrier des classes</td>
			</tr>
			<tr>
				<th>Classe</th>
				<th>P&eacute;riode au CFA</th>
				<th>P&eacute;riode en entreprise</th>
			</tr>
			<?php
			$les_id_classes = $periode->get_id_classes();
			$classTd = "";
			foreach($les_classes as $classe) {
				if (in_array($classe->id_cla, $les_id_classes)) {
					echo "<tr class='$classTd'>";
					$les_periodes = $periode->get_calendrier($classe->id_cla);
					echo "<td>$classe->libelle</td>";
					if ($periode->suivi_cfa) $txt = "du ".trans_date($les_periodes['date_debut_cfa'])." au ".trans_date($les_periodes['date_fin_cfa']); else $txt="";
					echo "<td>$txt</td>";
					if ($periode->suivi_entr) $txt = "du ".trans_date($les_periodes['date_debut_entr'])." au ".trans_date($les_periodes['date_fin_entr']); else $txt="";
					echo "<td>$txt</td>";
					echo "</tr>";
					$classTd = ($classTd=="")?"selected":"";
				}
			}
			?>
			<tr class="titre">
				<td height="21" colspan="3"><br/>P&eacute;riode dupliqu&eacute;e</td>
			</tr>	
		
			<tr>	
				<td height="50">
					Nom de la p&eacute;riode dupliqu&eacute;e :	<input name="nomPeriode" type="text"/>
					<input name="idPeriodeSrc" type="hidden" value="<?php echo $periode->id_periode ?>"/>
				</td>
				<td >
					D&eacute;caler les calendriers de <input name="nbJours" type="text" size="2" value="0" style="text-align:right"/> jours
				</td>
				<td >
					Rang <input name="rang" type="text" size="2" value="<?php echo $periode->rang; ?>" style="text-align:right"/> (saisir un nombre superieur &agrave; 0)
				</td>
			</tr>
			<tr>
				<td height="50" colspan="3" class="center"><input type="submit" name="Submit" value="Dupliquer"></td>
			</tr>
		</table>
	</form>
</div>