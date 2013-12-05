<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module info perso

function afficher_sous_menu($selected_rubrique) {
 
?>

<div id="sousMenu">
	<ul>
    	<li>
			<a <?php if ($selected_rubrique=="cons_coordonnees") echo" class=\"selected\"" ?> href="info_perso.php?cmd=cons_coordonnees">Consulter vos coordonn&eacute;es</a>
		</li> 
		<li>
			<a <?php if ($selected_rubrique=="modif_coordonnees") echo" class=\"selected\"" ?> href="info_perso.php?cmd=modif_coordonnees">Modifier vos coordonn&eacute;es</a>
		</li>
	</ul>		
</div>
	
<?php
}

?>
