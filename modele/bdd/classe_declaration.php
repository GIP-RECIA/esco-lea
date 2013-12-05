<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 09/08/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_document_declare.php");
require_once ($LEA_REP."modele/bdd/classe_terminologie.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
class Declaration {

	var $id_dec; 	 //identifiant de la déclaration 
	var $id_app; 	 // identifiant de l'apprenti ayant fait cette déclaration
	var $id_periode; //  identifiant de la période déclarée
	var $date_dec;   // date de déclaration 
	var $etat;   	 // l'etat de la déclaration,  verouillée ou non (Variable non exploitée)
	var $type_suivi; // = entr pour le suivi en entreprise, cfa pour le suivi au CFA
	var $bdd;        // objet de connexion a la base de données	

	function Declaration($id_dec) {
		$this->id_dec = $id_dec;
		$this->bdd = new Connexion_BDD_LEA();
	}
	/****************** les méthodes ******************************/

	/*
	 Cette fonction permet d'insérer cette déclaration dans la la table $table
	 */
	function insert(){
			
		$sql="INSERT INTO les_declarations
		      (id_dec, 			   
			   id_app, 	
			   id_periode,
			   date_dec, 			  
			   etat,
			   type_suivi
			  )
		VALUES('',				
				'$this->id_app' ,
				'$this->id_periode' ,
				CURDATE() ,
				'$this->etat' ,
				'$this->type_suivi'
				
				)";
		$result = $this->bdd->executer($sql);
		$this->id_dec = mysql_insert_id(); // identifiant de la déclaration créée. 
			
	} // fin de la fonction

	/*
	 Cette fonction met a jour cette déclaration dans la base de données
	  
	 */
	function update(){

		$sql="UPDATE les_declarations
		      SET			   
			   
			   etat = '$this->etat'
			   
			  WHERE id_dec ='$this->id_dec' 	
				
				";		     
		$result = $this->bdd->executer($sql);

			
	} // fin de la fonction

	/*
	 Cette fonction permet de supprimer cette déclaration de la base de données
	  
	 */
	function delete(){

		global $SRC_DOCUMENTS_DECLARES;
		// suppression de fichiers joints avec cette déclaration

		$sql = "SELECT  src_doc
				FROM les_documents_declares 
			    WHERE id_dec = '$this->id_dec'
				"; 			 

		$result = $this->bdd->executer($sql);
			
		while( $ligne = mysql_fetch_assoc($result)) {

			if(file_exists($SRC_DOCUMENTS_DECLARES.$ligne['src_doc']))
			@unlink($SRC_DOCUMENTS_DECLARES.$ligne['src_doc']);

		}

		// Suppression de la déclaration

		$sql = "DELETE  FROM les_declarations
		      	WHERE id_dec = '$this->id_dec'			   			   
				";		     
		$result = $this->bdd->executer($sql);

			
	} // fin de la fonction

	/*
	 Cette fonction permet signer cette déclaration par l'usager d'identifiant $id_usager
	  
	 */
	function signer($id_usager){

		$this->delete_signature($id_usager);

		$sql="INSERT INTO les_signatures_declarations(id_dec, id_usager, date)
		      VALUES('$this->id_dec', '$id_usager', CURDATE() )			  	
				
				";		     
		$result = $this->bdd->executer($sql);

			
	} // fin de la fonction


	/*
	 Cette fonction permet de supprimer la signature de  l'usager d'identifiant $id_usager
	  
	 */
	function delete_signature($id_usager){

		$sql = "DELETE FROM les_signatures_declarations
				WHERE id_dec = '$this->id_dec' and id_usager = '$id_usager'";

		$result = $this->bdd->executer($sql);

			
	} // fin de la fonction


	/*
	 Cette fonction renvoit les dates de signatures des usagers ayant signés cette déclaration	
	  
	 */
	function get_dates_signature(){

		$sql = "SELECT id_usager, date
				FROM les_signatures_declarations
				WHERE id_dec = '$this->id_dec'";

		$result = $this->bdd->executer($sql);

		$les_dates_signatures = array();

		while ($ligne = mysql_fetch_assoc($result)) {

			$les_dates_signatures[$ligne['id_usager']] = $ligne['date'] ;
		}

		return $les_dates_signatures;
			
	} // fin de la fonction

	/*
	 Cette fonction teste si cette déclaration a était signée par l'usager
	 d'identifiant id_usager ou non
	 */
	function est_signee($id_usager){

		$sql = "SELECT id_usager, date
				FROM les_signatures_declarations
				WHERE id_dec = '$this->id_dec' and id_usager = '$id_usager'";

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {

			return 1;
		}
		else  return 0;
			
	} // fin de la fonction

	/*
	 Cette fonction teste si cette déclaration est "signable" par l'enseignant
	 Pour qu'une déclaration puisse etre signée par l'enseignant, 
	 il faut qu'elle soit déjà signé par l'apprenti et le maitre d'apprentissage 
	 */
	function est_signable_entr() {

		$sql = "select min(bMa) as bMa, 
					  min(bApp) as bApp
				from (
					select id_dec,
						  0 as bMa, 
						  1 as bApp
					from les_signatures_declarations
					inner join les_usagers on les_usagers.id_usager = les_signatures_declarations.id_usager and les_usagers.profil like '%ma%'
					where id_dec = '$this->id_dec'
					union all 
					select id_dec,
						  1 as bMa, 
						  0 as bApp
					from les_signatures_declarations
					inner join les_usagers on les_usagers.id_usager = les_signatures_declarations.id_usager and les_usagers.profil like '%app%'
					where id_dec = '$this->id_dec'
				) as ssReq
				group by id_dec";

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {
			if ($ligne['bMa'] == 0 && $ligne['bApp'] == 0) {  
				return 0;
			}
			if ($ligne['bMa'] == 0) {
				return 1;
			}
			if ($ligne['bApp'] == 0) {
				return 2;
			}
		}
		return 3;
			
	} // fin de la fonction

	/*
	 Cette fonction teste si cette déclaration est "signable" par le maitre d'apprentissage
	 Pour qu'une déclaration puisse etre signée par le MA, 
	 il faut qu'elle soit déjà signé par le formateur
	 */
	function est_signable_cfa() {

		$sql = "select 0 as bEns
				from les_signatures_declarations
				inner join les_usagers on les_usagers.id_usager = les_signatures_declarations.id_usager and les_usagers.profil like '%ens%'
				where id_dec = '$this->id_dec'";

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {
			if ($ligne['bEns'] == 0) {  
				return 0;
			}
		}
		return 1;
			
	} // fin de la fonction
	
	
	/* Cette fonction permet de fixier tous les attributs de la classe declaration.
	 */

	function set_detail(){

		$sql="SELECT id_dec, id_app, id_periode, date_dec, etat, type_suivi
 	 		  FROM les_declarations
    		 WHERE id_dec='$this->id_dec'";
			
		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {

			$this->id_app = $ligne['id_app'];
			$this->id_periode = $ligne['id_periode'];
			$this->date_dec = $ligne['date_dec'];
			$this->etat = $ligne['etat'];
			$this->type_suivi = $ligne['type_suivi'];

		}
			
		mysql_free_result($result);

	}


	/*
	 Cette fonction met a jour la liste des feuilles déclarées.	 
	 $les_id_noeud : la liste des identifiants des nouvelles feuilles déclarées. 
	 */
	function update_feuilles_declarees($les_id_noeud){

		$sql = "DELETE FROM les_feuilles_declarees
		     	WHERE id_dec = '$this->id_dec' 
				";		     

		$result = $this->bdd->executer($sql);

		if( is_array($les_id_noeud) && count($les_id_noeud) > 0 ) {

			$sql = "INSERT les_feuilles_declarees
		      (
			  id_noeud ,
			  id_dec 
			  )
			  VALUES
			  ";

			$virgule = "";

			foreach($les_id_noeud as $id_noeud) {
				$sql .= "
				$virgule
			    		 (
  						  '$id_noeud' ,
						  '$this->id_dec' 
						  )			 			   
						";

				$virgule = ",";
			}

			$result = $this->bdd->executer($sql);
		}

		$sql = "DELETE FROM les_feuilles_declarees_modalite_va_unique
		     			WHERE (id_noeud, id_dec ) not IN (
															SELECT id_noeud, id_dec
															FROM les_feuilles_declarees
														  )
				";		     

		$result = $this->bdd->executer($sql);


		$sql = "DELETE FROM les_feuilles_declarees_modalite_choix
		     			WHERE (id_noeud, id_dec ) not IN (
															SELECT id_noeud, id_dec
															FROM les_feuilles_declarees
														  )
				";		     

		$result = $this->bdd->executer($sql);

			
	} // fin de la fonction


	/*
	 Cette fonction met a jour la valeur saisie $val
	 pour valider la feuille d'identifiant $id_noeud avec la
	 modalité à réponse unique  $id_modalite
	  
	 */
	function validation_feuille_modalite_va_unique($id_noeud, $id_modalite, $val ){

		$sql = "DELETE FROM les_feuilles_declarees_modalite_va_unique
		     	WHERE id_dec = '$this->id_dec' and id_noeud = '$id_noeud' and id_modalite = '$id_modalite'
				";		     

		$result = $this->bdd->executer($sql);

		$sql="INSERT les_feuilles_declarees_modalite_va_unique
		      (
			  id_noeud ,
			  id_dec ,
			  id_modalite, 
			  evaluation
			  )
			  VALUES
			  (
  			  '$id_noeud' ,
			  '$this->id_dec' ,
			  '$id_modalite', 
			  '$val'
			  )			   
				";		     
		$result = $this->bdd->executer($sql);

			
	} // fin de la fonction

	/*
	 Cette fonction met a jour les identifiants des  choix séléctionnés $les_id_choix 
	 pour valider la feuille d'identifiant $id_noeud avec la
	 modalité multiple $id_modalite
	  
	 */
	function validation_feuille_modalite_va_multiple($id_noeud, $id_modalite, $les_id_choix ){

		$sql = "DELETE FROM les_feuilles_declarees_modalite_choix
		     	WHERE id_dec = '$this->id_dec' and id_noeud ='$id_noeud' and  id_modalite = '$id_modalite'
				";		     

		$result = $this->bdd->executer($sql);

		$sql = "INSERT les_feuilles_declarees_modalite_choix
		      (
			  id_noeud ,
			  id_dec ,
			  id_modalite, 
			  id_choix
			  )
			  VALUES";
			
		$virgule = "";
			
		foreach($les_id_choix as $id_choix) {
			$sql .= "
			$virgule
			    		 (
		  				  '$id_noeud' ,
						  '$this->id_dec' ,
						  '$id_modalite', 
						  '$id_choix'
						  )			   
						";

			$virgule = ",";
		}
			
		$result = $this->bdd->executer($sql);

			
	} // fin de la fonction


	/*
	 Cette fonction met a jour le texte saisie $txt
	 pour valider la modalité à réponse libre d'identifiant $id_modalite
	  
	 */
	function validation_mod_rep_libre($id_modalite, $txt ){

		$sql = "DELETE FROM les_declarations_modalite_reponse_libre
		     	WHERE id_dec = '$this->id_dec' and id_modalite = '$id_modalite'
				";		     

		$result = $this->bdd->executer($sql);

		$sql="INSERT les_declarations_modalite_reponse_libre
		      (
			 
			  id_dec ,
			  id_modalite, 
			  texte
			  )
			  VALUES
			  (  			 
			  '$this->id_dec' ,
			  '$id_modalite', 
			  '$txt'
			  )			   
				"; 
		$result = $this->bdd->executer($sql);

			
	} // fin de la fonction

	/*
	 Cette fonction met à jour les identifiants des réponses séléctionnées $les_id_reponse
	 pour valider la modalité d'identifiant $id_modalite 
	  
	 */
	function validation_mod_rep_choix($id_modalite, $les_id_reponse ){

		$sql = "DELETE  FROM les_declarations_modalite_reponse_choix
		     	WHERE id_dec = '$this->id_dec'and  id_modalite = '$id_modalite'
				";		     

		$result = $this->bdd->executer($sql);

		if(count($les_id_reponse) > 0) {

			$sql = "INSERT les_declarations_modalite_reponse_choix
		      (			 
			  id_dec ,
			  id_modalite, 
			  id_reponse
			  )
			  VALUES";

			$virgule = "";

			foreach($les_id_reponse as $id_reponse) {
				$sql .= "
				$virgule
			    		 (		  				  
						  '$this->id_dec' ,
						  '$id_modalite', 
						  '$id_reponse'
						  )			   
						";

				$virgule = ",";
			}

			$result = $this->bdd->executer($sql);
		}

			
	} // fin de la fonction


	/*
	 Cette fonction renvoit un tableau contenant tous les  documents déclarés.  
	 */



	function get_documents_declares(){
			
		$sql="SELECT id_doc, src_doc, confidentialite, id_dec,  id_usager
     			  FROM les_documents_declares  
				  WHERE id_dec='$this->id_dec' ";

		$result = $this->bdd->executer($sql);
			
		$les_documents = array();

		while ($ligne = mysql_fetch_assoc($result)) {

			$document = new Document_declare($ligne['id_doc']);
			$document->src_doc = $ligne['src_doc'];
			$document->confidentialite = $ligne['confidentialite'];
			$document->id_dec = $ligne['id_dec'];
			$document->id_usager = $ligne['id_usager'];

			$les_documents[] = $document;
		}
		mysql_free_result($result);

		return $les_documents;

	} // fin de la fonction



	/*
	 Cette fonction renvoit un tableau contenant tous les noeuds feuille déclarées 
	 de l'arbre d'identifiant  $id_arbre
	  
	 */


	function get_feuilles_declarees($id_arbre){

		$sql = "SELECT A.id_noeud, libelle, id_noeud_parent, id_arbre
		    FROM   les_feuilles_declarees A, les_noeuds B
		    WHERE  A.id_noeud = B.id_noeud  and 
				   B.id_arbre = '$id_arbre' and 	
				   A.id_dec ='$this->id_dec'			   
				";		     
		$result = $this->bdd->executer($sql);

		$les_feuilles_declarees = array();

		while ($ligne = mysql_fetch_assoc($result) ) {

			$feuille = new Noeud($ligne['id_noeud']);
			$feuille->libelle = $ligne['libelle'];
			$feuille->id_noeud_parent = $ligne['id_noeud_parent'];
			$feuille->id_arbre = $ligne['id_arbre'];

			$les_feuilles_declarees[] = $feuille;
		}

		return $les_feuilles_declarees;

	} // fin de la fonction


	/*
	 Cette fonction renvoit un tableau contenant tous les identifiants des feuilles déclarées 
	 de l'arbre d'identifiant $id_arbre
	  
	 */


	function get_id_feuilles_declarees($id_arbre){

		$arbre = new Arbre($id_arbre);
		$arbre->set_detail();
		// si toutes les feuilles de l'arbre d'identifiant $id_arbre doivent être sélectionnées et validées,
		// cette fonction renvoit la liste des identifiants de toutes les feuilles.

		if($arbre->valider_all_feuilles) return ($arbre->get_id_feuilles());

		$sql = "SELECT A.id_noeud
		    FROM   les_feuilles_declarees A, les_noeuds B
		    WHERE  A.id_noeud = B.id_noeud  and 
				   B.id_arbre = '$id_arbre' and 
				   A.id_dec ='$this->id_dec'
				   			   
				";		     
		$result = $this->bdd->executer($sql);

		$les_id_feuilles_declarees = array();

		while ($ligne = mysql_fetch_assoc($result) ) {

			$les_id_feuilles_declarees[] = $ligne['id_noeud'];
		}

		return $les_id_feuilles_declarees;

	} // fin de la fonction


	/*
	 Cette fonction renvoit la valeur saisie pour valider la la feuille d'identifiant
	 $id_noeud avec la modalité de validation arbre d'identifiant $id_modalite
	  
	 si cette feuille n'a pas été validée elle renvoit -1
	 */


	function get_valeur_validee_modalite_va_unique($id_modalite, $id_noeud){

		$sql = "SELECT  evaluation
		    FROM les_feuilles_declarees_modalite_va_unique
		    WHERE id_modalite = '$id_modalite' and id_noeud = '$id_noeud'  and id_dec ='$this->id_dec'			   
				";		     
		$result = $this->bdd->executer($sql);


		if ($ligne = mysql_fetch_assoc($result) ) {

			return $ligne['evaluation'];

		}
		else return '';

	} // fin de la fonction

	/*
	 Cette fonction renvoit un tableau contenant tous les identifiants des choix
	 de la modalité multiple d'identifiant $id_modalite
	 ayant validé le noeud d'identifiant $id_noeud lors de cette déclaration
	 */

	function get_id_choix_valides_modalite_va_multiple($id_modalite, $id_noeud){

		$sql = "SELECT id_choix
		    FROM les_feuilles_declarees_modalite_choix 
		    WHERE id_modalite = '$id_modalite' and id_noeud = '$id_noeud'  and id_dec ='$this->id_dec'			   
				";		     
		$result = $this->bdd->executer($sql);

		$les_id_choix = array();

		while ($ligne = mysql_fetch_assoc($result) ) {

			$les_id_choix[] = $ligne['id_choix'];
		}
		return $les_id_choix;

	} // fin de la fonction

	/*
	 Cette fonction renvoit le texte saisis avec la modalite
	 à réponse libre d'identifiant $id_modalite
	 */

	function get_texte_valide_modalite_reponse_libre($id_modalite){

		$sql = "SELECT texte
		    FROM les_declarations_modalite_reponse_libre A 
		    WHERE id_modalite = '$id_modalite' and id_dec ='$this->id_dec'			   
				";		     
		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result) ) {

			return($ligne['texte']);

		}
		else return "";

	} // fin de la fonction

	/*
	 Cette fonction renvoit un tableau contenant toutes les identifiant des réponses  sélctionnées 
	 lors de la déclaration de la modalité d'identifiant $id_modalité
	 */

	function get_id_reponses_modalite_reponse_choix($id_modalite){

		$sql = "SELECT  id_reponse
		    FROM les_declarations_modalite_reponse_choix 
		    WHERE id_modalite = '$id_modalite' and id_dec ='$this->id_dec'			   
				";		     
		$result = $this->bdd->executer($sql);

		$les_id_reponse = array();

		while ($ligne = mysql_fetch_assoc($result) ) {

			$les_id_reponse[] = $ligne['id_reponse'];
		}
		return $les_id_reponse;

	} // fin de la fonction


	// Cette fonction affiche la valeur déclarée pour la validation du feuille d'identifiant $id_noeud
	// avec la modalité  $id_modalité

	function afficher_modalite_suivi_guide($modalite, $id_noeud){

		global $URL_THEME;

		$classe = strtolower(get_class($modalite)); // la classe de cette modalite
			
		switch($classe){

			case "modalite_va_unique" :
				$valeur = $this->get_valeur_validee_modalite_va_unique($modalite->id_modalite, $id_noeud);
				if($valeur == '') {
					echo " - ";
				} else {
					echo "$valeur";
				}
				if($modalite->type_reponse == 'note') {
					$noeud = new Noeud($id_noeud);
					$note_max = $noeud->get_evaluation_modalite_va_unique($modalite->id_modalite);
					echo " / $note_max";
				}
				break;

			case "modalite_va_multiple" :
				$les_choix = $modalite->get_choix();
				$les_id_choix_valides = $this->get_id_choix_valides_modalite_va_multiple($modalite->id_modalite, $id_noeud);
				if(count($les_id_choix_valides) == 0) {
					$output = " - ";
				} else {
					$output = "";
					foreach($les_choix as $choix) {
						if(in_array($choix->id_choix, $les_id_choix_valides)) {
							$output.= " $choix->libelle <br> ";
						}
					}
				}
				echo $output;
				break;
		}
	}

	function get_modalite_suivi_guide($modalite, $id_noeud){

		global $URL_THEME;

		$classe = strtolower(get_class($modalite)); // la classe de cette modalite
			
		switch($classe){
			case "modalite_va_unique" :
				$valeur = $this->get_valeur_validee_modalite_va_unique($modalite->id_modalite, $id_noeud);
				if($valeur == '') {
					$output = "-";
				} else {
					$output = $valeur;
				}
				if($modalite->type_reponse == 'note') {
					$noeud = new Noeud($id_noeud);
					$note_max = $noeud->get_evaluation_modalite_va_unique($modalite->id_modalite);
					$output .= " / ".$note_max;
				}
				// String
				return $output;
				break;
			case "modalite_va_multiple" :
				$les_choix = $modalite->get_choix();
				$les_id_choix_valides = $this->get_id_choix_valides_modalite_va_multiple($modalite->id_modalite, $id_noeud);
				if(count($les_id_choix_valides) == 0) {
					$output = "-";
				} else {
					$output = array();
					foreach($les_choix as $choix) {
						if(in_array($choix->id_choix, $les_id_choix_valides)) {
							array_push($output, $choix->libelle);
						}
					}
				}
				// Si vide: String
				// Sinon: array() contenant les choix
				return $output;
				break;
		}
	}

	/*
	 Cette fonction affiche  la liste des feuilles déclarées, ainsi leurs valeurs saisies 
	 lors de la  validation de la liste des modalités de l'arbre $arbre à la période $id_periode.
	 */
	function afficher_feuilles_declarees($arbre, $id_periode = 0){

		global $URL_THEME;


		$apprenti = new Apprenti($this->id_app);
		$apprenti->set_detail();

		$tuteur_cfa = new Usager($apprenti->id_ens);
		$tuteur_cfa->set_detail();

		$maitre = new Usager($apprenti->id_ma);
		$maitre->set_detail();

		$parent = new Usager($apprenti->id_rl);
		$parent->set_detail();

		$formation = $apprenti->get_formation();
		$responsable = new Usager($formation->id_ens);
		$responsable->set_detail();


		$config_lea = new Config_lea($arbre->id_config);
		$config_lea->set_detail();

		$les_feuilles_declarees = $this->get_feuilles_declarees($arbre->id_arbre) ;
			
		$libelle_feuille = $arbre->get_libelle_feuille();
			
		$les_modalites =
		array_merge($arbre->get_modalites('app', $id_periode ),
		$arbre->get_modalites('ma', $id_periode),
		$arbre->get_modalites('tuteur_cfa', $id_periode),
		$arbre->get_modalites('ens', $id_periode),
		$arbre->get_modalites('rl', $id_periode),
		$arbre->get_modalites('rf', $id_periode));

		if( count($les_modalites) > 0 ) {

			echo'<p>
				<img src="'.$URL_THEME.'images/picto_arbre.png'.'"  border="0">
	  		 D&eacute;claration : <span class="nom_arbre">'.strtoupper($arbre->nom) .'</span></p>';

			if( count($les_feuilles_declarees) >  0 ) {
				echo "<table width='100%' cellspacing='0'>";
				echo"<tr>
					<th rowspan='2'>$libelle_feuille</th>";

				foreach($les_modalites as $modalite ) {
					echo"<th>$modalite->libelle</th>";
				}
				echo"</tr>";
				echo"<tr>";

				foreach($les_modalites as $modalite ) {

					switch ($modalite->acteur){
						case 'app' :
							$acteur  = $apprenti->nom .' '. $apprenti->prenom;
							break;
						case 'tuteur_cfa' :
							$acteur  = $tuteur_cfa->nom .' '. $tuteur_cfa->prenom;
							break;
						case 'ma' :
							$acteur  = $maitre->nom .' '. $maitre->prenom;
							break;
						case 'rl' :
							$acteur  = $parent->nom .' '. $parent->prenom;
							break;
						case 'rf' :
							$acteur  = $responsable->nom .' '. $responsable->prenom;
							break;
						case 'ens' :
							$acteur  = 'Les enseignants de la formation';
							break;
						default   :
							$acteur='';
					}

					echo"<th>
							<p style='font-size:11px; color:#000000'> $acteur</p>
							</th>";	

				}
				echo"</tr>";

				$tabNiveaux = array();
				$marge=0;
					
				$selected = '';
				foreach($les_feuilles_declarees as $feuille){

					//						if($selected == '')
					//							$selected = 'selected';
					//						else
					//							$selected = '';

					$les_id_noeuds_ascendants = $feuille->get_id_noeuds_ascendants();
					$libelles_noeuds ='';
					$niveau = 1;

					foreach($les_id_noeuds_ascendants as $id ){

						if($id == 0) continue;
						$nd = new Noeud($id, $arbre->id_arbre);

						if (!isset($tabNiveaux[$niveau]) || $tabNiveaux[$niveau] != $id) {
							$tabNiveaux[$niveau] = $id;
							$nd->set_detail();
							$marge = 20*($niveau-1);
							echo "<tr>\n";
							echo "<td colspan='".(count($les_modalites)+1)."'>\n";
							echo "<span style='margin-left:".$marge."px'";
							echo "<b>".$nd->libelle."</b></span>\n";
							echo "</td>\n</tr>\n";
						}

						$niveau++;
					}

					echo"<tr class='$selected'>
						<td style='padding-left: 20px;width:40%;height:50;vertical-align: top;'>
							<span style='margin-left:".$marge."px' >
							$feuille->libelle
							</span>
						</td>";

							foreach($les_modalites as $modalite ) {
								echo"<td class=\"val_dec\">";
								$this->afficher_modalite_suivi_guide($modalite, $feuille->id_noeud);
								echo"</td>";
							}
							echo"</tr>";
				}
				echo"</table> ";

				return 1;
			}
			else {
				echo("Aucun(e) ". strtolower($arbre->get_libelle_feuille())." n'est d&eacute;clar&eacute;(e) <br><br>");
			}
		}
	}


	function afficher_feuilles_declarees_pdf($arbre, $id_periode = 0){

		$apprenti = new Apprenti($this->id_app);
		$apprenti->set_detail();

		$tuteur_cfa = new Usager($apprenti->id_ens);
		$tuteur_cfa->set_detail();

		$maitre = new Usager($apprenti->id_ma);
		$maitre->set_detail();

		$parent = new Usager($apprenti->id_rl);
		$parent->set_detail();

		$formation = $apprenti->get_formation();
		$responsable = new Usager($formation->id_ens);
		$responsable->set_detail();


		$config_lea = new Config_lea($arbre->id_config);
		$config_lea->set_detail();

		$les_feuilles_declarees = $this->get_feuilles_declarees($arbre->id_arbre) ;
			
		$libelle_feuille = $arbre->get_libelle_feuille();
			
		$les_modalites =
		array_merge($arbre->get_modalites('app', $id_periode ),
		$arbre->get_modalites('ma', $id_periode),
		$arbre->get_modalites('tuteur_cfa', $id_periode),
		$arbre->get_modalites('ens', $id_periode),
		$arbre->get_modalites('rl', $id_periode),
		$arbre->get_modalites('rf', $id_periode)
		);
		//$liste = array();
		$liste2 = array();

		$liste2['titre_tab']['feuille'] = $libelle_feuille;

		$num = 0;
		foreach($les_modalites as $modalite ) {

			switch ($modalite->acteur){
				case 'app' :
					$acteur = $apprenti->nom .' '. $apprenti->prenom;
					break;
				case 'tuteur_cfa' :
					$acteur = $tuteur_cfa->nom .' '. $tuteur_cfa->prenom;
					break;
				case 'ma' :
					$acteur = $maitre->nom .' '. $maitre->prenom;
					break;
				case 'rl' :
					$acteur = $parent->nom .' '. $parent->prenom;
					break;
				case 'rf' :
					$acteur = $responsable->nom .' '. $responsable->prenom;
					break;
				case 'ens' :
					$acteur = 'Les enseignants de la formation';
					break;
				default :
					$acteur	='';
			}

			$liste2['titre_tab']['modalite'][$num] = 	array(
														"titre" => $modalite->libelle,
														"acteur" => $acteur
			);
			$num++;
		}

		$selected = '';

		foreach($les_feuilles_declarees as $feuille){
			$les_id_noeuds_ascendants = $feuille->get_id_noeuds_ascendants();
			$libelles_noeuds = '';
			$sous_groupe = '';
			$itmp2=0;
			foreach($les_id_noeuds_ascendants as $id ){
				if($id == 0) continue;
					
				$nd = new Noeud($id, $arbre->id_arbre);
				$nd->set_detail();
					
				if($itmp2 > 0) {
					$sous_groupe .= $nd->libelle;

					if(next($les_id_noeuds_ascendants)!==FALSE) {
						$sous_groupe .= " > ";
					}
				} else {
					$libelles_noeuds = $nd->libelle;
				}
				$itmp2++;
			}

			// on rÃ©cupÃ¨re sous forme d'aun tableau les modalitÃ©s
			$modalites_tab = array();
			$types_modalites_tab = array();
			foreach($les_modalites as $modalite ) {
				if(strtolower(get_class($modalite)) == "modalite_va_multiple") {
					array_push($types_modalites_tab, (($modalite->type_choix == "unique" ) ? "unique" : "multiple"));
				} else {
					array_push($types_modalites_tab, "texte brut");
				}
				array_push($modalites_tab, $this->get_modalite_suivi_guide($modalite, $feuille->id_noeud));
			}

			// si le groupe n'existe pas on le cree
			if(!isset($liste2['groupes_de_feuilles'][$libelles_noeuds])) {
				$liste2['groupes_de_feuilles'][$libelles_noeuds] = array();
			}

			// si le groupe n'existe pas on le cree
			if(!isset($liste2['groupes_de_feuilles'][$libelles_noeuds][$sous_groupe])) {
				$liste2['groupes_de_feuilles'][$libelles_noeuds][$sous_groupe] = array();
			}

			// on formate une feuille et les modalites des acteurs associÃ©es
			$une_feuille_et_modalites = array(
										"titre" => $feuille->libelle,
										"types_modalites" => $types_modalites_tab,
										"modalites" => $modalites_tab
			);
			// ajoute $une_feuille_et_modalites au groupe auquel la feuille appartient
			$liste2['groupes_de_feuilles'][$libelles_noeuds][$sous_groupe][] = $une_feuille_et_modalites;
		}

		return $liste2;

		//return $liste;
	}

	/*
	 Cette fonction affiche la réponse saisie lors de cette déclaration   pour  la validation 
	 de la modalité $id_modalite  utlisée pour le suivi libre 
	 */

	function afficher_modalite_suivi_libre($modalite){

		global $URL_THEME;

		$src_img = $URL_THEME.'images/valide.gif';
		// la classe de cette modalite

		$classe = strtolower(get_class($modalite));
			
		switch($classe){

			case "modalite_reponse_libre" :

				$texte = $this->get_texte_valide_modalite_reponse_libre($modalite->id_modalite);
				if($texte == "" ) $texte="?";
					
				echo( nl2br($texte) );
					
				break;

					
			case "modalite_reponse_choix"		   :

				$les_reponses = $modalite->get_reponses();
				$les_id_reponse_valides = $this->get_id_reponses_modalite_reponse_choix($modalite->id_modalite);
					
				if(count($les_id_reponse_valides) ==0) {
					$output = "?";
				}
				else {
					$output = "";

					foreach($les_reponses as $reponse) {
						if( in_array($reponse->id_reponse, $les_id_reponse_valides) )
						$output.=" <img src='$src_img'> $reponse->reponse <br> ";
						else $output.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $reponse->reponse <br> ";
					}

				}
					
				echo"$output";
				break;
		}


	}

	/*
	 Cette fonction affiche la rÃ©ponse saisie lors de cette dÃ©claration pour la validation 
	 de la modalitÃ© $id_modalite  utlisÃ©e pour le suivi libre 
	 */

	function afficher_modalite_suivi_libre_pdf($modalite){

		// la classe de cette modalite
		$classe = strtolower(get_class($modalite));

		if($classe == "modalite_reponse_libre") {
			$r = $this->get_texte_valide_modalite_reponse_libre($modalite->id_modalite);
			if(empty($r)) {
				$r = " - ";
			}
		} elseif($classe == "modalite_reponse_choix") {
			$les_reponses = $modalite->get_reponses();

			$les_id_reponse_valides = $this->get_id_reponses_modalite_reponse_choix($modalite->id_modalite);
			//var_dump($les_id_reponse_valides);
			if(count($les_id_reponse_valides) == 0) {
				$r = " - ";
			} else {
				$r = array();

				foreach($les_reponses as $reponse) {
					$r2 = array();
					$r2['reponse'] = $reponse->reponse;

					if(in_array($reponse->id_reponse, $les_id_reponse_valides)) {
						$r2['cochee'] = TRUE;
					} else {
						$r2['cochee'] = FALSE;
					}
					array_push($r, $r2);
					unset($r2);
				}
			}
		} else {
			$r = FALSE;
		}

		return $r;
	}

	/*
	 Cette fonction affiche toutes les valeurs saisies lors de la déclaration de 
	 la période d'identifiant $id_periode et qui correspondent 
	 aux modalités du suivi libre de la configuration $config_lea
	 */

	function afficher_tableau_modalites_suivi_libre($config_lea, $id_periode = 0){

		$type_suivi = $this->type_suivi;

		$apprenti = new Apprenti($this->id_app);
		$apprenti->set_detail();

		$tuteur_cfa = new Usager($apprenti->id_ens);
		$tuteur_cfa->set_detail();

		$maitre = new Usager($apprenti->id_ma);
		$maitre->set_detail();

		$parent = new Usager($apprenti->id_rl);
		$parent->set_detail();

		$formation = $apprenti->get_formation();
		$responsable = new Usager($formation->id_ens);
		$responsable->set_detail();

		$les_modalites =
		array_merge($config_lea->get_modalites($type_suivi, 'app', $id_periode),
		$config_lea->get_modalites($type_suivi, 'ma', $id_periode),
		$config_lea->get_modalites($type_suivi, 'tuteur_cfa', $id_periode),
		$config_lea->get_modalites($type_suivi, 'ens', $id_periode),
		$config_lea->get_modalites($type_suivi, 'rl', $id_periode),
		$config_lea->get_modalites($type_suivi, 'rf', $id_periode)
		);

		if( count($les_modalites) > 0 ) {

			foreach($les_modalites as $modalite ) {

				switch ($modalite->acteur){
					case 'app' : 			$acteur  = $apprenti->nom .' '. $apprenti->prenom;
					break;
					case 'tuteur_cfa' :  	$acteur  = $tuteur_cfa->nom .' '. $tuteur_cfa->prenom;
					break;
					case 'ma' : 			$acteur  = $maitre->nom .' '. $maitre->prenom;
					break;
					case 'rl' :				$acteur  = $parent->nom .' '. $parent->prenom;
					break;
					case 'rf' : 			$acteur  = $responsable->nom .' '. $responsable->prenom;
					break;
					case 'ens' :  			$acteur  = 'Les enseignants de la formation';
					break;
					default   :  			$acteur='';
				}

				echo "<table>";
				echo"<tr>
					<th width='50%'>
					$modalite->libelle
					</th>
					<th>
						 R&eacute;dig&eacute;(e) par :  $acteur 
					</th>
				 </tr>
				 <tr>	
				  <td height='100' colspan='2'>
				  
				  ";
					$this->afficher_modalite_suivi_libre($modalite);
					echo"
				</td>	
				 </tr>
			 </table>";			 
			}
			return 1;

		}
		else return 0;
	}

	function afficher_tableau_modalites_suivi_libre_pdf($config_lea, $id_periode = 0){

		$type_suivi = $this->type_suivi;

		$apprenti = new Apprenti($this->id_app);
		$apprenti->set_detail();

		$tuteur_cfa = new Usager($apprenti->id_ens);
		$tuteur_cfa->set_detail();

		$maitre = new Usager($apprenti->id_ma);
		$maitre->set_detail();

		$parent = new Usager($apprenti->id_rl);
		$parent->set_detail();

		$formation = $apprenti->get_formation();
		$responsable = new Usager($formation->id_ens);
		$responsable->set_detail();

		$les_modalites =
		array_merge($config_lea->get_modalites($type_suivi, 'app', $id_periode),
		$config_lea->get_modalites($type_suivi, 'ma', $id_periode),
		$config_lea->get_modalites($type_suivi, 'tuteur_cfa', $id_periode),
		$config_lea->get_modalites($type_suivi, 'ens', $id_periode),
		$config_lea->get_modalites($type_suivi, 'rl', $id_periode),
		$config_lea->get_modalites($type_suivi, 'rf', $id_periode)
		);

		$liste = array();
		$num = 0;
			
		foreach($les_modalites as $modalite ) {

			switch ($modalite->acteur){
				case 'app' : 			$acteur  = $apprenti->nom .' '. $apprenti->prenom;
				break;
				case 'tuteur_cfa' :  	$acteur  = $tuteur_cfa->nom .' '. $tuteur_cfa->prenom;
				break;
				case 'ma' : 			$acteur  = $maitre->nom .' '. $maitre->prenom;
				break;
				case 'rl' :				$acteur  = $parent->nom .' '. $parent->prenom;
				break;
				case 'rf' : 			$acteur  = $responsable->nom .' '. $responsable->prenom;
				break;
				case 'ens' :  			$acteur  = 'Les enseignants de la formation';
				break;
				default   :  			$acteur='';
			}

			$liste[$num]['libelle'] = $modalite->libelle;
			$liste[$num]['auteur'] = $acteur;
			if(strtolower(get_class($modalite)) == "modalite_reponse_choix") {
				$liste[$num]['type'] = (($modalite->type_choix == "unique" ) ? "unique" : "multiple");
			} else {
				$liste[$num]['type'] = "texte brut";
			}
			$liste[$num]['reponse'] = $this->afficher_modalite_suivi_libre_pdf($modalite);
			$num++;
		}
		return $liste;
	}

	/*
	 Cette fonction permet d'afficher la liste des document joints lors de cette déclaration	
	 */

	function afficher_fichiers_joints(){
			
		global $URL_DOCUMENTS_DECLARES;
		global $REP_DOCUMENTS_DECLARES;
		global $LEA_URL;


		$les_documents = $this->get_documents_declares();

		if( count($les_documents) > 0 ) {
		 echo "<table>
			    <tr>
					<th colspan='3'>
						Les documents joints 
					</th>
				 </tr>";
		 foreach($les_documents as $document ) {

		 	$url = $URL_DOCUMENTS_DECLARES.urlencode($document->src_doc);
		 	 
		 	 
		 	$tab = array("jpg","jpeg","bmp","png","gif");
		 	 
		 	if(in_array( get_extension($document->src_doc), $tab))
		 	$img = $URL_DOCUMENTS_DECLARES.urlencode($document->src_doc);
		 	else $img = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_fichier.jpeg';
		 	 
		 	$usager = new Usager($document->id_usager);
		 	$usager->set_detail();
		 	 
		 	if($document->confidentialite) $str_conf ="Est confidentiel";
		 	else $str_conf="";
		 	 
		 	echo"	 <tr>
							
				  		 <td height='30'>
						
						 	<a href = \"$url\" target=\"_blank\">
							 <img src=\"$img\" border=\"0\" width=\"70\">
							";
		 	echo(to_html($document->src_doc) );
		 	echo"</a>
							
							";							
		 	 
		 	echo" 		</td>
						<td>
						Joint par : $usager->nom $usager->prenom			
						</td>
						<td>
						$str_conf
						</td>	
				 	</tr>";
							
		 }
		 echo"</table>";
		 return 1;
		}
		else return 0;
	}

	function afficher_fichiers_joints_pdf(){
			
		global $URL_DOCUMENTS_DECLARES;
		global $REP_DOCUMENTS_DECLARES;
		global $LEA_URL;

		$liste = array();
		$num = 0;
		$les_documents = $this->get_documents_declares();

		if( count($les_documents) > 0 ) {
			foreach($les_documents as $document ) {
				$usager = new Usager($document->id_usager);
				$usager->set_detail();
					
				$liste[$num]['url'] = $URL_DOCUMENTS_DECLARES.urlencode($document->src_doc);
				$liste[$num]['extension'] = get_extension($document->src_doc);
				$liste[$num]['auteur'] = $usager->nom.' '.$usager->prenom;
				$liste[$num]['confidentiel'] = ($document->confidentialite) ? 1 : 0;
					
				$num++;
			}
		} else {
			$liste = NULL;
		}
		return $liste;
	}

	/*
	 Cette fonction affiche  les dates de signature de cette déclaration par les différents 
	 usagers concernés
	 si $annuler =1; le boutton qui permet d'annuler une siganture sera  visible
	 (option proposée au responsable d'une formation) 


	 */

	function afficher_signatures($annuler = 0){

		global $URL_THEME;

		$les_dates = $this->get_dates_signature();

		if( count($les_dates) > 0 ) {
		 echo "<table width='90%' cellspacing='0'>
			    <tr>
					<th colspan='2'>
						Les signataires de la d&eacute;claration
					</th>
				 </tr>";

		 foreach( $les_dates as $id_usager => $date ) {
		 	$usager = new Usager($id_usager);
		 	$usager->set_detail();
		 	$date = trans_date($date);
		 	 
		 	echo"	 <tr>
				  		 <td  height='30'>						
						<p>	$usager->nom &nbsp; &nbsp; $usager->prenom [ le 	$date ]</p>
						</td>";
		 	if($annuler) {
		 		echo"<td>
							 <p> 
							 	<a href='annuler_signature.php?id_dec=$this->id_dec&id_usager=$id_usager'
								onClick='return confirm(\"Etes-vous sur de vouloir annuler cette signature ? \")'
								>
							 		<img src='".$URL_THEME."images/picto_drop.png' border='0' \>		
									Annuler 
								</a> 
							</p>
			 			 	</td>";
		 	}

		 	echo"	 	</tr>";
		 }
		 echo"</table>";
		 return 1;

		} else {
			return 0;
		}
	}

	/*
	 * Cette fonction retourne un tableau contenant le profil des usagers qui doivent signer
	 * ou ont signÃ©, les dates de signature, et le nom des usagers qui ont signÃ©.
	 */


	function afficher_signatures_pdf(){
		$les_dates = $this->get_dates_signature();
		$t = new Terminologie();
		$profils_usagers = 	array(
							"app" ,
							"ens" ,
							"ma" ,
		);
		$liste = array();
		$num = 0;
		foreach( $les_dates as $id_usager => $date ) {
			$usager = new Usager($id_usager);
			$usager->set_detail();

			$date = trans_date($date);

			$liste[$num]['profil'] = $usager->profil;//ucfirst($profils_usagers[$usager->profil]);
			$liste[$num]['auteur'] = $usager->nom.' '.$usager->prenom;
			$liste[$num]['date'] = $date;

			unset($profils_usagers[$usager->profil]);
			$num++;
		}
		//var_dump($profils_usagers);
		foreach($profils_usagers as $profil_non_signe_v) {
			$liste[$num]['profil'] = $profil_non_signe_v;
			$liste[$num]['auteur'] = NULL;
			$liste[$num]['date'] = NULL;
			$num++;
		}

		return $liste;
	}

}// fin de la classe Declaration

?>