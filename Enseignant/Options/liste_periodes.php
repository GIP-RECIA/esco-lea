<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: 
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_noeud.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
include("../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$config_lea = $formation->get_config_lea();

$les_periodes = $formation->get_periodes();

$rang_max = 0; // le rang  par défaut maximum  des période créées.

?>		
<script type="text/javascript" src="../../javascript/stdlib.js"></script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">L</span>iste des p&eacute;riodes de <?php echo $config_term->terminologie_formation; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<input type="button" value="Cr&eacute;er une nouvelle p&eacute;riode" onclick="window.open('maj_periode.php?rang_max=<?php echo"$rang_max"?>', '',' width=650, height=700, top=20, left=50, scrollbars=yes, resizable=yes ' )" />

	<table>
	<?php
		if(count($les_periodes) >0 ){
			echo"
			<tr>
				<th>Libell&eacute; de la p&eacute;riode</th>
				<th>Rang</th>
				<th> S'applique </th>				
				<th colspan=\"3\">Actions</th>
			</tr>";
	
			$style = "";		
	
			foreach($les_periodes as $periode ){
				if($periode->rang > $rang_max) $rang_max = $periode->rang ;
		
				$suivi = "";		
				if($periode->suivi_cfa) $suivi = "<p> ".$config_lea->appelation_suivi_cfa." </p>";
				if($periode->suivi_entr) $suivi .= "<p> ".$config_lea->appelation_suivi_entr." </p>";
		
				if($style == "") $style ="selected";
				else $style = "";
	
				echo"		 
				<tr class='$style'>
					<td>".to_html($periode->libelle)."</td>
					<td>".to_html($periode->rang)."</td>
					<td>".$suivi."</td>					
					<td>
						<img src=\"../../images/b_edit.png\" />
						<a href=\"#\" onclick=\"window.open('maj_periode.php?id_periode=".$periode->id_periode."', '','width=650, height=700, top=20, left=50, scrollbars=yes, resizable=yes ' )\">
							Modifier</a>  
					</td>
					<td>
						<img src=\"../../images/ico_dupliquer.png\" /> 
						<a href=\"options.php?cmd=dupliquer_periode&id_periode=".$periode->id_periode."\" \">
							Dupliquer</a>
					</td>
					<td>
						<img src=\"../../images/b_drop.png\" /> 
						<a href=\"maj_periode_v.php?action=supp&id_periode=".$periode->id_periode."\" onclick=\"return deleteConfirm('cette p&eacute;riode')\">
							Supprimer</a>
					</td>
				</tr>";
			}// fin foreach		    		  
		}else echo"<p>Aucune p&eacute;riode n'est d&eacute;finie</p>";	
	?>
	</table>
</div>