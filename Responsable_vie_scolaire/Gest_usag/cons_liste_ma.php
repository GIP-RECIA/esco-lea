<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Ce script permet d'affcher la liste des maitres d'apprentissage de lea. 
  //          Si le nombre de  maitres d'apprentissage enregistrï¿½s dï¿½passe la plage autorisï¿½e plage
  //         ($PLAGE se trouve dans config.inc.php),  une bare de pagination apparaï¿½t.
/***********************************************************/
include_once("../secure.php");
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
/***********************************************************/
$bdd = new Connexion_BDD_LEA();
	
if ( isset($_REQUEST['lettre']) ){ 
	$mot_cle = $_REQUEST['lettre']; 
}elseif (isset($_REQUEST['mot_cle'])){  
	$mot_cle = $_REQUEST['mot_cle'];
}else{ 
	$mot_cle='A';
}

$les_maitres_apprentissage = $bdd->get_usagers(0,100000, "ma",$mot_cle);
		
$nb = $bdd->get_nb_usagers("ma"); // le nombre total de maitres d'apprentissage 	            
 ?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer : <?php echo $config_term->terminologie_ma; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<div id="search">
		<?php Afficher_recherche("gest_usag.php", $mot_cle, array("cmd" =>"cons_liste_ma")); ?>
	</div>
	<p>
		<?php echo count($les_maitres_apprentissage)." / ".$nb." ".$config_term->terminologie_ma." trouv&eacute;s"; ?>
	</p>
	<?php if (count($les_maitres_apprentissage) > 0) {?>
	<table>
		<tr>
			<th>Nom / Pr&eacute;nom</th>
        	<th>T&eacute;l&eacute;phone</th>
        	<th colspan="3">Actions</th>
		</tr>
		<?php 
			foreach($les_maitres_apprentissage as $ma){     

	   			echo"
		<tr>
        	<td class=\"nom\">
				<a href=\"gest_usag.php?cmd=cons_coordonnees_usager&profil=ma&id_ma=".$ma->id_ma."\">
					".$ma->nom."&nbsp;&nbsp;".$ma->prenom."
				</a>
			</td>        
			<td>".$ma->tel_fixe."</td>
	       	<td>
				<img src=\"../../images/picto_app.gif\" />
				<a href=\"gest_usag.php?cmd=cons_app_suivis&id_ma=".$ma->id_ma."\">
					".$config_term->terminologie_app."s
				</a>
			</td>
    	    <td>
				<img src=\"../../images/b_edit.png\" />
				<a href=\"gest_usag.php?cmd=form_nouv_usag&profil=ma&action=modif&id_ma=".$ma->id_ma."\">
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
	<input type="button" value="Ajouter <?php echo $config_term->terminologie_ma; ?>"
		onclick="document.location='gest_usag.php?cmd=form_nouv_usag&profil=ma&action=nouv'" />
</div>