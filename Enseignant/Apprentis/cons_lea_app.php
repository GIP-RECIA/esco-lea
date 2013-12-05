<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 16/09/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/classe_usager.php");
require_once ($LEA_REP."modele/bdd/classe_apprenti.php");
require_once ($LEA_REP."modele/bdd/classe_enseignant.php");
require_once ($LEA_REP."modele/bdd/classe_representant_legal.php");
require_once ($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");

/***********************************************************/
$enseignant = new Enseignant($_SESSION['id_ens']);
$est_responsable = $enseignant->est_responsable($_SESSION['id_for']); 

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();


if (isset($_REQUEST['id_app'])) $id_app = $_REQUEST['id_app'];	
else { include($LEA_REP.'erreur.php');  exit();  }

$apprenti=new Apprenti($id_app);
$apprenti->set_detail();


$formation = new Formation($apprenti->get_id_for()); // la formation de l'apprenti

// l'enseignant connectï¿½ n'est pas autorisï¿½ ï¿½ consulter le suivi d'un apprenti qui n'est pas de sa formation

if($_SESSION['id_for']!= $formation->id_for) { include($LEA_REP.'erreur.php');  exit();  }


$ma =  new Maitre_apprentissage($apprenti->id_ma);
$ma->set_detail();

$entreprise=new Entreprise($ma->id_entr);
$entreprise->set_detail();

$id_tuteur=$apprenti->id_ens;
$tuteur = new Enseignant($id_tuteur);
$tuteur->set_detail();

$id_rl = $apprenti->id_rl;
$rl = new Representant_legal($id_rl);
$rl->set_detail();

?>		

 <div id="top_l"></div>
 <div id="top_m">
		<h1><span class="orange">L</span>e suivi de <?php echo $config_lea->appelation_app; ?> <?php echo"<a href=\"apprentis.php?cmd=cons_coordonnees_app&id_app_select=$apprenti->id_app\">$apprenti->nom $apprenti->prenom </a>";?></h1>
 </div>
 <div id="top_r"></div>
 <div id="m_contenu">


<table width="440">         
	<tr>
		<th colspan="2"><?php echo($config_lea->appelation_ma);?></th>
	</tr>
	<tr >
		<td width="105">Nom / Pr&eacute;nom</td>
		<td width="323" class="nom">
		
		<?php if($ma->id_ma > 0) 
				  echo"<a href=\"apprentis.php?cmd=cons_coordonnees_ma&id_ma_select=$ma->id_ma\">
				  		$ma->nom &nbsp; $ma->prenom
						</a>"; 
			 else echo "?";	
		?>	  
		</td>
	</tr>
	<tr >
		<td><?php echo $config_lea->appelation_entr; ?></td>
		<td><?php echo"$entreprise->nom"; ?></td>
	</tr>
	<tr>
		<td height="34">Date de d&eacute;but du contrat</td>
		<td><?php echo(trans_date($apprenti->date_debut_contrat)); ?> </td>
	</tr>
	<tr >
		<td>Date de fin du contrat</td>
		<td><?php echo(trans_date($apprenti->date_fin_contrat)); ?></td>
	</tr>
	<tr>
		<th colspan="2"><?php echo($config_lea->appelation_tuteur_cfa);?></th>
	</tr>
	<tr >
		<td>Nom / Pr&eacute;nom</td>
		<td class="nom">
		  <?php 
		  	if($tuteur->id_ens > 0) 
				echo"<a href=\"apprentis.php?cmd=cons_coordonnees_ens&id_ens_select=$tuteur->id_ens\">
						$tuteur->nom &nbsp; $tuteur->prenom
					 </a>";					 
			else echo"?";
		  ?>
		</td>
	</tr>
	<tr >
		<th colspan="2"><?php echo $config_lea->appelation_rl; ?></th>
	</tr>
	<tr >
		<td>Nom / Pr&eacute;nom</td>
		<td class="nom">
		  <?php 
		  		if($rl->id_rl > 0) 
					echo"<a href=\"apprentis.php?cmd=cons_coordonnees_rl&id_rl_select=$rl->id_rl\">
							$rl->nom &nbsp; $rl->prenom
						</a>"; 
			?>
		</td>
	</tr>
</table>
<br>
<ul class="suivi">
	<li><a class="suiviCFA" href="<?php echo"apprentis.php?cmd=cons_dec_app&id_app_select=$apprenti->id_app&type_suivi=cfa"?>"><?php echo $config_lea->appelation_suivi_cfa; ?></acronym></a></li>
	<li><a class="suiviEntreprise" href="<?php echo"apprentis.php?cmd=cons_dec_app&id_app_select=$apprenti->id_app&type_suivi=entr"?>"><?php echo $config_lea->appelation_suivi_entr; ?></a></li>
</ul>

</div>