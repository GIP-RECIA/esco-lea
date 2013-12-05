<?php
/* /!\Projet_tut/!\ Julien GEORGES - 13/06/06 
Description : Page permettant l'affichage des espaces partagés */

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");

//Declaration des classes qui seront nï¿½cessaires
		require_once($LEA_REP.'modele/bdd/classe_usager.php');
		require_once($LEA_REP.'modele/bdd/classe_enseignant.php');
		require_once($LEA_REP.'modele/bdd/classe_apprenti.php');
		require_once($LEA_REP.'modele/bdd/classe_formation.php');
		require_once($LEA_REP.'modele/bdd/classe_apprenti.php');
		require_once($LEA_REP.'modele/bdd/classe_maitre_apprentissage.php');


$bdd = new Connexion_BDD_LEA();

echo '<script type="text/javascript" src="verif.js"></script>';
if(empty($_GET['id_space'])){
/*******************************************************************************************************************************************************/
/************************************************************PARTIE CREATION****************************************************************************/
/*******************************************************************************************************************************************************/

	echo '<form name="create_espace" method="post" action="do_create_espace.php" onSubmit="return valide(this);"><br />
		<table>
			<tr>
				<td>
					Nom de l\'espace 
				</td>
				<td>
					<input type="text" size="50" name="nom_espace" >
				</td>
			</tr>	
			<tr>
				<th colspan="2">
					Choix des acteurs concern&eacute;s par l\'espace  
				</th>
			</tr>
		';

/*******************************************************************************************************************************************************/
	//Apprentis
	if(isset($_SESSION['id_app'])){
		$id=$_SESSION['id_app'];
		$apprenti=new Apprenti($id);
		$apprenti->set_detail();
		$nom=$apprenti->nom;
		$prenom=$apprenti->prenom;
		
		$id_ens=$apprenti->id_ens;
		$ens=new Enseignant($id_ens);
		$ens->set_detail();
		$nom_ens=$ens->nom;
		$prenom_ens=$ens->prenom;
		
		$id_ma=$apprenti->id_ma;
		$ma=new Maitre_apprentissage($id_ma);
		$ma->set_detail();
		$nom_ma=$ma->nom;
		$prenom_ma=$ma->prenom;
		
		$formation=new Formation($apprenti->get_id_for());
		$lenseignants=$formation->get_enseignants(); //ressort un tableau d'enseignants
		$config_lea = $formation->get_config_lea();
			if(trim($nom_ens) !=''){
				echo '
					<tr>
						<td>
							'.$config_lea->appelation_tuteur_cfa.'
						</td>
						<td>
						  <input type="checkbox" value="'.$id_ens.'" name="tuteur" /> '.$nom_ens.' '.$prenom_ens.'
						</td>  
					</tr>';
			}
			if(trim($nom_ma) != ''){
				echo '
					<tr>
						<td>
							'.$config_lea->appelation_ma.' 
						</td>
						<td>
						  <input type="checkbox" value="'.$id_ma.'" name="ma" /> '.$nom_ma.' '.$prenom_ma.'
						</td>  
					</tr>';
				 
			}
			echo '
				<tr>
					<td>
						Enseignants 
					</td>				
					<td>
			<select name="enseignants[]" size="5" multiple>';
			foreach($lenseignants as $ens){
				if($ens->id_ens!=0 && $ens->id_ens!=$id_ens){
					echo '<option value="'.$ens->id_ens.'">'.$ens->nom.' '.$ens->prenom.'</option>';
				}
			}
			echo '</select>
			
					</td>
				</tr>
			';
				
			
	}
/*******************************************************************************************************************************************************/
	//Maitres d'apprentissage
	if(isset($_SESSION['id_ma'])){
		$id=$_SESSION['id_ma'];
		//son ou ses apprentis (checkbox), tuteur de ses apprentis
					
		$ma=new Maitre_apprentissage($id);
		$app_ma=$ma->get_id_apprentis();
	
		foreach($app_ma as $app){
			$apprenti=new Apprenti($app);
			$apprenti->set_detail();
			$nom_apprenti=$apprenti->nom;
			$prenom_apprenti=$apprenti->prenom;
			
			$id_tuteur=$apprenti->id_ens;
			$tut=new Enseignant($id_tuteur);
			$tut->set_detail();			
			$config_lea = $apprenti->get_config_lea();
				echo '
				<tr>
					<td>
						'.$config_lea->appelation_app.' 						
					</td>
					<td>
						<input type="checkbox" value="'.$apprenti->id_app.'" name="app[]" />'.$nom_apprenti.' '.$prenom_apprenti.'
					</td>
			   </tr>';		

			if(trim($tut->nom)!=''){
				
				echo '
				<tr>
					<td>
						'.$config_lea->appelation_tuteur_cfa.' 
					</td>
					<td>
						<input type="checkbox" value="'.$apprenti->id_ens.'" name="ens[]" />'.$tut->nom.' '.$tut->prenom.'
					</td>
					
				</tr>';
			}
		}
		
	}
/*******************************************************************************************************************************************************/
	//Enseignants
	if(isset($_SESSION['id_ens'])){
		$id=$_SESSION['id_ens'];
		$id_for=$_SESSION['id_for'];
		//ï¿½tudiants (classes), autres profs, ma?	
		
		$ens=new Enseignant($id);
		$ens->set_detail();
					
		$formation=new Formation($id_for);
		$apprentis=$formation->get_apprentis();
		$config_lea = $formation->get_config_lea();
		
		//Selection des apprentis et de leur maitre d'apprentissage
		echo '<tr>
				<td> Liste des '.$config_lea->appelation_app.'s <br>
					-> et leur '.$config_lea->appelation_ma.' 
				</td>
			  ';
		
		echo '
				<td>
		<select name="apprentis[]" size="5" multiple>';
		foreach($apprentis as $app){
			if($app->id_app!=0){
				echo '<option value="'.$app->id_app.'">'.$app->nom.' '.$app->prenom.'</option>';
			}
		
			$id_ma=$app->id_ma;
			$maitre_appren=new Maitre_apprentissage($id_ma);
			$maitre_appren->set_detail();
			if(trim($maitre_appren->nom) != ''){
				echo '<option value="'.$maitre_appren->id_ma.'"> ->'.$maitre_appren->nom.' '.$maitre_appren->prenom.'</option>';
			}
		}
		echo '</select>
				</td>
			</tr>	
		';
		
		
		$enseignants = $formation->get_enseignants();
		//Selection des autres enseignants
		echo '<tr>
				<td> Liste des enseignants </td>
				<td>
			<select name="enseignants[]" size="5" multiple>';
		foreach($enseignants as $ens){
			if($ens->id_ens==$id){
				
			}else{
				if($ens->id_ens!=0){
					echo '<option value="'.$ens->id_ens.'">'.$ens->nom.' '.$ens->prenom.'</option>';
				}
			}
		}
		echo '</select>
			 </td>
			</tr> 
			';
		
	}
	
	echo '
		<tr height="50">
			<td>
				&nbsp;
			</td>
			<td>
				<input type="submit" value="Cr&eacute;er l\'espace partag&eacute;" />
			</td>
		</tr>
	</table>
			
	</form>';
	
}else{
/*******************************************************************************************************************************************************/
/*************************************************************PARTIE MODIFICATION***********************************************************************/
/*******************************************************************************************************************************************************/

function verifActeur($pwet, $hello){
	$sql="SELECT COUNT(*) FROM acteurs_espace WHERE id_espace='$pwet' AND id_acteur='$hello'";
	$req = mysql_query($sql);
	$verif=mysql_fetch_row($req);
	if($verif[0]==0){
		return false;
	}else{
		return true;
	}
}

	//Si on rï¿½cupï¿½re l'id_espace, on modifie l'espace ici
	$id_espace=$_GET['id_space'];
	if(isset($_SESSION['id_app'])){
		$id=$_SESSION['id_app'];
	}
	if(isset($_SESSION['id_ens'])){
		$id=$_SESSION['id_ens'];
	}
	if(isset($_SESSION['id_ma'])){
		$id=$_SESSION['id_ma'];
	}
	
	if( ! $bdd->consulte_espace($id, $id_espace) ) exit();
	
	$sql="SELECT id_createur_espace, nom_espace FROM espace WHERE id_espace='$id_espace'";
	$req = $bdd->executer($sql);
	$verif=mysql_fetch_row($req);
	if($verif[0]==$id){
		//PAGE DE MODIFICATION ICI
		echo '<form name="modif_espace" method="post" action="do_create_espace.php" onSubmit="return valide(this);"><br />
			<input type="hidden" name="id_espace" value="'.$id_espace.'" />
		<table>
			<tr>
				<td>
					Nom de l\'espace
				</td>
				<td>
					<input type="text" size="50" name="nom_espace" value="'.$verif[1].'" />	
				</td>
			</tr>	
			<tr>
				<th colspan="2">
					Choix des acteurs concern&eacute;s par l\'espace
				</th>
			</tr>	
		';
/*******************************************************************************************************************************************************/
		//Apprentis
		if(isset($_SESSION['id_app'])){
			$id=$_SESSION['id_app'];

			$apprenti=new Apprenti($id);
			$apprenti->set_detail();
			$nom=$apprenti->nom;
			$prenom=$apprenti->prenom;
			
			$id_ens=$apprenti->id_ens;
			$ens=new Enseignant($id_ens);
			$ens->set_detail();
			$nom_ens=$ens->nom;
			$prenom_ens=$ens->prenom;
			
			$id_ma=$apprenti->id_ma;
			$ma=new Maitre_apprentissage($id_ma);
			$ma->set_detail();
			$nom_ma=$ma->nom;
			$prenom_ma=$ma->prenom;
			
			$formation=new Formation($apprenti->get_id_for());
			$lenseignants=$formation->get_enseignants(); //ressort un tableau d'enseignants
			$config_lea = $apprenti->get_config_lea();				
				echo'
					<tr>
						<td>
							'.$config_lea->appelation_tuteur_cfa.'
						</td>
						<td>									
					';
						
				if(trim($nom_ens)!= ''){
					if(verifActeur($id_espace, $id_ens)){
						echo '<input type="checkbox" value="'.$id_ens.'" name="tuteur" checked /> '.$nom_ens.' '.$prenom_ens.'<br />';
					}else{
						echo '<input type="checkbox" value="'.$id_ens.'" name="tuteur" /> '.$nom_ens.' '.$prenom_ens.'<br />';
					}
				}
				echo'	</td>
					</tr>
					<tr>
						<td>
							'.$config_lea->appelation_ma.'
						</td>
						<td>
						';
				if(trim($nom_ma)!= ''){
					if(verifActeur($id_espace, $id_ma)){
						echo '<input type="checkbox" value="'.$id_ma.'" name="ma" checked /> '.$nom_ma.' '.$prenom_ma.'<br />';
					}else{
						echo '<input type="checkbox" value="'.$id_ma.'" name="ma" /> '.$nom_ma.' '.$prenom_ma.'<br />';
					}
				}
				echo '</td>
					</tr>
					<tr>
						<td>
						Enseignants 
						</td>
						<td>
						';				
				echo '<select name="enseignants[]" size="5" multiple>';
				foreach($lenseignants as $ens){
					if($ens->id_ens!=0 && $ens->id_ens!=$id_ens){
						if(verifActeur($id_espace, $ens->id_ens)){
							echo '<option value="'.$ens->id_ens.'" selected="selected">'.$ens->nom.' '.$ens->prenom.'</option>';
						}else{
							echo '<option value="'.$ens->id_ens.'">'.$ens->nom.' '.$ens->prenom.'</option>';
						}
					}
				}
				echo '</select>
					</td>
				  </tr>';
		}
/*******************************************************************************************************************************************************/
	//Maitres d'apprentissage
	if(isset($_SESSION['id_ma'])){
		$id=$_SESSION['id_ma'];
		//son ou ses apprentis (checkbox), tuteur de ses apprentis
					
		$ma=new Maitre_apprentissage($id);
		$app_ma=$ma->get_id_apprentis();
	
		foreach($app_ma as $app){
			$apprenti=new Apprenti($app);
			$apprenti->set_detail();
			$nom_apprenti=$apprenti->nom;
			$prenom_apprenti=$apprenti->prenom;
			
			$id_tuteur=$apprenti->id_ens;
			$tut=new Enseignant($id_tuteur);
			$tut->set_detail();
			$config_lea = $apprenti->get_config_lea();	
			echo'<tr>
					<td>
						'.$config_lea->appelation_app.'
					</td>
					<td>
					';
				if(verifActeur($id_espace, $apprenti->id_app)){
					echo '<input type="checkbox" value="'.$apprenti->id_app.'" name="app[]" checked />'.$nom_apprenti.' '.$prenom_apprenti.'<br />';
				}else{
					echo '<input type="checkbox" value="'.$apprenti->id_app.'" name="app[]" />'.$nom_apprenti.' '.$prenom_apprenti.'<br />';
				}
			echo'	</td>
				</tr>
				<tr>
					<td>
						'.$config_lea->appelation_tuteur_cfa.'
					</td>
					<td>
				';
			if(trim($tut->nom) != ''){
				if(verifActeur($id_espace, $apprenti->id_ens)){
					echo '<input type="checkbox" value="'.$apprenti->id_ens.'" name="ens[]" checked />'.$tut->nom.' '.$tut->prenom.'<br /><br />';
				}else{
					echo '<input type="checkbox" value="'.$apprenti->id_ens.'" name="ens[]" />'.$tut->nom.' '.$tut->prenom.'<br /><br />';
				}
			}
			
			echo'	</td>
				</tr>';
		}
		
	}
/*******************************************************************************************************************************************************/
	//Enseignants
	if(isset($_SESSION['id_ens'])){
		$id=$_SESSION['id_ens'];
		$id_for=$_SESSION['id_for'];
		//ï¿½tudiants (classes), autres profs, ma?
	
		
		$ens=new Enseignant($id);
		$ens->set_detail();
					
		$formation=new Formation($id_for);
		$apprentis=$formation->get_apprentis();
		$config_lea = $formation->get_config_lea();	
		//Selection des apprentis et de leur maitre d'apprentissage
		echo '<tr>
				<td>
					Liste des '.$config_lea->appelation_app.'s <br />
					-> et leur '.$config_lea->appelation_ma.' 
				 </td>
				 <td>				 
				 
			';
		
		echo '<select name="apprentis[]" size="5" multiple>';
		foreach($apprentis as $app){
			if($app->id_app!=0){
				if(verifActeur($id_espace, $app->id_app)){
					echo '<option value="'.$app->id_app.'" selected="selected">'.$app->nom.' '.$app->prenom.'</option>';
				}else{
					echo '<option value="'.$app->id_app.'">'.$app->nom.' '.$app->prenom.'</option>';
				}
			}
		
			$id_ma=$app->id_ma;
			$maitre_appren=new Maitre_apprentissage($id_ma);
			$maitre_appren->set_detail();
			if(trim($maitre_appren->nom)!=''){
				if(verifActeur($id_espace, $maitre_appren->id_ma)){
					echo '<option value="'.$maitre_appren->id_ma.'" selected="selected"> ->'.$maitre_appren->nom.' '.$maitre_appren->prenom.'</option>';
				}else{
					echo '<option value="'.$maitre_appren->id_ma.'"> ->'.$maitre_appren->nom.' '.$maitre_appren->prenom.'</option>';
				}
			}
		}
		echo '</select>
				</td>
			</tr>	
		';
				
		$enseignants=$formation->get_enseignants();
		//Selection des autres enseignants
		echo '<tr>
				<td> Liste des enseignants </td>
				<td>';
		echo '<select name="enseignants[]" size="5" multiple>';
		foreach($enseignants as $ens){
			if($ens->id_ens==$id){
				
			}else{
				if($ens->id_ens!=0){
					if(verifActeur($id_espace, $ens->id_ens)){
						echo '<option value="'.$ens->id_ens.'" selected="selected">'.$ens->nom.' '.$ens->prenom.'</option>';
					}else{
						echo '<option value="'.$ens->id_ens.'">'.$ens->nom.' '.$ens->prenom.'</option>';
					}
				}
			}
		}
		echo '</select>
				</td>
			</tr>';
		
	}
/*******************************************************************************************************************************************************/
		echo '<tr height="50">
				<td>
					&nbsp;
				</td>
				<td>
					<input type="submit" value="Modifier l\'espace partag&eacute;" />
				</td>
			 </tr>
		</table>		
					
		</form>';
	}else{
		echo '<br/>Vous n\'avez pas l\'autorisation de modifier cet espace.<br />';
	}
	
}
?>
