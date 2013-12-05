<?php 
require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();
if (!isset($_SESSION['id_admin'])){
	header('Location: ../index.html');
	exit();
}
header("Content-disposition: attachment; filename=lea.leav3");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: 'text/xml'\n"); // Surtout ne pas enlever le \n
header("Content-Length: ".filesize('./lea.leav3'));
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
header("Expires: 0");
readfile('./lea.leav3'); 

?> 
