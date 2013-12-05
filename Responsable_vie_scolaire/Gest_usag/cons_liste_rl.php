<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Ce script permet d'affcher la liste des reprï¿½sentants lï¿½gaux de lea. 
  //          Si le nombre de  reprï¿½sentants lï¿½gaux enregistrï¿½s dï¿½passe la plage autorisï¿½e plage
  //         ($PLAGE se trouve dans config.inc.php),  une bare de pagination apparaï¿½t.
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

/***********************************************************/
$bdd = new Connexion_BDD_LEA();
	
if ( isset($_REQUEST['lettre'])){ 
	$mot_cle = $_REQUEST['lettre']; 
}elseif (isset($_REQUEST['mot_cle']) ){  
	$mot_cle = $_REQUEST['mot_cle'];
}else{ 
	$mot_cle='A';
}

$les_representants_legaux = $bdd->get_usagers(0,100000, "rl", $mot_cle);	
$nb = $bdd->get_nb_usagers("rl"); // le nombre total de reprï¿½sentants lï¿½gaux	         
?>
<div id="top_l"></div>
<div id="top_m">
  	<h1><span class="orange">G</span>&eacute;rer : <?php echo $config_term->terminologie_rl; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<?php Afficher_recherche("gest_usag.php", $mot_cle, array("cmd" =>"cons_liste_rl")); ?>
	<?php echo( count($les_representants_legaux)." / ".$nb."  ".$config_term->terminologie_rl."parents trouv&eacute;s"); ?>
	<?php if (count($les_representants_legaux) > 0) {?>
	<table>
	  	<tr>
	    	<th>Nom / Pr&eacute;nom</td>
	    	<th>T&eacute;l&eacute;phone
	    	<th colspan="3">Action</td>
	  	</tr>
	  <?php 
	  	foreach($les_representants_legaux as $rl){   	
	   		echo" 
		<tr>
	        <td class=\"nom\">
			<a href='gest_usag.php?cmd=cons_coordonnees_usager&profil=rl&id_rl=".$rl->id_usager."' class='txt_grand'>
				".$rl->nom."&nbsp;&nbsp;".$rl->prenom." 
			</a>
			</td>
			<td>".$rl->tel_fixe."</td>
	        <td><img src='../../images/picto_app.gif'>
				<a href='gest_usag.php?cmd=cons_app_suivis&id_rl=".$rl->id_usager."'>
					".$config_term->terminologie_app."s
				</a>
			</td>
	        <td >
				<img src='../../images/b_edit.png'>
				<a href='gest_usag.php?cmd=form_nouv_usag&profil=rl&action=modif&id_rl=".$rl->id_usager."'>
					Modifier 
				</a>
			</td>	
	    </tr>";
		}
		?>
	</table>
	<?php 	
	}	
	?>
	<input type="button" value="Ajouter <?php echo $config_term->terminologie_rl; ?>" onclick="document.location = 'gest_usag.php?cmd=form_nouv_usag&profil=rl&action=nouv'" />
</div>