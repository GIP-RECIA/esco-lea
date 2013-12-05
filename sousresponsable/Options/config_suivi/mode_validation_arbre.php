<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/09/05
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['id_arbre'])) { 
			$id_arbre = $_REQUEST['id_arbre']; 			
}			
else exit(); 

$arbre = new Arbre($id_arbre);
$arbre->set_detail(0);

if(isset($_REQUEST['valider_all_feuilles'])) {
	$arbre->valider_all_feuilles = $_REQUEST['valider_all_feuilles'];	
	$arbre->nom = addslashes($arbre->nom);
	$arbre->update();
}

$arbre->set_detail(0);

if($arbre->id_config != $config_lea->id_config) exit(); 

$arbre->set_libelles_niveaux();
$nb_niveaux = count($arbre->libelles_niveaux);
$les_feuilles = $arbre->get_feuilles(); // les feuilles de l'arbre

if( $nb_niveaux > 0) $libelle_dernier_niveau = $arbre->libelles_niveaux[$nb_niveaux-1];
else { afficher_msg_erreur("Votre arbre ne comporte aucun niveau"); exit();}

if(isset($_REQUEST['acteur'])) $acteur = $_REQUEST['acteur'];
else $acteur = "app";

$les_modalites = $arbre->get_modalites($acteur);

// Cette fonction visualise la prï¿½sentation de la  modalite  $modalite

function afficher_modalite($modalite){
		
	global $LEA_URL;
	global $URL_THEME;
	global $les_feuilles;
		
	$src_img_modif = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_edit.png';
	$src_img_supp =  $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_drop.png';
	
	// la classe de cette modalite
	$classe = strtolower(get_class($modalite)); 
		
	switch($classe){		
		case "modalite_va_unique" : 
			if($modalite->type_reponse == 'texte') $output = "<textarea disabled> </textarea>";
			else $output = "<input  type='text' size='4' disabled>";
			
			$lien_modif =
				"<a href ='#' 
				onClick=\"window.open('./config_suivi/modifier_modalite_va_unique.php?id_modalite=$modalite->id_modalite','','width=800, height=600, resizable=yes, scrollbars=yes' )\" > 
			 	Modifier cette modalit&eacute;
				</a>";
			$lien_supp = 
				"<a href ='./config_suivi/modifier_modalite_va_unique_v.php?action=supp&id_modalite=$modalite->id_modalite' 
				  onClick='return deleteConfirm(\"cette modalite\")'
				 > Supprimer cette modalit&eacute; </a>";
				 
			$les_periodes = $modalite->get_periodes();	
				 
			break;										
		case "modalite_va_multiple"		   :								
			$les_choix = $modalite->get_choix();
			if($modalite->type_choix == 'unique' ) $type = 'radio';
			else  $type = 'checkbox';

			$output = "";
			foreach($les_choix as $choix) $output.=" <input type='$type' name='reponse' disabled > $choix->libelle <br>";
			
			$lien_modif =
				"<a href ='#' 
				onClick=\"window.open('./config_suivi/modifier_modalite_va_multiple.php?id_modalite=$modalite->id_modalite','','width=800, height=600, resizable=yes, scrollbars=yes' )\" > 
			 	Modifier cette modalit&eacute;
				</a>";
			$lien_supp = 
				"<a href ='./config_suivi/modifier_modalite_va_multiple_v.php?action=supp&id_modalite=$modalite->id_modalite' 
				  onClick='return deleteConfirm(\"cette modalite\")'
				 > Supprimer cette modalit&eacute; </a>";
				 
			$les_periodes = $modalite->get_periodes();
					 
			break;
		default :   return;									
	}
	
	if( count($les_periodes) > 0  ) {
		$str_periodes = "<ul>";
		
		foreach ($les_periodes as $periode){
			$str_periodes .= "<li>".to_html($periode->libelle)."</li>";
		}
		$str_periodes .= "</ul>";
	} else{ 
		$str_periodes = to_html("Aucune p&eacute;riode ");
	}	
							 
 	echo"
     <table cellspacing='0' >
	 	<tr width ='100%' height='30' class='titre' >
			<td  colspan='2'>Modalit&eacute; : $modalite->libelle</td>
        </tr>
	   	<tr>
			<th width='70%'>S'affiche comme suit</th>
			<th width='30%'>Se d&eacute;clare aux p&eacute;riodes suivantes</th>													 		
        </tr>
 		<tr>
	 		<td>$output</td>
			<td>
				<div style='width: 300px; height: 150px;overflow: auto;'>
					$str_periodes
				</div>
	 		</td>
      	</tr>
	   	<tr >
			<th colspan='2'>
				<img src='$src_img_modif' border='0' title='modifier'> 
				$lien_modif	 &nbsp;&nbsp;&nbsp;
				<img src='$src_img_supp' border='0' title='supprimer'> 
				$lien_supp
	 		</th>
      	</tr>
	</table>";  	
}     

