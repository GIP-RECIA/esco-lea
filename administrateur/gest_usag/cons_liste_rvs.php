<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/02/05
  // Contenu: Ce script permet d'affcher la liste des responsable vie scolaire de lea. 
  //          Si le nombre d'administrateur enregistrï¿½s dï¿½passe la plage autorisï¿½e plage
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
require_once ($LEA_REP."modele/bdd/classe_usager.php");
/***********************************************************/
	
$bdd = new Connexion_BDD_LEA();

$les_rvs = $bdd->get_usagers(0,1000, "rvs");

?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer <?php echo($config_term->terminologie_rvs); ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
<?php if (count($les_rvs) > 0) {	?>
<table >
  <tr >
    <th width='25%'>Nom</th>
    <th width='17%'>Unit&eacute;</th>
    <th width='17%'>Connexion</th>
    <th width='41%' colspan="3">Action</th>
  </tr>
  <?php 
	foreach($les_rvs as $rvs){	
		$les_unites = $rvs->get_unites(); // les unites pï¿½dagogiques auquelles cet usagerc est responsable
		
		$les_noms_unites = "";
		
		foreach($les_unites as $unite) {
			$les_noms_unites .= "<p>".$unite->nom."</p>";
		}		
				$fichier_log = $LEA_URL.'log/'.$rvs->id_usager.'.log';		 
			
			  if(file_exists($LEA_REP.'log/'.$rvs->id_usager.'.log'))	{
			
			  	$lien_fichier_log = "<a href='$fichier_log' target='_Blank'>
									<img src='".$URL_THEME."images/picto_fichier_log.png' border='0'>
										fichier log
								</a>";
			  }
			  else	 $lien_fichier_log = "" ;
          	
   echo" <tr>
        	<td class='cellule'> 
				<a href='gest_usag.php?cmd=cons_coordonnees_usager&profil=rvs&id_usager=".$rvs->id_usager."'>
					".$rvs->nom."&nbsp;&nbsp;".$rvs->prenom." 
				</a>
			</td>        
			<td> ".$les_noms_unites." </td>
			<td>".$rvs->date_derniere_connexion." ( ".$rvs->nombre_connexions." )</td>			
        	<td><img src='../../images/b_edit.png'>
				<a href='gest_usag.php?cmd=form_nouv_usag&profil=rvs&action=modif&id_usager=".$rvs->id_usager."'>
					Modifier 
				</a>
			</td>
	        <td><img src='../../images/b_drop.png'>
				<a href='supp_usag.php?id_usager=".$rvs->id_usager."&profil=rvs' onClick='return deleteConfirm(\"cet ".$config_term->terminologie_admin."\")'>
					Supprimer 
				</a>
			</td>
			<td>
				".$lien_fichier_log."
			</td>
    	</tr>";
	} 
	?>
</table>
<?php }else echo "Aucun ".$config_term->terminologie_rvs." n'est enregistr&eacute;"; ?>
<p>
<input type="button" value="Ajouter <?php echo($config_term->terminologie_rvs); ?>" 
		onclick="document.location='gest_usag.php?cmd=form_nouv_usag&profil=rvs&action=nouv'" />
</p>
</div>