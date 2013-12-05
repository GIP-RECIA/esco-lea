<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Ce script permet d'affcher la liste des enseignant du lea. 
  //          Si le nombre d'enseignants enregistrï¿½s dï¿½passe la plage autorisï¿½e plage
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
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

/***********************************************************/
$bdd = new Connexion_BDD_LEA();
	
if ( isset($_REQUEST['lettre']) ) $mot_cle = $_REQUEST['lettre']; 
elseif (isset($_REQUEST['mot_cle']) )  $mot_cle = $_REQUEST['mot_cle'];
else $mot_cle='A';


	$les_enseignants = $bdd->get_usagers(0, 10000, "ens", $mot_cle);
	$nb = $bdd->get_nb_usagers("ens"); // le nombre total d'enseignants 		

 ?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer <?php echo($config_term->terminologie_ens); ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
<?php Afficher_recherche("gest_usag.php", $mot_cle, array("cmd" =>"cons_liste_ens")); ?>
<br>
<p>    
	<input type="button" value="Ajouter <?php echo $config_term->terminologie_ens; ?>" 
		onclick="document.location='gest_usag.php?cmd=form_nouv_usag&profil=ens&action=nouv'" />
	<?php
		if(count($les_enseignants) > 0) {
			echo"<input type=\"button\" value=\"Supprimer ".$config_term->terminologie_ens."\" onclick=\"if(deleteConfirm('tous ".$config_term->terminologie_ens." affich&eacute;s')) document.location='supp_all_usagers.php?profil=ens&mot_cle=".$mot_cle."'\" />";
			echo"
	<input type=\"button\" value=\"Imprimer les mots de passe\" 
		onclick=\"document.location='imprimer_mdp_usagers.php?profil=ens&mot_cle=".$mot_cle."'\" />";
		}
		?>
</p>
<br>
<?php echo"
<p>".
	count($les_enseignants)." / $nb  enseignants trouv&eacute;s 
</p>"; 
		if(count($les_enseignants) > 0) { ?>
<table>
  <tr >
    <th width='23%' >Nom / Pr&eacute;nom </th>
    <th width='17%'> Connexion</th>
    <th width='60%' colspan="3">Action</th>
  </tr>
  <?php 
	foreach($les_enseignants as $enseignant){
    
	       $nb = $enseignant->get_nb_apprentis();
		   
		    $fichier_log = $LEA_URL.'log/'.$enseignant->id_ens.'.log';		 
			
			  if(file_exists($LEA_REP.'log/'.$enseignant->id_ens.'.log'))	{
			
			  	$lien_fichier_log = "
	<a href='$fichier_log' target='_Blank'>
		<img src='".$URL_THEME."images/picto_fichier_log.png' border='0'>
		fichier log
	</a>";
			  }
			  else	 $lien_fichier_log = "" ;	
  
   echo" 
		<tr>
        	<td class=\"nom\">
				<a href='gest_usag.php?cmd=cons_coordonnees_usager&profil=ens&id_ens=$enseignant->id_usager' class='txt_grand'>
					$enseignant->nom &nbsp;&nbsp;$enseignant->prenom 
				</a>
			</td>        	        
			<td>$enseignant->date_derniere_connexion ( $enseignant->nombre_connexions )</td>
        	<td>
				<img src=\"../../images/picto_app.gif\" />
				<a href='gest_usag.php?cmd=cons_app_suivis&id_ens=$enseignant->id_usager'>
					Ses ".$config_term->terminologie_app."s ($nb)
				</a>
			</td>
        	<td>
				<img src=\"../../images/b_edit.png\" />
				<a href='gest_usag.php?cmd=form_nouv_usag&profil=ens&action=modif&id_ens=$enseignant->id_usager'>
					Modifier 
				</a>
						
	            <img src=\"../../images/b_drop.png\" />
				<a href='supp_usag.php?id_usager=$enseignant->id_usager&profil=ens' onClick='return deleteConfirm(\"cet ".$config_term->terminologie_ens."\")'>
					Supprimer 
				</a>
				 $lien_fichier_log
			</td>
    	</tr>";
	}
	?>
</table>
<?php } ?>
</div>