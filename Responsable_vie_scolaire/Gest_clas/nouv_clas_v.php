<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 23/08/05
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
/***********************************************************/

if (isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="";

if ($action=="modif") $id_cla=$_REQUEST['id_cla'];
else $id_cla=0; 

		
	
if ($action=="nouv") {
		
		$classe = new Classe(0);	
		$classe->libelle = to_sql($_REQUEST['libelle']);
		$classe->niveau_etude = to_sql($_REQUEST['niveau_etude']);	
		$classe->id_for = to_sql($_REQUEST['id_for']);
		$classe->ens = 0;
		
	    $classe->insert();												
		html_refresh("gest_clas.php?cmd=cons_clas&id_for=".$classe->id_for);

}	 	
elseif ($action=="modif") {										

		$classe = new Classe($id_cla);
		$classe->set_detail();	
		$classe->libelle = to_sql($_REQUEST['libelle']);
		$classe->niveau_etude = to_sql($_REQUEST['niveau_etude']);	
		$classe->id_for = to_sql($_REQUEST['id_for']);
        
		$classe->update();
		html_refresh("gest_clas.php?cmd=cons_clas&id_for=".$classe->id_for);

	}
else html_refresh ($_SERVER['HTTP_REFERER']);		 	

 ?>