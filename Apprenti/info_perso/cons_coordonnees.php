<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 08/08/05
  // Contenu: Cette page contient le formulaire de modification d'une dï¿½claration 
  // correspondant aux travaux effectuï¿½s en entreprise 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");

/***********************************************************/
if(isset($_SESSION['id_app'])) $id_app_select=$_SESSION['id_app'];
elseif(isset($_REQUEST['id_app_select'])) $id_app_select=$_REQUEST['id_app_select'];
else exit();

$apprenti = new Apprenti($id_app_select);

if(isset($_SESSION['id_for']) &&$_SESSION['id_for']!= $apprenti->get_id_for() ) exit();

$apprenti->set_detail();
$REP_PHOTOS = $LEA_URL."Apprenti/Photos/";
$config_lea = $apprenti->get_config_lea();

?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>oordonn&eacute;es</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
<table width="60%" cellspacing="0" >
  <tr >
    <th height="27" colspan="3">Informations <?php echo$config_lea->appelation_app; ?></th>
  </tr>
  <tr >
    <td width="25%" height="25">Civilit&eacute;</td>
    <td width="45%"><p><?php echo"$apprenti->civilite" ?> </p></td>
    <td width="30%" rowspan="5" align="center" valign="middle"> <img src="<?php echo($REP_PHOTOS.$apprenti->src_photo) ?>" width="120" > </td>
  </tr>
  <tr >
    <td height="27">Nom</td>
    <td><p><?php echo"$apprenti->nom" ?></p>
    </td>
  </tr>
  <tr >
    <td height="27">Pr&eacute;nom</td>
    <td><p><?php echo"$apprenti->prenom" ?></p>
    </td>
  </tr>
  <tr >
    <td height="28">Date de naissance</td>
    <td><p><?php echo(trans_date($apprenti->date_nais)) ?> </p></td>
  </tr>
  <tr>
    <td height="26">T&eacute;l&eacute;phone fixe</td>
    <td><p><?php echo"$apprenti->tel_fixe" ?></p>
    </td>
  </tr>
  <tr >
    <td height="25">T&eacute;l&eacute;phone portable</td>
    <td colspan="2"><p><?php echo"$apprenti->tel_mobile" ?> </p></td>
  </tr>
  <tr >
    <td height="37">Adresse</td>
    <td colspan="2"><p><?php echo"$apprenti->adresse" ?></p></td>
  </tr>
  <tr >
    <td>E-mail</td>
    <td colspan="2"> <a href='mailto:<?php echo"$apprenti->email" ?>'><?php echo"$apprenti->email" ?></a></td>
  </tr>
  <tr >
    <td height="37" bordercolor="#99CCFF">Num&eacute;ro d'inscription</td>
    <td colspan="2"><p><?php echo"$apprenti->no_insc" ?></p></td>
  </tr>
  <tr >
    <td height="34">Num&eacute;ro de s&eacute;curit&eacute; sociale</td>
    <td colspan="2"><p><?php echo"$apprenti->no_secu" ?></p></td>
  </tr>
  <tr >
    <td height="35">Situation ann&eacute;e p&eacute;c&eacute;dente</td>
    <td colspan="2"><p><?php echo"$apprenti->dern_classe_freq" ?> </p></td>
  </tr>
  <tr >
    <td height="33">Diplomes obtenus</td>
    <td colspan="2"><p><?php echo"$apprenti->diplomes_obtenus" ?></p></td>
  </tr>
  <tr >
    <td height="33">Contrat</td>
    <td colspan="2"><p> Du <?php echo trans_date($apprenti->date_debut_contrat); ?> Au <?php echo trans_date($apprenti->date_fin_contrat); ?> </p></td>
  </tr>
  <tr >
    <td height="56">Autre adresse</td>
    <td colspan="2"><p><?php echo"$apprenti->adresse_perso" ?></p></td>
  </tr>
  <tr >
    <td height="23">T&eacute;l&eacute;phone personnel</td>
    <td colspan="2"><p><?php echo"$apprenti->tel_perso" ?></p></td>
  </tr>
  <tr >
    <td height="29">E-mail personnel</td>
    <td colspan="2"><?php echo"$apprenti->email_perso" ?></td>
  </tr>
  <tr >
    <td height="27">Site web(url)</td>
    <td colspan="2"><a href='<?php echo"$apprenti->url_site" ?>' target="_blank"><?php echo"$apprenti->url_site" ?></a></td>
  </tr>
  <?php if(isset($_SESSION['id_app']) && $_SESSION['id_app']==$id_app_select ) { 
			  ?>
  <tr >
    <th colspan="3">Authentification</th>
  </tr>
  <tr >
    <td>Login</td>
    <td colspan="2"><p><?php echo"$apprenti->login" ?></p></td>
  </tr>
  <?php }?>
</table>
<p>
	<?php 
		if( (isset($_SESSION['id_app']) && $_SESSION['id_app']!=$id_app_select) || !isset($_SESSION['id_app']) )  
			afficher_boutton_ecrire_msg("Ecrire un message via LEA", $id_app_select);
	?>
</p>
</div>