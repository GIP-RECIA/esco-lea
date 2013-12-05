<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: Cette page contient le formulaire de crï¿½ation d'un nouveau document administratif 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_document_administratif.php");
require_once($LEA_REP."modele/bdd/classe_categorie_document.php");


/***********************************************************/

if(isset($_REQUEST['id_doc'])) $id_doc = $_REQUEST['id_doc'];
else $id_doc = 0;

$document = new Document_administratif($id_doc);
$document->set_detail();

if($id_doc > 0 )
		$id_categ_select = $document->id_categ;
elseif(isset($_REQUEST['id_categ'])) $id_categ_select = $_REQUEST['id_categ']; 
else $id_categ_select = 0;

$categorie_select = new Categorie_document($id_categ_select);
$categorie_select->set_detail();

if($id_doc != 0 && $categorie_select->id_for != $_SESSION['id_for']) exit();

$formation = new Formation ( $_SESSION['id_for']);
$formation->set_detail();

$les_categories = $formation->get_categories_documents();


if($id_doc == 0) $titre_page = "Mettre en ligne un nouveau document";
else $titre_page ="Modifier un document";
	
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
	<div id="m_contenu">
      <form action='maj_doc_v.php' method='post' enctype='multipart/form-data' onSubmit='return verifform(this)' >
    	<input type="hidden" name="id_doc" value="<?php echo( $id_doc) ?>" >		
    <table width="61%" border="0" cellspacing="0">
      <tr >
        <th height="30" colspan="2" > Document </th>
      </tr>
      <tr>
        <td height="43">Cat&eacute;gorie</td>
        <td>
          
            <select name="id_categ" size="1" >
              <?php			  			  			  			  									  			  					 	
			 		foreach($les_categories as $categorie) {				
							
						if ($categorie->id_categ == $id_categ_select) $selected = "selected";
						else $selected = "";
			 		 
				     echo "<option value='$categorie->id_categ' $selected > $categorie->libelle </option>";	 
				 	}
			 
					 ?>
            </select>
        <br>
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
		<textarea rows="5" cols="40" name="commentaire"><?php echo"$document->commentaire"; ?></textarea>
				          
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
														
				if ($src_doc != ""  && file_exists( $rep_doc.$src_doc) ) {
						echo"
						  Le document &agrave; remplacer
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

