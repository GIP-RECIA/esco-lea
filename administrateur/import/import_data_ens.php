<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/11/05
/***********************************************************/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
/***********************************************************/
$bdd = new Connexion_BDD_LEA();
$les_classes = $bdd->get_classes(); 

?>
				<div id="top_l"></div><div id="top_m"><h1><span class="orange">I</span>mportation <?php echo($config_term->terminologie_ens); ?></h1></div><div id="top_r"></div>

<div id="m_contenu"> 
				<form name="form2" method="post" action="import_data_ens_v.php" enctype="multipart/form-data">
                  <table width="68%" height="224" cellspacing="0" >
                    <tr >
                      <th height="21" colspan="2" >Fichier</th>
                    </tr>
                    <tr class="cellule">
                      <td width="52%" class="cellule"><a href="format_fichier_data_ens.php">(Voir
                          le format du fichier &agrave; attacher)</a></td>
                      <td width="48%" class="cellule"><input type="file" name="data_ens">
                      </td>
                    </tr>
                    <tr>
                      <th height="22" colspan="2" class="sous_titre_tableau">Options</th>
                    </tr>
                    <tr>
                      <td height="29"  class="cellule">Mettre &agrave; jour les
                      coordonn&eacute;es d'un usager d&eacute;j&agrave; enregistr&eacute;</td>
                      <td><input type="checkbox" name="update" value="checkbox" onClick="if(this.checked) alert('Vous voulez vraiment remplacer les cordonnées des enseignants déjà existants dans la BDD LEA par celles issues du fichier CSV')">
                      </td>
                    </tr>
                    <tr class="cellule">
                      <td height="29"  >Identifiant (login)</td>
                      <td>
                        <select name="option_login" size="1" id="type_login">
                          <option value="1">faouzi AMIER ----&gt; fAMIER
                          <option value="2" selected>faouzi AMIER ----&gt; faouzi_AMIER
                        </select>
                      </td>
                    </tr>
                    <tr class="cellule">
                      <td height="25"  class="cellule" >Mot de passe</td>
                      <td>
                        <select name="option_mdp" size="1" id="type_mdp">
                          <option value='1' > Identique au login </option>
                          <option value='2' selected > Aléatoire alphanumérique </option>
                        </select>
                      </td>
                    </tr>
                    <tr class="cellule">
                      <td height="58"  class="cellule" >&nbsp;</td>
                      <td><input type="submit" name="Submit2" value="Importer <?php echo($config_term->terminologie_ens); ?>"></td>
                    </tr>
                  </table>
				  <br>
				</form>
				
			</div>	