<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: sous menu du module du livret de l'apprenti

/*  Cette fonction permet d'afficher le sous menu du livret
*/
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
 require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

function afficher_sous_menu($selected_rubrique) {
	global $URL_THEME;
	global $LEA_URL;
 	$apprenti = new Apprenti($_SESSION['id_app']);
	$apprenti->set_detail();
	$config_lea = $apprenti->get_config_lea();
	$config_term = new Terminologie();
	$config_term->set_detail();
?>
<div id="sousMenu">
	<ul>
	    
    <li>
		<a <?php if ($selected_rubrique=="cons_dec") echo" class=\"selected\"" ?> href="livret.php?cmd=cons_dec" >Vos d&eacute;clarations</a>	
	</li>
	<li>
		  <a <?php if ($selected_rubrique=="nouv_dec_cfa") echo" class=\"selected\"" ?> href='livret.php?cmd=nouv_dec&type_suivi=cfa' >Nouvelle d&eacute;claration <?php echo $config_term->terminologie_cfa; ?></a>
	</li>
  <?php  
$bdd=new Connexion_BDD_LEA();
$app=$_SESSION['id_app'];
$sql="select id_cla from les_apprentis where id_app='$app'";
$res=$bdd->executer($sql);
if ($ligne = mysql_fetch_assoc($res)) {
$cla=$ligne['id_cla'];
$sql="select id_for from les_classes where id_cla='$cla'";
$res=$bdd->executer($sql);
if ($ligne = mysql_fetch_assoc($res)) {
$for=$ligne['id_for'];
}}
$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$for'";
$res=$bdd->executer($sql);
if(mysql_num_rows($res)==1){
$suivi="false";
}else{
$suivi="true";
}

 if($suivi!="false") {   	?>   <li>
		<a <?php if ($selected_rubrique=="nouv_dec_entr") echo" class=\"selected\"" ?> href='livret.php?cmd=nouv_dec&type_suivi=entr'>Nouvelle d&eacute;claration <?php echo $config_lea->appelation_entr; ?></a>
	</li> <?php  }  ?>
    <li>
		<a <?php if ($selected_rubrique=="bilan_app") echo" class=\"selected\"" ?> href="livret.php?cmd=bilan_app" >Synth&egrave;se</a>
	</li>
	</ul>
</div>
<?php
}

?>
