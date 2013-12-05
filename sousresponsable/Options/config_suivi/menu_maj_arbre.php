<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: menu de l'interface maitre apprentissage.

/*  Cette fonction permet d'afficher le menu de l'interface maitre apprentissage. 
*/

function afficher_menu_maj_arbre($selected_rubrique) {
 
	global $LEA_URL;
	global $URL_THEME;
	global $arbre;
?>
<div id="sousMenu3">
	<ul>
		<li>			
			
			<a <?php if ($selected_rubrique=="modifier") echo" class=\"selected3\"" ?> href="./options.php?cmd=maj_arbre&id_arbre=<?php echo "$arbre->id_arbre"; ?>&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" >							
				<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_edit.png') ?>" border="0"> Modifier le contenu 
			</a>			
		</li>
        <li>
	
			<a <?php if ($selected_rubrique=="modifier_niveaux") echo" class=\"selected3\"" ?> href="./options.php?cmd=modifier_arbre&id_arbre=<?php echo "$arbre->id_arbre"; ?>&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" >
				<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_edit.png') ?>" border="0"> Modifier l'intitul&eacute; 
			</a>    			
		</li>
		<li>
			
			<a  href="./config_suivi/supprimer_arbre.php?action=supprimer&id_arbre=<?php echo "$arbre->id_arbre"; ?>&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" onClick="return deleteConfirm('cet arbre')" >
			   <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_drop.png') ?>" border="0"> Supprimer 
			</a>
    			
		</li>   
		<li>			
			
			<a href="./config_suivi/supprimer_arbre.php?action=vider&id_arbre=<?php echo "$arbre->id_arbre"; ?>&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" onClick="return vidageConfirm('cet arbre')" >
		  <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_corbeille.png') ?>" border="0"> Vider                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       </a>    			
		</li>  
	</ul>
	<ul> 
		<li>
											
			<a <?php if ($selected_rubrique=="afficher") echo" class=\"selected3\"" ?> href="./options.php?cmd=afficher_arbre&id_arbre=<?php echo "$arbre->id_arbre"; ?>&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" >			 
			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_afficherOUarborescence.png') ?>" border="0"> Afficher
			</a>					
		</li>   
		<li>						
			
			<a <?php if ($selected_rubrique=="validation") echo" class=\"selected3\"" ?> href="./options.php?cmd=mode_validation_arbre&id_arbre=<?php echo "$arbre->id_arbre"; ?>&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" >			
			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_valider.png') ?>" border="0"> Validation
			</a>					
		</li>  
		<li>						
			
			<a <?php if ($selected_rubrique=="performance") echo" class=\"selected3\"" ?> href="./options.php?cmd=criteres_performance&id_arbre=<?php echo "$arbre->id_arbre"; ?>&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" >			
			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_performance.png') ?>" border="0"> Performance
			</a>					
		</li>  
 		<li>						
			
			<a <?php if ($selected_rubrique=="param_critere") echo" class=\"selected3\"" ?> href="./options.php?cmd=param_critere&id_arbre=<?php echo "$arbre->id_arbre"; ?>&type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" >			
			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/config_ico.png') ?>" border="0"> Param&eacute;trage des crit&egrave;res
			</a>					
		</li>
	</ul>
</div>
<?php
}
?>


