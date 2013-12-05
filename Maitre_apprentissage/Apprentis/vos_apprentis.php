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
			  <h1><span class="orange">V</span>otre suivi</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">

  <?php 
  	if (count($les_apprentis) > 0) {
   ?>

<form name="theForm" method="get" action="">
  <select name="id_app_select" 
					onChange="this.form.submit();">
  
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

<table width="100%" height="368" cellspacing="0">
  <tr >
    <th colspan="3">type de suivi</th>
  </tr>
  <tr >
    <td height="50" colspan="3">
    	<a href='<?php echo"apprentis.php?cmd=cons_dec_app&id_app_select=$id_app_select&type_suivi=cfa"?>'>
    		<img src="<?php echo $URL_THEME."images/picto_suivi_cfa.png" ?> " border="0"> 
    		<?php echo $config_lea->appelation_suivi_cfa; ?>
    	</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
 <?php   require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
$bdd=new Connexion_BDD_LEA();
$sql="select id_cla from les_apprentis where id_app='$id_app_select'";
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

 if($suivi!="false") {   	?><a href='<?php echo"apprentis.php?cmd=cons_dec_app&id_app_select=$id_app_select&type_suivi=entr"?>' >
      		<img src="<?php echo $URL_THEME."images/picto_suivi_entreprise.png" ?> " border="0"> 
      		<?php echo $config_lea->appelation_suivi_entr; ?> 
      	</a> <?php   }   ?>
	</td>
  </tr>
  <tr >
    <th colspan="3">Ses coordonn&eacute;es</th>
  </tr>
  <tr >
    <td width="30%" height="24">Titre</td>
    <td width="42%"><p class="txt_gras"><?php echo"$apprenti_select->civilite" ?></td>
    <td width="28%" rowspan="5" align="center" valign="middle"> <img src='<?php echo($REP_PHOTOS.$apprenti_select->src_photo) ?>' width="120"> </td>
  </tr>
  <tr >
    <td height="26">Nom</td>
    <td><p class="txt_gras"><?php echo"$apprenti_select->nom" ?></p>
    </td>
  </tr>
  <tr >
    <td height="27">Pr&eacute;nom</td>
    <td><p class="txt_gras"><?php echo"$apprenti_select->prenom" ?></p>
    </td>
  </tr>
  <tr >
    <td height="22">Date de naissance</td>
    <td><p ><?php echo(trans_date($apprenti_select->date_nais)); ?></td>
  </tr>
  <tr>
    <td height="22">T&eacute;l&eacute;phone fixe</td>
    <td><p ><?php echo"$apprenti_select->tel_fixe" ?></p>
    </td>
  </tr>
  <tr >
    <td>T&eacute;l&eacute;phone portable</td>
    <td colspan="2"><p class="txt_gras"><?php echo"$apprenti_select->tel_mobile" ?></td>
  </tr>
  <tr >
    <td height="36">Adresse</td>
    <td colspan="2"><p class="txt_gras"><?php echo"$apprenti_select->adresse" ?></td>
  </tr>
  <tr >
    <td height="26">E-mail</td>
    <td colspan="2"> <a href='mailto:<?php echo"$apprenti_select->email" ?>'><?php echo"$apprenti_select->email" ?></a></td>
  </tr>
  <tr >
    <td height="22">Diplomes obtenus</td>
    <td colspan="2"><p class="txt_gras"><?php echo"$apprenti_select->diplomes_obtenus" ?></td>
  </tr>
  <tr >
    <td height="27">Date de d&eacute;but du contrat</td>
    <td colspan="2"><p><?php echo(trans_date($apprenti_select->date_debut_contrat)); ?></p>
    </td>
  </tr>
  <tr >
    <td>Date de fin du contrat </td>
    <td colspan="2"><p><?php echo(trans_date($apprenti_select->date_fin_contrat)); ?></p>
    </td>
  </tr>
</table>
<table width="100%" height="183"  class="bordure">
  <tr>
    <th height="26" colspan="2" class="titre_tableau">Communiquer avec </th>
  </tr>
  <tr>
    <td height="22" class="sous_titre_tableau"><?php echo $config_term->terminologie_rvs; ?></td>
    <td><p><?php  			
					afficher_boutton_ecrire_msg("Ecrire un message", $id_rvs);
			?>
		</p>	
    </td>
  </tr>
  <tr>
    <td width="43%" height="22" ><?php echo($config_lea->appelation_tuteur_cfa);?> </td>
    <td width="57%">
      <p>
        <?php 
				if($tuteur->id_ens > 0)
			 	 echo"<a href='apprentis.php?cmd=cons_coordonnees_ens&id_ens_select=$tuteur->id_ens'>
			  			$tuteur->nom &nbsp;&nbsp; $tuteur->prenom
					 </a>";
					
				?>
      </p>
    </td>
  </tr>
  <tr>
    <td height="27" ><?php echo $config_lea->appelation_rl; ?></td>
    <td>
      <p>
        <?php 
				if($parent->id_rl > 0)
			 	echo"<a href='apprentis.php?cmd=cons_coordonnees_rl&id_rl_select=$parent->id_rl'>
			  			$parent->nom &nbsp;&nbsp; $parent->prenom
					 </a>";
					
				?>
      </p>
    </td>
  </tr>
  <tr>
    <td height="26" ><?php echo $config_term->terminologie_rf; ?></td>
    <td>
      <p>
        <?php 
				if($responsable->id_ens > 0 )
			 	 echo"<a href='apprentis.php?cmd=cons_coordonnees_ens&id_ens_select=$responsable->id_ens'>
			  			$responsable->nom &nbsp;&nbsp; $responsable->prenom
					 </a>";
					
				?>
      </p>
    </td>
  </tr>
  <tr>
    <td height="21" ><?php echo"$apprenti_select->nom &nbsp; $apprenti_select->prenom" ?>	</td>
    <td>
      <p>
        <?php 			
					afficher_boutton_ecrire_msg("Ecrire un message",$apprenti_select->id_app);
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
