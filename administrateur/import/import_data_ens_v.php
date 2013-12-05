<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/10/05
  // Contenu: Ce script permet de d'enregistrer les données de tous les enseignants saisis 
  //          dans fichier texte du format csv fourni en paramètre .
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");

/***********************************************************/
error_reporting(E_ALL ^ E_NOTICE);
ini_set("max_execution_time",3600); // la durée maximale d'exécution du script est 3600 secondes( 1 heure )

if(isset($_REQUEST['option_login'])) $option_login = $_REQUEST['option_login'];
else { html_refresh("../accueil.php"); exit(); }

if(isset($_REQUEST['option_mdp'])) $option_mdp = $_REQUEST['option_mdp'];
else { html_refresh("../accueil.php"); exit(); }

if(isset($_REQUEST['update'])) $update = 1;  // = 1 si les données de la base  doivent être changées par celle du fichier d'importation
else $update = 0;
$bdd = new Connexion_BDD_LEA();

$src=$_FILES['data_ens']['tmp_name']; 
$nom=$_FILES['data_ens']['name'];

$erreur=$_FILES['data_ens']['error'];
if($erreur) { echo"Erreur lors de l'upload du fichier à importer &nbsp;&nbsp;"; afficher_boutton_retour(); exit();}
 
$fp = fopen ("$src","r");
$data=array();

$ligne1= fgetcsv ($fp, 10000, ";"); // les noms des données importées

$row =0; 

while ($ligne= fgetcsv ($fp, 10000, ";")) {    		
    if(isset($ligne)&& $ligne[0]!=NULL) { 
	    $nb = count($ligne);
		for($j=0; $j < $nb; $j++ ) {
	        $key = trim( $ligne1[$j] );
			$data[$row][$key] = $ligne[$j];
		}	
		$row++;
	}	
		
}

fclose ($fp);

$nbl = count($data); //le nombre de lignes

$nb_ens_update = 0; // nombre d'enseignants  mis à jours.
$nb_ens_insert = 0; // nombre d'enseignants  enregistrés.

// parcours de la table data: chaque ligne correspond à un enseignant

for($i=0; $i<$nbl; $i++){ 

	$enseignant = new Enseignant(0);
	$ligne = $data[$i];

	$enseignant->civilite = addslashes(trim($ligne["CIVILITE_ENSEIGNANT"]));
	$enseignant->nom 	  = addslashes(trim($ligne["NOM_ENSEIGNANT"]));
	$enseignant->prenom   = addslashes(trim($ligne["PRENOM_ENSEIGNANT"]));
	$sql="select dr_soumis from les_droits where id_droit='ens'";
	$result=$bdd->executer($sql);
		while($ligneSql = mysql_fetch_assoc($result)){
		$dr_soumis=$ligneSql['dr_soumis'];
		}
	if ($dr_soumis == null ) $dr_soumis = "ens";
	$enseignant->profil   =$dr_soumis;
	
	if($existe_enseignant = $enseignant->existe()) {
				 $enseignant->id_ens = $enseignant->id_usager;
				 $enseignant->set_detail();
    }
	
	$enseignant->civilite 	= addslashes(trim($ligne["CIVILITE_ENSEIGNANT"]));
	$enseignant->nom 	  	= addslashes(trim($ligne["NOM_ENSEIGNANT"]));
	$enseignant->prenom   	= addslashes(trim($ligne["PRENOM_ENSEIGNANT"]));
	$enseignant->adresse    = addslashes($ligne["ADRESSE_ENSEIGNANT"]);
	$enseignant->tel_fixe   = addslashes($ligne["TELEPHONE1_ENSEIGNANT"]);
	$enseignant->tel_mobile = addslashes($ligne["TELEPHONE2_ENSEIGNANT"]);
	$enseignant->email	    = addslashes($ligne["EMAIL_ENSEIGNANT"]);
	$enseignant->discipline = addslashes($ligne["DISCIPLINE_ENSEIGNANT"]);
	$enseignant->url_site	= addslashes($enseignant->url_site);		

	if(!$existe_enseignant) {			
		$enseignant->login = create_login($option_login,  "$enseignant->prenom " . " $enseignant->nom") ;
		$enseignant->mdp = create_mdp($option_mdp,  $enseignant->login ) ;

	}	
	
	  //print_r($enseignant); echo("<br><br>");
	  	
	if ($enseignant->login != "" ) {	
		if( $existe_enseignant) { 
					if($update) { 						
						$enseignant->update();
						$nb_ens_update++;
					}	
		}					
		else {			$enseignant->insert();
						$nb_ens_insert++;						
		}
	}
	
}//fin  foreach

$str="
<div id=\"top_l\"></div><div id=\"top_m\"><h1><span class=\"orange\">I</span>mportation des enseignants</h1></div><div id=\"top_r\"></div>
<b>Statistique </b> <hr>
<pre>

------------------------------------------------------------------------------
Nombre d'enseignants  mis à jours : <b> $nb_ens_update </b>
Nombre d'enseignants  enregistrés: <b> $nb_ens_insert </b>
------------------------------------------------------------------------------
</pre>
	";



//html_refresh($LEA_URL."administrateur/gest_usag/gest_usag.php?cmd=cons_liste_ens"); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>				
		
		<title>LEA Administrateur</title>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		
		<meta name="keywords" content="" />
		<meta name="special" content="" /> 		
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>" media="screen" />
		<script type="text/javascript" src="/javascript/menu.js"></script>		
	</head>
<body>

	<div id="conteneur">
		<div id="header">
		<div id="session">
			 <?php 
				$nom_admin=$_SESSION['nom_admin'];
				$prenom_admin=$_SESSION['prenom_admin'];
				echo  "<strong>Bonjour ".$prenom_admin."&nbsp;".$nom_admin."</strong>"; 
				if (!$AUTHENTIFICATION_CAS) {
					echo '<a href="../fermer_session.php">D&eacute;connexion</a>';
				}
				
			?>
		</div>
			<?php include($LEA_REP."header.php")?>
		</div>
			
<div id="contenu">
										
    		<div id="contents">
    		<?php 
				echo"$str"; 
				echo"<a href=\"$LEA_URL"."administrateur/gest_usag/gest_usag.php?cmd=cons_liste_ens". "\"\>
						Liste des enseignants </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				 afficher_boutton_retour(); 						
			
			?>
			</div>
					  <div id="bottom_box"> </div>   
		</div>	
		
		<div id="footer">
			<?php include($LEA_REP."footer.php")?>
		</div>
		
	</div>
	
</body>
</html>
