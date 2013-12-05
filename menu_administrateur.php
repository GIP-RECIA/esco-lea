<?php
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
  if(!isset($_REQUEST['imprimer'])) { ?>

		<div id="header">
		<div id="session">
			 <?php 
				$nom_admin=$_SESSION['nom_admin'];
				$prenom_admin=$_SESSION['prenom_admin'];
				echo  "Bonjour <strong>".$prenom_admin."&nbsp;".$nom_admin."</strong>"; 
			?>
    	   <br>
			 <?php if (!$AUTHENTIFICATION_CAS) {?>
   	   		 <a href="<?php echo($LEA_URL.'fermer_session.php') ?>">
			 <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_quitter.gif');?>" border="0">
			 D&eacute;connexion
			 </a>
			 <?php }?>
		</div>
			<?php include($LEA_REP."header.php")?>
		</div>	
		<div id="menu">
			<ul>
				<li id="menu1" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/accueil.php'); ?>">Accueil</a></li>
			<!-- <li id="menu10" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/module_xml.php'); ?>">Paramétrage ext.</a></li>  -->	
				<li id="menu2" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/options/terminologie.php'); ?>">Paramétrage int.</a></li>
				<li id="menu3" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/gest_usag/gest_usag.php?cmd=cons_liste_app'); ?>">Gestion des Usagers</a></li>
				<?php if($_SESSION['unite']=="true") {?>
					<li id="menu4" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> 
						<a href="<?php echo($LEA_URL.'administrateur/gest_unite/gest_unite.php?cmd=cons_unite'); ?>"><?php echo($config_term->terminologie_unit_pedag); ?></a>
					</li> 
				<?php } ?>
				<li id="menu5" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/gest_entr/gest_entr.php'); ?>">Gestion des <?php echo($config_term->terminologie_entr); ?>s</a></li>
				<li id="menu6" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/contact/contact.php?cmd=cons_msg'); ?>">Messagerie</a></li>
				<?php if (!$AUTHENTIFICATION_CAS) {?>
				<li id="menu7" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/options/options.php?cmd=modif_options'); ?>">Charte graphique</a></li>
				<li id="menu8" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/import/import.php'); ?>">Importation</a></li>
				<?php }?>
				<?php if ($LDAP_IMPORT) {?>
				<li id="menu81" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/import/importLdap.php'); ?>">Importation LDAP</a></li>
				<?php }?>
				<?php if (!$AUTHENTIFICATION_CAS) {?>
				<li id="menu9" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'administrateur/affich_mdp.php?cmd=affich'); ?>">Affichage des login/pass</a></li>
				<?php }?>
			</ul>
		</div>	
<?php 
}else {
	$img = $LEA_URL."images/print.gif";	
	echo "<a href='#' onClick='window.print()'> <img src='$img' border='0'>Imprimer</a>&nbsp&nbsp&nbsp&nbsp&nbsp";
	afficher_boutton_fermer();
}
?>	
