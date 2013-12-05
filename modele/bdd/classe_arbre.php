<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 09/01/06
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_noeud.php");
require_once($LEA_REP."modele/bdd/classe_modalite_va_unique.php");
require_once($LEA_REP."modele/bdd/classe_modalite_va_multiple.php");
/***********************************************************/
/***
 * Creation d'une clé unique
 */
function randomkeys($length)
{
	$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$key  = $pattern{rand(0,61)};
	for($i=1;$i<$length;$i++)
	{
		$key .= $pattern{rand(0,61)};
	}
	return $key;
}
/***********************************************************/
class Arbre{

	var $id_arbre;
	var $nom; 	// le nom de l'arbre (Référentiel métiers, listes des matieres, ...).
	var $type;  // mode de suivi auquel on valide les feulles de cet arbre (type = cfa ou type = entr)
	var $valider_all_feuilles;  // =1 si toutes les feuilles de cet arbre doivent êtres sélectionnées et validées lors de la déclaration d'une période.
	var $id_config; // la configuration à laquelle cet arbre est rataché.
	var $tab_noeuds;
	var $noeud_actif; 		// le noeud ouvert lors de l'affichage de l'arbre
	var $libelles_niveaux;
	var $nb_niveaux; 		// le nombre de niveaux de l'arbre
	var $bdd;       		// objet de connexion à la base de données
	var $bdd_pdo;       		// objet de connexion a la BD avec le driver PDO

	function Arbre($id_arbre) {
		$this->id_arbre = $id_arbre;
		$this->bdd = new Connexion_BDD_LEA();
		$this->bdd_pdo = new Connexion_BDD_LEA_PDO();
		$this->tab_noeuds = $this->get_noeuds();
	}

	/******************************* les méthodes ******************************/

	/* 
	 * Cette fonction  permet d'enregistrer les données du l'arbre créé dans la base
	 */
	function insert( )
	{
		// Preparation de la requete
		$statement = 'INSERT INTO les_arbres (nom, type, id_config) VALUES( :nom, :type, :idconfig)';
		$sth = $this->bdd_pdo->prepare( $statement );
		
		// Liage des parametres
		$stringValues = array( ':nom' => $this->nom, ':type' => $this->type );
		$intValues = array( ':idconfig' => $this->id_config );
		$this->bdd_pdo->bindValues( $sth, $stringValues );
		$this->bdd_pdo->bindValues( $sth, $intValues, PDO::PARAM_INT );
		
		// Execution de la requete
		$result = $this->bdd_pdo->execute( $sth );
		
		// Recuperation de l'id cree pour l'arbre
		$this->id_arbre = $this->bdd_pdo->lastInsertId( 'les_arbres', 'id_arbre' );
	}

	/* 
	 * Cette fonction  permet d'enregistrer les libelles des niveaux de cet arbre 
	 */
	function insert_libelle_niveau( $no, $libelle )
	{
		
		// Preparation de la requete
		$statement = 'INSERT INTO les_niveaux_arbre (no, libelle, id_arbre)
						VALUES( :no, :libelle, :idarbre )';
		$sth = $this->bdd_pdo->prepare( $statement );
		
		// Liage des parametres
		$stringValues = array( ':no' => $no, ':libelle' => $libelle );
		$intValues = array( ':idarbre' => $this->id_arbre );
		$this->bdd_pdo->bindValues( $sth, $stringValues );
		$this->bdd_pdo->bindValues( $sth, $intValues, PDO::PARAM_INT );
		
		// Execution de la requete
		$this->bdd_pdo->execute( $sth );
	}

	/* 
	 * Cette fonction  permet mettre à jour les libellé des niveaux de cet arbre 
	 */ 
	function update_libelle_niveau( $no, $libelle )
	{
		// Preparation de la requete
		$statement = 'UPDATE  les_niveaux_arbre
		    	     	SET libelle = :libelle					 
						WHERE id_arbre = :idarbre AND no = :no';
		$sth = $this->bdd_pdo->prepare( $statement );
		
		// Liage des parametres
		$stringValues = array( ':libelle' => $libelle );
		$intValues = array( ':no' => $no, ':idarbre' => $this->id_arbre );
		$this->bdd_pdo->bindValues( $sth, $stringValues );
		$this->bdd_pdo->bindValues( $sth, $intValues, PDO::PARAM_INT );
		
		// Execution de la requete
		$this->bdd_pdo->execute( $sth );
	}

