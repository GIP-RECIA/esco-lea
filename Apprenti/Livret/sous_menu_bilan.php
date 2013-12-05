<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du bilan des déclaration de l'apprenti

/*  Cette fonction permet d'afficher le sous menu du livret
*/

function afficher_sous_menu($selected_rubrique) {

global $URL_THEME;
global $LEA_URL;
 
?>
<div id="sousMenu" style="margin:0,0,0,0">
	<ul>
	    
    <li class="<?php if ($selected_rubrique=="suivi_libre") echo"selected" ?>" >
		<a href="livret.php?cmd=cons_dec" >Suivi libre en formation
		</a>	
	</li>
	<li class="<?php if ($selected_rubrique=="suivi_guide") echo"selected" ?>">
		  <a href='livret.php?cmd=nouv_dec&type_suivi=cfa' >Suivi guidé en formation</a>
	</li>
	</ul>
</div>
<?php
}

?>
