<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/08/05
/***********************************************************/

require_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");


require_once($LEA_REP."modele/bdd/classe_modalite_multiple.php");
require_once($LEA_REP."modele/bdd/classe_choix_modalite_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="modif";

switch($action) {
				
case "modif":  if( isset($_REQUEST['id_modalite']))  {
					
					$modalite = new Modalite_multiple($_REQUEST['id_modalite']);
					
					$modalite->set_detail();
										
		 		 	$modalite->libelle = to_sql($_REQUEST['libelle']);
					 
			         if(isset($_REQUEST['type_choix'])) $modalite->type_choix = $_REQUEST['type_choix'];
					 else  $modalite->type_choix ='unique';												 				 						
					 
					 $modalite->update();
					
					$les_choix = $_REQUEST['les_choix'];
					
					foreach($les_choix as $id_choix => $libelle){
					
					$choix = new Choix_modalite_multiple( $id_choix);
					$choix->set_detail();
					$choix->libelle = $libelle;
					
					if($choix->libelle =="" ) $choix->delete();
					else $choix->update();										
					}
					
							$choix = new Choix_modalite_multiple(0);
							$choix->libelle = to_sql($_REQUEST['nouveau_choix']);				
							$choix->id_modalite = $modalite->id_modalite;
							if($choix->libelle!='') $choix->insert();
				}
					echo" 
					<script langage='javascript'>
						window.opener.location.reload();
						window.close();
					</script>					
					";
				break;

case "supp":   		$id_modalite = $_REQUEST['id_modalite'];
					$modalite = new Modalite_multiple($_REQUEST['id_modalite']);													
					$modalite->delete();															
					html_refresh($_SERVER['HTTP_REFERER']);
				break;				

default     : exit();

}
?>		