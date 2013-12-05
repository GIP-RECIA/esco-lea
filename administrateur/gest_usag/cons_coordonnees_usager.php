<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 06/09/05
// Contenu: ce script permet d'afficher les coordonnï¿½es de l'un des usager suivants
//         - L'apprenti d'identifiant id_app
// 		 - L'enseignant  d'identifiant id_ens
//         - Le maitre d'apprentissage d'identifiant id_ma
//         - Le representant lï¿½gal d'identifiant id_rl
//         - L'administrateur d'identifiant id_usager

/***********************************************************/
require_once("../secure.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");

/***********************************************************/

$profil = $_REQUEST['profil'];

switch($profil){

	case "app":
		afficher_sous_menu("cons_liste_app");
		$id_app = $_REQUEST['id_app'];
		$apprenti=new Apprenti($id_app);
		$apprenti->set_detail();
		$classe = new Classe($apprenti->id_cla);
		$classe->set_detail();
		$ma_app =  new Usager($apprenti->id_ma); $ma_app->set_detail();
		$rl_app =  new Usager($apprenti->id_rl); $rl_app->set_detail();
		$tuteur_app = new Usager($apprenti->id_ens); $tuteur_app->set_detail();

		$usager = $apprenti;
		$id_usager = $apprenti->id_app;
		$titre="Les coordonn&eacute;es ".$config_term->terminologie_app." "; //titre de la page
		$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=app&action=modif&id_app=$apprenti->id_app";
		break;

	case "ens":
		afficher_sous_menu("cons_liste_ens");

		$id_ens=$_REQUEST['id_ens'];
		$enseignant=new Enseignant($id_ens);
		$enseignant->set_detail();
		$usager=$enseignant;

		$id_usager=$enseignant->id_ens;
		$titre="Les coordonn&eacute;es de ".$config_term->terminologie_ens."";
		$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=ens&action=modif&id_ens=$enseignant->id_ens";
		break;

	case "ma":
		afficher_sous_menu("cons_liste_ma");

		$id_ma=$_REQUEST['id_ma'];
		$ma=new Maitre_apprentissage($id_ma);
		$ma->set_detail();
		$entreprise=new Entreprise($ma->id_entr);
		$entreprise->set_detail();
		$usager=$ma;
		$id_usager=$ma->id_ma;

		$titre="Les coordonn&eacute;es ".$config_term->terminologie_ma."";
		$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=ma&action=modif&id_ma=$ma->id_ma";
		break;

	case "rl":
		afficher_sous_menu("cons_liste_rl");
		$titre="Les coordonn&eacute;es du ".$config_term->terminologie_rl."";
		$id_rl=$_REQUEST['id_rl'];
		$rl=new Representant_legal($id_rl);
		$rl->set_detail();
		$usager=$rl;
		$id_usager=$rl->id_rl;
		$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=rl&action=modif&id_rl=$rl->id_rl";
		break;

	case "admin":
		afficher_sous_menu("cons_liste_admin");
		$titre="Les coordonn&eacute;es ".$config_term->terminologie_admin."";
		$id_usager=$_REQUEST['id_usager'];
		$admin=new Usager($id_usager);
		$admin->set_detail();
		$usager=$admin;
		$id_usager=$usager->id_usager;
		$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=admin&action=modif&id_usager=$admin->id_usager";

		break;
	case "rvs":
		afficher_sous_menu("cons_liste_rvs");
		$titre="Les coordonn&eacute;es ".$config_term->terminologie_rvs."";
		$id_usager= $_REQUEST['id_usager'];
		$rvs=new Usager($id_usager);
		$rvs->set_detail();
		$usager=$rvs;
		$id_usager=$usager->id_usager;
		$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=rvs&action=modif&id_usager=$rvs->id_usager";

		break;
	default     :
		break;
}
?>
<div id="top_l"></div>
<div id="top_m">
	<h1><?php echo" $titre" ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<?php 
	echo "<br><img src='../../images/b_edit.png'><a href='$href_modif' class='txt_grand'>Modifier ses coordonn&eacute;es</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
	afficher_boutton_ecrire_msg("Ecrire un message via LEA", $id_usager);
	?> 
