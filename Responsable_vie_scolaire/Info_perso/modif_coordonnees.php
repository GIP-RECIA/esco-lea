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

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once("../secure.php");
/***********************************************************/
$rvs = new Usager($_SESSION['id_rvs']);
$rvs->set_detail();

?>
<script language="JavaScript" src="../../javascript/stdlib.js"></script>

<script language="JavaScript">
	function controleSaisie(theForm)
	{       			      
	   
	   if(testVide(theForm.adresse, "adresse")==false) return false;     
	   
	   if(testLongueur(theForm.mdp, "mot de passe", 6 )==false) return false;
	   
	   if(verifMotPass ( theForm.mdp, theForm.confirm_mdp)==false) return false;
	      
	   return true;
	
	}
</script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange coordonnees">M</span>odifier vos coordonn&eacute;es </h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form action="modif_coordonnees_v.php" method="post" onSubmit="return controleSaisie(this)">
	   	<table>
			<tr>
				<th colspan="2">Coordonn&eacute;es</th>
			</tr>
			<tr>
				<td>Civilit&eacute;</td>
				<td><?php echo"$rvs->civilite" ?></td>
			</tr>
			<tr>
	        	<td>Nom</td>
	            <td><?php echo"$rvs->nom" ?></td>
	        </tr>
	        <tr>
				<td>Pr&eacute;nom</td>
	            <td><?php echo"$rvs->prenom" ?></td>
	        </tr>
	        <tr>
	            <td>Adresse</td>
	            <td>
	            	<textarea name="adresse" cols="40" rows="3"><?php echo"$rvs->adresse" ?></textarea>
	            </td>
	        </tr>
	        <tr>
		        <td>T&eacute;l&eacute;phone fixe</td>
	            <td>
	            	<input name="tel_fixe" type="text" value="<?php echo"$rvs->tel_fixe" ?>" />
	            </td>
	    	</tr>
	        <tr>
	        	<td>T&eacute;l&eacute;phone portable</td>
	            <td>
	            	<input name="tel_mobile" type="text" id="tel_mobile2" value="<?php echo"$rvs->tel_mobile" ?>" />
	            </td>
	        </tr>
	        <tr>
	        	<td>E-mail</td>
	            <td>
	            	<input name="email" type="text" id="email2" value="<?php echo"$rvs->email" ?>" size="40" />
	            </td>
	        </tr>
	        <tr>
		    	<td>Site web (URL)</td>
	            <td>
	             	<input name="url_site" type="text" value="
	             	<?php 
						if ($rvs->url_site!="") echo"$rvs->url_site";
						else echo("http://");
					?>" size="40" />
				</td>
	        </tr>
	        <tr>
	         	<th colspan="2">Authentification</td>
	        </tr>
	        <tr>
	         	<td>Login</td>
	          	<td><?php echo"$rvs->login" ?></td>
	        </tr>
			<tr>
		     	<td>Nouveau mot de passe</td>
	            <td>
	            	<input name="mdp" type="password" value="<?php echo "$rvs->mdp"?>" />
	            </td>
	        </tr>
	        <tr>
	         	<td>Confirmer mot de passe</td>
	            <td>
	            	<input name="confirm_mdp" type="password" value="<?php echo "$rvs->mdp"?>" />
	            </td>
	        </tr>
	        <tr>
	           <td height="50">&nbsp;</td>
	           <td>
	           		<input class="submit" type="submit" name="modifier" value="Modifier" />
	           	</td>
	        </tr>
		</table>          
	    <p>&nbsp;</p>
	</form>
</div>