<?php
/***********************************************************/  
  // Auteur : GOYER FrÃ©dÃ©ric
  // Version : 1.0.2
  // Date: 05/07
/***********************************************************/
include_once("./secure.php");

require_once("../config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
/***********************************************************/
/***
 * Fonction d'affichage des mots de passe
 */
function Affich() {
	
	$config_term = new Terminologie();
	$config_term->set_detail();
	echo "<div id='m_contenu'>";
	$bdd = new Connexion_BDD_LEA();	
	$unite = new Unite_pedagogique(0); 
	$les_id_formations = $bdd->get_id_formations();
	//
	if(isset($_GET['id_for_sel'])) {
		$id_for_select = $_GET['id_for_sel'];
		$formation = new Formation($id_for_select);
		$les_classes =  $formation->get_classes();
	} else{
		$id_for_select = 0;
		$formation = new Formation($id_for_select);
		$les_classes =  $formation->get_classes();
	}
	//
	if(isset($_GET['id_cla_sel'])) {
		$id_cla_select = $_GET['id_cla_sel'];
		$classe_select = new Classe($id_cla_select);
		$classe_select->set_detail();
		$les_apprentis = $classe_select->get_apprentis();
	}
	
	echo "<br><form name='forForm' action='?'  method='GET'>
			<input type='hidden' name='cmd' value='affich'>";		
	echo"<select name='id_for_sel' size='1' onChange='this.form.submit()' >
			<option value='-1' selected >-- S&eacute;lectionnez ".$config_term->terminologie_formation." --</option>";
	//Boucle de recuperation des formations
	foreach($les_id_formations as $id_for){
		$formation = new Formation($id_for);
		$formation->set_detail();
		$nom = $formation->nom;
				  
		if($formation->id_for == $id_for_select) $selected = "selected";
		else $selected = "";
	
		echo"<option value='".$id_for."' ".$selected." >".$nom."</option>";				
	}
	echo"</select></form>";
	
	if(isset($_GET['id_for_sel'])){
		echo "<br><form name='forForm' action='?'  method='GET'>
				<input type='hidden' name='cmd' value='affich'>
				<input type='hidden' name='id_for_sel' value='".$_GET['id_for_sel']."'>";
		echo"<select name='id_cla_sel' size='1' onChange='this.form.submit()' >
				<option value='-1' selected >-- S&eacute;lectionnez ".$config_term->terminologie_classe." --</option>";	
		//Boucle de recuperation des classes
		foreach($les_classes as $classe){
			if($classe->id_cla == $id_cla_select) $selected = "selected";
			else $selected = "";
		
			echo"<option value='$classe->id_cla' $selected > $classe->libelle </option>";				
		}
		echo"</select></form>";
	}
	//affichage du tableau si la formation et la classe sont selectionnÃ©es
	if(isset($_GET['id_cla_sel']) && isset($_GET['id_for_sel'])) {
		echo" <table>
			<tr>
				<th width='20%'>Titre</th>
				<th width='20%'>Nom</th>
	    		<th width='20%'>Prenom</th>
	    		<th width='20%'>Login</th>
				<th width='20%'>Pass</th>
			</tr>
			</table>";
		foreach($les_apprentis as $apprenti){          		   
			$ma = new Maitre_apprentissage($apprenti->id_ma);
			$ma->set_detail();
			
			$tuteur = new Enseignant($apprenti->id_ens);
			$tuteur->set_detail(); 
			
			$rl = new Representant_legal($apprenti->id_rl);
			$rl->set_detail();
			
			echo "<table class='alter'><tr>
					<td width='20%'>".$config_term->terminologie_app."</td>
					<td width='20%'>".$apprenti->nom."</td>
					<td width='20%'>".$apprenti->prenom."</td>
					<td width='20%'>".$apprenti->login."</td>
					<td width='20%'>".$apprenti->mdp."</td>
					  	</tr>";
	if($_SESSION['parent']!="false"){echo"	  	<tr>
				<td class='alter'>".$config_term->terminologie_rl."</td>
				<td class='alter'>".$rl->nom."</td>
				<td class='alter'>".$rl->prenom."</td>
				<td class='alter'>".$rl->login."</td>
				<td class='alter'>".$rl->mdp."</td>
		  	</tr>";
			
			}
			
		  echo"	<tr>
					<td>".$config_term->terminologie_tuteur_cfa."</td>
					<td>".$tuteur->nom."</td>
					<td>".$tuteur->prenom."</td>
					<td>".$tuteur->login."</td>
					<td>".$tuteur->mdp."</td>
				  </tr>
				  <tr>
					<td class='alter'>".$config_term->terminologie_ma."</td>
					<td class='alter'>".$ma->nom."</td>
					<td class='alter'>".$ma->prenom."</td>
					<td class='alter'>".$ma->login."</td>
					<td class='alter'>".$ma->mdp."</td>
				  </tr></table>"; 
		}	
	}
	echo "</div>";		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Madministrateur.dwt" codeOutsideHTMLIsLocked="false" -->
<head>				
<!-- InstanceBeginEditable name="doctitle" -->
<!-- <title>LEA Administrateur</title> -->
	<title>LEA: Affichage des mots de passe</title>
<!-- InstanceEndEditable -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
<!-- #BeginEditable "meta" -->
	<meta name="special" content="" />		
<!-- #EndEditable -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"  />
<?php 
	if(isset($_REQUEST['imprimer'])) {
	echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print_preview.css\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"".$LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/print.css\" />";
}
?>	
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
	<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js');?>"></script>		
</head>	
<body>
<div  id="<?php  if(!isset($_REQUEST['imprimer'])){
						echo("conteneur");
					}else {
						echo('truccontenuimpression');
					} ?>">
<?php include($LEA_REP.'menu_administrateur.php'); ?>
	<div id="contenu">										
		<div id="contents">
			<div id="top_l"></div>
			<div id="top_m">
				<h1><span class="orange">A</span>ffichage des mots de passe</h1>
			</div>
			<div id="top_r"></div>
<!-- InstanceBeginEditable name="sous_menu" -->
			<script  src="../../javascript/test_formulaire.js"></script>
			<script language="JavaScript" type="text/javascript" src="../../javascript/stdlib.js"></script>   
	        <?php                                      	
				if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
				else 						 $cmd="";			
						
				switch ($cmd) {		
					case "affich":							  	 
						Affich();
						break;
					default : 
						break;					  	        				
				}		
			?>
 <!-- InstanceEndEditable -->
		</div>
		<div id="bottom_box"></div>   
	</div>	
	<?php include($LEA_REP."footer.php")?>					
</div>
</body>
<!-- InstanceEnd -->
</html>