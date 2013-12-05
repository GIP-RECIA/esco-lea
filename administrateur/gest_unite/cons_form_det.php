<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: Cette page contient le detail d'une formation d'identifiant $id_for
/***********************************************************/
include_once("../secure.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

/***********************************************************/
 
if (isset($_REQUEST['id_for'])) $id_for=$_REQUEST['id_for'];
else {html_refresh("../accueil.php"); exit();}

$formation = new Formation($id_for);
$formation->set_detail();
$responsable = $formation->get_responsable();
$unite =  new Unite_pedagogique($formation->id_unite);
$unite->set_detail();

$repertoire = $LEA_URL."documents/"; // le repertoire ou se trouve la fiche mï¿½tier	 
 		 
		 $modifier_formation="		
	<img src='../../images/b_edit.png'>
	<a href='gest_unite.php?cmd=nouv_form&id_for=".$id_for."'> 
		Modifier 
	</a>";
					 	
		 $voir_classes="
	<img src='../../images/b_browse.png'>
	<a href='gest_unite.php?cmd=cons_clas&id_for=".$formation->id_for."'>
		Voir les ".$config_term->terminologie_classe."s 
    </a>";

 ?>		
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>onsulter : <?php echo $config_term->terminologie_formation; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu"> 
	<table width="76%" cellspacing="0" >
	  	<tr>
	    	<th height="23" colspan="2" class="titre_tableau">Fiche d'information</th>
	  	</tr>
	  	<tr>
	    	<td height="35" class="sous_titre_tableau">Nom <?php echo $config_term->terminologie_unit_pedag; ?></td>
	    	<td>
	        <?php 
				echo"<a href='gest_unite.php?cmd=cons_unite_det&id_unite=".$unite->id_unite."'>
					".$unite->nom." 
				</a>";
			?>
	    	</td>
	  	</tr>
	  	<tr>
	    	<td width="38%" height="35" class="sous_titre_tableau">Nom <?php echo $config_term->terminologie_formation; ?></td>
	    	<td width="62%"><?php  echo $formation->nom; ?></td>
	  	</tr>
	  	<tr>
	    	<td height="31" class="sous_titre_tableau">Nombre de semestres</td>
	    	<td><?php  echo $formation->nb_semestres; ?></td>
	  	</tr>
	  	<tr>
	    	<td height="34" class="sous_titre_tableau">Secteur</td>
	    	<td><?php  echo $formation->secteur; ?></td>
	  	</tr>
	  	<tr>
	    	<td height="29" class="sous_titre_tableau">Niveau</td>
	    	<td><?php  echo $formation->niveau; ?></td>
	  	</tr>
	  	<tr>
	    	<td height="35" class="sous_titre_tableau"><?php echo $config_term->terminologie_tuteur_cfa; ?></td>
	    	<td>
	        <?php 
				echo"
				<a href='../gest_usag/gest_usag.php?cmd=cons_coordonnees_usager&profil=ens&id_ens=".$responsable->id_ens."'>
					".$responsable->nom."&nbsp;&nbsp;".$responsable->prenom." 
				</a>";		 
			?>
	    	</td>
	  	</tr>
	</table>
	<?php
		echo $voir_classes;
		echo $modifier_formation;
	?>
</div>