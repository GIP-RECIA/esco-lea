<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 25/08/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

/***********************************************************/
	
$unite = new Unite_pedagogique($_SESSION['id_unite']); // l'unite auquelle l'usager connï¿½ctï¿½ est responsable

$les_classes = $unite->get_classes(); // liste des classes de l'unite.
			
 ?>		
  			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">O</span>p&eacute;rations</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
<form name="form1" method="post" action="affect_app_clas_v.php?id=1">
  <table width="549" height="57">
    <tr class="titre_tableau">
      <th >Basculement  de classes</th>
    </tr>
    <tr class="cellule">
      <td width="361"> Basculer les apprentis de 
          <select name="id_cla_depart" size="1">
            <?php		  			
						foreach($les_classes as $classe) {			 		 					 
				    	 echo "<option value='$classe->id_cla' >$classe->libelle </option>\n";	 
			 			}			
					   ?>
          </select>
        vers 
        <select name="id_cla_dest" size="1">
          <option value='0'> </option>
          <?php		  			
						foreach($les_classes as $classe) {			 		 					 
				    	 echo "<option value='$classe->id_cla' >$classe->libelle </option>\n";	 
			 			}			
					   ?>
        </select>
        <input type="submit" name="Submit" value="Valider">
      </td>
    </tr>
  </table>
</form>
</div>