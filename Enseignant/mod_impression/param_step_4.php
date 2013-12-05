<?php
/***********************************************************/   
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.1
  // Date: 04/04/07
/***********************************************************/
require_once('../secure.php');

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_param_criteres.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."modele/bdd/classe_arbre.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
require_once($LEA_REP."modele/classe_declaration_vierge.php");

define("_REP_", $LEA_REP);
//define("FPDF_FONTPATH","./fpdf/font/");
require($LEA_REP."lib/fpdf/fpdf.php");
require($LEA_REP."lib/fpdf/pdf.php");

require_once("genpdf.php");
$GenPDF = new GenPDF($_SESSION["imp_apprenti_tmp"], $_SESSION["imp_ordre"]);
//generaleGen($_SESSION["imp_apprenti_tmp"], $_SESSION["imp_ordre"]);*/
?>