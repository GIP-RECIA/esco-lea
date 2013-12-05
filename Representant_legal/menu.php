
<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: menu de l'interface représentant légal

/*  
	Cette fonction permet d'afficher le menu de l'interface représentant légal
*/
function afficher_menu($selected_rubrique) {
 
global $LEA_URL;
?>
<div id="sousMenu">
	<ul>
		<li class='<?php if ($selected_rubrique=="accueil") echo"selected" ?>'>
			<a href="<?php echo($LEA_URL.'Representant_legal/accueil.php')?>" >Accueil</a>
		</li>
		<li class='<?php if ($selected_rubrique=="suiv_app") echo"selected" ?>'>
			<a href="<?php echo($LEA_URL.'Representant_legal/Apprentis/apprentis.php')?>" >Suivi de vos apprentis</a>
		</li>
		<li class='<?php if ($selected_rubrique=="info_perso") echo"selected" ?>' >
			<a href="<?php echo($LEA_URL.'Representant_legal/Info_perso/info_perso.php')?>" > Info
			perso</a>
		</li>    
        <li class='<?php if ($selected_rubrique=="contact") echo"selected" ?>' >
			<a href="<?php echo($LEA_URL.'Representant_legal/Contact/contact.php')?>" >Vos messages</a>
		</li>
           
				
	</ul>
</div>

<?php
}

?>
