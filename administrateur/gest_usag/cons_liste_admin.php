<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Ce script permet d'affcher la liste des administrateurs de lea. 
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
$les_administrateurs = $bdd->get_usagers(0,10000, "admin");				

 ?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer <?php echo($config_term->terminologie_admin); ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<?php if (count($les_administrateurs) > 0) { ?>
	<table>
      <tr class="sous_titre_tableau" >
        <th >Nom / Pr&eacute;nom</th>
        <th >Connexion</th>
        <th colspan="3">Action</th>
      </tr>
      <?php	
	 	foreach($les_administrateurs as $admin){		
          $fichier_log = $LEA_URL.'log/'.$admin->id_usager.'.log';		 
			
			  if(file_exists($LEA_REP.'log/'.$admin->id_usager.'.log'))	{
			
			  	$lien_fichier_log = "<a href='$fichier_log' target='_Blank'>
									<img src='".$URL_THEME."images/picto_fichier_log.png' border='0'>
										fichier log
								</a>";
			  }
			  else	 $lien_fichier_log = "" ;	
   echo" <tr>
        	<td >
			<a href='gest_usag.php?cmd=cons_coordonnees_usager&profil=admin&id_usager=$admin->id_usager' class='txt_grand'>
			$admin->nom &nbsp;&nbsp;$admin->prenom 
			</a>
			</td>        
        	<td>  
				$admin->date_derniere_connexion ( $admin->nombre_connexions ) 
			</td>
        		
        	<td>
				<img src='../../images/b_edit.png'>
				<a href='gest_usag.php?cmd=form_nouv_usag&profil=admin&action=modif&id_usager=$admin->id_usager'>
					Modifier 
				</a>
			</td>
	        <td><img src='../../images/b_drop.png'>
				<a href='supp_usag.php?id_usager=$admin->id_usager&profil=admin' onClick='return deleteConfirm(\"cet ".$config_term->terminologie_admin."\")'>
					Supprimer 
				</a>
			</td>
			<td>
				$lien_fichier_log
			</td>
    	</tr>";
	}
	?>
    </table>
	<?php } ?>
	<p>
		<input type="button" value="Ajouter <?php echo($config_term->terminologie_admin); ?>" onclick="document.location='./gest_usag.php?cmd=form_nouv_usag&profil=admin&action=nouv'" />
	</p>
</div>    