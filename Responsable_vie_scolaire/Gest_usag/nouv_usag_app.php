<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

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
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; // l'action demandï¿½e : mofier ou ajouter un nouvel apprenti
else $action="nouv";

if ($action=="modif") $id_app = $_REQUEST['id_app'];
else $id_app=0;

$apprenti = new Apprenti($id_app);
$apprenti->set_detail();

$bdd = new Connexion_BDD_LEA();
$les_enseignants = $bdd->get_usagers(0,10000, "ens"); //liste de tous les enseignants
$les_rl = $bdd->get_usagers(0,10000, "rl"); 		  //liste de tous les  reprï¿½sentants lï¿½gaux
$les_ma = $bdd->get_usagers(0,10000, "ma"); 		  //liste de tous les maitres d'apprentissage

$unite = new Unite_pedagogique($_SESSION['id_unite']);

$les_classes = $unite->get_classes(); 

 ?>
 
 <script language="JavaScript">
 
function controleSaisie(theForm)
{   
    			    
   if(testCivilite(theForm.civilite)==false) return false;
   
   if(testNom(theForm.nom, "nom")==false) return false;
   
   if(testNom(theForm.prenom, "prenom")==false) return false;
   
   if(testVide(theForm.adresse, "adresse")==false) return false;
   
   if(testLongueur(theForm.login, "login", 6 )==false) return false;
   
   if(testLongueur(theForm.mdp, "mot de passe", 6 )==false) return false;
   
   if(verifMotPass ( theForm.mdp, theForm.confirm_mdp)==false) return false;
    
   return true;

}

 </script>		
  			<div id="top_l"></div><div id="top_m">
			  <h1><span class="orange">N</span>ouvel apprenti</h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">
 
