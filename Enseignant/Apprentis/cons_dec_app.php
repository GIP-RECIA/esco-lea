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
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/**********************************************************/
$enseignant = new Enseignant($_SESSION['id_ens']);
$formation = new Formation ($_SESSION['id_for']); // la formation de l'enseignant connecté


if(isset($_REQUEST['id_app_select'])) {
  		  $apprenti = new Apprenti($_REQUEST['id_app_select']);
		  $id_for_app = $apprenti->get_id_for(); // l'identifiant de la formation de l'apprenti
		  if($formation->id_for != $id_for_app ) exit();
		  
}		  
else exit();

$apprenti->set_detail();

  $est_responsable = $enseignant->est_responsable($_SESSION['id_for']); 
  $est_tuteur = ($enseignant->id_ens == $apprenti->id_ens);

$classe = new Classe($apprenti->id_cla); // la classe de l 'apprenti
$les_id_apprentis = $classe ->get_id_apprentis(); 

if( isset($_REQUEST['type_suivi']) && 
	( $_REQUEST['type_suivi']=='entr' || $_REQUEST['type_suivi']=='cfa')	
  ) 
     $type_suivi = $_REQUEST['type_suivi'];
else $type_suivi ='cfa';

if($est_responsable) $acteur ='';
elseif( $est_tuteur ) $acteur ='tuteur_cfa';
else $acteur ='ens';

$les_periodes =  $formation->get_periodes($type_suivi, $acteur, $classe->id_cla);


if(isset($_REQUEST['id_periode'])) { 
	$id_periode_select = $_REQUEST['id_periode'];
}									
elseif(count($les_periodes) > 0){ 
	$id_periode_select =  $les_periodes[0]->id_periode;
}
else $id_periode_select = 0;
	
$periode_select = new Periode($id_periode_select);
$periode_select->set_detail(); 	 

if($type_suivi=='cfa' && $periode_select->suivi_cfa == 0) 	$id_periode_select = 0;
if($type_suivi=='entr' && $periode_select->suivi_entr == 0) $id_periode_select = 0;

$config_lea = $formation->get_config_lea();

$declaration = $apprenti->get_declaration($id_periode_select, $type_suivi);

$les_arbres = $config_lea->get_arbres($declaration->type_suivi);

$detail_declaration = 0; 

// $bool : une variable booléene qui détermine si l'enseignant connecté a le 
//         droit de modifier ou faire une déclaration pour la période $id_periode_select
//		   lors du 	suivi $type_suivi
	if($est_responsable) {
		$bool = $config_lea->declaration_acteur($type_suivi, 'rf', $id_periode_select) ||
				$config_lea->declaration_acteur($type_suivi, 'ens', $id_periode_select) ||
				$config_lea->declaration_acteur($type_suivi, 'tuteur_cfa', $id_periode_select) ||
				$config_lea->declaration_acteur($type_suivi, 'app', $id_periode_select);													
	}
	elseif($est_tuteur){
		$bool = $config_lea->declaration_acteur($type_suivi, 'ens', $id_periode_select) ||
		$config_lea->declaration_acteur($type_suivi, 'tuteur_cfa', $id_periode_select);
	}
	else $bool = $config_lea->declaration_acteur($type_suivi, 'ens', $id_periode_select);
?>
<script>
 function signer(status) {
	 if (status != 0) {
		 var acteurs = "";
		 if ((status & 1) != 0 ) {
			 acteurs += "\n- <?php echo $config_term->terminologie_app; ?>"; 
		 }
		 if ((status & 2) != 0 ) {
			 acteurs += "\n- <?php echo $config_term->terminologie_ma; ?>"; 
		 }
		 
		 alert("Vous ne pouvez pas signer cette déclaration car elle n'a pas été signée par les acteurs suivants : " + acteurs );
		 return false;
	 }
	 return confirm("Etes-vous sur de vouloir signer cette déclaration ? ");
 }
</script>

 <div id="top_l"></div>
 <div id="top_m">	
<?php 
 if($type_suivi =='entr' ) {
	    $img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png" >';
		echo"<h1> $img <span class=\"orange\">C</span>onsulter une d&eacute;claration ".$config_lea->appelation_entr."</h1>";
 }		
 elseif($type_suivi == 'cfa') {
 		$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png" >';
		echo"<h1> $img <span class=\"orange\">C</span>onsulter une d&eacute;claration ".$config_term->terminologie_cfa."</h1>";
 }		
