<?php
/***********************************************************/  
  // Auteur : Charles-Ulysse BEILLEVERT
/***********************************************************/
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
	if($ligne['id_droit']=="supp_suivi")
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
							
/***********************************************************/
?>
<script type="text/javascript" src="../../javascript/stdlib.js"></script>
<script language="JavaScript">
	function controleSaisie(theForm){	          
		if(testVide(theForm.terminologie_ma, "nom du referent entreprise")== false) return false;     
		if(testVide(theForm.terminologie_tuteur_cfa, "nom du referent en cours")== false) return false;
		if(testVide(theForm.terminologie_app, "nom de l apprenti")== false) return false;  
		if(testVide(theForm.terminologie_ens, "nom de l enseignant")== false) return false;        
		if(testVide(theForm.terminologie_classe, "nom de la classe")== false) return false;
		if(testVide(theForm.terminologie_rl, "nom du responsable legal")== false) return false;
		if(testVide(theForm.terminologie_entr, "entreprise")== false) return false;     
		if(testVide(theForm.terminologie_suivi_cfa, "Type de suivi A")== false) return false;
		if(testVide(theForm.terminologie_suivi_entr, "Type de suivi B")== false) return false;

		if(testVide(theForm.terminologie_lea, "livret électronique d'apprentissage")== false) return false;  
		if(testVide(theForm.terminologie_admin, "adminstrateur")== false) return false;        
		if(testVide(theForm.terminologie_cfa, "cfa")== false) return false;
		if(testVide(theForm.terminologie_unit_pedag, "unite pédagogique")== false) return false;
		if(testVide(theForm.terminologie_rvs, "responsable vie scolaire")== false) return false;     
		if(testVide(theForm.terminologie_formation, "formation")== false) return false;
		if(testVide(theForm.terminologie_rf, "responsable de formation")== false) return false;
		
		return true;
	}
