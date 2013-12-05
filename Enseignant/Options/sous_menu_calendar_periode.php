<?php
/***********************************************************/   
  // Auteur : FrÃ©dÃ©ric Goyer
  // Version : 1.0.2
  // Date: 04/07  
/***********************************************************/
function afficher_sous_menu($selected_rubrique) {  
?>
<div id="sousMenu">
	<ul>
		<li>
			<a <?php if ($selected_rubrique=="liste_periodes") echo" class=\"selected\"" ?> href="options.php?cmd=liste_periodes">Liste des p&eacute;riodes</a>
		</li>		
		<li>
			<a <?php if ($selected_rubrique=="liste_periodes_classe") echo" class=\"selected\"" ?> href="options.php?cmd=liste_periodes_classe">Mise &agrave; jour du calendrier</a>
		</li>
	</ul>		
</div>		    
<?php 
}
?>