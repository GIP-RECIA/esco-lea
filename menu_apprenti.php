<?php  
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
if(!isset($_REQUEST['imprimer'])) { ?>

	<div id="header">
		<div id="session">
              <?php 
				$civilite_app=$_SESSION['civilite_app'];
				$nom_app = $_SESSION['nom_app'];
				$prenom_app = $_SESSION['prenom_app'];
				echo  "Bonjour <strong>".$prenom_app."&nbsp;".$nom_app.", </strong>" ; 
				
				echo "&nbsp; &nbsp; Formation : <strong>".$_SESSION['nom_formation']."</strong>"; 

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
				<li id="menu1" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"  ><a href="<?php echo($LEA_URL.'Apprenti/accueil.php'); ?>"> Accueil</a></li>
				<li id="menu2" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" ><a href="<?php echo($LEA_URL.'Apprenti/Livret/livret.php') ?>"> Votre suivi</a></li>
				<li id="menu3" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" ><a href="<?php echo($LEA_URL.'Apprenti/info_perso/info_perso.php') ?>">Profil</a></li>
				<li id="menu4" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" ><a href="<?php echo($LEA_URL.'Apprenti/Contact/contact.php') ?>">Messagerie</a></li>
				<li id="menu5" class="onglet" onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" ><a href="<?php echo($LEA_URL.'Apprenti/gest_doc/gest_doc.php'); ?>">Documents</a></li>
				
				<li id="menu6" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" onclick="javascript:montre();"><a href="<?php echo($LEA_URL.'espace_de_partage/consult_espace.php') ?>" >Espace de partage</a></li>
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