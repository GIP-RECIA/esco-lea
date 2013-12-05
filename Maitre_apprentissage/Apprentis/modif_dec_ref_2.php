<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06

/***********************************************************/
@session_start();
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");

/**********************************************************/

$declaration = $_SESSION['declaration'];

$apprenti = new Apprenti($declaration->id_app);
$apprenti->set_detail();

$config_lea = $apprenti->get_config_lea();

$periode = new Periode ($declaration->id_periode); // la période à déclarer
$periode->set_detail();

if(isset($_REQUEST['les_id_noeud'])){
									 $les_id_noeud = $_REQUEST['les_id_noeud'];
									 $_SESSION['les_id_noeud'] = $les_id_noeud;
}
elseif(isset($_REQUEST['submit_ref'])) {
			
				$_SESSION['les_id_noeud'] = NULL;
				html_refresh("apprentis.php?cmd=modif_dec_libre");
}				
elseif(isset ($_SESSION['les_id_noeud']))  $les_id_noeud = $_SESSION['les_id_noeud'];
else html_refresh("apprentis.php?cmd=modif_dec_libre");

if($declaration->type_suivi=='entr') $arbre = $config_lea->get_arbre('ref_entr');
else $arbre = $config_lea->get_arbre('ref_cfa');

$arbre->set_libelles_niveaux(); // recupérer tous les noms des niveaux de l'arbre
$arbre->tab_noeuds = $arbre->get_noeuds();

if(count($arbre->libelles_niveaux) < 1 || count($arbre->tab_noeuds) <  1 ) {
	 html_refresh("apprentis.php?cmd=modif_dec_libre");
}	



// Cette fonction affiche la modalite $modalite 

function afficher_modalite($modalite, $id_noeud){
		
		global $LEA_URL;					
		global $les_id_noeud;
		global $arbre;		
		// la classe de cette modalite
		
		$classe = get_class($modalite); 
			
		switch($classe){
		
		case "modalite_numerique_frequence" : 

										 $nom = "les_noeuds_modalites_nf[".$id_noeud."][".$modalite->id_modalite."]";
										 
										 if( 										 	
											isset($_SESSION['les_noeuds_modalites_nf'][$id_noeud][$modalite->id_modalite])
										   )										 
										 	  $value = $_SESSION['les_noeuds_modalites_nf'][$id_noeud][$modalite->id_modalite];
											 
										 else $value = 0;	 
										 
										 if($value < 0) $value = 0;
										 
										 
										 echo"<input name='$nom'  type='text' size='4' value='$value'> <br>";
										 break;
	
											
		case "modalite_numerique_note"	   : 

										 $nom = "les_noeuds_modalites_nn[".$id_noeud."][".$modalite->id_modalite."]";
										 
										 if( 										 	
											isset($_SESSION['les_noeuds_modalites_nn'][$id_noeud][$modalite->id_modalite])
										   )										 
										 	 $value = $_SESSION['les_noeuds_modalites_nn'][$id_noeud][$modalite->id_modalite];
											 
										 else $value = 0;
										 
										 if($value < 0) $value = 0;
										 	 
										 echo"<input name='$nom' type='text' size='4' value='$value'> /" ;
										 echo"$modalite->note_max";
									 	 break;								
											
		case "modalite_multiple"		   :								

									$les_choix = $modalite->get_choix();
									if($modalite->type_choix == 'unique' ) { 
															$type = 'radio';
															
									}
									else  {
											$type = 'checkbox';
											
									}		
									
									
									$output = "";

									$nom = "les_noeuds_modalites_m[".$id_noeud."][".$modalite->id_modalite."][]";
									
									 if( 								 	
											isset($_SESSION['les_noeuds_modalites_m'][$id_noeud][$modalite->id_modalite])
										 )										 
									      $les_id_choix_select = $_SESSION['les_noeuds_modalites_m'][$id_noeud][$modalite->id_modalite];
											 
									 else $les_id_choix_select = array();
									 
									foreach($les_choix as $choix) { 
										if( in_array($choix->id_choix, $les_id_choix_select ) )
											 $checked = "checked";
										else $checked = "";				
										
										$output.=" <input name='$nom' type='$type' value='$choix->id_choix' $checked > $choix->libelle ";
									}
									
									echo"$output";
									break;		
		}
											 		 	
	
}    


