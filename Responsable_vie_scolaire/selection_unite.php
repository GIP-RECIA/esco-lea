<?php
 // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/08/05
  // Contenu:   Ce script permet Ã  un  enseignant de sÃ©lÃ©ctionner la formation Ã  laquelle  
  //            veut se connecter
/***********************************************************/
require_once ("./secure.php");
require_once("../config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");

//-----------------------------------------------------------------------------------
$config_term = new Terminologie();
$config_term->set_detail();
$bdd = new Connexion_BDD_LEA();

$rvs= new Usager($_SESSION['id_rvs']); 

$les_unites = $rvs->get_unites();

$les_formations = $bdd->get_formations();
					  
if(count($les_unites) == 1) {
		$_SESSION['id_unite'] = $les_unites[0]->id_unite;
		$_SESSION['nom_unite'] = $les_unites[0]->nom;
		html_refresh("accueil.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>LEA: S&eacute;lection <?php echo $config_term->terminologie_unit_pedag; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="special" content="" />
<link rel="stylesheet" type="text/css" href="<?php echo($URL_THEME.'enseignant.css');?>"  />
</head>
<body>
<div id="formation">
  <div id="formationSession">
    <?php 
			$nom_rvs=$_SESSION['nom_rvs'];
			$prenom_rvs=$_SESSION['prenom_rvs'];
			$enseignant = new Enseignant($_SESSION['id_rvs']);
			echo  "Bonjour <strong>".$prenom_rvs."&nbsp;".$nom_rvs."</strong>"; 
			if (!$AUTHENTIFICATION_CAS) {
				echo '<a href="../fermer_session.php">D&eacute;connexion</a>';
			}
		?>
    
  <div id="formationContenu">
  <form  action="accueil.php" method="post">
    <p>S&eacute;lectionnez votre <?php echo $config_term->terminologie_unit_pedag; ?> </p>
    <select name="id_unite">
            <?php	  
				  foreach($les_unites as $unite) {
					  echo("<option value='$unite->id_unite' > $unite->nom </option>");
	  
				  }
				  ?>
          </select>
          <input type="submit" name="Submit" value="Valider">
</p>
		</FORM>
  </div>
  <div >
    <?php include("../footer.php") ?>
    </div>
<?php
if( count($les_unites) == 0) {
	afficher_msg_erreur( "Vous &egrave;tes responsable d'aucune unit&eacute; <br>
						  Veuillez contacter l'administrateur LEA  "); 
	afficher_boutton_retour(); 					  				  
}
?>
</div>
</body>
</html>
