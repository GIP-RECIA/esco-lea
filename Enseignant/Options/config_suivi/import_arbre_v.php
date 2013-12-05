<?php
	
	if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
	elseif	(file_exists("../../config/config.inc.php")) 	 require_once("../../config/config.inc.php");
	elseif	(file_exists("../config/config.inc.php"))      	 require_once("../config/config.inc.php");
	
	include_once($LEA_REP."Enseignant/secure.php");
	
	require_once ($LEA_REP."modele/bdd/classe_arbre.php");
	require_once ($LEA_REP."modele/bdd/classe_formation.php");
	require_once ($LEA_REP."lib/stdlib.php");
	/***********************************************************/
	ini_set("max_execution_time",300); // la durée maximale d'exécution du script est 300 secondes
	
	include($LEA_REP."Enseignant/test_responsable.php");
	
	$formation = new Formation($_SESSION['id_for']);
	$formation->nom = $_SESSION['nom_formation'];
	$config_lea = $formation->get_config_lea();
	unset($_SESSION['erreur_import']);
	
	// Validation du fichier XML 
    $doc = new DOMDocument('1.0', 'UTF-8');
    if ($doc->load($_FILES['fichier']['tmp_name'])) {
		libxml_use_internal_errors(true);
	    if ($doc->schemaValidate($LEA_REP."modele/arbre.xsd")) {
	    	// Creation de l'arbre à partir de sa representation XML

	    	$arbre = Arbre::from_xml($doc->saveXML(), $_POST['nom'], $_POST['idConfig'], $_POST['typeSuivi']);
			$arbre->insertAll();
			$_SESSION['msg_info']="L'arbre '".$_POST['nom']."' a été importé";
	    } else {
	    	// La structure du fichier XML importé est invalide
	    	$array = libxml_get_errors();
	    	$msg ="La structure XML du fichier ".$_FILES['fichier']['name']." est invalide :";
	    	foreach($array as $ligne) {
	    		$msg .= "<br/>".$ligne->message;
	    	}
	    	$_SESSION['erreur_import'] = $msg;
	    }
    } else {
    	// Le fichier n'est pas valide
    	$_SESSION['erreur_import'] = "Fichier ".$_FILES['fichier']['name']." n'est pas un fichier XML valide";
    }
	html_refresh("../options.php?cmd=suivi_guide_".$_GET['type_suivi']."&type_suivi=".$_GET['type_suivi']."&suivi=guide&selmenu=guide");
?>
