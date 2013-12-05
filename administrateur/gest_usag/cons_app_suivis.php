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
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

/***********************************************************/
if(isset($_REQUEST['id_ens'])) $id_ens=$_REQUEST['id_ens'];
elseif(isset($_REQUEST['id_ma'])) $id_ma=$_REQUEST['id_ma'];
elseif (isset($_REQUEST['id_rl'])) $id_rl=$_REQUEST['id_rl'];


if(isset($id_ens)) {
					afficher_sous_menu("cons_liste_ens"); 
					
					$enseignant= new Enseignant($id_ens);
					$enseignant->set_detail();	
					$les_id_apprentis = $enseignant->get_id_apprentis();
					$titre_page="Liste des ".$config_term->terminologie_app." suivis par ".$config_term->terminologie_ens." 
								$enseignant->nom &nbsp; $enseignant->prenom";
					$aucun_apprenti="".$config_term->terminologie_ens." ne suit aucun ".$config_term->terminologie_app."";			
}                  
elseif(isset($id_ma)) {
					afficher_sous_menu("cons_liste_ma"); 
					$ma= new Maitre_apprentissage($id_ma);
					$ma->set_detail();	
					$les_id_apprentis = $ma->get_id_apprentis();
					$titre_page="Liste des ".$config_term->terminologie_app." suivis par ".$config_term->terminologie_ma." 
								$ma->nom &nbsp; $ma->prenom";
					$aucun_apprenti="Le ".$config_term->terminologie_ma." ne suit aucun ".$config_term->terminologie_app."";			
}
elseif(isset($id_rl)) {
					afficher_sous_menu("cons_liste_rl"); 
					$rl= new Representant_legal($id_rl);
					$rl->set_detail(); 	
					$les_id_apprentis = $rl->get_id_apprentis();
					$titre_page="Liste des ".$config_term->terminologie_app." suivis par ".$config_term->terminologie_rl." 
							     $rl->nom &nbsp; $rl->prenom ";
					$aucun_apprenti="Ce ".$config_term->terminologie_rl." n'a aucun ".$config_term->terminologie_app."";			
} 

?>

<div id="top_l"> </div>
<div id="top_m">
	<h1>
	<span class="orange">L</span>iste des <?php echo($config_term->terminologie_app); ?> suivis		
	</h1>
</div>
<div id="top_r"></div>

<div id="m_contenu">
 
 <p>
	<?php echo "$titre_page"?>   
 </p>     
<?php if (isset($les_id_apprentis)) { ?>
	<table width="95%"  >
     	<tr>
	        <th>Nom / Prenom</th>
			<th>Téléphone</th>
        	<th>Classe</th>
		</tr>
		<?php 
			$selected = "selected";
			
			foreach($les_id_apprentis as $id_app){
	    
		      $apprenti=new Apprenti($id_app);	
		      $apprenti->set_detail();		  
			  $classe=$apprenti->get_classe();
			  if($classe->libelle == "") $classe->libelle = "?";
			  
				if($selected == "") $selected="selected";
				else $selected = "";
				
			   echo"<tr class=\"$selected\">
        				<td class=\"nom\">
							<a href=\"gest_usag.php?cmd=cons_coordonnees_usager&profil=app&id_app=$apprenti->id_app\">$apprenti->nom &nbsp;&nbsp;&nbsp;$apprenti->prenom</a>
						</td>        	
			        	<td>$apprenti->tel_fixe</td>
						<td>$classe->libelle</td>
					</tr>";
			}
		?>	  
    </table>
	<?php }else  echo"$aucun_apprenti";	?>

</div>           