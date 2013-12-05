<?php 
 // Copyright Â© 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/08/05
  // Contenu:   Ce script permet Ã  un maitre d'apprentissage de son apprenti 

/***********************************************************/
require_once ("secure.php");
require_once("../config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
//-----------------------------------------------------------------------------------

$maitre = new Maitre_apprentissage($_SESSION['id_ma']);	

$les_formations = $maitre->get_formations();

if( count($les_formations) == 0) {
	afficher_msg_erreur( "Aucune formation n'est enregistr&eacute;e"); 
	afficher_boutton_retour(); 					  
	exit();					  
}
elseif(count($les_formations) == 1) {
	$_SESSION['id_for'] = $les_formations[0]->id_for;
	html_refresh("accueil.php");	
}
				   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>S&eacute;lection <?php echo $config_term->terminologie_formation; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="special" content="" />
<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/enseignant.css');?>"  />
</head>
<body>
<div id="formation">
  <div id="formationSession">
    <?php 
				$nom_ma=$_SESSION['nom_ma'];
				$prenom_ma=$_SESSION['prenom_ma'];
				echo  "<strong>Bonjour ".to_html($prenom_ma)."&nbsp;".to_html($nom_ma)."</strong>"; 
				if (!$AUTHENTIFICATION_CAS) {
					echo '<a href="../fermer_session.php">D&eacute;connexion</a>';
				}
			?>
    
  </div>
  <div id="formationContenu">
    <p>S&eacute;lectionnez <?php echo $config_term->terminologie_formation; ?></p>
    <center>
    	<?php  	
		if(($nb = count($les_formations)) > 0 ){	 	
			echo"<table cellspacing='10'>\n";	  	 
			$nbformation=0;
			for($k=0; $k < $nb; $k++){
				if(isset($les_formations[$k]) ){
				 	$formation = $les_formations[$k];
					$charte = $formation->get_charte_graphique();
					
					$nbformation++;
					if (($k % 2) == 0) echo "<tr>\n";

					echo"<td>\n";
					echo"<a href=\"accueil.php?id_for=$formation->id_for\">";
					echo("<img src=". $LEA_URL."images/charte_graphique/".urlencode($charte->logo) ." border=\"0\" />");
					echo(to_html($formation->nom));
					echo"</a>";
		
					echo"</td>\n";
					if (($k % 2) == 1) echo "</tr>\n";
		 		} 
			}
			if (($k % 2) == 1) echo "</tr>\n";	  	
			echo"</table>\n";
		}
		?>
    </center>
  </div>

  <?php 
if(isset($_REQUEST['id_for']))	{	

$formation = new Formation($_REQUEST['id_for']);
$formation->set_detail(0); 
$nom_formation = $formation->nom;

afficher_msg_erreur("Vous n'&ecirc;tes pas autoris&eacute; &agrave; vous connecter au ".$config_term->terminologie_lea." en ".$config_term->terminologie_formation." &nbsp; ".to_html( $nom_formation).". <br> Veuillez contacter le responsable de cette formation." );		
}
if(($nb = count($les_formations)) > 0 ){
}else afficher_msg_erreur("Rien n'est enregistr&eacute;");
?>
</div>
</body>
</html>
