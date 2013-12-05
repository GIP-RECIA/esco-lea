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
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

/***********************************************************/
$parent = new Representant_legal($_SESSION['id_rl']);	

$les_id_apprentis = $parent->get_id_apprentis();

$REP_PHOTOS="../../Apprenti/Photos/";

if(isset($_REQUEST['id_app_select'])) { 
	
	$id_app_select = $_REQUEST['id_app_select'];
}
elseif(count($les_id_apprentis) > 0) $id_app_select = $les_id_apprentis[0];
else $id_app_select = 0;

if($id_app_select > 0) {

	$apprenti_select = new Apprenti($id_app_select);	
	$apprenti_select->set_detail();
	$classe = $apprenti_select->get_classe();		
    
	if($_SESSION['id_rl']!= $apprenti_select->id_rl){ 
			html_refresh("../accueil.php");
			exit();
	}		
	
	$id_tuteur = $apprenti_select->id_ens; //tuteur de l'apprenti
	$tuteur = new Enseignant($id_tuteur);
	$tuteur->set_detail();
	
	$id_ma = $apprenti_select->id_ma;
	$maitre = new Maitre_apprentissage($apprenti_select->id_ma);
	$maitre->set_detail();
	
	$formation = $apprenti_select->get_formation();
	$responsable = $formation->get_responsable(); // le responsable de la formation de l'apprenti
}
?>
			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">V</span>os apprentis</h1>
			</div><div id="top_r"></div>
<div id="m_contenu">
  <?php 
  	if (isset($les_id_apprentis)) {
   ?>

<form name="theForm" method="get" action="">
  <select name="id_app_select" 
					onChange="if(document.theForm.id_app_select.selectIndex!=0) document.theForm.submit();">
    <option value='0' selected>---- S&eacute;lectionner un apprenti ----</option>
    <?php 							
				
			foreach($les_id_apprentis as $id_app){
		         $apprenti=new Apprenti($id_app);	
	    		 $apprenti->set_detail();		  
				if($id_app==$id_app_select) $selected="selected";
				else $selected="";	  
		  echo"<option value='$id_app' $selected> $apprenti->nom &nbsp;&nbsp; $apprenti->prenom</option>";
		  }
		  ?>
  </select>
</form>
<?php if($id_app_select > 0) { ?>

<table width="100%" height="407" cellspacing="0">
  <tr >
    <th colspan="3">Son livret d'apprentissage</th>
  </tr>
  <tr >
    <td height="50" colspan="3"><a href='<?php echo"apprentis.php?cmd=cons_dec_app&id_app_select=$id_app_select&type_suivi=cfa"?>'><img src="<?php echo $URL_THEME."images/picto_suivi_cfa.png" ?> " border="0"> Suivi
        au CFA</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='<?php echo"apprentis.php?cmd=cons_dec_app&id_app_select=$id_app_select&type_suivi=entr"?>' ><img src="<?php echo $URL_THEME."images/picto_suivi_entreprise.png" ?> " border="0"> Suivi
        en entreprise </a> </td>
  </tr>
  <tr >
    <th colspan="3">Informations Apprenti</th>
  </tr>
  <tr >
    <td width="30%" height="28">Titre</td>
    <td width="42%"><p class="txt_gras"><?php echo"$apprenti_select->civilite" ?></td>
    <td width="28%" rowspan="5" align="center" valign="middle"> <img src='<?php echo($REP_PHOTOS.$apprenti_select->src_photo) ?>' width="120" height="110"> </td>
  </tr>
  <tr >
    <td height="33">Nom</td>
    <td><p class="txt_gras"><?php echo"$apprenti_select->nom" ?></p>
    </td>
  </tr>
  <tr >
    <td height="33">Pr&eacute;nom</td>
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
    <td height="50">Adresse</td>
    <td colspan="2"><p class="txt_gras"><?php echo"$apprenti_select->adresse" ?></td>
  </tr>
  <tr >
    <td height="38">E-mail</td>
    <td colspan="2"> <a href='mailto:<?php echo"$apprenti_select->email" ?>'><?php echo"$apprenti->email" ?></a></td>
  </tr>
  <tr >
    <td height="37">Diplomes obtenus</td>
    <td colspan="2"><p class="txt_gras"><?php echo"$apprenti_select->diplomes_obtenus" ?></td>
  </tr>
  <tr >
    <td>Date de d&eacute;but du contrat</td>
    <td colspan="2"><p><?php echo(trans_date($apprenti_select->date_debut_contrat)); ?></p>
    </td>
  </tr>
  <tr >
    <td>Date de fin du contrat </td>
    <td colspan="2"><p><?php echo(trans_date($apprenti_select->date_fin_contrat)); ?></p>
    </td>
  </tr>
</table>
<table width="100%" height="167"  class="bordure">
  <tr>
    <th height="28" colspan="2" class="titre_tableau">Communiquer avec </th>
  </tr>
  <tr>
    <td width="43%" height="27" class="sous_titre_tableau">Tuteur CFA</td>
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
    <td height="32" >Maitre apprentissage</td>
    <td>
      <p>
        <?php 
				if($maitre->id_ma > 0)
			 	echo"<a href='apprentis.php?cmd=cons_coordonnees_ma&id_ma_select=$maitre->id_ma'>
			  			$maitre->nom &nbsp;&nbsp; $maitre->prenom
					 </a>";
					
				?>
      </p>
    </td>
  </tr>
  <tr>
    <td height="45" >Le responsable de la formation</td>
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
    <td height="21" >Votre apprenti</td>
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

}else  echo"Cette ann&eacute;e, vous ne suivez personne ";

?>

</div>
