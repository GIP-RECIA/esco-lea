<?php
if	(file_exists("./config/config.inc.php")) {
	require_once("./config/config.inc.php");
} else {
	echo'<b> Fichier de configuration introuvable </b>';
	include('index.php');
	exit();
}
session_name("LEA_$RNE_ETAB");

if (!isset($AUTHENTIFICATION_CAS) || !$AUTHENTIFICATION_CAS) {
	session_cache_expire(60);
	session_start();
	$_SESSION = array();
	session_destroy();
	session_cache_expire(60);
	session_start();
}

require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");

$bdd = new Connexion_BDD_LEA();

if (isset($AUTHENTIFICATION_CAS) && $AUTHENTIFICATION_CAS) {
	require_once('./lib/Cas/authentificationCAS.php');
} 

$_SESSION['droitAdminCAS']=$droitAdminCAS;
		
if (isset($userCAS)) {
	$sql="SELECT id_usager, civilite, nom, prenom, profil from les_usagers
       WHERE login='$userCAS'";
} elseif ($_POST['the_login'] != "" && $_POST['the_mdp'] != "") {

	$login = to_sql($_POST['the_login']);
	$mdp = to_sql($_POST['the_mdp']);

	$sql="SELECT id_usager, civilite, nom, prenom, profil from les_usagers
       WHERE login='$login' and mdp='$mdp'";
}
if (isset($sql)) {
	$result = $bdd->executer($sql);

	if (mysql_num_rows($result)==1) {
		$sql="select dr_soumis from les_droits where id_droit='unite_peda'";
		$result2=$bdd->executer($sql);
		$unite="";
		if ($ligne = mysql_fetch_assoc($result2)) {
			$unite=$ligne['dr_soumis'];
		}
		if($unite=="false") {
			$_SESSION['unite']="false"; 
		} else {
			$_SESSION['unite']="true";
		}

		$sql="select dr_soumis from les_droits where id_droit='suivi_entr'";
		$result2=$bdd->executer($sql);
		$suivi_entr="";
		if ($ligne = mysql_fetch_assoc($result2)) {
			$suivi_entr=$ligne['dr_soumis'];
		}
		if($suivi_entr=="false") {
			$_SESSION['suivi_entr']="false";
		} else {
			$_SESSION['suivi_entr']="true";
		}


		$sql="select dr_soumis from les_droits where id_droit='rvs'";
		$result2=$bdd->executer($sql);
		$rvs="";
		if ($ligne = mysql_fetch_assoc($result2)) {
			$rvs=$ligne['dr_soumis'];
		}
		if($rvs=="") {
			$_SESSION['rvs']="false";
		} else {
			$_SESSION['rvs']="true";
		}

		$ligne = mysql_fetch_assoc($result);
		if(!ereg(",",$ligne['profil'])) $profil= $ligne['profil'];
		else{
			$chaine = $ligne['profil'];
			
			$tok = strtok($chaine,",");
			$profil=$tok;

		}
		$_SESSION['atok']=$profil;
		$_SESSION['options_lea'] = $bdd->get_options();

		$id_usager=$ligne['id_usager'];
		$lenom=$ligne['nom'];
		$leprenom=$ligne['prenom'];
		$civil=$ligne['civilite'];
		$sql="select dr_soumis from les_droits where id_droit='parent'";
		$result2=$bdd->executer($sql);
		$parent="";
		if ($ligne = mysql_fetch_assoc($result2)) {
			$parent=$ligne['dr_soumis'];
		}
		if($parent=="false") {
			$_SESSION['parent']="false";
		} else {
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

					}
				} else {
					$_SESSION['parent']="true";
				}
			} else {
				$_SESSION['parent']="true";
			}
		}

		$usager = new Usager( $id_usager);
		$usager->set_detail();
		$usager->update_connexion();
		
		$usager->update_log("Connexion De IP : ".$_SERVER['REMOTE_ADDR']." Agent : ".$_SERVER['HTTP_USER_AGENT']);

		switch($profil){

			case "app":
				$_SESSION['id_app'] = $id_usager;
				$_SESSION['nom_app']= $lenom;
				$_SESSION['prenom_app']= $leprenom;
				$_SESSION['civilite_app']= $civil;

				$header = $LEA_URL."Apprenti/accueil.php";
				break;

			case "ens":
				$_SESSION['id_ens'] = $id_usager;
				$_SESSION['nom_ens'] = $lenom;
				$_SESSION['prenom_ens'] = $leprenom;
				$_SESSION['civilite_ens'] = $civil;

				$header = $LEA_URL."Enseignant/selection_formation.php";
				break;

			case "admin":
				$_SESSION['id_admin'] = $id_usager;
				$_SESSION['nom_admin'] = $lenom;
				$_SESSION['prenom_admin'] = $leprenom;
				$_SESSION['civilite_admin'] = $civil;

				$header = $LEA_URL."administrateur/accueil.php";
				break;

			case "ma":
				$_SESSION['id_ma'] = $id_usager;
				$_SESSION['nom_ma'] = $lenom;
				$_SESSION['prenom_ma'] = $leprenom;
				$_SESSION['civilite_ma'] = $civil;

				$header = $LEA_URL."Maitre_apprentissage/selection_formation.php";
				break;

			case "rl":
				$_SESSION['id_rl'] = $id_usager;
				$_SESSION['nom_rl'] = $lenom;
				$_SESSION['prenom_rl'] = $leprenom;
				$_SESSION['civilite_rl'] = $civil;

				$header = $LEA_URL."Representant_legal/accueil.php";
				break;

			case "rvs":
				$_SESSION['id_rvs'] = $id_usager;
				$_SESSION['nom_rvs'] = $lenom;
				$_SESSION['prenom_rvs'] = $leprenom;
				$_SESSION['civilite_rvs'] = $civil;

				$header = $LEA_URL."Responsable_vie_scolaire/selection_unite.php";
				break;

			case "sr":
				$_SESSION['id_sr'] = $id_usager;
				$_SESSION['nom_sr'] = $lenom;
				$_SESSION['prenom_sr'] = $leprenom;
				$_SESSION['civilite_sr'] = $civil;

				$header = $LEA_URL."sousresponsable/selection_formation.php";
				break;
			default :
				$err_msg = "Login et/ou mot de passe incorrect(s). Veuillez vous identifier de nouveau.";
				include('index.php');
				exit();
		}
			
		header("Location:".$header);
		exit();
			
	} else {
		if (isset($AUTHENTIFICATION_CAS) && $AUTHENTIFICATION_CAS) {
			if ($droitAdminCAS) {
				$_SESSION['id_admin'] = $attributes['login'];
				$_SESSION['nom_admin'] = $attributes['nom'];
				$_SESSION['prenom_admin'] = $attributes['prenom'];
				$_SESSION['civilite_admin'] = "";
				$_SESSION['atok']="admin";
				$_SESSION['options_lea'] = $bdd->get_options();				
				header("Location:".$LEA_URL."administrateur/accueil.php");
			} else {
				header("Location:erreurAuthentification?login=".$userCAS);
			}
		} else {
			$err_msg = "Login et/ou mot de passe incorrect(s). Veuillez vous identifier de nouveau.";
			include('index.php');
		}
		exit();
	}
} else {
	$err_msg = "Erreur lors de la recupération de l'identifiant de l'utilisateur.<br/>Connexion impossible.";
	afficher_msg_erreur($err_msg);
	die();
}

?>
