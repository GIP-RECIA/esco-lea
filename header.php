<?php 

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");

$config_term = new Terminologie();
$config_term->set_detail();
?>	

<!--[if lte IE 7]>
	<style type="text/css">
		.dock
		{
			left:-180px;
		}
	</style>
<![endif]-->


		<?php
$bdd = new Connexion_BDD_LEA();
$atok=$_SESSION['atok'];
$prof=$bdd->getprofil($_SESSION['id_'.$atok]);
$droitAdminCAS = $_SESSION['droitAdminCAS'];
if ($droitAdminCAS && !stristr($prof, "admin")) {
	$prof = $prof.",admin";
}

if 		(file_exists("../../reconnect.php"))  $link="../../reconnect.php";
elseif	(file_exists("../reconnect.php")) 	  $link="../reconnect.php";
elseif	(file_exists("./reconnect.php"))      $link="./reconnect.php";
if 		(file_exists("../../dock/admin.png"))  $linkdir="../../dock";
elseif	(file_exists("../dock/admin.png")) 	  $linkdir="../dock";
			$_SESSION['profil']=$prof;

echo '<script type="text/javascript" src="'.$LEA_URL.'javascript/mootools.js"></script>
<link href="'.$linkdir.'/dock.css" rel="stylesheet" type="text/css">';

?>

<div id="date">        
	<span id="profils">
<?php
if (ereg(",", $prof))
{
	if(ereg("admin",$prof)) 
		echo '<a href="'.$link.'?tok=admin" class="profil_admin"><img src="'.$linkdir.'/admin.png" title="'.$config_term->terminologie_admin.'" alt="admin" /></a>';
	if(ereg("rvs",$prof)) 
		echo '<a href="'.$link.'?tok=rvs" class="profil_rvs"><img src="'.$linkdir.'/rvs.png" title="'.$config_term->terminologie_rvs.'" alt="rvs" /></a>';
	if(ereg("ens",$prof)) 
		echo '<a href="'.$link.'?tok=ens" class="profil_ens"><img src="'.$linkdir.'/ens.png" title="'.$config_term->terminologie_ens.'" alt="ens" /></a>';
	if(ereg("ma",$prof)) 
		echo '<a href="'.$link.'?tok=ma" class="profil_ma"><img src="'.$linkdir.'/ma.png" title="'.$config_term->terminologie_ma.'" alt="ma" /></a>';
	if(ereg("app",$prof)) 
		echo '<a href="'.$link.'?tok=app" class="profil_app"><img src="'.$linkdir.'/app.png" title="'.$config_term->terminologie_app.'" alt="app" /></a>';
	if(ereg("rl",$prof)) 
		echo '<a href="'.$link.'?tok=rl" class="profil_rl"><img src="'.$linkdir.'/rl.png" title="'.$config_term->terminologie_rl.'" alt="rl" /></a>';
	if(ereg("sr",$prof)) 
		echo '<a href="'.$link.'?tok=sr" class="profil_sr"><img src="'.$linkdir.'/sr.png" title="Conception du Livret" alt="sr" /></a>';
	echo '<script type="text/javascript" src="'.$LEA_URL.'javascript/dock.js"></script>';
}
?>
	</span>

	<span>
		<script type="text/javascript">
			var MonthsList = new Array("Mois_Vide", "Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");
			Today = new Date;
			Jour = Today.getDate();
			Mois = Today.getMonth()+1;
			Annee = Today.getFullYear();
			Message = Jour + " " + MonthsList[Mois] + " " + Annee;
			document.write(Message);
		</script>
	</span>
<?php 
	$url = $_SERVER['SERVER_NAME'];
	if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
		$url .= ":". $_SERVER['SERVER_PORT'];
	}
	$protocol = "http://";
	
	$url = $protocol.$url.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
?>

	<br/>
	<span>
		<a href="<?php echo($url.'&imprimer=1');?>" target="_blank" > 
			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_print.gif');?>" border="0">
			Version imprimable
		</a>
	</span>
</div>
<?php
	require_once($LEA_REP.'modele/bdd/classe_usager.php');
	
	if (isset($_SESSION['id_ens'])){
		$id_usager=$_SESSION['id_ens'];
	}	
	elseif (isset($_SESSION['id_app'])) {
		$id_usager=$_SESSION['id_app'];
	
	}	 
	elseif (isset($_SESSION['id_ma'])){
		$id_usager=$_SESSION['id_ma'];
	
	}	 
	elseif (isset($_SESSION['id_rl'])) {
		$id_usager=$_SESSION['id_rl'];
	
	}
	elseif (isset($_SESSION['id_rvs'])) {
		$id_usager=$_SESSION['id_rvs'];
	
	}	 		 
	elseif (isset($_SESSION['id_admin'])) {
		$id_usager=$_SESSION['id_admin'];
	}
	else exit();	 
	
	$usager = new Usager($id_usager);
	$usager->set_detail();
	
	$chaine = date('[d/m/y H:i:s]') . ' ' .$_SERVER['PHP_SELF']  . ' | acces'."\n";
	foreach($_POST as $cle => $valeur)
		$chaine .= date('[d/m/y H:i:s]') . ' ' . $_SERVER['PHP_SELF']  . ' | ' . $cle . ' => ' . $valeur . "\n";

	foreach ($_GET as $cle => $valeur)
		$chaine .= date('[d/m/y H:i:s]') . ' ' . $_SERVER['PHP_SELF']  . ' | ' . $cle . ' => ' . $valeur . "\n";
		
	$usager->update_log($chaine);
?>