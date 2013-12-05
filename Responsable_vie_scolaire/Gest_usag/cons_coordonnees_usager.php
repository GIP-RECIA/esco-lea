<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: ce script permet d'afficher les coordonnées de l'un des usager suivants
  //         - L'apprenti d'identifiant id_app
  // 		 - L'enseignant  d'identifiant id_ens
  //         - Le maitre d'apprentissage d'identifiant id_ma
  //         - Le representant légal d'identifiant id_rl
  //         - L'administrateur d'identifiant id_usager

/***********************************************************/
require_once("../secure.php");
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

case "app": afficher_sous_menu("cons_liste_app");
			$titre="Les coordonnées de l'apprenti"; //titre de la page
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
			
			$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=app&action=modif&id_app=$apprenti->id_app";			
			break;

case "ens": afficher_sous_menu("cons_liste_ens");
			$titre="Les coordonnées de l'enseignant";
			$id_ens=$_REQUEST['id_ens'];	
			$enseignant=new Enseignant($id_ens);
			$enseignant->set_detail();
						
			$usager=$enseignant;
			
			$id_usager=$enseignant->id_ens;
			$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=ens&action=modif&id_ens=$enseignant->id_ens";						
			break;
			
case "ma": afficher_sous_menu("cons_liste_ma");
			$titre="Les coordonnées du maitre d'apprentissage";
			$id_ma=$_REQUEST['id_ma'];	
			$ma=new Maitre_apprentissage($id_ma);
			$ma->set_detail();
			$entreprise=new Entreprise($ma->id_entr);
			$entreprise->set_detail();		
			$usager=$ma;
			$id_usager=$ma->id_ma;
			$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=ma&action=modif&id_ma=$ma->id_ma";						
			break;
		
case "rl":  afficher_sous_menu("cons_liste_rl");
			$titre="Les coordonnées du parent";
			$id_rl=$_REQUEST['id_rl'];	
			$rl=new Representant_legal($id_rl);
			$rl->set_detail();					
			$usager=$rl;
			$id_usager=$rl->id_rl;
			$href_modif="gest_usag.php?cmd=form_nouv_usag&profil=rl&action=modif&id_rl=$rl->id_rl";						
			break;
			
case "admin": afficher_sous_menu("cons_liste_admin");
			  $titre="Les coordonnées de l'administrateur";
	  		  $id_usager=$_REQUEST['id_usager'];	
			  $admin=new Usager($id_usager);
			  $admin->set_detail();					
			  $usager=$admin;
			  $id_usager = $usager->id_usager;
			  $href_modif="gest_usag.php?cmd=form_nouv_usag&profil=admin&action=modif&id_usager=$admin->id_usager";						

			break;
case "rvs":  afficher_sous_menu("cons_liste_rvs");
			  $titre="Les coordonnées du responsable vie scolaire";
	  		  $id_usager= $_REQUEST['id_usager'];	
			  $rvs=new Usager($id_usager);
			  $rvs->set_detail();					
			  $usager = $rvs;
			  $id_usager=$usager->id_usager;
			  $href_modif="gest_usag.php?cmd=form_nouv_usag&profil=rvs&action=modif&id_usager=$rvs->id_usager";						

			break;			
default     : 
			break;			
}			
 ?>		
 			<div id="top_l"></div><div id="top_m">
			  <h1><?php echo" $titre" ?></h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
<p>
  <?php if($profil=='app') { ?>
</p>
<table width="48%" cellspacing="0"   >
  <tr >
    <td width="29%" class="cellule">Classe</td>
    <td width="71%" class="cellule"> <b>
      <?php
					if($classe->libelle!="") echo"<b >$classe->libelle </b>";
					else echo"<font color='red' >?</font>";
				?>
    </b> </td>
  </tr>
  <tr >
    <td class="cellule">Date de cr&eacute;ation</td>
    <td class="cellule"><p class="txt_gras"><?php echo"$apprenti->date_creation" ?></p>
    </td>
  </tr>
</table>
<?php  } ?>
<table width="61%" height="62%"  cellspacing="0">
  <tr>
    <th height="28" colspan="3" >Coordonn&eacute;es</th>
  </tr>
  <tr>
    <td width="40%" height="18">Civilit&eacute;</td>
    <td width="60%"><p> <?php echo"$usager->civilite" ?> </p>
    </td>
    <?php 
				if ($profil=='app') { 
				echo "<td width='29%' rowspan='4' align='right' valign='top'  class='cellule'>";
				echo"<img src='../../Apprenti/Photos/$apprenti->src_photo' width='120' height='120'>"; 
				echo"</td>";
				}
				?>
  </tr>
  <tr>
    <td height="18">Nom</td>
    <td><p> <?php echo"$usager->nom" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="18">Pr&eacute;nom</td>
    <td>
      <p class="txt_gras"><?php echo"$usager->prenom" ?></p>
    </td>
  </tr>
  <tr>
    <td height="33">Adresse</td>
    <td>
      <p class="txt_gras"><?php echo"$usager->adresse" ?> </p>
    </td>
  </tr>
  <tr>
    <td height="20">T&eacute;l&eacute;phone fixe</td>
    <td colspan="2"><p class="txt_gras"><?php echo"$usager->tel_fixe" ?> </td>
  </tr>
  <tr>
    <td height="18">T&eacute;l&eacute;phone portable</td>
    <td colspan="2"><p class="txt_gras"><?php echo"$usager->tel_mobile" ?> </td>
  </tr>
  <tr>
    <td height="22">E-mail</td>
    <td colspan="2"><a href='mailto:<?php echo"$usager->email" ?>'><?php echo"$usager->email" ?></a> </td>
  </tr>
  <tr>
    <td height="18">Site web(url)</td>
    <td colspan="2"><a href='<?php echo"$usager->url_site" ?>' target="_blank"><?php echo"$usager->url_site" ?></a> </td>
  </tr>
