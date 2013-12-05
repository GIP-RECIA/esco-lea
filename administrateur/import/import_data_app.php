<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 11/11/05
/***********************************************************/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
/***********************************************************/
$bdd = new Connexion_BDD_LEA();
$les_classes = $bdd->get_classes();

?>
<script language="JavaScript">

//waite = new Image('../../images/wait.gif');

function import_data(url) {
	document.getElementById('id_submit').style.visibility = 'hidden';
	document.getElementById('id_wait').style.visibility = 'visible';
}
</script>
<div id="top_l"></div>
<div id="top_m">
<h1><span class="orange">I</span>mportation <?php echo($config_term->terminologie_app); ?></h1>
</div>
<div id="top_r"></div>

<div id="m_contenu">

<form name="form1" method="post" action="import_data_app_v.php"
	enctype="multipart/form-data"
	onSubmit="import_data('<?php echo"$LEA_URL"?>'); ">
<table width="70%" height="279" cellspacing="0">
	<tr>
		<th height="22" colspan="2">Fichier</th>
	</tr>
	<tr class="cellule">
		<td width="52%" height="36"><a href="format_fichier_data_app.php">(Voir le format du fichier &agrave; attacher)</a></td>
		<td width="48%"><input type="file" name="data"></td>
	</tr>
	<tr class="cellule">
		<td height="26" class="cellule"><?php echo($config_term->terminologie_classe); ?></td>
		<td><select name="id_cla" size="1">

		<?php

		foreach($les_classes as $classe) {
			echo "<option value='$classe->id_cla' >$classe->libelle </option>\n";
		}

		?>
			<option value='all'>Toutes les classes</option>
		</select> <sup class="etoile">*</sup></td>
	</tr>
	<tr class="cellule">
		<th height="21" colspan="2">Options</th>
	</tr>
	<tr>
		<td height="29" class="cellule">Mettre &agrave; jour les coordonn&eacute;es d'un usager d&eacute;j&agrave; enregistr&eacute;</td>
		<td><input type="checkbox" name="update" value="checkbox"
			onClick="if(this.checked) alert('Vous voulez vraiment remplacer les cordonnées des usagers déjà existants dans la BDD LEA par celles issues du fichier CSV')"></td>
	</tr>
	<tr>
		<td height="29" class="cellule">Identifiant (login)</td>
		<td><select name="option_login" size="1">
			<option value="1">faouzi AMIER ----&gt; fAMIER
			<option value="2" selected>faouzi AMIER ----&gt; faouzi_AMIER
		</select></td>
	</tr>
	<tr class="cellule">
		<td height="25" class="cellule">Mot de passe</td>
		<td><select name="option_mdp" size="1">
			<option value='1'>Identique au login</option>
			<option value='2' selected>Aléatoire alphanumérique</option>
		</select></td>
	</tr>
	<tr>
		<td height="51"></td>
		<td><input type="submit" name="Submit"
			value="Importer <?php echo($config_term->terminologie_app); ?>"></td>
	</tr>
</table>
<p>
<div id="id_submit" style="visibility: visible"></div>
<div id="id_wait" style="visibility: hidden"><span
	style="font-weight: bold"> Importation en cours ..... </span><br>
</div>
</p>
</form>
<p>&nbsp;</p>
</div>
