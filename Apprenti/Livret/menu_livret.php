<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 05/10/05
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once($LEA_REP."lib/stdlib.php");

/***********************************************************/
$apprenti = new Apprenti($_SESSION['id_app']);
$apprenti->set_detail();
$config_lea = $apprenti->get_config_lea();
?>		
			<div id="top_l"></div><div id="top_m"><h1><span class="orange">V</span>otre livre d'apprentissage</h1></div><div id="top_r"></div>
			<div id="m_contenu">

        <table cellspacing="0">
          <tr>
            <th height="34">Faire une nouvelle d&eacute;claration </th>
          </tr>
          <tr>
            <td width="93%" height="32"> <a href='livret.php?cmd=nouv_dec&type_suivi=cfa' >Nouvelle
                d&eacute;claration <?php echo $config_lea->appelation_cfa; ?></a></td>
          </tr>
          <tr>
            <td height="29"> <a href='livret.php?cmd=nouv_dec&type_suivi=entr' >Nouvelle
                d&eacute;claration <?php echo $config_lea->appelation_entr; ?></a></td>
          </tr>
          <tr>
            <th height="29">Consulter vos d&eacute;clarations</th>
          </tr>
          <tr>
            <td height="35"> <a href='livret.php?cmd=cons_dec&type_suivi=cfa' >Consulter
                les d&eacute;clarations <?php echo $config_lea->appelation_cfa; ?></a></td>
          </tr>
          <tr>
            <td height="33"> <a href='livret.php?cmd=cons_dec&type_suivi=entr' >Consulter
                les d&eacute;clarations <?php echo $config_lea->appelation_entr; ?> </a> </td>
          </tr>
          <tr>
            <th height="27">Synth&egrave;se</th>
          </tr>
          <tr>
            <td height="27"> <a href='#'>Consulter la synth&egrave;se de
                vos d&eacute;clarations</a></td>
          </tr>
          <tr>
            <td> <a href='#' >Consulter le Bilan de votre <?php echo($config_lea->appelation_classe);?></a></td>
          </tr>
        </table>
        
</div>