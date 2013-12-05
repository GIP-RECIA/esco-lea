<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/11/05
  // Contenu: Ce script permet d'afficher la lise des apprentis ayant un nom commence par le mot clï¿½ passï¿½
  //           en paramettre
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
/***********************************************************/
$config_term = new Terminologie();
$config_term->set_detail();

if(isset($_REQUEST['mot_cle'])) $mot_cle = $_REQUEST['mot_cle'];
else $mot_cle = "UNDEFINED"; 

$mot = to_sql($mot_cle);

if(isset($_REQUEST['profil'])) $profil = $_REQUEST['profil'];
else $profil = "app"; 

$bdd = new Connexion_BDD_LEA();

$les_usagers = $bdd->get_usagers(0,100000, $profil, $mot);
?>

<script language="JavaScript">
function select_all(ok){
	var nbchamps=document.forms['msgForm'].elements.length;
	for(i=0;i<nbchamps;i++) {
		if (document.forms['msgForm'].elements[i].name=="les_id_usager_dest[]") 
	        document.forms['msgForm'].elements[i].checked=ok;		  		
	}	
}
</script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">E</span>crire un message</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form name="form1" method="post" action="<?php echo($LEA_URL."/administrateur/contact/contact.php?cmd=chercher_usager"); ?>">
  		<table width="48%" height="105">
    		<tr class="cellule">
      			<td width="39%" align="right">Profil</td>
      			<td width="61%" height="23" align="left">
        			<select name="profil" >
						<option value="app" <?php if($profil == 'app') echo"selected" ?> >	<?php echo $config_term->terminologie_app; ?></option>
						<option value="ens" <?php if($profil == 'ens') echo"selected" ?> >	<?php echo $config_term->terminologie_ens; ?></option>
						<option value="ma" <?php if($profil == 'ma') echo"selected" ?> >	<?php echo $config_term->terminologie_ma; ?></option>
						<option value="rl" <?php if($profil == 'rl') echo"selected" ?> >	<?php echo $config_term->terminologie_rl; ?></option>
						<option value="rvs" <?php if($profil == 'rvs') echo"selected" ?> >	<?php echo $config_term->terminologie_rvs; ?></option>
        			</select>
      			</td>
    		</tr>
    		<tr class="cellule">
				<td height="31"  align="right">Nom de l'usager</td>
				<td  align="left">
        			<input name="mot_cle" type="text" value="<?php if($mot_cle!='UNDEFINED') echo"$mot_cle"; ?>" size="25">
      			</td>
    		</tr>
    		<tr class="cellule">
      			<td  align="center">&nbsp;      </td>
      			<td><input type="submit" name="Submit" value="chercher"></td>
    		</tr>
  		</table>
	</form>
	<form name="msgForm" action="ecrire_msg.php" method="post" target="_blank" >
		<?php if (count($les_usagers) > 0) { ?>
		<table width="81%" >
	    	<tr>
	      		<th width="5%">&nbsp;</th>
	      		<th width="21%">Nom </th>
	      		<th width="19%">Pr&eacute;nom</th>
	      		<th width="21%">T&eacute;l&eacute;phone</th>
	      		<th width="32%">Connexion</th>
	    	</tr>
	    	<?php        
				foreach($les_usagers as $usager){
				echo "<tr>
					  <td><input type='checkbox' name='les_id_usager_dest[]' value='".$usager->id_usager."' >
			          <td class='nom'> ".to_html($usager->nom)." </td>
					  <td class='nom'> ".to_html($usager->prenom)."</td>			                 			    			  			                 
					  <td>".$usager->tel_fixe."</td>
					  <td>".$usager->date_derniere_connexion."&nbsp;&nbsp;( ".$usager->nombre_connexions." )</td>							         			          
				  </tr> ";										
				}
			?>
			<tr>
	      		<td align="right" >
	      			<img src="../../images/arrow_ltr.png" width="38" height="22">
	      			&nbsp;&nbsp;&nbsp;&nbsp;
	      		</td>
	      		<td colspan="4"> 
		      		<a href="#" onClick="select_all(true); return false;">Tout cocher</a> 
		      		/ <a  href="#" onClick="select_all(false); return false;">Tout d&eacute;cocher</a>
		      		&nbsp;&nbsp; pour la s&eacute;lection :
		        	<input type="submit" name="Submit2" value="Ecrire un message">
	      		</td>
	    	</tr>
		</table>
  	<?php 	
		}elseif($mot_cle !="UNDEFINED" ) echo("Aucun usager n'est trouv&eacute;")
	?>
	</form>
	<p>&nbsp;</p>
</div>


