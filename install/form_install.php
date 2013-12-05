<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/08/05
/***********************************************************/
class Form_install {
	
	var $hostname = "127.0.0.1";
	var $database = "lea";
	var $username = "root";
	var $password = "" ;
	var $login_admin = "admin";
	var $mdp_admin = "";
	var $utilisationCAS = "Non";
	var $hostnameCAS = "localhost";
	var $portCAS = "8443";
	var $uriCAS = "cas";
	
	var $ldapDn = "";
	var $ldapDnPwd = "";
	var $ldapHost = "";
	var $ldapPort = "389";
	var $rne = "";
	
	var $msg_erreur="";
			
    function Form_install() {
		
    }	
/****************** les methodes ******************************/
	/***
	 * 
	 */
	function testConnexionBDD(){
			
		$this->msg_erreur = "";	
	
		if($this->hostname == "") {
			$this->msg_erreur = "Serveur de base de données est vide ";
			return 0;
		}
		elseif($this->database == "") {
			$this->msg_erreur = "Nom de la base de données est vide ";
			return 0;
		}
		elseif($this->username == "") { 
			$this->msg_erreur = "Le login de connexion à la base de données est vide ";
			return 0;
		}	
		
		$conn = @mysql_connect($this->hostname, $this->username, $this->password);
	
		if (!$conn) {
		
			$this->msg_erreur=" Impossible de se connecter au serveur :" . mysql_error();
			return 0;		
		} elseif (!mysql_select_db($this->database)) {
			$this->msg_erreur= "Impossible d'accéder à la base de données $this->database : " . mysql_error();
			
			// Tentative de creation de la base de donnee 
			$sql = "Create database ".$this->database." ;";
			
			if(mysql_query($sql) ) {
				return 1;
			} else{
				$this->msg_erreur .="<br> Tentative de création de la base de données $this->database a eï¿½choue ";
				return 0;
			}		
		}
		return 1;
	}
	/***
	 * 
	 */
	function testLoginAdmin(){
			
		$this->msg_erreur = "";	
	
		if($this->login_admin == "") {
			$this->msg_erreur = "Le login administrateur est vide ";
			return 0;
		}
		elseif($this->mdp_admin == "") { 
			$this->msg_erreur = "Le mot de passe admin est vide ";
			return 0;
		}				
		return 1;
	}

	/***
	 * 
	 */
	function testConnexionCAS() {
		if ($this->utilisationCAS == "Non") {
			return 1;
		}
		$this->msg_erreur = "";	
		
		if($this->hostnameCAS == "") {
			$this->msg_erreur = "Le hostname du serveur CAS est vide ";
			return 0;
		}
		if($this->portCAS == "") { 
			$this->msg_erreur = "Le port du serveur CAS est vide ";
			return 0;
		}
		if(!is_numeric($this->portCAS)) { 
			$this->msg_erreur = "Le port doit être numérique (".$this->portCAS.")";
			return 0;
		}
		if($this->uriCAS == "") { 
			$this->msg_erreur = "L'uri du serveur CAS est vide ";
			return 0;
		}				

		return 1;
	}
	
	/***
	 * 
	 */
	function testLDAP() {
		$this->msg_erreur = "";	

		if($this->rne == "") {
			$this->msg_erreur = "Le RNE de l'etablissement est vide ";
			return 0;
		}
		
		if($this->ldapDn == "") {
			$this->msg_erreur = "Le Dn de l'utilisateur de connexion au LDAP est vide ";
			return 0;
		}
		if($this->ldapDnPwd == "") { 
			$this->msg_erreur = "Le mot de passe de l'utilisateur de connexion au LDAP est vide ";
			return 0;
		}
		if($this->ldapHost == "") { 
			$this->msg_erreur = "L'adresse du serveur LDAP est vide ";
			return 0;
		}						
		if(!is_numeric($this->ldapPort)) { 
			$this->msg_erreur = "Le port LDAP doit être numérique (".$this->ldapPort.")";
			return 0;
		}

		return 1;
	}
		
}// fin de la classe 
?>