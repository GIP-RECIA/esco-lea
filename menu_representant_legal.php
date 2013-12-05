<?php  
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
if(!isset($_REQUEST['imprimer'])) { ?>
<div id="header">
		<div id="session">
			<?php				
				$nom_rl = $_SESSION['nom_rl'];
				$prenom_rl = $_SESSION['prenom_rl'];
				echo  "Bonjour <strong>".$prenom_rl."&nbsp;".$nom_rl."</strong>"; 
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
		<li id="menu1" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Representant_legal/accueil.php')?>" >Accueil</a>
		</li>
		<li id="menu2" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Representant_legal/Apprentis/apprentis.php')?>" >Suivi de vos <?php echo($config_term->terminologie_app); ?>s</a>
		</li>
		<li id="menu3" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Representant_legal/Info_perso/info_perso.php')?>" >Profil</a>
		</li>    
        <li id="menu4" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Representant_legal/Contact/contact.php')?>" >Messagerie</a>
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