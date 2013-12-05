<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 05/10/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_arbre.php");
/***********************************************************/
include("../test_responsable.php");

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

<div id="top_l"></div>
<div id="top_m">
  <h1><span class="orange">C</span>onfiguration</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
  <div id="texte">
    <div id="aide_pdf"></div>
    <ul class="menuConfig">
      <li class="aide"> <a href="<?php echo $LEA_URL.'documents/aide.pdf'; ?>" target="_blank">Aide &agrave; la configuration</a> </li>
      <li class="calendar" > <a href="<?php echo"options.php?cmd=liste_periodes"?>"> P&eacute;riodes et calendrier</a> <a href="#" onclick="lightbox('aide_42', '<?php echo $LEA_URL?>')"> <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /> </a> </li>
      <li class="configSuivi"> <a href="configurelessuivis.php"> Configurer : les suivis </a> <a href="#" onclick="lightbox('aide_44', '<?php echo $LEA_URL?>')"> <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /> </a> </li>
      <li class="miseAJour"> <a href="options.php?cmd=modifier_liste_enseignants"> Composition de la liste: <?php echo $config_lea->appelation_ens ?> </a> <a href="#" onclick="lightbox('aide_45', '<?php echo $LEA_URL?>')"> <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /> </a> </li>
      <li class="miseAJour"> <a href="options.php?cmd=modifier_tuteur_apprenti"> Association: <?php echo $config_lea->appelation_tuteur_cfa ?> / <?php echo $config_lea->appelation_app ?> </a> <a href="#" onclick="lightbox('aide_46', '<?php echo $LEA_URL?>')"> <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /> </a> </li>
      <li class="charte"> <a href="<?php echo"options.php?cmd=maj_charte_graphique"?>"> Charte graphique </a> <a href="#" onclick="lightbox('aide_47', '<?php echo $LEA_URL?>')"> <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /> </a> </li>
    </ul>
  </div>
</div>
