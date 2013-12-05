<?php
session_cache_expire(60);
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
include($LEA_REP.'espace_de_partage/aide.php');

$config_term = new Terminologie();
$config_term->set_detail();
$id_for = $_SESSION['id_for'];
$formation = new Formation($id_for);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
$bdd=new Connexion_BDD_LEA();
$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
$res=$bdd->executer($sql);
if(mysql_num_rows($res)==1){
$suivi="false";
}else{
$suivi="true";
}
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<!-- InstanceBegin template="/Templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
<!-- InstanceBeginEditable name="doctitle" -->
		<title>LEA: Configurer les suivis</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "Meta" -->
		<meta name="keywords" content="" />
		<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>"  />
<link rel="stylesheet" type="text/css" media="screen" href="

<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>" />

<link href="schema_apprenti.css" rel="stylesheet" type="text/css" media="screen" />
<?php 
	if(isset($_REQUEST['imprimer'])) {
		echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
		echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
	}
?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
	</head>
	<body>
		<div id="box2" style="display:none">
			<?php include($LEA_REP.'Enseignant/sel_formation.php'); ?>
		</div>

		<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
			<?php include($LEA_REP.'menu_enseignant.php'); ?>
			<div id="aide_43" class="boxaide" style="display:none"><?php echo afficher_aide(43); ?></div>			
			<div id="aide_44" class="boxaide" style="display:none"><?php echo afficher_aide(44); ?></div>

			<div id="contenu">
    			<div id="contents">	
<!-- InstanceBeginEditable name="sous_menu" -->
					<div id="top_l"></div><div id="top_m"><h1><span class="orange">C</span>onfigurer les suivis</h1></div><div id="top_r"></div>
					<div id="m_contenu">
					<div id="texte">              
		           		 <ul class="menuConfig">
		            	<?php  if($suivi!="false"){   ?> 
			            	<li class="configSuivi"> 
			            		<a href="options.php?cmd=suivi_entr"> Configurer : <?php echo $config_lea->appelation_suivi_entr; ?> </a> 
			            		<a href="#" onclick="lightbox('aide_43', '<?php echo $LEA_URL?>')"> <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /> </a> 
		            		</li> 
		            	<?php  }  ?>
	      					<li class="configSuivi"> 
	      						<a href="options.php?cmd=suivi_cfa"> Configurer : <?php echo $config_lea->appelation_suivi_cfa; ?> </a> 
    	  						<a href="#" onclick="lightbox('aide_44', '<?php echo $LEA_URL?>')"> <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /> </a> 
      						</li>						
	      					<li class="configExport"> 
	      						<a href="options.php?cmd=exporter"> Exporter un arbre pour le suivi guid&eacute; </a>
      						</li>						
       					</ul>
		       		</div></div>
<!-- InstanceEndEditable --> 
				</div>
				<div id="bottom_box"> </div>   
			</div>	
			<?php include($LEA_REP."footer.php")?>
		</div>
	</body>
<!-- InstanceEnd -->
</html> 
