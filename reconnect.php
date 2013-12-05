<?php 
require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();
require_once ($LEA_REP."lib/stdlib.php");
require($LEA_REP.'modele/bdd/classe_usager.php');
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
$profil=$_GET['tok'];
$ancientokenprofil=$_SESSION['atok'];
$bdd = new Connexion_BDD_LEA();

switch($profil){

	case "app":
		$_SESSION['id_app'] = $_SESSION['id_'.$ancientokenprofil];
		$_SESSION['nom_app']= $_SESSION['nom_'.$ancientokenprofil];
		$_SESSION['prenom_app']= $_SESSION['prenom_'.$ancientokenprofil];
		$_SESSION['civilite_app']= $_SESSION['civilite_'.$ancientokenprofil];

		$header = $LEA_URL."Apprenti/accueil.php";
		break;

	case "ens":
		$_SESSION['id_ens'] = $_SESSION['id_'.$ancientokenprofil];
		$_SESSION['nom_ens'] = $_SESSION['nom_'.$ancientokenprofil];
		$_SESSION['prenom_ens'] = $_SESSION['prenom_'.$ancientokenprofil];
		$_SESSION['civilite_ens'] = $_SESSION['civilite_'.$ancientokenprofil];

		$header = $LEA_URL."Enseignant/selection_formation.php";
		break;

	case "ma":
		$_SESSION['id_ma'] = $_SESSION['id_'.$ancientokenprofil];
		$_SESSION['nom_ma'] = $_SESSION['nom_'.$ancientokenprofil];
		$_SESSION['prenom_ma'] = $_SESSION['prenom_'.$ancientokenprofil];
		$_SESSION['civilite_ma'] = $_SESSION['civilite_'.$ancientokenprofil];

		$header = $LEA_URL."Maitre_apprentissage/selection_formation.php";
		break;
	case "admin":
		$_SESSION['id_admin'] = $_SESSION['id_'.$ancientokenprofil];
		$_SESSION['nom_admin'] = $_SESSION['nom_'.$ancientokenprofil];
		$_SESSION['prenom_admin'] = $_SESSION['prenom_'.$ancientokenprofil];
		$_SESSION['civilite_admin'] = $_SESSION['civilite_'.$ancientokenprofil];
		$header = $LEA_URL."administrateur/accueil.php";
		break;
	case "rl":
		$_SESSION['id_rl'] = $_SESSION['id_'.$ancientokenprofil];
		$_SESSION['nom_rl'] = $_SESSION['nom_'.$ancientokenprofil];
		$_SESSION['prenom_rl'] = $_SESSION['prenom_'.$ancientokenprofil];
		$_SESSION['civilite_rl'] = $_SESSION['civilite_'.$ancientokenprofil];

		$header = $LEA_URL."Representant_legal/accueil.php";
		break;

	case "rvs":
		$id_usager=$_SESSION['id_'.$ancientokenprofil];
		$sql="select dr_soumis from les_droits where id_droit='parent'";
		$result2=$bdd->executer($sql);
		$parent="";
		if ($ligne = mysql_fetch_assoc($result2)) {
			$parent=$ligne['dr_soumis'];
		}
		if($parent=="false"){$_SESSION['parent']="false";}else {
			$_SESSION['parent']="false";
			if(ereg("rvs",$profil)){
				$sq="select id_unite from les_responsables_unites_pedagogiques where id_rvs='$id_usager'";
				$res=$bdd->executer($sq);
				if ($ligne = mysql_fetch_assoc($res)) {
					$unite=$ligne['id_unite'];

					$sq="select id_for from les_formations where id_unite='$unite'";
					$res=$bdd->executer($sq);
					if(mysql_num_rows($res)==0)$_SESSION['parent']="true";
					while ($ligne = mysql_fetch_assoc($res)) {
						$for=$ligne['id_for'];
						$s="select id_for_without_parent from les_droits_formations where id_for_without_parent='$for'";
						$re=$bdd->executer($s);
							
						if(mysql_num_rows($re)==1 and $_SESSION['parent']=="false"){
						}
						else{
							$_SESSION['parent']="true";
						}

					}}else{$_SESSION['parent']="true";}
			}else{

				$_SESSION['parent']="true";

			}

		}


		$_SESSION['id_rvs'] = $_SESSION['id_'.$ancientokenprofil];
		$_SESSION['nom_rvs'] = $_SESSION['nom_'.$ancientokenprofil];
		$_SESSION['prenom_rvs'] = $_SESSION['prenom_'.$ancientokenprofil];
		$_SESSION['civilite_rvs'] = $_SESSION['civilite_'.$ancientokenprofil];
			
		$header = $LEA_URL."Responsable_vie_scolaire/selection_unite.php";
		break;
	case "sr":
		$_SESSION['id_sr'] = $_SESSION['id_'.$ancientokenprofil];
		$_SESSION['nom_sr'] = $_SESSION['nom_'.$ancientokenprofil];
		$_SESSION['prenom_sr'] =  $_SESSION['prenom_'.$ancientokenprofil];
		$_SESSION['civilite_sr'] = $_SESSION['civilite_'.$ancientokenprofil];

		$header = $LEA_URL."sousresponsable/selection_formation.php";
		break;
}
$_SESSION['atok']=$profil;

$usager = new Usager($_SESSION['id_'.$profil]);
$usager->set_detail();

$chaine = date('[d/m/y H:i:s]') . ' ' .$_SERVER['PHP_SELF']  . ' | acces'."\n";

$usager->update_log($chaine);

header("Location:".$header);
exit();
?>