function afficher_tableau_modalites(){
	
	global $arbre; 
	global $les_id_noeud;
	
	$libelle_feuille = $arbre->get_libelle_feuille();
	
	$les_modalites = array_merge ($arbre->get_modalites('app'), $arbre->get_modalites('ma'));
		
	if( count($les_modalites) > 0 ) {
	
		echo "<table width='100%'>";
			echo"<tr class='titre_tableau'>
					<td>
						$libelle_feuille
					</td>";
				
				foreach($les_modalites as $modalite ) {	
						echo"<td>
							$modalite->libelle
							</td>";	
						
											
				}
			echo"</tr>";
		
		$style="";
		
		foreach($les_id_noeud as $id_noeud){
			
			if($style == "") $style ="cellule";
			else $style= "";
			
			$noeud =  new Noeud($id_noeud, $arbre->id_arbre);
			$noeud->set_detail();
		
			echo"<tr class='cellule'>
					<td width='50%'>
						$noeud->libelle
					</td>";
				
				foreach($les_modalites as $modalite ) {	
						echo"<td>";
							afficher_modalite($modalite, $noeud->id_noeud);
						echo"</td>";	
						
											
				}
			echo"</tr>";
		}
		echo"</table> ";					 
															
	}

}

 ?>


			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">

	<table width="100%"  border="0" cellpadding="0" cellspacing="0" >
		   <tr>
		     <td height=""><span class="titre_page"><?php 
			 if($declaration->type_suivi =='entr' )
				 echo"<img src='../../images/entreprise_dec.png' >";
			 else echo"<img src='../../images/cfa_dec.png' >";
			 
			  echo"Déclaration : $periode->libelle" 
			  ?>
		     </span>
			 </p>
			 </td>
		   </tr>
		   <tr>
		     <td height="" align="right"><?php 
				echo"$apprenti->nom $apprenti->prenom";
			   ?>
               <hr class="trait"></td>
      </tr>

		    <tr>
		      <td height="19" align="center"  valign="top">
			  
			  <form action="apprentis.php?cmd=modif_dec_libre" method="post">
			  			  
				  <table width="100%" border="0" cellspacing="0">
				    <tr>
				      <td align="center">
					  <table width="100%" border="0">
					    <tr>
					      <td colspan="3"><h3> Veuillez valider les modalités suivantes
                                <h3>
                                  <?php afficher_tableau_modalites();?>
                                </h3>
				          </h3></td>
				        </tr>
					    <tr align="center">
					      <td colspan="3"><input name="submit2" type="submit" value="Valider"></td>
				        </tr>
					    <tr>
					      <td colspan="3" align="center"><hr class="trait"></td>
				        </tr>
					    <tr>
					      <td width="57%">&nbsp;</td>
					      <td width="17%">
						   <?php
			
					echo"<input type='button'  name='quitter' value='Quitter' 
			   			onClick=\"window.location.replace('quitter_dec.php')\" >
							
					";  
							?>
						  </td>
					      <td width="26%"><input type="button"  name="Submit2" value="Pr&eacute;cedent" 
			 			  onClick="window.location.replace('apprentis.php?cmd=modif_dec_ref')" >
							&nbsp;&nbsp;
							<input name="submit" type="submit" value="Suivant"></td>
				        </tr>
					    </table>
					  <p>&nbsp;</p></td>
			        </tr>
				    <tr>
				      <td align="center">&nbsp;				      </td>
			        </tr>
			    </table>
			  </form>
			  </td>
      </tr>
  </table>  
</div>
