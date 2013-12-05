<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_usager.php");
/***********************************************************/	
if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; // l'action demandï¿½e : mofier ou ajouter un nouvel usager
else $action="";

if ($action=="modif") $id_usager=$_REQUEST['id_usager'];
else $id_usager=0;

$admin=new Usager($id_usager);
$admin->set_detail();
?>		

<script language="JavaScript">

function controleSaisie(theForm)
{   
    			    
   if(testCivilite(theForm.civilite)==false) return false;
   
   if(testNom(theForm.nom, "nom")==false) return false;
   
   if(testNom(theForm.prenom, "prenom")==false) return false;
   
   if(testVide(theForm.adresse, "adresse")==false) return false;
   
   if(testLongueur(theForm.login, "login", 6 )==false) return false;
   
   if(testLongueur(theForm.mdp, "mot de passe", 6 )==false) return false;
   
   if(verifMotPass ( theForm.mdp, theForm.confirm_mdp)==false) return false;
      
   return true;

}

 </script>		


	<div id="top_l"></div><div id="top_m"><h1><span class="orange">N</span>ouvel <?php echo($config_term->terminologie_admin); ?> <?php echo($config_term->terminologie_lea); ?></h1></div><div id="top_r"></div>
<div id="m_contenu">

<?php echo"<form name='theForm' action='form_nouv_usag_v.php?id_usager=$id_usager&profil=admin&action=$action' method='post' onsubmit='return controleSaisie(this)'>" ?>
<table width="69%" height="114%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <th height="28" colspan="2" >Informations
      <?php echo($config_term->terminologie_admin); ?>    </th>
  </tr>
  <tr>
    <td width="43%" height="18">Civilit&eacute;</td>
    <td width="57%">
      <?php  
				
				if($admin->civilite=="Monsieur")
				     echo"<input name='civilite' type='radio' value='Monsieur' checked > Monsieur";
				else echo"<input name='civilite' type='radio' value='Monsieur' > Monsieur";
				
				if($admin->civilite=="Madame")
				     echo"<input name='civilite' type='radio' value='Madame' checked> Madame";
				else echo"<input name='civilite' type='radio' value='Madame'  > Madame";
				
				if($admin->civilite=="Mademoiselle")
				     echo"<input name='civilite' type='radio' value='Mademoiselle' checked > Mademoiselle";
				else echo"<input name='civilite' type='radio' value='Mademoiselle' > Mademoiselle";      			  
				echo"<sup class='etoile'>*</sup> ";
				?>
    </td>
  </tr>
  <tr>
    <td height="18" bordercolor="#99CCFF">Nom</td>
    <td bordercolor="#99CCFF" class="cellule">
      <input name="nom" type="text" value='<?php echo "$admin->nom"?>'>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18" bordercolor="#99CCFF">Pr&eacute;nom</td>
    <td bordercolor="#99CCFF" class="cellule">
      <input name="prenom" type="text" value='<?php echo "$admin->prenom"?>'>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18" bordercolor="#99CCFF">Adresse</td>
    <td bordercolor="#99CCFF" class="cellule">
      <textarea name="adresse" cols="40" rows="4" ><?php echo "$admin->adresse"?></textarea>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="20" bordercolor="#99CCFF">T&eacute;l&eacute;phone
      fixe</td>
    <td bordercolor="#99CCFF" class="cellule">
      <input name="tel_fixe" type="text" value='<?php echo "$admin->tel_fixe"?>'>
    </td>
  </tr>
  <tr>
    <td height="18" bordercolor="#99CCFF">T&eacute;l&eacute;phone
      portable</td>
    <td bordercolor="#99CCFF" class="cellule">
      <input name="tel_mobile" type="text" value='<?php echo "$admin->tel_mobile"?>'>
    </td>
  </tr>
  <tr>
    <td height="22" bordercolor="#99CCFF">E-mail </td>
    <td bordercolor="#99CCFF" class="cellule">
      <input name="email" type="text" value='<?php echo "$admin->email"?>'>
    </td>
  </tr>
  <tr>
    <td height="18">Site web(url)</td>
    <td class="cellule"><input name="url_site" type="text"value='<?php echo "$admin->url_site"?>'>
    </td>
  </tr>
  <tr>
    <th height="18" colspan="2" >Authentification</th>
  </tr>
  <tr>
    <td height="18">Login</td>
    <td class="cellule"><input name="login" type="text" value='<?php echo "$admin->login"?>' onFocus=" auto_login(document.theForm)">
        <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Mot de passe</td>
    <td class="cellule"><input name="mdp" type="password" value='<?php echo "$admin->mdp"?>'  >
        <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Confirmer mot de passe</td>
    <td class="cellule">
      <input name="confirm_mdp" type="password" value='<?php echo "$admin->mdp"?>'  >
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Droit</td>
    <td class="cellule">
      <input name='droit' type='checkbox' value='ma' > Maitre de stage
	  <input name='droit' type='checkbox' value='rvs' > Responsable de vie scolaire
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="52">&nbsp;</td>
    <td class="cellule"><input type="submit" name="Submit" value="Valider"></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
 </div>