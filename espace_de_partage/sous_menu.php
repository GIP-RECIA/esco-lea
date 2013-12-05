<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module gestion des contacts.


function afficher_sous_menu($selected_rubrique) {
 
?>
<div id="sousMenu">
  <ul>  
	<li>
		<a <?php if ($selected_rubrique=="consulter_espace") echo" class=\"selected\"" ?> href="consult_espace.php?cmd=consulter_espace">Consulter ses espaces</a>
	</li>
    <li> 
	  	<a <?php if ($selected_rubrique=="creer_espace") echo" class=\"selected\"" ?> href="consult_espace.php?cmd=creer_espace">Cr&eacute;er un espace</a> 
	</li>  
	</ul>		
</div>	 

<?php
}

?>
