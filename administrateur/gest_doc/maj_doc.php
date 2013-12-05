<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: Cette page contient le formulaire de création d'une nouvelle formation
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

if(isset($_REQUEST['id_doc'])) $id_doc = $_REQUEST['id_doc'];
else $id_doc = 0;

$document = new Document_administratif($id_doc);
$document->set_detail();


if(isset($_SESSION['id_rvs']) && $document->id_usager != $_SESSION['id_rvs'] && $id_doc != 0 ) exit();
if(isset($_SESSION['id_ens']) && $document->id_usager != $_SESSION['id_ens'] && $id_doc != 0 ) exit();

$les_categories = $bdd->get_categories_document_admin();


if($id_doc == 0) $titre_page = "Mette en ligne un nouveau document";
else $titre_page ="Modifier le document";
	
?>
<SCRIPT language=JavaScript>
						
	function verifform(theForm){															
		if (theForm.titre.value == "") {
			alert("Vous devez saisir le titre du document");
			theForm.titre.focus();
			return false;
		}
		
	}//fin de verifform					
  </SCRIPT>



<div id="top_l"></div>
<div id="top_m">
	<?php echo"<h1> $titre_page  </h1>"; ?>
	    	
</div>
	<div id="top_r">	
    </div>
    <div id="m_contenu"> 
	 NB : Le document que vous voulez mettre en ligne est consultable  par tous
	   les apprentis du  CFA.
       <form action='<?php echo($LEA_URL.'administrateur/gest_doc/maj_doc_v.php'); ?>' method='post' enctype='multipart/form-data' onSubmit='return verifform(this)' >
    <input type="hidden" name="id_doc" value="<?php echo( $id_doc) ?>" >
    <table width="61%" border="0" cellspacing="0">
      <tr >
        <th height="30" colspan="2" >Nouveau Document </th>
      </tr>
      <tr>
        <td height="73">Cat&eacute;gorie</td>
        <td>
          
            <select name="categorie" size="1" >
              <?php			  			  			  			  									  			  
					 echo "<option value='' selected > --- Sans categorie  ---- </option>";	
			 		foreach($les_categories as $categorie) {				
				
						if ($categorie == $document->categorie) $selected = "selected";
						else $selected = "";
			 		 
				     echo "<option value='$categorie' $selected > $categorie </option>";	 
				 	}
			 
					 ?>
            </select>
        <br>
          <input name="autre_categorie" type="text" value="" size="20" >
        	Autre categorie
		
		</td>
      </tr>
      <tr>
        <td width="41%" height="30">Titre</td>
        <td width="59%">
          <input name="titre" type="text" value="<?php echo"$document->titre"; ?>" size="40" >
          <sup class="etoile">*</sup> </td>
      </tr>
      <tr>
        <td height="39">Commentaire</td>
        <td>
		<textarea rows="5" cols="70" name="commentaire"><?php echo"$document->commentaire"; ?></textarea>
				          
        </td>
      </tr>
      <tr>
        <td height="37">Fichier joint</td>
        <td>
			<?php 		
	  				$rep_doc = $LEA_REP."documents/documents_administratifs/";
					$url_doc = $LEA_URL."documents/documents_administratifs/";
					
					$src_doc = $document->fichier_joint;
					$fichier = $url_doc.urlencode($src_doc);
														
				if (file_exists( $rep_doc.$src_doc) ) {
						echo"
						  Le document à remplacer
						  <a href=\"$fichier\" target=\"_blank\" >$src_doc</a> <br><br>				         						  
				
						 ";
				}		 
				?>
			<input type='file' name='fichier_joint'>
		</td>
      </tr>
      <tr>
        <td height="56">&nbsp;</td>
        <td><input type="submit" name="Submit" value="Valider"></td>
      </tr>
    </table>
    <br>
  </form>

</div>

