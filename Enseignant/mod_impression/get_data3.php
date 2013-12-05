<?php
/***********************************************************/   
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.1
  // Date: 16/05/07
/***********************************************************/
require_once('../secure.php');

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

/***********************************************************/
require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_arbre.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_param_criteres.php");

?>
<html>
	<head>
<!--
		<link rel="stylesheet" type="text/css" href="../../themes/cub/commun.css" media="screen"/>
 		<script type="text/javascript" src="../../javascript/stdlib.js"></script>
-->
	<head>
	<body>
	
	
<?php
//Instanciation d'un apprenti
$apprenti = new Apprenti($_SESSION["imp_apprenti_tmp"]);
$apprenti->set_detail();

// $apprenti->adresse
// $apprenti->nom
// $apprenti->prenom

// Instanciation de la classe de l'apprenti
$classe = new Classe($apprenti->id_cla);
$classe->set_detail();

// $classe->libelle

// Instanciation de la formation de l'apprenti
$formation = new Formation($_SESSION['id_for']);
$formation->set_detail();

// $formation->nom

// Instanciation d'un MA de l'apprenti
$ma = new Maitre_apprentissage($apprenti->id_ma);
$ma->set_detail();

// $ma->nom

// Instanciation de l'entreprise du MA
$entreprise = new Entreprise($ma->id_entr);
$entreprise->set_detail();

// $entreprise->nom

// Instanciation du tuteur CFA
$tuteur = new Enseignant($apprenti->id_ens);
$tuteur->set_detail();

// $tuteur->nom
// $tuteur->prenom

echo "<br /><strong>Nom prenom apprenti :</strong><br />";
echo $apprenti->nom." ".$apprenti->prenom;

echo "<br /><strong>Classe :</strong><br />";
echo $classe->libelle;

echo "<br /><strong>Formation :</strong><br />";
echo $formation->nom;

echo "<br /><strong>Adresse apprenti :</strong><br />";
echo $apprenti->adresse;

echo "<br /><strong>Maitre d'apprentissage (nom prenom):</strong><br />";
if($apprenti->id_ma > 0) {
	echo $ma->nom." ".$ma->prenom;
} else {
	echo "<i>Non renseign&eacute;</i>";
}

echo "<br /><strong>Nom entreprise :</strong><br />";
echo $entreprise->nom;

echo "<br /><strong>Tuteur CFA (nom prenom) :</strong><br />";
if($apprenti->id_ens > 0) {
	echo $tuteur->nom." ".$tuteur->prenom;
} else {
	echo "<i>Non renseign&eacute;</i><br><br>";
}

///////////////////////////////////////////////////////////////////////
//	Fonctions d'affichage d'un arbre et de la visualisation de la progression
///////////////////////////////////////////////////////////////////////

//  Cette fonction recursive qui calcule les evaluations des noeuds branche de l'arbre
//   reprï¿½sentï¿½ par le tableau les_eva_noeuds et elle renvoit l'evaluation de son neoud racine

	function eval_noeud($id_noeud_racine, $les_eva_noeuds) {	
	
		$sum = 0;
		$nb  = 0;
		  
		for ($x=0; $x < count($les_eva_noeuds); $x++ ) {
			if ($les_eva_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
				$nb += 1;	
				if( $les_eva_noeuds[$x]->type == "feuille") {			
					$sum += $les_eva_noeuds[$x]->progression;
				} else {
					$eva = eval_noeud($les_eva_noeuds[$x]->id_noeud, $les_eva_noeuds);
					$les_eva_noeuds[$x]->progression =  round($eva, 2);
					$sum += $eva;
				}			
			}
		}
		 
		if( $nb > 0 ) return ($sum/$nb);
		else return 0;
	}

// cette fonction affiche les noeuds de l'arbre 

