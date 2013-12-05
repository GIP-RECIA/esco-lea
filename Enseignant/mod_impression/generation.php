<?php
include_once('../secure.php');
require_once("../../config/config.inc.php");

if(isset($_POST['ordre'])) {
	$_SESSION["imp_ordre"] = $_POST['ordre'];
}
?>