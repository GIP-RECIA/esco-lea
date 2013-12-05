<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

/***********************************************************/	
if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; // l'action demandée : mofier ou ajouter un nouvel usager
else $action="";

if ($action=="modif") $id_rl=$_REQUEST['id_rl'];
else $id_rl=0;

$rl=new Representant_legal($id_rl);
$rl->set_detail();

 ?>		

<script language="JavaScript">

function controleSaisie(theForm)
{   
    			    
   if(testCivilite(theForm.civilite)==false) return false;
   
   if(testNom(theForm.nom, "nom")==false) return false;
   
   if(testNom(theForm.prenom, "prenom")==false) return false;
   
   if(testVide(theForm.adresse, "adresse")==false) return false;
   
      
   return true;

}

 </script>		

 			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">N</span>ouveau parent</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">

<?php echo"<form name='theForm' action='form_nouv_usag_v.php?id_usager=$id_rl&profil=rl&action=$action' method='post' onsubmit='return controleSaisie(this)'>" ?>
<table width="69%" height="62%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <th height="28" colspan="2">Informations
      repr&eacute;sentant l&eacute;gal</th>
  </tr>
  <tr>
    <td width="43%" height="18">Civilit&eacute;</td>
    <td width="57%">
      <?php  
				
				if($rl->civilite=="Monsieur")
				     echo"<input name='civilite' type='radio' value='Monsieur' checked >Monsieur";
				else echo"<input name='civilite' type='radio' value='Monsieur' >Monsieur";
				
				if($rl->civilite=="Madame")
				     echo"<input name='civilite' type='radio' value='Madame' checked>Madame";
				else echo"<input name='civilite' type='radio' value='Madame'  >Madame";
				
				if($rl->civilite=="Mademoiselle")
				     echo"<input name='civilite' type='radio' value='Mademoiselle' checked >Mademoiselle";
				else echo"<input name='civilite' type='radio' value='Mademoiselle' >Mademoiselle";      			  
				echo"<sup class='etoile'>*</sup> ";
				?>
    </td>
  </tr>
  <tr>
    <td height="18">Nom</td>
    <td>
      <input name="nom" type="text" value='<?php echo "$rl->nom"?>'>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="25">Pr&eacute;nom</td>
    <td>
      <input name="prenom" type="text" value='<?php echo "$rl->prenom"?>'>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Adresse</td>
    <td>
      <textarea name="adresse" cols="40" rows="4" ><?php echo "$rl->adresse"?></textarea>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="20">T&eacute;l&eacute;phone
      fixe</td>
    <td>
      <input name="tel_fixe" type="text" value='<?php echo "$rl->tel_fixe"?>'>
    </td>
  </tr>
  <tr>
    <td height="18">T&eacute;l&eacute;phone
      portable</td>
    <td>
      <input name="tel_mobile" type="text" value='<?php echo "$rl->tel_mobile"?>'>
    </td>
  </tr>
  <tr>
    <td height="22">E-mail </td>
    <td>
      <input name="email" type="text" value='<?php echo "$rl->email"?>'>
    </td>
  </tr>
  <tr>
    <td height="18">Site web(url)</td>
    <td><input name="url_site" type="text"value='<?php echo "$rl->url_site"?>'>
    </td>
  </tr>
  <tr>
    <th height="22" colspan="2">Autres Informations</th>
  </tr>
  <tr>
    <td height="25">Profession</td>
    <td>
      <input name="profession" type="text" value='<?php echo "$rl->profession"?>'>
    </td>
  </tr>
  <tr>
    <td height="25">Adresse professionnelle</td>
    <td>
      <textarea name="adresse_prof" cols="40" rows="4" ><?php echo "$rl->adresse_prof"?></textarea>
    </td>
  </tr>
  <tr>
    <td height="53">&nbsp;</td>
    <td><input type="submit" name="Submit" value="Valider"></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
</div>
