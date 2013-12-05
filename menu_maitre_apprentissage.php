<?php
require_once($LEA_REP.'modele/bdd/classe_usager.php');
if(!isset($_REQUEST['imprimer'])) { ?>
		<div id="header">
			<div id="session">
			<?php				
				$nom_ma = $_SESSION['nom_ma'];
				$prenom_ma = $_SESSION['prenom_ma'];
				echo  "Bonjour <strong>".$prenom_ma."&nbsp;".$nom_ma."</strong>"; 
//
$maitre = new Maitre_apprentissage($_SESSION['id_ma']);
$les_apprentis = $maitre->get_apprentis_form($_SESSION['id_for']);
if(isset($_REQUEST['id_app_select'])) { 
	
	$id_app_select = $_REQUEST['id_app_select'];
}
elseif(count($les_apprentis) > 0 ) $id_app_select = $les_apprentis[0]->id_app;
else $id_app_select = 0;



if($id_app_select > 0) {

	$apprenti_select = new Apprenti($id_app_select);	
	$apprenti_select->set_detail();
	$classe = $apprenti_select->get_classe();		
    $config_lea = $apprenti_select->get_config_lea();
}
//
	echo"&nbsp;&nbsp;".$config_lea->appelation_ma;		
    	    ?><br>
			 <?php if (!$AUTHENTIFICATION_CAS) {?>
   	   		 <a href="<?php echo($LEA_URL.'fermer_session.php') ?>">
			 <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_quitter.gif');?>" border="0">
			 D&eacute;connexion
			 </a>
			 &nbsp;&nbsp;								 		 
			 <?php }?>
			</div>
			<?php include($LEA_REP."header.php")?>
		</div>
		
		<div id="menu">
			<ul>
				<li id="menu1" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
					<a href="<?php echo($LEA_URL.'Maitre_apprentissage/accueil.php')?>" >
						Accueil
					</a>
				</li>
				<li id="menu2" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
					<a href="<?php echo($LEA_URL.'Maitre_apprentissage/Apprentis/apprentis.php')?>" >
						Suivi 
					</a>
				</li>
				<li id="menu3" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
					<a href="<?php echo($LEA_URL.'Maitre_apprentissage/Info_perso/info_perso.php')?>" > 
						Profil
					</a>
				</li>    
		        <li id="menu4" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
					<a href="<?php echo($LEA_URL.'Maitre_apprentissage/Contact/contact.php')?>" >
						Messagerie
					</a>
				</li>
				<li id="menu5" class="onglet" onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" >
					<a href="<?php echo($LEA_URL.'Maitre_apprentissage/gest_doc/gest_doc.php'); ?>">
						Documents
					</a>
				</li>
				<li id="menu6" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
					<a href="<?php echo($LEA_URL.'espace_de_partage/consult_espace.php') ?>" >
						Espace de partage
					</a>
				</li>
			</ul>
		</div>
<?php 
}else {
$img = $LEA_URL."images/print.gif";	
echo "<a href='#' onClick='window.print()'> 
		<img src='$img' border='0'> 
		Imprimer
		 </a>&nbsp&nbsp&nbsp&nbsp&nbsp";
	afficher_boutton_fermer();
}
?>	