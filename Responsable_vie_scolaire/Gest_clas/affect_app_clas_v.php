<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 29/08/05
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/

$id_cla_depart = $_REQUEST['id_cla_depart'];
$id_cla_dest = $_REQUEST['id_cla_dest'];  
$classe_depart = new Classe ($id_cla_depart);
$classe_dest = new Classe ($id_cla_dest);
$classe_dest->set_detail();
if($_GET['id']=="1"){
$tableau=$classe_depart->get_apprentis();
//$classe_depart->basculer_apprentis($id_cla_dest);
?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Mresponsable_vie_scolaire.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Accueil</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "Meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'responsableVieScolaire.css');?>"/>
<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?><!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js');?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
	<body>
	<div id="box2" style="display:none"></div>	
	<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
			<?php include($LEA_REP.'menu_responsable_vie_scolaire.php'); ?>
			<div id="contenu">
    			<div id="contents">		
<form name="form1" method="post" action="affect_app_clas_v.php?id=2"> <?php
echo "<input type='hidden' name='id_cla_depart' value=".$id_cla_depart.">";
echo "<input type='hidden' name='id_cla_dest' value=".$id_cla_dest.">";
echo "<table>
				
				<tr>
					<th>Nom / Pr&eacute;nom</th>
					<th> Transfert vers ".$classe_dest->libelle."</th>
				</tr>";
for($i=0;$i<sizeof($tableau);$i++){
//html_refresh($LEA_URL."Responsable_vie_scolaire/Gest_usag/gest_usag.php?cmd=cons_liste_app&id_cla=$id_cla_dest")
echo "<tr><td>".$tableau[$i]->nom."   ".$tableau[$i]->prenom."</td><td> <input type=\"checkbox\" name=\"les_id_app[]\" value=".$tableau[$i]->id_app." checked /></td></tr><br/>";
}
?></table><input type="submit" name="Submit" value="Valider">
				</div>
				<div id="bottom_box"> </div>   
			</div>
			<?php include($LEA_REP."footer.php")?>
		</div>
	</body>
<!-- InstanceEnd -->
</html>
<?php } else{
$lis=$_REQUEST['les_id_app'];
$classe_depart->basculer_apprentis_l($id_cla_dest,$lis);
html_refresh($LEA_URL."Responsable_vie_scolaire/Gest_usag/gest_usag.php?cmd=cons_liste_app&id_cla=$id_cla_dest");


}

?>
