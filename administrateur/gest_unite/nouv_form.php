<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: Cette page contient le formulaire de crï¿½ation d'une nouvelle formation
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
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
$bdd = new Connexion_BDD_LEA();

$les_enseignants = $bdd->get_usagers(0,10000,'ens');

$les_unites = $bdd->get_all_unites_pedagogiques();
 		
if(isset($_REQUEST['id_for'])) $id_for = $_REQUEST['id_for']; // modifier la formation d'identifiant id_for
else $id_for = 0; // crï¿½er une nouvelle formation

$formation = new Formation($id_for); 
$formation->set_detail();

if(isset($_REQUEST['id_unite'])) $formation->id_unite = $_REQUEST['id_unite'];

$id_ens_select = $formation->id_ens; //le responsable de la formation sï¿½lectionnï¿½e

if($id_for==0) $titre_page = "Ajouter : ".$config_term->terminologie_formation;
else $titre_page ="Modifier ".$config_term->terminologie_formation;
?>
<script language=JavaScript>
						
	function verifform(theForm){															
		if (theForm.nom.value == "") {
			alert("Vous devez saisir le nom de la formation ");
			theForm.nom.focus();
			return false;
		}
		
	}//fin de verifform					
</script>
<div id="top_l"></div>
<div id="top_m"><?php echo"
	<h1>".$titre_page."</h1>"; ?>
</div>
<div id="top_r"></div>
<div id="m_contenu"> 
  <form action='nouv_form_v.php' method='post' enctype='multipart/form-data' onSubmit='return verifform(this)' >
    <input type="hidden" name="id_for" value="<?php echo $id_for; ?>" >
    <table width="61%" border="0" cellspacing="0">
      	<tr >
        	<th height="30" colspan="2" >Fiche d'information </th>
      	</tr>
      	<tr>
        	<td height="30"><?php echo $config_term->terminologie_unit_pedag; ?></td>
        	<td>
          		<select name="id_unite" size="1" >
            	<?php			  			  			  			  									  			  
					foreach($les_unites as $unite) {				
						if ($unite->id_unite == $formation->id_unite) $selected="selected";
						else $selected="";
						
						echo "
					<option value='".$unite->id_unite."' ".$selected.">".$unite->nom." </option>";	 
				 	}
				?>
          		</select>
        	</td>
      	</tr>
      	<tr>
        	<td width="41%" height="30">Nom <?php echo($config_term->terminologie_formation); ?></td>
        	<td width="59%">
          		<input name="nom" type="text" value="<?php echo"$formation->nom"; ?>" size="40" />
          		<sup class="etoile">*</sup> 
          	</td>
      	</tr>
      	<tr>
        	<td height="39">Nombre de semestres</td>
        	<td>
          		<select name="nb_semestres" size="1">
            	<?php echo"<option selected>$formation->nb_semestres</option>" ?>
            		<option>1</option>
            		<option>2</option>
            		<option>3</option>
            		<option>4</option>
            		<option>5</option>
            		<option>6</option>
          		</select>
        	</td>
      	</tr>
      	<tr>
       	 	<td height="54">Secteur</td>
        	<td> <br />
            	<input name="secteur" type="text" value="<?php echo"$formation->secteur"; ?>" size="40" />
        	</td>
      	</tr>
      	<tr>
        	<td height="45">Niveau</td>
        	<td>
         		<input name="niveau" type="text" value="<?php echo"$formation->niveau"; ?>" size="40" >
        	</td>
      	</tr>
      	<tr>
       		<td height="55"><?php echo($config_term->terminologie_rf); ?></td>
        	<td>
          		<select name='id_ens' size='1'>
            		<option value='0' selected> ------ Inconnu ------ </option>
            		<?php
						foreach($les_enseignants as $enseignant){
			
						if ($enseignant->id_ens == $id_ens_select) $selection="selected";
						else $selection="";
            
			    		echo"
					<option value=\"".$enseignant->id_ens."\" ".$selection." >
				     ".$enseignant->nom."&nbsp;&nbsp;".$enseignant->prenom."
					</option>";              		
						}		            
					?>
          		</select>
        	</td>
      	</tr>
      	<tr>
        	<td height="55">&nbsp;</td>
        	<td>
        		<input type="submit" name="Submit" value="valider">
        	</td>
      	</tr>
    </table>  <br />
  </form>
</div>