</table>
<?php if($profil=='app'){ ?>
<table width="61%" height="57%" cellspacing="0"  >
  <tr>
    <th height="18" colspan="2" >Authentification</th>
  </tr>
  <tr>
    <td height="18">Login</td>
    <td><p class="txt_gras"><?php echo"$usager->login" ?></td>
  </tr>
  <tr>
    <td height="18">Mot de passe</td>
    <td><p class="txt_gras"><?php echo"$usager->mdp" ?></td>
  </tr>
  <tr>
    <th height="21" colspan="2" >Suivi de l'apprenti </th>
  </tr>
  <tr>
    <td height="29">Maitre d'apprentissage</td>
    <td><p> <?php echo"$ma_app->nom $ma_app->prenom"; ?> </p>
    </td>
  </tr>
  <tr>
    <td height="26" >Tuteur CFA</td>
    <td height="26" >
      <p> <?php echo"$tuteur_app->nom $tuteur_app->prenom";  ?> </p>
    </td>
  </tr>
  <tr>
    <td height="26" >Repr&eacute;sentant l&eacute;gal</td>
    <td height="26" ><p><?php echo"$rl_app->nom $rl_app->prenom";  ?> </p>
    </td>
  </tr>
  <tr>
    <td height="31">Date de début du contrat</td>
    <td><p><?php echo(trans_date($apprenti->date_debut_contrat))?> </p>
    </td>
  </tr>
  <tr>
    <td height="26">Date de fin du contrat</td>
    <td><p> <?php echo(trans_date($apprenti->date_fin_contrat)) ?> </p>
    </td>
  </tr>
  <tr>
    <th height="26" colspan="2" >Autres Informations</th>
  </tr>
  <tr>
    <td width="39%" height="25" class="sous_titre_tableau">Date de naissance </td>
    <td width="61%" class="cellule"><p class="txt_gras"> <?php echo(trans_date($apprenti->date_nais)) ?> </td>
  </tr>
  <tr>
    <td height="28" class="sous_titre_tableau">Num&eacute;ro d'inscription</td>
    <td class="cellule"><p class="txt_gras"><?php echo"$apprenti->no_insc" ?> </td>
  </tr>
  <tr>
    <td height="23" class="sous_titre_tableau">Num&eacute;ro de s&eacute;curit&eacute; sociale</td>
    <td class="cellule"><p class="txt_gras"><?php echo"$apprenti->no_secu" ?> </td>
  </tr>
  <tr>
    <td height="22" class="sous_titre_tableau">Situation ann&eacute;e p&eacute;c&eacute;dente</td>
    <td class="cellule"><p class="txt_gras"><?php echo"$apprenti->dern_classe_freq" ?> </td>
  </tr>
  <tr>
    <td height="18" class="sous_titre_tableau">Diplômes obtenus</td>
    <td class="cellule"><p class="txt_gras"><?php echo"$apprenti->diplomes_obtenus" ?></td>
  </tr>
  <tr>
    <td height="41" class="sous_titre_tableau">Autre adresse </td>
    <td class="cellule"><p class="txt_gras"><?php echo"$apprenti->adresse_perso" ?> </td>
  </tr>
  <tr>
    <td height="18">T&eacute;l&eacute;phone personnel</td>
    <td><p class="txt_gras"><?php echo"$apprenti->tel_perso" ?> </td>
  </tr>
  <tr>
    <td height="18">E-mail personnel</td>
    <td><p class="txt_gras"><?php echo"$apprenti->email_perso" ?> </td>
  </tr>
</table>
<?php }
			       else if($profil=='ens'){ 
			 ?>
<table width="61%" height="10%" cellspacing="0"  >
  <tr>
    <th height="18" colspan="2">Autres Informations</th>
  </tr>
  <tr>
    <td width="39%" height="18">Discipline</td>
    <td width="61%"><?php echo"$enseignant->discipline" ?></td>
  </tr>
</table>
<?php }
			       else if($profil=='ma'){ 
			 ?>
<table width="61%" height="10%" cellspacing="0">
  <tr>
    <th height="18" colspan="2">Autres Informations</th>
  </tr>
  <tr>
    <td width="39%" height="18">Entreprise</td>
    <td width="61%"><p class="txt_gras"><?php echo"$entreprise->nom" ?> </td>
  </tr>
</table>
<?php }
			       else if($profil=='rl'){ 
			 ?>
<table width="61%" height="30%" cellspacing="0" >
  <tr>
    <th height="18" colspan="2">Autres Informations</th>
  </tr>
  <tr>
    <td width="39%" height="18">Profession</td>
    <td width="61%"><p class="txt_gras"><?php echo"$rl->profession" ?></td>
  </tr>
  <tr>
    <td height="41">Adresse professionnelle</td>
    <td><p class="txt_gras"><?php echo"$rl->adresse_prof" ?> </td>
  </tr>
</table>
<?php }
			       else if($profil=='admin') ;
				   			
              echo" <br>
			  		<img src='../../images/b_edit.png'>
			  		<a href='$href_modif' class='txt_grand'>
						Modifier ses coordonnées
					</a> 					
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					"; 
					
					afficher_boutton_ecrire_msg("Ecrire un message via LEA", $id_usager);
			 ?>
</div>