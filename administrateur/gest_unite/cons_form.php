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

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
/***********************************************************/
$bdd = new Connexion_BDD_LEA();	  	      		  		 		  

$les_unites = $bdd->get_all_unites_pedagogiques();

if(isset($_REQUEST['id_unite_select'])&& $_REQUEST['id_unite_select'] > 0) { 
	$id_unite_select = $_REQUEST['id_unite_select'];
	$unite = new Unite_pedagogique($id_unite_select); 
	$les_id_formations = $unite->get_id_formations();
}else {
	$id_unite_select = 0;
	$unite = new Unite_pedagogique(0); 
	$les_id_formations = $bdd->get_id_formations();
}
?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer <?php echo($config_term->terminologie_formation); ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu"> 
<br />
    <form name="form1" method="get" action="">
			<input type="hidden" name="cmd" value="cons_form" />
			<?php  if(count($les_unites) > 0) { ?>   
			<?php echo($config_term->terminologie_unit_pedag); ?> 
			 <select name="id_unite_select" size="1" onChange="this.form.submit()">
		 	 	<option value='0' >----- Toutes les <?php echo $config_term->terminologie_formation; ?>s des <?php echo $config_term->terminologie_unit_pedag; ?>s  ------</option>
            <?php			
			 	foreach($les_unites as $unite) {				
					if ($unite->id_unite == $id_unite_select){
						$selected="selected=\"selected\"";
					}else{
						$selected="";
					}
					echo "
				<option value='".$unite->id_unite."' $selected>".$unite->nom." </option>";	 
			 	}//foreach
			 
			 ?>
          </select>
      <?php  
	  	}else { 
			echo "Aucune ".$config_term->terminologie_unit_pedag." n'est enregistr&eacute;e <br /><br />";  	
			echo"<input type=\"button\" value=\"Ajouter ".$config_term->terminologie_unit_pedag."\" onclick=\"document.location='./gest_unite.php?cmd=nouv_unite'\" />";		 	
		}
 		?>
	</form>
	<?php 
		if (count($les_id_formations) > 0) {
	   		echo"  
		<table>	   							
       		<tr>
            	<th >Nom de la ".$config_term->terminologie_formation."</th>
                <th >".$config_term->terminologie_rf."</th>
                <th colspan='3' > Action</th>
            </tr>";
			  
			foreach($les_id_formations as $id_for){	  
			  	$formation = new Formation($id_for);
			  	$formation->set_detail();
			  	$nom = $formation->nom;
			  	$responsable = $formation->get_responsable();	
			
				if($responsable->id_ens==0){
					$coordonnee_ens="?";
				}else{
					$coordonnee_ens="
			<a href='../gest_usag/gest_usag.php?cmd=cons_coordonnees_usager&profil=ens&id_ens=".$responsable->id_ens."'>
				".$responsable->nom." &nbsp;&nbsp;".$responsable->prenom." 
			</a>";
				}
          echo"
			<tr>
                <td  class='nom'>
					<a href='gest_unite.php?cmd=cons_form_det&id_for=".$id_for."'  >
						".$nom."
					</a>
				</td>
                <td class='nom'>
				".$coordonnee_ens."
				</td>
				<td>
					<img src=\"../../images/b_browse.png\" />
					<a href=\"gest_unite.php?cmd=cons_clas&id_for=".$formation->id_for."\">Consulter ses ".$config_term->terminologie_classe."s</a>

				</td>
                <td >
					<img src='../../images/b_edit.png'>
					<a href='gest_unite.php?cmd=nouv_form&id_for=".$id_for."'> 
						Modifier
					</a>
				</td>
                <td ><img src='../../images/b_drop.png'> 
					<a href='supp_form.php?id_for=".$formation->id_for."' onClick='return deleteConfirm(\" : ".$config_term->terminologie_formation."\")'>
					Supprimer
					</a>
				</td>
				  
              </tr>";				  
		    }
			echo"
		</table>";
	  
		 } elseif($id_unite_select != 0) {
			echo"Aucune ".$config_term->terminologie_formation." n'est enregistr&eacute;e";
		 }
		         
	?>  
	<br /><br />	
    <?php 
		if( count($les_unites) > 0) {  				
			echo"
	<input type=\"button\" value=\"Ajouter ".$config_term->terminologie_formation."\" onclick=\"document.location='./gest_unite.php?cmd=nouv_form&id_unite=".$id_unite_select."'\" />";
		}			 	
	?>
</div>