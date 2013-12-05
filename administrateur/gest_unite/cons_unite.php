<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 25/08/05
  // Contenu: ce script permet d'afficher la liste des unites enregistrï¿½es par formation 
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
require_once($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
/***********************************************************/
$bdd = new Connexion_BDD_LEA();	  	      		  		 		  

$les_unites = $bdd->get_all_unites_pedagogiques();	  		
?>		
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer <?php echo $config_term->terminologie_unit_pedag; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu"> 
	<form action="gest_unite.php?cmd=cons_unite" method="post">
	    <?php
		if (count($les_unites) > 0){		
		?>
	    <table>
			<tr>
	       		<th>Nom</th>
	            <th>Nom du <?php echo $config_term->terminologie_rvs; ?></th>
	            <th>T&eacute;lephone</th>
	            <th colspan="3" width="50%">Actions</th>
			</tr>
	        <?php			  
				foreach($les_unites as $unite){
					$les_id_responsables = $unite->get_id_responsables(); 										 
						
					$liste_rvs = "
					<ul>"; // liste des responsables vie scolaire de cette unitï¿½
						 
					foreach($les_id_responsables as $id_rvs ){
					 	$rvs = new Usager($id_rvs);
						$rvs->set_detail();
						$liste_rvs .= "
						<li>
							<a href=\"../gest_usag/gest_usag.php?cmd=cons_coordonnees_usager&profil=rvs&id_usager=$rvs->id_usager\">$rvs->nom &nbsp;&nbsp; $rvs->prenom</a>
						</li>";
					}//foreach2
					$liste_rvs .= "
					</ul>";
					if(count($les_id_responsables)==0){
						$liste_rvs ='?';
					}
					echo"
			<tr>
				<td class=\"nom\">
					<a href=\"gest_unite.php?cmd=cons_unite_det&id_unite=$unite->id_unite\">$unite->nom</a>
				</td>
				<td class=\"nom\">
					".$liste_rvs."
				</td>
				<td>".$unite->tel_fixe1."</td>
				<td>
					<img src=\"../../images/b_browse.png\" />
					<a href=\"gest_unite.php?cmd=cons_form&id_unite_select=".$unite->id_unite."\">
						Consulter ses ".$config_term->terminologie_formation."s
					</a>
				</td>
				<td>
					<img src=\"../../images/b_edit.png\" />
					<a href=\"gest_unite.php?cmd=modif_unite&id_unite=".$unite->id_unite."\">
						Modifier	
					</a>
				</td>
				<td>
					<img src=\"../../images/b_drop.png\" />
					<a href=\"supp_unite.php?id_unite=".$unite->id_unite."\" onclick=\"return deleteConfirm('cette ".$config_term->terminologie_unit_pedag."')\">
						Supprimer
					</a>
				</td>
			</tr>";	                
				}//foreach1
				?>
	    <?php
			}else {
				echo "Aucune ".$config_term->terminologie_unit_pedag." n'est enregistr&eacute;e";
			}   		
		?>
		</table>
		<?php    
			echo"<input type=\"button\" value=\"Ajouter ".$config_term->terminologie_unit_pedag."\" onclick=\"document.location='./gest_unite.php?cmd=nouv_unite'\" />";		 	
		?>      
	</form>
</div>