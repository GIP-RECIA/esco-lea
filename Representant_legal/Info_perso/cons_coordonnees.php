<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 15/11/05

/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

/***********************************************************/

if(isset($_REQUEST['id_rl_select'])) $id_rl_select=$_REQUEST['id_rl_select'];
else $id_rl_select=$_SESSION['id_rl'];

$parent=new Representant_legal($id_rl_select);
$parent->set_detail();

?>
			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">C</span>oordonn&eacute;es 
			    <?php 
				if(isset($_SESSION['id_rl']) && $id_rl_select==$_SESSION['id_rl']) {
				echo('<img src="'.$URL_THEME.'images/picto_edit.png" />				
					<a href="info_perso.php?cmd=modif_coordonnees">Modifier</a>');
				} 
				?>
			  </h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">       
<table height="438">
	<tr>
		<th height="21" colspan="2">Coordonn&eacute;es repr&eacute;sentant l&eacute;gal		</th>
	</tr>
	<tr>
		<td height="34">Civilit&eacute;</td>
		<td class="nom"><?php echo"$parent->civilite" ?></td>
	</tr>
	<tr>
		<td height="34" >Nom</td>
		<td class="nom"><?php echo"$parent->nom" ?></td>
	</tr>
	<tr>
		<td height="28">Pr&eacute;nom</td>
		<td class="nom"><?php echo"$parent->prenom" ?></td>
	</tr>
	<tr>
		<td height="52">Adresse</td>
		<td class="nom"><?php echo"$parent->adresse" ?></td>
	</tr>
	<tr>
		<td height="29">T&eacute;l&eacute;phone fixe</td>
		<td class="nom"><?php echo"$parent->tel_fixe" ?></td>
	</tr>
	<tr>
		<td height="31">T&eacute;l&eacute;phone portable</td>
		<td class="nom"><?php echo"$parent->tel_mobile" ?></td>
	</tr>
	<tr>
		<td height="25">E-mail</td>
		<td><a href=mailto:<?php echo"$parent->email" ?>><?php echo"$parent->email" ?></a></td>
	</tr>
	<tr>
		<td height="31">Site web (URL)</td>
		<td><a href=<?php echo"$parent->url_site" ?> target="_blank"><?php echo"$parent->url_site" ?></a></td>
	</tr>
	<tr>
		<td height="29">Profession</td>
		<td class="nom"><?php echo"$parent->profession" ?></td>
	</tr>
	<tr>
		<td height="30">Adresse professionnelle</td>
		<td class="nom"><?php echo"$parent->adresse_prof" ?></td>
	</tr>
	<?php if(isset($_SESSION['id_rl']) && $_SESSION['id_rl']==$id_rl_select ) { ?>
	<tr>
		<th colspan="2">Authentification</th>
	</tr>
	<tr>
		<td>Login</td>
		<td class="nom"><?php echo"$parent->login" ?></td>
	</tr>
	<?php }?>
</table>
<?php if( (isset($_SESSION['id_rl']) && $_SESSION['id_rl']!=$id_rl_select) || !isset($_SESSION['id_rl']) )  
	afficher_boutton_ecrire_msg("&Eacute;crire un message &agrave; ce parent ", $parent->id_rl);
?>
</div>