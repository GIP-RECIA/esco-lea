<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 15/11/05

/***********************************************************/
require_once("../../config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
/***********************************************************/

if(isset($_REQUEST['id_ma_select'])) $id_ma_select=$_REQUEST['id_ma_select'];
else $id_ma_select=$_SESSION['id_ma'];

$maitre=new Maitre_apprentissage($id_ma_select);
$maitre->set_detail();

$entreprise=new Entreprise($maitre->id_entr);
$entreprise->set_detail();

?>
			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">C</span>oordonn&eacute;es

			  </h1>
			 
			</div><div id="top_r"></div>
			<div id="m_contenu">
			
<table width="61%" cellspacing="0" >
	<td colspan="2">
		<?php 				
			if(isset($_SESSION['id_ma']) && $id_ma_select==$_SESSION['id_ma']) {
				echo("<img src='../../images/b_edit.png'>				
				<a href='info_perso.php?cmd=modif_coordonnees'> <strong>Modifier vos coordonn&eacute;es</strong></a>");				
			}
		?>
	</td>
  <tr>
    <th colspan="2"> Coordonn&eacute;es maître d'apprentissage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </th>
  </tr>
  <tr>
    <td width="25%">Civilit&eacute;</td>
    <td width="75%" >
    	<p class="txt_gras"><?php echo"$maitre->civilite" ?></p>
    </td>
  </tr>
  <tr>
    <td >Nom</td>
    <td>
    	<p class="txt_gras"><?php echo"$maitre->nom" ?></p>
    </td>
  </tr>
  <tr>
    <td >Pr&eacute;nom</td>
    <td>
    	<p class="txt_gras"><?php echo"$maitre->prenom" ?></p>
    </td>
  </tr>
  <tr>
    <td height="40">Adresse</td>
    <td>
    	<p class="txt_gras"><?php echo"$maitre->adresse" ?></p>
    </td>
  </tr>
  <tr>
    <td>T&eacute;l&eacute;phone fixe</td>
    <td>
    	<p class="txt_gras"><?php echo"$maitre->tel_fixe" ?></p>
    </td>
  </tr>
  <tr>
    <td height="30">T&eacute;l&eacute;phone portable</td>
    <td>
    	<p class="txt_gras"><?php echo"$maitre->tel_mobile" ?></p>
    </td>
  </tr>
  <tr>
    <td>E-mail</td>
    <td> 
    	<a href='mailto:<?php echo"$maitre->email" ?>'>
    		<?php echo"$maitre->email" ?>
    	</a> 
    </td>
  </tr>
  <tr>
    <td height="30">Site web(url)</td>
    <td> <a href='<?php echo"$maitre->url_site" ?>' target="_blank"><?php echo"$maitre->url_site" ?></a> </td>
  </tr>
  <tr>
    <th colspan="2"><a name="entreprise"></a> <?php echo $config_lea->appelation_entr; ?></th>
  </tr>
  <tr>
    <td>Nom</td>
    <td width="67%"><p class="txt_gras"> <?php echo"$entreprise->nom"; ?> </td>
  </tr>
  <tr>
    <td height="39">Adresse</td>
    <td><p class="txt_gras"> <?php echo"$entreprise->adresse  $entreprise->code_postal $entreprise->ville "; ?> </td>
  </tr>
  <tr>
    <td>T&eacute;lephone 1</td>
    <td><p class="txt_gras"><?php echo"$entreprise->tel_fixe1"; ?></td>
  </tr>
  <tr>
    <td height="30">T&eacute;l&eacute;phone 2</td>
    <td><p class="txt_gras"><?php echo"$entreprise->tel_fixe2"; ?> </td>
  </tr>
  <tr>
    <td>Fax</td>
    <td><p class="txt_gras"><?php echo"$entreprise->fax"; ?> </td>
  </tr>
  <tr>
    <td height="30">Email</td>
    <td><a href='mailto:<?php echo"$entreprise->email" ?>'><?php echo"$entreprise->email" ?></a> </td>
  </tr>
  <tr>
    <td>Site web(url)</td>
    <td><?php echo"<a href='$entreprise->url_site' target='_blank'>$entreprise->url_site</a>"; ?> </td>
  </tr>
  <tr>
    <td height="30">Secteur d'activit&eacute;</td>
    <td><p class="txt_gras"><?php echo"$entreprise->secteur_activite"; ?> </td>
  </tr>
  <tr>
    <td>Nombre de salari&eacute;s</td>
    <td><p class="txt_gras"><?php echo"$entreprise->nb_salaries"; ?> </td>
  </tr>
  <tr>
    <td>Nombre <?php echo $config_lea->appelation_app; ?></td>
    <td><p class="txt_gras"><?php echo"$entreprise->nb_apprentis"; ?> </td>
  </tr>
  <tr>
    <th colspan="2">Contact <?php echo $config_lea->appelation_entr; ?></th>
  </tr>
  <tr>
    <td>Nom</td>
    <td><p class="txt_gras"><?php echo"$entreprise->nom_contact"; ?> </td>
  </tr>
  <tr>
    <td>Pr&eacute;nom</td>
    <td><p class="txt_gras"><?php echo"$entreprise->prenom_contact"; ?> </td>
  </tr>
  <?php if(isset($_SESSION['id_ma']) && $_SESSION['id_ma']==$id_ma_select ) { ?>
  <tr>
    <th colspan="2">Authentification</th>
  </tr>
  <tr>
    <td>Login</td>
    <td>
    	<p class="txt_gras"><?php echo"$maitre->login" ?></p>
    </td>
  </tr>
  <?php }?>
</table>
<p>
	<?php 
		if( (isset($_SESSION['id_ma']) && $_SESSION['id_ma']!=$id_ma_select) || !isset($_SESSION['id_ma']) )  
			afficher_boutton_ecrire_msg("Ecrire un message  via LEA", $maitre->id_ma);
	?>
</p>
</div>