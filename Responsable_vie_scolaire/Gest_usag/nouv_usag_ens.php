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
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

/***********************************************************/	

if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; // l'action demandée : mofier ou ajouter un nouvel enseignant
else $action="";

if ($action=="modif") $id_ens = $_REQUEST['id_ens'];
else $id_ens=0;

$enseignant = new Enseignant($id_ens);
$enseignant->set_detail();


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
			  <h1><span class="orange">N</span>ouvel enseignant</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
 

<?php echo"<form name='theForm' action='form_nouv_usag_v.php?id_usager=$id_ens&profil=ens&action=$action' method='post' onsubmit='return controleSaisie(this)'>" ?>
<table width="69%" height="62%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <th height="23" colspan="2">Informations
      Enseignant</th>
  </tr>
  <tr>
    <td width="31%" height="18">Civilit&eacute;</td>
    <td width="69%">
      <?php  
				
				if($enseignant->civilite=="Monsieur")
				     echo"<input name='civilite' type='radio' value='Monsieur' checked >Monsieur";
				else echo"<input name='civilite' type='radio' value='Monsieur' >Monsieur";
				
				if($enseignant->civilite=="Madame")
				     echo"<input name='civilite' type='radio' value='Madame' checked>Madame";
				else echo"<input name='civilite' type='radio' value='Madame'  >Madame";
				
				if($enseignant->civilite=="Mademoiselle")
				     echo"<input name='civilite' type='radio' value='Mademoiselle' checked >Mademoiselle";
				else echo"<input name='civilite' type='radio' value='Mademoiselle' >Mademoiselle";      			  
				echo"<sup class='etoile'>*</sup> ";
				?>
    </td>
  </tr>
  <tr>
    <td height="18">Nom</td>
    <td>
      <input name="nom" type="text" value='<?php echo "$enseignant->nom"?>'>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Pr&eacute;nom</td>
    <td>
      <input name="prenom" type="text" value='<?php echo "$enseignant->prenom"?>'>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Adresse</td>
    <td>
      <textarea name="adresse" cols="40" rows="4" ><?php echo "$enseignant->adresse"?></textarea>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="20">T&eacute;l&eacute;phone
      fixe</td>
    <td>
      <input name="tel_fixe" type="text" value='<?php echo "$enseignant->tel_fixe"?>'>
    </td>
  </tr>
  <tr>
    <td height="18">T&eacute;l&eacute;phone
      portable</td>
    <td><input name="tel_mobile" type="text" value='<?php echo "$enseignant->tel_mobile"?>'>
    </td>
  </tr>
  <tr>
    <td height="22">E-mail </td>
    <td>
      <input name="email" type="text" value='<?php echo "$enseignant->email"?>'>
    </td>
  </tr>
  <tr>
    <td height="18">Site web(url)</td>
    <td><input name="url_site" type="text"value='<?php echo "$enseignant->url_site"?>'>
    </td>
  </tr>
  <tr>
    <td height="25">Discipline</td>
    <td><input name="discipline" type="text" value='<?php echo "$enseignant->discipline"?>' size="50">
    </td>
  </tr>
   <tr>
    <td height="25">Est-il aussi maitre d'apprentissage ?</td>
    <td><input name='droit[]' type='checkbox' value='ma' >
    </td>
  </tr>
  <tr>
    <td height="41">&nbsp;</td>
    <td><input type="submit" name="Submit" value="Valider"></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
</div>