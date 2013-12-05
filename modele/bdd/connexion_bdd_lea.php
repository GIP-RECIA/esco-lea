<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 01/02/06
// gère la connexion à la base de donnée LE
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

class Connexion_BDD_LEA {

	var $hostname;  		 // le nom de la machine hote qui heberge la base de données
	var $database;     		 // le nom de la bases de données LEA
	var $username;     		 // un utilisateur de la base
	var $password;           // son mot de passe
	var $erreurs = array();  // liste d'erreurs
	var $connecte = 0;       // booléen qui indique si on est connecté à la base de donneés ou non
	var $requete;            // la dernière requete executée

	// constructeur

	function Connexion_BDD_LEA(){
		global $BDD;

		$this->hostname = $BDD['hostname'];
		$this->database = $BDD['database'];
		$this->username = $BDD['username'];
		$this->password = $BDD['password'];
	}

	/*
	 cette fonction permet la connexion à la base de données LEA
	 */
	function connexion(){

		$this->erreurs=array();
		$conn = @mysql_pconnect($this->hostname, $this->username, $this->password);
		if (!$conn) {

			afficher_msg_erreur(" Impossible de se connecter a la base de donnees LEA : " . mysql_error());
			exit();
		}
		elseif (!mysql_select_db("$this->database")) {

			afficher_msg_erreur("Impossible d'acceder a la base de donnees LEA : " . mysql_error());
			exit();
		}
		else {
			mysql_query("SET NAMES 'utf8'");
			$this->connecte = 1;
		}
	}


	/*
	 Cette fonction permet d'éxecuter la requette $sql
	 elle retourne le resultat
	 */

	function executer($sql, $display_error=1) {
			
		$this->requete = $sql;
		$this->connexion(); // connexion a la base
		

		if($this->connecte) {
			$result = mysql_query($sql);
			if (!$result && $display_error) {
				afficher_msg_erreur("Impossible d'executer la requête  : " . mysql_error()." <br>".$sql);
			}
			return $result;
		}
	}

	/*
	 Cette fonction permet de fermer la connexion
	 */

	function deconnexion() {
			
		mysql_close();
		$this->connecte = 0;
	}

	/* Cette fonction renvoit un tableau contenant la liste de tous les usagers ayant pour profil
	 $profil et un nom commence par  $mot_cle.
	 On récupère un nombre $nb d'usagers à partir de la position de debut $pos 
	 */
	function getprofil($id_usager){
		$sql= "SELECT profil FROM les_usagers WHERE id_usager='$id_usager'";
		$result = $this->executer($sql);
		$ligne = mysql_fetch_assoc($result);
		return $ligne['profil'];


	}
	function get_all_usagers_for($for){
		$sql="select id_usager from les_usagers where profil like 'rvs%' or profil like 'admin%' or profil like 'ma%' order	 by profil";
		$result = $this->executer($sql);
		$les_id = array();
		while ($ligne = mysql_fetch_assoc($result)) {
			$les_id[]=$ligne['id_usager'];
		}
		$sql="select id_app,id_rl from les_apprentis A, les_classes B where A.id_cla = B.id_cla AND B.id_for='$for'";
		$result = $this->executer($sql);
		while ($ligne = mysql_fetch_assoc($result)) {
			$les_id[]=$ligne['id_app'];
			$les_id[]=$ligne['id_rl'];
		}
		$sql="select id_ens from les_enseignants_formations where id_for='$for'";
		$result = $this->executer($sql);
		while ($ligne = mysql_fetch_assoc($result)) {
			$idens=$ligne['id_ens'];
			$les_id[]=$idens;
			/*$sql="select profil from les_usagers where id_usager='$idens'";
			 $result = $this->executer($sql);
			 if($ligne2 = mysql_fetch_assoc($result)){
			 $chaine=$ligne2['profil'];
			 $tok = strtok($chaine,",");
			 }
			 if($tok=="ens")$les_id[]=$idens;*/
		}

		$les_usagers = array();
		for($i=0;$i<sizeof($les_id);$i++){
			$id=$les_id[$i];
			$sql="SELECT id_usager, civilite, nom, prenom, adresse, tel_fixe, tel_mobile,
		   				email, url_site, date_creation, date_derniere_connexion, 
						nombre_connexions, mode_acces, date_debut_acces, date_fin_acces,
						login, mdp
						
				 FROM les_usagers
			     where id_usager='$id'" ; 		   

			$result = $this->executer($sql);



			while ($ligne = mysql_fetch_assoc($result)) {
					
				$usager = new Usager($ligne['id_usager']);
				$usager->civilite = $ligne['civilite'];
				$usager->nom = $ligne['nom'];
				$usager->prenom = $ligne['prenom'];
				$usager->adresse = $ligne['adresse'];
				$usager->tel_fixe = $ligne['tel_fixe'];
				$usager->tel_mobile = $ligne['tel_mobile'];
				$usager->email=$ligne['email'];
				$usager->url_site = $ligne['url_site'];
				$usager->date_creation = trans_date($ligne['date_creation']);
				$usager->date_derniere_connexion = trans_date_time($ligne['date_derniere_connexion']);
				$usager->nombre_connexions = $ligne['nombre_connexions'];
				$usager->mode_acces = $ligne['mode_acces'];
				$usager->date_debut_acces = $ligne['date_debut_acces'];
				$usager->date_fin_acces = $ligne['date_fin_acces'];
				$usager->login = $ligne['login'];
				$usager->mdp = $ligne['mdp'];

				$les_usagers[] = $usager;
			}


		}
		return $les_usagers;
	}

