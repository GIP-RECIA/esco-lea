<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 05/09/05

/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
/***********************************************************/

if(isset($_REQUEST['id_ens_select'])) $id_ens_select=$_REQUEST['id_ens_select'];
elseif(isset($_SESSION['id_ens'])) $id_ens_select=$_SESSION['id_ens'];
else exit();

$enseignant = new Enseignant($id_ens_select);
$enseignant->set_detail();

?>
			<div id="top_l"></div><div id="top_m">
			<h1><span class="orange">C</span>oordonn&eacute;es</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">		
		<table>              
			 <tr>
              		<th colspan="2">Informations g&eacute;n&eacute;rales</th>
             </tr>
			<tr>
                <td width="25%" height="30">Civilit&eacute;</td>
                <td width="75%"><?php echo"$enseignant->civilite" ?></td>
          </tr>
              <tr >
			  		<td height="31">Nom</td>
	                <td class="nom"><?php echo"$enseignant->nom" ?></td>
              </tr>
              <tr>
		          <td height="36">Pr&eacute;nom</td>
        	      <td class="nom"><?php echo"$enseignant->prenom" ?></td>
              </tr>
              <tr>
					<td height="31">Adresse</td>
					<td><?php echo"$enseignant->adresse" ?></td>
              </tr>
              <tr>
					<td height="31">T&eacute;l&eacute;phone fixe</td>
	                <td><?php echo"$enseignant->tel_fixe" ?></td>
    	      </tr>
              <tr>
        	        <td height="37">T&eacute;l&eacute;phone portable</td>
	                <td><?php echo"$enseignant->tel_mobile" ?></td>
              </tr>
              <tr>
    	            <td height="32">E-mail</td>
        	        <td><a href="mailto:<?php echo"$enseignant->email" ?>"><?php echo"$enseignant->email" ?></a></td>
              </tr>
              <tr>
	        		<td height="34">Site web(url)</td>
	                <td><a href="<?php echo"$enseignant->url_site" ?>" target="_blank"><?php echo"$enseignant->url_site" ?></a></td>
			  </tr>
	          <tr>
                	<td height="31">Discipline</td>
	                <td><?php echo"$enseignant->discipline" ?></td>
              </tr>
   			  <?php if(isset($_SESSION['id_ens']) && $_SESSION['id_ens']==$id_ens_select ) { //si  l'enseignant qui veut consulter ses coordonnï¿½es			  
			  ?> 
              <tr>
              		<th colspan="2">Authentification</th>
              </tr>
              <tr>
              		<td>Login</td>
	                <td class="nom"><?php echo"$enseignant->login" ?></td>
              </tr>
			  <?php } ?> 			  
		</table>			
		<?php
			if( (isset($_SESSION['id_ens']) && $_SESSION['id_ens']!= $id_ens_select) || !isset($_SESSION['id_ens']) )  
				afficher_boutton_ecrire_msg("&Eacute;crire un message &agrave; cet enseignant", $enseignant->id_ens);
				//echo"<input type=\"button\" value=\"&Eacute;crire un message &agrave; cet enseignant\" onclick=\"window.open('../../administrateur/contact/ecrire_msg.php?les_id_usager_dest[]=$enseignant->id_ens','','height=300, width=600, left=150, top=300, scrollbars=no')\">";
		?>
		</div>