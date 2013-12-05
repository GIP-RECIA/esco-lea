<?php
/***********************************************************/
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 06/09/05
// Contenu:
/***********************************************************/
include_once("../secure.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");

/***********************************************************/
if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; // l'action demandï¿½e : mofier ou ajouter un nouvel usager
else $action="";

if ($action=="modif") $id_ma=$_REQUEST['id_ma'];
else $id_ma=0;

$ma=new Maitre_apprentissage($id_ma);
$ma->set_detail();

$bdd = new Connexion_BDD_LEA();
$les_entreprises = $bdd->get_entreprises(0,10000);

$les_formations=$bdd->get_formations();
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
	
function afficherDivFor(e, div)
{
	var fx;
	var nb = <?php echo count($les_formations); ?>;

	if (e.src.contains('ouverture'))
	{
		fx = new Fx.Style(div, 'height', {duration: (nb > 10 ? 1000 : 100 * nb), onComplete: function() {div.getElements('div')[0].setStyle('display', '')}}).start(nb * 20);
		e.src = 'fermeture.jpg';
	}
	else
	{
		fx = new Fx.Style(div, 'height', {duration: 250, onStart: function () {div.getElements('div')[0].setStyle('display', 'none')}}).start(1);
		e.src = 'ouverture.jpg';
	}
}
</script>
<div id="top_l"></div>
<div id="top_m"><?php
if ($action != "modif") {
	echo "<h1><span class='orange'>A</span>jouter ".$config_term->terminologie_ma."</h1>";
} else {
	echo "<h1><span class='orange'>M</span>odifier ".$config_term->terminologie_ma."</h1>";
}
?></div>
<div id="top_r"></div>
<div id="m_contenu"><?php echo"
	<form name='theForm' action='form_nouv_usag_v.php?profil=$profil&action=$action&id_usager=$id_ma' method='post' onsubmit='return controleSaisie(this)'>" ?>
