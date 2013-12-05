<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 06/09/05
// Contenu:
/***********************************************************/
include("../secure.php");
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

/***********************************************************/
if (isset($_REQUEST['profil'])) {
	$profil=$_REQUEST['profil']; // le profil de l'usager qu'on veut ajouter ou modifier
}
else {
	$profil="";
}

if(isset($_REQUEST['action'])) {
	$action=$_REQUEST['action']; // l'action demandée : mofier ou ajouter un nouvel usager
}
else {
	$action="";
}
$bdd = new Connexion_BDD_LEA();
if($action!="modif"){
	$login = to_sql($_REQUEST['login']);
	$sql="select login from les_usagers where login='$login'";
	$res=$bdd->executer($sql);
	if(mysql_num_rows($res)>0){
		echo " le login existe d&eacute;j&agrave;  ";
		exit();
	}
}

if ($action=="modif") {
	$id_usager=$_REQUEST['id_usager'];
}
else {
	$id_usager=0;
}
$droitligne="";
switch($profil){

	case "app":
		$usager = new Apprenti($id_usager); // on crée un nouvel usager de type  apprenti
		$usager->set_detail();
		$old_src_photo = $usager->src_photo;
		break;
	case "ens":
		$usager = new Enseignant($id_usager); // on crée un nouvel usager de type  enseignant
		$usager->set_detail();
		break;
	case "ma":
		$usager = new Maitre_apprentissage($id_usager); // on crée un nouvel usager de type  maitre d'apprentissage
		$usager->set_detail();
		break;
	case "rl":
		$usager = new Representant_legal($id_usager); // on crée un nouvel usager de type  représentant légal
		$usager->set_detail();
		break;
	case "rvs":
		$usager = new Usager($id_usager); // on crée un nouvel usager de type  responsable vie scolaire
		$usager->set_detail();
		break;
	case "admin":
		$usager = new Usager($id_usager); // on crée un nouvel usager de type  administrateur
		$usager->set_detail();
		break;
	default		: break;

}
function reorganiser($tout,$truc){
	if(ereg($truc,$tout)){
		$retour=$truc;
		$tok = strtok($tout,",");
		while ($tok != false) {
			if($tok!=$truc) $retour=$retour.','.$tok;
			$tok = strtok(",");
		}
		return $retour;
	}
}
if ( $profil=="app" || $profil=="ens" || $profil=="ma" || $profil=="rl" || $profil=="rvs" || $profil=="admin" ){

	$usager->civilite = to_sql($_REQUEST['civilite']);
	$usager->nom = to_sql($_REQUEST['nom']);
	$usager->prenom = to_sql($_REQUEST['prenom']);
	$usager->adresse = to_sql($_REQUEST['adresse']);
	$usager->tel_fixe = to_sql($_REQUEST['tel_fixe']);
	$usager->tel_mobile = to_sql($_REQUEST['tel_mobile']);
	$usager->email = to_sql($_REQUEST['email']);
	$usager->url_site = to_sql($_REQUEST['url_site']);
	$usager->login = to_sql($_REQUEST['login']);
	$usager->mdp = to_sql($_REQUEST['mdp']);

	if(isset($_REQUEST['droit']) and $profil!='app' and $profil!='rl') {
		$droit=$_REQUEST['droit'];
		$droitligne=$droit[0];
		if($id_usager!=0) {
			$usagerdel = new Enseignant($id_usager); // on crée un nouvel usager de type  enseignant
			$usagerdel->set_detail();
			// $usagerdel->delete_all_ens($id_usager);
			$usagerdel->delete_all_resp($id_usager);
		}

		for ($i=1; $i<sizeof($droit);$i++) {
			$droitligne=$droitligne.",".$droit[$i];

			if($droit[$i]=="sr") {
//				$usager = new Enseignant($id_usager); // on crée un nouvel usager de type  enseignant
//				$usager->set_detail();
				$usager->delete_all_resp($id_usager);
				if(isset($_REQUEST['id_for']) and $action=="modif") {
					$for=$_REQUEST['id_for'];
					for($j=0;$j<sizeof($for);$j++) {
						$usager->insert_sous_resp($id_usager,$for[$j]);
					}
				}
				if(isset($_REQUEST['id_for']) and $action!="modif") {
					$for=$_REQUEST['id_for'];
					$usager->civilite = to_sql($_REQUEST['civilite']);
					$usager->nom = to_sql($_REQUEST['nom']);
					$usager->prenom = to_sql($_REQUEST['prenom']);
					$usager->adresse = to_sql($_REQUEST['adresse']);
					$usager->tel_fixe = to_sql($_REQUEST['tel_fixe']);
					$usager->tel_mobile = to_sql($_REQUEST['tel_mobile']);
					$usager->email = to_sql($_REQUEST['email']);
					$usager->url_site = to_sql($_REQUEST['url_site']);
					$usager->login = to_sql($_REQUEST['login']);
					$usager->mdp = to_sql($_REQUEST['mdp']);
					$usager->insert_sous_resp_herite($for);
					$action="modif";
					$id_usager=$usager->id_usager;
				}
			}
			if($droit[$i]=="ens") {
				$usager = new Enseignant($id_usager); // on crée un nouvel usager de type  enseignant
				$usager->set_detail();
				$usager->civilite = to_sql($_REQUEST['civilite']);
				$usager->nom = to_sql($_REQUEST['nom']);
				$usager->prenom = to_sql($_REQUEST['prenom']);
				$usager->adresse = to_sql($_REQUEST['adresse']);
				$usager->tel_fixe = to_sql($_REQUEST['tel_fixe']);
				$usager->tel_mobile = to_sql($_REQUEST['tel_mobile']);
				$usager->email = to_sql($_REQUEST['email']);
				$usager->url_site = to_sql($_REQUEST['url_site']);
				$usager->login = to_sql($_REQUEST['login']);
				$usager->mdp = to_sql($_REQUEST['mdp']);
				$sql=" SELECT id_ens FROM les_enseignants WHERE id_ens=$id_usager";
				$bdd = new Connexion_BDD_LEA();
				$result=$bdd->executer($sql);
				if($action=="modif"){
					if (mysql_num_rows($result)==0){
						$usager->insert2();
					}
					else {
						$usager->update2();
					}
				}else{
					$usager->insert();
					$action="modif";
					$id_usager=$usager->id_usager;
				}
			}
		}
	} else {
		if($id_usager==0) {
			$droitligne=$profil;
		} else {
			$bdd = new Connexion_BDD_LEA();
			$chaine=$bdd->getprofil($id_usager);
			$tok = strtok($chaine,",");
			$droitligne=$tok;
		}
	}
	/*$usager=new Usager($id_usager);
	 $usager->civilite = to_sql($_REQUEST['civilite']);
	 $usager->nom = to_sql($_REQUEST['nom']);
	 $usager->prenom = to_sql($_REQUEST['prenom']);
	 $usager->adresse = to_sql($_REQUEST['adresse']);
	 $usager->tel_fixe = to_sql($_REQUEST['tel_fixe']);
	 $usager->tel_mobile = to_sql($_REQUEST['tel_mobile']);
	 $usager->email = to_sql($_REQUEST['email']);
	 $usager->url_site = to_sql($_REQUEST['url_site']);
	 $usager->login = to_sql($_REQUEST['login']);
	 $usager->mdp = to_sql($_REQUEST['mdp']);*/
	$droitligne=reorganiser($droitligne,$profil);
	$usager->profil = $droitligne;
	if($action=="modif"){
		$usager->update();
		if(!ereg("ens",$droitligne)){
			$sql="update les_formations set id_ens='' where id_ens='$id_usager'";
			$bdd->executer($sql);
			$sql="delete from les_enseignants_formations where id_ens='$id_usager'";
			$bdd->executer($sql);
		}
		if(!ereg("rvs",$droitligne)){
			$sql="delete from les_responsables_unites_pedagogiques where id_rvs='$id_usager'";
			$bdd->executer($sql);
		}
		if(!ereg("ma",$droitligne)){
			$sql="delete from les_maitres_apprentissage where id_ma='$id_usager'";
			$bdd->executer($sql);
		} else {
			$sql="delete from les_maitres_apprentissage where id_ma='$id_usager'";
			$bdd->executer($sql);
			$s="insert into les_maitres_apprentissage values ('$id_usager','')";
			$bdd->executer($s);
		}
	}
}

