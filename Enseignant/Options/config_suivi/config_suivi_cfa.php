<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/09/05
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."Enseignant/secure.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/

include($LEA_REP."Enseignant/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();

if($config_lea->id_config == 0) { 
	 
	$config_lea->id_for = $formation->id_for;
	$config_lea->suivi_cfa_actif = 1;
	$config_lea->insert();
	
	$suivi_cfa_guide = 0;
	$suivi_cfa_libre = 0;
								
}								

$suivi_cfa_guide = $config_lea->suivi_cfa_guide_actif ;
$suivi_cfa_libre = $config_lea->suivi_cfa_libre_actif ;
?>
<script language="JavaScript" src="../../../javascript/stdlib.js"></script>		
<script language="JavaScript">
	function controleSaisie(theForm){   
	       
	   if(!theForm.suivi_cfa_guide.checked && !theForm.suivi_cfa_libre.checked ) {
	  	 	alert('Vous devez choisir au moins un mode de suivi');
	   	return false;     
	   }
	   if(testVide(theForm.appelation_ens, "nom de la personne qui enseigne")== false) return false;   
	     
	   return true;
	}
</script>			

<div id="contenu">
	<div id="top_l"></div>
		<div id="top_m">
			<h1>	
				<img src="<?php echo($URL_THEME.'images/picto_suivi_cfa.png') ?>"> 
    			Configurer : <?php echo $config_lea->appelation_suivi_cfa; ?>
    		</h1>
    	</div>
		<div id="top_r"></div>
		<div id="m_contenu">
		<form action="./config_suivi/config_suivi_cfa_v.php" method="post" onSubmit="return controleSaisie(this)">
  <table width="66%" border="0">
    <tr>
      <th height="21" colspan="2">1. Autorisez-vous les acteurs de suivi &agrave; joindre des fichiers &agrave; leurs d&eacute;clarations ?
<a href="#" onclick="lightbox('aide_02', '<?php echo $LEA_URL?>')"><img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>
		</th>
    </tr>
    <tr>
      <td height="33" colspan="2">
        <input type="checkbox" name="app_joint_fichiers_suivi_cfa" value="1"
				<?php
						if($config_lea->app_joint_fichiers_suivi_cfa)	echo "checked";						
				
				?>
				>
        Oui </td>
    </tr>
    <tr>
      <th height="21" colspan="2">2. Quelle est la dur&eacute;e d'activation d'une d&eacute;claration ?
<a href="#" onclick="lightbox('aide_03', '<?php echo $LEA_URL?>')"><img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>
		</td>
    </th>
    <tr>
      <td height="58" colspan="2">
        <input name="DMSA_dec_cfa" type="text" size="4"
				value='<?php echo"$config_lea->DMSA_dec_cfa" ?>'
				>
        Jours</td>
    </tr>
    <tr>
      <th height="21" colspan="2">3. Vous d&eacute;sirez que la d&eacute;claration d'activit&eacute;s soit
	 </th>
    </tr>
    <tr>
      <td height="32">Libre (Modalit&eacute; de saisie libre)
<a href="#" onclick="lightbox('aide_04', '<?php echo $LEA_URL?>')"><img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>
	  
	  </td>
      <td>
        <input type="checkbox" name="suivi_cfa_libre" value="1"
				<?php
						if($suivi_cfa_libre)	echo "checked";						
				
					?>
				>
        Oui</td>
    </tr>
    <tr>
      <td width="33%" height="30">Guid&eacute;e grâce &agrave; un r&eacute;f&eacute;rentiel (Arbre)
<a href="#" onclick="lightbox('aide_05', '<?php echo $LEA_URL?>')"><img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>
	  </td>
      <td width="67%" height="30">
        <input type="checkbox" name="suivi_cfa_guide" value="1"
				<?php
						if($suivi_cfa_guide)	echo "checked";						
				
				?>
				>
        Oui </td>
    </tr>
  </table>
  <p>
    <input type="submit" name="Submit" value="Suivant">
  </p>
</form>
</div>
</div>