</script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>onfiguration : Sch&eacute;mas de la structure</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<!-- 
		TODO :
		- Mettre la terminologie pour les alts des images
		- Gï¿½rer la transparence pour IE
	-->
	<div id="param">
	<form action="../interface_v.php" method="post">
		<table id="table_func" class="table_layout">
			<caption>Fonctionnalités du Livret</caption>
			<tr>
				<td>
					<div class="func">
						<img class="func_img" src="param/logo_admin.png" alt="Fonctionnalité Gestion Web" />
						<div class="func_haut"><img class="func_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
						<div class="func_mid">
							Gestion Web
						</div>
						<div class="func_bas"></div>
					</div>
				</td>
				<td>
					<div class="func">
						<img class="func_img" src="param/logo_rvs.png" alt="Fonctionnalité Gestion Administrative" />
						<div class="func_haut"><img class="func_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
						<div class="func_mid">
							Gestion administrative
						</div>
						<div class="func_bas"></div>
					</div>
				</td>
				<td>
					<div class="func">
						<img class="func_img" src="param/logo_rf.png" alt="Fonctionnalité Gestion Pédagogique" />
						<div class="func_haut"><img class="func_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
						<div class="func_mid">
							Gestion pédagogique
						</div>
						
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="func">
						<img class="func_img" src="param/logo_ens.png" alt="Fonctionnalité Enseignement" />
						<div class="func_haut"><img class="func_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
						<div class="func_mid">
							Enseignement
						</div>
						<div class="func_bas"></div>
					</div>
				</td>
				<td>
					<div class="func">
						<img class="func_img" src="param/logo_ma.png" alt="Fonctionnalité Tutorat" />
						<div class="func_haut"><img class="func_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
						<div class="func_mid">
							Tutorat
						</div>
						<div class="func_bas"></div>
					</div>
				</td>
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
				<td></td>
				<td></td>
				<td>
					<div class="func">
						<img class="func_img" src="param/logo_trace.png" alt="Fonctionnalité Usages" />
						<div class="func_haut"><img class="func_taille" src="param/ouverture.jpg" alt="ouverture" /></div>
						<div class="func_mid">
							Usages
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
					<div class="act" id="act_admin">
						<div class="act_name">
							<img src="param/petit_logo_admin.png" alt="<?php echo $config_term->terminologie_admin; ?>" />
							<input type="text" class="act_text" name="term_admin" value="<?php echo $config_term->terminologie_admin; ?>" />
						</div>
						<?php
							afficherDroits($tabAdmin);
							afficherSousResponsable($tabSr, 'admin');
						?>
					</div>
				</td>
				<td>
					<div class="act" id="act_rvs">
						<div class="act_name">
							<img src="param/petit_logo_rvs.png" alt="<?php echo $config_term->terminologie_rvs; ?>" />
							<img src="param/suppression.jpg" alt="Supprimer" class="suppression" id="supp_rvs" />
							<input type="text" class="act_text" name="term_rvs" value="<?php echo $config_term->terminologie_rvs; ?>" />
						</div>
						<?php
							afficherDroits($tabRvs);
							afficherSousResponsable($tabSr, 'rvs');
						?>
					</div>
				</td>
				<td>
					<div class="act" id="act_rf">
						<div class="act_name">
							<img src="param/petit_logo_rf.png" alt="<?php echo $config_term->terminologie_rf; ?>" />
							<input type="text" class="act_text" name="term_rf" value="<?php echo $config_term->terminologie_rf; ?>" />
						</div>
						<?php
							afficherDroits($tabEns);
							afficherSousResponsable($tabSr, 'ens');
						?>
					</div>
				</td>
			</tr>
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
							afficherSousResponsable($tabSr, 'ens');
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
							afficherSousResponsable($tabSr, 'ma');
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
							afficherSousResponsable($tabSr, 'rl');
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
							afficherSousResponsable($tabSr, 'app');
						?>
					</div>
				</td>
			</tr>
		</table>
		<!-- Sauvegarde :
		<table class="table_layout">
			<caption>Institutions du Livret</caption>
			<tr>
				<td>
					<div class="inst">
						<input type="text" class="act_text" name="term_lea" value="<?php //echo $config_term->terminologie_lea; ?>" />
					</div>
				</td>
				<td>
					<div class="inst">
						<input type="text" class="act_text" name="term_cfa" value="<?php //echo $config_term->terminologie_cfa; ?>" />
					</div>
				</td>
				<td>
					<div class="inst">
						<input type="text" class="act_text" name="term_entr" value="<?php //echo $config_term->terminologie_entr; ?>" />
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="inst">
						<img src="param/suppression.jpg" alt="Supprimer" class="suppression" id="supp_unit_pedag" />
						<input type="text" class="act_text" name="term_unit_pedag" value="<?php //echo $config_term->terminologie_unit_pedag; ?>" />
					</div>
				</td>
				<td>
					<div class="inst">
						<input type="text" class="act_text" name="term_formation" value="<?php //echo $config_term->terminologie_formation; ?>" />
					</div>
				</td>
				<td>
					<div class="inst">
						<input type="text" class="act_text" name="term_classe" value="<?php //echo $config_term->terminologie_classe; ?>" />
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="inst">
						<input type="text" class="act_text" name="term_suivi_cfa" value="<?php //echo $config_term->terminologie_suivi_cfa; ?>" />
					</div>
				</td>
				<td>
					<div class="inst">
						<img src="param/suppression.jpg" alt="Supprimer" class="suppression" id="supp_suivi_entr" />
						<input type="text" class="act_text" name="term_suivi_entr" value="<?php //echo $config_term->terminologie_suivi_entr; ?>" />
					</div>
				</td>
			</tr>
		</table>
		-->
		
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
							<img src="param/suppression.jpg" alt="Supprimer" class="suppression" id="supp_unit_pedag" />
							<input type="text" class="act_text" name="term_unit_pedag" value="<?php echo $config_term->terminologie_unit_pedag; ?>" />
						</div>
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
		<input type="hidden" id="droitadmin" name="droitadmin" value="<?php echo $droitadmin ?>" />
		<input type="hidden" id="droitrvs" name="droitrvs" value="<?php echo $droitrvs ?>" />
		<input type="hidden" id="droitens" name="droitens" value="<?php echo $droitens ?>" />
		<input type="hidden" id="droitma" name="droitma" value="<?php echo $droitma ?>" />
		<input type="hidden" id="droitsr" name="droitsr" value="<?php echo $sr ?>" />
		
		<!-- /!\ 
			si supprimé, alors la valeur est false
			si non supprimé, alors la valeur est true (l'acteur existe, donc il est vrai)
			(les valeurs sont inversées, à cause du système)
		-->
		<input type="hidden" id="input_supp_rvs" value="<?php echo empty($droitrvs) ? 'false' : 'true'; ?>" />
		<input type="hidden" id="input_supp_suivi_entr" name="supp_suivi_entr" value="<?php echo $suivi; ?>" />
		<input type="hidden" id="input_supp_unit_pedag" name="supp_unit_pedag" value="<?php echo $unite; ?>" />
		<input type="hidden" id="input_supp_rl" name="supp_rl" value="<?php echo $parent; ?>" />
		
		<center><input type="button" id="submit_term" value="Valider" /></center>
	</form>
	</div>
	<div style="visibility:hidden; height:1px;">
		<img src="param/bloc_o.jpg" alt="prechargement" />
		<img src="param/activation.png" alt="prechargement" />
	</div>
</div>