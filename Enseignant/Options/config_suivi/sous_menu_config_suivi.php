<?php
/***********************************************************/   
  // Auteur : Frédéric Goyer
  // Version : 1.0.2
  // Date: 04/07  
/***********************************************************/
function afficher_menu($selected_rubrique, $suivi) {  
	$formation = new Formation ($_SESSION['id_for']);
	$config_lea = $formation->get_config_lea();
?>
<div id="sousMenu">
	<ul>	
		<li>
			<a <?php if ($selected_rubrique=="suivi_entr") echo" class=\"selected\"" ?> href="options.php?cmd=suivi_entr">Configurer : <?php echo $config_lea->appelation_suivi_entr; ?></a>
		</li>
		<li>
			<a <?php if ($selected_rubrique=="suivi_cfa") echo" class=\"selected\"" ?> href="options.php?cmd=suivi_cfa">Configurer : <?php echo $config_lea->appelation_suivi_cfa; ?></a>
		</li>
	</ul>		
</div>		    
<?php } ?>