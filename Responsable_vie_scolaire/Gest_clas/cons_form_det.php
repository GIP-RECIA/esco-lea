<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: Cette page contient le detail d'une formation d'identifiant $id_for
/***********************************************************/
include_once("../secure.php");

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
$enseignant = $formation->get_responsable();

$repertoire = $LEA_URL."documents/"; // le repertoire ou se trouve la fiche métier	 
 		 
		 $modifier_formation="		
					   	 		   <img src='../../images/b_edit.png'>
								   <a href='gest_clas.php?cmd=nouv_form&id_for=$id_for'> 
					   				Modifier 
								   </a>
						     ";
					 	
		 $voir_classes="<img src='../../images/b_browse.png'>
						<a href='gest_clas.php?cmd=cons_clas&id_for=$formation->id_for'>
				 			Voir les classes 
			    	    </a>";

 ?>		
  			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">C</span>onsulter une formation</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
<table width="76%" cellspacing="0" >
  <tr>
    <th height="23" colspan="2">Fiche d'information</th>
  </tr>
  <tr>
    <td width="38%" height="35">Nom</td>
    <td width="62%"><p >
        <?php  echo "$formation->nom" ?>
      </p>
    </td>
  </tr>
  <tr>
    <td height="31">Nombre de semestre</td>
    <td>
      <p>
        <?php  echo "$formation->nb_semestres" ?>
      </p>
    </td>
  </tr>
  <tr>
    <td height="34">Secteur</td>
    <td>
      <p>
        <?php  echo "$formation->secteur" ?>
      </p>
    </td>
  </tr>
  <tr>
    <td height="29">Niveau</td>
    <td>
      <p>
        <?php  echo "$formation->niveau" ?>
      </p>
    </td>
  </tr>
  <tr>
    <td height="35">Responsable</td>
    <td>
      <p>
        <?php  echo "$enseignant->nom &nbsp; $enseignant->prenom " ?>
      </p>
    </td>
  </tr>
</table>
<p>
  <?php
				echo"$voir_classes";
				?>
  <?php
				echo"$modifier_formation";
				?>
</p>
</div>