<table>

	<?php if($profil=='app') { ?>
		<tr>
			<td ><?php echo($config_term->terminologie_classe); ?></td>
			<td >
				<?php
					if($classe->libelle!="") echo"<b>$classe->libelle </b>"; else echo"<font color='red' >?</font>";
				?>
			</td>
		</tr>
		<tr>
			<td>Date de cr&eacute;ation</td>
			<td><b><?php echo"$apprenti->date_creation" ?></b></td>
		</tr>
	<?php  } ?>
	<tr>
		<th height="28" colspan="3">Coordonn&eacute;es</th>
	</tr>
	<tr>
		<td height="18" width="30%">Civilit&eacute;</td>
		<td ><b><?php echo"$usager->civilite" ?></b></td>
		<?php
			if ($profil=='app') {
				echo "<td rowspan='4' align='right' valign='top'  class='cellule'>";
				echo"<img src='../../Apprenti/Photos/$apprenti->src_photo' width='120' height='120'>";
				echo"</td>";
			}
		?>
	</tr>
	<tr>
		<td height="18">Nom</td>
		<td><b> <?php echo"$usager->nom" ?> </b></td>
	</tr>
	<tr>
		<td height="18">Pr&eacute;nom</td>
		<td><b><?php echo"$usager->prenom" ?></b></td>
	</tr>
	<tr>
		<td height="33">Adresse</td>
		<td><b><?php echo"$usager->adresse" ?> </b></td>
	</tr>
	<tr>
		<td height="20">T&eacute;l&eacute;phone fixe</td>
		<td colspan="2"><b><?php echo"$usager->tel_fixe" ?></b></td>
	</tr>
	<tr>
		<td height="18">T&eacute;l&eacute;phone portable</td>
		<td colspan="2"><b class="txt_gras"><?php echo"$usager->tel_mobile" ?></b></td>
	</tr>
	<tr>
		<td height="22">E-mail</td>
		<td colspan="2"><a href='mailto:<?php echo"$usager->email" ?>'><?php echo"$usager->email" ?></a></td>
	</tr>
	<tr>
		<td height="18">Site web(url)</td>
		<td colspan="2"><a href='<?php echo"$usager->url_site" ?>' target="_blank"><?php echo"$usager->url_site" ?></a></td>
	</tr>
	<?php 
		// On cache les informations sur l'authentification quand le CAS est utilise
		$style_display = "";
		if( $AUTHENTIFICATION_CAS ) {
			$style_display = ' style="display: none;" ';
		}
			$style_display = ' style="display: none;" ';
	?>
	<tr <?php echo $style_display ?> >
		<th height="18" colspan="2" class="titre_tableau">Authentification</th>
	</tr>
	<tr <?php echo $style_display ?> >
		<td height="18">Login</td>
		<td ><b><?php echo"$usager->login" ?></b></td>
	</tr>
	<tr <?php echo $style_display ?> >
		<td height="18">Mot de passe</td>
		<td><b><?php echo"$usager->mdp" ?></b></td>
	</tr>
	<?php if($profil=='app'){ ?>
			<tr>
				<th height="21" colspan="2">Suivi <?php echo($config_term->terminologie_classe); ?>	</th>
			</tr>
			<tr>
				<td height="29"><?php echo($config_term->terminologie_ma); ?></td>
				<td><b><?php echo"$ma_app->nom $ma_app->prenom"; ?></b></td>
			</tr>
			<tr>
				<td height="26"><?php echo($config_term->terminologie_tuteur_cfa); ?></td>
				<td height="26"><b><?php echo"$tuteur_app->nom $tuteur_app->prenom";  ?></b></td>
			</tr>
			<tr>
				<td height="26"><?php echo($config_term->terminologie_rl); ?></td>
				<td height="26"><b><?php echo"$rl_app->nom $rl_app->prenom";  ?></b></td>
			</tr>
			<tr>
				<td height="31">Date de début du contrat</td>
				<td><b><?php echo(trans_date($apprenti->date_debut_contrat))?></b></td>
			</tr>
			<tr>
				<td height="26">Date de fin du contrat</td>
				<td><b><?php echo(trans_date($apprenti->date_fin_contrat)) ?></b></td>
			</tr>
			<tr>
				<th height="26" colspan="2">Autres Informations</th>
			</tr>
			<tr>
				<td height="25" class="sous_titre_tableau">Date de naissance</td>
				<td class="cellule"><b><?php echo(trans_date($apprenti->date_nais)) ?></b></td>
			</tr>
			<tr>
				<td height="28" class="sous_titre_tableau">Num&eacute;ro d'inscription</td>
				<td class="cellule"><b><?php echo"$apprenti->no_insc" ?></b></td>
			</tr>
			<tr>
				<td height="23" class="sous_titre_tableau">Num&eacute;ro de s&eacute;curit&eacute; sociale</td>
				<td class="cellule"><b><?php echo"$apprenti->no_secu" ?></b></td>
			</tr>
			<tr>
				<td height="22" class="sous_titre_tableau">Situation ann&eacute;e p&eacute;c&eacute;dente</td>
				<td class="cellule"><b><?php echo"$apprenti->dern_classe_freq" ?></b></td>
			</tr>
			<tr>
				<td height="18" class="sous_titre_tableau">Diplômes obtenus</td>
				<td class="cellule"><b><?php echo"$apprenti->diplomes_obtenus" ?></b></td>
			</tr>
			<tr>
				<td height="41" class="sous_titre_tableau">Autre adresse</td>
				<td class="cellule"><b><?php echo"$apprenti->adresse_perso" ?></b></td>
			</tr>
			<tr>
				<td height="18">T&eacute;l&eacute;phone personnel</td>
				<td><b><?php echo"$apprenti->tel_perso" ?></b></td>
			</tr>
			<tr>
				<td height="18">E-mail personnel</td>
				<td><b><?php echo"$apprenti->email_perso" ?></b></td>
			</tr>
		<?php } else if($profil=='ens'){  ?>
			<tr>
				<th height="18" colspan="2">Autres Informations</th>
			</tr>
			<tr>
				<td height="18">Discipline</td>
				<td ><b><?php echo"$enseignant->discipline" ?></b></td>
			</tr>
		<?php } else if($profil=='ma'){ ?>
			<tr>
				<th height="18" colspan="2">Autres Informations</th>
			</tr>
			<tr>
				<td height="18"><?php echo($config_term->terminologie_entr); ?></td>
				<td ><b><?php echo"$entreprise->nom" ?></b></td>
			</tr>
		<?php } else if($profil=='rl'){ ?>
			<tr>
				<th height="18" colspan="2">Autres Informations</th>
			</tr>
			<tr>
				<td height="18">Profession</td>
				<td ><b><?php echo"$rl->profession" ?></b></td>
			</tr>
			<tr>
				<td height="41">Adresse professionnelle</td>
				<td><b><?php echo"$rl->adresse_prof" ?></b></td>
			</tr>

		<?php } else ?>
</table>
	<?php 	echo" <br><img src='../../images/b_edit.png'><a href='$href_modif' class='txt_grand'>Modifier ses coordonn&eacute;es</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
			afficher_boutton_ecrire_msg("Ecrire un message via LEA", $id_usager);
		?>
</div>
		
