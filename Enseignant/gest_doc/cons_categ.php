<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: Cette page contient la liste des catï¿½gories documents administratifs
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_categorie_document.php");
/***********************************************************/
$formation = new Formation ( $_SESSION['id_for']);
$formation->set_detail();

$les_categories = $formation->get_categories_documents();			
?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">M</span>ettre &agrave; jour les cat&eacute;gories de documents</h1>    	
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<?php 
		if(count($les_categories) > 0 ){
  			echo"<table>	
					<tr>
						<th>Cat&eacute;gorie</th>
						<th colspan=\"2\">Action</th>
					</tr>";
			foreach($les_categories as $categorie){
				echo"
					<tr>
						<td>".to_html($categorie->libelle)."</td>
						<td>
							<img src='".$URL_THEME."images/picto_edit.png'>
							<a href='gest_doc.php?cmd=maj_categ&id_categ=$categorie->id_categ' >
								Modifier 
							</a>
						</td>
						<td>
							<img src='".$URL_THEME."images/picto_drop.png'>
							<a href='supp_categ.php?id_categ=$categorie->id_categ' onClick='return deleteConfirm(\"cette catï¿½gorie\")'>
								Supprimer 
							</a>
						</td>
					</tr>";	
			}
		   	echo"</table>";
		} else echo"Aucune cat&eacute;gorie n'est d&eacute;finie";
		  
		echo" 	<input type=\"button\" value=\"Nouvelle cat&eacute;gorie\" onClick=\"document.location='./gest_doc.php?cmd=maj_categ'\" />";
  ?>
</div>

