<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  // Contenu: Cette page permet de consulter les classe d'une formation donnnï¿½e

/***********************************************************/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
/***********************************************************/
if (isset($_REQUEST['id_for'])) {
	$id_for_select=$_REQUEST['id_for'];
} else{
	$id_for_select = 0;
}
		
$boutton_nouvelle_classe="
	<input type=\"button\" value=\"Ajouter ".$config_term->terminologie_classe."\" 
		onclick=\"document.location='./gest_unite.php?cmd=nouv_clas&id_for_select=".$id_for_select."&action=nouv'\" />";
 
$formation_select = new Formation($id_for_select);
$formation_select->set_detail();
$les_classes = $formation_select->get_classes();	
 ?>		
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer : <?php echo($config_term->terminologie_classe); ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu"> 
	<?php echo($config_term->terminologie_formation); ?> : <?php echo"$formation_select->nom" ?>
	<?php
		if (count($les_classes) > 0) { 
			foreach($les_classes as $classe){
				$nb_apprentis = $classe->get_nb_apprentis();
							
				switch($classe->niveau_etude){
					case 1:$niveau_etude="Premi&egrave;re ann&eacute;e";
		      			 break; 
					case 2:$niveau_etude="Deuxi&egrave;me ann&eacute;e";
		    			   break; 
					case 3:$niveau_etude="Troisi&egrave;me ann&eacute;e";
		       			   break; 
					default: $niveau_etude="?";	   
				}
			 	$href_consulter_apprentis = "../gest_usag/gest_usag.php?cmd=cons_liste_app&id_cla=".$classe->id_cla;
			
			 	$lien_modifier = "
		<img src='../../images/b_edit.png'>
		<a href='gest_unite.php?cmd=modif_clas&id_cla=".$classe->id_cla."&action=modif'>
			Modifier 
		</a>";
			 	$lien_supprimer = "
		<img src='../../images/b_drop.png'>
		<a href='supp_clas.php?id_cla=".$classe->id_cla."' onClick='return deleteConfirm(\"cette ".$config_term->terminologie_classe."\")'>
			Supprimer 
		</a>";				 		 
	?>
	<table width='99%' cellspacing="0">
	  	<tr>
	    	<td width='24%' height="37" class='sous_titre_tableau'>
	    		<?php echo($config_term->terminologie_classe); ?>
	    	</td>
			<td width='26%' class='cellule'>
	  			<p class='txt_gras'> <?php echo $classe->libelle." <br /> ".$niveau_etude; ?> </td>
			<td width='50%' > 
				<img src="../../images/picto_app.gif" /> 
				<a href='<?php echo"$href_consulter_apprentis"?>'> 
					Consulter <?php echo($config_term->terminologie_app); ?> de <?php echo $config_term->terminologie_classe; ?>
				</a> 
			</td>
		</tr>
		<tr>
	  		<td height="38"  class='sous_titre_tableau'> Nombre <?php echo($config_term->terminologie_app); ?> </td>
			<td class='cellule'>
	  			<p class='txt_gras'><?php echo $nb_apprentis; ?></p>
			</td>
			<td ><?php echo $lien_modifier."&nbsp;&nbsp;&nbsp;".$lien_supprimer; ?></td>
	  	</tr>
	</table>
	<?php	  
			}// fin foreach 																											  
		}elseif ($id_for_select!=0){
			echo "Aucune ".$config_term->terminologie_classe." n'est enregistr&eacute;e pour cette ".$config_term->terminologie_formation; 	
	    }
	     
		if ($id_for_select!=0) { 
			echo $boutton_nouvelle_classe;
		}		 	
	?>
</div>