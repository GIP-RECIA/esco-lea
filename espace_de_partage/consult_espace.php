<?php
/* /!\Projet_tut/!\ Matthieu Charron - 19/06/06
 Description : Page permettant l'affichage de l'espace partagé */

require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

ob_start();
include_once("secure.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
// projet_tut ------------ DEBUT
require_once ($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once ($LEA_REP."modele/bdd/classe_apprenti.php");
// projet_tut ------------ FIN
/***********************************************************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
	<!--<title>LEA Enseignant</title>-->
	<title>LEA: Espace de partage</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen"
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'apprenti.css');?>"
		media="screen" />
	<?php
	if(isset($_REQUEST['imprimer'])) {
		echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
		echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
	}
	?>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
</head>

<body>
<div
	id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
		<?php
			if (isset($_SESSION['id_ens'])) {
				echo '<div id="box2" style="display:none">';
				include($LEA_REP.'Enseignant/sel_formation.php'); 
				echo '</div>';
				include('../menu_enseignant.php');
			} elseif(isset($_SESSION['id_app'])) {
				include('../menu_apprenti.php');
			} elseif(isset($_SESSION['id_ma'])) {
				include('../menu_maitre_apprentissage.php');
			}
		?>

<div id="contenu"><script language="JavaScript" type="text/javascript"src="../../javascript/stdlib.js"></script> 
<?php                                      

			if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
			else 						 $cmd="";

			include("sous_menu.php");

			if(isset($_GET['id_espace'])){
				afficher_sous_menu("consulter_espace");
				include("consult_un_espace.php");
			}else{
					
				switch ($cmd) {

					case "creer_espace":
						afficher_sous_menu("creer_espace");
						include('create_espace.php');
						break;

					case "modif_comm":
						afficher_sous_menu("creer_espace");
						include('modif_commentaire.php');
						break;

					case "consulter_espace":
						afficher_sous_menu("consulter_espace");
						include('liste_espace.php');
						break;

					default             :
						afficher_sous_menu("consulter_espace");
						include('liste_espace.php');
						break;
				}
			}
			?></div>
			<?php include($LEA_REP."footer.php")?></div>
</body>
</html>
<?php
	ob_end_flush();
?>