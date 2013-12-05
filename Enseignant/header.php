<?php
require_once($LEA_REP.'modele/bdd/classe_usager.php');
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if (isset($_SESSION['id_ens'])){
	$id_usager=$_SESSION['id_ens'];
} else exit();

$usager = new Usager($id_usager);
$usager->set_detail();
$usager->update_log("Acc&eacute;s au ".$_SERVER['REQUEST_URI']);
?>
<div id="header">					
	<div id="session">
		<?php 				
			$nom_ens=$_SESSION['nom_ens'];
			$prenom_ens=$_SESSION['prenom_ens'];
			echo "Bonjour <strong>".$prenom_ens."&nbsp;".$nom_ens.",</strong> ";			
			echo $config_term->terminologie_formation." :<strong> ".$_SESSION['nom_formation']."</strong>";
			
		?>             	   		 
	</div>
	<?php 
		afficher_boutton_imprimer(); echo'&nbsp;&nbsp;&nbsp;';
	 	afficher_boutton_fermer();
		//echo'<br> <h1>Configuration </h1>' ;
	?>
</div>
