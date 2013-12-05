<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  // Contenu: ce script permet d'afficher toutes les coordonnées d'une entreprise donnée
/*******************************************************/
require_once("../secure.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");

/*******************************************************/

if (isset($_REQUEST['id_entr'])) $id_entr=$_REQUEST['id_entr'];
else exit();
 
$entreprise = new Entreprise($id_entr);
$entreprise->set_detail();

 ?>		
 			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">C</span>onsulter une entreprise</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
        
 <table width="63%" height="62%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <th height="28" colspan="2">Informations
                    Entreprise</td>
                </tr>
                <tr>
                  <td width="47%" height="18" align="left"><p class="txt_gras">Nom</p>
                  </td>
                  <td width="53%"><p class="txt_gras"> <?php echo"$entreprise->nom"; ?>  </td>
   </tr>
                <tr>
                  <td height="59" align="left"><p class="txt_gras">Adresse</p>
                  </td>
                  <td><?php echo"$entreprise->adresse <br> $entreprise->code_postal $entreprise->ville "; ?> </td>
   </tr>
                <tr>
                  <td height="20" align="left"><p class="txt_gras">T&eacute;l&eacute;phone
                      1 </p>
                  </td>
                  <td><?php echo"$entreprise->tel_fixe1"; ?></td>
   </tr>
                <tr>
                  <td height="18" align="left"><p class="txt_gras">T&eacute;l&eacute;phone
                  2 </td>
                  <td><?php echo"$entreprise->tel_fixe2"; ?>
                  </td>
   </tr>
                <tr>
                  <td height="24" align="left"><p class="txt_gras">Fax</td>
                  <td><?php echo"$entreprise->fax"; ?>
                  </td>
   </tr>
                <tr>
                  <td height="18" align="left"><p class="txt_gras">E-mail </td>
                  <td><?php echo"$entreprise->email"; ?>
                  </td>
   </tr>
                <tr>
                  <td height="18" align="left"><p class="txt_gras">Site
                  web(url)</td>
                  <td><?php echo"<a href='$entreprise->url_site' target='_blank'>$entreprise->url_site</a>"; ?>
                  </td>
   </tr>
                <tr>
                  <td height="18" align="left"><p class="txt_gras">Secteur
                  d'activit&eacute;</td>
                  <td><?php echo"$entreprise->secteur_activite"; ?>
                  </td>
   </tr>
                <tr>
                  <td height="22" align="left"><p class="txt_gras">Nombre
                  de salaries </td>
                  <td><?php echo"$entreprise->nb_salaries"; ?>
                  </td>
   </tr>
                <tr>
                  <td height="22" align="left"><p class="txt_gras">Nombre
                  d'apprentis</td>
                  <td><?php echo"$entreprise->nb_apprentis"; ?>
                  </td>
   </tr>
                <tr>
                  <th height="22" colspan="2" >Contact</td>
                </tr>
                <tr>
                  <td height="22" align="left"><p class="txt_gras">Nom</td>
                  <td><?php echo"$entreprise->nom_contact"; ?>
                  </td>
   </tr>
                <tr>
                  <td height="18" align="left"><p class="txt_gras">Pr&eacute;nom</td>
                  <td><?php echo"$entreprise->prenom_contact"; ?>
                  </td>
   </tr>
</table>
 <p>
   <?php
			  echo"
			  <img src='".$LEA_URL."images/b_edit.png'>
			  <a href='gest_entr.php?cmd=nouv_entr&id_entr=$entreprise->id_entr'>
			  Modifier la fiche d'information
			  </a>";
			  ?>
</p>
</div>