function construire_arbre($id_noeud_racine, $les_eva_noeuds, $mon_niveau = 0) {										

	global $mon_arbre;
	
	$mon_noeud = array();
	$mon_niveau++;
	for($x=0; $x < count($les_eva_noeuds); $x++ ) {
		if($les_eva_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {

			$mon_noeud["NIVEAU"] = $mon_niveau;
			$mon_noeud["LIBELLE"] = $les_eva_noeuds[$x]->libelle;
			
			if($les_eva_noeuds[$x]->type == "feuille") {
				$mon_noeud["TYPE"] = "feuille";
				$mon_noeud["VALEUR"] = $les_eva_noeuds[$x]->progression;
			} else {
				$mon_noeud["TYPE"] = "noeud";
				$mon_noeud["VALEUR"] = round(eval_noeud($les_eva_noeuds[$x]->id_noeud, $les_eva_noeuds), 2);
			}
							
			array_push($mon_arbre, $mon_noeud);
			construire_arbre($les_eva_noeuds[$x]->id_noeud, $les_eva_noeuds, $mon_niveau); 
		}
	}
}

function afficher_pdf($id_noeud_racine, $mon_niveau = 0) {

	global $mon_arbre;
	
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
				
				array_push($mon_arbre, $mon_noeud);
				$this->afficher_pdf($this->tab_noeuds[$x]->id_noeud, $mon_niveau);
			}		
		}
	}
}
/*
Cette fonction affiche la bare de progression qui correspond ï¿½ la valeur $val 
$val <=0 		affiche 0%
0 < $val < 100  affiche val%

*/
function progressbar($val){
	if($val <= 0) $width = 0; 
	elseif ($val <= 100) $width = round($val);
	else $width = 100;

	return $width;
}


	$les_id_arbres = (isset($_SESSION["imp_arbre"])) ? unserialize($_SESSION["imp_arbre"]) : array();
	$refs_arbres_modalites = (isset($_SESSION["imp_modalite_arbre"])) ? unserialize($_SESSION["imp_modalite_arbre"]) : array();
	
	$refs_arbres_modalites_criteres = array();
	
	// on test les critÃ¨res afficher et on les met dans le tableau Ã  afficher
	foreach($refs_arbres_modalites as $ref_arbre_modalite) {
		list($id_arbre, $id_modalite, $classe_modalite) = explode(":", $ref_arbre_modalite);
		
		if($classe_modalite == 'modalite_va_multiple'){
			$modalite = new Modalite_va_multiple($id_modalite);
			$modalite->set_detail();
			
			$les_criteres = $modalite->get_choix();
			foreach( $les_criteres  as $critere ){
				$param_crit = new Param_criteres($modalite->id_modalite, $critere->id_choix);
				$param_crit->set_detail();
				
				if($param_crit->mode_affichage == "aucun" || is_null($param_crit->mode_affichage)) {
					continue;
				} else {
					$ref_arbre_modalite_critere = $id_arbre.":".$id_modalite.":".$classe_modalite.":".$critere->id_choix;
					array_push($refs_arbres_modalites_criteres, $ref_arbre_modalite_critere);
				}
			}
		} else{
			$param_crit = new Param_criteres($id_modalite);
			$param_crit->set_detail();
			
			$ref_arbre_modalite_critere = $id_arbre.":".$id_modalite.":".$classe_modalite.":NULL";
			array_push($refs_arbres_modalites_criteres, $ref_arbre_modalite_critere);
		}
	}

	$tableau_arbres = array_merge($les_id_arbres, $refs_arbres_modalites_criteres);
	asort($tableau_arbres);
	
	foreach($tableau_arbres as $ligne_arbre) {
		
		if(preg_match('`^([0-9]+)$`', $ligne_arbre)) {	
			
			////////////////////////////////////////////////////////////////////////////
			//	Affichage des arbres pour lesquels aucune modalitÃ© n'a Ã©tÃ© selectionnÃ©e.
			////////////////////////////////////////////////////////////////////////////

			$arbre = new Arbre($ligne_arbre);
			$arbre->set_detail();
			
			if ($arbre->type == "entr") {
		    	$titre_bilan = "<img src=\"".$URL_THEME."images/picto_suivi_entreprise.png\"> Bilan Entreprise";
			} elseif($arbre->type == "cfa") {
				$titre_bilan = "<img src=\"".$URL_THEME."images/picto_suivi_cfa.png\"> Bilan CFA";
			}
			
			echo "<h1>".$titre_bilan.":</h1>";
			echo "<h2>Arbre: ".strtoupper($arbre->nom)."</h2>";
			echo "<h2>Modalit&eacute;: <i>Sans modalit&eacute;</i></h2>";
			
			$mon_arbre = array();
			
			$noeud["NIVEAU"] = "0";
			$noeud["TYPE"] = "noeud";
			$noeud["LIBELLE"] = $arbre->nom;
			
			array_push($mon_arbre, $noeud);
			
			$arbre->afficher_pdf(0);
				
			echo "<table cellspacing='10'>
					<tr>
						<th>NIVEAU</th>
						<th>TYPE</th>
						<th>LIBELLE</th>
					</tr>";
			foreach($mon_arbre as $noeud) {
				echo "
					<tr".(($noeud["TYPE"] == "noeud") ? " style=\"font-weight:bold;\"" : "").">
						<td>".$noeud["NIVEAU"]."</td>
						<td>".$noeud["TYPE"]."</td>
						<td>".$noeud["LIBELLE"]."</td>
					</tr>
					";
			}
			echo "</table>";
			
			unset($mon_arbre);
			echo "<hr />";

		} else {
			
			///////////////////////////////////////////////////////////////////////
			//	Affichage des arbres pour lesquels une modalitÃ© a Ã©tÃ© selectionnÃ©e.
			///////////////////////////////////////////////////////////////////////

			$ref_arbre_modalite = $ligne_arbre;
			
			list($id_arbre, $id_modalite, $classe_modalite, $id_critere) = explode(":", $ref_arbre_modalite);
		
			$arbre = new Arbre($id_arbre);
			$arbre->set_detail();
	
			if ($classe_modalite == 'modalite_va_multiple' && $id_critere != "NULL") {
				$modalite = new Modalite_va_multiple($id_modalite);
				$modalite->set_detail();
				$param_crit = new Param_criteres($id_modalite, $id_critere);
				$param_crit->set_detail();
				$les_eva_noeuds = $apprenti->evaluation_arbre_va_multiple($arbre, $id_critere);
			} else {
				$modalite = new Modalite_va_unique($id_modalite);	
				$modalite->set_detail();
				$param_crit = new Param_criteres($id_modalite);
				$param_crit->set_detail();
				$les_eva_noeuds = $apprenti->evaluation_arbre_modalite_va_unique($arbre, $modalite);
			}
			
			if ($arbre->type == "entr") {
		    	$titre_bilan = "<img src=\"".$URL_THEME."images/picto_suivi_entreprise.png\"> Bilan Entreprise";
			} elseif($arbre->type == "cfa") {
				$titre_bilan = "<img src=\"".$URL_THEME."images/picto_suivi_cfa.png\"> Bilan CFA";
			}
	
			echo "<h1>".$titre_bilan.":</h1>";
			echo "<h2>Arbre: ".strtoupper($arbre->nom)."</h2>";
			echo "<h2>Modalit&eacute;: ".strtoupper($modalite->libelle)."</h2>";
			
			$mon_arbre = array();
			
			$noeud["NIVEAU"] = "0";
			$noeud["TYPE"] = "noeud";
			$noeud["LIBELLE"] = $arbre->nom;
			$noeud["VALEUR"] = round(eval_noeud(0, $les_eva_noeuds), 2);
				
			if($param_crit->mode_graphique == "smilies") {
				// affichage des smilies
				// le paramÃ¨tres sont dans $param_crit->param_graphique;
			} elseif($param_crit->mode_graphique == "bpp") {
				// barre de progression par paliers
			} elseif($param_crit->mode_graphique == "bps") {
				 // barre de progression simple
			}
			
			if($param_crit->mode_textuel == "calcule") {
				// affichage du %age
			}

			array_push($mon_arbre, $noeud);
			
			construire_arbre(0, $les_eva_noeuds);
			echo "<table cellspacing='10'>
					<tr>
						<th>NIVEAU</th>
						<th>TYPE</th>
						<th>LIBELLE</th>
						<th>VALEUR</th>
					</tr>";
			foreach($mon_arbre as $noeud) {
				echo "
					<tr".(($noeud["TYPE"] == "noeud") ? " style=\"font-weight:bold;\"" : "").">
						<td>".$noeud["NIVEAU"]."</td>
						<td>".$noeud["TYPE"]."</td>
						<td>".$noeud["LIBELLE"]."</td>
						<td>".$noeud["VALEUR"]."</td>
					</tr>
					";
			}
			echo "</table>";
			
			
			unset($mon_arbre);
			echo "<hr />";
		}
	}
?>
	</body>
</html>