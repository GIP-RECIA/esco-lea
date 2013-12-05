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
require_once($LEA_REP."modele/bdd/classe_periode.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");

/**********************************************************/
if(isset($_REQUEST['id_app_select']))
$apprenti = new Apprenti($_REQUEST['id_app_select']);
else  {include($LEA_REP.'erreur.php'); exit();}

$apprenti->set_detail();

$classe = $apprenti->get_classe();

$formation = new Formation ($classe->id_for);


$les_periodes =  $formation->get_periodes();

if(isset($_REQUEST['id_periode'])) {
	$id_periode_select = $_REQUEST['id_periode'];
}
else  $id_periode_select = 0;

$periode_select = new Periode($id_periode_select);
$periode_select->set_detail();

if( isset($_REQUEST['type_suivi']) &&
( $_REQUEST['type_suivi']=='entr' || $_REQUEST['type_suivi']=='cfa')
)
$type_suivi = $_REQUEST['type_suivi'];
else {include($LEA_REP.'erreur.php'); exit();}


$config_lea = $formation->get_config_lea();

$declaration = $apprenti->get_declaration($id_periode_select, $type_suivi);
$les_feuilles_declarees = $declaration->get_feuilles_declarees();

if($type_suivi == 'entr' &&  $config_lea->suivi_entr_guide_actif) {
	$arbre = $config_lea->get_arbre("ref_entr");
}
elseif($type_suivi == 'cfa' &&  $config_lea->suivi_cfa_guide_actif){
	$arbre = $config_lea->get_arbre("ref_cfa");
}


?>

<div id="top_l"></div>
<div id="top_m"></div>
<div id="top_r"></div>
<div id="m_contenu">


<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="26" colspan="2"><?php 
		echo"<span class='titre_page'>";
		/*
		 if($type_suivi =='entr' )
		 afficher_sous_menu('cons_dec_entr');
		 else  afficher_sous_menu('cons_dec_cfa');
		 */
		?></td>
	</tr>
	<tr>
		<td width="86%" height="26"><?php 
		echo"<span class='titre_page'>";
			
		if($type_suivi =='entr' )
		echo"<img src='../../images/entreprise_dec.png' >";
		else echo"<img src='../../images/cfa_dec.png' >";

		echo"Déclaration : $periode_select->libelle"; 
		echo"</span>";
		?></td>
		<td width="14%">&nbsp;</td>
	</tr>
	<tr align="right">
		<td height="39" colspan="2"><?php echo"<p>Apprenti: <b> $apprenti->nom $apprenti->prenom </b></p>"; ?>
		<hr class="trait">
		</td>
	</tr>

	<tr>
		<td height="19" colspan="2" align="center" valign="top">


		<table width="100%" border="0" cellspacing="0">
			<tr>
				<td align="center">
				<form action="?" method="post"><input type="hidden" name="cmd"
					value="cons_dec"> <input type="hidden" name="type_suivi"
					value="<?php echo"$type_suivi" ?>"> <input type="hidden"
					name="id_app_select" value="<?php echo"$apprenti->id_app" ?>">
				<table width="51%" border="0" cellspacing="0">
					<tr>
						<td height="41" align="center"><?php 
							
						if(count($les_periodes) > 0 ) {

							$output  = "<select name='id_periode' onChange='this.form.submit()'>";
							$output .=			"<option value='0' >";
							$output .=			"---- Sélectionnez une p&eacute;riode ----";
							$output .=			"</option>";

							foreach($les_periodes as $periode  )  {
									
								if($periode->id_periode == $id_periode_select) $selected = "selected";
								else $selected = "";
									
								$output .= "<option value='$periode->id_periode' $selected> ";
								$output .= "$periode->libelle ";
								$output .= " </option>";
							}
							$output .= "</select>";
						}
						else $output ="Aucune p&eacute;riode n'est d&eacute;finie";
							
						echo($output);
						?></td>
					</tr>
				</table>
				</form>
				</td>
			</tr>
			<tr class="sous_titre_tableau">
				<td align="center"><?php
				if($declaration->id_dec > 0 ) {

					echo	"<table width='100%' border='0'>
                       				 <tr>
									 <td>
										     Apprenti :<b> $apprenti->prenom $apprenti->nom </b>
			                          </td>
				                      <td width='60%'>Date de d&eacute;claration : <b>".trans_date($declaration->date_dec)."
									  </b>
									  </td>
										<td>
										     Etat : <b> $declaration->etat	</b>
			                        	  </td>
            	            		</tr>
        	            
                	      </table>";
				}elseif($id_periode_select > 0) afficher_msg_erreur("P&eacute;riode non d&eacute;clar&eacute;e");
				?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><?php 
				if($declaration->id_dec > 0 ) $declaration->afficher_feuilles_declarees($arbre);
					
				?></td>
			</tr>
			<tr>
				<td><?php 
				if($declaration->id_dec > 0 ) $declaration->afficher_tableau_modalites_suivi_libre($config_lea);
					
				?></td>
			</tr>
			<tr>
				<td><?php 
				if($declaration->id_dec > 0 ) $declaration->afficher_fichiers_joints();
					
				?></td>
			</tr>
			<tr>
				<td><?php 
				if($declaration->id_dec > 0 ) $declaration->afficher_signatures();
					
				?></td>
			</tr>
			<tr>
				<td align="center"><?php
				$id_usager = $_SESSION['id_ma'];
					
				if( $declaration->id_dec > 0 && !$declaration->est_signee($id_usager ) ) {

					echo"
					  			<a href=\"signer_dec.php?id_usager=$id_usager&id_dec=$declaration->id_dec\">
					  			Signer
						   	</a>";

					echo"&nbsp;&nbsp;&nbsp;";

					if(  $declaration->type_suivi=='entr' &&
					( $config_lea->declaration($declaration->type_suivi, 'app')||
					$config_lea->declaration($declaration->type_suivi, 'ma')
					)
					)  {

						echo" <img src='".$URL_IMAGES."b_edit.png'>
						  			<a href='modifier_dec.php?id_dec=$declaration->id_dec'>
						  			Modifier la d&eacute;claration 
							   		</a>
							";
					}
				}
				?></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>
