<?php
require_once("../../config/config.inc.php");

 include_once($LEA_REP."Enseignant/secure.php");

include($LEA_REP.'espace_de_partage/aide.php');
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html
	xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<!-- InstanceBegin template="/Templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>LEA: Configuration</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- #BeginEditable "Meta" -->
<meta name="special" content="" />
<!-- #EndEditable -->
<link rel="stylesheet" type="text/css" media="screen"
	href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>" />
<link rel="stylesheet" type="text/css" media="screen"
	href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>" />
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
<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
<script type="text/javascript"	src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
<script type="text/javascript"	src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
<script type="text/javascript"	src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
</head>
<?php
if (isset($_SESSION['nb_smiley'])) {
	echo '<body onload="loadsmiley('.$_SESSION['nb_smiley'].')">';
} else {
	echo '<body>';
}
?>
<div id="box2" style="display: none"><?php include($LEA_REP.'Enseignant/sel_formation.php'); ?>
</div>
<?php
// Listes des boites d'aide
// $fp_aide = fopen($LEA_URL."espace_de_partage/aide.csv","r");
for($i=0; $i<50; $i++) {
	$i_tmp = (strlen($i) == 1) ? "0".$i : $i;
	echo "
		<div id=\"aide_".$i_tmp."\" class=\"boxaide\" style=\"display:none\">
			".afficher_aide($i)."
		</div>";
}
//fclose($fp_aide);
?>
<div
	id="<?php  if(!isset($_REQUEST['imprimer'])){
	echo("conteneur");
}else {
	echo('truccontenuimpression');
} ?>"><?php
include($LEA_REP.'menu_sous_responsable.php');
?>

<div id="contenu">
<div id="contents"><!-- InstanceBeginEditable name="sous_menu" --> <?php  
include('sous_menu_calendar_periode.php');
include('./config_suivi/sous_menu_config_suivi.php');
include('./config_suivi/sous_menu_config_suivi2.php');

if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
else 						 $cmd="";

switch ($cmd) {
	/***********************************************************/
	/** Options : Menu principal	                           */
	/***********************************************************/
	case "cons_options"  :
		include('cons_options.php');
		break;
	case "modifier_tuteur_apprenti"    :
		include('modifier_tuteur_apprenti.php');
		break;
	case "modifier_liste_enseignants"    :
		include('modifier_liste_enseignants.php');
		break;
	case "liste_periodes"    :
		afficher_sous_menu("liste_periodes");
		include('liste_periodes.php');
		break;
	case "liste_periodes_classe"    :
		afficher_sous_menu("liste_periodes_classe");
		include('liste_periodes_classe.php');
		break;
	case "maj_charte_graphique"    :
		include('./charte_graphique/maj_charte_graphique.php');
		break;
	case "terminologie"  :
		include('terminologie.php');
		break;
		/***********************************************************/
		/** Options : Suivi entreprise	                           */
		/***********************************************************/
	case "suivi_entr":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false")afficher_menu("suivi_entr", "entr");
		include ("./config_suivi/config_suivi_entr.php");
		break;
	case "suivi_guide_entr":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false")afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		$type_suivi = "entr";
		include ("./config_suivi/nouv_arbre.php");
		break;
	case "suivi_libre_entr":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false")afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		$type_suivi = "entr";
		include ("./config_suivi/config_suivi_libre.php");
		break;
		/***********************************************************/
		/** Options : Suivi CFA	                                   */
		/***********************************************************/
	case "suivi_cfa":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false")afficher_menu("suivi_cfa", "cfa");
		include ("./config_suivi/config_suivi_cfa.php");
		break;
	case "suivi_guide_cfa":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		$type_suivi = "cfa";
		include ("./config_suivi/nouv_arbre.php");
		break;
	case "suivi_libre_cfa":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		$type_suivi = "cfa";
		include ("./config_suivi/config_suivi_libre.php");
		break;

		/***********************************************************/
		/** Options : Création de l'arborescence	               */
		/***********************************************************/
	case "maj_arbre":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/maj_arbre.php");
		break;
	case "modifier_arbre":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/modifier_arbre.php");
		break;
	case "supprimer_arbre":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/supprimer_arbre.php");
		break;
	case "vider_arbre":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/supprimer_arbre.php");
		break;
	case "afficher_arbre":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/afficher_arbre.php");
		break;
	case "mode_validation_arbre":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/mode_validation_arbre.php");
		break;
	case "criteres_performance":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/criteres_performance.php");
		break;
	case "param_critere":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/parametrage_critere.php");
		break;
	case "bibliotheque":
		$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
			$suivi="false";
		}else{
			$suivi="true";
		}

		if($suivi!="false") {
			afficher_menu("suivi_".$_GET['type_suivi'], $_GET['type_suivi']);
		}
		afficher_menu2("suivi_".$_GET['suivi'], $_GET['type_suivi']);
		include ("./config_suivi/dupliquer_arbre.php");
		break;
		/***********************************************************/
	default :
		include('cons_options.php');
		break;
}
?> <!-- InstanceEndEditable --></div>
<div id="bottom_box"></div>
</div>
<?php include($LEA_REP."footer.php")?></div>
</body>
<!-- InstanceEnd -->
</html>
