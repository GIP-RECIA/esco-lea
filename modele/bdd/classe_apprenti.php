<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 03/08/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");

/***********************************************************/
class Apprenti extends Usager{

	var $id_app; 			// l'identifiant de l'apprenti
	var $date_nais;			// date de naissance
	var $no_insc;			// date d'inscription
	var $no_secu;			// numéro de sécurité sociale 
	var $dern_classe_freq;	// dernière classe fréquentée
	var $diplomes_obtenus; 	// les diplomes obtenus par l'apprenti
	var $src_photo;			// source de la photo de l'apprenti
	var $adresse_perso ;    // adresse personnelle
	var $email_perso;		// email personnelle
	var $tel_perso;			// telephone personnelle
	var $date_debut_contrat;
	var $date_fin_contrat;
	var $id_cla = 0;			// l'identifiant de la classe de l'apprenti
	var $id_ma  = 0;			// l'identifiant du maitre d'apprentissage de l'apprenti
	var $id_ens = 0;			// l'identifiant du tuteur cfa de l'apprenti
	var $id_rl  = 0;			// l'identifiant du représentant légal de l'apprenti
	var $modif_dec_ma  = 0;		// = 1 si cette apprenti est autorisé à modifier la déclaration de son maitre d'apprentissage

	// Identifiants des MA issus de la simulation / import LDAP
	var $ids_mas  = array("0");

	function Apprenti($id_app) {

		$this->id_app = $id_app;
		$this->bdd = new Connexion_BDD_LEA();
		$this->id_usager = $id_app;
	}

	/****************** les méthodes ******************************/

	/* Cette fonction parmet d'enregistrer cet apprenti dans la base de données */

