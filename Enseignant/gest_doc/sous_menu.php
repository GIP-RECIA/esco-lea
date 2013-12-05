<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05  

/*  Cette fonction permet d'afficher le sous menu de la gestion des unitï¿½s pï¿½dagogiuques 
*/
function afficher_sous_menu($selected_rubrique) {
?>
<div id="sousMenu">
	<ul>
    	<li>
			<a <?php if ($selected_rubrique=="cons_doc") echo" class=\"selected\"" ?> href="gest_doc.php?cmd=cons_doc">Documents</a>
		</li> 
		<li>
			<a <?php if ($selected_rubrique=="cons_categ") echo" class=\"selected\"" ?> href="gest_doc.php?cmd=cons_categ"> Cat&eacute;gories de documents </a>
		</li>
	</ul>		
</div>		    
<?php
}
?>