	/* 
	 * Cette fonction renvoit le libelle du niveau  $no de cet arbre 
	 */
	function get_libelle_niveau( $no )
	{
		// Preparation de la requete
		$statement = 'SELECT libelle
		    	     	FROM les_niveaux_arbre
					 	WHERE id_arbre = :idarbre AND no = :no';
		$sth = $this->bdd_pdo->prepare( $statement );
		
		// Liage des parametres
		$intValues = array( ':no' => $no, ':idarbre' => $this->id_arbre );
		$this->bdd_pdo->bindValues( $sth, $intValues, PDO::PARAM_INT );
		
		// Execution de la requete
		$this->bdd_pdo->execute( $sth );

		if ( $ligne = $this->bdd_pdo->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			return $ligne[ 'libelle' ] ;
		}
	}

	/* Cette fonction  le libelle du dernier niveau de l'arbre (libelle de la feuille)
	 */

	function get_libelle_feuille(){
		$nb = $this->get_nb_niveaux();
		return $this->get_libelle_niveau($nb);
	}


	/* Cette fonction renvoit  le nombre de niveaux de cet arbre */

	function get_nb_niveaux(){
			
		$sql="SELECT COUNT(no) as nb
		    	     From les_niveaux_arbre
					 WHERE id_arbre='$this->id_arbre' 
					";
			
		$result = $this->bdd->executer($sql);

		if ($ligne = mysql_fetch_assoc($result)) {
			return $ligne['nb'] ;
		}
	}


	/* Cette fonction  mêt à jour le nom de l'arbre dans la base*/ 

	function update(){

		$sql="UPDATE les_arbres
		         SET nom='$this->nom',
				 	 valider_all_feuilles = '$this->valider_all_feuilles'
				WHERE id_arbre='$this->id_arbre' ";

		$result = $this->bdd->executer($sql);
			
	}

	/*
	 Cette fonction  permet de supprimer cet arbre de la base de données
	 */

	function delete(){

		$sql="DELETE FROM les_arbres
				 WHERE id_arbre='$this->id_arbre'";				
		$result = $this->bdd->executer($sql);
	}

	/*
	 Cette fonction  permet de supprimer le contenu de cet arbre
	 */

	function vider(){

		$sql="DELETE FROM les_noeuds
				 WHERE id_arbre='$this->id_arbre'";				
		$result = $this->bdd->executer($sql);
	}

	/*
	 Cette fonction permet de copyer tous les noeuds descendants du noeud d'identifiant id_noeud_racine
	 de cet arbre dans l'arbre d'identifiant id_arbre_dest .
	 */

	function dupliquer_noeuds($id_noeud_racine, $id_noeud_racine_dest, $id_arbre_dest) {

		for ($x= 0; $x < count($this->tab_noeuds); $x++ ) {

			if ($this->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
				$noeud = new Noeud(0,  $id_arbre_dest);
				$noeud->libelle = addslashes($this->tab_noeuds[$x]->libelle);
				$noeud->id_noeud_parent = $id_noeud_racine_dest;
				$noeud->type =  $this->tab_noeuds[$x]->type;
				$noeud->insert();
				$this->dupliquer_noeuds($this->tab_noeuds[$x]->id_noeud, $noeud->id_noeud, $id_arbre_dest );
					
			}
		}


	}

	/*
	 Cette fonction  permet de créer un arbre ayant  les même caractéristique de cette arbre 
	 notament : les mêmes libelles de niveau , le même nom et le même contenu.
	 pour le suivi $type_suivi(cfa ou entr) de la configuration d'identifiant $id_config

	 Elle renvoit l'identifiant du nouvel arbre créé
	 */

	function dupliquer($id_config, $type_suivi){

		$arbre = new Arbre(0);
		$arbre->nom = addslashes($this->nom);
		$arbre->id_config = $id_config;
		$arbre->type = $type_suivi;
		$arbre->valider_all_feuilles = $this->valider_all_feuilles;
		$arbre->insert();
			
		$this->set_libelles_niveaux();

		$no = 1;
			
		foreach($this->libelles_niveaux as $libelle){
			$arbre->insert_libelle_niveau($no, addslashes($libelle));
			$no++;
		}
		$this->tab_noeuds = $this->get_noeuds(0);

		$this->dupliquer_noeuds( 0, 0, $arbre->id_arbre);

		return   $arbre->id_arbre ;
	}

