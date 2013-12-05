<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module gestion des classes.

/*  Cette fonction permet d'afficher le sous menu de gestion des classes   
*/

function afficher_sous_menu($selected_rubrique) {
 
?>

<div id="sousMenu">
  <ul><li>
		<a <?php if ($selected_rubrique=="cons_form") echo" class=\"selected\"" ?> href="gest_clas.php?cmd=cons_form">Consulter les formations</a> 
	  </li>
	  <li>
		  <a <?php if ($selected_rubrique=="nouv_clas") echo" class=\"selected\"" ?> href="gest_clas.php?cmd=nouv_clas">Cr&eacute;er une nouvelle classe</a>
	  </li>
	  <li>
		  <a <?php if ($selected_rubrique=="cons_clas") echo" class=\"selected\"" ?> href="gest_clas.php?cmd=cons_clas">Consulter les classes</a> 
	  </li>
	  <li>
		  <a <?php if ($selected_rubrique=="operations") echo" class=\"selected\"" ?> href="gest_clas.php?cmd=operations">Op&eacute;rations</a>
	  </li>
	</ul>		
</div>
	
<?php
}

?>