<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05  
/***********************************************************/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
/***
 * Cette fonction permet d'afficher le sous menu de la gestion des unitï¿½s pï¿½dagogiuques
 */
function afficher_sous_menu($selected_rubrique) {
 $config_term = new Terminologie();
$config_term->set_detail();
?>
<div id="sousMenu">
	<ul>
    	<li>
			<a <?php if ($selected_rubrique=="cons_unite") echo" class=\"selected\"" ?> href="gest_unite.php?cmd=cons_unite">G&eacute;rer : <?php echo $config_term->terminologie_unit_pedag; ?></a>
		</li> 
		<li>
			<a <?php if ($selected_rubrique=="cons_form") echo" class=\"selected\"" ?> href="gest_unite.php?cmd=cons_form">G&eacute;rer : <?php echo $config_term->terminologie_formation; ?></a>
		</li>
	</ul>		
</div>		    
<?php
}
?>