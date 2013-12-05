<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/09/05
/***********************************************************/
include_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/

include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();


if(isset($_REQUEST['id_arbre'])) { 
			$id_arbre = $_REQUEST['id_arbre']; 			
}			
else exit(); 


$arbre = new Arbre($id_arbre);
$arbre->set_detail();

if($arbre->id_config != $config_lea->id_config) exit(); 

$arbre->set_libelles_niveaux();
$nb_niveaux = count($arbre->libelles_niveaux);
$les_feuilles = $arbre->get_feuilles(); // les feuilles de l'arbre


if( $nb_niveaux > 0) $libelle_dernier_niveau = $arbre->libelles_niveaux[$nb_niveaux-1];
else { afficher_msg_erreur("votre arbre ne comporte aucun niveau"); exit();}

if(isset($_REQUEST['acteur'])) $acteur = $_REQUEST['acteur'];
else $acteur = "";

$les_modalites = $arbre->get_modalites($acteur);


// Cette fonction visualise la modalité $modalite

function afficher_modalite($modalite){
		
		global $LEA_URL;
		global $les_feuilles;
			
		$src_img_modif = $LEA_URL."images/b_edit.png";
		$src_img_supp =  $LEA_URL."images/b_drop.png";
		
		if(count($les_feuilles) > 0 ) $libelle_feuille = $les_feuilles[0]->libelle;
		else $libelle_feuille ="XXXXXXXXXXX"  ;
		
		// la classe de cette modalite
		
		$classe = get_class($modalite); 
			
		switch($classe){
		
		case "modalite_numerique_frequence" : 
									$output = "<input  type='text' size='4' disabled>";
									$lien_modif =
										"<a href ='#' 
										onClick=\"window.open('modifier_modalite_numerique_frequence.php?id_modalite=$modalite->id_modalite','','width=600, height=600 scrollbars=yes' )\" > 
									 	Modifier cette modalite
										</a>";
									$lien_supp = 
										"<a href ='modifier_modalite_numerique_frequence_v.php?action=supp&id_modalite=$modalite->id_modalite' 
										  onClick='return deleteConfirm(\"cette modalite\")'
										 > Supprimer cette modalite </a>";
									break;
											
		case "modalite_numerique_note"	   : 
									
									$output = "<input  type='text' size='4' disabled>/".$modalite->note_max;
									$lien_modif =
										"<a href ='#' 
										onClick=\"window.open('modifier_modalite_numerique_note.php?id_modalite=$modalite->id_modalite','','width=600, height=600 scrollbars=yes' )\" > 
									 	Modifier cette modalite
										</a>";
									$lien_supp = 
										"<a href ='modifier_modalite_numerique_note_v.php?action=supp&id_modalite=$modalite->id_modalite' 
										  onClick='return deleteConfirm(\"cette modalite\")'
										 > Supprimer cette modalite </a>";
									break;								
											
		case "modalite_multiple"		   :								

									$les_choix = $modalite->get_choix();
									if($modalite->type_choix == 'unique' ) $type = 'radio';
									else  $type = 'checkbox';
			
									$output = "";
									foreach($les_choix as $choix) 			
									$output.=" <input type='$type' name='reponse' disabled > $choix->libelle <br>";
									
									$lien_modif =
										"<a href ='#' 
										onClick=\"window.open('modifier_modalite_multiple.php?id_modalite=$modalite->id_modalite','','width=600, height=600 scrollbars=yes' )\" > 
									 	Modifier cette modalite
										</a>";
									$lien_supp = 
										"<a href ='modifier_modalite_multiple_v.php?action=supp&id_modalite=$modalite->id_modalite' 
										  onClick='return deleteConfirm(\"cette modalite\")'
										 > Supprimer cette modalite </a>";
									break;		
		}
											 
		 	echo"
		     <table width ='60%' cellspacing='0' >
			 	<tr class ='titre_tableau' width ='100%' >
					 <td  colspan='2'>
					Cette Modalité se valide comme suit 
			 		</td>
	           </tr>
			 	<tr class ='sous_titre_tableau' width='100%'  >
					 <td colspan='2'>
					 $modalite->libelle 					
			 		</td>													 		
	           </tr>
   			 <tr class = 'cellule'>
			 		<td>
					 $libelle_feuille
			 		</td>
					<td>
					 $output
			 		</td>
	           </tr>
			   <tr align='right' class ='titre_tableau' >
					 <td colspan='2'>
					 <img src='$src_img_modif' border='0' title='modifier'> 
					 $lien_modif	 &nbsp;&nbsp;&nbsp;
					 <img src='$src_img_supp' border='0' title='supprimer'> 
					 $lien_supp
			 		</td>
	           </tr>

			</table>";  	

	
	}    

