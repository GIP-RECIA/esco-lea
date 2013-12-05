<?php	
		// Fichier de configuration LEA 	 	
		$LEA_URL = "<lea-url>";      	
		$LEA_REP = "<lea-rep>";  		
		// Gestion de la connexion a la base de donnees \r\n 
		$BDD["hostname"]= "<bd-hostname>"; 
		$BDD["database"]= "<bd-database>";  
		$BDD["username"]= "<bd-username>";  
		$BDD["password"]= "<bd-password>";  
	
		$PLAGE = 10; // le nombre de lignes de resultat a afficher par page 
		
		//$SRC_DOCUMENTS_DECLARES = "/home/applisdata/lea/lea0451583b/Docs_declares/";  
		$SRC_DOCUMENTS_DECLARES = $LEA_REP."Apprenti/Docs_declares/";  
		$URL_DOCUMENTS_DECLARES = $LEA_URL."Apprenti/Docs_declares/";  
		
		$SRC_IMAGES = $LEA_REP."images/"; 
		$URL_IMAGES = $LEA_URL."images/"; 
		
		$SRC_THEME = (isset($_SESSION["options_lea"]["LEA_THEME"]))? $LEA_REP."themes/".$_SESSION["options_lea"]["LEA_THEME"]."/" 
															   : $LEA_REP."themes/cub_default/"; 
															   
		$URL_THEME = (isset($_SESSION["options_lea"]["LEA_THEME"]))? $LEA_URL."themes/".$_SESSION["options_lea"]["LEA_THEME"]."/" 
														   	   : $LEA_URL."themes/cub_default/";
		// Connexion au serveur CAS
		$AUTHENTIFICATION_CAS = true;
		$SERVEUR_CAS_HOSTNAME = "<cas-hostname>";
		$SERVEUR_CAS_PORT = <cas-port>;
		$SERVEUR_CAS_URI = "<cas-uri>";
		
		// Access LDAP
		$LDAP_HOSTNAME = "<ldap-hostname>";
		$LDAP_PORT = "<ldap-port>";
		$LDAP_DN = "<ldap-dn>";
		$LDAP_DN_PWD = "Iwf18_zYey";
        
		// Activation de l'import LDAP
		$LDAP_IMPORT = false;
		
		// Rne de l'etablissement
		$RNE_ETAB = "<rne-etab>";
		
		// Rne des antennes
		$RNE_ANTENNES = array( "<rne-antenne-1>", "<rne-antenne-2>" );

		$RACINE_GROUPE_ADMIN="<racine-groupe-admin>";
	?>
