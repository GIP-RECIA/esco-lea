<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05  

/*  Cette fonction permet d'afficher le sous menu de la gestion des unités pédagogiuques 
*/

function afficher_sous_menu($selected_rubrique) {
 
?>

<div id="sousMenu">
	<ul>
    	<li class="<?php if ($selected_rubrique=="cons_doc") echo"selected" ?>">
			<a href="gest_doc.php?cmd=cons_doc">Consulter les documents  </a>
		</li> 
		<li class="<?php if ($selected_rubrique=="maj_doc") echo"selected" ?>">
			<a href="gest_doc.php?cmd=maj_doc"> Nouveau document </a>
		</li>
	</ul>		
</div>		    

<?php
}

?>