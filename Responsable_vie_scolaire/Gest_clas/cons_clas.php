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

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
/***********************************************************/
$unite = new Unite_pedagogique($_SESSION['id_unite']); // l'unite auquelle l'usager connï¿½ctï¿½ est responsable
$les_id_formations = $unite->get_id_formations();

if (isset($_REQUEST['id_for'])) $id_for_select=$_REQUEST['id_for'];
else $id_for_select=0;

		 $action_form = "gest_clas.php";		
		 $aucune_formation =" 
	Aucune ".$config_term->terminologie_formation." n'est enregistr&eacute;e : 
		<a href='gest_clas.php?cmd=nouv_form'> 
			Ajouter ".$config_term->terminologie_formation." 
		</a>";
		
		 $boutton_nouvelle_classe = "
	<input type=\"button\" value=\"Ajouter ".$config_term->terminologie_classe."\" 
		onclick=\"document.location='gest_clas.php?cmd=nouv_clas&id_for_select=".$id_for_select."&action=nouv'\" />";
 
$formation_select = new Formation($id_for_select);
$formation_select->set_detail();
$les_classes = $formation_select->get_classes();	
 ?>		
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>onsulter : <?php echo $config_term->terminologie_classe; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form action='<?php echo"$action_form" ?>' method="GET" >
		<input type='hidden' name='cmd' value='cons_clas'>
	  	<?php  
	  		if(isset($les_id_formations)) { 
	  	?>
		<p class='txt_gras'> Formation
	    	<select name="id_for" size="1" onChange="this.form.submit()">
	      		<option value='0' >----- S&eacute;lectionnez une formation ------</option>
	      		<?php			  			  			  			  									  			  
					foreach($les_id_formations as $id_for) {				
						if ($id_for==$id_for_select){
							$selected="selected=\"selected\"";
						}else {
							$selected="";
						}
				 		
						$formation=new Formation($id_for);
						$formation->set_detail();
					    echo "
				<option value='$id_for' $selected>$formation->nom </option>";	 
				 	}
				 
				 ?>
	    	</select>
		</p>
	<?php  }else {
				echo"$aucune_formation";
			}
	 ?>
	</form>
	<?php
		if (count($les_classes) > 0) { 
			foreach($les_classes as $classe){
				$nb_apprentis = $classe->get_nb_apprentis();
							
				switch($classe->niveau_etude){
					case 1:
						$niveau_etude="Premi&egrave;re ann&eacute;e";
	      				break; 
					case 2:
						$niveau_etude="Deuxi&egrave;me ann&eacute;e";
	    			   	break; 
					case 3:
						$niveau_etude="Troisi&egrave;me ann&eacute;e";
	       			   	break; 
					default: 
						$niveau_etude="?";	   
				}
															 				 				
			 	$href_consulter_apprentis = "../Gest_usag/gest_usag.php?cmd=cons_liste_app&id_cla=".$classe->id_cla."";
			
			 	$lien_modifier = "
		<img src='../../images/b_edit.png'>
		<a href='gest_clas.php?cmd=modif_clas&id_cla=".$classe->id_cla."&action=modif'>
			Modifier 
		</a>";
			 	$lien_supprimer = "
		<img src='../../images/b_drop.png'>
		<a href='supp_clas.php?id_cla=".$classe->id_cla."' onClick='return deleteConfirm(\"cette classe\")'>
			Supprimer 
		</a>";				 		 		
			?>
	<table>
		<tr>
	    	<td>Classe</td>
	    	<td>
	      		<?php echo $classe->libelle." <br /> ".$niveau_etude; ?> 
	      	</td>
	    	<td width='50%' > 
	    		<img src='../../images/picto_app.gif'> 
	    		<a href='<?php echo"$href_consulter_apprentis"?>'> 
	    			Consulter les <?php echo $config_term->terminologie_app; ?>s de cette <?php echo $config_term->terminologie_classe; ?> 
	    		</a> 
	    	</td>
	  	</tr>
	  	<tr>
	    	<td> Nombre d'apprentis </td>
	    	<td><?php echo $nb_apprentis; ?></td>
	    	<td> <?php echo$lien_modifier." &nbsp;&nbsp;&nbsp; ".$lien_supprimer ?> </td>
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