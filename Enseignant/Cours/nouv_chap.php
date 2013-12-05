<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 21/09/05
  //Contenu: .
/***********************************************************/
include_once("../../Modele/classe_matiere.php");
include_once('../secure.php');
include_once("../../stdlib.php");
/***********************************************************/

if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; 
else $action="";

if ( $action=="nouv" || $action=="modif" ) {

	if($action=="nouv") {
		if (isset($_REQUEST['id_mat']))  $id_mat=$_REQUEST['id_mat'];
		else  { html_refrech("../accueil.php");exit(); }

		$chapitre=new Chapitre(0);
		$chapitre->id_mat=$id_mat;
		$titre_page="Ajout d'un nouveau chapitre";
        $libelle_boutton="ajouter ce chapitre";	
	}
   	if($action=="modif") {
		if (isset($_REQUEST['id_chap']))  $id_chap=$_REQUEST['id_chap'];
		else  { html_refrech("../accueil.php");exit(); }
		
		$chapitre=new Chapitre($id_chap);
		$chapitre->set_detail();
        $libelle_boutton="Modifier";
		$titre_page="Modifier un chapitre";		
	}

$matiere=new Matiere($chapitre->id_mat);
$tab_themes=$matiere->get_les_themes(); // liste des thèmes abordé par cette matière.

}else html_refrech("../accueil.php");
?>

<html>
<head>
<title>Document sans titre</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../themes/default/enseignantSuivi.css" type="text/css">
</head>

<body>
			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">

 <form action='<?php echo"maj_chap.php?action=$action&id_chap=$chapitre->id_chap"; ?> ' method='post'>
 <?php echo"<input type='hidden' name='id_mat' value='$chapitre->id_mat'>"; ?>
             <table width="103%" border="0">
               <tr class="sous_titre_tableau">
                 <td colspan="2" class="titre_tableau">
				 <?php echo"$titre_page" ?>
				 </td>
               </tr>
               <tr class="sous_titre_tableau">
                 <td width="14%" height="47">Libell&eacute;</td>
                 <td width="86%"><input name="libelle" type="text" value='<?php echo("$chapitre->libelle") ?>' size="70">
                 </td>
               </tr>
               <tr class="sous_titre_tableau">
                 <td height="24">Th&egrave;me</td>
                 <td rowspan="2">
				 <select name="theme">
				 <option value='' selected></option>
				 <?php
				 if (isset($tab_themes)) {
					 foreach($tab_themes as $theme){
					 if ($theme==$chapitre->theme) $selected="selected";
					 else $selected="";
					 echo"<option value=\"$theme\" $selected>$theme</option>";
					 }
				 }
				 ?>
                 </select><br>
                   Si le theme n'existe pas
                   <input name="new_theme" type="text" size="40" >
</td>
               </tr>
               <tr class="sous_titre_tableau">
                 <td height="25">&nbsp;</td>
               </tr>
               <tr align="center" >
                 <td colspan="2"><input type="submit" name="Submit2" value='<?php echo"$libelle_boutton"?>'>
                 </td>
               </tr>
             </table>
</form>
</div>
</body>
</html>
