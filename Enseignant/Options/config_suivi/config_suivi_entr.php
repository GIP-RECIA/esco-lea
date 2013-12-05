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
include($LEA_REP."Enseignant//test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$les_apprentis = $formation->get_apprentis();

$config_lea = $formation->get_config_lea();

if($config_lea->id_config == 0) {  
	// on crï¿½e une nouvelle configuration
	$config_lea->id_for = $formation->id_for;
	$config_lea->suivi_entr_actif = 1;
	$config_lea->insert();
	
	$suivi_entr_guide = 0;
	$suivi_entr_libre = 0;
								
}								

$suivi_entr_guide = $config_lea->suivi_entr_guide_actif ;
$suivi_entr_libre = $config_lea->suivi_entr_libre_actif ;

//print_r($config_lea);

?>
<script language="JavaScript" src="../../../javascript/stdlib.js"></script>		
<script language="JavaScript">
	function controleSaisie(theForm){   
	    			          
		if(testVide(theForm.appelation_ma, "nom du referent entreprise")== false) return false;     
		if(testVide(theForm.appelation_tuteur_cfa, "nom du referent en cours")== false) return false;
		if(testVide(theForm.appelation_app, "nom de l apprenti")== false) return false;     
		if(testVide(theForm.appelation_classe, "nom de la classe")== false) return false;
		if(testVide(theForm.appelation_rl, "nom du responsable legal")== false) return false;
		  
		if(testNumeric(theForm.DMSA_dec_entr, "duree d'activation de la declaration" )== false) return false; 
		
		if(!theForm.suivi_entr_guide.checked && !theForm.suivi_entr_libre.checked ) {
			alert('Vous devez choisir au moins un mode de suivi');
			return false;     
		} 
		return true;
	}
</script>
<div id="contenu">
	<div id="top_l"></div>
	<div id="top_m">
		<h1><img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_suivi_entreprise.png') ?>"> 
			Configurer : <?php echo $config_lea->appelation_suivi_entr; ?>
		</h1>
	</div>
	<div id="top_r"></div>
	<div id="m_contenu">
		<form action="./config_suivi/config_suivi_entr_v.php" method="post" onSubmit="return controleSaisie(this)">
	  		<table width="719">
	    		<tr>
	      			<th height="31" colspan="2">Acc&egrave;s par internet </th>
	    		</tr>
	    		<tr>
	      			<td height="58" colspan="2">
		  				Cochez dans la liste qui suit les <?php echo"$config_lea->appelation_app" ?>s qui seront autoris&eacute;s &agrave; faire
		  				la saisie &agrave; la place de leur <?php echo($config_lea->appelation_ma) ?>. <br><br>
		  				<div style="width:300px; height:140px; overflow:auto;">
		  				<?php
		  					foreach($les_apprentis as $apprenti ){
								if($apprenti->modif_dec_ma) $checked = 'checked';
								else $checked = '';
								
								echo'<input type="checkbox" name="les_id_app[]" value="'.$apprenti->id_app.'"  '.$checked.  ' > '.to_html($apprenti->nom).'&nbsp;'.to_html($apprenti->prenom).'<br>';
							}
		  				?>
		  				</div>
		  			</td>
	    		</tr>
			    <tr>
				    <th height="21" colspan="2">1. Autorisez-vous les acteurs &agrave; joindre des fichiers &agrave; leurs d&eacute;clarations ? 
						<a href="#" onclick="lightbox('aide_02', '<?php echo $LEA_URL?>')">
							<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
						</a>
					</th>
			    </tr>
	    		<tr>
				    <td height="33" colspan="2">
				    	<input type="checkbox" name="app_joint_fichiers_suivi_entr" value="1" <?php if($config_lea->app_joint_fichiers_suivi_entr) echo "checked";?> >
						Oui 
					</td>
			    </tr>
			    <tr>
			    	<th height="21" colspan="2">2. Quelle est la dur&eacute;e d'activation d'une d&eacute;claration ? 
				      	<a href="#" onclick="lightbox('aide_03', '<?php echo $LEA_URL?>')">
				      		<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
				      	</a>
			    	</th>
			    </tr>
			    <tr>
			    	<td height="58" colspan="2">
			        	<input 	name="DMSA_dec_entr" type="text" size="4" value='<?php echo"$config_lea->DMSA_dec_entr" ?>'>
			        	Jours
			        </td>
			    </tr>
			    <tr>
			    	<th height="21" colspan="2">3. Vous d&eacute;sirez que la d&eacute;claration d'activit&eacute;s soit
			        </th>
			    </tr>
			    <tr>
			    	<td height="32">Libre (Modalit&eacute; de saisie libre)
			    		<a href="#" onclick="lightbox('aide_04', '<?php echo $LEA_URL?>')">
			    			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
			    		</a>
			    	</td>
			    	<td>
			        	<input type="checkbox" name="suivi_entr_libre" value="1" <?php if($suivi_entr_libre) echo "checked";	?> >
	        			Oui
	        		</td>
			    </tr>
			    <tr>
			    	<td width="33%" height="30">Guid&eacute;e grâce &agrave; un r&eacute;f&eacute;rentiel (Arbre)
			    		<a href="#" onclick="lightbox('aide_05', '<?php echo $LEA_URL?>')">
			    			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
			    		</a>
			    	</td>
			    	<td width="67%" height="30">
			        	<input type="checkbox" name="suivi_entr_guide" value="1" <?php if($suivi_entr_guide) echo "checked"; ?> >
			        	Oui
			        </td>
			    </tr>
			</table>
			<p>
			  <input type="submit" name="Submit" value="Suivant">
			</p>
		</form>
	</div>
</div>