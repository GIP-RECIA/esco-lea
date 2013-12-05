<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 25/08/05
  // Contenu: ce script permet d'afficher la liste des entreprises enregistrï¿½es par formation 
/***********************************************************/
require_once("../secure.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
$bdd = new Connexion_BDD_LEA();
	
if ( isset($_REQUEST['lettre']) ){
	$mot_cle = $_REQUEST['lettre']; 
}elseif(isset($_REQUEST['mot_cle'])){
	$mot_cle = $_REQUEST['mot_cle'];
}else {
	$mot_cle='A';
}

$les_entreprises = $bdd->get_entreprises(0, 10000, $mot_cle);
$nb = $bdd->get_nb_entreprises(); // le nombre total d'entreprise
 ?>	
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>onsulter : <?php echo $config_term->terminologie_entr; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form action="gest_entr.php?cmd=cons_entr" method="post" >
		<?php Afficher_recherche("gest_entr.php", $mot_cle, array("cmd" =>"cons_entr")); ?>        
    	<p>
   		<?php 
			echo( count($les_entreprises)." / $nb ".$config_term->terminologie_entr."s trouv&eacute;es"); 
			if (count($les_entreprises) > 0){
		?>
		</p>
       	<table >
         	<tr>
           		<th>Nom</th>
           		<th>Telephone</th>
           		<th colspan="2" >Action </th>
         	</tr>
         	<?php			  
				foreach($les_entreprises as $entreprise){
				  					  
    	            echo"
			<tr>
				<td width='25%'>
					<a href='gest_entr.php?cmd=cons_entr_det&id_entr=".$entreprise->id_entr."'>
						".$entreprise->nom." 
					</a>
				</td>
				<td width='25%'>							
					".$entreprise->tel_fixe1."
				</td>
				<td>
					<img src='../../images/b_edit.png'>
					<a href='gest_entr.php?cmd=modif_entr&id_entr=".$entreprise->id_entr."'>
						Modifier 
					</a>
				</td>
				<td>
					<img src='../../images/b_drop.png'>
					<a href='supp_entr.php?id_entr=".$entreprise->id_entr."' onClick='return deleteConfirm(\" ".$config_term->terminologie_entr."\")'>
						Supprimer 
					</a>
				</td>";
				}//foreach
			?>
       	</table>
		<br />
		<?php
				}
		?>
		<p>
			<input type="button" value="Ajouter <?php echo $config_term->terminologie_entr;  ?>" onclick="document.location='gest_entr.php?cmd=nouv_entr'" />  
		<?php
			if(count($les_entreprises) > 0) {
				echo"
			<input type=\"button\" value=\"Tout supprimer\" 
				onclick=\"if(deleteConfirm('tout ".$config_term->terminologie_entr."')) document.location='supp_all_entr.php?mot_cle=".$mot_cle."'\" />";
			}
		?>
		</p>
	</form>
</div>