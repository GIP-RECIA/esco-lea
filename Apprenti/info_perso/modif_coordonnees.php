<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 05/09/05

/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
/***********************************************************/
$apprenti = new Apprenti($_SESSION['id_app']);
$apprenti->set_detail();
$config_lea = $apprenti->get_config_lea();

$bdd = new Connexion_BDD_LEA();
$les_administrateurs = $bdd->get_usagers(0,10000, "admin"); // les administrateurs lEA
$id_usager_admin = $les_administrateurs[0]->id_usager;

?>
<script language="JavaScript" src="../../javascript/stdlib.js">
</script>

<script language="JavaScript">

function controleSaisie(theForm)
{   
    			         
   if(testLongueur(theForm.mdp, "mot de passe", 6 )==false) return false;
   
   if(verifMotPass ( theForm.mdp, theForm.confirm_mdp)==false) return false;
      
   return true;

}

 </script>		
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">M</span>odifier vos coordonn&eacute;es personnelles</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">

<table width="61%"  cellspacing="0">
              <tr >
                <th colspan="3">Informations <?php echo $config_lea->appelation_app; ?></th>
              </tr>
              <tr >
                <td width="25%">Civilit&eacute;</td>
                <td width="45%"><p><?php echo"$apprenti->civilite" ?> </p></td>
                <td width="30%" rowspan="5" align="center" valign="middle"> <img src='../Photos/<?php echo"$apprenti->src_photo" ?>' width="120" height="110"> </td>
              </tr>
              <tr >
                <td>Nom</td>
                <td><p><?php echo"$apprenti->nom" ?></p>
                </td>
              </tr>
              <tr >
                <td>Pr&eacute;nom</td>
                <td><p><?php echo"$apprenti->prenom" ?></p>
                </td>
              </tr>
              <tr >
                <td>Date de naissance</td>
                <td><p><?php echo(trans_date($apprenti->date_nais)) ?> </p></td>
              </tr>
              <tr>
                <td>T&eacute;l&eacute;phone fixe</td>
                <td><p><?php echo"$apprenti->tel_fixe" ?></p>
                </td>
              </tr>
              <tr >
                <td>T&eacute;l&eacute;phone portable</td>
                <td colspan="2"><p><?php echo"$apprenti->tel_mobile" ?></p></td>
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
                <td height="22" bordercolor="#99CCFF">Num&eacute;ro
                  d'inscription</td>
                <td colspan="2"><p><?php echo"$apprenti->no_insc" ?></p></td>
              </tr>
              <tr >
                <td height="22">Num&eacute;ro de s&eacute;curit&eacute; sociale</td>
                <td colspan="2"><p><?php echo"$apprenti->no_secu" ?></p></td>
              </tr>
              <tr >
                <td height="22">Situation ann&eacute;e p&eacute;c&eacute;dente</td>
                <td colspan="2"><p><?php echo"$apprenti->dern_classe_freq" ?></p></td>
              </tr>
              <tr >
                <td height="22">Diplomes obtenus</td>
                <td colspan="2"><p><?php echo"$apprenti->diplomes_obtenus" ?> </p></td>
              </tr>
 </table>

<p>Si vous constatez qu'une information doit &ecirc;tre mise &agrave; jour, veuillez
 <?php afficher_boutton_ecrire_msg("&nbsp;contactez l'administrateur <acronym title=\"Livret &Eacute;lectronique d'Apprentissage\">LEA</acronym>", $id_usager_admin); ?> </p>
<p>
<a name="modif_coordonnees" ></a></p>
<form action="modif_coordonnees_v.php" method="post" enctype="multipart/form-data" onSubmit="return controleSaisie(this)" >
<table width="61%"  cellspacing="0">
  <tr>
    <th height="26" colspan="2">Autres Informations</th>
  </tr>
  <tr >
    <td height="18">Photo</td>
    <td><input name="src_photo" type="file" >
    </td>
  </tr>
  <tr>
    <td width="25%">Adresse personnelle</td>
    <td width="75%"><p class="txt_gras">
        <textarea name="adresse_perso" cols="40" rows="3"><?php echo"$apprenti->adresse_perso" ?>  </textarea>
    </td>
  </tr>
  <tr>
    <td>T&eacute;l&eacute;phone personnel</td>
    <td><p class="txt_gras">
        <input type="text" name="tel_perso" value='<?php echo"$apprenti->tel_perso" ?>'>
    </td>
  </tr>
  <tr>
    <td>E-mail personnel</td>
    <td><p class="txt_gras">
        <input name="email_perso" type="text" value='<?php echo"$apprenti->email_perso" ?>' size="40">
    </td>
  </tr>
  <tr>
    <td>Site web(url)</td>
    <td>
      <input name="url_site" type="text" 
				value='<?php 
					if ($apprenti->url_site!="") echo"$apprenti->url_site";
					else echo("http://");
					   ?>' size="40">
    </td>
  </tr>
  <tr>
    <th colspan="2">Authentification</th>
  </tr>
  <tr>
    <td>Login</td>
    <td><p><?php echo"$apprenti->login" ?> </p></td>
  </tr>
  <tr>
    <td>Mot de passe</td>
    <td><input  name='mdp' type="password" value='<?php echo "$apprenti->mdp"?>' >
    </td>
  </tr>
  <tr>
    <td>Confirmer mot de passe</td>
    <td><input name="confirm_mdp" type="password" value='<?php echo "$apprenti->mdp"?>'>
    </td>
  </tr>
</table>
<p>&nbsp; </p>
<p>
  <input type="submit" name="modifier" value="Modifier">
</p>


 </form>
 
 </div>