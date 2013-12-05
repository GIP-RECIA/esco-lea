<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module du gestion de livrets des apprentis

/*  Cette fonction permet d'afficher le sous menu du livret
*/
//
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

function afficher_sous_menu($selected_rubrique) {
global $LEA_URL;
global $URL_THEME;
//
$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$les_apprentis = $formation->get_apprentis();

$config_lea = $formation->get_config_lea();
if($config_lea->id_config == 0) {  
	// on crï¿½e une nouvelle configuration
	$config_lea->id_for = $formation->id_for;
	$config_lea->suivi_entr_actif = 1;
	$config_lea->insert();
	
	$suivi_entr_guide = 0;
	$suivi_entr_libre = 0;								
}
?>
<div id="sousMenu">
	<ul>   
	    <li>
			<a <?php if ($selected_rubrique=="cons_liste_app") echo" class=\"selected\"" ?> href="apprentis.php?cmd=cons_liste_app" >Par <?php echo($config_lea->appelation_app) ?></a>
		</li>
    
	 	<li>
		 	<a <?php if ($selected_rubrique=="bilan_classe") echo" class=\"selected\"" ?> href="apprentis.php?cmd=bilan_classe" >Synth&egrave;se par <?php echo $config_lea->appelation_classe; ?> </a>
		 	<?php
			 	//echo"<img src='".$URL_THEME."images/ico_performance.png' >";  
				/*echo '<a href="'.$LEA_URL.'Apprenti/Livret/bilan_classe.php?cmd=bilan_classe" target = "_blank"> 
						Synth&egrave;se par '.($config_lea->appelation_classe).' </a>';*/
			?>  
		</li>
		<li>
			<a <?php if ($selected_rubrique=="suivi_signature") echo" class=\"selected\"" ?> href="apprentis.php?cmd=suivi_signature" >Suivi des signatures</a>
		</li>
	</ul>
</div>
<?php
}
?>