	function insert($display_error = 1) {
			
		$result = parent::insert($display_error);
			
		if ($result) {
			$sql="INSERT INTO les_apprentis(id_app, date_nais, no_insc, no_secu,
		 			dern_classe_freq, diplomes_obtenus, src_photo, adresse_perso,
					tel_perso, email_perso, date_debut_contrat, date_fin_contrat,
					id_cla, id_ens, id_ma, id_rl)
			   VALUES('$this->id_usager', 
			   		  STR_TO_DATE('$this->date_nais','%d/%m/%Y'),
					  '$this->no_insc',
			   		  '$this->no_secu', 
					  '$this->dern_classe_freq', 
					  '$this->diplomes_obtenus',
					  '$this->src_photo', 
					  '$this->adresse_perso', 
					  '$this->tel_perso', 
					  '$this->email_perso', 
					  STR_TO_DATE('$this->date_debut_contrat','%d/%m/%Y'), 
					  STR_TO_DATE('$this->date_fin_contrat','%d/%m/%Y') ,
					  '$this->id_cla', 
					  '$this->id_ens',
					  '$this->ids_mas[0]', 
					  '$this->id_rl' )"; 

			$result = $this->bdd->executer($sql, $display_error);

			$this->id_app = $this->id_usager;
		} else {
			$this->bdd->erreurs[] = "Une erreur est survenue lors de l'enregistrement de $this->civilite $this->nom $this->prenom ";
			$this->bdd->erreurs[] = mysql_error();
		}
		return $result;
	}

	/* Cette fonction met à jour les coordonnées de  cet apprenti */ 

	function update($display_error = 1) {

		$result = parent::update($display_error);
			
		if ($result) {
			$sql="UPDATE les_apprentis
		      
			   SET   date_nais=STR_TO_DATE('$this->date_nais','%d/%m/%Y'), 
			   		 no_insc ='$this->no_insc', 
			  		 no_secu ='$this->no_secu', 
					 dern_classe_freq ='$this->dern_classe_freq',
			  		 diplomes_obtenus ='$this->diplomes_obtenus', 
					 src_photo ='$this->src_photo', 
					 adresse_perso ='$this->adresse_perso', 
					 tel_perso ='$this->tel_perso', 
					 email_perso ='$this->email_perso', 
					 date_debut_contrat = STR_TO_DATE('$this->date_debut_contrat','%d/%m/%Y'),
					 date_fin_contrat = STR_TO_DATE('$this->date_fin_contrat','%d/%m/%Y'),					 
					 id_cla='$this->id_cla', 
					 id_ens ='$this->id_ens' , id_rl='$this->id_rl'";

			// Si le MA defini en BD n'est plus associe dans le LDAP
			if($this->id_ma_has_to_be_updated()) {
				$id_ma = ($this->ids_mas[0] != "0" ? $this->ids_mas[0] : $this->id_ma);
      	$sql .= " , id_ma='$id_ma'";
			}	
		      
			$sql .= " WHERE id_app='$this->id_app'";

			$result = $this->bdd->executer($sql, $display_error);
		} else {
			$this->bdd->erreurs[] = "Une erreur est survenue lors de la mise a jour de $this->civilite $this->nom $this->prenom ";
			$this->bdd->erreurs[] = mysql_error();
		}
		return $result;

	}

	/* Cette fonction met à jour le tuteur de  cet apprenti */

	function update_tuteur_cfa($id_ens) {
		$sql="UPDATE les_apprentis
			   SET   id_ens ='$id_ens' 
			   WHERE id_app='$this->id_app'";

		$result = $this->bdd->executer($sql);
	}

	/* Cette fonction met à jour l'attribut de la table les apprentis */

	function update_attribut($attribut, $valeur) {

		$sql="UPDATE les_apprentis
		       SET  
		       $attribut = '$valeur'

		       WHERE id_app='$this->id_app'"; 

		       $result = $this->bdd->executer($sql);

	}

	/*
	 Cette fonction supprime le parent  de cet apprenti de la base de données 
	 si se parent ne représente que cet apprenti 
	 */

	function delete_parent() {

		$id_rl = $this->id_rl; 		//l'identifiant du représentant légal de l'apprenti		
			
		$sql="SELECT  count(id_app) as nb FROM les_apprentis
			   WHERE id_rl = '$id_rl'"; 			 

		$result = $this->bdd->executer($sql);
			
		if($ligne = mysql_fetch_assoc($result)) {
			if( $ligne['nb'] ==1) { 		// le parent d'identifiant rl  suit qu'un seule apprenti
				$parent = new usager($id_rl);
				$parent->delete_usager();
					
			}
		}


	}

	/*
	 Cette fonction toutes les document liés à cet apprenti
	 */

	function delete_documents_apprenti() {
			
		global $LEA_REP;
		global $SRC_DOCUMENTS_DECLARES;
			
		// suppression de la photo de l'apprenti

		$sql = "SELECT  src_photo
				FROM les_apprentis 
			    WHERE id_app = '$this->id_app'"; 			 

		$result = $this->bdd->executer($sql);
			
		if($ligne=mysql_fetch_assoc($result)) {
			$this->src_photo = $ligne['src_photo'];
			if(file_exists($LEA_REP.'Apprenti/Photos/'.$this->src_photo))
			@unlink($LEA_REP.'Apprenti/Photos/'.$this->src_photo);

		}

		// suppression de fichiers joints avec ses declarations

		$sql = "SELECT  src_doc
				FROM les_documents_declares A , les_declarations B 
			    WHERE A.id_dec = B.id_dec and B.id_app = '$this->id_app'
				"; 			 

		$result = $this->bdd->executer($sql);
			
		while( $ligne = mysql_fetch_assoc($result)) {

			if(file_exists($SRC_DOCUMENTS_DECLARES.$ligne['src_doc']))
			@unlink($SRC_DOCUMENTS_DECLARES.$ligne['src_doc']);

		}

	}

	/*
	 Cette fonction permet de verrouiller ( signer ) toutes les déclarations du suivi $suivi
	 ayant dépassées le delai autorisé  $delai 
	 */
	function auto_signee_declarations($delai, $suivi){

		$sql="UPDATE  les_declarations A , les_periodes B
      	  SET 	  etat='as'
	  	  WHERE  	A.id_periode = B.id_periode
			  		and id_app = '$this->id_app' 
					and type_suivi = '$suivi'
					and ( TO_DAYS(CURDATE())- TO_DAYS((B.date_fin_$suivi))  >= '$delai' 
				";
		$result = executer($sql);

	}

	/*
	 Cette fonction renvoit la déclaration de cet apprenti effectuée 
	 à la période d'identifiant $id_periode pour le suivi $suivi(entr ou cfa )
	  
	 */

	function get_declaration($id_periode, $suivi){

		if($suivi == 'cfa') 	  		$str_suivi = " and type_suivi = 'cfa'";
		elseif($suivi == 'entr') 		$str_suivi = " and type_suivi = 'entr'";
		elseif($suivi == 'entr_et_cfa') $str_suivi = " and ( type_suivi = 'entr' OR type_suivi = 'cfa')";
		else 							$str_suivi = " and ( type_suivi = 'entr' OR type_suivi = 'cfa')";

		$sql="SELECT id_dec, date_dec, etat
		      FROM les_declarations
      		  WHERE id_app='".$this->id_app."' AND id_periode='".$id_periode."'".$str_suivi;

		$result = $this->bdd->executer($sql);

		$declaration = new Declaration(0);
			
		if  ($ligne = mysql_fetch_assoc($result)) {

			$declaration->id_dec = $ligne['id_dec'];
			$declaration->date_dec = $ligne['date_dec'];
			$declaration->etat = $ligne['etat'];
			$declaration->id_app = $this->id_app;
			$declaration->id_periode = $id_periode;
			$declaration->type_suivi = $suivi;
		}

		mysql_free_result($result);
			
		return $declaration;
			
	}
	/*
	 Cette fonction renvoit la déclaration de cet apprenti effectuée 
	 à la période d'identifiant $id_periode pour le suivi $suivi(entr ou cfa )
	  
	 */

	function get_num_declarations($suivi){

		if($suivi == 'cfa') 	  		$str_suivi = " and type_suivi = 'cfa'";
		elseif($suivi == 'entr') 		$str_suivi = " and type_suivi = 'entr'";
		elseif($suivi == 'entr_et_cfa') $str_suivi = " and ( type_suivi = 'entr' OR type_suivi = 'cfa')";
		else 							$str_suivi = " and ( type_suivi = 'entr' OR type_suivi = 'cfa')";

		$sql="SELECT id_dec
		      FROM les_declarations
      		  WHERE id_app='".$this->id_app."'".$str_suivi;

		$result = $this->bdd->executer($sql);

		$num_rows = mysql_num_rows($result);

		mysql_free_result($result);
			
		return $num_rows;
	}

	/*
	 Cette fonction renvoit la déclaration de cet apprenti effectuée 
	 à la période d'identifiant $id_periode pour le suivi $suivi(entr ou cfa )
	 */
	function get_id_declaration($id_periode, $suivi){

		if($suivi == 'cfa') 	  		$str_suivi = " and type_suivi = 'cfa'";
		elseif($suivi == 'entr') 		$str_suivi = " and type_suivi = 'entr'";
		else 							$str_suivi = " and ( type_suivi = 'entr' OR type_suivi = 'cfa')";

		$sql="SELECT id_dec
		      FROM les_declarations
      		  WHERE id_app='".$this->id_app."' AND id_periode='".$id_periode."'".$str_suivi;

		$result = $this->bdd->executer($sql);

		$id = "0";
		if($ligne = mysql_fetch_assoc($result)) {
			$id = $ligne['id_dec'];
		}
		mysql_free_result($result);
		return $id;
	}

	/*
	 Cette fonction renvoit un tableau contenant toutes les périodes  non déclarées
	 par cet apprenti
	 */

	function get_periodes_non_declarees($type_suivi, $classe) {
			
		$sql="SELECT id_periode
				 FROM  les_declarations
				 WHERE id_app ='$this->id_app' and type_suivi ='$type_suivi'
				";	
			
		$result = $this->bdd->executer($sql);
			
		$les_id_periodes_declarees = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_periodes_declarees[] = $ligne['id_periode'];
		}
			
		mysql_free_result($result);
			
		$formation = new Formation ($this->get_id_for());
		$les_periodes = $formation->get_periodes($type_suivi,'app',$classe); // les périodes de la formation de l'apprenti
			
		$les_periodes_non_declarees = array();
			
		foreach($les_periodes as $periode){

			if( ! in_array($periode->id_periode, $les_id_periodes_declarees ) )

			$les_periodes_non_declarees[] = $periode;

		}
			
			
		return $les_periodes_non_declarees;
	}


	/*
	 Cette fonction renvoit l'identifiant de la  classe frÃ©quentÃ©e par l'apprenti 
	 */

	function get_id_classe(){

		$sql="SELECT id_cla
			   FROM les_apprentis
			   WHERE id_app ='$this->id_app'"; 	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			return $ligne['id_cla'];
		}
		else return 0;
			
	}

	/* Cette fonction renvoit l'identifiant la  classe de l'apprenti */

	function get_classe(){

		$sql="SELECT A.id_cla, C.libelle, C.niveau_etude, C.id_for
			   FROM les_apprentis A, les_classes C
			   WHERE A.id_cla=C.id_cla and id_app ='$this->id_app'"; 	   		   

		$result = $this->bdd->executer($sql);
			
		$classe = new Classe(0);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			$classe->id_cla = $ligne['id_cla'];
			$classe->libelle = $ligne['libelle'];
			$classe->niveau_etude = $ligne['niveau_etude'];
			$classe->id_for = $ligne['id_for'];

		}
		return $classe;
	}

	/* Cette fonction  permet de fixer tous les attributs de la classe Apprenti  */

	function set_detail(){
			
		parent::set_detail(); // fixer les attribus en tantque usager
			
		$sql="SELECT date_nais, no_insc, no_secu, dern_classe_freq,
		 			  diplomes_obtenus, src_photo, adresse_perso, 
					  email_perso, tel_perso, date_debut_contrat, date_fin_contrat,
					  id_cla, id_ens, id_ma, id_rl, modif_dec_ma
			   FROM  les_apprentis 
			   WHERE id_app='$this->id_app'";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {

			$this->date_nais = $ligne['date_nais'];
			$this->no_insc = $ligne['no_insc'];
			$this->no_secu = $ligne['no_secu'];

			$this->dern_classe_freq = $ligne['dern_classe_freq'];
			$this->diplomes_obtenus = $ligne['diplomes_obtenus'];

			$this->src_photo = $ligne['src_photo'];

			$this->adresse_perso = $ligne['adresse_perso'];

			$this->email_perso = $ligne['email_perso'];
			$this->tel_perso = $ligne['tel_perso'];
			$this->date_debut_contrat = $ligne['date_debut_contrat'];
			$this->date_fin_contrat =  $ligne['date_fin_contrat'];
			$this->id_ens = $ligne['id_ens'];
			$this->id_ma = $ligne['id_ma'];
			$this->id_rl = $ligne['id_rl'];
			$this->id_cla = $ligne['id_cla'];
			$this->modif_dec_ma = $ligne['modif_dec_ma'];
		}
	}

	/* Cette fonction permet de tester si le patron d'identifiant id_ma
	 est le maitre d'apprentissage de l'apprenti.
	 .*/

	function apour_maitre_apprentissage($id_ma){

		$sql="SELECT id_ma
        	  FROM les_apprentis
	    	  WHERE id_app='$this->id_app' and id_ma='$id_ma' 
			  ";
			
		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) return 1;
		else return 0;
			
	}

	/* Cette fonction renvoit l'identifiant du tuteur cfa  de l'apprenti.
	 */
	function get_id_tuteur(){

		$sql="SELECT id_ens
        	  FROM les_apprentis
	    	  WHERE id_app ='$this->id_app'";
		$result = $this->bdd->executer($sql);
		if ($ligne = mysql_fetch_assoc($result)){
			return $ligne['id_ens'];
		}
	}

	/* Cette fonction permet de tester si l'enseignant d'identifiant id_ens
	 est le tuteur de l'apprenti.
	 .*/

	function apour_tuteur($id_ens){

		$sql="SELECT id_ens
        	  FROM les_apprentis
	    	  WHERE id_app='$this->id_app' and id_ens='$id_ens'";

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) return 1;
		else return 0;
			
			
	}

	/* Cette fonction renvoit l'identifiant du représenatnt légal  de l'apprenti.
	 */
	function get_id_rl(){

		$sql="SELECT id_rl
        	  FROM les_apprentis 
	    	  WHERE id_app='$this->id_app'";

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)){
			return $ligne['id_rl'];
		}
	}

	/* Cette fonction permet de tester si le parent d'identifiant id_rl
	 est le représentant légal de l'apprenti.
	 .*/

	function apour_parent($id_rl){

		$sql="SELECT id_rl
        	  FROM les_apprentis 
	    	  WHERE id_app='$this->id_app' and id_rl='$id_rl'";

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) return 1;
		else return 0;
			
			
	}


	/* Cette fonction permet de tester si l'enseignant d'identifiant id_ens
	 est le responsable de la formation de l'apprenti.
	 .*/

	function apour_responsable_formation($id_ens){
			
		$formation = new Formation( $this->get_id_for());
		$id_ens_resp = $formation->get_id_rf();

		if($id_ens_resp==$id_ens) return 1;
		else return 0;
	}


	/* Cette fonction renvoit l'identifiant de la formation de l'apprenti.
	 */
	function get_id_for(){

		$sql="SELECT C.id_for
        	  FROM les_apprentis A,  les_classes C
	    	  WHERE A.id_cla = C.id_cla and A.id_app ='$this->id_app'";

		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)){
			return $ligne['id_for'];
		}
		else return 0;

	}

	/* Cette fonction renvoit la formation de l'apprenti.
	 */
	function get_formation(){

		$sql="SELECT C.id_for
        	  FROM les_apprentis A,  les_classes C
	    	  WHERE A.id_cla = C.id_cla and A.id_app ='$this->id_app'";

		$result = $this->bdd->executer($sql);

		$formation = new Formation(0);

		if ($ligne = mysql_fetch_assoc($result)){

			$formation->id_for= $ligne['id_for'];
			$formation->set_detail();
		}

		return $formation;

	}

	/*
	 Cette fonction renvoit un objet contenant la configuration du LEA de l'apprenti .
	 */
	function get_config_lea(){

		$id_for = $this->get_id_for();

		$formation = new Formation($id_for);
		$config_lea = $formation->get_config_lea();

		return $config_lea;
	}

	/*

	function bilan_modalite_va_unique(($id_noeud,  $id_modalite){

	$sql="SELECT A.evaluation
	FROM   les_feuilles_declarees_modalite_va_unique A , les_declarations B
	WHERE  A.id_dec= B.id_dec and
	B.id_app ='$this->id_app' and
	A.id_noeud ='$id_noeud' and
	A.id_modalite = '$id_modalite'
	";

	$result = $this->bdd->executer($sql);

	$eva = 0;
	$nb = 0; // le nombre d'enregistrements

	while ($ligne = mysql_fetch_assoc($result)) {

	$eva += $ligne['evaluation'];

	$nb++;
	}

	return $eva ;
	}

	*/

	/*
	 Cette fonction renvoit un tableau contenant tous les noeuds de l'arbre $arbre avec
	 leurs evaluations par rapport à la modalité à réponse unique d'identifiant  $modalite
	 */
	function evaluation_arbre_modalite_va_unique($arbre,  $modalite){

		if($modalite->type_reponse =='frequence') $txt_ration = '';
		elseif($modalite->type_reponse =='note')  $txt_ration = '/ COUNT(B.evaluation)';
		else return;

		$temp_table="SELECT A.id_noeud, A.libelle, A.type, A.id_noeud_parent,  A.id_arbre,  SUM(B.evaluation) ".$txt_ration ."  As evaluation
			 FROM   les_noeuds AS A 
			 		LEFT JOIN 
					 (SELECT C.id_dec, C.id_modalite, C.id_noeud, C.evaluation, D.id_app
					  FROM les_feuilles_declarees_modalite_va_unique AS C
					  INNER JOIN 	
					  les_declarations AS D
					  ON C.id_dec= D.id_dec 
					  WHERE  D.id_app ='$this->id_app' and C.id_modalite = '$modalite->id_modalite'
					 ) AS B
					ON A.id_noeud = B.id_noeud 
			WHERE  A.id_arbre = '$arbre->id_arbre'
			GROUP BY A.id_noeud
					
			";	

			
		$sql="SELECT A.id_noeud, A.libelle, A.type, A.id_noeud_parent,  A.id_arbre, A.evaluation, B.evaluation_max
			  FROM ( $temp_table ) AS A 
			 		LEFT JOIN 
					 les_evaluations_feuilles_modalite_va_unique AS B
					ON A.id_noeud = B.id_noeud and B.id_modalite = '$modalite->id_modalite'						
			";
			
		$result = $this->bdd->executer($sql);
			
		$les_eva_noeuds = array();

		while ($ligne = mysql_fetch_assoc($result)) {
			//print_r($ligne);
			$noeud = new Noeud($ligne['id_noeud'],$ligne['id_arbre']);
			$noeud->libelle = $ligne['libelle'];
			$noeud->type = $ligne['type'];
			$noeud->id_noeud_parent = $ligne['id_noeud_parent'];
			$noeud->evaluation = ($ligne['evaluation']==NULL)? 0 : $ligne['evaluation'];
			$noeud->evaluation_max = ($ligne['evaluation_max']==NULL)? 0 : $ligne['evaluation_max'];

			if($noeud->evaluation_max ==0) $noeud->progression = 0;
			else{
				$x = round( 100*($noeud->evaluation / $noeud->evaluation_max) , 2);
				if($x > 100) $noeud->progression = 100;
				else $noeud->progression = $x;

			}
			//echo($noeud->evaluation." , ");
			//echo($noeud->evaluation_max." , ");
			//echo($noeud->progression." , ");

			$les_eva_noeuds[] = $noeud;

		}

		return $les_eva_noeuds;
			
	}

	/*
	 Cette fonction renvoit un tableau contenant tous les noeuds de l'arbre $arbre avec
	 leurs evaluations parapport au choix modalité mutiple  d'identifiant  $id_choix
	 */
	function evaluation_arbre_va_multiple($arbre,  $id_choix){


		$temp_table="SELECT A.id_noeud, A.libelle, A.type, A.id_noeud_parent,  A.id_arbre,  COUNT(B.id_choix)  AS evaluation
			 FROM   les_noeuds AS A 
			 		LEFT JOIN 
					 (SELECT C.id_dec, C.id_modalite, C.id_choix, C.id_noeud, D.id_app
					  FROM les_feuilles_declarees_modalite_choix AS C
					  INNER JOIN 	
					  les_declarations AS D
					  ON C.id_dec= D.id_dec 
					  WHERE  D.id_app ='$this->id_app' and C.id_choix = '$id_choix'
					 ) AS B
					ON A.id_noeud = B.id_noeud 
			WHERE  A.id_arbre = '$arbre->id_arbre'
			GROUP BY A.id_noeud ";	
			
		$sql="SELECT A.id_noeud, A.libelle, A.type, A.id_noeud_parent,  A.id_arbre, A.evaluation, B.evaluation_max
			  FROM ( $temp_table ) AS A 
			 		LEFT JOIN 
					 les_evaluations_feuilles_modalite_choix AS B
					ON A.id_noeud = B.id_noeud and B.id_choix = '$id_choix'	";
			
		$result = $this->bdd->executer($sql);
			
		$les_eva_noeuds = array();

		while ($ligne = mysql_fetch_assoc($result)) {

			$noeud = new Noeud($ligne['id_noeud'],$ligne['id_arbre']);
			$noeud->libelle = $ligne['libelle'];
			$noeud->type = $ligne['type'];
			$noeud->id_noeud_parent = $ligne['id_noeud_parent'];
			$noeud->evaluation = ($ligne['evaluation']==NULL)? 0 : $ligne['evaluation'];
			$noeud->evaluation_max = ($ligne['evaluation_max']==NULL)? 0 : $ligne['evaluation_max'];

			if($noeud->evaluation_max == 0) $noeud->progression = 0;
			else{
				$x = round( 100*($noeud->evaluation / $noeud->evaluation_max) , 2);
				if($x > 100) $noeud->progression = 100;
				else $noeud->progression = $x;
			}

			$les_eva_noeuds[] = $noeud;

		}
			
		return $les_eva_noeuds;
			
	}


	function is_apprenti() {
		return true;
	}

	/* Setter de l'ID */
	function set_id($id) {
		$this->id_app = $id;
	}

	/* Getter de l'ID */
	function get_id() {
		return $this->id_app;
	}
	/* Fonction indiquant si plusieurs ma sont associés à l'apprenti */
	function has_multiple_ma() {
		return (sizeof($this->ids_mas) > 1);
	}

	/* Fonction indiquant si id_ma a besoin d'etre mis a jour */
	function id_ma_has_to_be_updated() {
		// Si l'apprenti n'a pas de MA rattaché dans le LDAP
		if(sizeof($this->ids_mas) == 0) {
			return false;
		}

		// Si au moins un MA est rattaché à l'apprenti dans le LDAP
		$sql = strtoupper($this->bdd->requete);
		// Si l'apprenti est déjà présent en BD
		if (is_numeric(strpos($sql, "UPDATE"))) {
			// Si le MA issu de la BD est toujours associé à l'apprenti dans le LDAP
			if(in_array($this->id_ma,$this->ids_mas)) {
				// Pas de mise à jour nécessaire
				return false;
			}
		}
		// Mise à jour dans tous les autres cas
		return true;
	} 

	/**
	 * Fonction permettant de personnaliser l'affichage de l'objet
	 */
	public function __toString() {
		return "Apprenti ".parent::__toString();
	}
}// fin de la classe Apprenti

?>
