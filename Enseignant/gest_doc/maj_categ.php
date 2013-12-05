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
require_once($LEA_REP."modele/bdd/classe_categorie_document.php");


/***********************************************************/

if(isset($_REQUEST['id_categ'])) 
			$id_categ = $_REQUEST['id_categ'];		
else $id_categ = 0;

$categorie = new Categorie_document($id_categ);
$categorie->set_detail();

if($id_categ != 0 && $categorie->id_for != $_SESSION['id_for']) exit();

if($id_categ == 0)  $titre_page = "Nouvelle cat&eacute;gorie document";
else {
	$titre_page ="Modifier une cat&eacute;gorie";
	$id_for_select = $categorie->id_for;
}	
	
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
      <form action='maj_categ_v.php' method='post' onSubmit='return verifform(this)' >
    <input type="hidden" name="id_categ" value="<?php echo( $id_categ) ?>" >
    <table width="61%" border="0" cellspacing="0">
      <tr >
        <th height="21" colspan="2" >Cat&eacute;gorie</th>
      </tr>
      <tr>
        <td width="41%" height="43">Libell&eacute;</td>
        <td width="59%">
        <br>
          <input name="libelle" type="text" value="<?php echo to_html($categorie->libelle) ?>" size="40" >
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

