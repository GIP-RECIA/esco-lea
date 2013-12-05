<?php
if (!file_exists("./config/config.inc.php")) {
	header("Location:install/install.php");
	exit();
}

require_once("./config/config.inc.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if(!isset($_GET['js'])){
  $url=$LEA_URL."index.php";
  echo '<script type="text/javascript">window.location.href="'.$url.'?js=1";</script>';
  echo '<noscript><meta http-equiv="refresh" content="0; url='.$url.'?js=2"/></noscript>';
} 
if ($AUTHENTIFICATION_CAS) {
	header("Location:authentification.php");
	exit();	
} 
include('version.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>LEA : <?php echo($config_term->terminologie_lea); ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Charles-Ulysse BEILLEVERT" />
<link rel="stylesheet" type="text/css" href="themes/cub_default/login.css"
	media="screen" />
</head>
<body>
<div id="conteneur">
<?php if($_GET['js']=='2') echo 'Javascript est désactivé, veuillez l activer dans les options de votre navigateur<br/>'; ?>
  <div id="logo">
	<table id="version">
	  <tr>
	    <td><?php echo $version ?></td>
	  </tr>
	</table>
  </div>
  <div id="visuel" valign="middle">
    <table id="nomlea">
      <tr>
        <td align="left" valign="middle"><?php echo($config_term->terminologie_lea); ?></td>
      </tr>
    </table>
  </div>
  <div id="zoneform">
    <form id="loginForm" name="login_form" action="authentification.php"
	method="post">
      <label for="the_login">Identifiant :</label>
      <input maxlength="50" size="20" name="the_login" id="the_login" />
      <label for="the_mdp">Mot de passe :</label>
      <input type="password" maxlength="50" size="20" name="the_mdp"
	id="the_mdp" />
      <input class="bouton" type="submit" name="Envoyer" value="Valider" />
    </form>
  </div>
	<?php include("footer.php") ?>
	
</div>
<?php
  if(isset($err_msg)) {
  echo "
<div id='erreur_login'><img src='themes/cub_default/images/default_pictoStop_cub.png' />
".$err_msg."
</div>
";	
  }
?>
</body>
</html>
