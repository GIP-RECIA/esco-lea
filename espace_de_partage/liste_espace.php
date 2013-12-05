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

$bdd = new Connexion_BDD_LEA();
echo '<script type="text/javascript" src="../javascript/stdlib.js"></script>';

if(isset($_SESSION['id_app'])){
	$id=$_SESSION['id_app'];
}
if(isset($_SESSION['id_ma'])){
	$id=$_SESSION['id_ma'];
}

if(isset($_SESSION['id_ens'])){
	$id=$_SESSION['id_ens'];
}

//Requete de selection des espaces
$sql="SELECT id_espace, nouveaute_espace FROM acteurs_espace WHERE id_acteur='$id' ORDER BY nouveaute_espace DESC";

$req = $bdd->executer($sql);

$sel=mysql_fetch_row($req);

echo'<div id="top_l"></div><div id="top_m">
			<h1><span class="orange">L</span>iste de vos espaces partag&eacute;s </h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
	';

if($sel[0]==''){
	echo('Vous n\'avez pas d\'espaces partag&eacute;s<br />');
}else{
	
	echo '<table border="0" width="100%">
			<tr>
				<th>
					Nom de l\'espace
				</th>
				<th>
					Est partagé entre 
				</th>
				<th>
					Date de création
				</th>
				<th colspan="2" width="5%">
					Action
				</th>
			</tr>';
			
		$selected ="";
			
	while($sel){
		if($selected == "" ) $selected ="selected";
		else $selected ="";
		//Requete de selection du détail de chaque espaces
		$sql2="SELECT nom_espace, id_createur_espace, DATE_FORMAT(date_creation_espace, '%d/%m/%Y  %kh%i') FROM espace WHERE id_espace='$sel[0]'";

		$req2 = $bdd->executer($sql2);
		$det=mysql_fetch_row($req2);				
		
		//Requete de selection du la liste des acteurs concernés par cet espace
		$sq3="SELECT B.id_usager, B.nom, B.prenom FROM acteurs_espace A, les_usagers B 
			  WHERE A.id_acteur = B.id_usager and id_espace='$sel[0]'
			  ORDER BY nom
			  ";
		$req3 = $bdd->executer($sq3);
		$str_acteurs ="";
		while($ligne = mysql_fetch_assoc($req3)) {			
			$str_acteurs .=$ligne['nom']." ".$ligne['prenom']."<br>";			
		}
		
		//Boucle pour afficher la liste des espaces
		echo '<tr class='.$selected.'>
			<td width="30%"><a href="consult_espace.php?id_espace='.$sel[0].'">'.$det[0].'</a>'; //Affichage du nom de l'espace
			//Affichage si l'espace contient des nouveautés
			if($sel[1]==1){
				echo ' - <i>Nouveaut&eacute;</i>';
			}
			echo '</td>';
			//Selection du nom et prénom du créateur de l'espace
			
			$sql3="SELECT nom, prenom FROM les_usagers WHERE id_usager='$det[1]'";
			$req3 = $bdd->executer($sql3);
			$creat=mysql_fetch_row($req3);
			
			echo '<td><br>
					<div style="width:200px; height:85px; overflow:auto;">
						'.
					$str_acteurs.
					 '
					 </div>
				 </td>';
			echo '<td>'.$det[2].'</td>'; //Date
			//Vérification des droits de modification et suppression
			if($det[1]==$id){ //Si l'identifiant du créateur correspond à l'identifiant de la personne connecté
				echo '<td title="Modifier"> 	<a href="consult_espace.php?cmd=creer_espace&amp;id_space='.$sel[0].'" >
								<img src="'.$URL_THEME.'/images/picto_edit.png" border="0">
							</a>
					  </td>
					  <td> 
					  		<a href="delete_espace.php?id_espace='.$sel[0].'" onclick="return deleteConfirm(\'cet espace\');" >
								<img src="'.$URL_THEME.'/images/picto_drop.png" border="0" title="supprimer">
							</a>
					   </td>';
			}else{
				echo '<td>&nbsp;</td><td>&nbsp;</td>';
		
			}
		echo '</tr>';
		
		$sel=mysql_fetch_row($req);
	}
	echo '</table>';
}
echo'</div>';
?>