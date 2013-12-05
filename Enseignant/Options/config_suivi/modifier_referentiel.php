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

require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if( isset($_REQUEST['id_arbre'])) { 

	$arbre = new Arbre($_REQUEST['id_arbre']);
	$arbre->set_detail();
	$arbre->set_libelles_niveaux(); 
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

function controleSaisie(theForm){   
		          
   if(testVide(theForm.nom, "intitulé")== false) return false;           
   
   return true;
}

</script>		
</head>
<body>
			<div id="top_l"></div><div id="top_m"><h1></h1></div><div id="top_r"></div>
			<div id="m_contenu">

<table width="100%" >
 		 <tr>
 		   <td width="80%" height="21"><span class="titre_page"> Modifier votre <?php echo"$arbre->nom"; ?></span></td>
           <td width="20%"><?php afficher_boutton_fermer(); ?>
           </td>
	 </tr>
 		 <tr>
 		   <td height="23" colspan="2"><hr class="trait"></td>
      </tr>
	    <tr align="center">
		  <td height="118" colspan="2" align="left">

<form action="nouv_referentiel_v.php"  method="post" onSubmit="return controleSaisie(this)">
	<input type="hidden" name="id_arbre" value="<?php echo"$arbre->id_arbre" ?>">
	
    <table width="100%" height="93" border="0" cellspacing="0">
      <tr>
        <td width="14%" height="31" class="sous_titre_tableau">Intitul&eacute;</td>
        <td width="44%" class="cellule">
		<input name="nom" type="text" size="60"
		value= "<?php echo($arbre->nom); ?>" 
		>
		</td>
        <td width="42%">&nbsp;</td>
      </tr>
      <tr>
        <td height="31" colspan="3">
		<?php 
				echo"<table cellspacing='0'> 
						<tr>
			           <td   class='sous_titre_tableau' colspan='2'>Les intitulés des niveaux</td>
				      </tr>";
			$i=1;		  	
			foreach($arbre->libelles_niveaux as $libelle) {
			
			echo" <tr>        		
					<td class='cellule'>
					Niveau $i	
					</td>
       				<td class='cellule'>
					<input name='libelles_niveaux[$i]' type='texte'  value='$libelle' size='60'>		
					</td>
	      		</tr>";
			$i++;
			}
			echo"</table>";
	   ?>
		</td>
        </tr>
		<tr>
        <td height="23" colspan="3" align="center">
			<input type='submit' name='Submit' value='Valider'>
		</td>
      </tr>
    </table>
            </form>
</td>
	    </tr>
</table></div>

</body>
</html>