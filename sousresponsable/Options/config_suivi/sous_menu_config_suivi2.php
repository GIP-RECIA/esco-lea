<?php
/***********************************************************/   
  // Auteur : FrÃ©dÃ©ric Goyer
  // Version : 1.0.2
  // Date: 04/07  
/***********************************************************/
function afficher_menu2($selected_rubrique, $suivi) {  
?>
<div id="sousMenu2">
	<ul>
		<?php 
			if($_GET['suivi'] == "tous"){ 
				$selected_rubrique = "suivi_".$_GET['selmenu'];
		?>	
		<li>
			<a <?php if ($selected_rubrique=="suivi_libre") echo" class=\"selected2\"" ?> href="options.php?cmd=suivi_libre_<?php echo $suivi."&type_suivi=".$_GET['type_suivi']."&suivi=tous&selmenu=libre"; ?>">Cr&eacute;ation de modalit&eacute; de saisie (Suivi Libre)</a>
		</li>
		<li>
			<a <?php if ($selected_rubrique=="suivi_guide") echo" class=\"selected2\"" ?> href="options.php?cmd=suivi_guide_<?php echo $suivi."&type_suivi=".$_GET['type_suivi']."&suivi=tous&selmenu=guide"; ?>">Cr&eacute;ation / S&eacute;lection d'arbre (Suivi Guid&eacute;)</a>
		</li>
		<?php } elseif($_GET['suivi'] == "guide") { ?>
		<li>
			<a <?php if ($selected_rubrique=="suivi_guide") echo" class=\"selected2\"" ?> href="options.php?cmd=suivi_guide_<?php echo $suivi."&type_suivi=".$_GET['type_suivi']."&suivi=guide&selmenu=guide"; ?>">Cr&eacute;ation / S&eacute;lection d'arbre (Suivi Guid&eacute;)</a>
		</li>
		<?php } else {?>
		<li>
			<a <?php if ($selected_rubrique=="suivi_libre") echo" class=\"selected2\"" ?> href="options.php?cmd=suivi_libre_<?php echo $suivi."&type_suivi=".$_GET['type_suivi']."&suivi=libre&selmenu=libre"; ?>">Cr&eacute;ation de modalit&eacute; de saisie (Suivi Libre)</a>
		</li>
		<?php } ?>
	</ul>		
</div>
<?php } ?>