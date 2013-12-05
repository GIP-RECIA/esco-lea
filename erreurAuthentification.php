<?php 
	include_once ("config/config.inc.php"); 
	require_once($LEA_REP."modele/bdd/classe_terminologie.php");
	$config_term = new Terminologie();
	$config_term->set_detail();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="themes/cub_default/login.css" media="screen" />
		
		<title>Authentification LEA</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
	<div id="conteneur">
		  <div id="logo"></div>
				
		  <div id="visuel" valign="middle">
		    <table id="nomlea">
		      <tr>
		        <td align="left" valign="middle"><?php echo($config_term->terminologie_lea); ?></td>
		      </tr>
		    </table>
		  </div>		

		<table width="100%" height="2%" border="0" cellpadding="0" cellspacing="0" >
			<tr align="center">
				<td >
					<br/>
					Le compte <b><?php echo $_GET['login']; ?></b> n'est pas d&eacute;clar&eacute;.<br/>
					Vous ne pouvez donc pas acc&eacute;der &agrave; l'application.<br/><br/>
					<i>Pour obtenir un compte valide, veuillez contacter votre administrateur.</i>
					<br/><br/>
				</td>
			</tr>
		</table>

		</div>
		
	</body>
</html>
