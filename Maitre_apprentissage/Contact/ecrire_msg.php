<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
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
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");

/***********************************************************/
$maitre = new Maitre_apprentissage($_SESSION['id_ma']);	

$les_apprentis = $maitre->get_apprentis_form($_SESSION['id_for']);

$REP_PHOTOS="../../Apprenti/Photos/";

if(isset($_REQUEST['id_app_select'])) { 	
	$id_app_select = $_REQUEST['id_app_select'];
}
elseif(count($les_apprentis) > 0 ) $id_app_select = $les_apprentis[0]->id_app;
else $id_app_select = 0;

$config_term = new Terminologie();
$config_term->set_detail();

if($id_app_select > 0) {

	$apprenti_select = new Apprenti($id_app_select);	
	$apprenti_select->set_detail();
	$classe = $apprenti_select->get_classe();		
    $config_lea = $apprenti_select->get_config_lea();
				
	if($_SESSION['id_ma']!= $apprenti_select->id_ma){ 
			html_refresh("../accueil.php");
			exit();
	}		
	
	$formation = $apprenti_select->get_formation();		
	$unite = new Unite_pedagogique($formation->id_unite);
	$unite->set_detail(); // l'unitï¿½ frï¿½quentï¿½ par l'apprenti
	$les_id_responsables = $unite->get_id_responsables();
	
	if(count($les_id_responsables) > 0) $id_rvs = $les_id_responsables[0];
	else $id_rvs =0;
	
	$rvs =  new Usager($id_rvs);
	$rvs->set_detail();
	
	$id_tuteur = $apprenti_select->id_ens; //tuteur de l'apprenti
	$tuteur = new Enseignant($id_tuteur);
	$tuteur->set_detail();
	
	$id_rl = $apprenti_select->id_rl;
	$parent = new Representant_legal($id_rl);
	$parent->set_detail();
	
	$formation = $apprenti_select->get_formation();
	$responsable = $formation->get_responsable(); // le responsable de la formation de l'apprenti
}
?>
<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">E</span>crire un message</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">

  <?php 
  	if (count($les_apprentis) > 0) {
   ?>

<form name="theForm" method="post" action="<?php echo $LEA_URL; ?>Maitre_apprentissage/Contact/contact.php?cmd=ecrire_msg">
  <select name="id_app_select" 
					onChange="if(document.theForm.id_app_select.selectIndex!=0) document.theForm.submit();">
   
    <?php 							
				
			foreach($les_apprentis as $apprenti){
		         		  
				if($apprenti->id_app==$id_app_select) $selected="selected";
				else $selected="";	 
				 
		  echo"<option value='$apprenti->id_app' $selected> $apprenti->nom &nbsp;&nbsp; $apprenti->prenom</option>";
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
    <td height="26" class="sous_titre_tableau"><?php echo $config_term->terminologie_rvs; ?></td>
    <td class="bordure"><p>
        <?php 
				if($rvs->id_usager > 0) {
					
				 	 afficher_boutton_ecrire_msg("Ecrire un message", $rvs->id_usager);
					 echo"a $rvs->nom $rvs->prenom";
				 
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
					 echo" a $tuteur->nom $tuteur->prenom";
				 
				} 
					
	?>
      </p>
    </td>
    </tr>
  <tr >
    <td height="27" class="bordure" ><?php echo("Son ".$config_lea->appelation_rl);?></td>
    <td class="bordure">
      <p>
        <?php 
				if($parent->id_rl > 0){
					
				 	afficher_boutton_ecrire_msg("Ecrire un message",$parent->id_rl);
					echo"a $parent->nom $parent->prenom";
					
				}
						
				?>
      </p>
    </td>
    </tr>
  <tr>
    <td height="26" class="bordure" ><?php echo $config_term->terminologie_rf; ?> </td>
    <td class="bordure">
      <p>
        <?php 
				if($responsable->id_ens > 0 ) {					
			 		afficher_boutton_ecrire_msg("Ecrire un message", $responsable->id_ens);
					echo"a $responsable->nom $responsable->prenom";
				}	
					
				?>
      </p>
    </td>
    </tr>
  <tr>
    <td height="21" class="bordure" >Votre <?php echo($config_lea->appelation_app);?></td>
    <td class="bordure">
      <p>
        <?php 			
					afficher_boutton_ecrire_msg("Ecrire un message",$apprenti_select->id_app);
					echo"a $apprenti_select->nom &nbsp; $apprenti_select->prenom";
		?>
      </p>
    </td>
    </tr>
</table>
<?php 
	 }		

}else  echo"Cette ann&eacute;e, vous ne suivez aucun $config_lea->appelation_app ";

?>
            </div>
