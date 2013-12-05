<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Formulaire de  saisies d'une nouvelle uniteepreprsie dans la base
  //          de donnnï¿½es
/***********************************************************/
include_once("../secure.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
/***********************************************************/	
if(isset($_REQUEST['id_unite'])) $id_unite=$_REQUEST['id_unite']; // modifier l'unite didentifiant id_unite
else $id_unite = 0; // crï¿½er une nouvelle unite

$unite = new Unite_pedagogique($id_unite);

$unite->set_detail();

$bdd = new Connexion_BDD_LEA();

$les_rvs = $bdd->get_usagers(0,1000, "rvs"); // la liste de tous les usagers enregistï¿½s comme 
											 //	responsable vie scolaire du CFA
$les_id_responsables = $unite->get_id_responsables(); // les identifiant des responsable vie scolaire de cette unitï¿½
?>		
<script language="JavaScript" src="../../javascript/stdlib.js"></script>
<script language="JavaScript">
function controleSaisie(theForm)
{   
    			          
   if(testNom(theForm.nom, "nom")==false) return false;     
   
   if(testVide(theForm.adresse, "adresse")==false) return false;
   
   return true;
}
</script>		
<div id="top_l"></div>
<div id="top_m"><h1>         
	<?php 			
		if($id_unite==0) echo"Ajouter : ".$config_term->terminologie_unit_pedag;
		else echo"Modifier : ".$config_term->terminologie_unit_pedag;
	?>
</div>
<div id="top_r"></div>
	<div id="m_contenu"> 
<?php echo"
		<form name='theForm' action='nouv_unite_v.php?id_unite=".$id_unite."' method='post' onSubmit='return controleSaisie(this)'>" ?>
		<table width="62%" height="120%" border="0" cellpadding="0" cellspacing="0" >
		  	<tr>
		    	<th height="25" colspan="2" >Informations</th>
		  	</tr>
		  	<tr>
		    	<td width="50%" height="23" >Nom</td>
		    	<td width="50%" >
			      	<input name="nom" type="text" value="<?php echo $unite->nom; ?>" />
			    	<sup class="etoile">*</sup> 
		    	</td>
		  	</tr>
		  	<tr>
		    	<td height="18" >Adresse</td>
		    	<td>
		      		<textarea name="adresse" cols="40" rows="4" ><?php echo $unite->adresse; ?></textarea>
		    		<sup class="etoile">*</sup> 
		    	</td>
		  	</tr>
		  	<tr>
		    	<td height="20" > T&eacute;l&eacute;phone fixe1 </td>
		    	<td>
		      		<input name="tel_fixe1" type="text" value='<?php echo $unite->tel_fixe1; ?>' />
		    	</td>
		  	</tr>
		  	<tr>
		    	<td height="18">T&eacute;l&eacute;phone fixe2 </td>
		    	<td >
		    		<input name="tel_fixe2" type="text" value='<?php echo $unite->tel_fixe2; ?>' />
		    	</td>
		  	</tr>
		  	<tr>
		    	<td height="18">Fax</td>
		    	<td>
		    		<input name="fax" type="text" value='<?php echo $unite->fax; ?>' />
		    	</td>
		  	</tr>
		  	<tr>
		    	<td height="18" >E-mail </td>
		    	<td>
		    		<input name="email" type="text" value='<?php echo $unite->email; ?>' />
		    	</td>
		  	</tr>
		  	<tr>
		    	<td height="18" >Site web(url)</td>
		    	<td>
		    		<input name="url_site" type="text" value='<?php echo $unite->url_site; ?>' size="50" />
		    	</td>
		  	</tr>
		  	<tr>
		    	<th height="22" colspan="2" >Contact</th>
		  	</tr>
		  	<tr>
		    	<td height="30" >Nom</td>
		    	<td >
		    		<input name="nom_contact" type="text" value='<?php echo $unite->nom_contact; ?>' size="40" />
		    	</td>
		  	</tr>
		  	<tr >
		    	<td height="32">Pr&eacute;nom</td>
		    	<td>
		    		<input name="prenom_contact" type="text" value="<?php echo $unite->prenom_contact; ?>" size="40" />
		    	</td>
		  	</tr>
		  	<tr>
		    	<td height="22"><?php echo $config_term->terminologie_rvs; ?></td>
		    	<td>
      			<?php 			  			  
              		echo"
					<select name='les_id_rvs[]' multiple size='5'>";			  			 
				  	foreach ($les_rvs as $rvs){		  			  
						if (in_array($rvs->id_usager, $les_id_responsables) ) $selected = "selected=\"selected\"";
						else $selected = "";
				  		echo"
						<option value='".$rvs->id_usager."' ".$selected.">".$rvs->nom."&nbsp;&nbsp;".$rvs->prenom." </option>";			  
				  	}
              		echo"
					</select>";		  
			  	?>
				</td>
		  	</tr>
		  	<tr>
		    	<td height="51">&nbsp;</td>
		    	<td>
		    		<input type="submit" name="Submit" value="Valider">
		    	</td>
		  	</tr>
		</table>
		<br />
	</form>
</div>