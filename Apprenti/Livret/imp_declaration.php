<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/10/06

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
@session_start();
session_name("LEA_$RNE_ETAB");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_periode.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");

/**********************************************************/


function afficher_declaration($periode, $type_suivi){

	global $apprenti;
	$config_lea = $apprenti->get_config_lea();
	
	if($type_suivi=='cfa' && $periode->suivi_cfa) {
		$declaration = $apprenti->get_declaration( $periode->id_periode, 'cfa');
		$class_table ='periode_cfa';
		$class_tr = 'titre_periode_cfa';
		$titre = 'D&eacute;claration '.$config_lea->appelation_cfa.': '.$periode->libelle;									
		
	}		
	elseif($type_suivi=='entr' && $periode->suivi_entr) {		
		$declaration = $apprenti->get_declaration( $periode->id_periode, 'entr');
		$class_table ='periode_entr';
		$class_tr = 'titre_periode_entr';
		$titre = 'D&eacute;claration '.$config_lea->appelation_entr.': '.$periode->libelle;
	}
	else return;
	$les_arbres = $config_lea->get_arbres($declaration->type_suivi);

echo'
<table width="100%" cellspacing="0" class="'.$class_table.'">
  <tr class="'.$class_tr.'">
    <td height="30">
	';
	echo $titre.' &nbsp; &nbsp; &nbsp;
			  '.trans_date($declaration->date_dec);
echo'
	</td>
  </tr>
  <tr>
    <td height="100">
	';									  
		if($declaration->id_dec <= 0 ) echo"Aucune d&eacute;claration n'est effectu&eacute;e";
		else {
			if(	count($les_arbres) > 0 ) {

				foreach($les_arbres as $arbre){
						
					$declaration->afficher_feuilles_declarees($arbre,  $periode->id_periode);
						
				}//foreach
			}
					
			$declaration->afficher_tableau_modalites_suivi_libre($config_lea,  $periode->id_periode);
					  
			$declaration->afficher_signatures();
		}				


echo'     </td>
  </tr>
</table>
';

}

?>
