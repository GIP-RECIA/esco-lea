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
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
define ( "NB_CHOIX_MAX" , 10 );

class Gestion_declaration {

	var $declaration;

	function Gestion_declaration($declaration) {
		$this->declaration = $declaration;
	}

	/****************** les méthodes ******************************/
	// Cette fonction affiche la zone de saisie qui correspond a
	// la modalite $modalite  du suivi guidé.
	// Le nom de cette zone est généré en fonction de l'identifiant du noeud qu'on veut valider.

	function zone_modalite_suivi_guide($modalite, $id_noeud){

		global $LEA_URL;
			
		// la classe de cette modalite
		$classe = strtolower(get_class($modalite));
			
		switch($classe){

			case "modalite_va_unique" :

				$nom = "les_feuilles_modalite_va_unique[".$id_noeud."][".$modalite->id_modalite."]";
				if(isset($_SESSION['les_feuilles_modalite_va_unique'][$id_noeud][$modalite->id_modalite])) {
					$value = $_SESSION['les_feuilles_modalite_va_unique'][$id_noeud][$modalite->id_modalite];
				} else {
					$value = '';
				}

				if($modalite->type_reponse == 'texte') {
					echo"<textarea name='$nom' >$value</textarea>";
				} elseif($modalite->type_reponse == 'frequence') {
					echo "<input name=\"$nom\"  type=\"text\" size=\"3\" value=\"$value\"
						  onChange=\"if (!isNumeric(this.value) || this.value < 0) {	
									alert('Nombre saisi invalide : Veuillez saisir un nombre positif');
									this.focus();
									return false;
								} \">"; 
				} elseif($modalite->type_reponse == 'note') {
					$noeud = new Noeud($id_noeud);
					$note_max = $noeud->get_evaluation_modalite_va_unique($modalite->id_modalite);

					echo "<input name=\"$nom\"  type=\"text\" size=\"3\" value=\"$value\"
							onChange=\"if (!isReal(this.value) || this.value < 0 || this.value > $note_max ) {	
									alert('Nombre saisi invalide : Veuillez saisir un nombre positif inf&eacute;rieur &agrave; $note_max');
									this.focus();
									return false;
								}  \"> / $note_max"; 		
				}
				break;
					
			case "modalite_va_multiple" :
				$les_choix = $modalite->get_choix();
				$nom = "les_feuilles_modalite_va_multiple[".$id_noeud."][".$modalite->id_modalite."][]";

				if (isset($_SESSION['les_feuilles_modalite_va_multiple'][$id_noeud][$modalite->id_modalite])) {
					$les_id_choix_select = $_SESSION['les_feuilles_modalite_va_multiple'][$id_noeud][$modalite->id_modalite];
				} else {
					$les_id_choix_select = array();
				}
					
				$output = "";
					
