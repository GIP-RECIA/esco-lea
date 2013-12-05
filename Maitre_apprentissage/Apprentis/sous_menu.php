<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module gestion des contacts.

/*  Cette fonction permet d'afficher le sous menu du livret
*/

function afficher_sous_menu($selected_rubrique) {
 
?>

<table width='100%' height='20' cellspacing="0"  class="font_sous_menu">
  <tr align="center">
    <td width='0%' height="41" >&nbsp;</td>
    <td width='13%' class='<?php if ($selected_rubrique=="cons_dec_cfa") echo"cellule2" ?>' >
		<a href='livret.php?cmd=cons_dec&type_suivi=cfa' >Les d&eacute;clarations
        	CFA
		</a>	</td>
    <td width='18%' class='<?php if ($selected_rubrique=="cons_dec_entr") echo"cellule2" ?>' >
	<a href="contact.php?cmd=contact_entr" class="sous_menu">	</a><a href='livret.php?cmd=cons_dec&type_suivi=entr' >Les
	d&eacute;clarations entreprise</a></td>
	<td width='18%' class='<?php if ($selected_rubrique=="nouv_dec_cfa") echo"cellule2" ?>' >
		         <a href='livret.php?cmd=nouv_dec&type_suivi=cfa' >Nouvelle d&eacute;claration
        CFA</a></td>
    <td width='17%' class='<?php if ($selected_rubrique=="nouv_dec_entr") echo"cellule2" ?>'>
	<a href='livret.php?cmd=nouv_dec&type_suivi=entr' >Nouvelle
    d&eacute;claration entreprise</a></td>
    <td width='17%'><a href='#'>Synth&egrave;se de vos d&eacute;clarations</a></td>
    <td width='12%'><a href='#' >Bilan	de votre classe</a></td>
    <td width='5%'>&nbsp;</td>
  </tr>
</table>
<?php
}

?>
