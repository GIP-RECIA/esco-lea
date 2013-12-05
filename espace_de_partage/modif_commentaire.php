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


if(isset($_GET['id_espace_partage'])){
	$id_espace_partage=$_GET['id_espace_partage'];
	
	//Requete de mise a jour de la variable "nouveaute_espace" de la table "acteurs_espace"
//	$sql="UPDATE acteurs_espace SET nouveaute_espace='0' WHERE id_espace='$id_espace' AND  id_acteur='$id'";
	//$req = $bdd->executer($sql);
	
	
	//Requete de selection de l'espace
	$sql="SELECT * FROM espace_partage WHERE id_espace_partage='$id_espace_partage'";
	$req = $bdd->executer($sql);
	$sel=mysql_fetch_row($req);
	
	// recupération de l'id de l'espace 
	$id_espace=$sel[5];
	
	// recupération du nom du fichier 
	$nom_fichier=$sel[4];
	
	// recupération du commentaire de l'espace 
	$commentaire=$sel[1];
	
	// recupération du l'id du créateur de l'espace
	$id_acteur=$sel[3];
	
	if( $id_acteur != $id) exit();
	
	//Requete de selection du nom de l'espace
	$sql2="SELECT nom_espace FROM espace WHERE id_espace='$id_espace'";
	$req2 = $bdd->executer($sql2);
	$sel2=mysql_fetch_row($req2);
	$nom_espace=$sel2[0];
	
	
	?>
<script type="text/javascript">
<!--
function verifModifFichier(form_ajout_commentaire){
  if(form_ajout_commentaire.fichier.value!=''){
    if(confirm("Attention, le fichier sera remplacé et le fichier précédent sera définitivement perdu.")){
      //window.location = 'page a charger';
      form_ajout_commentaire.submit();
    }
  }else{
	  form_ajout_commentaire.submit();
  }
}
-->
</script>
<div id="top_l"></div><div id="top_m">
			<h1><span class="orange">M</span>odifier un commentaire et/ou fichier </h1>
			</div><div id="top_r"></div>
	<div id="m_contenu">
	
	<form name="form_ajout_commentaire" enctype="multipart/form-data" action="do_modif_commentaire.php" method="post">

		<table border="0" width="90%">
			<tr>
				<td><label>Nom de l'espace :</label></td>
				<td><b><?php echo $nom_espace ; ?></b><input type="hidden" name="id_espace_partage" value="<?php echo $id_espace_partage ; ?>" ></td>
			</tr> 
			<input type="hidden" name="id_espace" value="<?php echo $id_espace ; ?>" >
			
			<tr>
				<td><label>Commentaire :</label></td>
				<td><textarea name="commentaire" cols="50" rows="3"><?php echo $commentaire ; ?></textarea>
			</tr>
			
			<?php if($sel[4]!=""){ ?>
			<tr>
				<td><label>Nom du fichier joint actuel :</label></td>
				<td><a href="fichiers/<?php echo $id_espace.'_'.$id_espace_partage.'_'.$nom_fichier; ?>" target="_blank"><?php echo $nom_fichier ; ?></a></td>
			</tr>
			
			<tr>
			  <td height="35"><label>Remplacer le fichier joint actuel par celui-ci :</label></td>
				<td><input type="file" name="fichier"></td>
			</tr>
			
			<?php }else{ ?>
			<tr>
			  <td height="37"><label>Ajouter un fichier joint :</label></td>
				<td><input type="file" name="fichier"></td>
			</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<?php
					if(!empty($nom_fichier)){
						echo '<td><input type="button" value="Modifier ce commentaire" onClick="verifModifFichier(this.form);"></td>';
					}else{
						echo '<td><input type="submit" value="Modifier ce commentaire"></td>';
					}
				?>
				
			</tr>
		</table>
	</form>
	</div>	
	<?php
}
?>
