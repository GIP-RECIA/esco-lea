<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
/***********************************************************/
	
if (isset($_REQUEST['id_entr'])) $id_entr=$_REQUEST['id_entr'];
else {html_refresh("../accueil.php"); exit();}

$entreprise = new Entreprise($id_entr);
			
			$entreprise->nom 		= to_sql ($_REQUEST['nom']);			
			$entreprise->adresse 	= to_sql ($_REQUEST['adresse']);
			$entreprise->code_postal= to_sql ($_REQUEST['code_postal']);
			$entreprise->ville 		= to_sql ($_REQUEST['ville']);
			$entreprise->tel_fixe1 	= to_sql ($_REQUEST['tel_fixe1']);
			$entreprise->tel_fixe2 	= to_sql ($_REQUEST['tel_fixe2']);
			$entreprise->fax		= to_sql ($_REQUEST['fax']);
			$entreprise->email		= to_sql ($_REQUEST['email']);
			$entreprise->url_site 	= to_sql ($_REQUEST['url_site']);
			$entreprise->secteur_activite 	= to_sql ($_REQUEST['secteur_activite']);
			$entreprise->nom_contact 	  	= to_sql ($_REQUEST['nom_contact']);						
			$entreprise->prenom_contact 	= to_sql ($_REQUEST['prenom_contact']);
			$entreprise->nb_salaries 		= to_sql ($_REQUEST['nb_salaries']);
			$entreprise->nb_apprentis 		= to_sql ($_REQUEST['nb_apprentis']);

if($id_entr == 0) $entreprise->insert(); // ajout de nouevelle entreprise			
else $entreprise->update(); // modification de  l'entreprise d'identifiant id_entr

html_refresh("gest_entr.php?cmd=cons_entr_det&id_entr=$entreprise->id_entr")
 ?>	