switch($profil) {

	case "app":
		$usager->date_nais = trans_date($_REQUEST['date_nais']);
		$usager->no_insc = to_sql($_REQUEST['no_insc']);
		$usager->no_secu = to_sql($_REQUEST['no_secu']);
		$usager->dern_classe_freq = to_sql($_REQUEST['dern_classe_freq']);
		$usager->diplomes_obtenus = to_sql($_REQUEST['diplomes_obtenus']);
		$usager->adresse_perso = to_sql($_REQUEST['adresse_perso']);
		$usager->tel_perso = to_sql($_REQUEST['tel_perso']);
		$usager->email_perso = to_sql($_REQUEST['email_perso']);
		$usager->date_debut_contrat = trans_date($_REQUEST['date_debut_contrat']);
		$usager->date_fin_contrat = trans_date($_REQUEST['date_fin_contrat']);
		$usager->id_cla = to_sql($_REQUEST['id_cla']); // l'identifiant de la classe de l'apprenti
		$usager->id_ens = to_sql($_REQUEST['id_ens']);
		$usager->id_ma = to_sql($_REQUEST['id_ma']);
		$usager->id_rl = to_sql($_REQUEST['id_rl']);

		$src = $_FILES['src_photo']['tmp_name'];
		$nom = $_FILES['src_photo']['name']; // le nom de la photo telechargé

		$repertoireDestination = "../../Apprenti/Photos/";

		$filename = "$repertoireDestination"."$old_src_photo";
			
		if (file_exists($filename)&& $old_src_photo!="" && $nom!="") {
			unlink($filename);
		}
		$dest = "";
		$nb = date("dmy-His");
		if ($nom!="") {
			$dest = "photo_".$nb.".".get_extension($nom);
		}
			
		if  (move_uploaded_file($src, $repertoireDestination.$dest)) {
			$usager->src_photo = to_sql($dest);
		}
			
		if($action == "modif") {
			$usager->update();
		}
		else {
			$usager->insert();
		}
			
		html_refresh("gest_usag.php?cmd=cons_coordonnees_usager&profil=app&id_app=$usager->id_usager");
		break;

	case "ens":
		$usager->discipline = to_sql($_REQUEST['discipline']);
			
		if(isset($_REQUEST['les_id_for'])) {
			$les_id_for = $_REQUEST['les_id_for']; // les formations de l'enseignants
		}
		else {
			$les_id_for = array();
		}
			
		if($action=="modif") {
			$usager->update();
		}
		else {
			$usager->insert();
		}
		if(ereg("rvs",$droitligne) and $_SESSION['unite']=="false"){
			$sql2="select * from les_responsables_unites_pedagogiques where id_rvs='$id_usager'";
			$result2=$bdd->executer($sql2);
			if (mysql_num_rows($result)==0){
				$sql="select id_unite from les_unites_pedagogiques where nom='default'";
				$result=$bdd->executer($sql);
				if ($ligne = mysql_fetch_assoc($result)) {
					$id=$ligne['id_unite'];
				}
				$sql="insert into les_responsables_unites_pedagogiques values ('$id_usager','$id')";
				$bdd->executer($sql);
			}
		}
		html_refresh("gest_usag.php?cmd=cons_coordonnees_usager&profil=ens&id_ens=$usager->id_usager");
		break;
			
	case "ma":
		$usager->id_entr = to_sql($_REQUEST['id_entr']);

		if($action == "modif") {
			$usager->update();
		}
		else {
			$usager->insert();
		}
		if(ereg("rvs",$droitligne) and $_SESSION['unite']=="false"){
			$sql2="select * from les_responsables_unites_pedagogiques where id_rvs='$id_usager'";
			$result2=$bdd->executer($sql2);
			if (mysql_num_rows($result)==0){
				$sql="select id_unite from les_unites_pedagogiques where nom='default'";
				$result=$bdd->executer($sql);
				if ($ligne = mysql_fetch_assoc($result)) {
					$id=$ligne['id_unite'];
				}
				$sql="insert into les_responsables_unites_pedagogiques values ('$id_usager','$id')";
				$bdd->executer($sql);
			}
		}
		html_refresh("gest_usag.php?cmd=cons_coordonnees_usager&profil=ma&id_ma=$usager->id_usager");
		break;
			
	case "rl":
		$usager->profession = to_sql($_REQUEST['profession']);
		$usager->adresse_prof = to_sql($_REQUEST['adresse_prof']);

		if($action == "modif") {
			$usager->update();
		}
		else {
			$usager->insert();
		}
			
		html_refresh("gest_usag.php?cmd=cons_coordonnees_usager&profil=rl&id_rl=$usager->id_usager");
		break;

	case "rvs":
		if($action == "modif") {
			$usager->update();
		}
		else {
			$usager->insert();
		}
		if(ereg("rvs",$droitligne) and $_SESSION['unite']=="false"){
			$sql2="select * from les_responsables_unites_pedagogiques where id_rvs='$id_usager'";
			$result2=$bdd->executer($sql2);
			if (mysql_num_rows($result)==0){
				$sql="select id_unite from les_unites_pedagogiques where nom='default'";
				$result=$bdd->executer($sql);
				if ($ligne = mysql_fetch_assoc($result)) {
					$id=$ligne['id_unite'];
				}
				$sql="insert into les_responsables_unites_pedagogiques values ('$id_usager','$id')";
				$bdd->executer($sql);
			}
		}
		html_refresh("gest_usag.php?cmd=cons_coordonnees_usager&profil=rvs&id_usager=$usager->id_usager");
		break;

			
	case "admin":
		if($action == "modif") {
			$usager->update();
		}
		else {
			$usager->insert();
		}
		if(ereg("rvs",$droitligne) and $_SESSION['unite']=="false"){
			$sql2="select * from les_responsables_unites_pedagogiques where id_rvs='$id_usager'";
			$result2=$bdd->executer($sql2);
			if (mysql_num_rows($result)==0){
				$sql="select id_unite from les_unites_pedagogiques where nom='default'";
				$result=$bdd->executer($sql);
				if ($ligne = mysql_fetch_assoc($result)) {
					$id=$ligne['id_unite'];
				}
				$sql="insert into les_responsables_unites_pedagogiques values ('$id_usager','$id')";
				$bdd->executer($sql);
			}
		}
		html_refresh("gest_usag.php?cmd=cons_coordonnees_usager&profil=admin&id_usager=$usager->id_usager");
		break;
		
	default :
		break;
}
?>