<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  // Contenu: cette page permet d'afficher  les coordonnï¿½es de la personne qui cette apprenti au CFA
/*******************************************************/
include_once("../secure.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/classe_config_lea.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
require_once ($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once ($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
/*******************************************************/
$config_term = new Terminologie();
$config_term->set_detail();

$apprenti= new Apprenti($_SESSION['id_app']);
$apprenti->set_detail();

$formation = $apprenti->get_formation();
$config_lea = $formation->get_config_lea();

$unite = new Unite_pedagogique($formation->id_unite); // l'unite pï¿½dagogique de l'apprenti
$unite->set_detail();

/*
$les_id_responsables = $unite->get_id_responsables(); 
if(count($les_id_responsables) > 0 ) $id_rvs = $les_id_responsables[0]; //  l'identifiant de l'un des responsables vie scolaire de l'unite
else $id_rvs = 0;
*/

$enseignant = new Enseignant($apprenti->id_ens);
$enseignant->set_detail();


if($enseignant->nom !=""){


?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>ontact</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
<table width="61%" height="361" cellspacing="0" >
  <tr>
    <th height="32" colspan="2"> Coordonn&eacute;es de votre <?php echo"$config_lea->appelation_tuteur_cfa"; ?></th>
  </tr>
  <tr>
    <td width="30%" height="31">Titre</td>
    <td width="70%"  ><p><?php echo"$enseignant->civilite" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="33" >Nom</td>
    <td><p><?php echo"$enseignant->nom" ?></p>
    </td>
  </tr>
  <tr>
    <td height="33"  >Pr&eacute;nom</td>
    <td><p><?php echo"$enseignant->prenom" ?></p>
    </td>
  </tr>
  <tr>
    <td height="40">Adresse</td>
    <td><p><?php echo"$enseignant->adresse" ?></p>
    </td>
  </tr>
  <tr>
    <td height="34">T&eacute;l&eacute;phone fixe</td>
    <td><p><?php echo"$enseignant->tel_fixe" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="35">T&eacute;l&eacute;phone portable</td>
    <td><p><?php echo"$enseignant->tel_mobile" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="32">E-mail</td>
    <td> <a href='mailto:<?php echo"$enseignant->email" ?>'><?php echo"$enseignant->email" ?></a> </td>
  </tr>
  <tr>
    <td height="32">Site web(url)</td>
    <td> <a href="<?php echo"$enseignant->url_site" ?>" target="_blank"><?php echo"$enseignant->url_site" ?></a> </td>
  </tr>
</table>
<p>
 <?php
  afficher_boutton_ecrire_msg("Ecrire un message &agrave; votre ".$config_lea->appelation_tuteur_cfa , $enseignant->id_ens );
 ?>
</p>
<p>
  <?php
}else echo(" <b> Vous n'avez pas de ".$config_lea->appelation_tuteur_cfa." </b>");

?> 
</p>
<table width="61%" height="316" cellspacing="0" >
  <tr>
    <th height="32" colspan="2"><?php echo $config_term->terminologie_rvs; ?></th>
  </tr>
  <tr>
    <td width="30%" height="33" >Nom</td>
    <td width="70%"><p><?php echo"$unite->nom" ?></p>
    </td>
  </tr>
  <tr>
    <td height="40">Adresse</td>
    <td><p><?php echo"$unite->adresse" ?></p>
    </td>
  </tr>
  <tr>
    <td height="34">T&eacute;l&eacute;phone fixe 1</td>
    <td><p><?php echo"$unite->tel_fixe1" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="35">T&eacute;l&eacute;phone fixe 2</td>
    <td><p><?php echo"$unite->tel_fixe2" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="35">Fax</td>
    <td><p><?php echo"$unite->fax" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="32">E-mail</td>
    <td> <a href='mailto:<?php echo"$unite->email" ?>'><?php echo"$unite->email" ?></a> </td>
  </tr>
  <tr>
    <td height="32">Site web(url)</td>
    <td> <a href='<?php echo"$unite->url_site" ?>' target="_blank"><?php echo"$unite->url_site" ?></a> </td>
  </tr>
</table>
<?php
	$ma = new Maitre_apprentissage($apprenti->id_ma);
	$ma->set_detail();

	if( $ma->nom!= ""){

	$entreprise = new Entreprise($ma->id_entr);
	$entreprise->set_detail();


?>
<table width="70%" height="122%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <th height="28" colspan="2" >Coordonn&eacute;es de votre <?php echo"$config_lea->appelation_ma"; ?></th>
  </tr>
  <tr>
    <td width="32%" height="18" >Titre</td>
    <td width="68%" ><p><?php echo"$ma->civilite" ?> </p></td>
  </tr>
  <tr>
    <td height="18">Nom</td>
    <td>
      <p><?php echo"$ma->nom" ?></p>
    </td>
  </tr>
  <tr>
    <td height="18">Pr&eacute;nom</td>
    <td bordercolor="#99CCFF">
      <p><?php echo"$ma->prenom" ?></p>
    </td>
  </tr>
  <tr>
    <td height="50">Adresse</td>
    <td bordercolor="#99CCFF">
      <p><?php echo"$ma->adresse" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="25" >T&eacute;l&eacute;phone fixe</td>
    <td><p><?php echo"$ma->tel_fixe" ?> </td>
  </tr>
  <tr>
    <td height="26">T&eacute;l&eacute;phone portable</td>
    <td><p><?php echo"$ma->tel_mobile" ?> </p></td>
  </tr>
  <tr>
    <td height="25">E-mail</td>
    <td><a href='mailto:<?php echo"$ma->email" ?>'><?php echo"$ma->email" ?></a> </td>
  </tr>
  <tr>
    <td height="18">Site web(url)</td>
    <td><a href='<?php echo"$ma->url_site" ?>' target="_blank"><?php echo"$ma->url_site" ?></a> </td>
  </tr>
</table>
<p>
	<?php afficher_boutton_ecrire_msg("Ecrire un message &agrave; votre ".$config_lea->appelation_ma , $ma->id_ma );  ?>
</p>
<p>
	<?php	}else echo(" <b> Vous n'avez pas de patron </b>"); ?>
</p>
</div>