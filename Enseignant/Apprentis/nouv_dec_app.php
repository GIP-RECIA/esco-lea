<?php
/***********************************************************/
  // Copyright ? 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06
  // Contenu: Cette page contient le formulaire de d?claration 
  // correspondant aux travaux effectu?s en entreprise ou au CFA 
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
require_once($LEA_REP."modele/classe_gestion_declaration.php");

include_once($LEA_REP."Enseignant/secure.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/**********************************************************/
$enseignant = new Enseignant($_SESSION['id_ens']);
$formation = new Formation ($_SESSION['id_for']); // la formation de l'enseignant connect?

if(isset($_SESSION['declaration'])) {$declaration = $_SESSION['declaration'] ; 				
} else { afficher_msg_erreur("Aucune d&eacute;claration ne peut &ecirc;tre eff&egrave;ctu&eacute;e"); exit(); }

if(isset($declaration->id_periode))	$id_periode_select = $declaration->id_periode;
else $id_periode_select = 0;				

$apprenti = new Apprenti($declaration->id_app);
$apprenti->set_detail();

$est_responsable = $enseignant->est_responsable($_SESSION['id_for']); 
$est_tuteur = ($enseignant->id_ens == $apprenti->id_ens);

$config_lea = $formation->get_config_lea();

$les_arbres = $config_lea->get_arbres($declaration->type_suivi);

$periode = new Periode($declaration->id_periode);
$periode->set_detail();

$gest_dec = new Gestion_declaration($declaration); // classe de gestion d'une d?claration

$test_modif = 0;
?>
 <div id="top_l"></div>
 <div id="top_m">		
<?php 
	if($declaration->type_suivi =='entr' ) {
	    $img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png" >';
		echo"<h1> $img <span class=\"orange\">M</span>odifier une d&eacute;claration ".$config_lea->appelation_entr."</h1>";
	} elseif($declaration->type_suivi == 'cfa') {
 		$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png" >';
		echo"<h1> $img <span class=\"orange\">M</span>odifier une d&eacute;claration ".$config_term->terminologie_cfa."</h1>";
	}		
?>
 </div>
 <div id="top_r"></div> 
<script language="JavaScript" src="../../javascript/stdlib.js"></script>
<br><br><p>
 <?php echo"$config_lea->appelation_app : <b> $apprenti->nom $apprenti->prenom </b><br> 
 			P&eacute;riode  : <b> $periode->libelle </b>"; ?>  
</p>
<form name="theForm" action="nouv_dec_app_v.php" method="post" enctype="multipart/form-data" >
	<table width="571" height="90">
		<tr>
		 	<td width="100%" height="20" >
		       <?php
					if(count($les_arbres) > 0 ) {						
						foreach($les_arbres as $arbre){												 
							$les_modalites_suivi = $_SESSION['les_modalites_suivi_guide'][$arbre->id_arbre];
						
							if(count($les_modalites_suivi) > 0 ) {
						 		$test_modif = 1;						
						  		$gest_dec->tableau_modalites_suivi_guide($arbre, $les_modalites_suivi);
							}	  
						}//foreach
					}
				?> 
	        </td>
     	</tr>
		<tr>
		    <td height="20">
			<?php 				
				$les_modalites_suivi_libre = $_SESSION['les_modalites_suivi_libre'];
				if(count($les_modalites_suivi_libre) > 0 )	{
					$test_modif = 1;		   		
					$gest_dec->tableau_modalites_suivi_libre( $config_lea, $les_modalites_suivi_libre);
				}	
			?>
		    </td>
      	</tr>
		<tr>
		    <td height="19" class="center">
			<?php
				$joint_fichiers = 
					( $declaration->type_suivi == 'entr' && $config_lea->app_joint_fichiers_suivi_entr ) ||
					( $declaration->type_suivi == 'cfa' && $config_lea->app_joint_fichiers_suivi_cfa );
				 
				$joint_fichiers =	$joint_fichiers && ($est_tuteur || $est_responsable);	
				 
				if( $joint_fichiers ){ 
					$test_modif = 1;
					$gest_dec->tableau_fichier_joint();
				}
			?>
			</td>		
	    </tr>
		<tr>
		   	<td class="center"><br>
		    <?php
				  if($test_modif) echo'<input type="submit" name="valider" value="Valider la d&eacute;claration">';
				  else afficher_msg_erreur("Vous n'&ecirc;tes pas autoris&eacute; &agrave; faire une d&eacute;claration  "); 
			 ?>
			</td> 
		</tr>
 	</table>
</form>