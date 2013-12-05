<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la mise  à jour du modele  de tâche 
/***********************************************************/
require_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once ($LEA_REP."modele/bdd/classe_modalite_numerique_note.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if( isset($_REQUEST['id_modalite'])) { 
    $id_modalite = $_REQUEST['id_modalite'];
	$modalite = new Modalite_numerique_note($_REQUEST['id_modalite']);
	$modalite->set_detail();
}else exit();

?>		

<html>
<head>
<link rel="stylesheet" href="../../../styles/enseignant.css" type="text/css">
<title>Question</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="../../../javascript/stdlib.js">

</script>		
<script language="JavaScript">


function CS_modalite_numerique_note(theForm){   
      	
  if(	testVide(theForm.libelle, "l'intitulé de cette modalité ")== false) return false;
  
  if ( !isNumeric(theForm.note_max.value) || theForm.note_max.value < 1 ){
  	 	alert("Ce n'est pas un nombre valide \n Veuillez saisir un nombre supérueir à 1");
		theForm.note_max.focus();
   		return false;  
		}
    
   return true;
}
</script>		
</head>
<body>
			<div id="top_l"></div><div id="top_m"><h1></h1></div><div id="top_r"></div>
			<div id="m_contenu">

<table width="102%" height="179" border="0">
 		 <tr>
 		   <td width="80%" height="21"><span class="titre_page"> Modalite num&eacute;rique
 		       (note ou un ratio)</span></td>
           <td width="20%"><?php afficher_boutton_fermer(); ?>
           </td>
	 </tr>
 		 <tr>
 		   <td height="23" colspan="2"><hr class="trait"></td>
      </tr>
	    <tr align="center">
		  <td height="122" colspan="2" align="left">

            <form action="modifier_modalite_numerique_note_v.php" method="post" onSubmit="return CS_modalite_numerique_note(this)">
              <input type="hidden" name="id_modalite" value="<?php echo"$id_modalite" ?>">
              <input type="hidden" name="action" value="modif">
              <table width="93%" border="0" cellspacing="0">
                <tr class="cellule">
                  <td width="34%" height="21">L'intitul&eacute; de la modalit&eacute;</td>
                  <td width="66%">
				  <input name="libelle" type="text" size="50" 
				  value="<?php echo"$modalite->libelle"?>">
                  </td>
                </tr>
                <tr class="cellule">
                  <td>Note max</td>
                  <td>x /
                      <input name="note_max" type="text" size="4"
					   value="<?php echo"$modalite->note_max" ?>" >
                  </td>
                </tr>
                <tr align="right" class="cellule">
                  <td colspan="2">
                    <input name="Submit2" type="submit" value="Valider">
                  </td>
                </tr>
              </table>
            </form></td>
	    </tr>
</table>
</div>
</body>
</html>