<table width="69%" height="62%" border="0" cellpadding="0"
	cellspacing="0">
	<tr>
		<th height="28" colspan="2"><?php echo $config_term->terminologie_entr; ?></th>
	</tr>
	<tr>
		<td><select name="id_entr">
			<option value=0>--- S&eacute;lectionnez <?php echo $config_term->terminologie_entr; ?>
			---</option>
			<?php
			if (isset($les_entreprises)){
				foreach($les_entreprises as $entreprise) {

					if ($entreprise->id_entr==$ma->id_entr) $selected="selected=\"selected\"";
					else $selected="";
					echo "
						<option value='".$entreprise->id_entr."' ".$selected.">".$entreprise->nom."</option>";
				}
			}

			?>
		</select> <?php //lien qui ne sert pas ?? ?> <a href="#"
			onClick="window.open('../Gest_entr/nouv_entr.php','LEA','height=500, width=600, left=150, top=100, scrollbars=no')"></a>
		</td>
	</tr>
	<tr>
		<th height="28" colspan="2">Informations <?php echo $config_term->terminologie_ma; ?></th>
	</tr>
	<tr>
		<td width="43%" height="37">Civilit&eacute;</td>
		<td width="57%"><?php  
		if($ma->civilite=="Monsieur")
		echo"<input name='civilite' type='radio' value='Monsieur' checked > Monsieur";
		else echo"<input name='civilite' type='radio' value='Monsieur' > Monsieur";
			
		if($ma->civilite=="Madame")
		echo"<input name='civilite' type='radio' value='Madame' checked> Madame";
		else echo"<input name='civilite' type='radio' value='Madame'  > Madame";
			
		if($ma->civilite=="Mademoiselle")
		echo"<input name='civilite' type='radio' value='Mademoiselle' checked > Mademoiselle";
		else echo"<input name='civilite' type='radio' value='Mademoiselle' > Mademoiselle";
		echo"<sup class='etoile'>*</sup> ";
		?></td>
	</tr>
	<tr>
		<td height="30">Nom</td>
		<td><input name="nom" type="text" value='<?php echo $ma->nom;?>'> <sup
			class="etoile">*</sup></td>
	</tr>
	<tr>
		<td height="28">Pr&eacute;nom</td>
		<td><input name="prenom" type="text" value='<?php echo $ma->prenom;?>'>
		<sup class="etoile">*</sup></td>
	</tr>
	<tr>
		<td height="18">Adresse</td>
		<td><textarea name="adresse" cols="40" rows="4"><?php echo $ma->adresse;?></textarea>
		<sup class="etoile">*</sup></td>
	</tr>
	<tr>
		<td height="20">T&eacute;l&eacute;phone fixe</td>
		<td><input name="tel_fixe" type="text"
			value='<?php echo $ma->tel_fixe;?>'></td>
	</tr>
	<tr>
		<td height="18">T&eacute;l&eacute;phone portable</td>
		<td><input name="tel_mobile" type="text"
			value='<?php echo $ma->tel_mobile;?>'></td>
	</tr>
	<tr>
		<td height="22">E-mail</td>
		<td><input name="email" type="text" value='<?php echo $ma->email;?>'></td>
	</tr>
	<tr>
		<td height="18">Site web(url)</td>
		<td><input name="url_site" type="text"
			value='<?php echo $ma->url_site;?>'></td>
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
		<th height="18" colspan="2">Authentification</th>
	</tr>
	<tr <?php echo $style_display ?> >
		<td height="18">Login</td>
		<td><input name="login" type="text" value='<?php echo $ma->login;?>'
			onFocus=" auto_login(document.theForm)"> <sup class="etoile">*</sup>
		</td>
	</tr>
	<tr <?php echo $style_display ?> >
		<td height="18">Mot de passe</td>
		<td><input name="mdp" type="password" value='<?php echo $ma->mdp;?>'>
		<sup class="etoile">*</sup></td>
	</tr>
	<tr <?php echo $style_display ?> >
		<td height="18">Confirmer mot de passe</td>
		<td><input name="confirm_mdp" type="password"
			value='<?php echo $ma->mdp;?>'> <sup class="etoile">*</sup></td>
	</tr>
	<tr>
		<td height="18">Droit</td>
		<td class="cellule"><?php
		if($id_ma!=0){
			$bdd = new Connexion_BDD_LEA();
			$prof=$bdd->getprofil($id_ma);
			if(ereg("admin",$prof)) {
				echo "<input name='droit[]' type='checkbox' value='admin' checked>".$config_term->terminologie_admin."  <br/> ";
			} else {
				echo "<input name='droit[]' type='checkbox' value='admin'>".$config_term->terminologie_admin."  <br/> ";
			}
			if(ereg("rvs",$prof)) {
				echo"<input name='droit[]' type='checkbox' value='rvs' checked> $config_term->terminologie_rvs <br/>";
			}
			else {
				echo"<input name='droit[]' type='checkbox' value='rvs'> $config_term->terminologie_rvs <br/>";
			}
			if(ereg("ens",$prof)) {
				echo"<input name='droit[]' type='checkbox' value='ens' checked>$config_term->terminologie_ens<br/>";
			}
			else {
				echo"<input name='droit[]' type='checkbox' value='ens' >$config_term->terminologie_ens<br/>";
			}
			echo "<input name='droit[]' type='checkbox' value='ma' checked disabled>$config_term->terminologie_ma <br/>";
			echo "<input name='droit[]' type='hidden' value='ma'>";
			if(ereg("sr",$prof)) {
				echo "<input name='droit[]' type='checkbox' value='sr' checked>auteur de livret de la formation :";
			}
			else {
				echo "<input name='droit[]' type='checkbox' value='sr' >auteur de livret de la formation :";
			}
			echo '&nbsp;<img src="ouverture.jpg" alt="Ouvrir" onclick="afficherDivFor(this, $(\'liste_for\'))"<br />';
			echo '<div id="liste_for" style="padding-left:10px"><div style="display:none">';
			$les_formations=$bdd->get_formations();

			foreach($les_formations as $formation){
				$sql="SELECT id_for From les_sous_resp WHERE id_for='$formation->id_for' AND id_usager='$id_ma'";
				$result=$bdd->executer($sql);
				if (mysql_num_rows($result)==1) {
					$selection="checked";
				}
				else {
					$selection="";
				}
					
				echo '<input type="checkbox" value="'.$formation->id_for.'" '.$selection.' name="id_for[]" />'.$formation->nom.' <br />';
			}
			echo '</div></div>';
		}if($id_ma==0){
			$sql="select * from les_droits";
			$result=$bdd->executer($sql);
			while($ligne = mysql_fetch_assoc($result)){
				if($ligne['id_droit']=="ma"){
					$drsoumis=$ligne['dr_soumis'];
				}

			}
			?> <input name='droit[]' type='checkbox' value='admin'
			<?php if(ereg("admin",$drsoumis))echo "checked";?>><?php echo $config_term->terminologie_admin;?><br />
		<input name='droit[]' type='checkbox' value='rvs'
		<?php if(ereg("rvs",$drsoumis))echo "checked";?>><?php echo $config_term->terminologie_rvs;?><br />
		<input name='droit[]' type='checkbox' value='ens'
		<?php if(ereg("ens",$drsoumis))echo "checked";?>><?php echo $config_term->terminologie_ens;?><br />
		<input name='droit[]' type='checkbox' value='ma' checked disabled><?php echo $config_term->terminologie_ma;?><br />
		<input name='droit[]' type="hidden" value="ma" /> <?php 
		echo "<input name='droit[]' type='checkbox' value='sr' >auteur de livret de la formation :";
		echo '&nbsp;<img src="ouverture.jpg" alt="Ouvrir" onclick="afficherDivFor(this, $(\'liste_for\'))"<br />';
		echo '<div id="liste_for" style="padding-left:10px"><div style="display:none">';

		foreach($les_formations as $formation){
			$sql="SELECT id_for From les_sous_resp WHERE id_for='$formation->id_for' AND id_usager='$id_ma'";
			$result=$bdd->executer($sql);
			if (mysql_num_rows($result)==1) {
				$selection="checked";
			}
			else {
				$selection="";
			}

			echo '<input type="checkbox" value="'.$formation->id_for.'" '.$selection.' name="id_for[]" />'.$formation->nom.' <br />';
		}
		echo '</div></div>';
		}
		?></td>
	</tr>
	<tr>
		<td><input type="submit" name="Submit" value="Valider"></td>
	</tr>
</table>
</form>
</div>
