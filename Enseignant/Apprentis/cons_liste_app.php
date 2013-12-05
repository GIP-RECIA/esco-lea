<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
/***********************************************************/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
$enseignant = new Enseignant($_SESSION['id_ens']); // l'enseignant connectï¿½.

$formation = new Formation($_SESSION['id_for']); // la formation sï¿½lectionnï¿½e.

$config_lea	= $formation->get_config_lea();

$les_classes =  $formation->get_classes();
	
if (isset($_REQUEST['id_cla'])) $id_cla_select = $_REQUEST['id_cla'];
//elseif(count($les_classes) > 0 ) $id_cla_select = $les_classes[0]->id_cla;
else $id_cla_select = -1;

$classe_select = new Classe($id_cla_select);
$classe_select->set_detail();

if($id_cla_select!=-1 && $classe_select->id_for != $formation->id_for) {
	include($LEA_REP.'erreur.php'); exit();
}
										
$les_apprentis = $classe_select->get_apprentis(); // les apprentis affectï¿½s ï¿½ cette classe	
?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">S</span>uivi par <?php echo"$config_lea->appelation_app" ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form name="theForm" action="apprentis.php"  method="GET">
  		<input type='hidden' name='cmd' value='cons_liste_app'>
		<?php echo($config_lea->appelation_classe);?> 
		<select name="id_cla" size="1" onChange="this.form.submit()" >
  			<option value='-1' selected >-- S&eacute;lectionnez: <?php echo($config_lea->appelation_classe);?> -- </option>
 			<?php
				foreach($les_classes as $classe){
					if($classe->id_cla == $id_cla_select) $selected = "selected";
					else $selected = "";
				
					echo"<option value='$classe->id_cla' $selected > $classe->libelle </option>";				}
			?>
		</select> 
	</form>
	<p>
		<?php if (count($les_apprentis) > 0) { ?>
	</p>
	<p>
		<?php
		/* 	echo"<img src='".$URL_THEME."images/ico_performance.png' >";  
			echo"	<a href='".$LEA_URL."Apprenti/Livret/bilan_app.php?id_app_select=$declaration->id_app' target='_blank'>
		 			Synth&eacute;se de toutes les d&eacute;clarations de l'apprenti
		   	</a>
		";	
		*/						   	
	?>
	</p>
	<table width="95%" height="96" cellspacing="0" >
  		<tr >
    		<th width="2%" height="30">&nbsp;</th>
			<th width="20%"><?php echo "$config_lea->appelation_app"; ?></th>
    		<th width="21%"><?php echo ($config_lea->appelation_tuteur_cfa); ?></th>
    		<th><?php echo $config_lea->appelation_entr; ?></th>
    		<th>Action</th>
		</tr>
		<?php 
			foreach($les_apprentis as $apprenti){          		   
				$ma = new Maitre_apprentissage($apprenti->id_ma);
				$ma->set_detail();
				
				$entreprise = new Entreprise( $ma->id_entr);
				$entreprise->set_detail();
				
				$tuteur = new Enseignant($apprenti->id_ens);
				$tuteur->set_detail();  
		?>
  		<tr>
    		<td height="22" align="center">
     		<?php
				if($apprenti->id_ens == $enseignant->id_ens)
				echo'<img src="'.$URL_THEME.'images/picto_app.gif" title="vous &ecirc;tes le '.$config_lea->appelation_tuteur_cfa.' de cet '.$config_lea->appelation_app.'">';
			?>
    		</td>
    		<td>
    			<p> 
    				<a href='apprentis.php?cmd=cons_coordonnees_app&id_app_select=<?php echo"$apprenti->id_app"?>' title="coordonn&eacute;es"> 
						<?php echo"$apprenti->nom &nbsp;&nbsp;&nbsp;$apprenti->prenom"; ?> 
					</a> 
				</p>  
			</td>
    		<td> 
    			<p>
				<?php 
				  	if($tuteur->id_ens > 0) {
						echo"<a href=\"apprentis.php?cmd=cons_coordonnees_ens&id_ens_select=$tuteur->id_ens\">
								$tuteur->nom &nbsp; $tuteur->prenom
							 </a>";					 
				  	}else {
				  		echo"?";
				  	}
			  	?>
		 		</p>  
	  		</td>
    		<td width="24%">
				<p> 
	 				<?php 
	 					if($entreprise->nom !='') {
				  			echo"<a href=\"apprentis.php?cmd=cons_coordonnees_ma&id_ma_select=$ma->id_ma#entreprise\">
				  				$entreprise->nom</a>"; 
		 				}else{
		 					echo "?";	
		 				}
					?>	  
				</p>
			</td>
			<td width="33%">
				<p>
					<img src="<?php echo($URL_THEME.'images/picto_browse.png') ?>"> 
					<a href='apprentis.php?cmd=cons_dec_app&id_app_select=<?php echo"$apprenti->id_app"?>'> 
						Consulter <?php echo $config_term->terminologie_lea; ?>
					</a>
				</p>
			</td>
  		</tr>
  		<?php  } ?>
	</table>
	<p>
		<?php
		 /* echo '<a href="apprentis.php?cmd=nouv_dec&id_cla='.$classe->id_cla.'"> 
					Remplir le livret de vos apprentis de cette classe 
			   </a>';
		*/
			}elseif($id_cla_select!='-1') echo("Aucune association: ".$config_lea->appelation_app." / ".$config_lea->appelation_classe);				
		?>
	</p>
</div>