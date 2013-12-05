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
$parent = new Representant_legal($_SESSION['id_rl']);

if(isset($_REQUEST['id_app_select'])) {
	$apprenti = new Apprenti($_REQUEST['id_app_select']);
}
else exit();


$apprenti->set_detail();

if($apprenti->id_rl != $parent->id_rl) exit();

$formation = $apprenti->get_formation();


if( isset($_REQUEST['type_suivi']) &&
( $_REQUEST['type_suivi']=='entr' || $_REQUEST['type_suivi']=='cfa')) {
	$type_suivi = $_REQUEST['type_suivi'];
}
else {
	$type_suivi ='cfa';
}

$les_periodes =  $formation->get_periodes($type_suivi,'rl', $apprenti->id_cla);

if(isset($_REQUEST['id_periode'])) {
	$id_periode_select = $_REQUEST['id_periode'];
}
else  $id_periode_select = 0;

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


$bool = $config_lea->declaration_acteur($type_suivi, 'rl', $id_periode_select);


?>
<div id="top_l"></div>
<div id="top_m"><?php 

if($type_suivi =='entr' ) {
	$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png" >';
	echo"<h1> $img <span class=\"orange\">C</span>onsulter une déclaration entreprise </h1>";	
}
elseif($type_suivi == 'cfa') {
	$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png" >';
	echo"<h1> $img <span class=\"orange\">C</span>onsulter une déclaration cfa</h1>";	

}

?></div>
<div id="top_r"></div>
<div id="m_contenu">
<form action="?" method="get"><input type="hidden" name="cmd"
	value="cons_dec_app"> <input type="hidden" name="id_app_select"
	value="<?php echo"$apprenti->id_app" ?>">


<p>Suivi : <select name="type_suivi" onChange="this.form.submit()">
	<option value="cfa" <?php if($type_suivi == 'cfa') echo'selected'; ?>>
	Suivi au CFA</option>
	<option value="entr" <?php if($type_suivi == 'entr') echo'selected'; ?>>Suivi
	en entreprise</option>
</select> <?php 							  
if(count($les_periodes) > 0 ) {


	$output  = "<select name='id_periode' onChange ='this.form.submit()'>";
	$output .=			"<option value='0' >";
	$output .=			"---- Sélectionnez une p&eacute;riode ----";
	$output .=			"</option>";

	foreach($les_periodes as $periode  )  {
			
		if($periode->id_periode == $id_periode_select) {
			$selected = "selected";
		}
		else {
			$selected = "";
		}

		$output .= "<option value='$periode->id_periode' $selected> ";
		$output .= "$periode->libelle ";
		$output .= " </option>";
	}
	$output .= "</select>";
}
else { 
	$output ="Aucune p&eacute;riode n'est d&eacute;finie"; 
}

echo($output);
?></p>
</form>

<table width="635">
	<tr>
		<th class="center"><?php
		echo" Apprenti: $apprenti->nom $apprenti->prenom &nbsp;&nbsp;&nbsp;";
		if($declaration->id_dec > 0 ) {

			echo	"Date de d&eacute;claration : ".
			trans_date($declaration->date_dec);

		}
		?></th>
	</tr>
	<tr>
		<td><?php

		if($id_periode_select > 0 && $declaration->id_dec <= 0 ) afficher_msg_erreur("Période non déclarée");

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
			if ($detail_declaration == 0 )  echo "Aucun détail n'est associé à cette déclaration";
			$declaration->afficher_signatures();
		}
			
		?></td>
	</tr>
	<tr>
		<td class="center">
		<p><?php
		$id_usager = $parent->id_rl;
			
		if( $declaration->id_dec > 0) {

			if(!$declaration->est_signee($id_usager ) ) {
				echo"
					  			<a href='".$LEA_URL."Apprenti/Livret/signer_dec.php?id_usager=$id_usager&id_dec=$declaration->id_dec' 
								onClick ='return confirm(\"Etes-vous sur de vouloir signer cette déclaration ?\")'
								>
								<img src='".$URL_THEME."/images/picto_signature.png' border='0'>
					  			Signer  
						   	</a>";
					
				//$bool: booléen permetant de tester si l'enseignant conncecté à le droit de modifier une déclaration ou non

				if($bool ) {
					echo"&nbsp;&nbsp;&nbsp;
						  			<a href='modifier_dec_app.php?id_dec=$declaration->id_dec' >
									  <img src='".$URL_THEME."/images/picto_edit.png' border='0'>
						  			Modifier 
							   		</a>
								";
				}
					
			}
		}
		/* // si aucune déclaration n'est créé le representant légal ne peut faire une déclaration					
		 elseif($id_periode_select > 0) { // aucune déclaration n'est créée
		 if($bool){

		 echo("<a href='modifier_dec_app.php?id_dec=0&id_app=$apprenti->id_app&id_periode=$id_periode_select&type_suivi=$type_suivi'>
		 Déclarer cette période
		 </a>");
		 }
		 }*/
			
		echo"&nbsp;&nbsp;&nbsp;";

		echo"<img src='".$URL_THEME."images/ico_performance.png' >";
		echo"	<a href='./apprentis.php?cmd=bilan_app&id_app_select=$apprenti->id_app' >
						  			Synthèse 
							   	</a>
							";
		?></p>
		</td>
	</tr>
</table>

</div>