				if(count($les_choix) <= NB_CHOIX_MAX ) {

					if($modalite->type_choix == 'unique' ) {
						$type = 'radio';
					} else {
						$type = 'checkbox';
					}

					foreach($les_choix as $choix) {
						if( in_array($choix->id_choix, $les_id_choix_select ) ) {
							$checked = "checked";
						} else {
							$checked = "";
						}

						$output.=" <input name='$nom' type='$type' value='$choix->id_choix' $checked > $choix->libelle <br>";
					}

				}
				else{
					if($modalite->type_choix == 'unique' )
					$type = '';
					else    $type = 'multiple';

					$output = "<select name='$nom' $type size='5'>";

					foreach($les_choix as $choix) {
						if( in_array($choix->id_choix, $les_id_choix_select ) ) {
				 		$selected = "selected";
						} else {
							$selected = "";
						}
						$output.= "<option value='$choix->id_choix' $selected > $choix->libelle </option>";
					}

					$output.= "</select>";

				}
				echo "$output";
				break;
		}
	}

	// test si la modalité modalite est contenu dans le tableau $tab_modalites
	function in_array_modalite($modalite, $tab_modalites){
	
		if(count($tab_modalites) > 0) {
			foreach($tab_modalites as $mod){
				if($modalite->id_modalite == $mod->id_modalite) {
					$classe_modalite = strtolower(get_class($modalite));
					$classe_mod      = strtolower(get_class($mod));
					if($classe_modalite == $classe_mod) {
						return 1;
					}
				}
			}
		}
		return 0;
	
	}


	// Cette fonction affiche le tableau du validation des modalités $les_modalite de l'arbre $arbre

	function tableau_modalites_suivi_guide($arbre, $les_modalites){

		global $LEA_URL;
		global $URL_THEME;

		$arbre->set_detail();

		if($arbre->valider_all_feuilles) {
			$les_id_noeud = $arbre->get_id_feuilles();
			$_SESSION['les_feuilles_declarees'][$arbre->id_arbre] = $les_id_noeud;
		}
		elseif(isset($_SESSION['les_feuilles_declarees'][$arbre->id_arbre])) {
			$les_id_noeud = $_SESSION['les_feuilles_declarees'][$arbre->id_arbre];
		}
		else {
			$les_id_noeud = array();
		}

		$config_lea = new Config_lea($arbre->id_config);
		$config_lea->set_detail();

		$libelle_feuille = $arbre->get_libelle_feuille();

		$apprenti = new Apprenti($this->declaration->id_app);
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

		// Toutes les modalités de l'arbre $arbre qui doivent être validées
		$all_modalites_unique =
		array_merge($arbre->get_modalites_unique('app', $this->declaration->id_periode ),
		$arbre->get_modalites_unique('ma', $this->declaration->id_periode),
		$arbre->get_modalites_unique('tuteur_cfa', $this->declaration->id_periode),
		$arbre->get_modalites_unique('ens', $this->declaration->id_periode),
		$arbre->get_modalites_unique('rl', $this->declaration->id_periode),
		$arbre->get_modalites_unique('rf', $this->declaration->id_periode)	);
		
		$all_modalites_multiple =
		array_merge($arbre->get_modalites_multiple('app', $this->declaration->id_periode ),
		$arbre->get_modalites_multiple('ma', $this->declaration->id_periode),
		$arbre->get_modalites_multiple('tuteur_cfa', $this->declaration->id_periode),
		$arbre->get_modalites_multiple('ens', $this->declaration->id_periode),
		$arbre->get_modalites_multiple('rl', $this->declaration->id_periode),
		$arbre->get_modalites_multiple('rf', $this->declaration->id_periode)	);

		if(count($les_modalites) > 0) {

			if($arbre->valider_all_feuilles) {
				echo '<p>
				 	  		<img src="'.$URL_THEME.'images/picto_arbre.png'.'"  border="0">
						 	    Veuillez remplir la fiche : <span class="nom_arbre">'.strtoupper($arbre->nom).
						   '</span>
						   </p>';
			} else {
				echo'<p>
				 	   <a href ="#" 
					   onClick="window.open(\''.$LEA_URL.'Apprenti/Livret/dec_feuilles.php?id_arbre='.$arbre->id_arbre.'\' , \'\', \' height=600, width=900, top=20, resizable=yes,  scrollbars=yes\' )"
					   >
			 	  		<img src="'.$URL_THEME.'images/picto_arbre.png'.'"  border="0">
				 	    Veuillez s&eacute;lectionner les '. strtolower($arbre->get_libelle_feuille()).
						' &agrave; d&eacute;clarer en : <span class="nom_arbre">'.strtoupper($arbre->nom) .
					   '</span></a> 
					  </p>';
			}

		}
		if( (count($les_modalites) > 0)  && count($les_id_noeud) > 0) {

			echo "<table border=0 width='100%'>";
			echo"<tr>
					<th>$libelle_feuille</th>";

			foreach($all_modalites_multiple as $modalite ) {
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
							$modalite->libelle
								<p style='font-size:11px; color:#000000'> $acteur </p>
								</th>";	
			}
			foreach($all_modalites_unique as $modalite ) {
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
							$modalite->libelle
								<p style='font-size:11px; color:#000000'> $acteur </p>
								</th>";	
			}
			echo"</tr>";

			$selected = "";

			$tabNiveaux = array();
			$marge=0;

			foreach($les_id_noeud as $id_noeud){
					
				//				if($selected == "")
				//					$selected = 'selected';
				//				else
				//					$selected = '';
					
				$noeud =  new Noeud($id_noeud, $arbre->id_arbre);
				$noeud->set_detail();
					
				$les_id_noeuds_ascendants = $noeud->get_id_noeuds_ascendants();

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
						echo "<td colspan='".(count($all_modalites)+1)."'>\n";
						//echo "<img style='margin-left:".$marge."px' src='".$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME']."/images/picto_branche.png'>&nbsp;";
						echo "<span style='margin-left:".$marge."px'>";
						echo "<b>".$nd->libelle."</b></span>\n";
						echo "</td>\n</tr>\n";
					}

					$niveau++;
				}

				echo"<tr class='$selected'>
					<td style='padding-left: 20px;height:50;vertical-align: top;'>
						<span style='margin-left:".$marge."px'>	$noeud->libelle</span>
					</td>";

				foreach($all_modalites_multiple as $modalite ) {
					echo"<td>";
					if($this->in_array_modalite($modalite, $les_modalites)) {
						$this->zone_modalite_suivi_guide($modalite, $noeud->id_noeud);
					}
					else {
						$this->declaration->afficher_modalite_suivi_guide($modalite, $noeud->id_noeud);
					}
					echo"</td>";
				}
				foreach($all_modalites_unique as $modalite ) {
					echo"<td>";
					if($this->in_array_modalite($modalite, $les_modalites)) {
						$this->zone_modalite_suivi_guide($modalite, $noeud->id_noeud);
					}
					else {
						$this->declaration->afficher_modalite_suivi_guide($modalite, $noeud->id_noeud);
					}
					echo"</td>";
				}
				echo"</tr>";
			}
			echo"</table> ";
		}
	}


	// Cette fonction affiche la zone de saisie  correspond à la modalite $modalite  du suivi libre.

	function zone_modalite_suivi_libre($modalite){

		global $LEA_URL;

		// la classe de cette modalite

		$classe = strtolower(get_class($modalite));
			
		switch($classe){
			case "modalite_reponse_libre":
				$nom = "les_modalites_rl[$modalite->id_modalite]";
					
				if(isset($_SESSION['les_modalites_rl'][$modalite->id_modalite])) {
					$value = $_SESSION['les_modalites_rl'][$modalite->id_modalite];
				} else {
					$value = "";
				}
				echo "<textarea   name='$nom' cols='60' rows='5'>$value</textarea>";
				break;
					
			case "modalite_reponse_choix":

				$nom = "les_modalites_rc[$modalite->id_modalite][]";
				if( isset($_SESSION['les_modalites_rc'][$modalite->id_modalite]) ) {
					$les_id_reponses_select = $_SESSION['les_modalites_rc'][$modalite->id_modalite];
				} else {
					$les_id_reponses_select = array();
				}
					
				$les_reponses = $modalite->get_reponses();
					
				if(count($les_reponses) <= NB_CHOIX_MAX ) {

					if($modalite->type_choix == 'unique' ) {
						$type = 'radio';
					} else {
						$type = 'checkbox';
					}

					$output = "";

					foreach($les_reponses as $reponse) {

						if( in_array($reponse->id_reponse, $les_id_reponses_select ) ) {
							$checked = "checked";
						}
						else {
							$checked = "";
						}

						$output.=" <input type='$type' name='$nom' value='$reponse->id_reponse' $checked > $reponse->reponse <br>";
					}
				}
				else {

					if($modalite->type_choix == 'unique' ) {
						$type = '';
					} else {
						$type = 'multiple';
					}

					$output = "<select name='$nom' $type 	size='5'>";

					foreach($les_reponses as $reponse) {
						if( in_array($reponse->id_reponse, $les_id_reponses_select ) ) {
							$selected = "selected";
						}
						else {
							$selected = "";
						}

						$output.= "<option value='$reponse->id_reponse' $selected > $reponse->reponse </option>";
					}

					$output.= "</select>";
				}
				echo "$output";
				break;
		}

	}
	// Cette fonction affiche toutes les modalités qui doivent être validées lors du suivi libre

	function tableau_modalites_suivi_libre($config_lea, $les_modalites){

		$apprenti = new Apprenti($this->declaration->id_app);
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

		// toutes les modalits libre qui doivent être valides
		$all_modalites_reponse_libre =
		array_merge($config_lea->get_modalites_reponse_libre( $this->declaration->type_suivi, 'app',  $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_libre($this->declaration->type_suivi, 'ma', $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_libre($this->declaration->type_suivi, 'tuteur_cfa', $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_libre($this->declaration->type_suivi, 'ens', $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_libre($this->declaration->type_suivi, 'rl', $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_libre($this->declaration->type_suivi, 'rf', $this->declaration->id_periode)
		);
		
		$all_modalites_reponse_choix =
		array_merge($config_lea->get_modalites_reponse_choix( $this->declaration->type_suivi, 'app',  $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_choix($this->declaration->type_suivi, 'ma', $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_choix($this->declaration->type_suivi, 'tuteur_cfa', $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_choix($this->declaration->type_suivi, 'ens', $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_choix($this->declaration->type_suivi, 'rl', $this->declaration->id_periode),
		$config_lea->get_modalites_reponse_choix($this->declaration->type_suivi, 'rf', $this->declaration->id_periode)
		);


		if( count($all_modalites_reponse_libre) > 0 || count($all_modalites_reponse_choix) > 0 ) {

			foreach($all_modalites_reponse_libre as $modalite ) {
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
					default :
						$acteur = '';
				}
					
				echo "<table width='100%'>";
				echo"<tr>
					<th width='50%'>$modalite->libelle</th>
					<th width='50%'>R&eacute;dig&eacute;(e) par : $acteur</th>
				 </tr>
				 <tr>	
				  <td height='100' colspan='2'>";
				if ($this->in_array_modalite($modalite,$les_modalites)) {
					$this->zone_modalite_suivi_libre($modalite);
				}
				else {
					$this->declaration->afficher_modalite_suivi_libre($modalite);
				}
				echo" </td>
				 </tr>
			 </table>";
			}
			
			foreach($all_modalites_reponse_choix as $modalite ) {
			
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
					default :
						$acteur = '';
				}
					
				echo "<table width='100%'>";
				echo"<tr>
								<th width='50%'>$modalite->libelle</th>
								<th width='50%'>R&eacute;dig&eacute;(e) par : $acteur</th>
							 </tr>
							 <tr>	
							  <td height='100' colspan='2'>";
				if ($this->in_array_modalite($modalite,$les_modalites)) {
					$this->zone_modalite_suivi_libre($modalite);
				}
				else {
					$this->declaration->afficher_modalite_suivi_libre($modalite);
				}
				echo" </td>
				</tr>
				</table>";
			}

		}
	}

	function liste_fichiers_joints(){


		global $URL_DOCUMENTS_DECLARES;

		if(isset($_SESSION['id_app'])) {
			$id_usager = $_SESSION['id_app'];
		}
		elseif(isset($_SESSION['id_ens'])){
			$id_usager = $_SESSION['id_ens'];
		}
		elseif(isset($_SESSION['id_ma'])){
			$id_usager = $_SESSION['id_ma'];
		}
		elseif(isset($_SESSION['id_rl'])){
			$id_usager = $_SESSION['id_rl'];
		}
		else retrun;


		$les_fichiers = $this->declaration->get_documents_declares();
			
		if( count($les_fichiers) > 0 ) {
			$bool=0;
			$html ="<table>
						   	 <tr>
								<th>
									Vos documents joints 
								</th>
							 </tr>";

			foreach($les_fichiers as $fichier ) {

				$url = $URL_DOCUMENTS_DECLARES.urlencode($fichier->src_doc);

				if($fichier->confidentialite) $checked ='checked';
				else  $checked ='';

				if($fichier->id_usager == $id_usager) { // si ce fichier est joint par la personne connecte
					$bool=1;
					$html.="	 <tr>
							  		 <td  height='50'>";
					$html.="<a href = '#' onClick=\"window.open('$url','','')\" >";
					$html.= "$fichier->src_doc";
					$html.="</a>";
					$html.="	[ <a href= 'supprimer_doc.php?id_doc=$fichier->id_doc'  onClick=\"return deleteConfirm('ce document')\" >Supprimer</a> ]
										&nbsp;&nbsp;&nbsp;
										<input type='checkbox' name= 'files_modif[]' value='$fichier->id_doc' $checked> Est confidentiel ";

					$html.="</td>
					 			</tr>";

				}
			}

			$html.="</table>";

			if($bool) echo($html);

		}
	}


	function tableau_fichier_joint(){

	 $this->liste_fichiers_joints();

	 echo 'Vous pouvez joindre un fichier &agrave; cette d&eacute;claration <br><br>
                        <input type="file" name="fichier" >
                          <input name="confidentialite" type="checkbox" value="1" >Est confidentiel <br>'; 
	}


}// fin de la classe gest_declaration

?>