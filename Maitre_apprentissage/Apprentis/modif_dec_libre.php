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
require_once($LEA_REP."modele/bdd/classe_document_declare.php");

/**********************************************************/

$declaration = $_SESSION['declaration'];
$periode = new Periode ($declaration->id_periode);
$periode->set_detail();

$apprenti = new Apprenti($declaration->id_app);
$apprenti->set_detail();

$config_lea = $apprenti->get_config_lea();


// les_noeuds_modalites_nf : tableau à deux dimensions  contenant les valeur saisies pour valider les feuilles sélectionnées avec les  modalités numériques Numérique Fréquence 
// les_noeuds_modalites_nn : tableau à deux dimensions contenant les valeur saisies pour valider les feuilles sélectionnées avec les  modalités numériques Numérique Note.
// les_noeuds_modalites_m : tableau contenant les identifiants des  choix sélectionnés pour valider les feuilles sélectionnées avec les  modalités Multiple.

if(isset($_REQUEST['les_noeuds_modalites_nf'])) $_SESSION['les_noeuds_modalites_nf'] = $_REQUEST['les_noeuds_modalites_nf'];
if(isset($_REQUEST['les_noeuds_modalites_nn'])) $_SESSION['les_noeuds_modalites_nn'] = $_REQUEST['les_noeuds_modalites_nn'];
if(isset($_REQUEST['les_noeuds_modalites_m']))  $_SESSION['les_noeuds_modalites_m'] = $_REQUEST['les_noeuds_modalites_m'];

// cette fonction permet d'afficher une modalité utilisée pour le suivi libre

function afficher_modalite($modalite){
		
		global $LEA_URL;					
		global $les_id_noeud;
		global $arbre;		
		// la classe de cette modalite
		
		$classe = get_class($modalite); 
			
		switch($classe){
		
		
		case "modalite_reponse_libre":
									  $nom = "les_modalites_rl[$modalite->id_modalite]";
									  
									   if( 										 	
											isset($_SESSION['les_modalites_rl'][$modalite->id_modalite])
										  )										 
										 	 $value = $_SESSION['les_modalites_rl'][$modalite->id_modalite];
											 
										 else $value = "";
									  
									  if($modalite->type_affichage == 'champ_texte') 
											echo"<input name='$nom'  type='text' size='60' value='$value'>";
									  else 	
					                        echo "<textarea   name='$nom' cols='60' rows='5'>$value</textarea>"; 
										 	 
										break;								
											
		case "modalite_reponse_choix":
										
								$nom = "les_modalites_rc[$modalite->id_modalite][]";
								
								if( isset($_SESSION['les_modalites_rc'][$modalite->id_modalite]) )										 
									      $les_id_reponses_select = $_SESSION['les_modalites_rc'][$modalite->id_modalite];
											 
								else $les_id_reponses_select = array();
								
								$les_reponses = $modalite->get_reponses();
										
							if($modalite->type_affichage == 'case') {
			
									if($modalite->type_choix == 'unique' ) $type = 'radio';
									else  $type = 'checkbox';
			
									$output = "";
									
									foreach($les_reponses as $reponse) {
									
										if( in_array($reponse->id_reponse, $les_id_reponses_select ) )
											 $checked = "checked";
										else $checked = "";
													
										$output.=" <input type='$type' name='$nom' value='$reponse->id_reponse' $checked > $reponse->reponse <br>";
									}	
							}		
							else {
			
								if($modalite->type_choix == 'unique' ) $type = '';
								else  $type = 'multiple';			

								$output = "<select name='$nom' $type>";
								
								foreach($les_reponses as $reponse) {
									if( in_array($reponse->id_reponse, $les_id_reponses_select ) )
											 $selected = "selected";
									else $selected = "";
									
									$output.= "<option value='$reponse->id_reponse' $selected > $reponse->reponse </option>";			
								}	
								
								$output.= "</select>";	
       					  }
						  	echo "$output";		 
									break;		
		}

}    


function afficher_tableau_modalites(){
	
	global $config_lea; 
	global $declaration;
		
	$les_modalites = array_merge ($config_lea->get_modalites($declaration->type_suivi, 'app'),
								  $config_lea->get_modalites($declaration->type_suivi, 'ma')
								 );
		
	if( count($les_modalites) > 0 ) {

		foreach($les_modalites as $modalite ) {	
		 echo "<table width='100%'>";
			echo"<tr class='titre_tableau'>
					<td>
						$modalite->libelle
					</td>
				 </tr>
				 <tr>	
				  <td class='cellule'>";
						afficher_modalite($modalite);
			echo" </td>	
				 </tr>
			 </table>";
		}
		
	}		
}

