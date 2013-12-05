<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06
  // Contenu: Cette page contient le formulaire de déclaration 
  // correspondant aux travaux effectués en entreprise ou au CFA 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/classe_gestion_declaration.php");

include("../secure.php");

/**********************************************************/

if(isset($_SESSION['declaration'])) {
				
				$declaration = $_SESSION['declaration'] ; 				
}							
else { afficher_msg_erreur("Aucune déclaration ne peut être efféctuée"); exit(); }

if(isset($declaration->id_periode))
				$id_periode_select = $declaration->id_periode;
else			$id_periode_select = 0;				

$apprenti =  new Apprenti($declaration->id_app);
$apprenti->set_detail();

$config_lea = $apprenti->get_config_lea();

$les_arbres = $config_lea->get_arbres($declaration->type_suivi);

$periode = new Periode($declaration->id_periode);
$periode->set_detail();

$gest_dec = new Gestion_declaration($declaration); // classe de gestion d'une déclaration

?>  
 <div id="top_l"></div>
 <div id="top_m">
		
<?php 
		
 if($declaration->type_suivi =='entr' ) {
	    $img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png" >';
		echo"<h1> $img <span class=\"orange\">M</span>odifier une déclaration entreprise</h1>";			   
 }		
 elseif($declaration->type_suivi == 'cfa') {
 		$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png" >';
		echo"<h1> $img <span class=\"orange\">M</span>odifier une déclaration CFA</h1>";			   
}		
  

?>
 </div>
 <div id="top_r"></div> 

<script language="JavaScript" src="../../javascript/stdlib.js">

</script>

<br><br><br><br>
 <?php echo"Apprenti : <b> $apprenti->nom $apprenti->prenom </b><br> 
 			Période  : <b> $periode->libelle </b>"; ?>  

  <form name="theForm" action="nouv_dec_app_v.php" method="post" enctype="multipart/form-data" >
	<table width="572" height="90">
		    <tr>
		      <td width="100%" height="20" >
		       <?php
					if(count($les_arbres) > 0 ) {
						
						
						foreach($les_arbres as $arbre){												 
						
						$les_modalites_suivi_guide = $_SESSION['les_modalites_suivi_guide'][$arbre->id_arbre];
						
							if(count($les_modalites_suivi_guide) > 0 ) {
								 $gest_dec->tableau_modalites_suivi_guide($arbre, $les_modalites_suivi_guide );
							}	  
						}//foreach
					}
					else echo'<br><br> Aucun arbre n\'est créé <br> <br>';
			
					?> 
	          </td>
     		</tr>
		    <tr>
		      <td>
			  <br>
			   <?php 
			   				
					$les_modalites_suivi_libre = $_SESSION['les_modalites_suivi_libre'];			   		
					$gest_dec->tableau_modalites_suivi_libre($config_lea, $les_modalites_suivi_libre);
				 ?>
		      </td>
      </tr>
		   
  </table>
  <p>&nbsp;  </p>
    <p>
      <input type="submit" name="valider" value="Valider la d&eacute;claration">
  </p>
</form>

 