<?php echo"<form name='theForm' action='form_nouv_usag_v.php?id_usager=$id_app&profil=app&action=$action' method='post' onsubmit='return controleSaisie(this)' enctype='multipart/form-data'>" ?>
<table width="69%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th height="37" colspan="2">Informations apprenti</th>
  </tr>
  <tr>
    <td height="47">Classe</td>
    <td><?php 			  			  
              echo" <select name='id_cla'>";
			  echo" <option value='0'> Inconnue </option>";
			  if (count($les_classes) > 0){
			  	
			  	foreach ($les_classes as $classe){
							  			  
				if ($classe->id_cla == $apprenti->id_cla) $selected="selected";
				else $selected="";
			  	echo" <option value='$classe->id_cla' $selected> $classe->libelle </option>";			  
			  	}
			 }				  				
              echo" </select>";
			  			  
			  ?>
    </td>
  </tr>
  <tr>
    <td width="44%" height="32">Civilit&eacute;</td>
    <td width="56%">
      <?php  
				
				if($apprenti->civilite=="Monsieur")
				     echo"<input name='civilite' type='radio' value='Monsieur' checked >Monsieur";
				else echo"<input name='civilite' type='radio' value='Monsieur' >Monsieur";
				
				if($apprenti->civilite=="Madame")
				     echo"<input name='civilite' type='radio' value='Madame' checked>Madame";
				else echo"<input name='civilite' type='radio' value='Madame'  >Madame";
				
				if($apprenti->civilite=="Mademoiselle")
				     echo"<input name='civilite' type='radio' value='Mademoiselle' checked >Mademoiselle";
				else echo"<input name='civilite' type='radio' value='Mademoiselle' >Mademoiselle";      			  
				echo"<sup class='etoile'>*</sup> ";
				?>
    </td>
  </tr>
  <tr>
    <td height="30">Nom</td>
    <td>
      <input name="nom" type="text" value="<?php echo (to_html($apprenti->nom))?>" size="40">
    <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="26">Pr&eacute;nom</td>
    <td>
      <input name="prenom" type="text" value="<?php echo(to_html($apprenti->prenom))?>" size="40">
    <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Adresse</td>
    <td>
      <textarea name="adresse" cols="40" rows="4" ><?php echo(to_html($apprenti->adresse))?></textarea>
    <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="20">T&eacute;l&eacute;phone fixe</td>
    <td>
      <input name="tel_fixe" type="text" value='<?php echo "$apprenti->tel_fixe"?>'>
    </td>
  </tr>
  <tr>
    <td height="18">T&eacute;l&eacute;phone portable</td>
    <td>
      <input name="tel_mobile" type="text" value='<?php echo "$apprenti->tel_mobile"?>'>
    </td>
  </tr>
  <tr>
    <td height="22">E-mail </td>
    <td>
      <input name="email" type="text" value='<?php echo "$apprenti->email"?>' size="40">
    </td>
  </tr>
  <tr>
    <td height="21">Site web(url)</td>
    <td><input name="url_site" type="text"value='<?php echo "$apprenti->url_site"?>' size="40">
    </td>
  </tr>
  <tr>
    <th height="37" colspan="2">Autres Informations</th>
  </tr>
  <tr>
    <td height="25">Date de naissance </td>
    <td>
      <input name="date_nais" type="text" readonly  size="16" maxlength="12" value="<?php echo (trans_date($apprenti->date_nais))?>">
      <?php afficher_lien_calendrier("theForm", "date_nais"); ?>
    </td>
  </tr>
  <tr>
    <td height="25">Num&eacute;ro d'inscription</td>
    <td><input name="no_insc" type="text" value='<?php echo "$apprenti->no_insc"?>'>
    </td>
  </tr>
  <tr>
    <td height="23" bordercolor="#99CCFF">Num&eacute;ro de s&eacute;curit&eacute; sociale</td>
    <td><input name="no_secu" type="text" value='<?php echo "$apprenti->no_secu"?>'>
    </td>
  </tr>
  <tr>
    <td height="22">Situation ann&eacute;e p&eacute;c&eacute;dente</td>
    <td><input name="dern_classe_freq" type="text" value='<?php echo (to_html($apprenti->dern_classe_freq))?>'>
    </td>
  </tr>
  <tr>
    <td height="18">Diplômes obtenus</td>
    <td>
      <input name="diplomes_obtenus" type="text" value="<?php echo (to_html($apprenti->diplomes_obtenus)) ?>">
    </td>
  </tr>
  <tr>
    <td height="72">Autre adresse </td>
    <td>
      <textarea name="adresse_perso" cols="40" rows="4" ><?php echo (to_html($apprenti->adresse_perso)) ?></textarea>
    </td>
  </tr>
  <tr>
    <td height="18">T&eacute;l&eacute;phone personnel</td>
    <td><input name="tel_perso" type="text" value='<?php echo "$apprenti->tel_perso"?>' maxlength="30">
    </td>
  </tr>
  <tr>
    <td height="18">E-mail personnel</td>
    <td><input name="email_perso" type="text" value='<?php echo "$apprenti->email_perso"?>' size="40">
    </td>
  </tr>
  <tr>
    <td height="18">Photo</td>
    <td bordercolor="#99CCFF"><input name="src_photo" type="file" id="src_photos2">
    </td>
  </tr>
  <tr>
    <th height="34" colspan="2">Authentification</th>
  </tr>
  <tr>
    <td height="18">Login</td>
    <td><input name="login" type="text" value='<?php echo "$apprenti->login"?>' onFocus=" auto_login(document.theForm)" >
        <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Mot de passe</td>
    <td><input name="mdp" type="password" value='<?php echo "$apprenti->mdp"?>' >
        <sup class="etoile">*</sup> </td>
  </tr>
  <tr>
    <td height="18">Confirmer mot de passe</td>
    <td>
      <input name="confirm_mdp" type="password" value='<?php echo "$apprenti->mdp"?>' >
      <sup class="etoile">*</sup> </td>
  </tr>
  <tr >
    <th height="22" colspan="2">Suivi : <?php echo $config_term->terminologie_entr ?></th>
  </tr>
  <tr>
    <td height="29"><?php echo $config_term->terminologie_ma ?></td>
    <td>
      <?php 			  			  
              echo" <select name='id_ma'>";
			  echo" <option value='0'>Inconnu</option>";
			  if (isset($les_ma)){
			 
			  	foreach ($les_ma as $ma){
							  			  
				if ($ma->id_ma== $apprenti->id_ma) $selected="selected";
				else $selected="";
			  	echo" <option value='$ma->id_ma' $selected > $ma->nom &nbsp $ma->prenom </option>";			  
			  	}
			 }				  				
              echo" </select>";
               ?>
    </td>
  </tr>
  <tr>
    <td height="31">Date de début du contrat</td>
    <td>
        <input type="text" name="date_debut_contrat" readonly value="<?php echo(trans_date($apprenti->date_debut_contrat)) ?>" >
        <?php afficher_lien_calendrier("theForm", "date_debut_contrat"); ?>
    </td>
  </tr>
  <tr>
    <td height="26">Date de fin du contrat</td>
    <td>
        <input type="text" name="date_fin_contrat" readonly value="<?php echo(trans_date($apprenti->date_fin_contrat)) ?>">
        <?php afficher_lien_calendrier("theForm", "date_fin_contrat"); ?>
    </td>
  </tr>
  <tr >
    <th height="23" colspan="2">Suivi : <?php echo $config_term->terminologie_cfa ?></th>
  </tr>
  <tr>
    <td height="24"><?php echo $config_term->terminologie_tuteur_cfa ?></td>
    <td>
      <?php 			  			  
              echo" <select name='id_ens'>";
			  echo" <option value='0'> Inconnu </option>";
			  if (count($les_enseignants) > 0){
			  	
			  	foreach ($les_enseignants as $enseignant){
							  			  
				if ($enseignant->id_ens == $apprenti->id_ens) $selected="selected";
				else $selected="";
			  	echo" <option value='$enseignant->id_ens' $selected> $enseignant->nom &nbsp $enseignant->prenom </option>";			  
			  	}
			 }				  				
              echo" </select>";
			  			  
			  ?>
    </td>
  </tr>
  <tr>
    <th height="25" colspan="2">Suivi :  <?php echo $config_term->terminologie_rl ?></th>
  </tr>
  <tr>
    <td><?php echo $config_term->terminologie_rl ?> </td>
    <td>
      <?php 			  			  
              echo" <select name='id_rl'>";
			  echo" <option value='0'> Inconnu </option>";
			  if (isset($les_rl)){
			 
			  	foreach ($les_rl as $rl){
							  			  
				if ($rl->id_rl == $apprenti->id_rl) $selected="selected";
				else $selected="";
			  	echo" <option value='$rl->id_rl' $selected > $rl->nom &nbsp $rl->prenom </option>";			  
			  	}
			 }				  				
              echo" </select>";
               ?>
    </td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td><input type="submit" name="Submit" value="Valider"></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>