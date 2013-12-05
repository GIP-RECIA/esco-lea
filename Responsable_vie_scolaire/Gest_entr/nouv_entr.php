<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Formulaire de  saisies d'une nouvelle entrepreprsie dans la base
  //          de donnnï¿½es
/***********************************************************/
require_once("../secure.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

/***********************************************************/	
if(isset($_REQUEST['id_entr'])) $id_entr=$_REQUEST['id_entr']; // modifier l'entreprise didentifiant id_ent
else $id_entr=0; // crï¿½er une nouvelle entreprise
$entreprise=new Entreprise($id_entr);
$entreprise->set_detail();
 ?>		
<script language="JavaScript" src="../../javascript/stdlib.js">
</script>

<script language="JavaScript">

function controleSaisie(theForm)
{   
    			          
   if(testNom(theForm.nom, "nom")==false) return false;     
   
   if(testVide(theForm.adresse, "adresse")==false) return false;
   
   return true;
}

 </script>		
 			<div id="top_l"></div><div id="top_m">
			  <h1><?php 			
   if($id_entr==0) echo"Nouvelle entreprise";
 	else echo"Modifier une entreprise";
?></h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">

<?php echo"<form name='theForm' action='nouv_entr_v.php?id_entr=$id_entr' method='post' onSubmit='return controleSaisie(this)'>" ?>
<table width="68%" height="62%" border="0" cellpadding="0" cellspacing="0"  >
  <tr>
    <th height="24" colspan="2">Informations Entreprise</th>
  </tr>
  <tr>
    <td width="33%" height="18">Nom
    </td>
    <td width="67%">
      <input name="nom" type="text" value='<?php echo"$entreprise->nom"; ?>' size="40">
    <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Adresse
    </td>
    <td>
      <textarea name="adresse" cols="40" rows="4" ><?php echo"$entreprise->adresse"; ?></textarea>
    <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="22">Code postal</td>
    <td><input name="code_postal" type="text" value='<?php echo"$entreprise->code_postal"; ?>'></td>
  </tr>
  <tr>
    <td height="22">Ville</td>
    <td><input name="ville" type="text" value='<?php echo"$entreprise->ville"; ?>'></td>
  </tr>
  <tr>
    <td height="22">T&eacute;l&eacute;phone fixe1 
    </td>
    <td>
      <input name="tel_fixe1" type="text" value='<?php echo"$entreprise->tel_fixe1"; ?>'>
    </td>
  </tr>
  <tr>
    <td height="18">T&eacute;l&eacute;phone fixe2 </td>
    <td><input name="tel_fixe2" type="text" value='<?php echo"$entreprise->tel_fixe2"; ?>'>
    </td>
  </tr>
  <tr>
    <td height="18">Fax</td>
    <td><input name="fax" type="text" value='<?php echo"$entreprise->fax"; ?>' maxlength="30">
    </td>
  </tr>
  <tr>
    <td height="20">E-mail </td>
    <td><input name="email" type="text" value='<?php echo"$entreprise->email"; ?>'>
    </td>
  </tr>
  <tr>
    <td height="22">Site web(url)</td>
    <td><input name="url_site" type="text" value='<?php echo"$entreprise->url_site"; ?>' size="50">
    </td>
  </tr>
  <tr>
    <td height="22">Secteur d'activit&eacute;s</td>
    <td><input name="secteur_activite" type="text" value='<?php echo"$entreprise->secteur_activite"; ?>' size="50">
    </td>
  </tr>
  <tr>
    <td height="18">Nombre de salari&eacute;s </td>
    <td><input name="nb_salaries" type="text" value='<?php echo"$entreprise->nb_salaries"; ?>'size="6">
    </td>
  </tr>
  <tr>
    <td height="18">Nombre  <?php echo $config_term->terminologie_app ?></td>
    <td><input name="nb_apprentis" type="text" value='<?php echo"$entreprise->nb_apprentis"; ?>' size="6">
    </td>
  </tr>
  <tr>
    <th height="24" colspan="2">Contact</td>
  </tr>
  <tr>
    <td height="22">Nom</td>
    <td><input name="nom_contact" type="text" value='<?php echo"$entreprise->nom_contact"; ?>'>
    </td>
  </tr>
  <tr>
    <td height="18">Pr&eacute;nom</td>
    <td><input name="prenom_contact" type="text" value='<?php echo"$entreprise->prenom_contact"; ?>'>
    </td>
  </tr>
  <tr>
    <td height="58">&nbsp;</td>
    <td><input type="submit" name="Submit" value="Valider"></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>

</div>