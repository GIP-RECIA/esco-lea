<?php
require_once("../secure.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

$id_for = $_SESSION['id_for'];
$sql="select * from les_droits";
$result=$bdd->executer($sql);
$droitadmin="";
$droitrvs="";
$droitens="";
$droitma="";
$sr="";
$unite="";
$suivi="";
$parent="";

while($ligne=mysql_fetch_assoc($result))
{
	if($ligne['id_droit']=="admin")
		$droitadmin=$ligne['dr_soumis'];
	if($ligne['id_droit']=="rvs")
		$droitrvs=$ligne['dr_soumis'];
	if($ligne['id_droit']=="ens")
		$droitens=$ligne['dr_soumis'];
	if($ligne['id_droit']=="ma")
		$droitma=$ligne['dr_soumis'];
	if($ligne['id_droit']=="sr")
		$sr=$ligne['dr_soumis'];
	if($ligne['id_droit']=="unite_peda")
		$unite=$ligne['dr_soumis'];
	if($ligne['id_droit']=="suivi_entr")
		$suivi=$ligne['dr_soumis'];
	if($ligne['id_droit']=="parent")
		$parent=$ligne['dr_soumis'];
}

$tabAdmin = explode(',', $droitadmin);
$tabRvs = explode(',', $droitrvs);
$tabEns = explode(',', $droitens);
$tabMa = explode(',', $droitma);
$tabSr = explode(',', $sr);

function afficherDroits($tab)
{
	for ($i = 1 ; $i < count($tab) ; $i++)
	{
		echo '<img src="param/petit_logo_'.$tab[$i].'.png" alt="Fonctionnalité" />';
	}
}

function afficherSousResponsable($tab, $chaine)
{
	$existe = false;
	if (!empty($tab))
	{
		foreach ($tab as $sr)
		{
			if ($sr == $chaine)
				$existe = true;
		}
	}
	if ($existe)
		echo '<img src="param/petit_logo_livret.png" alt="Fonctionnalité Conception du Suivi" />';
}

$tabSrForm = "";
$suivi_for = 'true';
$parent_for = 'true';

$sql="select droit from les_sous_resp_droits where id_for='$id_for'";//pour les droit sr
$result = $bdd->executer($sql);
if (mysql_num_rows($result) != 0)
{
	$ligne = mysql_fetch_assoc($result);
	$droitSrForm = $ligne['droit'];
	$tabSrForm = explode(',', $droitSrForm);
}

$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
$result = $bdd->executer($sql);
if (mysql_num_rows($result) != 0)
{
	$suivi_for = 'false';
}
	
$sql="select id_for_without_parent from les_droits_formations where id_for_without_parent='$id_for'";
$result = $bdd->executer($sql);
if (mysql_num_rows($result) != 0)
{
	$parent_for = 'false';
}
							
/***********************************************************/

require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

/***********************************************************/
include("../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$config_lea = $formation->get_config_lea();

?>
<script type="text/javascript" src="param/parametrage.js"></script>
<link href="../sousresponsable/Option/schema_apprenti.css" rel="stylesheet" type="text/css" />
<link href="param/parametrage.css" rel="stylesheet" type="text/css" media="screen" />
<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
?>
<script type="text/javascript" src="../../javascript/stdlib.js"></script>
<script language="JavaScript">
	function controleSaisie(theForm){   
	    			          
		if(testVide(theForm.appelation_ma, "nom du referent entreprise")== false) return false;     
		if(testVide(theForm.appelation_tuteur_cfa, "nom du referent en cours")== false) return false;
		if(testVide(theForm.appelation_app, "nom de l apprenti")== false) return false;  
		if(testVide(theForm.appelation_ens, "nom de l enseignant")== false) return false;        
		if(testVide(theForm.appelation_classe, "nom de la classe")== false) return false;
		if(testVide(theForm.appelation_rl, "nom du responsable legal")== false) return false;
		if(testVide(theForm.appelation_entr, "entreprise")== false) return false;     
		if(testVide(theForm.appelation_suivi_cfa, "Type de suivi A")== false) return false;
		if(testVide(theForm.appelation_suivi_entr, "Type de suivi B")== false) return false;

		return true;
	}
</script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">T</span>erminologie : Sch&eacute;mas de la structure</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<div id="param">
	<form action="../../interface_formation_v.php" method="post">
		<table id="table_func" class="table_layout">
			<caption>Fonctionnalités du Livret</caption>
			<tr>
				<td>
					<div class="func">
						<img class="func_img" src="param/logo_livret.png" alt="Fonctionnalité Conception du Suivi" />
						<div class="func_haut"><img class="func_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
						<div class="func_mid">
							Conception du suivi
						</div>
						<div class="func_bas"></div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="aide">
					Déplacez une image pour ajouter cette fonctionnalité à un acteur. Vous pouvez agrandir une fonctionnalité pour voir ce qu'elle permet de faire.
				</td>
			</tr>
		</table>
		<table class="table_layout">
			<caption>Acteurs du Livret</caption>
			<tr>
				<td>
					<div class="act" id="act_ens">
						<div class="act_haut"><img class="act_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
						<div class="act_name">
							<img src="param/petit_logo_ens.png" alt="<?php echo $config_term->terminologie_ens; ?>" />
							<input type="text" class="act_text" name="term_ens" value="<?php echo $config_term->terminologie_ens; ?>" />
							<input type="text" class="act_text" name="term_tuteur_cfa" value="<?php echo $config_term->terminologie_tuteur_cfa; ?>" style="display:none; margin-top:4px; width:190px" />
						</div>
						<div class="act_bas"></div>
						<?php
							afficherDroits($tabEns);
							afficherSousResponsable($tabSrForm, 'ens');
						?>
					</div>
				</td>				
				<td>
					<div class="act" id="act_ma">
						<div class="act_name">
							<img src="param/petit_logo_ma.png" alt="<?php echo $config_term->terminologie_ma; ?>" />
							<input type="text" class="act_text" name="term_ma" value="<?php echo $config_term->terminologie_ma; ?>" />
						</div>
						<?php
							afficherDroits($tabMa);
							afficherSousResponsable($tabSrForm, 'ma');
						?>
					</div>
				</td>
				<td>
					<div class="act" id="act_rl">		
						<div class="act_name">
							<img src="param/petit_logo_rl.png" alt="<?php echo $config_term->terminologie_rl; ?>" />
							<img src="param/suppression.jpg" alt="Supprimer" class="suppression" id="supp_rl" />
							<input type="text" class="act_text" name="term_rl" value="<?php echo $config_term->terminologie_rl; ?>" />
						</div>
						<?php
							afficherSousResponsable($tabSrForm, 'rl');
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<div class="act" id="act_app">
						<div class="act_name">
							<img src="param/petit_logo_app.png" alt="<?php echo $config_term->terminologie_app; ?>" />
							<input type="text" class="act_text" name="term_app" value="<?php echo $config_term->terminologie_app; ?>" />
						</div>
						<?php
							afficherSousResponsable($tabSrForm, 'app');
						?>
					</div>
				</td>
			</tr>
		</table>
		
		<table class="table_layout" id="table_inst">
			<caption>Institutions du Livret</caption>
			<tr>
				<td colspan="2">
					<div class="inst">
						<input type="text" class="act_text" name="term_lea" value="<?php echo $config_term->terminologie_lea; ?>" />
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="inst_haut"><img class="inst_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
					<div class="inst_detail">
						<input type="text" class="act_text" name="term_cfa" value="<?php echo $config_term->terminologie_cfa; ?>" />
						<div class="inst">
							<input type="text" class="act_text" name="term_formation" value="<?php echo $config_term->terminologie_formation; ?>" />
						</div>
						<div class="inst">
							<input type="text" class="act_text" name="term_classe" value="<?php echo $config_term->terminologie_classe; ?>" />
						</div>
					</div>
					<div class="inst_bas"></div>
				</td>
				<td id="inst_entr">
					<div class="inst_detail">
						<input type="text" class="act_text" name="term_entr" value="<?php echo $config_term->terminologie_entr; ?>" />
					</div>
				</td>
			</tr>
			<tr class="marge">
				<td>
					<div class="inst">
						<input type="text" class="act_text" name="term_suivi_cfa" value="<?php echo $config_term->terminologie_suivi_cfa; ?>" />
					</div>
				</td>
				<td>
					<div class="inst">
						<img src="param/suppression.jpg" alt="Supprimer" class="suppression" id="supp_suivi_entr" />
						<input type="text" class="act_text" name="term_suivi_entr" value="<?php echo $config_term->terminologie_suivi_entr; ?>" />
					</div>
				</td>
			</tr>
		</table>
		
		<!-- Droits -->
		<input type="hidden" id="droitsr" name="droitsr" value="<?php echo isset($droitSrForm) ? $droitSrForm : ''; ?>" />
		<input type="hidden" id="droitsradmin" value="<?php echo $sr ;// ?>" />
		
		<!-- /!\ 
			si supprimé, alors la valeur est false
			si non supprimé, alors la valeur est true (l'acteur existe, donc il est vrai)
			(les valeurs sont inversés, à cause du système)
		-->
		<input type="hidden" id="input_supp_suivi_entr" name="supp_suivi_entr" value="<?php echo isset($suivi_for) ? $suivi_for : $suivi; ?>" />
		<input type="hidden" id="input_supp_rl" name="supp_rl" value="<?php echo isset($parent_for) ? $parent_for : $parent; ?>" />
		
		<input type="hidden" name="id_for" value="<?php echo $_SESSION['id_for']; ?>" />
		
		<center><input type="button" id="submit_term" value="Valider" /></center>
	</form>
	</div>
	<div style="visibility:hidden; height:1px;">
		<img src="param/bloc_o.jpg" alt="prechargement" />
		<img src="param/activation.png" alt="prechargement" />
	</div>
</div>