<?php 
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module gestion des usagers.
/***********************************************************/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
/***
 * Cette fonction permet d'afficher le sous menu de la gestion des usagers
 */
function afficher_sous_menu($selected_rubrique) {
	$config_term = new Terminologie();
	$config_term->set_detail();
?>
<div id="sousMenu">
	<ul>
    	<li>
			<a <?php if ($selected_rubrique=="cons_liste_app") echo" class=\"selected\"" ?> href="gest_usag.php?cmd=cons_liste_app"><?php echo $config_term->terminologie_app; ?></a>
		</li> 
    	<li>
			<a <?php if ($selected_rubrique=="cons_liste_ens") echo" class=\"selected\"" ?> href="gest_usag.php?cmd=cons_liste_ens"><?php echo $config_term->terminologie_ens; ?></a>
		</li>
    	<li>
			<a <?php if ($selected_rubrique=="cons_liste_ma") echo" class=\"selected\"" ?> href="gest_usag.php?cmd=cons_liste_ma"><?php echo $config_term->terminologie_ma; ?></a> 
		</li>
<?php   if($_SESSION['parent']!="false"){ 	?><li>
			<a <?php if ($selected_rubrique=="cons_liste_rl") echo" class=\"selected\"" ?> href="gest_usag.php?cmd=cons_liste_rl"><?php echo $config_term->terminologie_rl; ?></a>
		</li> <?php } ?>
<?php   if($_SESSION['rvs']!="false"){ 	?><li>
			<a <?php if ($selected_rubrique=="cons_liste_rvs") echo" class=\"selected\"" ?> href="gest_usag.php?cmd=cons_liste_rvs"><?php echo $config_term->terminologie_rvs; ?></a>
		</li> <?php } ?>
    	<li>
			<a <?php if ($selected_rubrique=="cons_liste_admin") echo" class=\"selected\"" ?> href="gest_usag.php?cmd=cons_liste_admin"><?php echo $config_term->terminologie_admin; ?> </a>
		</li>
	</ul>		
</div>
<?php
}
?>