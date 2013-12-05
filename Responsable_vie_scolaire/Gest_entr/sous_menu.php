<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module gestion des entreprise.

/*  Cette fonction permet d'afficher le sous menu de la gestion des enstreprises   
*/

function afficher_sous_menu($selected_rubrique) {
 
?>
		    
<table width='100%' height='20' cellspacing="0" class='font_sous_menu' >
  <tr align="center">
    <td width='5%' height="41" >&nbsp;</td>
    <td width='25%' class='<?php if ($selected_rubrique=="cons_entr") echo"cellule2" ?>'> 
		<a href="gest_entr.php?cmd=cons_entr" class="sous_menu">Consulter
                les entreprises</a>
	</td>
    <td width='31%' class='<?php if ($selected_rubrique=="nouv_entr") echo"cellule2" ?>' >
		<a href="gest_entr.php?cmd=nouv_entr" class="sous_menu">Cr&eacute;er une nouvelle
            entreprise</a>
	</td>
	<td width='39%'>&nbsp;</td>
  </tr>
</table>
<?php
}

?>