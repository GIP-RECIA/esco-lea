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
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
/***********************************************************/
$config_term->terminologie_app = to_sql($_REQUEST['terminologie_app']);
$config_term->terminologie_ens = to_sql($_REQUEST['terminologie_ens']);
$config_term->terminologie_classe = to_sql($_REQUEST['terminologie_classe']);
$config_term->terminologie_rl = to_sql($_REQUEST['terminologie_rl']);
$config_term->terminologie_ma = to_sql($_REQUEST['terminologie_ma']);
$config_term->terminologie_tuteur_cfa = to_sql($_REQUEST['terminologie_tuteur_cfa']);
$config_term->terminologie_entr = to_sql($_REQUEST['terminologie_entr']);
$config_term->terminologie_suivi_cfa = to_sql($_REQUEST['terminologie_suivi_cfa']);
$config_term->terminologie_suivi_entr = to_sql($_REQUEST['terminologie_suivi_entr']);
$config_term->terminologie_lea = to_sql($_REQUEST['terminologie_lea']);
$config_term->terminologie_admin = to_sql($_REQUEST['terminologie_admin']);
$config_term->terminologie_cfa = to_sql($_REQUEST['terminologie_cfa']);
$config_term->terminologie_unit_pedag = to_sql($_REQUEST['terminologie_unit_pedag']);
$config_term->terminologie_rvs = to_sql($_REQUEST['terminologie_rvs']);
$config_term->terminologie_formation = to_sql($_REQUEST['terminologie_formation']);
$config_term->terminologie_rf = to_sql($_REQUEST['terminologie_rf']);

$config_term->update();
html_refresh("./terminologie.php");
?>