function afficher_fichiers_joints(){
		
	global $declaration; 
	global $URL_DOCUMENTS_DECLARES; 
	

		 $les_fichiers = $declaration->get_documents_declares();
			  
			  	if( count($les_fichiers) > 0 ) {
					 echo "<table width='70%'>
						    <tr class='sous_titre_tableau'>
								<td>
									Vos fichiers joints 
								</td>
							 </tr>";
					foreach($les_fichiers as $fichier ) {	
		
						$url = $URL_DOCUMENTS_DECLARES.urlencode($fichier->src_doc);						
						
						if($fichier->confidentialite) $checked ='checked';
						else  $checked ='';
						
						echo"	 <tr>	
							  		 <td class='cellule' height='50'>
									 	<p>										
								 		<a href = '#' onClick=\"window.open('$url','','')\" >";
											echo($fichier->get_nom());
						echo"			</a>[ <a href= 'supprimer_doc.php?id_doc=$fichier->id_doc'  onClick=\"return deleteConfirm('ce document')\" >Supprimer</a> ]
										&nbsp;&nbsp;&nbsp;
										<input type='checkbox' name= 'files_modif[]' value='$fichier->id_doc' $checked> Est confidentièl 
										
										</p>							
							 		</td>	
					 			</tr>";
			
					}
				 
			 echo"</table>";
		
				}
}						

 ?>

			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">


	<table width="100%" height="360"  border="0" cellpadding="0" cellspacing="0" >
		   <tr>
		     <td height="" colspan="2"><p>
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
		     <td height="" colspan="2" align="right"><?php 
				echo"$apprenti->nom $apprenti->prenom";
			   ?>
               <hr class="trait"></td>
      </tr>

		    <tr>
		      <td height="19" colspan="2"  valign="top"><h4>&nbsp; </h4></td>
      </tr>
		    <tr>
		      <td height="261" colspan="2" align="center"  valign="top">
			  <form action="valider_dec.php" method="post" enctype="multipart/form-data">
			  <?php
			  if( 
			  	($declaration->type_suivi == 'entr' && $config_lea->app_joint_fichiers_suivi_entr)||
				($declaration->type_suivi == 'cfa' && $config_lea->app_joint_fichiers_suivi_cfa)
				)    
			   
			   {
			  ?>
			  <table width="64%" height="110" border="0" cellspacing="0">
                <tr class="titre_tableau">
                  <td width="65%" height="21" colspan="2"> Veuillez joindre un fichier &agrave;
                    votre d&eacute;claration </td>
                </tr>
                
                <tr>
                  <td height="26" class="cellule"><p> Nouveau fichier joint </p> </td>
                  <td class="cellule"><p>
                    <input type="file" name="fichier" >
                  </p>
                  <p>
                    <input name="confidentialite" type="checkbox" value="checkbox" >
			Est confidenti&egrave;l&nbsp;&nbsp; 
				</p>
				</td>
                </tr>
                <tr>
                  <td height="21" colspan="2" class="cellule">
				  <?php
				  afficher_fichiers_joints();
				  ?>
				  
				  
				  </td>
                </tr>
              </table>
			  <?php
			  }
			  ?>
			  <table width="64%" height="59" border="0" cellspacing="0">
                <tr>
                  <td>
                    <h3>
                      <?php afficher_tableau_modalites();?>
                    </h3>
                  </td>
                </tr>
              </table>
			  <p>
			  <?php
			
			echo"<input type='button'  name='quitter' value='Quitter' 
			   			onClick=\"window.location.replace('quitter_dec.php')\" >
							&nbsp;&nbsp;&nbsp;
				";  
			  
		if(isset($_SESSION['les_id_noeud']) )
			echo"<input type='button'  name='' value='Pr&eacute;cedent' 
			      onClick=\"window.location.replace('apprentis.php?cmd=nouv_dec_ref_2')\">"; 		
		   
   				?>
		&nbsp;&nbsp;
	    <input name="submit" type="submit" value="Enregistrer ma d&eacute;claration">
	        </p>
			
			  </form>
			  
			  </td>
      </tr>
</table>  
</div>
