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

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
/***********************************************************/
	
$bdd = new Connexion_BDD_LEA();
	
if ( isset($_REQUEST['lettre']) ) $mot_cle = $_REQUEST['lettre']; 
elseif (isset($_REQUEST['mot_cle']) )  $mot_cle = $_REQUEST['mot_cle'];
else $mot_cle='A';

$les_maitres_apprentissage = $bdd->get_usagers(0,100000, "ma",$mot_cle);
		
$nb = $bdd->get_nb_usagers("ma"); // le nombre total de maitres d'apprentissage 
		            
 ?>
<div id="top_l"></div>
<div id="top_m">
<h1><span class="orange">G</span>&eacute;rer <?php echo($config_term->terminologie_ma); ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
<?php Afficher_recherche("gest_usag.php", $mot_cle, array("cmd" =>"cons_liste_ma")); ?>
<br><p>
	<input type="button" value="Ajouter <?php echo($config_term->terminologie_ma); ?>" 
		onclick="document.location='gest_usag.php?cmd=form_nouv_usag&profil=ma&action=nouv'" />
	<?php
		if(count($les_maitres_apprentissage) > 0) {
		
		echo"<input type=\"button\" value=\"Supprimer tous les ".$config_term->terminologie_ma."\" onclick=\"if(deleteConfirm('tous ".$config_term->terminologie_ma."')) document.location='supp_all_usagers.php?profil=ma&mot_cle=".$mot_cle."'\" />";
	
		echo"
	<input type=\"button\" value=\"Imprimer les mots de passe\" 
		onclick=\"document.location='imprimer_mdp_usagers.php?profil=ma&mot_cle=".$mot_cle."'\" />";	 
		}
	?>
</p><br>
<p><?php echo count($les_maitres_apprentissage)." / $nb ".$config_term->terminologie_ma." trouv&eacute;s"; ?></p>

<?php if (count($les_maitres_apprentissage) > 0) {?>
<table>
	<tr>
	    <th width='23%' >Nom / Pr&eacute;nom </th>
	    <th width='17%'> Connexion</th>
	    <th width='60%' colspan="3">Action</th>
	</tr>
	<?php 
	
	foreach($les_maitres_apprentissage as $ma){ 
	    
		 $fichier_log = $LEA_URL.'log/'.$ma->id_ma.'.log';		 
			
			  if(file_exists($LEA_REP.'log/'.$ma->id_ma.'.log'))	{
			
			  	$lien_fichier_log = "<a href='$fichier_log' target='_Blank'>
									<img src='".$URL_THEME."images/picto_fichier_log.png' border='0'>
										fichier log
								</a>";
			  }
			  else	 $lien_fichier_log = "" ;	

	   echo"<tr>
        		<td class=\"nom\">
					<a href=\"gest_usag.php?cmd=cons_coordonnees_usager&profil=ma&id_ma=".$ma->id_ma."\">".$ma->nom."&nbsp;&nbsp;".$ma->prenom."</a>
				</td>        
				<td>".$ma->date_derniere_connexion." ( ".$ma->nombre_connexions." )</td>
	       		<td>
					<img src=\"../../images/picto_app.gif\" />
					<a href=\"gest_usag.php?cmd=cons_app_suivis&id_ma=".$ma->id_ma."\">".$config_term->terminologie_app."</a>
				</td>
    	    	<td>
					<img src=\"../../images/b_edit.png\" />
					<a href=\"gest_usag.php?cmd=form_nouv_usag&profil=ma&action=modif&id_ma=$ma->id_ma\">Modifier</a>				
					<img src=\"../../images/b_drop.png\" />
					<a href=\"supp_usag.php?id_usager=".$ma->id_ma."&profil=ma\" onclick='return deleteConfirm(\"ce ".$config_term->terminologie_ma."\")'>Supprimer</a>
					".$lien_fichier_log."
				</td>
    		</tr>";
	}
	?>	  
</table>
	<?php 		
	}	
	?> 
</div>