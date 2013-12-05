<?php
/***********************************************************/  
  // Auteur : GOYER Frédéric
  // Version : 1.0.2
  // Date: 04/05
/***********************************************************/
require_once('../secure.php');

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

/***********************************************************/
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");

$enseignant = new Enseignant($_SESSION['id_ens']); // l'enseignant connecté.
$formation = new Formation($_SESSION['id_for']); // la formation sélectionnée
$config_lea	= $formation->get_config_lea();
$les_classes =  $formation->get_classes();

if (isset($_GET['id_cla'])) $id_cla_select = $_GET['id_cla'];
else $id_cla_select = -1;

if($id_cla_select > 0){
	$classe_select = new Classe($id_cla_select);
	$classe_select->set_detail();
	$les_apprentis = $classe_select->get_apprentis();
}

if (isset($_GET["id_per"])) $id_periode_select = $_GET["id_per"];
else $id_periode_selected = -1;

?>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">S</span>uivi des signatures</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<!-- Récupération de la classe -->
	<form name="claForm" action="apprentis.php"  method="GET">
		<input type='hidden' name='cmd' value='suivi_signature'>
		<select name="id_cla" size="1" onChange="this.form.submit()" >
  			<option value='-1' selected >
  				-- S&eacute;lectionnez: <?php echo($config_lea->appelation_classe);?> --
  			</option>
 			<?php
				foreach($les_classes as $classe){
					if($classe->id_cla == $id_cla_select) $selected = "selected";
					else $selected = "";
					
					echo"<option value='$classe->id_cla' $selected > $classe->libelle </option>";				
				} 
			?>
		</select>
	</form> 
	<!-- Récupération du type de suivi -->
	<form name="suiForm" action="apprentis.php"  method="GET">
		<input type='hidden' name='cmd' value='suivi_signature'>
		<input type='hidden' name='id_cla' value='<?php echo $_GET["id_cla"]; ?>'>
		<?php 
			//Si la classe est au préalable choisie, la suite s'affiche
			if(isset($_GET["id_cla"]) && $_GET["id_cla"] != -1){
				$les_choix_type_suivi = array("entr" => $config_lea->appelation_suivi_entr, "cfa" => $config_lea->appelation_suivi_cfa);
				
				foreach($les_choix_type_suivi as $un_choix_type_suivi_key => $un_choix_type_suivi_value) {
					if(isset($_GET["type_suivi"])) {
						$checked = ($un_choix_type_suivi_key == $_GET["type_suivi"]) ? "checked" : "";
					} else {
						$checked = "";
					}
					echo "<input type='radio' onChange=\"this.form.submit()\" name='type_suivi' 
							id='type_suivi_".$un_choix_type_suivi_key."' 
							value='".$un_choix_type_suivi_key."' ".$checked." />
						<label for='type_suivi_".$un_choix_type_suivi_key."'> 
							".$un_choix_type_suivi_value."
						</label><br />";
				}
			}
		?>
	</form>
	<!-- Récupération de la période -->
	<form name="perForm" action="apprentis.php"  method="GET">
		<input type='hidden' name='cmd' 		value='suivi_signature'>
		<input type='hidden' name='id_cla' 		value='<?php echo $_GET["id_cla"]; ?>'>
		<input type='hidden' name='type_suivi' 	value='<?php echo $_GET["type_suivi"]; ?>'>
		<?php 
			// Si le type de suivi est choisi, la suite s'affiche
			if(isset($_GET["type_suivi"])){ 
				$les_periodes = $formation->get_periodes($_GET["type_suivi"], '',$_GET["id_cla"]);
		?>
		<select name="id_per" size="1" onChange="this.form.submit()" >
  			<option value='-1' selected >
  				-- S&eacute;lectionnez une p&eacute;riode --
  			</option>
 			<?php
				foreach($les_periodes as $periode){
					if($periode->id_periode == $id_periode_select) $selected = "selected";
					else $selected = "";
					
					echo"<option value='$periode->id_periode' $selected > $periode->libelle </option>";				
				} 
			?>
		</select> 
		<?php } ?>
	</form> 
	<!-- Affichage des donnée récupérées -->
	<?php if(isset($_GET["id_per"]) && $_GET["id_per"] != -1){ ?>
	<table>
		<tr>
			<th  colspan="2"><?php echo $config_lea->appelation_app; ?></th>
    		<th  colspan="2"><?php echo $config_lea->appelation_tuteur_cfa; ?></th>
    		<th  colspan="2"><?php echo $config_lea->appelation_ma; ?></th>
    		<th  colspan="2"><?php echo $config_lea->appelation_rl; ?></th>
		</tr>
		<?php 
			foreach($les_apprentis as $apprenti){          		   
				$ma = new Maitre_apprentissage($apprenti->id_ma);
				$ma->set_detail();
				
				$tuteur = new Enseignant($apprenti->id_ens);
				$tuteur->set_detail();  
				
				$declaration = $apprenti->get_declaration($_GET["id_per"], $_GET["type_suivi"]);
				
				$rl = new Representant_legal($apprenti->id_rl);
				$rl->set_detail();
		?>
		<tr>
			<td >
				<?php echo $apprenti->nom."&nbsp;".$apprenti->prenom; ?> 
			</td>
			<td width="25px">
				<?php if($declaration->est_signee($apprenti->id_app)) {?>
					<img src="<?php echo $URL_THEME; ?>images/ico_valider.png" title="sign&eacute;">
				<?php }elseif($declaration->id_dec > 0) {?>
					<img src="<?php echo $URL_THEME; ?>images/picto_edit.png" title="en cours">
				<?php }else {?>
					<img src="<?php echo $URL_THEME; ?>images/picto_drop.png" title="pas sign&eacute;">
				<?php } ?>
			</td>
			<td >
				<?php echo $tuteur->nom."&nbsp;".$tuteur->prenom; ?> 
			</td>
			<td width="25px">
				<?php if($declaration->est_signee($tuteur->id_ens) ) {?>
					<img src="<?php echo $URL_THEME; ?>images/ico_valider.png" title="sign&eacute;">
				<?php }elseif($declaration->id_dec > 0) {?>
					<img src="<?php echo $URL_THEME; ?>images/picto_edit.png" title="en cours">
				<?php }else {?>
					<img src="<?php echo $URL_THEME; ?>images/picto_drop.png" title="pas sign&eacute;">
				<?php } ?>
			</td>
			
			
			<td >
				<?php echo $ma->nom."&nbsp;".$ma->prenom; ?> 
			</td>
			<td width="25px">
				<?php if($declaration->est_signee($ma->id_ma) ) {?>
					<img src="<?php echo $URL_THEME; ?>images/ico_valider.png" title="sign&eacute;">
				<?php }elseif($declaration->id_dec > 0) {?>
					<img src="<?php echo $URL_THEME; ?>images/picto_edit.png" title="en cours">
				<?php }else {?>
					<img src="<?php echo $URL_THEME; ?>images/picto_drop.png" title="pas sign&eacute;">
				<?php } ?>
			</td>
			
			<td >
				<?php echo $rl->nom."&nbsp;".$rl->prenom; ?> 
			</td>
			<td width="25px">
			<?php if ($rl->id_rl > 0) { ?>
				<?php if ($declaration->est_signee($rl->id_rl) ) {?>
					<img src="<?php echo $URL_THEME; ?>images/ico_valider.png" title="sign&eacute;">
				<?php }elseif($declaration->id_dec > 0) {?>
					<img src="<?php echo $URL_THEME; ?>images/picto_edit.png" title="en cours">
				<?php }else {?>
					<img src="<?php echo $URL_THEME; ?>images/picto_drop.png" title="pas sign&eacute;">
				<?php } ?>
			<?php } ?>
			</td>
			
		</tr>
		<?php } ?>	
	</table>
	<?php } ?>
	<a name="baspageimp">&nbsp;</a>
	<script language="javascript" type="text/javascript">
		var doc = document.location.href.split("#");
		window.location.replace(doc[0] + "#baspageimp");
	</script>
</div>