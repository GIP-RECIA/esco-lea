<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
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
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");

/***********************************************************/
$id_ma_select=$_SESSION['id_ma'];

$maitre=new Maitre_apprentissage($id_ma_select);
$maitre->set_detail();

$entreprise=new Entreprise($maitre->id_entr);
$entreprise->set_detail();

?>
<script language="JavaScript" src="../../javascript/stdlib.js">
</script>

<script language="JavaScript">

function controleSaisie(theForm)
{       			      
   
   if(testVide(theForm.adresse, "adresse")==false) return false;   
   
   if(testLongueur(theForm.mdp, "mot de passe", 6 )==false) return false;
   
   if(verifMotPass ( theForm.mdp, theForm.confirm_mdp)==false) return false;
      
   return true;

}
</script>
			<div id="top_l"></div><div id="top_m"><h1><span class="orange">M</span>odifier vos coordonn&eacute;es</h1></div><div id="top_r"></div>
			<div id="m_contenu">

<form action="info_perso.php?cmd=modif_coordonnees_v" method="post" onSubmit="return controleSaisie(this)">

<table width="61%" >
              <tr>
                <th colspan="2">Coordonn&eacute;es <?php echo($config_lea->appelation_ma);?></th>
              </tr>
              <tr>
                <td width="33%">Civilit&eacute;</td>
                <td width="67%"  ><p><?php echo"$maitre->civilite" ?></p></td>
              </tr>
              <tr>
                <td height="23">Nom</td>
                <td><p><?php echo"$maitre->nom" ?></p>
                </td>
              </tr>
              <tr>
                <td>Pr&eacute;nom</td>
                <td><p><?php echo"$maitre->prenom" ?></p>
                </td>
              </tr>
              <tr>
                <td height="40">Adresse</td>
                <td>
                  
                  <textarea name="adresse" cols="40" rows="3"><?php echo"$maitre->adresse" ?></textarea>
             
                </td>
              </tr>
              <tr>
                <td>T&eacute;l&eacute;phone fixe</td>
                <td><input name="tel_fixe" type="text" value="<?php echo"$maitre->tel_fixe" ?>">
                </td>
              </tr>
              <tr>
                <td>T&eacute;l&eacute;phone portable</td>
                <td>
                  <input name="tel_mobile" type="text" value="<?php echo"$maitre->tel_mobile" ?>">
                </td>
              </tr>
              <tr>
                <td height="26">E-mail</td>
                <td>  <input name="email" type="text" value="<?php echo"$maitre->email" ?>" size="40"></td>
              </tr>
              <tr>
                <td>Site web(url)</td>
                <td>  
				<input name="url_site" type="text" 
				value='<?php 
					if ($maitre->url_site!="") echo"$maitre->url_site";
					else echo("http://");
					   ?>'
				 size="40">
				</td>
              </tr>
              <tr>
                <th colspan="2"><?php echo $config_lea->appelation_entr; ?></th>
              </tr>
              <tr>
                <td>Nom</td>
                <td width="67%"><p> <?php echo"$entreprise->nom"; ?> </p></td>
              </tr>
              <tr>
                <td>Adresse</td>
                <td><p><?php echo"$entreprise->adresse"; ?> </p></td>
              </tr>
              <tr>
                <td>T&eacute;lephone 1</td>
                <td>
                  <input name="tel_fixe1_entr" type="text" value="<?php echo"$entreprise->tel_fixe1"; ?>">
                </td>
              </tr>
              <tr>
                <td>T&eacute;l&eacute;phone 2</td>
                <td>
                  <input name="tel_fixe2_entr" type="text" value="<?php echo"$entreprise->tel_fixe2"; ?>">
                </td>
              </tr>
              <tr>
                <td>Fax</td>
                <td>
                  <input name="fax_entr" type="text" value="<?php echo"$entreprise->fax"; ?>">
                </td>
              </tr>
              <tr>
                <td>Email</td>
                <td>
                  <input name="email_entr" type="text" value="<?php echo"$entreprise->email"; ?> " size="40">
                </td>
              </tr>
              <tr>
                <td>Site web(url)</td>
                <td> 
				<input name="url_site_entr" type="text" value="<?php echo"$entreprise->url_site"; ?> " size="40"></td>
              </tr>
              <tr>
                <td>Secteur d'activit&eacute;</td>
                <td>
                  <input name="secteur_activite_entr" type="text" value="<?php echo"$entreprise->secteur_activite"; ?> " size="40">
                </td>
              </tr>
              <tr>
                <td>Nombre de salari&eacute;s</td>
                <td>
                  <input name="nb_salaries_entr" type="text" value="<?php echo"$entreprise->nb_salaries"; ?> ">
                </td>
              </tr>
              <tr>
                <td>Nombre d'<?php echo($config_lea->appelation_app);?>s</td>
                <td>
                  <input name="nb_apprentis_entr" type="text" value="<?php echo"$entreprise->nb_apprentis"; ?> ">
                </td>
              </tr>
              <tr>
                <th colspan="2">Contact <?php echo $config_lea->appelation_entr; ?></th>
              </tr>
              <tr>
                <td>Nom</td>
                <td>
                  <input name="nom_contact_entr" type="text" value="<?php echo"$entreprise->nom_contact"; ?> ">
                </td>
              </tr>
              <tr>
                <td>Pr&eacute;nom</td>
                <td>
                  <input name="prenom_contact_entr" type="text" value="<?php echo"$entreprise->prenom_contact"; ?> ">
                </td>
              </tr>
              <tr>
                <th colspan="2">Authentification</th>
              </tr>
              <tr>
                <td height="23">Login</td>
                <td><p class="txt_gras"><?php echo"$maitre->login" ?></p>
                </td>
              </tr>
              <tr>
                <td>Nouveau mot de passe</td>
                <td><input name="mdp" type="password" value='<?php echo "$maitre->mdp"?>' >
                </td>
              </tr>
              <tr>
                <td>Confirmer mot de passe</td>
                <td><input name="confirm_mdp" type="password" value='<?php echo "$maitre->mdp"?>'>
                </td>
              </tr>            
  </table>

<p> <input type="submit" name="modifier" value="Modifier"> </p>
</form>
</div>