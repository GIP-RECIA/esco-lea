<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: 
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_noeud.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
include("../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);

$les_classes = $formation->get_classes();

if(isset($_REQUEST['id_cla'])) $id_cla_select = $_REQUEST['id_cla'];
elseif(count($les_classes) > 0 ) $id_cla_select = $les_classes[0]->id_cla;
else $id_cla_select = 0;
$config_lea = $formation->get_config_lea();

$classe_select = new Classe($id_cla_select);
if($classe_select->get_id_for() != $_SESSION['id_for']) $id_cla_select = 0;

$les_periodes = $classe_select->get_periodes();

?>		
<script type="text/javascript" src="../../javascript/stdlib.js"></script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">L</span>e calendrier des <?php echo($config_lea->appelation_classe); ?>s</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">

<form action=""  method="get">
	<div>
		<input type="hidden" name="cmd" value="liste_periodes_classe" />
		<?php echo($config_lea->appelation_classe); ?> 
		<?php
			if (count($les_classes) >  0){
				echo"<select name=\"id_cla\" onchange=\"this.form.submit();\">";
				
				foreach($les_classes as $classe){
					if ($classe->id_cla == $id_cla_select) $selected = "selected";
					else $selected = "";
					echo"<option value=\"$classe->id_cla\" $selected >$classe->libelle</option>";
				}
				echo"</select>";
			}
			else echo"<p>Pas de $config_lea->appelation_classe trouvable</p>";
		?>
	</div>
</form>
<?php
	//if($id_cla_select > 0) echo"<a href=\"options.php?cmd=liste_periodes\"><button>Mettre &agrave; jour les p&eacute;riodes de votre formation</button></a>";
	if(count($les_periodes) >0 ){
		foreach($les_periodes as $periode ){
					
			if($periode->suivi_cfa) { 
				$date_debut_cfa = trans_date($periode->date_debut_cfa);
				$date_fin_cfa = trans_date($periode->date_fin_cfa);
			}									
			else {
				$date_debut_cfa = "XXXXXXXXXX";
				$date_fin_cfa = "XXXXXXXXXX";	
			}
			if($periode->suivi_entr) { 
				$date_debut_entr = trans_date($periode->date_debut_entr);
				$date_fin_entr = trans_date($periode->date_fin_entr);
			}									
			else {
				$date_debut_entr = "XXXXXXXXXX";
				$date_fin_entr = "XXXXXXXXXX";	
			}
$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
		$suivi="false";
		}else{
		$suivi="true";
		}
if($suivi!="false"){
			echo"
				<table>
					<tr>
						<th colspan=\"4\" > 
							<div style=\"widh:300px; float:left;\">".to_html($periode->libelle)."</div>
							<div style=\"margin-left:580px;\">
							<a style=\"text-align:right\" href=\"#\" onclick=\"window.open('maj_periode_classe.php?id_periode=$periode->id_periode&id_cla=$classe_select->id_cla', '','width=400, height=350,top=250, left=250,  scrollbars=yes,  resizeble=yes' )\">Modifier les dates </a>
							</div>
						</th>
					</tr>
					<tr class=\"selected\">
						<td colspan=\"2\">P&eacute;riode ".$config_term->terminologie_cfa."</td>
						<td colspan=\"2\">P&eacute;riode ".$config_term->terminologie_entr."</td>
					</tr>
					<tr>
						<td>Date de d&eacute;but</td>
						<td>".$date_debut_cfa."</td>"."
						<td>Date de d&eacute;but</td>
						<td>".$date_debut_entr."</td>"."
					</tr>
					<tr>
						<td>Date de fin</td>
						<td>".$date_fin_cfa."</td>"."
						<td>Date de fin</td>
						<td>".$date_fin_entr."</td>"."
					</tr>	 
				</table>";
		}// fin foreach
else{
echo"
				<table>
					<tr>
						<th colspan=\"4\" > 
							<div style=\"widh:300px; float:left;\">".to_html($periode->libelle)."</div>
							<div style=\"margin-left:580px;\">
							<a style=\"text-align:right\" href=\"#\" onclick=\"window.open('maj_periode_classe.php?id_periode=$periode->id_periode&id_cla=$classe_select->id_cla', '','width=400, height=350,top=250, left=250,  scrollbars=yes,  resizeble=yes' )\">Modifier les dates </a>
							</div>
						</th>
					</tr>
					<tr class=\"selected\">
						<td colspan=\"2\">P&eacute;riode ".$config_term->terminologie_cfa."</td>
						
					</tr>
					<tr>
						<td>Date de d&eacute;but</td>
						<td>".$date_debut_cfa."</td>"."
						
					</tr>
					<tr>
						<td>Date de fin</td>
						<td>".$date_fin_cfa."</td>"."
						
					</tr>	 
				</table>";


}
}
	}elseif($id_cla_select > 0) echo("<p> Aucune p&eacute;riode n'est d&eacute;finie pour cette $config_lea->appelation_classe </p>");
	echo"<br>";
	?>
</div>
