<?php
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."modele/bdd/classe_periode.php");
require_once ($LEA_REP."modele/bdd/classe_classe.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../test_responsable.php");

	if(!isset($_POST['nomPeriode']) || !isset($_POST['nbJours']) || !isset($_POST['idPeriodeSrc']) || !isset($_POST['rang'])) exit();
	
	$nbJours = $_POST['nbJours'];
	
	// Chargement de la formation
	$formation = new Formation($_SESSION['id_for']);
	$formation->set_detail();
	
	// Chargement des classes
	$les_classes = $formation->get_classes();
	
	// Chargement de la période a dupliquer
	$periode = new Periode($_POST['idPeriodeSrc']);
	$periode->set_detail();
	
	// Chargement des identifiants des classes
	$idClasses = $periode->get_id_classes();
	
	// Creation de la nouvelle période
	$nouvellePeriode = new Periode(0);
	$nouvellePeriode->libelle = to_sql($_POST['nomPeriode']);
	$nouvellePeriode->rang = $_POST['rang'];
	$nouvellePeriode->suivi_cfa = $periode->suivi_cfa;
	$nouvellePeriode->suivi_entr = $periode->suivi_entr;
	$nouvellePeriode->consult_app = $periode->consult_app;
	$nouvellePeriode->consult_ma = $periode->consult_ma;
	$nouvellePeriode->consult_tuteur_cfa = $periode->consult_tuteur_cfa;
	$nouvellePeriode->consult_ens = $periode->consult_ens;
	$nouvellePeriode->consult_rl = $periode->consult_rl;
	$nouvellePeriode->id_for = $periode->id_for;
	
	$nouvellePeriode->insert();
	
	foreach ($idClasses as $id) {
		$calendrier = $periode->get_calendrier($id);
		if (isset($calendrier)) {
			$dtDebCfa = $periode->suivi_cfa ? decaler_dateAAAAMMDD($calendrier['date_debut_cfa'], $nbJours) : $calendrier['date_debut_cfa'];
			$dtFinCfa = $periode->suivi_cfa ? decaler_dateAAAAMMDD($calendrier['date_fin_cfa'], $nbJours) : $calendrier['date_fin_cfa'];
			$dtDebEntr = $periode->suivi_entr ? decaler_dateAAAAMMDD($calendrier['date_debut_entr'], $nbJours) : $calendrier['date_debut_entr'];
			$dtFinEntr = $periode->suivi_entr ? decaler_dateAAAAMMDD($calendrier['date_fin_entr'], $nbJours) : $calendrier['date_fin_entr'];
			$nouvellePeriode->ajouter_classe( $id, $dtDebCfa, $dtFinCfa, $dtDebEntr, $dtFinEntr);
		}
	}

	html_refresh("./options.php?cmd=liste_periodes");
	?>