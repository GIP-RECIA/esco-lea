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
if (file_exists("../config/config.inc.php")) require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

if(isset($_SESSION['form'])) 
	 $form = $_SESSION['form'];	 
else $form = new Form_install();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Installation LEA</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="install.css" rel="stylesheet" >

</head>

<body>
<div id="conteneur">
   <div id="header">
	<div id="bandeau" >

	<div id="logo">  	
		<img src="img/logo.gif"  height="120" alt=" Logo " />	
	</div>

	</div>		
 </div>

  <div id="contenu">  
	<h1>Installation LEA</h1>

	<?php 	
		echo("<p style=\"color:red\">".$form->msg_erreur."</p>");	
	?>
	
	<form name="theForm" method="post" action="install.php">
	<table border="0" width="80%">
  			<tr class="titre">
  			  <td height="32" colspan="2">Base de donn&eacute;es</td>
  			 
	    </tr>
  			<tr>
   				 <td width="31%" height="32">Serveur</td>
   				 <td width="69%"><input name="hostname" type="text" value="<?php echo($form->hostname) ?>" ></td>
			</tr>
  			<tr>
  			  <td height="42">base de donn&eacute;es</td>
  			  <td><input name="database" type="text" value="<?php echo($form->database) ?>"></td>
	    </tr>
  			<tr>
  			  <td height="42">Login </td>
  			  <td><input name="username" type="text" value="<?php echo($form->username) ?>"></td>
	    </tr>
  			<tr>
  			  <td height="33">password</td>
  			  <td><input type="password" name="password" value="<?php echo($form->password) ?>"></td>
	    </tr>
  			<tr class="titre">
  			  <td height="31" colspan="2">Administrateur LEA</td>
  			  
	    </tr>
  			<tr>
  			  <td>login</td>
  			  <td><input type="text" name="login_admin" value="<?php echo($form->login_admin) ?>"></td>
	    </tr>
  			<tr>
  			  <td>password</td>
  			  <td><input type="password" name="mdp_admin" value="<?php echo($form->mdp_admin) ?>"></td>
	    </tr>
  			<tr>
  			  <td height="55">&nbsp;</td>
  			  <td><input type="submit" name="Submit" value="Valider"></td>
	    </tr>
	</table>
	</form>
  </div>
  <br>
  <div id="footer">
  <br>
  Issu du programme de recherche <acronym title="Livret &Eacute;lectronique d'Apprentissage">LEA</acronym>,
   men&eacute; par <a href="http://www-lium.univ-lemans.fr"> <acronym title="Laboratoire d'informatique de l'universit&eacute; de Maine">LUIM</acronym> 
   (Laboratoire d'informatique de l'universit&eacute; de Maine)</a> en collaboration avec le <a href="http://www.cfa3villes.com"><acronym title="Centre de Formation et d'Apprentissage">CFA</acronym> des 3 Villes de la Mayenne</a>.	Application con&ccedil;ue dans le cadre du projet de recherche <acronym title="Livret &Eacute;lectronique d'Apprentissage">LEA</acronym>, 
   subventionn&eacute; par le Minist&egrave;re de la recherche, Direction de la technologie. ANR.
  </div>
  
</div>



</body>
</html>
