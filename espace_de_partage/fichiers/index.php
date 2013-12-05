<?php 
if (file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
@session_start();
session_name("LEA_$RNE_ETAB");

if (isset($_SESSION['atok'])) {
	$atok = $_SESSION['atok'];
	$nom = $_SESSION["nom_".$atok];
	$prenom = $_SESSION["prenom_".$atok];
	$civilite = $_SESSION["civilite_".$atok];
	$nom_complet = "$civilite <font color='red'>$nom $prenom </font> ";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
	<title>LEA: Espace de partage</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<h2>
		Hum, hum....<br/>
		Vous cherchez quelque chose <?php echo $nom_complet?>?
	</h2>
</body>