	/* Cette fonction  renvoit la liste des identifiants des noeuds racines de cet arbre
	 (les noeuds qui n'ont pas de parent)
	 */

	function get_id_noeuds_racine(){

		$sql="SELECT id_noeud
				 FROM  les_noeuds 
				 WHERE id_noeud_parent=0 and id_arbre='$this->id_arbre'
				 ";	   		   
		$result = $this->bdd->executer($sql);
			
		$les_id_noueds_racine = array();

		while ($ligne = mysql_fetch_assoc($result)) {
			$les_id_noueds_racine[] = $ligne['id_noeud'];
		}

		return $les_id_noeuds_racine;
			
	}

	/* Cette fonction  renvoit la liste des noeuds feuille de l'arbres
	 */

	function get_feuilles(){

		$sql="SELECT id_noeud, libelle, id_noeud_parent
				 FROM  les_noeuds 
				 WHERE id_arbre='$this->id_arbre' and type = 'feuille'
				 ";	   		   
		$result = $this->bdd->executer($sql);
			
		$les_feuilles = array();

		while ($ligne = mysql_fetch_assoc($result)) {
			$noeud = new Noeud($ligne['id_noeud'], $this->id_arbre);
			$noeud->libelle = $ligne['libelle'];
			$noeud->type = 'feuille';
			$noeud->id_noeud_parent = $ligne['id_noeud_parent'];
			$les_feuilles[] = $noeud;
		}

		return $les_feuilles;
			
	}

	/* Cette fonction  renvoit la liste des identifiant des fauilles de cet arbres
	 */

	function get_id_feuilles(){

		$sql="SELECT id_noeud
				 FROM  les_noeuds 
				 WHERE id_arbre='$this->id_arbre' and type = 'feuille'
				 ";	   		   
		$result = $this->bdd->executer($sql);
			
		$les_id_feuilles = array();

		while ($ligne = mysql_fetch_assoc($result)) {

			$les_id_feuilles[] = $ligne['id_noeud'];
		}

		return $les_id_feuilles;
			
	}


	/*
	 Cette fonction  renvoit la liste de tous les  noeuds de cette arbre
	 */

	function get_noeuds($html=1){

		$sql="SELECT *
		       FROM les_noeuds
			   WHERE  id_arbre='$this->id_arbre'";	   		   

		$result = $this->bdd->executer($sql);
			
		$les_noeuds = array();
			
		while($ligne = mysql_fetch_assoc($result)) {
			$noeud = new Noeud($ligne['id_noeud'], $this->id_arbre );

			if($html)	$noeud->libelle = htmlentities($ligne['libelle'],ENT_QUOTES, "UTF-8");
			else 		$noeud->libelle = $ligne['libelle'];

			$noeud->type = $ligne['type'];
			$noeud->id_noeud_parent=$ligne['id_noeud_parent'];
			$noeud->id_arbre=$this->id_arbre;

			$les_noeuds[]=$noeud;

		}
			
		return 	$les_noeuds;

	}

	/*
	 Cette fonction  permet de récuperer de la base de données touts les libelles des niveaux de l'arbre
	 */

	function set_libelles_niveaux(){
			
		$sql="SELECT *
		       FROM les_niveaux_arbre
			   WHERE  id_arbre='$this->id_arbre'
			   ORDER BY no ";	   		   

		$result = $this->bdd->executer($sql);
		$this->libelles_niveaux=array();
			
		while ($ligne = mysql_fetch_assoc($result)) {

			$this->libelles_niveaux[] = $ligne['libelle'];

		}


	}


	/*
	 Cette fonction renvoit les modalités à réponses muliple utilisées par l'acteur $acteur 
	 pour valider les feuilles de cet arbre à la période d'identifiant $id_periode
	  
	 $acteur ='app' ====> Apprenti
	 $acteur ='ma'  ====> Maitre d'apprentissage
	 $acteur ='tuteur_cfa' ====> tuteur_cfa

	 Si $id_periode = 0. la foncion revoit  les modalités de toutes les périodes
	 */