?>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form action="?" method="get">
  		<p>
    		<input type="hidden" name="cmd" value="cons_dec_app">
    	</p>
  		<p>  
  		<?php echo"$config_lea->appelation_app" ?>
  		<?php
			$array_value = array();
		  
			foreach($les_id_apprentis as $id_app) {
				$app = new Apprenti($id_app);
				$app->set_detail();
			
				$array_value[$id_app] = "$app->nom &nbsp; $app->prenom";
		   }
		   $attr = 'onChange = "this.form.submit()"';
		   echo ( liste_deroulante ( 'id_app_select' , $array_value , $apprenti->id_app, $attr ) );
		?>
  		</p>
  		<p>Suivi : 
			<select name="type_suivi" onChange ="this.form.submit()">
		      	<option value="cfa" <?php if($type_suivi == 'cfa') echo'selected'; ?> > <?php echo $config_lea->appelation_suivi_cfa; ?>  </option>
		      	<option value="entr" <?php if($type_suivi == 'entr') echo'selected'; ?> ><?php echo $config_lea->appelation_suivi_entr; ?></option>
            </select>
			<?php 							  
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
			  	echo"$output";
			?>
      	</p>
	</form>
<table width="635">
  	<tr>
    	<th class="center">
			<?php
				$id_usager = $enseignant->id_ens;
					  					  
				if( $declaration->id_dec > 0) {					  
					  	
					if(!$declaration->est_signee($id_usager ) ) {	
						$cr = 0;
						if (($acteur == 'ens' ) && $type_suivi != 'cfa') {
							$cr = $declaration->est_signable_entr();
						} 
												
						echo" 
							<img src='".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_signature.png' border='0'>								 
							<a href='".$LEA_URL."Apprenti/Livret/signer_dec.php?id_usager=$id_usager&id_dec=$declaration->id_dec' 
								onClick ='return signer($cr)'>
									Signer 
							</a>";
					
					//$bool: booléen permetant de tester si l'enseignant conncecté a le droit de modifier une déclaration ou non
						if($bool ) { 
						echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
							<img src='".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_edit.png' border='0'>					  	      
							<a href='modifier_dec_app.php?id_dec=$declaration->id_dec' >
									Effectuer / Modifier ma d&eacute;claration
						  	</a>";
						}
							
					}
					
					if($est_responsable ) {
						echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						  	        
							<img src='".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/picto_drop.png' border='0'>
							<a href='supprimer_dec_app.php?id_dec=$declaration->id_dec' 
								onClick ='return confirm(\"&ecirc;tes-vous sur de vouloir supprimer cette d&eacute;claration ?\")'>
						 			Supprimer 
						   	</a>";
					}
																			
				}elseif($id_periode_select > 0) { // aucune déclaration n'est créée
					if($bool){
						echo"<a href='modifier_dec_app.php?id_dec=0&id_app=$apprenti->id_app&id_periode=$id_periode_select&type_suivi=$type_suivi'>
							D&eacute;clarer cette p&eacute;riode
						</a>";
					}			
				}	  
				echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";    
				echo"<img src='".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/ico_performance.png' border='0' >";
				echo"<a href='apprentis.php?cmd=bilan_app&id_app_select=".$apprenti->id_app."' >
				 			Synth&egrave;se 
				   	</a>";	
			?>

    	</th>
	</tr>
  	<tr>
    	<th class="center">
		<?php
 			//echo" Apprenti: $apprenti->nom $apprenti->prenom &nbsp;&nbsp;&nbsp;";
			if($declaration->id_dec > 0 ) {echo	"Date de d&eacute;claration : ".trans_date($declaration->date_dec);}  
		?>
    	</th>
	</tr>
  	<tr>
    	<td>
        <?php
			if($id_periode_select > 0 && $declaration->id_dec <= 0 ) {
				afficher_msg_erreur("P&eacute;riode non d&eacute;clar&eacute;e &nbsp");			
			}	
							
			if(count($les_arbres) > 0 ) {
				foreach($les_arbres as $arbre){
					if( $declaration->afficher_feuilles_declarees($arbre, $id_periode_select) ) {
						$detail_declaration = 1;
					}											
				}//foreach
			}	
			
		  	if($declaration->id_dec > 0 ) {
				if( $declaration->afficher_tableau_modalites_suivi_libre($config_lea,  $id_periode_select ) )
					$detail_declaration = 1;
			}	
			
			if ($declaration->afficher_fichiers_joints()) $detail_declaration = 1;
	
		  	if($declaration->id_dec > 0 ){
				if ($detail_declaration == 0 ) echo"Aucun d&eacute;tail n'est associ&eacute; &agrave; cette d&eacute;claration";
				
				if($est_responsable)
					  $declaration->afficher_signatures(1);
				else  $declaration->afficher_signatures(0);
			}	 
		?>
    	</td>
  	</tr>
</table>
		<?php
		}else echo"Aucune p&eacute;riode ne peut &egrave;tre consult&eacute;e";
		?>
</div>
