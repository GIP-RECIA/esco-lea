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
require_once ($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");

/***********************************************************/
if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; // l'action demandée : mofier ou ajouter un nouvel usager
else $action="";

if ($action=="modif") $id_ma=$_REQUEST['id_ma'];
else $id_ma=0;

$ma=new Maitre_apprentissage($id_ma);
$ma->set_detail();

$bdd = new Connexion_BDD_LEA(); 	
$les_entreprises = $bdd->get_entreprises(0,10000); 

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
			  <h1><span class="orange">N</span>ouveau maître d'apprentissage</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
<?php echo"<form name='theForm' action='form_nouv_usag_v.php?profil=$profil&action=$action&id_usager=$id_ma' method='post' onsubmit='return controleSaisie(this)'>" ?>
<table width="69%" height="116%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <th height="28" colspan="2">Entreprise</th>
  </tr>
  <tr>
    <td height="46">Entreprise</td>
    <td>
      <select name="id_entr" >
        <option value=0> --- Sélectionnez une entreprise ---</option>
        <?php 
				
				if (isset($les_entreprises)){
					foreach($les_entreprises as $entreprise) {
					  
						if ($entreprise->id_entr==$ma->id_entr) $selected="selected";
						else $selected="";										
						echo "<option value='$entreprise->id_entr' $selected>$entreprise->nom</option>";
					}
				 }
				
				?>
      </select>
      <a href="#" onClick="window.open('../Gest_entr/nouv_entr.php','LEA','height=500, width=600, left=150, top=100, scrollbars=no')"> </a></td>
  </tr>
  <tr>
    <th height="28" colspan="2">Informations Maitre d'apprentissage </th>
  </tr>
  <tr>
    <td width="43%" height="37">Civilit&eacute;</td>
    <td width="57%">
      <?php  
				
				if($ma->civilite=="Monsieur")
				     echo"<input name='civilite' type='radio' value='Monsieur' checked >Monsieur";
				else echo"<input name='civilite' type='radio' value='Monsieur' >Monsieur";
				
				if($ma->civilite=="Madame")
				     echo"<input name='civilite' type='radio' value='Madame' checked>Madame";
				else echo"<input name='civilite' type='radio' value='Madame'  >Madame";
				
				if($ma->civilite=="Mademoiselle")
				     echo"<input name='civilite' type='radio' value='Mademoiselle' checked >Mademoiselle";
				else echo"<input name='civilite' type='radio' value='Mademoiselle' >Mademoiselle";      			  
				echo"<sup class='etoile'>*</sup> ";
				?>
    </td>
  </tr>
  <tr>
    <td height="30">Nom</td>
    <td>
      <input name="nom" type="text" value='<?php echo "$ma->nom"?>'>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="28">Pr&eacute;nom</td>
    <td>
      <input name="prenom" type="text" value='<?php echo "$ma->prenom"?>'>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Adresse</td>
    <td>
      <textarea name="adresse" cols="40" rows="4" ><?php echo "$ma->adresse"?></textarea>
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="20">T&eacute;l&eacute;phone fixe</td>
    <td>
      <input name="tel_fixe" type="text" value='<?php echo "$ma->tel_fixe"?>'>
    </td>
  </tr>
  <tr>
    <td height="18">T&eacute;l&eacute;phone portable</td>
    <td>
      <input name="tel_mobile" type="text" value='<?php echo "$ma->tel_mobile"?>'>
    </td>
  </tr>
  <tr>
    <td height="22">E-mail </td>
    <td>
      <input name="email" type="text" value='<?php echo "$ma->email"?>'>
    </td>
  </tr>
  <tr>
    <td height="18">Site web(url)</td>
    <td><input name="url_site" type="text"value='<?php echo "$ma->url_site"?>'>
    </td>
  </tr>
  <tr>
    <td height="25">Est-il aussi enseignant ?</td>
    <td><input name='droit[]' type='checkbox' value='ens' >
    </td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td><input type="submit" name="Submit" value="Valider"></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
</div>