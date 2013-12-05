<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 06/09/05
// Contenu:
/***********************************************************/
include_once"sous_menu.php";
/***********************************************************/
if(isset($_REQUEST['profil'])) {
	$profil=$_REQUEST['profil'];
}
else {
	$profil="app";
}

switch($profil){

	case "app":
		afficher_sous_menu("cons_liste_app");
		include("nouv_usag_app.php");
		break;
	case "ens":
		afficher_sous_menu("cons_liste_ens");
		include("nouv_usag_ens.php");
		break;
	case "ma":
		afficher_sous_menu("cons_liste_ma");
		include("nouv_usag_ma.php");
		break;
	case "rl":
		afficher_sous_menu("cons_liste_rl");
		include("nouv_usag_rl.php");
		break;
	case "rvs":
		afficher_sous_menu("cons_liste_rvs");
		include("nouv_usag_rvs.php");
		break;
	case "admin":
		afficher_sous_menu("cons_liste_admin");
		include("nouv_usag_admin.php");
		break;
	default     :
		afficher_sous_menu("cons_liste_app");
		include("nouv_usag_app.php");
		break;

}

?>
