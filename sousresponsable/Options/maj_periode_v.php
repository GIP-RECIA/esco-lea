<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: 
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_periode.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$les_classes = $formation->get_classes();

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else exit(); 

switch($action) {

case "nouv" :  	$periode = new Periode(0);
				$periode->libelle = to_sql($_REQUEST['libelle']);
				$periode->rang = trans_date($_REQUEST['rang']);				
				$periode->id_for = $_REQUEST['id_for'];
				
				if(isset($_REQUEST['suivi_cfa'])) $periode->suivi_cfa = 1;
				else $periode->suivi_cfa = 0;
				
				if(isset($_REQUEST['suivi_entr'])) $periode->suivi_entr = 1;
				else $periode->suivi_entr = 0;
				
				if(isset($_REQUEST['consult_app'])) $periode->consult_app = 1;
				else $periode->consult_app = 0;
				
				if(isset($_REQUEST['consult_ma'])) $periode->consult_ma = 1;
				else $periode->consult_ma = 0;
				
				if(isset($_REQUEST['consult_tuteur_cfa'])) $periode->consult_tuteur_cfa = 1;
				else $periode->consult_tuteur_cfa = 0;
				
				if(isset($_REQUEST['consult_ens'])) $periode->consult_ens = 1;
				else $periode->consult_ens = 0;
				
				if(isset($_REQUEST['consult_rl'])) $periode->consult_rl = 1;
				else $periode->consult_rl = 0;
				
				if( $periode->suivi_cfa == 1 ||  $periode->suivi_entr == 1){
				
						$periode->insert(); 
				
						if(isset($_REQUEST['les_id_cla'])) 
							 $les_id_cla = $_REQUEST['les_id_cla'];
						else $les_id_cla = array();	
					
						 if (count($les_classes) >  0){
		   						
						   foreach($les_classes as $classe){
				   
						   	if(in_array($classe->id_cla, $les_id_cla)) {
								 if(! $periode->est_declaree_par($classe->id_cla))						  	
									 $periode->ajouter_classe($classe->id_cla);
							}	 
							else $periode->supprimer_classe($classe->id_cla);	
				    				   
						    }				
				
			     		}
			  	
				}	
				
					echo" 
					<script langage='javascript'>
						window.opener.location.reload();
						window.close();
					</script>					
					";

																				
				break;
				
case "modif":  
					$periode = new Periode($_REQUEST['id_periode']);
					$periode->set_detail();					
					$periode->libelle = to_sql($_REQUEST['libelle']);
					$periode->rang = to_sql($_REQUEST['rang']);
					
				if(isset($_REQUEST['suivi_cfa'])) $periode->suivi_cfa = 1;
				else $periode->suivi_cfa = 0;
				
				if(isset($_REQUEST['suivi_entr'])) $periode->suivi_entr = 1;
				else $periode->suivi_entr = 0;
				
				if(isset($_REQUEST['consult_app'])) $periode->consult_app = 1;
				else $periode->consult_app = 0;
				
				if(isset($_REQUEST['consult_ma'])) $periode->consult_ma = 1;
				else $periode->consult_ma = 0;
				
				if(isset($_REQUEST['consult_tuteur_cfa'])) $periode->consult_tuteur_cfa = 1;
				else $periode->consult_tuteur_cfa = 0;
				
				if(isset($_REQUEST['consult_ens'])) $periode->consult_ens = 1;
				else $periode->consult_ens = 0;
				
				if(isset($_REQUEST['consult_rl'])) $periode->consult_rl = 1;
				else $periode->consult_rl = 0;
				
				
				if( $periode->suivi_cfa == 1 ||  $periode->suivi_entr == 1){
										
					$periode->update();
		
					if(isset($_REQUEST['les_id_cla'])) 
						 $les_id_cla = $_REQUEST['les_id_cla'];
					else $les_id_cla = array(); 	
					
					 if (count($les_classes) >  0){
		   						
					   foreach($les_classes as $classe){
				   
					   	if(in_array($classe->id_cla, $les_id_cla)) {
							 if(! $periode->est_declaree_par($classe->id_cla))						  	
								 $periode->ajouter_classe($classe->id_cla);
						}	 
						else $periode->supprimer_classe($classe->id_cla);	
				    				   
				      }																														
					}
				}	
					echo" 
					<script langage='javascript'>
						window.opener.location.reload();
						window.close();
					</script>					
					";
				break;

case "supp":   					
					$id_periode = $_REQUEST['id_periode'];
					$periode = new Periode($id_periode);																				
					$periode->delete();					
					html_refresh($_SERVER['HTTP_REFERER']);
				break;				

default     : exit();

}

?>		
