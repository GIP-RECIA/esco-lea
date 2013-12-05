<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/08/05
  //Contenu: Ce script permet d'afficher la liste des apprentis suivi par un des usagers suivants
  // 		 - L'enseignant  d'identifiant id_ens
  //         - Le maitre d'apprentissage d'identifiant id_ma
  //         - Le representant légal d'identifiant id_rl 
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

/***********************************************************/
if(isset($_REQUEST['id_ens'])) $id_ens=$_REQUEST['id_ens'];
elseif(isset($_REQUEST['id_ma'])) $id_ma=$_REQUEST['id_ma'];
elseif (isset($_REQUEST['id_rl'])) $id_rl=$_REQUEST['id_rl'];

$unite = new Unite_pedagogique($_SESSION['id_unite']);


if(isset($id_ens)) {
					afficher_sous_menu("cons_liste_ens"); 
					
					$enseignant= new Enseignant($id_ens);
					$enseignant->set_detail();	
					$les_id_apprentis=$enseignant->get_id_apprentis($unite->id_unite);
					$titre_page="Liste des apprentis suivis par l'enseignant 
								$enseignant->nom &nbsp; $enseignant->prenom";
					 $aucun_apprenti="L'enseignant ne suit aucun apprenti";			
}                  
elseif(isset($id_ma)) {
					afficher_sous_menu("cons_liste_ma"); 
					$ma= new Maitre_apprentissage($id_ma);
					$ma->set_detail();	
					$les_id_apprentis=$ma->get_id_apprentis($unite->id_unite);
					$titre_page="Liste des apprentis suivis par le maitre d'apprentissage 
								$ma->nom &nbsp; $ma->prenom";
					$aucun_apprenti="Le maitre d'apprentissage ne suit aucun apprenti";			
}
elseif(isset($id_rl)) {
					afficher_sous_menu("cons_liste_rl"); 
					$rl= new Representant_legal($id_rl);
					$rl->set_detail();	
					$les_id_apprentis = $rl->get_id_apprentis($unite->id_unite);
					$titre_page="Liste des apprentis suivis par le parent 
							     $rl->nom &nbsp; $rl->prenom ";
					$aucun_apprenti="Ce parent n'a aucun apprenti";			
} 
else include("../../erreur.php");
?>
<div id="top_l"> </div>
<div id="top_m">
	<h1>
	<span class="orange">L</span>iste des apprentis suivis		
	</h1>
</div>
<div id="top_r"></div>

<div id="m_contenu">
 
 <p>
	<?php echo "$titre_page"?>   
 </p>  
    
  <?php if (isset($les_id_apprentis)) {
	    ?>

<table>
  <tr >
    <th>Nom / Prenom</td>
    <th>Téléphone</td>
    <th>Classe</td>
  </tr>
  <?php 
  		$selected = "selected";
		
  		foreach($les_id_apprentis as $id_app){
          $apprenti=new Apprenti($id_app);	
	      $apprenti->set_detail();		  
		  $classe=$apprenti->get_classe();
		  if($classe->libelle=="") $classe->libelle="?";
			
			if($selected == "") $selected="selected";
			else $selected = "";
				
	  echo"<tr class=\"$selected\">
        	<td class=\"nom\" >
				<a href='gest_usag.php?cmd=cons_coordonnees_usager&profil=app&id_app=$apprenti->id_app' class='txt_grand'>
				$apprenti->nom &nbsp;&nbsp;&nbsp;$apprenti->prenom				
				</a>			
			</td>
        	
        	<td>$apprenti->tel_fixe</td>
			<td>$classe->libelle</td>        
						
      	</tr>";
	}
	?>
</table>
<?php 
	}else  echo"$aucun_apprenti";
	
	?>
</div>