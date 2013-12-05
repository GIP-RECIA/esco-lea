<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  // Contenu: Cette page contient le formulaire de crï¿½ation d'une nouvelle classe
/***********************************************************/

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
/***********************************************************/

if (isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action = "nouv";

switch ($action) {

	case "nouv" : 
		$titre_page="Ajouter ".$config_term->terminologie_classe;
		$action_formulaire="nouv_clas_v.php?action=nouv";
		$id_for = $_REQUEST['id_for_select']; //si la formation est fournie comme paramï¿½tre			 
		$formation = new Formation($id_for);
		$formation->set_detail();			 
		$libelle="";
		$niveau_etude="";
		$id_ens_select="";  
		break;
	case "modif":
		$titre_page="Modifier : $config_term->terminologie_classe";
		$id_cla = $_REQUEST['id_cla'];
		$action_formulaire="nouv_clas_v.php?action=modif&id_cla=".$id_cla;			 
		$classe=new Classe($id_cla); 
		$classe->set_detail();
		$id_for = $classe->id_for;
		$formation = new Formation($id_for);
		$formation->set_detail();			
		$libelle = $classe->libelle;
		$niveau_etude = $classe->niveau_etude;
		$id_ens_select = $classe->get_id_prof_principal(); //l'identifiant du prof  principal de la classe 
		break;
}
?>		
<script language=JavaScript>				
	function verifform(theForm){															
		if ( theForm.id_for && theForm.id_for.selectedIndex ==0)  {
			alert("Vous devez  s&eacute;lectionner une formation ");
			return false;
	   }	
		if (theForm.libelle.value == "") {
			alert("Vous devez saisir le libell&eacute; de la classe ");
			theForm.libelle.focus();
			return false;	   		
		}	
	}//fin de verifform					
</script>
<div id="top_l"></div>
<div id="top_m">
	<?php echo"<h1>".$titre_page."</h1>"; ?>   	
</div>
<div id="top_r"></div>
<div id="m_contenu"> 

<?php echo"
	<form name='theForm' action='".$action_formulaire."' method='post' 
             onSubmit='return verifform(this)'>" ?>
		<input	type="hidden" name="id_for" value="<?php echo"$formation->id_for" ?>" />
        
		<table width="100%" height="53%" border="0" cellpadding="0" cellspacing="0" >
          	<tr >
            	<td height="36"><?php echo($config_term->terminologie_formation); ?></td>
            	<td width="53%"><?php echo"$formation->nom" ?>			  </td>
          	</tr>
          	<tr >
            	<td width="20%">Libell&eacute; <?php echo($config_term->terminologie_classe); ?></td>
            	<td height="37">
             		<input name="libelle" type="text" size="38" value="<?php echo to_html($libelle); ?>">
            		<sup class="etoile">*</sup>
            	</td>
          	</tr>
          	<tr>
            	<td height="34">Niveau d'&eacute;tude</td>
            	<td height="34">
				<select name="niveau_etude" size="1">
				<?php
					$selected1=""; 
					$selected2=""; 
					$selected3="";
					switch($niveau_etude){ 
						case 1:$selected1="selected=\"selected\"";
	      				 break; 
						case 2:$selected2="selected=\"selected\"";
	    				   break; 
						case 3:$selected3="selected=\"selected\"";
	       				   break; 
						default: break;
					}
					echo"
					<option value='1' $selected1>Premi&egrave;re ann&eacute;e</option>
					<option value='2' $selected2>Deuxi&egrave;me ann&eacute;e</option>
					<option value='3' $selected3>Troisi&egrave;me ann&eacute;e</option>"; 
				?> 
            	</select><sup class="etoile">*</sup></td>
          	</tr>
          	<tr>
            	<td height="45"><input type="submit" name="Submit" value="Valider"></td>
          	</tr>
        </table>
	</form>
</div>