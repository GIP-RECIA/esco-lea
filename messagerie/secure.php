<?php
if (!isset($_SESSION['messagerie'])){ 
	header('Location: '.$LEA_URL);
	exit();
}
?>