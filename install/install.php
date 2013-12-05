<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 03/11/06
/***********************************************************/
include('form_install.php');
include('../version.php');

if(file_exists("../config/config.inc.php")) {
	include('../config/config.inc.php');
	session_name("LEA_$RNE_ETAB");	
	@session_start(); 
	if (!isset($_SESSION['id_admin'])){ 
		header('Location: '.$LEA_URL);
		exit();
	}
	$_SESSION['maj'] = "oui";
} else {
	session_start();
}

if(isset($_SESSION['form'])) {
	$form = $_SESSION['form'];
} else {
	$form = new Form_install();
	$_SESSION['form'] = $form;
	
	$form->hostname = $BDD["hostname"];
	$form->database = $BDD["database"];
	$form->username = $BDD["username"];
	$form->password = $BDD["password"];

//	$form->login_admin = 
//	$form->mdp_admin =
 
	$form->utilisationCAS = $AUTHENTIFICATION_CAS ? "Oui":"Non";	
	$form->hostnameCAS = $SERVEUR_CAS_HOSTNAME;	
	$form->portCAS = $SERVEUR_CAS_PORT;	
	$form->uriCAS = $SERVEUR_CAS_URI;	

	$form->ldapDn = $LDAP_DN;
	$form->ldapDnPwd = $LDAP_DN_PWD;
	$form->ldapHost = $LDAP_HOSTNAME;
	$form->ldapPort = $LDAP_PORT;
	$form->rne = $RNE_ETAB;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
	<title>Installation LEA</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="../themes/cub_default/commun.css" rel="stylesheet">
	
	<script>
		function afficher() {
			var e = document.getElementById("paramCAS");
			e.style.display="block";
		}
		function masquer() {
			var e = document.getElementById("paramCAS");
			e.style.display="none";
		}
	</script>
	
	</head>
	
	<body>
		<div id="conteneur">
			<div id="header">
				<div id="bandeau">
					<div id="logo"><img src='./bandeau.jpg' /></div>
				</div>
			</div>
			
			<div id="contenu">
				<h2>Installation LEA <?php print $version ?> (<a href="GuideInstallationV2.pdf" target="_blank">Guide</a>)</h2>
				<?php echo("<p style=\"color:red\">".$form->msg_erreur."</p>"); ?>
				<form name="theForm" method="post" action="install_v.php">
					<table border="0" width="80%">
						<tr class="titre">
							<td height="32" colspan="2">Avez vous d&eacute;j&agrave; une base de
							donn&eacute;es pour la plateforme LEA?</td>
						</tr>
						<tr>
							<td><select name="maj" size="1">
								<option value="non" <?php if ($_SESSION['maj'] == "non") print 'selected="selected"' ?>>non</option>
								<option value="oui" <?php if ($_SESSION['maj'] == "oui") print 'selected="selected"' ?>>oui</option>
							</select></td>
						</tr>
						<tr class="titre">
							<td height="32" colspan="2">Base de donn&eacute;es</td>
						</tr>
						<tr>
							<td width="40%" height="25">Serveur</td>
							<td ><input name="hostname" type="text"
								value="<?php echo $form->hostname; ?>"></td>
						</tr>
						<tr>
							<td height="34">base de donn&eacute;es</td>
							<td><input name="database" type="text"
								value="<?php echo $form->database; ?>"></td>
						</tr>
						<tr>
							<td height="27">Login</td>
							<td><input name="username" type="text"
								value="<?php echo $form->username; ?>"></td>
						</tr>
						<tr>
							<td height="24">password</td>
							<td><input type="password" name="password"
								value="<?php echo $form->password; ?>"></td>
						</tr>
						<tr class="titre">
							<td height="31" colspan="2">Administrateur LEA</td>
						</tr>
						<tr>
							<td>login</td>
							<td><input type="text" name="login_admin"
								value="<?php echo $form->login_admin; ?>"></td>
						</tr>
						<tr>
							<td>password</td>
							<td><input type="password" name="mdp_admin"
								value="<?php echo $form->mdp_admin; ?>"></td>
						</tr>
					</table>
					<table border="0" width="80%" style="margin-top: 0px;">
						
						<tr class="titre">
							<td height="31" colspan="2">Single Sign On</td>
						</tr>
						<tr>
							<td width="40%">Utilisez vous un serveur CAS ?</td>
							<td>
								<input type="radio" name="utilisationCAS" value="Oui" <?php if ($form->utilisationCAS =="Oui") echo "checked";?> onclick="afficher()"> Oui
								<input type="radio" name="utilisationCAS" value="Non" <?php if ($form->utilisationCAS =="Non") echo "checked";?> onclick="masquer()">Non
							</td> 						
						</tr>
						
					</table>
					<div id="paramCAS" <?php if ($form->utilisationCAS =="Non") echo "style='display:none'";?> >
						<table border="0" width="80%" style="margin-top: 0px;">
							<tr>
								<td width="40%">CAS Hostname</td>
								<td><input type="text" name="hostnameCAS" value="<?php echo $form->hostnameCAS; ?>"></td>
							</tr>
							<tr>
								<td>CAS Port</td>
								<td><input type="text" name="portCAS" value="<?php echo $form->portCAS; ?>"></td>
							</tr>
							<tr>
								<td>URI</td>
								<td><input type="text" name="uriCAS" value="<?php echo $form->uriCAS; ?>"></td>
							</tr>
			
						</table>
					</div>

					<table border="0" width="80%" style="margin-top: 0px;">
						<tr class="titre">
							<td height="31" colspan="2">RNE</td>
						</tr>

						<tr>
							<td width="40%">Rne de l'établissement</td>
							<td><input type="text" name="RNE" value="<?php echo $form->rne; ?>"></td>
						</tr>
					</table>
					<table border="0" width="80%" style="margin-top: 0px;">
						<tr class="titre">
							<td height="31" colspan="2">LDAP</td>
						</tr>
					
						<tr>
							<td width="40%">LDAP Hostname</td>
							<td><input type="text" name="hostnameLDAP" value="<?php echo $form->ldapHost; ?>"></td>
						</tr>
						<tr>
							<td>LDAP Port</td>
							<td><input type="text" name="portLDAP" value="<?php echo $form->ldapPort; ?>"></td>
						</tr>
						<tr>
							<td>Dn de connexion</td>
							<td><input type="text" name="dnLDAP" value="<?php echo $form->ldapDn; ?>"></td>
						</tr>
						<tr>
							<td>Mot de passe</td>
							<td><input type="password" name="dnLDAPPwd" value="<?php echo $form->ldapDnPwd; ?>"></td>
						</tr>
		
					</table>
					
					<div align="center"><input type="submit" name="Submit" value="Valider"></div>
					
				</form>
			</div>
			<?php include("../footer.php") ?>
		</div>
	</body>
</html>
