<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Ce script permet d'affcher la liste des apprentis de la classe d'identifiant 
  //          id_cla passï¿½ en paramï¿½tre. 
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");

/***********************************************************/
$unite = new Unite_pedagogique($_SESSION['id_unite']);
$bdd = new Connexion_BDD_LEA();

$les_classes = $unite->get_classes(); 
	
if (isset($_REQUEST['id_cla'])) $id_cla_select = $_REQUEST['id_cla'];
elseif(count($les_classes) > 1) $id_cla_select = $les_classes[0]->id_cla;
else $id_cla_select = '-1'; // aucune classe n'est sï¿½lectionnï¿½es.

if($id_cla_select!='0') { // on veut afficher que les apprentis de la classe sï¿½lectionnï¿½e
	$classe_select = new Classe($id_cla_select);
	$classe_select->set_detail();
	$les_apprentis = $classe_select->get_apprentis(); // les identifiant des apprentis affectï¿½s ï¿½ cette classe
}else {	
	$les_apprentis = $bdd->get_apprentis_non_affectes(0, 100000);
}
/***
 * 
 */
function afficher_liste_apprentis($tab_apprentis) {
    
	global $id_cla_select;
	$config_term = new Terminologie();
	$config_term->set_detail();
	$nb_apprentis= count($tab_apprentis);
	echo"
<p> Liste ".$config_term->terminologie_app." (".$nb_apprentis.") </p>";
	echo"
	<table width='100%' >
		<tr>
			<th>Nom / Pr&eacute;nom</th>
			<th>T&eacute;l&eacute;phone</th>
        	<th>".$config_term->terminologie_classe."</th>
		    <th >Action</th>
       	</tr>";
    		  
	foreach($tab_apprentis as $apprenti){
		if($id_cla_select == 0){
	  		$classe= new Classe(0);			  	
	  	}else {
	  		$classe= new Classe($apprenti->get_id_classe());
	  		$classe->set_detail();
	  	}	
		 		  
	   	echo" 
		<tr>
    		<td  class=\"nom\">
				<a href='gest_usag.php?cmd=cons_coordonnees_usager&profil=app&id_app=".$apprenti->id_app."' class='txt_grand'>
					".$apprenti->nom."&nbsp;&nbsp;&nbsp;".$apprenti->prenom."				
				</a>			
			</td> 				
	        <td>
				".$apprenti->tel_fixe."										
			</td>      	
	        <td>";
   	    	if($classe->libelle!="") {
				echo
				$classe->libelle;
   	    	}else{
				echo"
				<font color='red' >?</font>";
   	    	}
			
		 	echo"
			</td>					      
	        <td>
				<img src='../../images/b_edit.png'>
				<a href='gest_usag.php?cmd=form_nouv_usag&profil=app&action=modif&id_app=".$apprenti->id_app."'>
					Modifier 
				</a>
			</td>
		</tr>";
	}//fin foreach
		
	echo"  
		<tr>
		    <th colspan='5'>"; 
			if ($id_cla_select > 0){ 
		  		echo "
				<a href=\"../../administrateur/gest_usag/imprimer_mdp.php?id_cla=".$id_cla_select."\">
        			<img src=\"../../images/print.gif\" border=0>
						Imprimer les mots de passe
	            </a>";
			}else{
				 echo"&nbsp;";
			}
	echo"  
			</th>
       	</tr>
	</table>";	
}// fin de la fonction	
?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer : <?php echo $config_term->terminologie_app; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form name="theForm" action="gest_usag.php"  method="GET">
  		<input type='hidden' name='cmd' value='cons_liste_app'>
        Recherche par <?php echo $config_term->terminologie_classe; ?> :
        <?php 			  			  
        	echo" 
			<select name='id_cla' onChange='this.form.submit()'>";
			echo"
				<option value='-1' > </option>";			  
			if (count($les_classes) > 0){
				foreach ($les_classes as $classe){		  			  
					if ($classe->id_cla == $id_cla_select){
						$selected = "selected=\"selected\"";
					}else{
						$selected = "";
					}
			  		echo" 
				<option value='".$classe->id_cla."' ".$selected.">".$classe->libelle."</option>";			  
			  	}//foreach
			 }
			 echo" 
				<option value='0'"; 
			 if ($id_cla_select == 0 ){
				echo "selected=\"selected\"";
			 }
			 echo">Les ".$config_term->terminologie_app."s non affect&eacute;s </option>";				  				
             echo"
			</select>";		  
		?>
	</form>
<?php 
	if (count($les_apprentis) > 0) {
		afficher_liste_apprentis($les_apprentis); 
	}elseif($id_cla_select!= -1) echo"Aucun ".$config_term->terminologie_app." n'est trouv&eacute;";
	echo"
		<input type=\"button\" value=\"Ajouter ".$config_term->terminologie_app."\" 
			onclick=\"document.location='gest_usag.php?cmd=form_nouv_usag&profil=app&action=nouv'\" />";	
	?>
</div>