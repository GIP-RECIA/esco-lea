<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 21/09/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");
include_once("../../stdlib.php");
include_once("../../Modele/classe_formation.php");
include_once("../../Modele/classe_tache.php");
/***********************************************************/


if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; 
else $action="";

if ( $action=="nouv" || $action=="modif" ) {

	if($action=="nouv") {
		if (isset($_REQUEST['id_for']))  $id_for=$_REQUEST['id_for'];
		else  { html_refrech("../accueil.php");exit(); }

		$tache=new Tache(0);		
        $libelle_boutton="ajouter cette tâche";	
	}
   	if($action=="modif") { 
		if (isset($_REQUEST['id_tache']))  $id_tache=$_REQUEST['id_tache'];
		else  { html_refrech("../accueil.php");exit(); }		
		$tache=new Tache($id_tache);
		$tache->set_detail();
		$id_for=$tache->get_id_for();
        $libelle_boutton="Modifier";		
	}

$formation=new Formation($id_for);
$tab_activites=$formation->get_les_activites(); // liste des activiy=tés du modèle de tâches de la formation.

}
?>

<html>
<head>
<title>Nouveau chapitre</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../themes/default/enseignantSuivi.css" type="text/css">
</head>

<body>
			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">

<form action='<?php echo"maj_tache.php?action=$action&id_tache=$tache->id_tache"; ?> ' method='post'>
 <?php echo"<input type='hidden' name='id_for' value='$id_for'>"; ?>
<table width="72%" height="222" border="0">
  <tr>
    <td width="12%" height="35" class="sous_titre_tableau">Libell&eacute;</td>
    <td width="88%" class="cellule"> 
	  <br>
    <input name="libelle" type="text" value='<?php echo("$tache->libelle") ?>' size="70">
	</td>
  </tr>
  <tr>
    <td class="sous_titre_tableau">Activit&eacute;</td>
    <td class="cellule">
	 <select name="activite">
	 <option value='' selected></option>
                    <?php
				 if (isset($tab_activites)) {
					 foreach($tab_activites as $activite){
					  if ($activite==$tache->activite) $selected="selected";
					  else $selected="";
					if($activite!="") echo"<option value='$activite' $selected>$activite</option>";
				 	}
				 }
				 ?>
        </select>
                  <br>
        Si l'activit&eacute; n'existe pas <br>
        <input name="new_activite" type="text" size="50" >
	</td>
  </tr>
  <tr>
    <td class="sous_titre_tableau">Description</td>
    <td class="cellule"><textarea name="description" cols="50" rows="5"><?php echo"$tache->description"; ?></textarea>
	</td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td><input type="submit" name="Submit" value='<?php echo"$libelle_boutton" ?>'></td>
  </tr>
</table>
</form>

</div>
</body>
</html>
