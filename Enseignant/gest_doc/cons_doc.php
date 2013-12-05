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
require_once($LEA_REP."modele/bdd/classe_document_administratif.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_categorie_document.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/     		  		 		  
$vide=false;
if(isset($_SESSION['id_for'])) { // si un enseignant, un maitre d'apprentissage ou un apprenti est connectï¿½.
	$formation = new Formation ( $_SESSION['id_for']);
	$formation->set_detail();
}
 
$les_categories = $formation->get_categories_documents();

if(isset($_REQUEST['id_categ'])) { 
		$id_categ_select = $_REQUEST['id_categ'];
		$categorie_select = new Categorie_document ($id_categ_select);
		$categorie_select->set_detail();
		
		if($formation->id_for != $categorie_select->id_for) $vide=true;
		$les_documents = $categorie_select->get_documents_admin();
		
} elseif(count($les_categories) > 0 ) {
		$id_categ_select = $les_categories[0]->id_categ;
		$categorie_select = new Categorie_document ($id_categ_select);
		$categorie_select->set_detail();
		
		if($formation->id_for != $categorie_select->id_for) $vide=true;
		$les_documents = $categorie_select->get_documents_admin();

} else { 	
	echo '<div id="top_l"></div>
		 <div id="top_m">
			<h1><span class="orange">C</span>onsulter les documents</h1>
		 </div>
		 <div id="top_r"></div>
		 <div id="m_contenu">' ;	 
	
	if(isset($_SESSION['id_ens']) && $est_responsable ) 
		echo "Veuillez cr&eacute;er les cat&eacute;gories de vos documents </div>";
	else echo "Aucun document n'est disponible </div>"; 
$vide=true;
	//exit();
}




if(isset($_SESSION['id_ens'])) {
	$est_responsable = ( $formation->id_ens == $_SESSION['id_ens'] );
} elseif(isset($_SESSION['id_app'])) {
	 $est_responsable = 0;
}	 
/**
 * cette fonction permet d'afficher le document $document
 */
function afficher_document($document){

	global $LEA_REP;
	global $LEA_URL;
	global $est_responsable;
	
	echo'<table width="75%" border="0">
			<tr class="titre" >
			    <td height="50">'.to_html($document->titre).' </td>
	    	</tr>
			<tr>
			    <td height="20">	
					<b> Mise &agrave; jour le :</b> [ '.trans_date_time($document->date_maj).' ]	
			    </td>
	  		</tr>
			<tr>
			    <td height="20">
					<b>Commentaire : </b>'. nl2br(to_html($document->commentaire)).'
				</td>
		    </tr>
			<tr>
			    <td>';		
  				$rep_doc = $LEA_REP."documents/documents_administratifs/";
				$url_doc = $LEA_URL."documents/documents_administratifs/";
				
				$src_doc = $document->fichier_joint;
				$fichier = $url_doc.urlencode($src_doc);
													
				if ($src_doc != '' && file_exists( $rep_doc.$src_doc) ) {
					$img = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_fichier.jpeg';			
					echo"						   
					  <b> T&eacute;l&eacute;charger </b>
						  	<a href=\"$fichier\" target=\"_blank\" > 
								<img src=\"$img\" border=0> 
							</a>";
				}		 
	echo'	    </td>
			 </tr>
			 <tr>
				<td width="59%">';
	
				if(  isset($_SESSION['id_ens']) && $est_responsable  ) {
		
					echo"<img src=\"../../images/b_edit.png\" />
						<a href=\"gest_doc.php?cmd=maj_doc&id_doc=$document->id_doc\">Modifier</a>
							&nbsp;&nbsp;		
						<img src=\"../../images/b_drop.png\" />
						<a href=\"supp_doc.php?id_doc=$document->id_doc\" onclick=\"return deleteConfirm('ce document')\">Supprimer</a>";
				}
	
	echo'</td>   </tr>	</table>';
}
if(!$vide) { 
?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>onsulter les documents</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form name="form1" method="get" action=""> 
    	<input type="hidden" name="cmd" value="cons_doc">
		<?php echo $config_term->terminologie_formation; ?> : <b><?php echo"$formation->nom "?> </b><br><br>
   		Cat&eacute;gories: <b>
		    <?php 
				if(count($les_categories) > 0 ){ 
					echo'<select name="id_categ" size="1" onChange="this.form.submit()">';
				 	foreach($les_categories as $categorie) {				
						if ($categorie->id_categ == $id_categ_select) $selected = "selected";
						else $selected = "";
			 		 	
						$cat = to_html($categorie->libelle);
				     	echo "<option value=\"$categorie->id_categ\" $selected> $cat </option>";	 
			 		}				
			 		echo'</select>';
				}else { 
					echo"Vous devez d&eacute;finir les cat&eacute;gories des documents avant de mettre un document en ligne"; /*exit()*/; 
				}
			?>
		</b>
	</form>
	<?php 
		if(count($les_documents) > 0 ) {
			$i=1;
			echo'<table>';
			foreach($les_documents as $document) {			
				if($i==1){
						 echo'<tr><td valign="top">';		
							 afficher_document($document);
						 echo'</td>';
						 $i=2;		
				} else{ 	
						echo'<td valign="top">';
							afficher_document($document);
						echo'</td></tr>';
						$i=1;		
				}		  		
			}
			echo'</table>';
		}else echo"<br> Aucun document n'est disponible<br><br>";
	
		if(isset($_SESSION['id_ens'] ) && $est_responsable) {
		 echo"	<input type=\"button\" value=\"Nouveau document\" onClick=\"document.location='./gest_doc.php?cmd=maj_doc&id_categ=".$categorie_select->id_categ."'\" />";
		}
	echo "</div>";
}
?>
