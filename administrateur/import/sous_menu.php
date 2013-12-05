<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module gestion des usagers.

/*  Cette fonction permet d'afficher le sous menu de la gestion des usagers   
*/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");


function afficher_sous_menu($selected_rubrique) {
 $config_term = new Terminologie();
$config_term->set_detail();
 
?>							

<div id="sousMenu">
	<ul>
    	<li>
			<a <?php if ($selected_rubrique=="import_data_app") echo" class=\"selected\"" ?> href="import.php?cmd=import_data_app">Importer <?php echo($config_term->terminologie_app); ?></a>		</li> 
		<li>
			<a <?php if ($selected_rubrique=="import_data_ens") echo" class=\"selected\"" ?> href="import.php?cmd=import_data_ens">Importer <?php echo($config_term->terminologie_ens); ?></a>		</li>
	</ul>		
</div>
		    
<?php
}

?>