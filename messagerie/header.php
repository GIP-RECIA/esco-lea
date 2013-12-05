<?php
include_once("secure.php");

if (file_exists("../../config/config.inc.php"))  
	require_once("../../config/config.inc.php");
elseif (file_exists("../config/config.inc.php")) 	  
	require_once("../config/config.inc.php");
elseif (file_exists("./config/config.inc.php"))      
	require_once("./config/config.inc.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_list_message.php");
/***********************************************************/

if (isset($_SESSION['id_for']) && isset($_SESSION['id_ens']))
{
        $id_usager = $_SESSION['id_ens'];
        $profil = "ens";
        $menu = "menu_enseignant.php";
        $href_det_msg="../../Enseignant/Contact/contact.php";
        $sel_formation=$LEA_REP.'Enseignant/sel_formation.php';
}
elseif (isset($_SESSION['id_admin']))
{
        $id_usager = $_SESSION['id_admin'];
        $profil = "admin";
        $menu = "menu_administrateur.php";
        $href_det_msg="../../administrateur/contact/contact.php";
}
elseif (isset($_SESSION['id_ens']))
{
	$id_usager = $_SESSION['id_ens'];
	$profil = "ens";
	$menu = "menu_enseignant.php";
	$href_det_msg="../../Enseignant/Contact/contact.php";
	$sel_formation=$LEA_REP.'Enseignant/sel_formation.php';
}	
elseif (isset($_SESSION['id_app'])) 
{
	$id_usager = $_SESSION['id_app'];
	$profil = "app";
	$menu = "menu_apprenti.php";
	$href_det_msg="../../Apprenti/Contact/contact.php";
}	 
elseif (isset($_SESSION['id_ma']))
{
	$id_usager = $_SESSION['id_ma'];
	$profil = "ma";
	$menu = "menu_maitre_apprentissage.php";
	$href_det_msg="../../Maitre_apprentissage/Contact/contact.php";
}	 
elseif (isset($_SESSION['id_rl'])) 
{
	$id_usager = $_SESSION['id_rl'];
	$profil = "rl";
	$menu = "menu_representant_legal.php";
	$href_det_msg="../../Representant_legal/Contact/contact.php";
}
elseif (isset($_SESSION['id_rvs'])) 
{
	$id_usager = $_SESSION['id_rvs'];
	$profil = "rvs";
	$menu = "menu_responsable_vie_scolaire.php";
	$href_det_msg="../../Responsable_vie_scolaire/Contact/contact.php";
}	 		 
else html_refresh($LEA_URL);

$liste = new ListeMessage($id_usager);
$messages = $liste->getListeMessageRempli();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Madministrateur.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>				
		<!-- InstanceBeginEditable name="doctitle" -->
		<!-- <title>LEA Administrateur</title> -->
		<title>LEA: Messagerie LEA</title>
		<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />
		<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"/>
		<?php 
			if(isset($_REQUEST['imprimer'])) 
			{
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?>
		
		<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js');?>"></script>	
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
		<script type="text/javascript" src="script/ajouterContact.js"></script>
		<script type="text/javascript" src="script/libMessagerie.js"></script>
		
		<style type="text/css">
			a img
			{
				border:none;
			}
		
			#contenu table
			{
				margin-top:10px;
			}
		
			.boutonMessagerie 
			{
				margin-top:10px;
			}
		
			.boutonMessagerie a
			{
				margin:0 0 0 15px;
				font-size:14px;
				padding:10px 10px 10px 30px;
				background-repeat:no-repeat !important;
				background-position:1px !important;
			}
			
			table td
			{
				margin:0 !important;
				padding:0 0.4em !important;
			}
			
			table td input
			{
				margin:0;
				padding:0;
			}
			
			#cible
			{
				width:110px;
			}
			
			.check {width:5px !important;}
			.blanc {width:15px !important; text-align:center !important}
			.dossier {width:100px !important;}
			.dossier a
			{
				background-image:url("images/archive.jpg");
				background-repeat:no-repeat;
				padding-left:20px;
			}
			.exp {width:230px !important;}
			.objet {width:240px !important;}
			.date {width:120px !important;}
			
			.fond_dossier {background-color:#fff9f4;}
			.normal {background-color:#FFFFFF;}
			.non-lu {background-color:#cae0ff;}
			.non-lu td {font-weight:bold;}
			.rep {background-color:#fffbd7;}
			.rep td {font-style:italic;}
			
			.date {font-style:normal !important; font-weight:normal !important;}
			
			.exp a, .objet a {color:#0062ad !important;}
			.exp a:hover, .objet a:hover {color:#0096ff !important;}
			
			.labelEnvoi
			{
				display:block; 
				float:left; 
				width:100px;
			}
			
			.croixDossier
			{
				cursor:pointer;
				position:relative;
				bottom: 2px;
			}
		</style>
		
		</head>
	
<body>
	<div id="box2" style="display:none">
	<?php if (isset($sel_formation)) include($sel_formation); ?> 
	</div>

	<div  id="<?php  
				if(!isset($_REQUEST['imprimer'])) echo("conteneur");
				else echo('truccontenuimpression'); 
			?>">
		<?php include($LEA_REP.$menu); ?>
		
		<div id="contenu">
										
    		<div id="contents">
				<div id="sousMenu">
					<ul>
						<li>
							<a href="reception.php">Bo&icirc;te de r&eacute;ception</a>
						</li> 
						<li>
							<a href="envoi.php">Bo&icirc;te d'envoi</a>
						</li>
						<li>
							<a href="corbeille.php">Corbeille</a>
						</li>
						<li>
							<a href="dossiers.php">Dossiers</a>
						</li>
					</ul>		
				</div>
				<div id="top_l"></div>
				<div id="top_m">
					<h1>
						<?php
							if (isset($_SESSION['messagerie']))
							{
								switch ($_SESSION['messagerie'])
								{
									case 'envoi':
										echo '<span class="orange">B</span>o&icirc;te d\'envoi';
										break;
									case 'corbeille':
										echo '<span class="orange">C</span>orbeille';
										break;
									case 'dossiers':
										echo '<span class="orange">D</span>ossiers';
										break;
									case 'nouveau':
										echo '<span class="orange">N</span>ouveau message';
										break;
									case 'lecture':
										echo '<span class="orange">L</span>ire un message';
										break;
									default:
										echo '<span class="orange">B</span>o&icirc;te de r&eacute;ception';
										break;
								}
							}
						?>
					</h1>
				</div>
				<div id="top_r"></div>
				<div id="m_contenu">
