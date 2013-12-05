<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 11/08/05
// Contenu: ce script permet d'afficher toutes les coordonnï¿½es d'une entreprise donnï¿½e
/*******************************************************/
require_once("../secure.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
/*******************************************************/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
if (isset($_REQUEST['id_entr'])) $id_entr=$_REQUEST['id_entr'];
else exit();

$entreprise = new Entreprise($id_entr);
$entreprise->set_detail();
?>
<div id="top_l"></div>
<div id="top_m">
<h1><span class="orange">C</span>onsulter : <?php echo($config_term->terminologie_entr); ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
<table  cellpadding="0" cellspacing="0">
	<tr>
		<th height="28" colspan="2">Informations <?php echo $config_term->terminologie_entr; ?>
	</tr>
	<tr>
		<td width="47%" height="18" align="left"><b>Nom</b></td>
		<td ><b><?php echo"$entreprise->nom"; ?></b></td>
	</tr>
	<tr>
		<td height="59" align="left"><b>Adresse</b></td>
		<td>
			<?php echo $entreprise->adresse."<br/>".($entreprise->code_postal!=0?$entreprise->code_postal:"")." ".$entreprise->ville; ?>
		</td>
	</tr>
	<tr>
		<td height="20" align="left"><b>T&eacute;l&eacute;phone 1</b></td>
		<td><?php echo $entreprise->tel_fixe1; ?></td>
	</tr>
	<tr>
		<td height="18" align="left">
		<b>T&eacute;l&eacute;phone 2</b>
		</td>
		<td><?php echo $entreprise->tel_fixe2; ?></td>
	</tr>
	<tr>
		<td height="24" align="left">
		<b>Fax</b>
		</td>
		<td><?php echo"$entreprise->fax"; ?></td>
	</tr>
	<tr>
		<td height="18" align="left">
		<b>E-mail</b>
		</td>
		<td><?php echo $entreprise->email; ?></td>
	</tr>
	<tr>
		<td height="18" align="left">
		<b>Site web(url)</b>
		</td>
		<td><?php echo"<a href='".$entreprise->url_site."' target='_blank'>".$entreprise->url_site."</a>"; ?></td>
	</tr>
	<tr>
		<td height="18" align="left">
		<b>Secteur d'activit&eacute;</b>
		</td>
		<td><?php echo $entreprise->secteur_activite; ?></td>
	</tr>
	<tr>
		<td height="22" align="left">
		<b>Nombre de salariés</b>
		</td>
		<td><?php echo $entreprise->nb_salaries; ?></td>
	</tr>
	<tr>
		<td height="22" align="left">
		<b>Nombre <?php echo($config_term->terminologie_app); ?></b>
		</td>
		<td><?php echo $entreprise->nb_apprentis; ?></td>
	</tr>
	<tr>
		<th height="22" colspan="2">Contact</th>
	</tr>
	<tr>
		<td height="22" align="left">
		<b>Nom</b>
		</td>
		<td><?php echo $entreprise->nom_contact; ?></td>
	</tr>
	<tr>
		<td height="18" align="left">
		<b>Pr&eacute;nom</b>
		</td>
		<td><?php echo $entreprise->prenom_contact; ?></td>
	</tr>
</table>
<p><?php
echo"
		<img src='".$LEA_URL."images/b_edit.png'>
		<a href='gest_entr.php?cmd=nouv_entr&id_entr=".$entreprise->id_entr."'>
			Modifier la fiche d'information
		</a>";
?></p>
</div>