?>

<html>
	<head>		
		<link rel="stylesheet" href="../../../styles/enseignant.css" type="text/css">
		<script language="JavaScript" src="../../../javascript/stdlib.js">
		</script>		

	</head>
	<body>

<?php require("../../header.php"); ?>
			<div id="top_l"></div><div id="top_m"><h1></h1></div><div id="top_r"></div>
			<div id="m_contenu">
	
<table width="100%" height="10%" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="81%" height="24">
			<span class="titre_page">
		    <?php
			if ($arbre->type == "ref_entr") {
			    echo"<img src='".$LEA_URL."images/entreprise_dec.png'>";
				
			}
			elseif($arbre->type == "ref_cfa") {
			echo"<img src='".$LEA_URL."images/cfa_dec.png'>";			
			}
			?>
		    Mode de validation du <?php echo"$arbre->nom"; ?>			</span></td>
            <td width="19%"><?php afficher_boutton_fermer(); ?>
</td>
          </tr>
          <tr valign="top">
            <td  colspan="2">			
			<?php include("menu_maj_referentiel.php")?>
			</td>
  </tr>
          <tr valign="top">
            <td height="226" colspan="2" align="center">
			<?php 
				if(count($les_feuilles) > 0) {
			?>			<table width="90%" border="0">
              <tr >
                <td height="34" align="center" >
                  <form name="form1" method="get" action="">
                    
                      <input type="hidden" name="id_arbre" value="<?php echo"$arbre->id_arbre" ?>">
                    
                    <p>Vous d&eacute;sirez proposez des modalit&eacute;s de saisie
                      &agrave; 
                      <select name="acteur" onChange="return this.form.submit();">
                        <option selected  value="" >---- Sélectionnez un usager -----</option>
                        <option value='app'
								<?php
								if(isset($_REQUEST['acteur'])&& $_REQUEST['acteur']=='app') echo"selected";
								?>	
							> APPRENTI </option>
                        <option value='ma'
								<?php
								if(isset($_REQUEST['acteur'])&& $_REQUEST['acteur']=='ma') echo"selected";
								?>
							> <?php echo(strtoupper($config_lea->appelation_ma)) ?> </option>
                        <option value='tuteur_cfa'
								<?php
								if(isset($_REQUEST['acteur'])&& $_REQUEST['acteur']=='tuteur_cfa') echo"selected";
								?>
							> <?php echo(strtoupper($config_lea->appelation_tuteur_cfa)) ?> </option>
                      </select>
					pour valider  le dernier niveau
                  <?php  echo" ( $libelle_dernier_niveau ) du  $arbre->nom "; ?>
				</form>
                </td>
              </tr>
 			  <tr>
			  <td align="center">
                  <?php	
				 
			if(count($les_modalites) == 0 ){
				 if($acteur !="") afficher_msg_erreur("Aucune modalité n'est créée");
			}					
			else {
					 echo"<h4> Liste de modalités proposées <h4>";
					 			
					foreach($les_modalites as $modalite ) {					
						afficher_modalite($modalite);
						echo"<br>"; 					
					}									  																		
				}
				?>
                </td>
              </tr>
              <tr>
                <td height="29" align="center"> <a href="#" 
					onClick="window.open('creer_modalite_validation_referentiel.php?<?php echo"id_arbre=$arbre->id_arbre"."&acteur=$acteur" ?>' , '', 'width=800, height=600 scrollbars=yes')"> <img src="../../../images/ico_ajouter.png" width="22" height="22" border="0">Proposer
                    une modalit&eacute; 
					</a> </td>
              </tr>
            </table>
			<?php }else afficher_msg_erreur("Votre $arbre->nom ne comporte aucun(e)".
											 $arbre->libelles_niveaux[$nb_niveaux-1] ) ;
			?>
			</td>
  </tr>
</table>		

</div>
	</body>
</html>
