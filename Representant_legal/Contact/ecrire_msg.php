<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/08/05
/***********************************************************/
include_once('../secure.php');
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

/***********************************************************/
$parent = new Representant_legal($_SESSION['id_rl']);	

$les_id_apprentis = $parent->get_id_apprentis();

$REP_PHOTOS="../../Apprenti/Photos/";

if(isset($_REQUEST['id_app_select'])) { 	
	$id_app_select = $_REQUEST['id_app_select'];
}
elseif(count($les_id_apprentis) > 0 ) $id_app_select = $les_id_apprentis[0];
else $id_app_select = 0;



if($id_app_select > 0) {

	$apprenti_select = new Apprenti($id_app_select);	
	$apprenti_select->set_detail();
	$classe = $apprenti_select->get_classe();		
    $config_lea = $apprenti_select->get_config_lea();
				
	if($_SESSION['id_rl']!= $apprenti_select->id_rl){ 
			html_refresh("../accueil.php");
			exit();
	}		
	
	$formation = $apprenti_select->get_formation();		
	$unite = new Unite_pedagogique($formation->id_unite);
	$unite->set_detail(); // l'unité fréquenté par l'apprenti
	$les_id_responsables = $unite->get_id_responsables();
	
	if(count($les_id_responsables) > 0) $id_rvs = $les_id_responsables[0];
	else $id_rvs =0;
	
	$rvs =  new Usager($id_rvs);
	$rvs->set_detail();
	
	$id_tuteur = $apprenti_select->id_ens; //tuteur de l'apprenti
	$tuteur = new Enseignant($id_tuteur);
	$tuteur->set_detail();
	
	$id_ma = $apprenti_select->id_ma;
	$maitre = new Maitre_apprentissage($id_ma);
	$maitre->set_detail();
	
	$formation = $apprenti_select->get_formation();
	$responsable = $formation->get_responsable(); // le responsable de la formation de l'apprenti
}
?>
<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">É</span>crire un message</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">

  <?php 
  	if (count($les_id_apprentis) > 0) {
   ?>

<form name="theForm" method="post" action="<?php echo $LEA_URL; ?>Representant_legal\Contact\contact.php?cmd=ecrire_msg" >
  <select name="id_app_select" 
					onChange="if(document.theForm.id_app_select.selectIndex!=0) document.theForm.submit();">
   
    <?php 							
				
			foreach($les_id_apprentis as $id_app){
		         $apprenti = new Apprenti($id_app);		  
				 $apprenti->set_detail();
				if($apprenti->id_app==$id_app_select) $selected="selected";
				else $selected="";	 
				 
		  echo"<option value='$id_app' $selected> $apprenti->nom &nbsp;&nbsp; $apprenti->prenom</option>";
		  }
		  ?>
  </select>
</form>

<?php if($id_app_select > 0) { ?>

<table width="100%" height="142" cellspacing="0">
  <tr >
    <th height="21" colspan="3">Communiquer avec</th>
  </tr>
  <tr >
    <td height="26" class="sous_titre_tableau">La vie scolaire</td>
    <td class="bordure"><p>
        <?php 
				if($rvs->id_usager > 0) {
					
				 	 afficher_boutton_ecrire_msg("Ecrire un message", $rvs->id_usager);
					 echo"au $rvs->nom $rvs->prenom";
				 
				} 
					
	?>
      </p>
    </td>
    <td width="28%" rowspan="5" align="center" valign="middle"> <img src='<?php echo($REP_PHOTOS.$apprenti_select->src_photo) ?>' width="120"> </td>
  </tr>
  <tr >
    <td width="43%" height="22" class="bordure" ><?php echo("Son ".$config_lea->appelation_tuteur_cfa);?> </td>
    <td width="57%" class="bordure">
      <p>
        <?php 
				if($tuteur->id_ens > 0) {
					
				 	 afficher_boutton_ecrire_msg("Ecrire un message", $tuteur->id_ens);
					 echo" au $tuteur->nom $tuteur->prenom";
				 
				} 
					
	?>
      </p>
    </td>
    </tr>
  <tr >
    <td height="27" class="bordure" >Son repr&eacute;sentant l&eacute;gal</td>
    <td class="bordure">
      <p>
        <?php 
				if($maitre->id_ma > 0){
					
				 	afficher_boutton_ecrire_msg("Ecrire un message",$maitre->id_ma);
					echo"au $maitre->nom $maitre->prenom";
					
				}
						
				?>
      </p>
    </td>
    </tr>
  <tr>
    <td height="26" class="bordure" >Le responsable de sa formation </td>
    <td class="bordure">
      <p>
        <?php 
				if($responsable->id_ens > 0 ) {					
			 		afficher_boutton_ecrire_msg("Ecrire un message", $responsable->id_ens);
					echo"au $responsable->nom $responsable->prenom";
				}	
					
				?>
      </p>
    </td>
    </tr>
  <tr>
    <td height="21" class="bordure" >Votre apprenti</td>
    <td class="bordure">
      <p>
        <?php 			
					afficher_boutton_ecrire_msg("Ecrire un message",$apprenti_select->id_app);
					echo"au $apprenti_select->nom &nbsp; $apprenti_select->prenom";
		?>
      </p>
    </td>
    </tr>
</table>
<?php 
	 }		

}else  echo"Cette annee, vous ne suivez aucun apprenti ";

?>
            </div>
