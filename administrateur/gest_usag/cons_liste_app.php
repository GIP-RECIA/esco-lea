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

require_once($LEA_REP."modele/bdd/classe_terminologie.php");


if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
/***********************************************************/

$bdd = new Connexion_BDD_LEA();

$les_classes = $bdd->get_classes(); 

if ( isset($_REQUEST['lettre']) ) $mot_cle = $_REQUEST['lettre']; 
elseif (isset($_REQUEST['mot_cle']) )  $mot_cle = $_REQUEST['mot_cle'];
else $mot_cle='A';
 	
if (isset($_REQUEST['id_cla'])) {
		$id_cla_select = $_REQUEST['id_cla'];
		$classe_select = new Classe($id_cla_select);
		$classe_select->set_detail();
		$les_apprentis = $classe_select->get_apprentis(); 
}		
else{ 
	$id_cla_select = '-1'; // aucune classe n'est sï¿½lectionnï¿½es.
	$les_apprentis = $bdd->get_usagers(0,100000, "app", $mot_cle);		
	$nb = $bdd->get_nb_usagers("app"); // le nombre total d'apprentis
}	

function afficher_liste_apprentis($tab_apprentis) {
    
	$config_term = new Terminologie();
	$config_term->set_detail();
	global $id_cla_select;
	global $LEA_URL;
	global $LEA_REP;
	global $URL_THEME;
	$nb_apprentis = count($tab_apprentis);

	echo"<p> Liste ".$config_term->terminologie_app." ( ".$nb_apprentis." ) </p>";
	echo"<table width='100%' >			 
    		  <tr>
			    	<th width='23%' >Nom / Pr&eacute;nom </th>
						<th width='17%'> Connexion </th>			    	
						<th width='17%'> ".$config_term->terminologie_classe."</th>
			    	<th width='43%' colspan='3'>Action</th>
       		</tr>";
	foreach($tab_apprentis as $apprenti){
          
		  $classe= new Classe($apprenti->get_id_classe());
		  $classe->set_detail();
		  $fichier_log = $LEA_URL.'log/'.$apprenti->id_app.'.log';		 
			
			  if(file_exists($LEA_REP.'log/'.$apprenti->id_app.'.log'))	{
			
			  	$lien_fichier_log = "<a href='$fichier_log' target='_Blank'>
									<img src='".$URL_THEME."images/picto_fichier_log.png' border='0'>
										fichier log
								</a>";
			  }
			  else	 $lien_fichier_log = "" ;
	   echo" <tr>
    	    	<td  class=\"nom\">
					<a href='gest_usag.php?cmd=cons_coordonnees_usager&profil=app&id_app=$apprenti->id_app' class='txt_grand'>
					$apprenti->nom &nbsp;&nbsp;&nbsp;$apprenti->prenom				
					</a>			
				</td>
				<td>$apprenti->date_derniere_connexion ( $apprenti->nombre_connexions )</td>        	
	        	<td >";
	    	    	if($classe->libelle!="") echo"$classe->libelle ";
					else echo"<font color='red' >?</font>";
		 	echo"</td>				
	      		";
 	    	    	
		   echo"
	        	<td><img src='".$URL_THEME."images/picto_edit.png'>
					<a href='gest_usag.php?cmd=form_nouv_usag&profil=app&action=modif&id_app=$apprenti->id_app'>
					Modifier 
					</a>
				</td>
	    	    <td><img src='".$URL_THEME."images/picto_drop.png'>
					<a href='supp_usag.php?id_usager=$apprenti->id_app&src_photo=$apprenti->src_photo&profil=app&id_cla=$id_cla_select' onClick='return deleteConfirm(\"cet ".$config_term->terminologie_app."\")'>
					Supprimer 
					</a>					
				</td>			
	    	    <td>
						$lien_fichier_log					
				</td>			

    	  	</tr>";
		}//fin foreach
if ($id_cla_select > 0) {		  
  
  echo"  <tr>
		    <th colspan='2'>
			
		  &nbsp;
					  
	      </th>
		  <th colspan='3'>
      		  <a href='supp_app_classe.php?id_cla=$id_cla_select' 
			  onClick='return deleteConfirm(\"les ".$config_term->terminologie_app." de cette classe\")' >
      		    <img src='../../images/b_drop.png' border=0>
				Tout supprimer
           	  </a>
		  </th>
       	</tr>";
}		
  	echo"</table>";	
	
}// fin de la fonction
	
 ?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">G</span>&eacute;rer <?php echo($config_term->terminologie_app); ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
<?php Afficher_recherche("gest_usag.php", $mot_cle, array("cmd" =>"cons_liste_app")); ?>
<form name="theForm" action="gest_usag.php"  method="GET">
	<input type='hidden' name='cmd' value='cons_liste_app'>
  	<br>Recherche par <?php echo($config_term->terminologie_classe); ?> :
	<?php 			  			  
		echo" <select name='id_cla' onChange='this.form.submit()'>";
		echo"<option value='0' > --- Choisir une classe ---- </option>";			 
	 	if (count($les_classes) > 0){	 	
		 	foreach ($les_classes as $classe){				  			  
				if ($classe->id_cla == $id_cla_select) $selected = "selected";
				else $selected = "";
				echo" <option value='$classe->id_cla' $selected> $classe->libelle </option>";			  
		 	}
		}				  				
		echo" </select>";				  
	?>
	</form>
<br><p>
<?php 
	echo"<input type=\"button\" value=\"Ajout ".$config_term->terminologie_app."\" onclick=\"document.location='gest_usag.php?cmd=form_nouv_usag&profil=app&action=nouv'\" />";
	
	echo"<input type=\"button\" value=\"Importer ".$config_term->terminologie_app."\" onclick=\"document.location='../import/import.php?cmd=import_app'\" />";	 	
?>
<?php
	if(count($les_apprentis) > 0) {
		if($id_cla_select!= -1){
		 	echo"<input type=\"button\" value=\"Imprimer les mots de passe\" onclick=\"document.location='imprimer_mdp.php?id_cla=".$id_cla_select."'\" />";		
		} else{
			echo"<input type=\"button\" value=\"Imprimer les mots de passe\" onclick=\"document.location='imprimer_mdp_usagers.php?profil=app&mot_cle=".$mot_cle."'\" />";
		}	 
	}
?>
</p>
<br>
<p>
  <?php 
	if (count($les_apprentis) > 0) {
		afficher_liste_apprentis($les_apprentis); 
	
	}elseif($id_cla_select!= -1) echo"Aucun ".$config_term->terminologie_app." n'est trouv&eacute;";	
	?>
</p>
</div>
