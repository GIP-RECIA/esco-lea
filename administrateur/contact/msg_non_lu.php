<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 15/12/05

/***********************************************************/

require_once("../config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");

/***********************************************************/

if (isset($_SESSION['id_admin']))   {
									$id_usager = $_SESSION['id_admin'];
									$href = $LEA_URL."administrateur/contact/contact.php";
}										
elseif (isset($_SESSION['id_ens'])) {
									$id_usager = $_SESSION['id_ens'];
									$href = $LEA_URL."Enseignant/Contact/contact.php";									
}									
elseif (isset($_SESSION['id_app'])) {
									$id_usager = $_SESSION['id_app'];
									$href = $LEA_URL."Apprenti/Contact/contact.php";
}									
elseif (isset($_SESSION['id_ma'])) {
									 $id_usager = $_SESSION['id_ma'];
									  $href = $LEA_URL."Maitre_apprentissage/Contact/contact.php";
}									
elseif (isset($_SESSION['id_rl'])) {
									 $id_usager = $_SESSION['id_rl'];
									 $href = $LEA_URL."Representant_legal/Contact/contact.php";
}									
elseif (isset($_SESSION['id_rvs'])){
									 $id_usager = $_SESSION['id_rvs'];
									 $href = $LEA_URL."Responsable_vie_scolaire/Contact/contact.php";
}									 
else html_refresh($LEA_URL);

$usager = new Usager($id_usager);

$nb = $usager->get_nb_messages_non_lus();

if($nb >= 1) { 
				$msg = "Vous avez recu ".$nb." message(s)";

echo"
<div style='
		margin:1em ;
		background: red;
		border: 1px solid #5896cf;
		color: #5896cf;
		font-weight: bold;	
		margin-right: 0;
		padding: 1.5em;
		height: 30px;
		text-align: center;			'>
<a href='$href' style='font-family: Arial, Helvetica, sans-serif; font-size: 16px;font-weight: bold;color:#FFFFFF;text-align:center;'> $msg </a>

</div>

";
/*
echo
"
<script language=\"JavaScript\">

w = window.open('Nouveaux messages' , '', 'scrollbars=no,resizable=no,width=300,height=100, top=330, left=430');

output ='<html><head> </head> <body bgcolor=\"red\" onClick=\"window.opener.location.replace(\'$href\'); window.close();\">';   

output +=   '<a href=\"#\"' + 'style=\"font-family: Arial, Helvetica, sans-serif; font-size: 16px;font-weight: bold;color:#FFFFFF;text-align:center;\"'
		     + '> $msg </a>';

output +=' </body>  </html>';   

w.document.write(output);

</script>";
*/
}
?>
