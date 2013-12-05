<?php
/***********************************************************/  
  // Auteur : FrÃ©dÃ©ric GOYER
  // Version : 1.0.2
  // Date: 04/07
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

require_once("../../config/config.inc.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
include("../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$config_lea = $formation->get_config_lea();

$config_lea->appelation_app = to_sql($_REQUEST['appelation_app']);
$config_lea->appelation_ens = to_sql($_REQUEST['appelation_ens']);
$config_lea->appelation_classe = to_sql($_REQUEST['appelation_classe']);
$config_lea->appelation_rl = to_sql($_REQUEST['appelation_rl']);
$config_lea->appelation_ma = to_sql($_REQUEST['appelation_ma']);
$config_lea->appelation_tuteur_cfa = to_sql($_REQUEST['appelation_tuteur_cfa']);
$config_lea->appelation_entr = to_sql($_REQUEST['appelation_entr']);
$config_lea->appelation_suivi_cfa = to_sql($_REQUEST['appelation_suivi_cfa']);
$config_lea->appelation_suivi_entr = to_sql($_REQUEST['appelation_suivi_entr']);

$config_lea->update();
html_refresh("./options.php?cmd=terminologie");
?>