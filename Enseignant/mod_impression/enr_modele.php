<?php
include_once('../secure.php');
require_once("../../config/config.inc.php");
require_once($LEA_REP."modele/bdd/classe_param_impression.php");

$params = array();
if(isset($_SESSION["imp_type_formulaire"])) {
	$params['imp_type_formulaire'] = $_SESSION["imp_type_formulaire"];
}
if(isset($_SESSION["imp_type_livret"])) {
	$params['imp_type_livret'] = $_SESSION["imp_type_livret"];
}
if(isset($_SESSION["imp_type_suivi"])) {
	$params['imp_type_suivi'] = $_SESSION["imp_type_suivi"];
}
if(isset($_SESSION["imp_periode"])) {
	$params['imp_periode'] = unserialize($_SESSION["imp_periode"]);
}
if(isset($_SESSION["grouper_type_suivi"])) {
	$params['grouper_type_suivi'] = "On groupe par type de suivi";
}
if(isset($_SESSION["imp_modalite_arbre"])) {
	$params['imp_modalite_arbre'] = unserialize($_SESSION["imp_modalite_arbre"]);
}
if(isset($_SESSION["imp_arbre"])) {
	$params['imp_arbre'] = unserialize($_SESSION["imp_arbre"]);
}
$imp_modele = new Param_impression();
$imp_modele->id_for = $_SESSION["id_for"];
$imp_modele->id_usager = $_SESSION["id_ens"];
$imp_modele->libelle = utf8_decode($_POST["nom_modele"]);
$imp_modele->params = serialize($params);
$imp_modele->insert();
echo "<pre>";
var_dump(unserialize($imp_modele->params));
echo "</pre>";
?>