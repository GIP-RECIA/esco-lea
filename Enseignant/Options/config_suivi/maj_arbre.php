<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la mise  ï¿½ jour d'un arbre
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	 require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))        require_once("../config/config.inc.php");

include_once($LEA_REP."Enseignant/secure.php");

require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['id_arbre'])) { 
			$id_arbre = $_REQUEST['id_arbre']; 			
} 

$arbre = new Arbre($id_arbre);
$arbre->set_detail();

if($arbre->id_config != $config_lea->id_config) exit(); 

$arbre->nb_niveaux = $arbre->get_nb_niveaux(); 

// si cet arbre n'a pas de niveaux

if($arbre->nb_niveaux < 1 )html_refresh($LEA_URL."erreur.php"); 

if(isset($_REQUEST['id_noeud'])) $id_noeud = $_REQUEST['id_noeud']; 
else $id_noeud = 0;

// Ce noeud permet l'affichage de la branche de l'arbre qui conduit ï¿½ ses fils.

$noeud = new Noeud($id_noeud, $id_arbre); 
$noeud->id_arbre = $id_arbre;
$noeud->set_detail();

$les_id_noeuds_ascendants = $noeud->get_id_noeuds_ascendants(); // les identifiant des noeuds ascendant de noeud actif

if( $id_noeud > 0 ) 	$les_id_noeuds_ascendants[] = $id_noeud;
		
$noeud->niveau = count($les_id_noeuds_ascendants)-1; // le niveau du noeud actif

$arbre->noeud_actif = $noeud;
$arbre->set_libelles_niveaux(); // recupï¿½rer tous les noms des niveaux de l'arbre
?>
	<?php 
	  	include("menu_maj_arbre.php");
		afficher_menu_maj_arbre('modifier');
  	?>		
<script type="text/javascript" src="../../../javascript/stdlib.js"></script>
<div id="top_l"></div>
<div id="top_m">
  	<h1>
	  	<?php
			if ($arbre->type == "entr") {
				echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';			
			}elseif($arbre->type == "cfa") {
				echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			}
			echo "<span class='orange'>M</span>ettre &agrave; jour du l'arbre : ".$arbre->nom;
		?>
	</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<div id="m_contenuArbre">
		<table width="100%" border="0">
	    	<tr>
	           	<td width="23%" height="41" align="left">
			     Veuillez introduire le contenu de votre arbre : <?php echo"$arbre->nom" ?>  
					<a href="#" onclick="lightbox('aide_26', '<?php echo $LEA_URL?>')">
					<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>			          
				</td>
	      	</tr>
	        <tr>
	        	<th  align="left">
			   	<?php
					$i=0;
					echo" Vous &ecirc;tes au niveau ";
					foreach($arbre->libelles_niveaux as $libelle){
						$i++;	
						echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  
						if($noeud->niveau == $i-1 )
								echo"<img src='".$LEA_URL."images/triangle.gif' border='0' ><b> $libelle </b>";
						else echo"$libelle";
					}
			   	?>
	        	</th>
	      	</tr>
	        <tr>
			  	<td height="27" align="left">
			  	<?php
					if( count($arbre->tab_noeuds) > 0) {
						if($id_noeud==0) echo"<b> $arbre->nom </b>";
						else echo"<a href='./options.php?cmd=maj_arbre&id_arbre=".$id_arbre."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']."' > $arbre->nom </a>";
					}	
					// affichage d'une branche de l'arbre qui conduit au noeud $noeud_actif 
					// pour de mettre à jour le contenu de l'arbre
					$arbre->afficher_branche($les_id_noeuds_ascendants, 0, 'maj_contenu');
				?>
	          	</td>
	      	</tr>
		</table>
	</div>
</div>
	