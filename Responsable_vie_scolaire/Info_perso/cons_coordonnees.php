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
require_once($LEA_REP."modele/bdd/classe_usager.php");

require_once("../secure.php");

/***********************************************************/

$rvs = new Usager($_SESSION['id_rvs']);
$rvs->set_detail();

?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>onsulter vos coordonn&eacute;es</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">         
<!--
	<p> Coordonn&eacute;es Responsable vie scolaire </p>                
	<img src="../../images/b_edit.png" />
	<a href="info_perso.php?cmd=modif_coordonnees">	Modifier</a> 
-->
<table>              
	<tr>
    	<th colspan="2">Informations g&eacute;n&eacute;rales</th>
    </tr>
	<tr>
       	<td height="30">Civilit&eacute;</td>
       	<td><?php echo"$rvs->civilite" ?></td>
   	</tr>
    <tr>
		<td height="20">Nom</td>
        <td class="nom"><?php echo"$rvs->nom" ?></td>
	</tr>
	<tr>
		<td height="20">Pr&eacute;nom</td>
	  	<td class="nom"><?php echo"$rvs->prenom" ?></td>
    </tr>
    <tr>
		<td height="40">Adresse</td>
		<td><?php echo"$rvs->adresse" ?></td>
    </tr>
    <tr>
		<td height="20">T&eacute;l&eacute;phone fixe</td>
        <td><?php echo"$rvs->tel_fixe" ?></td>
	</tr>
  	<tr>
		<td height="20">T&eacute;l&eacute;phone portable</td>
		<td><?php echo"$rvs->tel_mobile" ?></td>
	</tr>
	<tr>
		<td height="40">E-mail</td>
		<td>
			<a href="mailto:<?php echo"$rvs->email" ?>"><?php echo"$rvs->email" ?></a>
		</td>
   	</tr>
   	<tr>
		<td height="20">Site web(url)</td>
		<td>
			<a href="<?php echo"$rvs->url_site" ?>" target="_blank"><?php echo"$rvs->url_site" ?></a>
		</td>
	</tr>
	<?php if(isset($_SESSION['id_ens']) && $_SESSION['id_ens']==$id_ens_select ) { //si  l'rvs qui veut consulter ses coordonnï¿½es?> 
	<tr>
		<th colspan="2">Authentification</th>
	</tr>
	<tr>
		<td>Login</td>
   		<td class="nom"><?php echo"$rvs->login" ?></td>
	</tr>
	<?php } ?> 			  
</table>					
</div>