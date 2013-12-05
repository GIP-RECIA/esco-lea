<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06
 
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");

@session_start();
/**********************************************************/

$declaration = $_SESSION['declaration'] ; 
$id_periode = $declaration->id_periode;
$periode = new Periode($id_periode);
$periode->set_detail();

$apprenti = new Apprenti($declaration->id_app);
$apprenti->set_detail();

$config_lea = $apprenti->get_config_lea();

if(isset($_SESSION['les_id_noeud'])) $les_id_noeud = $_SESSION['les_id_noeud'];
else $les_id_noeud = array();

if( $declaration->type_suivi=='entr' && ! $config_lea->suivi_entr_guide_actif) html_refresh("apprentis.php?cmd=modif_dec_libre");
if($declaration->type_suivi=='cfa' && ! $config_lea->suivi_cfa_guide_actif) html_refresh("apprentis.php?cmd=modif_dec_libre"); 

if($declaration->type_suivi=='entr') $arbre = $config_lea->get_arbre('ref_entr');
else $arbre = $config_lea->get_arbre('ref_cfa');

if( count ($arbre->get_modalites('app') ) + count ($arbre->get_modalites('ma') ) == 0 ) 
	html_refresh("apprentis.php?cmd=modif_dec_libre");


$arbre->set_libelles_niveaux(); // recupérer tous les noms des niveaux de l'arbre
$arbre->tab_noeuds = $arbre->get_noeuds();

if(count($arbre->libelles_niveaux) < 1 || count($arbre->tab_noeuds) <  1 ) {
	  html_refresh("apprentis.php?cmd=modif_dec_libre");
}	

$libelle_feuille = $arbre->libelles_niveaux[count($arbre->libelles_niveaux)-1 ];

// cette fonction affiche les noeus de l'arbre 

function afficher_arbre($id_noeud_racine, $arbre) {
		
		global $LEA_URL;
		global $les_id_noeud;
						
			$src_img_feuille =  $LEA_URL."images/feuille.png";

	  //ballayage du l'arbre
	  echo"<ul>";
    
		  for ($x=0; $x < count($arbre->tab_noeuds); $x++ ) {

    
		    if ($arbre->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
      
	    	   echo "<li>"; 
			   if( $arbre->tab_noeuds[$x]->type == "feuille") {
			   				
							if(in_array ($arbre->tab_noeuds[$x]->id_noeud, $les_id_noeud) ) {
								$checked = "checked";
								$style ='feuille_select';
							}	
							else {
									 $checked = "";
									 $style ='feuille';
							}		 
							
							$id =  $arbre->tab_noeuds[$x]->id_noeud; // l'identifiant de la feuille
								
								echo"<div id='$id'  class='$style'>
								     <input type='checkbox' name='les_id_noeud[]' value='$id' 
									 $checked 
									 onClick='select_feuille($id, this.checked)'
									 >
									 
									 ".$arbre->tab_noeuds[$x]->libelle .
									"</divt> 
									"; 
				}		
				else echo("<b>".$arbre->tab_noeuds[$x]->libelle."</b>");				
			       
				afficher_arbre($arbre->tab_noeuds[$x]->id_noeud, $arbre);
							
			   echo"</li>";	   
    		}
 		 }
	  echo"</ul>"; 
  
	}


 ?>
 <style>
 .feuille{
 	color ='#008000';
 }
 .feuille_select{
 	color ='#FFA500';
 }

 
 </style>
<script language="JavaScript">

function select_feuille(id, checked){
	
	var div = document.getElementById(id);
	
	
	if( checked == false ) div.className ='feuille';
							
	else div.className = 'feuille_select';		

}

</script>

			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">

	<table width="100%"  border="0" cellpadding="0" cellspacing="0" >
		   <tr>
		     <td height=""><p>
			 <span class="titre_page">
			 <?php 
			 if($declaration->type_suivi =='entr' )
				 echo"<img src='../../images/entreprise_dec.png' >";
			 else echo"<img src='../../images/cfa_dec.png' >";
			 
			  echo"Déclaration : $periode->libelle" 
			  ?>
			 </span></p>
			 </td>
		   </tr>
		   <tr>
		     <td height="" align="right"><span class="titre_page">
		       </span>
		       <?php 
				echo"$apprenti->nom $apprenti->prenom";
			   ?>
		       <hr class="trait">
		       </td>
      </tr>

		    <tr>
		      <td height="19"  valign="top">
			  
			  <form action="apprentis.php?cmd=modif_dec_ref_2" method="post">
			  
			  <center>
			  <table width="100%" >
			    <tr>
			      <td colspan="3"><?php
			  				
			  echo"<p> Veuillez repérer les ". strtolower($libelle_feuille) ."(s) à déclarer sur le ".strtolower($arbre->nom) ." de votre formation </p>";
			  
			  afficher_arbre(0, $arbre);
			  
			  ?>
			      </td>
		        </tr>
			    <tr align="center">
			      <td colspan="3">		          <input type="submit" name='submit_ref2' value="Valider"></td>
		        </tr>
			    <tr align="center">
			      <td colspan="3"><hr class="trait"></td>
		        </tr>
			    <tr>
			      <td width="56%">&nbsp;</td>
			      <td width="17%"><?php
			
					echo"<input type='button'  name='quitter' value='Quitter' 
			   			onClick=\"window.location.replace('quitter_dec.php')\" >
							
					";  
							?>
			      </td>
			      <td width="27%">&nbsp;&nbsp;
&nbsp;&nbsp;
<input type="submit" name='submit_ref' value="Suivant">
</td>
		        </tr>
			    </table>
			  </center>
			  </form>
			  </td>
      </tr>
		    <tr>
		      <td height="21"  valign="top">&nbsp;</td>
		    </tr>
  </table>  
</div>