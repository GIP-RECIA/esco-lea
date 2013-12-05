<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_usager.php");
/***********************************************************/	
if(isset($_REQUEST['action'])){
	$action=$_REQUEST['action']; // l'action demandï¿½e : mofier ou ajouter un nouvel usager
}else{
	$action="";
}

if ($action=="modif"){ 
	$id_usager=$_REQUEST['id_usager'];
}else{ 
	$id_usager=0;
}
$rvs = new Usager($id_usager);
$rvs->set_detail();
?>		
<script language="JavaScript">
	function controleSaisie(theForm)
	{   
	    			    
	   if(testCivilite(theForm.civilite)==false) return false;
	   
	   if(testNom(theForm.nom, "nom")==false) return false;
	   
	   if(testNom(theForm.prenom, "prenom")==false) return false;
	   
	   if(testVide(theForm.adresse, "adresse")==false) return false;
	   
	   if(testLongueur(theForm.login, "login", 6 )==false) return false;
	   
	   if(testLongueur(theForm.mdp, "mot de passe", 6 )==false) return false;
	   
	   if(verifMotPass ( theForm.mdp, theForm.confirm_mdp)==false) return false;
	      
	   return true;
	
	}
</script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">A</span>jouter <?php echo $config_term->terminologie_rvs; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu"> 
<?php echo"
	<form name='theForm' action='form_nouv_usag_v.php?id_usager=$id_usager&profil=rvs&action=$action' method='post' onsubmit='return controleSaisie(this)'>" ?>
		<table width="69%" height="62%" border="0" cellpadding="0" cellspacing="0" >
  			<tr>
    			<th height="28" colspan="2">Informations <?php echo$config_term->terminologie_rvs; ?> </th>
  			</tr>
  			<tr>
    			<td width="43%" height="29">Civilit&eacute;</td>
    			<td width="57%">
      			<?php  
				
					if($rvs->civilite=="Monsieur"){
					     echo"
					<input name='civilite' type='radio' value='Monsieur' checked > Monsieur";
					}else{ 
						echo"
					<input name='civilite' type='radio' value='Monsieur' > Monsieur";
					}
					if($rvs->civilite=="Madame"){
					     echo"
					<input name='civilite' type='radio' value='Madame' checked> Madame";
					}else{ 
						echo"
					<input name='civilite' type='radio' value='Madame'  > Madame";
					}
					if($rvs->civilite=="Mademoiselle"){
					     echo"
					<input name='civilite' type='radio' value='Mademoiselle' checked > Mademoiselle";
					}else{ 
						echo"
					<input name='civilite' type='radio' value='Mademoiselle' > Mademoiselle";      			  
						echo"
					<sup class='etoile'>*</sup> ";
					}
				?>
    			</td>
  			</tr>
  			<tr>
		    <td height="18">Nom</td>
		    	<td>
		      		<input name="nom" type="text" value='<?php echo $rvs->nom;?>'>
		      		<sup class="etoile">*</sup> 
		      	</td>
		  	</tr>
		  	<tr>
		    	<td height="18">Pr&eacute;nom</td>
		    	<td>
		      		<input name="prenom" type="text" value='<?php echo $rvs->prenom;?>'>
		      		<sup class="etoile">*</sup> 
		      	</td>
		  	</tr>
		  	<tr>
		    	<td height="18">Adresse</td>
		    	<td>
		      		<textarea name="adresse" cols="40" rows="4" ><?php echo $rvs->adresse;?></textarea>
		      		<sup class="etoile">*</sup> 
		      	</td>
		  	</tr>
		  	<tr>
		    	<td height="20">T&eacute;l&eacute;phone fixe</td>
		    	<td>
		      		<input name="tel_fixe" type="text" value='<?php echo $rvs->tel_fixe;?>'>
		    	</td>
		  	</tr>
			<tr>
			  	<td height="18">T&eacute;l&eacute;phone portable</td>
			  	<td>
			    	<input name="tel_mobile" type="text" value='<?php echo $rvs->tel_mobile;?>'>
			  	</td>
			</tr>
			<tr>
			  	<td height="22">E-mail </td>
			  	<td>
			    	<input name="email" type="text" value='<?php echo $rvs->email;?>'>
			  	</td>
			</tr>
			<tr>
			  	<td height="18">Site web(url)</td>
			  	<td>
			  		<input name="url_site" type="text" value='<?php echo $rvs->url_site;?>'>
			  	</td>
			</tr>
			<tr>
			  	<th height="18" colspan="2">Authentification</th>
			</tr>
			<tr>
			  	<td height="18">Login</td>
			  	<td>
			  		<input name="login" type="text" value='<?php echo $rvs->login;?>' onFocus=" auto_login(document.theForm)">
			      	<sup class="etoile">*</sup> 
			    </td>
			</tr>
			<tr>
			  	<td height="18">Mot de passe</td>
			  	<td>
			  		<input name="mdp" type="password" value='<?php echo $rvs->mdp; ?>'  >
			      	<sup class="etoile">*</sup> 
			    </td>
			</tr>
			<tr>
			  	<td height="18">Confirmer mot de passe</td>
			  	<td>
			    	<input name="confirm_mdp" type="password" value='<?php echo $rvs->mdp; ?>'  >
			    	<sup class="etoile">*</sup> 
			    </td>
			</tr>
			<tr>
			  	<td>
			  		<input type="submit" name="Submit" value="Valider">
			  	</td>
			</tr>
		</table>
  	</form>
 </div>