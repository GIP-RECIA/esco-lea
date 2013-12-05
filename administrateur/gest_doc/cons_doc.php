<?php
/***********************************************************/
  // Copyright © 2005-2006 
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
/***********************************************************/

$bdd = new Connexion_BDD_LEA();	  	      		  		 		  

$les_categories = $bdd->get_categories_document_admin();

if(isset($_REQUEST['categorie'])) { 
		$categorie_select = stripslashes( $_REQUEST['categorie'] );
		
}		
elseif(count($les_categories) > 0 ) $categorie_select = $les_categories[0];
else $categorie_select = 'all';


$les_documents = $bdd->get_documents_admin($categorie_select);

?>
	<div id="top_l"></div><div id="top_m">
	<h1><span class="orange">C</span>onsulter les documents administratifs</h1>
	</div><div id="top_r"></div>
<div id="m_contenu"> 
<br>
    <form name="form1" method="get" action="">
			<input type="hidden" name="cmd" value="cons_doc">			
			 Cat&eacute;gorie 
			  <select name="categorie" size="1" onChange="this.form.submit()">
		 	 <option value="all" selected> Toutes les catégories </option>
            <?php			  			  			  			  									  			  
				
			 	foreach($les_categories as $categorie) {				
				
						if ($categorie == $categorie_select) $selected = "selected";
						else $selected = "";
			 		 	$cat = to_html($categorie);
						
				     echo "<option value=\"$categorie\" $selected> $cat </option>";	 
			 	}
			 
			 ?>
          </select>
      </p>

</form>
<p> Liste des documents </p>

<?php 
	if(count($les_documents) > 0 ) {
	
	foreach($les_documents as $document) {
		$usager =  new Usager($document->id_usager);
		$usager->set_detail(); // la personne ayant crée ce document 
		
?>

<table width="75%" border="0">
  <tr >
    <th><?php echo(to_html($document->titre))?></th>
    </tr>
  <tr>
    <td height="20">
	<?php 
		echo"<b> Mise &agrave; jour le :</b> [ ".trans_date_time($document->date_maj)." ]<br>
			  <b> Par : </b> $usager->nom $usager->prenom	
			"; 
	
	?>
    </td>
  </tr>
  <tr>
    <td height="20"><b>Commentaire : </b> <?php echo(nl2br(to_html($document->commentaire)))?></td>
    </tr>
  <tr>
    <td><?php 		
	  				$rep_doc = $LEA_REP."documents/documents_administratifs/";
					$url_doc = $LEA_URL."documents/documents_administratifs/";
					
					$src_doc = $document->fichier_joint;
					$fichier = $url_doc.urlencode($src_doc);
														
				if ($src_doc != '' && file_exists( $rep_doc.$src_doc) ) {
						$img = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_fichier.jpeg';			
						echo"						   
						  <b> Télécharger </b>
						  <a href=\"$fichier\" target=\"_blank\" > <img src=\"$img\" border=0> </a>				         						  
				
						 ";
				}		 
				?>
    </td>
  </tr>
  <tr>
    <th width="59%"><?php
	if(    ( isset($_SESSION['id_admin']) )
		|| ( isset($_SESSION['id_rvs']) && $usager->id_usager == $_SESSION['id_rvs'] ) 
		|| ( isset($_SESSION['id_ens']) && $usager->id_usager == $_SESSION['id_ens'] )  ) {
	
		echo"<img src=\"../../images/b_edit.png\" />
							<a href=\"gest_doc.php?cmd=maj_doc&id_doc=$document->id_doc\">Modifier</a>
		&nbsp;&nbsp;
		
		<img src=\"../../images/b_drop.png\" />
							<a href=\"../../administrateur/gest_doc/supp_doc.php?id_doc=$document->id_doc\" onclick=\"return deleteConfirm('ce document')\">Supprimer</a>";
		}
	?>
</th>
    </tr>
</table>
<br> <br>

<?php 
	}
}else echo"Aucun document n'est trouvé";

?>
</div>
