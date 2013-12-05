<?php 
require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();
require_once ($LEA_REP."lib/stdlib.php");
require($LEA_REP.'modele/bdd/classe_usager.php');
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
if (!isset($_SESSION['id_admin'])){
	html_refresh($LEA_URL);
}

$usager = new Usager($_SESSION['id_admin']);
$img_accueil = $usager->get_valeur_attribut("img_accueil"); // l'image de la page d'accueil de l'apprenti
$rep_img = $LEA_REP."images/img_accueil/";

if ($img_accueil=="" || !file_exists ($rep_img.$img_accueil) ) {

	$url_img = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'images/default_imageDefault.png';	
}	
else {
	$url_img = $LEA_URL.'images/img_accueil/'.$img_accueil;	
}  

$bdd = new Connexion_BDD_LEA();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/Templates/Madministrateur.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>				
		<!-- InstanceBeginEditable name="doctitle" -->
		<!-- <title>LEA Administrateur</title> -->
		<title>LEA: gestion des droits</title>
		<!-- InstanceEndEditable -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />		
		<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen"
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"  />
		
		<?php 
			if(isset($_REQUEST['imprimer'])) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
				echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
			}
		?>
		
		<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
		<script type="text/javascript" 
				src="<?php echo($LEA_URL.'javascript/menu.js');?>">
		</script>		
			<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script></head>
	
<body>

	<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
		<?php include($LEA_REP.'menu_administrateur.php'); ?>
		<div id="contenu">
										
    		<div id="contents">
    		<!-- InstanceBeginEditable name="sous_menu" -->
		
			<div id="m_contenu">
			
          <form action='interface_v.php' method='post'>
				
        	
				<p style="text-align:left; margin-left:1.4cm; margin-right:1.4cm; background: #99CCFF;">	Administrateur : <br/></p>
				<p style="text-align:center;background: #FFFFCC">
					<?php
					$sql="SELECT dr_soumis from les_droits where id_droit='admin'";
					$result2=$bdd->executer($sql);
					while($ligne2 = mysql_fetch_assoc($result2)){
					$dr=$ligne2['dr_soumis'];}
					/*if(ereg("admin",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitad[]' type='checkbox' value='admin'".$checked.">administration";*/
					if(ereg("rvs",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitad[]' type='checkbox' value='rvs'".$checked." >secretariat <br/>";
					if(ereg("ens",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitad[]' type='checkbox' value='ens'".$checked." >enseignemant <br/>";
					if(ereg("ma",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitad[]' type='checkbox' value='ma' ".$checked.">apprentissage ";
					?></p>
					<br/><p style="text-align:left; margin-left:1.4cm; margin-right:1.4cm; background: #99CCFF;">secretaire : <br/></p>
					<p style="text-align:center;background: #FFFFCC">
					<?php
					$sql="SELECT dr_soumis from les_droits where id_droit='rvs'";
					$result2=$bdd->executer($sql);
					while($ligne2 = mysql_fetch_assoc($result2)){
					$dr=$ligne2['dr_soumis'];}
					if(ereg("admin",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitrvs[]' type='checkbox' value='admin'".$checked.">administration <br/>";
					if(ereg("rvs",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitrvs[]' type='checkbox' value='rvs'".$checked." >secretariat <br/>";
					if(ereg("ens",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitrvs[]' type='checkbox' value='ens'".$checked." >enseignemant <br/>";
					if(ereg("ma",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitrvs[]' type='checkbox' value='ma' ".$checked.">apprentissage ";
					?></p>
					<br/><p style="text-align:left; margin-left:1.4cm; margin-right:1.4cm; background: #99CCFF;">Enseignant : <br/></p>
					<p style="text-align:center;background: #FFFFCC">
					<?php
					$sql="SELECT dr_soumis from les_droits where id_droit='ens'";
					$result2=$bdd->executer($sql);
					while($ligne2 = mysql_fetch_assoc($result2)){
					$dr=$ligne2['dr_soumis'];}
					if(ereg("admin",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitens[]' type='checkbox' value='admin'".$checked.">administration <br/>";
					if(ereg("rvs",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitens[]' type='checkbox' value='rvs'".$checked." >secretariat <br/>";
					if(ereg("ens",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitens[]' type='checkbox' value='ens'".$checked." >enseignement <br/>";
					if(ereg("ma",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitens[]' type='checkbox' value='ma' ".$checked.">apprentissage ";
					?></p>
					<br/><p style="text-align:left; margin-left:1.4cm; margin-right:1.4cm; background: #99CCFF;">Maitre : <br/></p>
					<p style="text-align:center;background: #FFFFCC">
					<?php
					$sql="SELECT dr_soumis from les_droits where id_droit='ma'";
					$result2=$bdd->executer($sql);
					while($ligne2 = mysql_fetch_assoc($result2)){
					$dr=$ligne2['dr_soumis']; }
					if(ereg("admin",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitma[]' type='checkbox' value='admin'".$checked.">administration <br/>";
					if(ereg("rvs",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitma[]' type='checkbox' value='rvs'".$checked." >secretariat <br/>";
					if(ereg("ens",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitma[]' type='checkbox' value='ens'".$checked." >enseignement <br/>";
					if(ereg("ma",$dr))$checked="checked";
					else $checked="";
					echo"<input name='droitma[]' type='checkbox' value='ma' ".$checked.">apprentissage ";
					?></p>
			<p style="text-align:center;background: #99FFCC;">
		<br/>
      		<input type="submit" name="Submit" value="Valider"><br/><br/></p>
				
				
			</div>

			
			<!-- InstanceEndEditable -->
			</div>
					  <div id="bottom_box"> </div>   
		</div>	
				
			<?php include($LEA_REP."footer.php")?>					
		
	</div>
</body>
<!-- InstanceEnd --></html>