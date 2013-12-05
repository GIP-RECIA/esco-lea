<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
/***********************************************************/
$unite = new Unite_pedagogique($_SESSION['id_unite']); // l'unite auquelle l'usager connï¿½ctï¿½ est responsable
$les_id_formations = $unite->get_id_formations();

?>
<div id="top_l">
</div><div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer : <?php echo $config_term->terminologie_formation; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<?php 
		if (count($les_id_formations) > 0) {						
       		echo"
	<table> 
		<tr>
        	<th> Nom</th>
            <th> Responsable</th>
            <th colspan='2'>Action</th>
        </tr>";
			foreach($les_id_formations as $id_for){	  
			  $formation = new Formation($id_for);
			  $formation->set_detail();
			  $nom = $formation->nom;
			  $responsable = $formation->get_responsable();	
			
				if($responsable->id_ens==0){
					$coordonnee_ens="?";
				}else {
				$coordonnee_ens="
		<a href='../Gest_usag/gest_usag.php?cmd=cons_coordonnees_usager&profil=ens&id_ens=".$responsable->id_ens."'>
			".$responsable->nom."&nbsp;&nbsp;".$responsable->prenom."
		</a>";
				}
          		echo"
		<tr>
        	<td class=\"nom\">
				<a href='gest_clas.php?cmd=cons_form_det&id_for=".$id_for."' >
					".$nom."
				</a>
			</td>
            <td class=\"nom\">
				".$coordonnee_ens."
			</td>
            <td>
				<img src='../../images/b_edit.png'>
				<a href='gest_clas.php?cmd=nouv_form&id_for=".$id_for."'> 
					Modifier
				</a>
			</td>
            <td>
				<img src='../../images/b_drop.png'> 
				<a href='supp_form.php?id_for=".$formation->id_for."' onClick='return deleteConfirm(\"cette ".$config_term->terminologie_formation."\")'>
					Supprimer
				</a>
			</td>
		</tr>";			  
		    }//foreach
			echo"
	</table>";
	  
		 }else {
			echo "Aucune ".$config_term->terminologie_formation." n'est enregistr&eacute;e";
		 }   
          ?>
	<input type="button" value="Ajouter <?php echo $config_term->terminologie_formation;  ?>" onclick="document.location='gest_clas.php?cmd=nouv_form'" />
</div>