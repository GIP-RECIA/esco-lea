<?php
/* /!\Projet_tut/!\ Matthieu Charron - 19/06/06 
Description : Page permettant l'affichage des commentaires des espaces partagés */

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");

$bdd = new Connexion_BDD_LEA();

if(isset($_SESSION['id_app'])){
	$id=$_SESSION['id_app'];
}
if(isset($_SESSION['id_ma'])){
	$id=$_SESSION['id_ma'];
}
if(isset($_SESSION['id_rl'])){
	$id=$_SESSION['id_rl'];
}
if(isset($_SESSION['id_ens'])){
	$id=$_SESSION['id_ens'];
}
echo '<script type="text/javascript" src="verif.js"></script>';
if(isset($_GET['id_espace'])){
	$id_espace=$_GET['id_espace'];

	if( ! $bdd->consulte_espace($id, $id_espace) ) exit();

	
	//Requete de mise a jour de la variable "nouveaute_espace" de la table "acteurs_espace"
	$sql="UPDATE acteurs_espace SET nouveaute_espace='0' WHERE id_espace='$id_espace' AND  id_acteur='$id'";
	$req = $bdd->executer($sql);
	
	
	//Requete de selection de l'espace
	$sql="SELECT * FROM espace WHERE id_espace='$id_espace'";
	$req = $bdd->executer($sql);
	$sel=mysql_fetch_row($req);
	?>
	<div id="top_l"></div><div id="top_m">
			<h1><span class="orange">C</span>onsulter un espace  partag&eacute; </h1>
			</div><div id="top_r"></div>
	<div id="m_contenu">
		
	<form id="form_ajout_commentaire" enctype="multipart/form-data" action="insert_commentaire.php" method="post" onSubmit="return valider(this);">
		<table border="0" width="90%">
			<tr>
				<th colspan="2">Ajouter un commentaire et/ou fichier </th>				
			</tr> 
			<tr>
				<td><label>Nom de l'espace :</label></td>
				<td><b><?php echo $sel[1] ; ?></b><input type="hidden" name="id_espace" value="<?php echo $sel[0] ; ?>" ></td>
			</tr> 
			<tr>
				<td><label>Commentaire :</label></td>
				<td><textarea name="commentaire" cols="30" rows="3"></textarea>
			</tr>
			<tr>
				<td><label>Fichier joint :</label></td>
				<td><input type="file" name="fichier"></td>
			</tr>
			<tr>
				<td>&nbsp;</td><td><input type="submit" name="Submit" value="Ajouter"></td>
			</tr>
		</table>
	</form>
		
	<?php
	//Requete de selection des messages de l'espace
	$sql="SELECT id_espace_partage, com_espace_partage,  DATE_FORMAT(date_ajout, '%d/%m/%Y  %kh%i'),id_auteur_espace_partage, nom_fichier,   	
lien_id_espace  FROM espace_partage WHERE lien_id_espace='$id_espace' ORDER BY date_ajout DESC";
	$req = $bdd->executer($sql);
	$sel=mysql_fetch_row($req);

	// S'il n'y a pas d'enregistrements, on avertit l'utilisateur
	if($sel[0]==''){
		
	}else{
		?>
		<br><br>
		<b>Liste des commentaires et/ou fichiers : </b><br />
		<table border="0" width="100%">
			<tr>
				<th width="35%"><label>Commentaire</label></th>
				<th ><label>Fichier</label></th>
				<th ><label>Date</label></th>
				<th ><label>Auteur</label></th>
				<th colspan="2" ><label>Action</label></th>
				
			</tr>
			<?php
			$selected = 'selected';
			
			while ($sel){
				$id_usager=$sel[3];
				$sql2="SELECT nom,prenom FROM les_usagers WHERE id_usager='$id_usager'";
				$req2 = $bdd->executer($sql2);
				$sel2=mysql_fetch_row($req2);
				$auteur= $sel2[1]."&nbsp;".$sel2[0];
				
				if($selected=='selected') $selected='';
				else $selected='selected';
				
				?>
				<tr class="<?php echo"$selected"?>">
					<td width="35%" height="50"><?php echo $sel[1] ; ?></td>
					<td><a href="fichiers/<?php echo($sel[5].'_'.$sel[0].'_'.$sel[4]) ?>" target="_blank"><?php echo $sel[4] ; ?></a></td>
					<td><?php echo $sel[2] ; ?></td>
					<td><?php echo $auteur; ?></td>
					<?php
					if($sel[3]==$id){ //Si l'identifiant du créateur correspond à l'identifiant de la personne connecté
						echo '<td>
								<a href="consult_espace.php?cmd=modif_comm&&id_espace_partage='.$sel[0].'">
									<img src="'.$URL_THEME.'/images/picto_edit.png" border="0" title="Modifier"> 
								</a>
							  </td>
							  <td>
							  	<a href="delete_commentaire.php?id_espace_partage='.$sel[0].'" onclick="return  deleteConfirm(\'ce commentaire\');">
									<img src="'.$URL_THEME.'/images/picto_drop.png" border="0" title="Supprimer"> 
							  	</a>
							  </td>';
					}else{
						echo '<td>&nbsp;</td><td>&nbsp;</td>';
		
					}
					?>
				</tr>
			<?php
			$sel=mysql_fetch_row($req);
			}
			?>
		</table>
		<?php
	}
}
?>
</div>