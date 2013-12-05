<?php
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

/***********************************************************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>LEA: Importation LDAP</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="special" content="" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'styles/jquery-ui-1.9.1.custom.min.css');?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>" />
	<?php
	if(isset($_REQUEST['imprimer'])) {
		echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
		echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
	}
	?>

	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js');?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js');?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/jquery-1.8.2.js');?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/jquery-ui-1.9.1.custom.min.js');?>"></script>
	<script>
		function controleSaisie(theForm)
		{   
		   if(!testVide(theForm.hote, "nom de l'hôte")) return false;
		   if(!testVide(theForm.port, "port")) return false;
		   if(!testVide(theForm.rne, "rne")) return false;

		   return true;
		}
	
		function enCours() {
			$('action').style.display="none";
			$('resultat').innerHTML = $('attente').innerHTML;
		}
		function fini() {
			$('action').style.display="block";
			jQuery('#tabs').tabs();
		}
		function simulation() {
			execution("simulation");
		}
		
		function importation() {
			if (confirm("L'importation LDAP va modifier les données des usagers\nEtes vous sur de vouloir continuer ?")) {
				execution("execution");
			}
		}
		
		function execution(mode) {
			var hash = {update : $('resultat'), method: 'post', data:'mode='+mode+'&'+$('formulaire').toQueryString(), onComplete: fini};
			var monObjetAjax= new Ajax("./traitementLdap.php", hash);
			monObjetAjax.request();
			enCours();
		}		
	</script>
</head>

<body>
	
	<div id="<?php  if(!isset($_REQUEST['imprimer'])){ echo("conteneur"); } else { echo('truccontenuimpression'); } ?>">
		<?php include($LEA_REP.'menu_administrateur.php'); ?>
		<div id="contenu">
			<div id="contents">
				<div id="top_l"></div>
				<div id="top_m">
					<h1><span class="orange">I</span>mportation LDAP</h1>
				</div>
			<div id="top_r"></div>
			<div id="m_contenu">
				<div id="attente" style="display:none;">	
					<center>
						<h3 class="orange">Traitement en cours d'ex&eacute;cution</h3>
						<img src="<?php echo($LEA_URL.'images/ajax-loader.gif')?>"/>
						<h3 class="orange">Veuillez patienter...</h3>
					</center>
				</div>
				<div id="action">
					<form id="formulaire">
						<table>
							<tr><th colspan="2">Etablissement(s) synchronisé(s)</th></tr>
							<tr>
								<td>Rne</td>
								<td><?php print $RNE_ETAB?></td>
							</tr>
							<?php
								// Si des antennes doivent etres synchronisees
								if(isset($RNE_ANTENNES)) {
									print '<tr>';
									print '<td>Rne antenne(s)</td>';
									print '<td>';
									foreach($RNE_ANTENNES as $RNE) {
										print $RNE . '&nbsp;&nbsp;&nbsp;';
									}
									print '</td>';
									print '</tr>';
								}
							?>
							<tr><th colspan="2">Options de synchronisation</th></tr>
							<tr>
								<td>Synchroniser les liens entre les apprentis et leurs tuteurs CFA ?</td>
								<td>
									<input type="radio" name="synchro_tuteurs_cfa" value="oui" /> Oui <br/>
									<input type="radio" name="synchro_tuteurs_cfa" value="non" checked="checked"/> Non
								</td>
							</tr>
						</table>
					</form>
					<p/>
					<input type="button" value="Simulation" onclick="simulation()"></input>&nbsp;
					<input type="button" value="Import" onclick="importation()"></input>
				</div>
				<div id="resultat"></div>
			</div>
		</div>
		<div id="bottom_box"></div>
	</div>

	<?php include($LEA_REP."footer.php")?></div>
</body>
</html>