	function get_modalites_multiple($acteur, $id_periode = 0 ) {
		if($id_periode == 0){

			$sql="SELECT id_modalite
 			 	FROM les_modalites_va_multiple 
    		 	WHERE id_arbre='$this->id_arbre' and 
					  acteur ='$acteur' 
				";

		}
		else {

		 $sql="SELECT A.id_modalite
 			 	FROM les_modalites_va_multiple A , les_periodes_modalite_va_multiple B
    		 	WHERE A.id_modalite = B.id_modalite and 
					  id_arbre='$this->id_arbre' and 
					  acteur ='$acteur' and 
					  B.id_periode = '$id_periode'
				";
		}
		$result = $this->bdd->executer($sql);
			
		$les_modalites = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$modalite = new Modalite_va_multiple($ligne['id_modalite']);
			$modalite->set_detail();
			$les_modalites[] = $modalite;

		}

		return $les_modalites;
	}

	/*
	 Cette fonction renvoit les modalités à réponse unique (texte, frequence, note ) utilisées par l'acteur $acteur 
	 pour valider les feuilles de  cet arbre à la période d'identifiant $id_periode

	 */

	function get_modalites_unique($acteur, $id_periode=0) {

		if($id_periode == 0){

			$sql="SELECT id_modalite
 			 	FROM les_modalites_va_unique
    		 	WHERE id_arbre='$this->id_arbre' and 
					  acteur ='$acteur' 
				";

		}
		else {

			$sql="SELECT A.id_modalite
 			 	FROM les_modalites_va_unique A , les_periodes_modalite_va_unique B
    		 	WHERE A.id_modalite = B.id_modalite and 
					  id_arbre='$this->id_arbre' and 
					  acteur ='$acteur' and 
					  B.id_periode = '$id_periode';
					  
				";
		}

		$result = $this->bdd->executer($sql);
			
		$les_modalites = array();
			
		while ($ligne = mysql_fetch_assoc($result)) {
			$modalite = new Modalite_va_unique($ligne['id_modalite']);
			$modalite->set_detail();
			$les_modalites[] = $modalite;

		}

		return $les_modalites;
	}


	/*
	 Cette fonction renvoit un tableau contenant toutes les modalités  utilisées par l'acteur $acteur 
	 pour valider les feuilles de  cet arbre à la période d'identifiant $id_periode


	 $acteur ='app' ====> apprenti
	 $acteur ='ma'  ====> maitre d'apprentissage
	 $acteur ='tuteur_cfa' ====> tuteur_cfa
	 $acteur ='ens' ====> un enseignant quelconque de la formation
	 $acteur ='rl' ====> parent (représentant légal)
	 $acteur ='rf' ====> responsable de la formation
	 */

	function get_modalites($acteur, $id_periode=0) {

		$les_modalites_va_multiple = $this->get_modalites_multiple($acteur, $id_periode);
		$les_modalites_va_unique = $this->get_modalites_unique($acteur, $id_periode);

		return array_merge($les_modalites_va_multiple, $les_modalites_va_unique) ;
	}



	/*
	 Cette fonction  permet de récuperer de la base de données le nom et le type de cette arbre 
	 $html=1, si les données récupérées vont être afficher dans une page html. 0 sino
	 */

	function set_detail(){
			
		$sql="SELECT *
		       FROM les_arbres
			   WHERE  id_arbre='$this->id_arbre'";	   		   

		$result = $this->bdd->executer($sql);
			
		if ($ligne = mysql_fetch_assoc($result)) {
			$this->nom = $ligne['nom'];
			$this->valider_all_feuilles = $ligne['valider_all_feuilles'];
			$this->type = $ligne['type'];
			$this->id_config = $ligne['id_config'];

		}


	}


	/* cette fonction gère le décallage des éléments lors de l'affichage de l'arbre
	 suivant leur position dans l'arborescence
	 */

	function get_espace($rang){


		$espace = "";

		for($j = 0; $j < $rang ; $j++){
			$espace.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";


		}
			
			
		return $espace;
	}

	/*
	 Cette fonction permet d'afficher  la branche de cette arbre qui conduit aux fils de son noeud actif.
	 $rang: represente l'indice  du rang des noeuds à afficher.
	 */

	function afficher_branche($les_id_noeuds_ascendants, $rang) {
			
		global $LEA_URL;
		global $URL_THEME;

		$src_img_modif   = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_edit.png';
		$src_img_supp    = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_drop.png';
		$src_img_feuille = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_feuille.png';
		$src_img_performance  = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_performance.png';

		$niveau = $this->noeud_actif->niveau; // le niveau du noeud actif de l'arbre

		if($rang <= $niveau) {

			$id_noeud_parent = $les_id_noeuds_ascendants[$rang];
			$noeud_parent = new Noeud($id_noeud_parent, $this->id_arbre);

			$les_noeuds_fils = $noeud_parent->get_noeuds_fils();

			$espace = Arbre::get_espace($rang);

			foreach($les_noeuds_fils as $noeud){
				$name_lien = randomkeys(20);
				echo"<br />$espace";

				echo("
	<a href='./config_suivi/maj_noeud_v.php?action=supp&id_noeud=".$noeud->id_noeud."&id_arbre=".$this->id_arbre."&id_noeud_actif=".$this->noeud_actif->id_noeud."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']."'
		onClick='return deleteConfirm(\"ce noeud\")'> 
			<img src='$src_img_supp' border='0' title='supprimer'>
	</a>
	<a href='#' 
		onClick=\"window.open('./config_suivi/maj_noeud.php?action=modif&id_noeud=".$noeud->id_noeud."&id_arbre=".$this->id_arbre."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']."','', 'width=950, height=400, scrollbars=yes, resizable =yes' )\"> 
			<img src='$src_img_modif' border='0' title='modifier'>
	</a>");

				if($noeud->id_noeud == $this->noeud_actif->id_noeud) {
					echo"
	<font size='4' color='#000000'> $noeud->libelle </font>";										  
				} else {
					if( $noeud->type == "feuille") {
						echo"
	<font color='green' size='2'> $noeud->libelle </font> 
	<a class ='lienfeuille'>&nbsp;</a>"; 
					}else  {
						echo"
	<a href='options.php?cmd=maj_arbre&id_arbre=".$this->id_arbre."&id_noeud=".$noeud->id_noeud."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']."'>$noeud->libelle</a>";
					}
				}
				if(isset($les_id_noeuds_ascendants[$rang+1]) && $noeud->id_noeud == $les_id_noeuds_ascendants[$rang+1])
				$this->afficher_branche($les_id_noeuds_ascendants, $rang+1);
			}// fin foreach

			if($rang == $niveau) {
				$id_noeud_parent = $this->noeud_actif->id_noeud;

				echo"
	<form name='theForm' 
			action='./config_suivi/maj_noeud_v.php?&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']."' 
			method='post'>
		<input type='hidden' name='action' value='nouv'>
		<input type='hidden' name='id_noeud_parent' value='$id_noeud_parent'>
		<input type='hidden' name='id_arbre' value='$this->id_arbre'>";

				echo"$espace";

				if(isset($this->libelles_niveaux[$this->noeud_actif->niveau]))
				echo($this->libelles_niveaux[$this->noeud_actif->niveau]);

				echo"
	<input name='libelle' type='text'>							     
	<a class ='lienfeuille'>&nbsp;</a>";
					
				if( $rang == $this->nb_niveaux-1) {
					echo"
	<input type='hidden' name='type' value='feuille'>";
				} else {
					echo"
	<input type='checkbox'  name='type' value='feuile'>";
				}

				echo"
	<input type='submit'  value='ajouter'></form>";
			}
		}
	}

	/*
	 Cette fonction permet d'afficher  tous les noeuds de l'arbre
	 la racine est le noeud d'identifiant 0;

	 function afficher($id_noeud_racine) {
	 global $LEA_URL;
	 global $URL_THEME;
	 $src_img_arbre  = $URL_THEME."images/picto_arbre.png";
	 //ballayage du l'arbre
	 $cgood = false;
	 for ($x=0; $x < count($this->tab_noeuds); $x++ ) {
		if ($this->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
		$cgood = true;
		}
		}
		if($cgood){
		echo"<ul>";
		for ($x=0; $x < count($this->tab_noeuds); $x++ ) {
		if ($this->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
		echo "<li class='arbre'>";
		if( $this->tab_noeuds[$x]->type == "feuille") {
		echo $this->tab_noeuds[$x]->libelle;
		} else{
		echo("<b>".$this->tab_noeuds[$x]->libelle."</b>");
		}
		$this->afficher($this->tab_noeuds[$x]->id_noeud);
		echo"</li>";
		}
		}
		echo"</ul>";
		}
		}
		*/

	/*
	 Cette fonction permet d'afficher  tous les noeuds de l'arbre
	 la racine est le noeud d'identifiant 0;
	 */
	function afficher_pdf($id_noeud_racine, $mon_niveau = 0) {

		//global $mon_arbre;

		//ballayage du l'arbre
		$cgood = false;
		for ($x=0; $x < count($this->tab_noeuds); $x++ ) {
			if ($this->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
				$cgood = true;
			}
		}


		if($cgood){

			$ma_feuille = array();
			$mon_niveau++;

			for ($x=0; $x < count($this->tab_noeuds); $x++ ) {
				if ($this->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {

					$mon_noeud["NIVEAU"] = $mon_niveau;
					$mon_noeud["LIBELLE"] = $this->tab_noeuds[$x]->libelle;

					if( $this->tab_noeuds[$x]->type == "feuille") {
						$mon_noeud["TYPE"] = "feuille";
					} else {
						$mon_noeud["TYPE"] = "noeud";
					}

					array_push($_SESSION["mon_arbre_a_imp"], $mon_noeud);
					$this->afficher_pdf($this->tab_noeuds[$x]->id_noeud, $mon_niveau);
				}
			}
		}
	}

	function afficher($id_noeud_racine, $id_ul = NULL) {
		global $LEA_URL;
		global $URL_THEME;

		//ballayage du l'arbre
		$cgood = false;
		for ($x=0; $x < count($this->tab_noeuds); $x++ ) {
			if ($this->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
				$cgood = true;
			}
		}

		if($cgood){
			echo"
<ul id='".$id_ul."'>";
			for ($x=0; $x < count($this->tab_noeuds); $x++ ) {
				if ($this->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
					$id_li = randomkeys(20);
					if( $this->tab_noeuds[$x]->type == "feuille") {
						echo "	<li class='feuille'>";
						echo '		<a class ="lienfeuille">&nbsp;</a>';
						echo $this->tab_noeuds[$x]->libelle;
					} else{
						echo "	<li class='branche'>";
						echo "		<a class =\"lienbranche\" onclick=\"afficherMasquer('".$id_li."')\">&nbsp;</a>";
						echo"		<b>".$this->tab_noeuds[$x]->libelle."</b>";
					}
					$this->afficher($this->tab_noeuds[$x]->id_noeud, $id_li);
					echo"	</li>";
				}
			}
			echo "</ul>";
		}
	}


	/*
	 Cette fonction permet d'afficher l'arbre pour mettre à jours les critères 
	 de performance de ses feuille;
	 */

	function maj_criteres_performance($id_noeud_racine, $niveau = 0) {

		global $LEA_URL;
		global $URL_THEME;

		$src_img_feuille = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_feuille.png';
		$src_img_performance  = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_performance.png';
		$src_img_arbre  = $LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_arbre.png';
		//ballayage du l'arbre
		echo"<ul>";
		for ($x=0; $x < count($this->tab_noeuds); $x++ ) {
			if ($this->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
				$noeud = $this->tab_noeuds[$x];
				$marge = $niveau * 10;
				
				echo "<li class='arbre' style='margin-left:".$marge."px' >";
				if( $this->tab_noeuds[$x]->type == "feuille") {
					echo("<a href=\"#\" onClick=\"window.open('./config_suivi/performance_feuille.php?action=modif&id_noeud=$noeud->id_noeud','', 'width=950, height=600, scrollbars=yes, resizable =yes ' )\"> 
				   			<img src='$src_img_performance'  title='modifier crit&egrave;res de perfomance'>
				   		 </a>	");
					echo($this->tab_noeuds[$x]->libelle) ;
				}
				else {
					echo("<img src=".$src_img_arbre."><b>&nbsp;".$this->tab_noeuds[$x]->libelle."</b>");
				}

				$this->maj_criteres_performance($this->tab_noeuds[$x]->id_noeud, $niveau+1);
					
				echo"</li>";
			}
		}
		echo"</ul>";

	}


	/*
	 Cette fonction  met à jour l'évaluation d'une modalité à réponse numérique (note ou fréquence)
	 appliquée à toutes les feuilles de cet arbre.

	 */

	function update_evaluation_modalite_va_unique($id_modalite, $evaluation_max){

		$sql="DELETE FROM les_evaluations_feuilles_modalite_va_unique
					 WHERE id_modalite = '$id_modalite' and 
					 	   id_noeud IN (
						   				SELECT id_noeud
										FROM les_noeuds
										WHERE id_arbre ='$this->id_arbre' 
						   				) ";
						   					
						   				$result = $this->bdd->executer($sql);

						   				$les_feuilles =	$this->get_feuilles();
						   					
						   				foreach($les_feuilles as $feuille) {

						   					$sql= "INSERT INTO les_evaluations_feuilles_modalite_va_unique
		    	     (id_modalite, id_noeud, evaluation_max)
					VALUES('$id_modalite', '$feuille->id_noeud', '$evaluation_max')";

						   					$result = $this->bdd->executer($sql);
						   				}

	}


	/*
	 Cette fonction  met à jour l'évaluation d'un choix de modalité à réponse multiple
	 appliquée à toutes les feuilles de l'arbre
	 */

	function update_evaluation_choix($id_choix, $evaluation_max){

		$sql="DELETE FROM les_evaluations_feuilles_modalite_choix
					 WHERE id_choix = $id_choix and 
					 		 id_noeud IN (
						   				SELECT id_noeud
										FROM les_noeuds
										WHERE id_arbre ='$this->id_arbre' 
						   				) ";

			
		$result = $this->bdd->executer($sql);

		$les_feuilles =	$this->get_feuilles();
			
		foreach($les_feuilles as $feuille) {

			$sql="INSERT INTO les_evaluations_feuilles_modalite_choix
		    	     (id_choix, id_noeud, evaluation_max)
					VALUES('$id_choix', '$feuille->id_noeud', '$evaluation_max')";

			$result = $this->bdd->executer($sql);
		}

	}


	/*
	 *  Retourne la représentation XML de l'arbre
	 */
	function to_xml( ) {
		// Récuperer le libellé des niveaux de l'arbre s'ils ne sont pas déjà chargés
		if (!is_array($this->libelles_niveaux)) {
			$this->set_libelles_niveaux();
		}
	
		// Constitution du XML
		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n<arbre>\n";
		$decalage = "   ";
		
		$xml .= $decalage."<niveaux>\n";
		foreach ($this->libelles_niveaux as $niveau) {
			$xml .= $decalage.$decalage."<niveau>$niveau</niveau>\n";
		}
		$xml .= $decalage."</niveaux>\n";
		
		$tabNiveaux = array();
		$niveau = -1;
		$niveauPrec = $niveau;
		$tabNiveaux[0] = 0;
        $typePrecedent = "";
		foreach($this->tab_noeuds as $noeud ) {
			$txt = "";
			$indent = "";
			
			if (isset($tabNiveaux[$noeud->id_noeud_parent])) {
				$niveau = $tabNiveaux[$noeud->id_noeud_parent] + 1;
			}
			if (!isset($tabNiveaux[$noeud->id_noeud])) {
				$tabNiveaux[$noeud->id_noeud] = $niveau;
			}
			for ($i=0 ; $i<$niveau; $i++) $indent .= $decalage;
			
            // Si l'on passe d'un niveau feuille a un niveau branche
            if ($niveau<$niveauPrec) {
                // On referme la branche precedente
				$delta = $niveauPrec - $niveau;
				for ($i=$delta ; $i>0 ; $i--) {
					$ligne = "";
					for ($j=0 ; $j<$i-1 ; $j++) $ligne .= $decalage;
					$ligne .= "</branche>\n";
					$txt .= $indent.$ligne;
				}
			} 
            
            // Si le noeud precedent etait une branche sans feuille
            if( $typePrecedent == "branche" && $noeud->type == "branche" ) 
            {
                // On supprime le dernier retour a la ligne
                $txt = substr_replace($txt,"",-3);
                // On referme la branche precedente
                $txt .= "</branche>\n";
            }

            // On ouvre le nouveau noeud
			$txt .= $indent."<".$noeud->type.">".html_entity_decode($noeud->libelle, ENT_QUOTES, "UTF-8");
            // Si le noeud actuel est une feuille
            if ($noeud->type == "feuille") {
                // On referme immediatement la feuille
				$txt = $txt."</feuille>";
			}
			$txt .= "\n";
			$xml .= $txt; 
			$niveauPrec = $niveau;
            $typePrecedent = $noeud->type;
		}
        // Si le dernier noeud etait une branche sans feuille
        if( $typePrecedent == "branche" ) 
        {
            // On referme la branche precedente
            $xml .= "</branche>";
        }
		for ($i=$niveau ; $i>1 ; $i--) {
			$ligne = "";
			for ($j=0 ; $j<$i-1 ; $j++) $ligne .= $decalage;
			$ligne .= "</branche>\n";	
			$xml .= $ligne; 
		}
		$xml .= "</arbre>\n";
		return $xml;
	}

	/*
	 * Crée un objet arbre à partir de sa représentation XML
	 */
	static function from_xml($xml, $nom, $idConfig, $type) {
		$parser = xml_parser_create();
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, $xml, $elements, $tags);
		xml_parser_free($parser);	
		
		$arbre = new Arbre(0);
		$arbre->nom = $nom;
		$arbre->id_config = $idConfig;
		$arbre->type = $type;
		$arbre->libelles_niveaux = array();
		
		$niveauMax = 0;
		$nbNoeuds = 0;
		$tabParents = array();
		$tabParents[0] = 0;
		$nbNiveaux = 0;
		foreach($elements as $element) {
			if ($element['type'] == "open" || $element['type'] == "complete") {
				if ($element['tag'] == "branche" || $element['tag'] == "feuille") {
					$libelle = str_replace("\n", "", $element["value"]);
					$libelle = ereg_replace("^[ \t]+", "", $libelle); 
					$libelle = ereg_replace("[ \t]+$", "", $libelle);
					$level = $element['level'] - 1; 
					if ($level > $niveauMax) $niveauMax = $level;
					if ($element['tag'] == "branche") {
						$tabParents[$level] = $nbNoeuds+1;
					}
					$noeud = new Noeud(0);
					$noeud->libelle = to_sql($libelle);
					$noeud->type = $element['tag'];
					$noeud->niveau = $level;
					$noeud->id_noeud = $nbNoeuds+1;
					$noeud->id_noeud_parent = $tabParents[$level - 1];
					$arbre->tab_noeuds[$nbNoeuds] = $noeud;
					$nbNoeuds++;
				} else if ($element['tag'] == "niveau") {
					$libelle = str_replace("\n", "", $element["value"]);
					$libelle = ereg_replace("^[ \t]+", "", $libelle); 
					$libelle = ereg_replace("[ \t]+$", "", $libelle);
					$nbNiveaux++;
					$arbre->libelles_niveaux[$nbNiveaux] = to_sql($libelle);
				}
			}
		}

		$arbre->nb_niveaux = $niveauMax;
		return $arbre;
	}
	
	function insertAll() {
		$this->insert();		
		$nouveauxId = array();
		$nouveauxId[0] = 0;
		
		// Insertion des niveaux
		if (isset($this->libelles_niveaux) && is_array($this->libelles_niveaux)) {
			$i = 1;
			foreach ($this->libelles_niveaux as $niveau) {
				$this->insert_libelle_niveau($i, $this->libelles_niveaux[$i]);
				$i++;
			}
		}
		
		// insertion des noeuds
		foreach($this->tab_noeuds as $noeud) {
			$noeud->id_arbre = $this->id_arbre;
			$ancienId = $noeud->id_noeud;
			$noeud->id_noeud_parent = $nouveauxId[$noeud->id_noeud_parent];
			$noeud->insert();
			$nouveauxId[$ancienId] = $noeud->id_noeud;
		}
	}
	
}// fin de la classe
?>
