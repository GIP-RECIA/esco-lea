<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include('form_install.php');

	if(file_exists("../config/config.inc.php")) require_once("../config/config.inc.php");
	session_name("LEA_$RNE_ETAB");
	session_start();
	$_SESSION['maj'] = $_POST['maj']; 

	$form = new Form_install();
	
	$form->hostname = $_REQUEST['hostname'];
	$form->database = $_REQUEST['database'];
	$form->username = $_REQUEST['username'];
	$form->password = $_REQUEST['password'];
	$form->login_admin = $_REQUEST['login_admin'];
	$form->mdp_admin = $_REQUEST['mdp_admin'];
	$form->utilisationCAS = $_REQUEST['utilisationCAS'];	
	$form->hostnameCAS = $_REQUEST['hostnameCAS'];	
	$form->portCAS = $_REQUEST['portCAS'];	
	$form->uriCAS = $_REQUEST['uriCAS'];	

	$form->ldapDn = $_REQUEST['dnLDAP'];
	$form->ldapDnPwd = $_REQUEST['dnLDAPPwd'];
	$form->ldapHost = $_REQUEST['hostnameLDAP'];
	$form->ldapPort = $_REQUEST['portLDAP'];
	$form->rne = $_REQUEST['RNE'];
	
	$lea_rep = str_replace ( "\\", "/", realpath(".."));
	$lea_rep.="/";
	
	$url = $_SERVER['SERVER_NAME'];
	
		if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
			$url .= ":". $_SERVER['SERVER_PORT'];
		}
		$protocol = "http://"; 
		
		$root = $protocol.$url.dirname($_SERVER['PHP_SELF']);
		$root = str_replace("install","",$root);
		
	$lea_url = $root;
	
	$_SESSION['form'] = $form;

	if(file_exists("../config/config.inc.php") && $_POST['maj'] == "non"){
		die('LEA est d&eacute;ja install&eacute; sur le serveur');
	}
	
		
	//Creation de la base de donnees
	if(!$form->testConnexionBDD() || !$form->testLoginAdmin() || !$form->testConnexionCAS() || !$form->testLDAP() ) {		 
		 header("Location:install.php");
		 exit();
	}		 
	$file = fopen("../config/config.inc.php","w");

	$txt = '<?php	
		// Fichier de configuration LEA 	 	
		$LEA_URL = "'.$lea_url.'";      	
		$LEA_REP = "'.$lea_rep.'";  		
		// Gestion de la connexion a la base de donnees \r\n 
		$BDD["hostname"]= "'.$form->hostname.'"; 
		$BDD["database"]= "'.$form->database.'";  
		$BDD["username"]= "'.$form->username.'";  
		$BDD["password"]= "'.$form->password.'";  
	
		$PLAGE = 10; // le nombre de lignes de resultat a afficher par page 
		
		$SRC_DOCUMENTS_DECLARES = $LEA_REP."Apprenti/Docs_declares/";  
		$URL_DOCUMENTS_DECLARES = $LEA_URL."Apprenti/Docs_declares/";  
		
		$SRC_IMAGES = $LEA_REP."images/"; 
		$URL_IMAGES = $LEA_URL."images/"; 
		
		$SRC_THEME = (isset($_SESSION["options_lea"]["LEA_THEME"]))? $LEA_REP."themes/".$_SESSION["options_lea"]["LEA_THEME"]."/" 
															   : $LEA_REP."themes/cub_default/"; 
															   
		$URL_THEME = (isset($_SESSION["options_lea"]["LEA_THEME"]))? $LEA_URL."themes/".$_SESSION["options_lea"]["LEA_THEME"]."/" 
														   	   : $LEA_URL."themes/cub_default/";
		// Connexion au serveur CAS
		$AUTHENTIFICATION_CAS = '.($form->utilisationCAS=="Oui"?"true":"false").';
		$SERVEUR_CAS_HOSTNAME = "'.$form->hostnameCAS.'";
		$SERVEUR_CAS_PORT = '.(empty($form->portCAS)?0:$form->portCAS).';
		$SERVEUR_CAS_URI = "'.$form->uriCAS.'";
		
		// Access LDAP
		$LDAP_HOSTNAME = "'.$form->ldapHost.'";
		$LDAP_PORT = "'.$form->ldapPort.'";
		$LDAP_DN = "'.$form->ldapDn.'";
		$LDAP_DN_PWD = "'.$form->ldapDnPwd.'";

    // Activation de l\'import LDAP
    $LDAP_IMPORT = false;
		
		// Rne de l\'etablissement
		$RNE_ETAB = "'.$form->rne.'";

    // Rne des antennes
    $RNE_ANTENNES = array( );

		$RACINE_GROUPE_ADMIN="esco:admin:LEA:local:";
	?>';														   															  
	fwrite($file, $txt);

	fclose($file);
	/* Creation des tables */
	require_once("../config/config.inc.php");

	
	echo "Installation dans le dossier ".$LEA_REP."<br/>\r\n";
	
	require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
	require_once($LEA_REP."modele/bdd/classe_usager.php");
	
	$bdd = new Connexion_BDD_LEA();
	
	$file_sql2_0 =  file_get_contents("lea2_0.sql");
	$file_sqlM1_0 =  file_get_contents("leaM1_0.sql");
	$file_sql3_0 =  file_get_contents("lea3.sql");
	  
	if($file_sql2_0 === false || $file_sql3_0 === false || $file_sqlM1_0 === false){
		die('Fichier erron&eacute; ');
	}
	  
	$requetes3_0 = explode(';', $file_sql3_0);  
	$requetesM1_0 = explode(';', $file_sqlM1_0);  
	
	$cpt = 0; // Nombre de tables 
	if($_POST['maj'] == "non"){  
		foreach($requetes3_0 as $requete){
			if(trim($requete)!="") {
				$bdd->executer($requete.';', 0); 
				if( strpos ($requete, "CREATE") ){
				$cpt++;				
				}				 
			}			
	  	}
	 	$usager = new Usager(0);
	 	$usager->nom ="admin";
	 	$usager->prenom ="admin";
	 	$usager->profil ="admin";
	 	$usager->login = $form->login_admin;
	 	$usager->mdp = $form->mdp_admin;
		$usager->mode_acces=2;
	 	$usager->insert();
	} elseif($_POST['maj'] == "oui"){  
		foreach($requetesM1_0 as $requete){
			if(trim($requete)!="") {
				$bdd->executer($requete.';', 0); 
				if( strpos ($requete, "CREATE") ){
				$cpt++;				
				}				 
			}			
	  	}
	}
	unset ($_SESSION['form']);
?>
L'installation a bien r&eacute;ussi <br>

Veuillez-vous connecter au LEA <br> 
<form action="../authentification.php" method="post">
	<input type="hidden" name="the_login" value="<?php echo"$usager->login" ?>">
	<input type="hidden" name="the_mdp" value="<?php echo"$usager->mdp" ?>">
	<input type="submit" name="submit" value="Connexion">
</form>
