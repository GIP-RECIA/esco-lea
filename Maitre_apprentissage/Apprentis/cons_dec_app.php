<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 03/04/06

/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_periode.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");

/**********************************************************/
$ma = new Maitre_apprentissage($_SESSION['id_ma']);

if(isset($_REQUEST['id_app_select'])) {
	$apprenti = new Apprenti($_REQUEST['id_app_select']);
}
else exit();


$apprenti->set_detail();

if($apprenti->id_ma != $ma->id_ma) exit();

$formation = $apprenti->get_formation();


if( isset($_REQUEST['type_suivi']) &&
( $_REQUEST['type_suivi']=='entr' || $_REQUEST['type_suivi']=='cfa')
)
$type_suivi = $_REQUEST['type_suivi'];
else $type_suivi ='entr';


$les_periodes =  $formation->get_periodes($type_suivi,'ma',$classe->id_cla);

if(isset($_REQUEST['id_periode'])) {
	$id_periode_select = $_REQUEST['id_periode'];
}
elseif(count($les_periodes) > 0){ $id_periode_select =  $les_periodes[0]->id_periode;
}
else $id_periode_select = 0;

$periode_select = new Periode($id_periode_select);
$periode_select->set_detail();

if($type_suivi=='cfa' && $periode_select->suivi_cfa == 0) $id_periode_select = 0;
if($type_suivi=='entr' && $periode_select->suivi_entr == 0) $id_periode_select = 0;


$config_lea = $formation->get_config_lea();

$declaration = $apprenti->get_declaration($id_periode_select, $type_suivi);

$les_arbres = $config_lea->get_arbres($declaration->type_suivi);

$detail_declaration = 0;

// $bool : une variable booléene qui détermine si le maitre d'apprentissage connecté à le 
//         droit de modifier ou faire une déclaration pour la période $id_periode_select
//		   lors du 	suivi $type_suivi


$bool = $config_lea->declaration_acteur($type_suivi, 'ma', $id_periode_select);
	
?>
<script>
 function signer(status) {
	 if (status != 0) {
		 acteurs = "\n- <?php echo $config_term->terminologie_ens; ?>"; 
		 alert("Vous ne pouvez pas signer cette déclaration car elle n'a pas été signée par les acteurs suivants : " + acteurs );
		 return false;
	 }
	 return confirm("Etes-vous sur de vouloir signer cette déclaration ? ");
 }
</script>

<div id="top_l"></div>
<div id="top_m"><?php 

if($type_suivi =='entr' )
$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png" >';
elseif($type_suivi == 'cfa')
$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png" >';
echo"<h1> $img <span class=\"orange\">C</span>onsulter une d&eacute;claration</h1>";

?></div>
<div id="top_r"></div>
<div id="m_contenu">

<form action="?" method="get"><input type="hidden" name="cmd"
	value="cons_dec_app"> <input type="hidden" name="id_app_select"
	value="<?php echo"$apprenti->id_app" ?>">


<p>Suivi : <select name="type_suivi" onChange="this.form.submit()">
	<option value="cfa" <?php if($type_suivi == 'cfa') echo'selected'; ?>>
	<?php echo $config_lea->appelation_suivi_cfa; ?></option>
	<option value="entr" <?php if($type_suivi == 'entr') echo'selected'; ?>><?php echo $config_lea->appelation_suivi_entr; ?>
	</option>
</select> <?php 							  
if(count($les_periodes) > 0 ) {


	$output  = "<select name='id_periode' onChange ='this.form.submit()'>";
	$output .=			"<option value='0' >";
	$output .=			"---- S&eacute;lectionnez une p&eacute;riode ----";
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
else $output ="Aucune p&eacute;riode ne peut &ecirc;tre consult&eacute;e";

echo($output);
?></p>
</form>

<table width="635">
	<tr>
		<th class="center">
		<p><?php
		$id_usager = $ma->id_ma;

		if( $declaration->id_dec > 0) {

			if(!$declaration->est_signee($id_usager ) ) {
				$cr = 0;
				if ($type_suivi == 'cfa') {
					$cr = $declaration->est_signable_cfa();
				} 
				
				echo"
					<img src='".$URL_THEME."/images/picto_signature.png' border='0'> 								 
		  			<a href='".$LEA_URL."Apprenti/Livret/signer_dec.php?id_usager=$id_usager&id_dec=$declaration->id_dec' 
						onClick ='return signer($cr)'>
		  				Signer
			   		</a>";

				//$bool: booléen permetant de tester si l'enseignant connecté à le droit de modifier une déclaration ou non
					
				if($bool ) {
					echo"&nbsp;&nbsp;&nbsp;
			  			<a href='modifier_dec_app.php?id_dec=$declaration->id_dec' >
						 	<img src='".$URL_THEME."/images/picto_edit.png' border='0'>
			  				Effectuer / Modifier ma d&eacute;claration
				   		</a>";
				}

			}
		}
		elseif($id_periode_select > 0) { // aucune déclaration n'est créée
			if($bool){
					
				echo("<a href='modifier_dec_app.php?id_dec=0&id_app=$apprenti->id_app&id_periode=$id_periode_select&type_suivi=$type_suivi'>
			  				D&eacute;clarer cette p&eacute;riode
					   		</a>");
			}
		}

		echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			
		echo"<img src='".$URL_THEME."images/ico_performance.png' >";
		echo"	<a href='./apprentis.php?cmd=bilan_app&id_app_select=$apprenti->id_app' >
			  			Synth&egrave;se 
				   	</a>";
		?></p>
		</th>
	</tr>
	<tr>
		<th class="center"><?php
		echo" De : $apprenti->civilite $apprenti->nom $apprenti->prenom &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
		if($declaration->id_dec > 0 ) {
			echo	"Date de d&eacute;claration : ".trans_date($declaration->date_dec);
		}
		?></th>
	</tr>
	<tr>
		<td><?php 
		if ($id_periode_select > 0 && $declaration->id_dec <= 0 ) {
			afficher_msg_erreur("P&eacute;riode non d&eacute;clar&eacute;e");
		}
			
		if(count($les_arbres) > 0 ) {
			foreach($les_arbres as $arbre){
				if( $declaration->afficher_feuilles_declarees($arbre, $id_periode_select) )
				$detail_declaration = 1;
			}//foreach
		}
			
		if($declaration->id_dec > 0 ) {
			if( $declaration->afficher_tableau_modalites_suivi_libre($config_lea,  $id_periode_select ) )
			$detail_declaration = 1;
		}
			
		if($declaration->id_dec > 0 ) {
			if ($declaration->afficher_fichiers_joints()) $detail_declaration = 1;
		}
			
		if($declaration->id_dec > 0 ) {
			if ($detail_declaration == 0 ) {
				echo"Aucun d&eacute;tail n'est associ&eacute; &agrave; cette d&eacute;claration";
				$declaration->afficher_signatures();
			}
		}
		?></td>
	</tr>
</table>
</div>
