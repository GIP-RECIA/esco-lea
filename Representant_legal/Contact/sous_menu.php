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
			<a href="../../messagerie/reception.php">Bo&icirc;te de r&eacute;ception</a>
		</li> 
		<li>
			<a href="../../messagerie/envoi.php">Bo&icirc;te d'envoi</a>
		</li>
		<li>
			<a href="../../messagerie/corbeille.php">Corbeille</a>
		</li>
		<li>
			<a href="../../messagerie/dossiers.php">Dossiers</a>
		</li>
	</ul>		
</div> 

<?php
}

?>
