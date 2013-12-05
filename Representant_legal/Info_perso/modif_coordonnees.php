<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 15/11/05

/***********************************************************/
include_once("../secure.php");
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");
/***********************************************************/
$id_rl_select=$_SESSION['id_rl'];

$parent=new Representant_legal($id_rl_select);
$parent->set_detail();

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
			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">M</span>odifier vos coordonn&eacute;es</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
<p>&nbsp;</p>
<form action="modif_coordonnees_v.php" method="post" onSubmit="return controleSaisie(this)">
<table width="61%" >
  <tr>
    <th height="28" colspan="2">Coordonn&eacute;es</th>
  </tr>
  <tr>
    <td width="33%">Civilit&eacute;</td>
    <td width="67%"  ><p><?php echo"$parent->civilite" ?></td>
  </tr>
  <tr>
    <td height="23">Nom</td>
    <td><p><?php echo"$parent->nom" ?></p>
    </td>
  </tr>
  <tr>
    <td>Pr&eacute;nom</td>
    <td><p><?php echo"$parent->prenom" ?></p>
    </td>
  </tr>
  <tr>
    <td height="40">Adresse</td>
    <td>
        <textarea name="adresse" cols="40" rows="3"><?php echo"$parent->adresse" ?></textarea>
     
    </td>
  </tr>
  <tr>
    <td>T&eacute;l&eacute;phone fixe</td>
    <td>
        <input name="tel_fixe" type="text" value="<?php echo"$parent->tel_fixe" ?>">
    </td>
  </tr>
  <tr>
    <td>T&eacute;l&eacute;phone portable</td>
    <td>
        <input name="tel_mobile" type="text" value="<?php echo"$parent->tel_mobile" ?>">
    </td>
  </tr>
  <tr>
    <td>E-mail</td>
    <td>
      <input name="email" type="text" value="<?php echo"$parent->email" ?>" size="40">
    </td>
  </tr>
  <tr>
    <td>Site web(url)</td>
    <td>
      <input name="url_site" type="text" value="<?php echo"$parent->url_site" ?>" size="40">
    </td>
  </tr>
  <tr>
    <td>Profession</td>
    <td>
        <input name="profession" type="text" value="<?php echo"$parent->profession"; ?>" size="40">
    </td>
  </tr>
  <tr>
    <td>Adresse professionnelle</td>
    <td bgcolor="#F9F9F9"><p class="txt_gras">
        <textarea name="adresse_prof" cols="40" rows="3"><?php echo"$parent->adresse_prof"; ?></textarea>
    </td>
  </tr>
  <tr>
    <th height="28" colspan="2">Authentification</th>
  </tr>
  <tr>
    <td>Login</td>
    <td><p><?php echo"$parent->login" ?></p>
    </td>
  </tr>
  <tr>
    <td>Nouveau mot de passe</td>
    <td><input name="mdp" type="password" value='<?php echo "$parent->mdp"?>' >
    </td>
  </tr>
  <tr>
    <td>Confirmer mot de passe</td>
    <td><input name="confirm_mdp" type="password" value='<?php echo "$parent->mdp"?>'>
    </td>
  </tr>
</table>

<p>
  <input type="submit" name="modifier" value="Modifier">
</p>
</form>
</div>