<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module gestion des contacts.

/*  Cette fonction permet d'afficher le sous menu de la gestion des enstreprises   
*/

function afficher_sous_menu($selected_rubrique) {
 
?>

<div id="sousMenu">
	<ul>
    	<li class="<?php if ($selected_rubrique=="cons_cours") echo"selected" ?>">
			<a href="cours.php?cmd=cons_cours">Vos cours</a>
		</li> 
		<li class="<?php if ($selected_rubrique=="cons_mat") echo"selected" ?>">
			<a href="cours.php?cmd=cons_mat">Les mati&egrave;res par formation</a>
		</li>
		<li class="<?php if ($selected_rubrique=="cons_mod_tach") echo"selected" ?>">
			<a href="cours.php?cmd=cons_mod_tach">R&eacute;f&eacute;rentiels m&eacute;tier</a>
		</li>
	</ul>		
</div>	
	
<?php
}

?>
