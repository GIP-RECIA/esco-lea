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

require_once($LEA_REP."modele/bdd/classe_modalite_multiple.php");
require_once($LEA_REP."modele/bdd/classe_choix_modalite_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if( isset($_REQUEST['id_modalite'])) { 
	$id_modalite = $_REQUEST['id_modalite'];	
	$modalite = new Modalite_multiple($id_modalite);
	$modalite->set_detail();
	$les_choix = $modalite->get_choix(); 
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

function CS_modalite_multiple(theForm){   
      	
	   if(	testVide(theForm.libelle, "l'intitulé des cases à cocher ")== false) return false;	      
   return true;
}


</script>		
</head>
<body>
			<div id="top_l"></div><div id="top_m"><h1></h1></div><div id="top_r"></div>
			<div id="m_contenu">

<table width="102%" height="170" border="0">
 		 <tr>
 		   <td width="80%" height="21"><span class="titre_page"> Modalite &agrave; choix
 		       multiple</span></td>
           <td width="20%"><?php afficher_boutton_fermer(); ?>
           </td>
	 </tr>
 		 <tr>
 		   <td height="23" colspan="2"><hr class="trait"></td>
      </tr>
	    <tr align="center">
		  <td height="118" colspan="2" align="left">
		  <form action="modifier_modalite_multiple_v.php" method="post" onSubmit="return CS_modalite_multiple(this)">
            <input type="hidden" name="id_modalite" value="<?php echo"$id_modalite"?>" >
            <input type="hidden" name="action" value="modif" >
			
            <table width="100%" border="0" cellspacing="0">
              <tr>
                <td width="34%" height="35" class="sous_titre_tableau">L'intitul&eacute; des cases </td>
                <td width="66%" class="cellule">
				<input name="libelle" type="text" size="50" 
				value="<?php echo"$modalite->libelle" ?>">
                </td>
              </tr>
              <tr>
                <td height="41" class="sous_titre_tableau">Vous autorisez le
                  choix</td>
                <td class="cellule">
                  <input name="type_choix" type="radio" value="unique"
		  <?php
					if($modalite->type_choix=='unique') echo"checked";
		  ?>
		  >
    Unique
    <input type="radio" name="type_choix" value="multiple"
		  <?php
					if($modalite->type_choix=='multiple') echo"checked";
		  ?>
		  >
    multiple </td>
              </tr>
              <tr>
                <td height="30" colspan="2" class="cellule">
				<?php 
				echo"<table cellspacing=0 width='100%'> 
						<tr>
			           <td   class='sous_titre_tableau'>
					   Liste des choix (Attention : les choix vide seront supprimés)
					   </td>
				      </tr>";
			$i = 0;	
			
			foreach($les_choix as $choix) {
				$i++;
			echo" <tr>        		
       			<td class='cellule'>
				Choix $i :<input name='les_choix[$choix->id_choix]' type='texte'  value='$choix->libelle' size='60'>		
				</td>
      		</tr>";
			}
			echo"</table>";
	   			?>
				
				</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><hr class="trait">
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center"> Ajouter ce choix en plus:
                    <input name='nouveau_choix' type='texte'  value='' size='60'
				
		>
                            </tr>
              <tr>
                <td colspan="2" align="center">
                  <input type='submit' name='Submit' value='Valider'>
                </td>
              </tr>
            </table>
	      </form></td>
	    </tr>
</table>
</div>
</body>
</html>