<?php
	require_once("./config/config.inc.php");
	require_once('./lib/Cas/CAS.php');
	
	// initialize phpCAS
	phpCAS::client(SAML_VERSION_1_1, $SERVEUR_CAS_HOSTNAME, $SERVEUR_CAS_PORT, $SERVEUR_CAS_URI);
	phpCAS::setLang(PHPCAS_LANG_FRENCH);
	
	// no SSL validation for the CAS server
	phpCAS::setNoCasServerValidation();
	
	// force CAS authentication
	phpCAS::handleLogoutRequests(false);
	$authentificationCAS = phpCAS::forceAuthentication();
	if ($authentificationCAS) {
		
		$attributes = phpCAS::getAttributes();
  		$userCAS = $attributes['login'];  		
  		if (empty($userCAS)) {
  			$userCAS = phpCAS::getUser();
  		}
	    $droitAdminCAS = false;  		
  		if (isset($attributes['isMemberOf'])) {
  			$regex = strtolower("#".$RACINE_GROUPE_ADMIN.".+".$RNE_ETAB."#");
  			
  			foreach ($attributes['isMemberOf'] as $isMemberOf) {
  				if (preg_match($regex, strtolower($isMemberOf))) {
  					$droitAdminCAS = true;
  					break;
  				}
  			}
  		}
	} 
	
?>