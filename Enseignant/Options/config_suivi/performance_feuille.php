<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la mise  ï¿½ jour du modele  de tï¿½che 
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."Enseignant/secure.php");
include($LEA_REP.'espace_de_partage/aide.php');

require_once ($LEA_REP."modele/bdd/classe_noeud.php");
require_once ($LEA_REP."modele/bdd/classe_modalite_va_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();

$id_noeud = $_REQUEST['id_noeud'] ;
$noeud = new Noeud($id_noeud );
$noeud->set_detail();

$arbre = new Arbre($noeud->id_arbre);
$arbre->set_detail(); 

$libelle_feuille = $arbre->get_libelle_feuille();

$src_img_feuille =  $URL_THEME."images/picto_feuille.png";

function afficher_modalite($modalite){
		
	global $LEA_URL;
	global $id_noeud;
	global $noeud;
	global $id_arbre;
	global $config_lea;
	// la classe de cette modalite
	$classe = strtolower(get_class($modalite)); 
		
	switch($classe){
		case "modalite_va_unique" : 					
			$value = $noeud->get_evaluation_modalite_va_unique($modalite->id_modalite);
			
			if( $modalite->type_reponse == 'frequence') {
				$output = 'Au moins <input  type="text" name="les_eva_modalite_va_unique['.$modalite->id_modalite.']" size="4" value="'.$value.'"> fois sur l\'ensemble des p&eacute;riodes ';
			} elseif( $modalite->type_reponse == 'note') {
				if($value==0) $value = '';
				$output = '/ <input  type="text" name="les_eva_modalite_va_unique['.$modalite->id_modalite.']" size="4" value="'.$value.'"> : Exemple ( /10 , /20 ,  /100)';
			} else return ; // aucun critï¿½te de peroformance ne peut ï¿½tre defini pour une modalitï¿½ ï¿½ reponse texte											
			
			break;																				
											
		case "modalite_va_multiple"		   :														
			$les_choix = $modalite->get_choix();									

			$output = "";
			foreach($les_choix as $choix) 			
			$output.=' au moins <input type="text"  size="4" name="les_eva_choix['.$choix->id_choix.']"  
						value="'.$noeud->get_evaluation_choix($choix->id_choix) .'" >
						fois  : '.$choix->libelle.' 
						<br>';
			break;		
	}									 
	 $acteur = $config_lea->get_nom_acteur($modalite->acteur);	 
		echo"
		<table width ='100%' cellspacing='0' >			 
		 	<tr> <th colspan='2'> $modalite->libelle (A valider par : $acteur )	</th> </tr>
  			<tr> <td> <p> Se d&eacute;clare  </p> </td>	
				 <td> $output </td> 
			</tr>			   
		</table>";  
} 
?>		
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>"  />
	<title>LEA : R&eacute;f&eacute;rentiel m&eacute;tier </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
</head>
<body>
	<?php
		echo "<div id=\"aide_30\" class=\"boxaide\" style=\"display:none\">	".afficher_aide(30)."</div>";
	?>
	<div id="contenu" style=" width:950px!important;">
		<div id="top_l"></div>
		<div id="top_m" align="left">
			<h1> 
			<?php
				if ($arbre->type == "entr") {
				    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				} elseif($arbre->type == "cfa") {
					echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
				}
				echo"Crit&egrave;res de performance de  : $noeud->libelle ";
			?>
			</h1>
		</div>
	<div id="top_r"></div>
	<?php afficher_boutton_fermer(0); ?>
	<div id="m_contenu">
		<p> 			
			<a href="#" onclick="lightbox('aide_30', '<?php echo $LEA_URL?>')">
			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>			
			Crit&egrave;res de performance des modalit&eacute;s propos&eacute;es 
		</p>
        <?php 
  		$les_acteurs = array("app", "ma", "tuteur_cfa","ens", "rl", "rf");					
	
		$les_modalites = array();
			  
		foreach($les_acteurs as $acteur) {
			$les_modalites = array_merge($les_modalites, $arbre->get_modalites($acteur) );
		}		
	 
	   	if( count($les_modalites) == 0 ){
			echo("La partie <b>\"Validation\"</b> n'a pas &eacute;t&eacute; faite car aucune modalit&eacute; n'est cr&eacute;&eacute;e");
		}else {	
			echo"
			<form name='theForm'  action='performance_feuille_v.php' method='post' >		     			 
				<input type='hidden' name='id_noeud' value='$id_noeud'>";				
		
				foreach($les_modalites as $modalite ) {									
					afficher_modalite($modalite);
					
					echo"<br>"; 					
				}
				
			echo"<p> <input type='checkbox' name='meme_param' value='1'	>
				    Appliquer les m&ecirc;mes param&egrave;tres &agrave; toutes les feuilles de l'arbre.
				 </p>";		
			echo"<input type='submit' value='valider'>";	
			echo"</form>";
		}									
		?>
		</div>	
	</div>
</body>
</html>
