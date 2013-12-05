<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la mise  ï¿½ jour du modele  de tï¿½che 
/***********************************************************/
require_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."modele/bdd/classe_modalite_va_multiple.php");
require_once($LEA_REP."modele/bdd/classe_choix_modalite_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();


if( isset($_REQUEST['id_modalite'])) { 
	$id_modalite = $_REQUEST['id_modalite'];	
	$modalite = new Modalite_va_multiple($id_modalite);
	$modalite->set_detail();
	
	$les_id_periode = $modalite->get_id_periodes();
	$les_choix = $modalite->get_choix(); 
		
	
}else exit();

$arbre = new Arbre($modalite->id_arbre);
$arbre->set_detail();

$les_periodes = $formation->get_periodes($arbre->type);

?>
		

<html>
<head>
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>"  />

<title>LEA : Modalit&eacute;</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="../../../javascript/stdlib.js">

</script>		
<script language="JavaScript">

function CS_modalite_multiple(theForm){   
      	
	   if(	testVide(theForm.libelle, "l'intitulï¿½ des cases ï¿½ cocher ")== false) return false;	      
   return true;
}


</script>		
</head>
<body>

<div id="contenu">
			<div id="top_l"></div><div id="top_m"><h1>
<?php
			if ($arbre->type == "entr") {
			    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				echo"Validation $arbre->nom";
			}
			elseif($arbre->type == "cfa") {
			echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			echo"Validation $arbre->nom ";
			}
?>
</h1></div><div id="top_r"></div>
			<div id="m_contenu">


<p>
  <?php afficher_boutton_fermer(); ?>
</p>
<form action="modifier_modalite_va_multiple_v.php" method="post" onSubmit="return CS_modalite_multiple(this)">
  <input type="hidden" name="id_modalite" value="<?php echo"$id_modalite"?>" >
  <input type="hidden" name="action" value="modif" >
  <table width="100%" border="0" cellspacing="0">
    <tr>
      <td width="34%" height="35">L'intitul&eacute; des cases </td>
      <td width="66%">
        <input name="libelle" type="text" size="50" 
				value="<?php echo"$modalite->libelle" ?>">
      </td>
    </tr>
    <tr>
      <td height="57">Modalit&eacute; se valide aux p&eacute;riodes suivantes</td>
      <td>
        <select name="les_id_periode[]" multiple size="5">
          <?php

		foreach($les_periodes as $periode ){
			if(in_array($periode->id_periode, $les_id_periode) ) $selected = "selected";
			else $selected = "";
			
			echo("<option value=\"$periode->id_periode\" $selected >". to_html($periode->libelle)."</option>");		
		}
		?>
        </select>
        <p>Appuyer sur la touche CTRL pour s&eacute;lectionner plusieurs p&eacute;riodes</p>
      </td>
    </tr>
    <tr>
      <td height="41">Vous autorisez le choix</td>
      <td>
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
        Multiple </td>
    </tr>
    <tr>
      <td height="30" colspan="2">
        <?php 
				echo"<table cellspacing=0 width='100%'> 
						<tr>
			           <th>
					   Liste des choix (Attention : les choix vide seront supprim&eacute;s)
					   </th>
				      </tr>";
			$i = 0;	
			
			foreach($les_choix as $choix) {
				$i++;
			echo" <tr>        		
       			<td>
				Choix $i :<input name='les_choix[$choix->id_choix]' type='texte'  value='$choix->libelle' size='60'>		
				</td>
      		</tr>";
			}
			echo"</table>";
	   			?>
      </td>
    </tr>
  </table>
  <p>Ajouter ce choix en plus:
      <input name='nouveau_choix' type='texte'  value='' size='60'
				
		>
    </p>
  <p>
    <input type='submit' name='Submit' value='Valider'>
    </p>
</form>
<p>&nbsp;</p>
</div>
</div>
</body>
</html>