include("menu_maj_arbre.php");
afficher_menu_maj_arbre('validation');
?>
<div id="top_l"></div>
<div id="top_m">
	<h1>
		<?php
		if ($arbre->type == "entr") {
		    echo'<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png">';
		}
		elseif($arbre->type == "cfa") {
			echo'<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_cfa.png">';
		}
		echo"<span class='orange'>M</span>ode de validation :  $arbre->nom ";
		?>
	</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<div id="m_contenuArbre">
	<?php 
		if(count($les_feuilles) > 0) {
  	?>
	<form name="form2" method="post" action="?<?php echo "cmd=mode_validation_arbre&id_arbre=".$_GET['id_arbre']."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu'];?>">
		<input type="hidden" name="id_arbre" value="<?php echo"$arbre->id_arbre"?>">
		<table width="92%" height="179" >
			<tr><th colspan="2">Affichage des feuilles</th></tr>
			<tr><td colspan="2">Pour la saisie des p&eacute;riodes</td></tr>
			<tr>
				<td colspan="2">
					<input type="radio" name="valider_all_feuilles" value="1" <?php if($arbre->valider_all_feuilles) echo "checked" ?>>
					Toutes les feuilles de l'arbre seront s&eacute;lectionn&eacute;es par d&eacute;faut et devront &ecirc;tre valid&eacute;es          
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="radio" name="valider_all_feuilles" value="0" <?php if(! $arbre->valider_all_feuilles) echo "checked" ?>>
					Seules quelques feuilles peuvent &ecirc;tre s&eacute;lectionn&eacute;es et valid&eacute;es
				</td>
			</tr>
			<tr>
				<td width="41%" class="center">
					<input type="submit" name="Submit" value="Valider">
				</td>
				<td width="59%" class="center">&nbsp;</td>
			</tr>
		</table>
	</form>      
	<table>
		<tr>
			<th>Choix de l'acteur</th>
		</tr>
		<tr>
			<td>
				<form name="form1" method="get" action="">
       				<input type="hidden" name="cmd" value="mode_validation_arbre">
       				<input type="hidden" name="id_arbre" value="<?php  echo $_GET['id_arbre'];?>">
       				<input type="hidden" name="type_suivi" value="<?php  echo $_GET['type_suivi'];?>">
       				<input type="hidden" name="suivi" value="<?php  echo $_GET['suivi'];?>">
       				<input type="hidden" name="selmenu" value="<?php  echo $_GET['selmenu'];?>">
               		<a href="#" onclick="lightbox('aide_40', '<?php echo $LEA_URL?>')">
               			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
               		</a>
   					Vous d&eacute;sirez proposez des modalit&eacute;s de saisie &agrave; l'un des acteurs de la liste ci-dessous pour valider le dernier niveau
         				<?php  echo" ( $libelle_dernier_niveau ) de l'arbre : $arbre->nom "; ?><br> <br>
         				<?php
						$array_values = array(											 
						'app'		  	=> $config_lea->appelation_app, 
						'tuteur_cfa'	=> $config_lea->appelation_tuteur_cfa,
						'ma'		  	=> $config_lea->appelation_ma,
						'ens'        	=> $config_lea->appelation_ens,
						'rl'		  	=> $config_lea->appelation_rl, 
						'rf'         	=> $config_lea->appelation_rf);
						
						$selected_value = (isset($_REQUEST['acteur']) ) ? $_REQUEST['acteur']:'app';
						$attr ='onChange="return this.form.submit();"';
						$name= 'acteur';
			
						echo liste_deroulante ( $name , $array_values , $selected_value , $attr,  $multiple = 0 , $size = 1 );
					?>              
	      		</form>
	      	</td>
		</tr>
		<tr>
			<th>Liste des modalit&eacute;s propos&eacute;es</th>
		</tr>
	  	<tr>
	    	<td>
			<?php
				if(count($les_modalites) == 0 ){
					if($acteur !="") echo("Aucune modalit&eacute; n'est cr&eacute;&eacute;e");
				}
				 			
				foreach($les_modalites as $modalite ) {					
					afficher_modalite($modalite);
					echo"<br />"; 					
				}									  																		
				
			?>
			</td>
		</tr>
		<tr>
			<td height="29" class="center"> <br/>
				<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_ajouter.png') ?>"> 	
				<a href="#" 
					onClick="window.open('config_suivi/creer_modalite_validation_arbre.php?<?php echo"id_arbre=$arbre->id_arbre"."&acteur=$acteur" ?>' , '', 'width=800, height=600, resizable=yes,  scrollbars=yes' )"> 
					Proposer une modalit&eacute; 
				</a> 
			</td>
		</tr>
	</table>
<?php }else afficher_msg_erreur("Votre $arbre->nom ne comporte aucun(e)".$arbre->libelles_niveaux[$nb_niveaux-1] ) ;?>
		<a name="baspageimp">&nbsp;</a>
		<script language="javascript" type="text/javascript">
			var doc = document.location.href.split("#");
			window.location.replace(doc[0] + "#baspageimp");
		</script>
	</div>
</div>