	function get_all_usagers($pos,$nb, $mot_cle="") {
			
		$mot_cle = to_sql($mot_cle);
			
		$sql="SELECT id_usager, civilite, nom, prenom, adresse, tel_fixe, tel_mobile,
		   				email, url_site, date_creation, date_derniere_connexion, 
						nombre_connexions, mode_acces, date_debut_acces, date_fin_acces,
						login, mdp
				 FROM les_usagers
				 WHERE nom LIKE '$mot_cle%' and profil!='app' and profil!='rl'		
			     ORDER BY nom 
		   	     LIMIT $pos, $nb" ; 		   

		$result = $this->executer($sql);
			
		$les_usagers = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$usager = new Usager($ligne['id_usager']);


			$usager->civilite = $ligne['civilite'];
			$usager->nom = $ligne['nom'];
			$usager->prenom = $ligne['prenom'];
			$usager->adresse = $ligne['adresse'];
			$usager->tel_fixe = $ligne['tel_fixe'];
			$usager->tel_mobile = $ligne['tel_mobile'];
			$usager->email=$ligne['email'];
			$usager->url_site = $ligne['url_site'];
			$usager->date_creation = trans_date($ligne['date_creation']);
			$usager->date_derniere_connexion = trans_date_time($ligne['date_derniere_connexion']);
			$usager->nombre_connexions = $ligne['nombre_connexions'];
			$usager->mode_acces = $ligne['mode_acces'];
			$usager->date_debut_acces = $ligne['date_debut_acces'];
			$usager->date_fin_acces = $ligne['date_fin_acces'];
			$usager->login = $ligne['login'];
			$usager->mdp = $ligne['mdp'];

			$les_usagers[] = $usager;
		}
		return $les_usagers;

	}//fin de la fonction

	function get_usagers($pos,$nb, $profil, $mot_cle="") {
			
		$mot_cle = to_sql($mot_cle);
			
		$sql="SELECT id_usager, civilite, nom, prenom, adresse, tel_fixe, tel_mobile,
		   				email, url_site, date_creation, date_derniere_connexion, 
						nombre_connexions, mode_acces, date_debut_acces, date_fin_acces,
						login, mdp
				 FROM les_usagers
				 WHERE profil LIKE '%$profil%' and nom LIKE '$mot_cle%'		
			     ORDER BY nom 
		   	     LIMIT $pos, $nb" ; 		   

		$result = $this->executer($sql);
			
		$les_usagers = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			switch($profil) {

				case "app":
					$usager = new Apprenti($ligne['id_usager']);
					break;

				case "ens":
					$usager = new Enseignant($ligne['id_usager']);
					break;

				case "ma":
					$usager= new Maitre_apprentissage($ligne['id_usager']);
					break;

				case "rl":
					$usager = new Representant_legal($ligne['id_usager']);
					break;

				default  :
					$usager = new Usager($ligne['id_usager']);
					break;
			}

			$usager->civilite = $ligne['civilite'];
			$usager->nom = $ligne['nom'];
			$usager->prenom = $ligne['prenom'];
			$usager->adresse = $ligne['adresse'];
			$usager->tel_fixe = $ligne['tel_fixe'];
			$usager->tel_mobile = $ligne['tel_mobile'];
			$usager->email=$ligne['email'];
			$usager->url_site = $ligne['url_site'];
			$usager->date_creation = trans_date($ligne['date_creation']);
			$usager->date_derniere_connexion = trans_date_time($ligne['date_derniere_connexion']);
			$usager->nombre_connexions = $ligne['nombre_connexions'];
			$usager->mode_acces = $ligne['mode_acces'];
			$usager->date_debut_acces = $ligne['date_debut_acces'];
			$usager->date_fin_acces = $ligne['date_fin_acces'];
			$usager->login = $ligne['login'];
			$usager->mdp = $ligne['mdp'];

			$les_usagers[] = $usager;
		}
		return $les_usagers;

	}//fin de la fonction

	/*
	 Cette fonction supprime tous les usagers de profil $profil et ayant un nom commence par $mot_cle
	 app : les apprentis.
	 ens : les enseignants.
	 ma  : les maitres d'apprentissages.
	 rl  : les représentant légaux (parents).
	 rvs : les responsable vies scoalire.
	 */

	function delete_all_usagers ($profil, $mot_cle="") {

		$sql = "SELECT id_usager
				FROM les_usagers			   
			    WHERE profil like '%$profil%' and nom LIKE '%$mot_cle%'";

		$result = $this->executer($sql);
		while ($ligne = mysql_fetch_assoc($result)) {
			$usager = new Usager($ligne['id_usager']);
			$usager->delete_usager();
		}
	}


	/*
	 Cette fonction renvoit un tableau contenant la liste de tous les apprentis non affectés 
	 */

	function get_apprentis_non_affectes($pos=0,$nb=100000, $mot_cle="") {
			
		$sql="SELECT id_usager, civilite, nom, prenom, adresse, tel_fixe, tel_mobile,
		   				email, url_site, date_creation, date_derniere_connexion, 
						nombre_connexions, mode_acces, date_debut_acces, date_fin_acces,
						login, mdp
				 FROM les_usagers U , les_apprentis A
				 WHERE U.id_usager= A.id_app and profil LIKE '%app%' and  id_cla=0 and  nom LIKE '%$mot_cle%'		
			     ORDER BY U.nom 
		   	     LIMIT $pos, $nb" ; 		   

		$result = $this->executer($sql);
			
		$les_usagers = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$usager = new Apprenti($ligne['id_usager']);
			$usager->civilite = $ligne['civilite'];
			$usager->nom = $ligne['nom'];
			$usager->prenom = $ligne['prenom'];
			$usager->adresse = $ligne['adresse'];
			$usager->tel_fixe = $ligne['tel_fixe'];
			$usager->tel_mobile = $ligne['tel_mobile'];
			$usager->email=$ligne['email'];
			$usager->url_site = $ligne['url_site'];
			$usager->date_creation = trans_date($ligne['date_creation']);
			$usager->date_derniere_connexion = trans_date_time($ligne['date_derniere_connexion']);
			$usager->nombre_connexions = $ligne['nombre_connexions'];
			$usager->mode_acces = $ligne['mode_acces'];
			$usager->date_debut_acces = $ligne['date_debut_acces'];
			$usager->date_fin_acces = $ligne['date_fin_acces'];

			$les_usagers[] = $usager;
		}
		return $les_usagers;

	}//fin de la fonction

	/* Cette fonction renvoit le nombre d'unsager de profils $profil et ayant un nom commence
	 par le mot clé $mot*/ 

	function get_nb_usagers($profil,$mot_cle="") {

		$sql="SELECT COUNT(id_usager) nb
			   FROM les_usagers 
			   WHERE profil LIKE '%$profil%' and nom LIKE '%$mot_cle%'";

		$result = $this->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne["nb"];
		}
		else return 0;
	}

	/* Cette fonction renvoit un tableau contenant toutes les entreprises ayant un
	 nom qui comence par $mot_cle.
	 On récupère un nombre $nb d'entreprise à partir de la position de debut $pos 
	 */

	function get_entreprises($pos=0,$nb=10000, $mot_cle="") {

		$sql="SELECT id_entr, nom, adresse, code_postal, ville, tel_fixe1, tel_fixe2, fax, email, url_site, secteur_activite,
		 			  nom_contact, prenom_contact, nb_salaries, nb_apprentis		 
			   FROM les_entreprises
			   WHERE nom LIKE '$mot_cle%'
			   ORDER BY nom
			   LIMIT $pos, $nb";

		$result = $this->executer($sql);
			
		$les_entreprises=array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$entreprise = new Entreprise($ligne['id_entr']);
			$entreprise->nom = $ligne['nom'];
			$entreprise->adresse = $ligne['adresse'];
			$entreprise->code_postal = $ligne['code_postal'];
			$entreprise->ville = $ligne['ville'];
			$entreprise->tel_fixe1 = $ligne['tel_fixe1'];
			$entreprise->tel_fixe2 = $ligne['tel_fixe2'];
			$entreprise->fax = $ligne['fax'];
			$entreprise->email= $ligne['email'];
			$entreprise->url_site = $ligne['url_site'];
			$entreprise->secteur_activite = $ligne['secteur_activite'];
			$entreprise->nom_contact = $ligne['nom_contact'];
			$entreprise->prenom_contact = $ligne['prenom_contact'];
			$entreprise->nb_salaries = $ligne['nb_salaries'];
			$entreprise->nb_apprentis = $ligne['nb_apprentis'];

			$les_entreprises[]=$entreprise;
		}

		return $les_entreprises;
	}

	/* Cette fonction renvoit le nombre d'entreprises ayant un nom commençant par le mot
	 $mot_cle*/

	function get_nb_entreprises($mot_cle="") {

		$sql="SELECT COUNT(id_entr) nb
			  FROM les_entreprises 
   		      WHERE nom LIKE '%$mot_cle%'";

		$result = $this->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne["nb"];
		}
		else return 0;
	}

	/*
	 Cette fonction permet de supprimer toutes les entreprises ayant un nom commence par le mot cle $mot_cle
	 */

	function delete_all_entreprises ($mot_cle="") {

		$sql="DELETE FROM les_entreprises
			  WHERE  nom LIKE '$mot_cle%'";

		$result = $this->executer($sql);

	}


	/* Cette fonction renvoit un tableau contenant tous les identifiants des formations
	 existantes
	 */
	function get_id_formations() {

		$sql="SELECT  id_for
			   FROM les_formations
			   WHERE id_for > 0
			   ORDER BY nom";

		$result = $this->executer($sql);
		$les_id_formations = array();
		while ($ligne = mysql_fetch_assoc($result)) {
			$les_id_formations[] = $ligne['id_for'];
		}
		return $les_id_formations;
	}


	/* Cette fonction renvoit un tableau contenant toutes les classes enregistrées
	 */

	function get_classes() {

		$sql="SELECT  id_cla, libelle
			   FROM les_classes
			   ORDER BY libelle";

		$result = $this->executer($sql);
			
		$les_classes = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$classe = new Classe($ligne['id_cla']);
			$classe->libelle = $ligne['libelle'];
			$les_classes[] = $classe;

		}
			
		return $les_classes;
	}

	/* Cette fonction renvoit un tableau contenant toutes les formations enregistrées
	 */

	function get_formations() {

		$sql="SELECT  id_for, nom
			   FROM les_formations
			   ORDER BY nom";

		$result = $this->executer($sql);
			
		$les_formations = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$formation = new Formation($ligne['id_for']);
			$formation->nom = $ligne['nom'];
			$les_formations[] = $formation;

		}
			
		return $les_formations;
	}



	/*
	 Cette fonction renvoit un tableau contenant toutes les unités pédagogiques du CFA	
	 */

	function get_all_unites_pedagogiques() {

		$sql="SELECT id_unite, nom, adresse, tel_fixe1, tel_fixe2, fax, email, url_site,
		 			  nom_contact, prenom_contact
			   FROM les_unites_pedagogiques
			   ORDER BY nom";

		$result = $this->executer($sql);
		$les_unites = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$unite = new Unite_pedagogique($ligne['id_unite']);
			$unite->nom = $ligne['nom'];
			$unite->adresse = $ligne['adresse'];
			$unite->tel_fixe1 = $ligne['tel_fixe1'];
			$unite->tel_fixe2 = $ligne['tel_fixe2'];
			$unite->fax = $ligne['fax'];
			$unite->email = $ligne['email'];
			$unite->url_site = $ligne['url_site'];
			$unite->nom_contact = $ligne['nom_contact'];
			$unite->prenom_contact = $ligne['prenom_contact'];

			$les_unites[] = $unite;
		}
		return $les_unites;
	}

	/*
	 Cette fonction renvoit un tableau contenant la liste des options des options lea
	 les  options sont:

	 - SRC_BACHGOUND_HEAD : nom de l'image de fond de l'entéte LEA
	 - SRC_LOGO_CFA       : nom du de l'image représentant le logo cfa

	 */

	function get_options() {

		$sql="SELECT nom, valeur
			   FROM les_options";

		$result = $this->executer($sql);
		$les_options = array();
		while ($ligne = mysql_fetch_assoc($result)) {
			$nom = $ligne['nom'];
			$valeur = $ligne['valeur'];
			$les_options[$nom] = $valeur;
		}
		return $les_options;
	}

	/*
	 Cette fonction met à jour l'option 	du nom $nom et de valeur $valeur	
	 */

	function update_option($nom, $valeur) {

		$sql= "UPDATE les_options
			   SET valeur = '$valeur'
			   WHERE nom = '$nom'";  

		$result = $this->executer($sql);

	}

	/*
	 Cette fonction renvot 1 si l'usager d'identifiant $id_usager est concerné par  l'espace d'identifiant
	 $id_espace

	 */

	function consulte_espace($id_acteur, $id_espace) {

		$sql= "SELECT id_acteur
			   FROM acteurs_espace
			   WHERE id_espace='$id_espace' and id_acteur='$id_acteur'";


		$result = $this->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {
			return 1;
		}
		else return 0;
			
	}


}// fin de la classe
?>
