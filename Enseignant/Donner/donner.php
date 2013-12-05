<?php
/***********************************************************/
  // Copyright ? 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu:  Ce script permet la mise ? jours de la liste des enseignants de la formation
  // 			dont l'identifiant est enregistr?e dans la session.

/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("config/config.inc.php"))      require_once("config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/

include("../test_responsable.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html
	xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<!-- InstanceBegin template="/Templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>LEA: Donner des droits</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- #BeginEditable "Meta" -->
<meta name="special" content="" />
<!-- #EndEditable -->
<link rel="stylesheet" type="text/css" media="screen" href="

<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>
" />
<link rel="stylesheet" type="text/css" media="screen" href="
<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>

" />

<link href="schema_apprenti.css" rel="stylesheet" type="text/css"
	media="screen" />

<?php
if(isset($_REQUEST['imprimer'])) {
	echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
}
?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<script type="text/javascript" src="

<?php echo($LEA_URL.'javascript/menu.js')?>
">
</script>
<script type="text/javascript" src="

<?php echo($LEA_URL.'javascript/stdlib.js')?>
">
</script>
<script type="text/javascript" src="

<?php echo($LEA_URL.'javascript/mootools.js')?>
">
</script>
<script type="text/javascript" src="

<?php echo($LEA_URL.'javascript/lightbox.js')?>
">
</script>

<script type="text/javascript">
	window.onload = function ()
	{
		var filtre = $('filtre');
		var children = filtre.getChildren();
		for (var i = 0 ; i < children.length ; i++)
		{
			if (children[i].getTag() == 'input')
			{
				var child = children[i];
				child.addEvent('click', function ()
				{
					var tri = $$('tr.tri_' + this.getProperty('value'));
					for (var j = 0 ; j < tri.length ; j++)
					{
						tri[j].setStyle('display', tri[j].getStyle('display') != 'none' ? 'none' : null);
					}
				});
			}
		}
	}
</script>
</head>

<div id="<?php  if(!isset($_REQUEST['imprimer'])){
	echo("conteneur");
}else {
	echo('truccontenuimpression');
} ?>"> <?php
include($LEA_REP.'menu_enseignant.php');
?>

<div id="contenu"><?php
$bdd = new Connexion_BDD_LEA();
$forr=$_SESSION['id_for'];
$sq="select droit from les_sous_resp_droits where id_for='$forr'";
$resul=$bdd->executer($sq);
$dr="";
if(mysql_num_rows($resul)==0){
$sq="select dr_soumis from les_droits where id_droit='sr'";
$result=$bdd->executer($sq);
while($ligne = mysql_fetch_assoc($result)){
$dr=$ligne['dr_soumis'];
}
}else{
while($ligne = mysql_fetch_assoc($resul)){
$dr=$ligne['droit'];
}
}
$les_administrateurs = $bdd->get_usagers(0,10000, "admin"); // les administrateurs lEA
$id_usager_admin = $les_administrateurs[0]->id_usager;

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();


	
	$tous_les_enseignants = $bdd->get_all_usagers_for($_SESSION['id_for']); // tous les enseignants
	//$nb = $bdd->get_nb_usagers('%'); // le nombre total d'enseignants 
		
	$sql="SELECT id_usager FROM les_sous_resp WHERE id_for='$formation->id_for'";
	$result2=$bdd->executer($sql);	
	$les_id_enseignants = array();
	while($ligne2 = mysql_fetch_assoc($result2)){
		$id=$ligne2['id_usager'];
		$sql= "SELECT * FROM les_usagers where id_usager='$id'";
		$result=$bdd->executer($sql);	
	while ($ligne = mysql_fetch_assoc($result)) {
					$id=$ligne['id_usager'];
					/*$usager = new Usager($ligne['id_usager']);
					
						  	           					
					$usager->civilite = $ligne['civilite'];
					$usager->nom = $ligne['nom'];
					$usager->prenom = $ligne['prenom'];
					$usager->adresse = $ligne['adresse'];
					$usager->tel_fixe = $ligne['tel_fixe'];
					$usager->tel_mobile = $ligne['tel_mobile'];
					$usager->email=$ligne['email'];
					$usager->url_site = $ligne['url_site'];
					$usager->date_creation = trans_date($ligne['date_creation']);
					$usager->date_derniere_connexion = trans_date_time($ligne['date_derniere_connexion']);
					$usager->nombre_connexions = $ligne['nombre_connexions'];
					$usager->mode_acces = $ligne['mode_acces'];
					$usager->date_debut_acces = $ligne['date_debut_acces'];
					$usager->date_fin_acces = $ligne['date_fin_acces'];
					$usager->login = $ligne['login'];
					$usager->mdp = $ligne['mdp'];*/
				
					$les_id_enseignants[] = $id;								
				}
	mysql_free_result($result);	
}	
	
 ?>
			<div id="top_l"></div><div id="top_m"><h1><span class="orange">G</span>roupe de concepteurs <?php echo $config_term->terminologie_lea;  ?></h1></div><div id="top_r"></div>
			<div id="m_contenu">

			<!-- Faire avec termino -->
			<div id="filtre">
			
		<?php 	if(ereg('admin',$dr)){	?><label for="check-admin"><?php echo$config_term->terminologie_admin;  ?></label><input type="checkbox" checked="checked" value="admin" id="check-admin" />
		<?php }	if(ereg('rvs',$dr)){	?>		<label for="check-rvs"><?php echo$config_term->terminologie_rvs;  ?></label><input type="checkbox" checked="checked" value="rvs" id="check-rvs" />
		<?php }	if(ereg('ens',$dr)){	?>	<label for="check-ens"><?php echo$config_term->terminologie_ens;  ?></label><input type="checkbox" checked="checked" value="ens" id="check-ens" />
		<?php }	if(ereg('ma',$dr)){	?>		<label for="check-ma"><?php echo$config_term->terminologie_ma;  ?></label><input type="checkbox" checked="checked" value="ma" id="check-ma" />
		<?php }	if(ereg('rl',$dr)){	?>		<label for="check-rl"><?php echo$config_term->terminologie_rl;  ?></label><input type="checkbox" checked="checked" value="rl" id="check-rl" />
		<?php }	if(ereg('app',$dr)){	?>		<label for="check-app"><?php echo$config_term->terminologie_app;  ?></label><input type="checkbox" checked="checked" value="app" id="check-app" />
		<?php } ?>	</div>
<?php 



	if (count($tous_les_enseignants) > 0) {
	
		echo"<form action=\"donner_v.php\" method=\"post\">";
			
		echo"<table>
				
				<tr>
					<th>Nom / Pr&eacute;nom</th>
					<th> Profil   </th>
					<th> </th>
				</tr>";
		foreach($tous_les_enseignants as $enseignant){         
			
			if( in_array ($enseignant->id_usager, $les_id_enseignants) ) {
										 $checked="checked";
										 $selected='selected';
			}						 
			else{ 		
						$checked = "";
						$selected='';
			
			}
			$enseignant->set_detail();
			$chaine = $enseignant->profil;
				$tok = strtok($chaine,",");
				$tokclass="tri_".$tok;
			if(ereg($tok,$dr)){
			echo " 
			<tr class=\"$tokclass\">
				<td>$enseignant->nom &nbsp;$enseignant->prenom</td>        	
				<td>";
			if($tok=="admin")echo $config_term->terminologie_admin;
			if($tok=="ma")echo $config_term->terminologie_ma;
			if($tok=="ens")echo $config_term->terminologie_ens;
			if($tok=="rvs")echo $config_term->terminologie_rvs;
			if($tok=="app")echo $config_term->terminologie_app;
			if($tok=="rl")echo $config_term->terminologie_rl;
			
				 echo"</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name=\"les_id_ens[]\" value=\"$enseignant->id_usager\" $checked /></td>						
			</tr>";
		}
		}//fin foreach
		echo"
			</table>
			<fieldset><input type='submit' value='Valider'></fieldset>";
		echo"</form>";	
}	
?>
</div>
<div id="bottom_box"></div>
</div>
<?php include($LEA_REP."footer.php")?></div>
</body>
<!-- InstanceEnd -->
</html>