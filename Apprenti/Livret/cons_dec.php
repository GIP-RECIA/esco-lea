<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_periode.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");

/**********************************************************/

$apprenti = new Apprenti($_SESSION['id_app']);

$apprenti->set_detail();

$classe = $apprenti->get_classe();

$formation = new Formation ($classe->id_for);

if( isset($_REQUEST['type_suivi']) && 
	( $_REQUEST['type_suivi']=='entr' || $_REQUEST['type_suivi']=='cfa')	
  ) 
  	$type_suivi = $_REQUEST['type_suivi'];
else $type_suivi = 'cfa';

$les_periodes =  $formation->get_periodes( $type_suivi,'app',$classe->id_cla);

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

?>
<div id="top_l"></div>
<div id="top_m">		
<?php 	
	if($type_suivi =='entr' )
	   $img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png" >';
	elseif($type_suivi == 'cfa') 
		$img = '<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png" >';
	echo"<h1> $img <span class=\"orange\">C</span>onsulter une d&eacute;claration</h1>";			   
?>
</div>
<div id="top_r"></div>
<div id="m_contenu"><br> 
	<form action="?" method="get">
  		<input type="hidden" name="cmd" value="cons_dec">  
  			Suivi : 
			<select name="type_suivi" onChange ="this.form.submit()">
		    	<option value="cfa" <?php if($type_suivi == 'cfa') echo'selected'; ?> > <?php echo $config_lea->appelation_suivi_cfa; ?>  </option>
 <?php   require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
	$bdd=new Connexion_BDD_LEA();
	$sql="select id_cla from les_apprentis where id_app='$id_app_select'";
	$res=$bdd->executer($sql);
	if ($ligne = mysql_fetch_assoc($res)) {
		$cla=$ligne['id_cla'];
		$sql="select id_for from les_classes where id_cla='$cla'";
		$res=$bdd->executer($sql);
		if ($ligne = mysql_fetch_assoc($res)) {
			$for=$ligne['id_for'];
		}
	}
	$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$for'";
	$res=$bdd->executer($sql);
	if(mysql_num_rows($res)==1){
		$suivi="false";
	} else {
		$suivi="true";
	}

    if($suivi!="false") {   	?>		    	
 			<option value="entr" <?php if($type_suivi == 'entr') echo'selected'; ?> >
 			<?php echo $config_lea->appelation_suivi_entr; ?> </option>   <?php   }   ?>
          	</select>
			<?php 			  
				if(count($les_periodes) > 0 ) {
		
					$output  = "<select name='id_periode' onChange='this.form.submit()'>";
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
			?>
	</form>
<table width="635">
  	<tr>
		<?php
			$id_usager = $_SESSION['id_app'];
			if( $declaration->id_dec > 0 && !$declaration->est_signee($id_usager ) ) {					  					
				echo "<br/><strong  style=\"color:red\">ATTENTION : l'ouverture de deux fen&ecirc;tres simultan&eacute;ment peut effacer des donn&eacute;es  enregistr&eacute;es</strong>";												
				echo"<th style='text-align: center'>
					<img src='".$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME']."/images/picto_signature.png'> 
					<a href='".$LEA_URL."Apprenti/Livret/signer_dec.php?id_usager=$id_usager&id_dec=$declaration->id_dec'
						onClick ='return confirm(\"&ecirc;tes-vous sur de vouloir signer cette d&eacute;claration ?\")'>
						Signer 
		 			</a>";
				echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			        <img src='".$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME']."/images/picto_edit.png'>
					<a href='".$LEA_URL."Apprenti/Livret/modifier_dec.php?id_dec=$declaration->id_dec'>
		 				Effectuer / Modifier ma d&eacute;claration
		   			</a><br/><br/></th>";
			}
		?>
  	</tr>
	
  	<tr>
    	<th class="center"><br/><br/>
		<?php
	  		echo" ".$config_lea->appelation_app.": $apprenti->nom $apprenti->prenom &nbsp;&nbsp;&nbsp;";
			if($declaration->id_dec > 0 ) {			  
				echo	"Date de d&eacute;claration : ".trans_date($declaration->date_dec);
	        }elseif($id_periode_select > 0) afficher_msg_erreur("P&eacute;riode non d&eacute;clar&eacute;e");
		?>
    	</th>
  	</tr>
  	<tr>
    	<td>
    	<?php
			if(count($les_arbres) > 0 ) {
				foreach($les_arbres as $arbre){
					$declaration->afficher_feuilles_declarees($arbre, $id_periode_select);
				}
			}
			if($declaration->id_dec > 0 ) $declaration->afficher_tableau_modalites_suivi_libre($config_lea,  $id_periode_select );
			if($declaration->id_dec > 0 ) $declaration->afficher_fichiers_joints();
			if($declaration->id_dec > 0 ) $declaration->afficher_signatures();
		?>
		</td>
  	</tr>
  	
</table>
</div>