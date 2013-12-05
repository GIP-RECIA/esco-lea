
<?php  
include_once('../secure.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><!-- InstanceBegin template="/templates/Menseignant.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>		
		<!-- InstanceBeginEditable name="doctitle" -->
<title>LEA Enseignant</title>
<!-- InstanceEndEditable -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<!-- #BeginEditable "Meta" -->
<meta name="special" content="" />
<!-- #EndEditable -->
		<link rel="stylesheet" type="text/css" href="<?php echo($URL_THEME.'/enseignant.css'); ?>" media="screen" />
		<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
				<script type="text/javascript" src="/javascript/menu.js"></script>
	</head>
<body>

<div id="conteneur">

		
		<div id="header">
		<div id="session">
	
       	    <?php 				
				$nom_ens=$_SESSION['nom_ens'];
				$prenom_ens=$_SESSION['prenom_ens'];
				echo "Bonjour ".$prenom_ens."&nbsp;".$nom_ens;
				echo "Formation : ".$_SESSION['nom_formation'];
				if (!$AUTHENTIFICATION_CAS) {
					echo '<a href="'.$LEA_URL.'fermer_session.php">D&eacute;connexion</a>';	
				} 
			?>
   	   		 
		</div>
			<?php include($LEA_REP."header.php")?>
				
		</div>		 
			
	
		<div id="menu">
			<ul>
				<li id="menu1" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" onclick="location='<?php echo($LEA_URL.'Enseignant/accueil.php') ?>'"><a href="<?php echo($LEA_URL.'Enseignant/accueil.php') ?>">Accueil</a></li>
				<li id="menu2" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" onclick="location='<?php echo($LEA_URL.'Enseignant/Apprentis/apprentis.php?cmd=cons_liste_app') ?>'"><a href="<?php echo($LEA_URL.'Enseignant/Apprentis/apprentis.php?cmd=cons_liste_app') ?>">Suivi des apprentis</a></li>
				<li id="menu3" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" onclick="location='<?php echo($LEA_URL.'Enseignant/Info_perso/info_perso.php?cmd=cons_coordonnee') ?>'"><a href="<?php echo($LEA_URL.'Enseignant/Info_perso/info_perso.php?cmd=cons_coordonnee') ?>">Info perso</a></li>
				<li id="menu4" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" onclick="location='<?php echo($LEA_URL.'Enseignant/Contact/contact.php') ?>'"><a href="<?php echo($LEA_URL.'Enseignant/Contact/contact.php') ?>">Contact</a></li>
				<?php 
					$enseignant = new Enseignant($_SESSION['id_ens']);
					$est_responsable = $enseignant->est_responsable($_SESSION['id_for']);
					if( $est_responsable ) {				
				?>
				<li id="menu5" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" onclick="location='<?php echo($LEA_URL.'Enseignant/Options/options.php?cmd=cons_options') ?>"><a href="<?php echo($LEA_URL.'Enseignant/Options/options.php?cmd=cons_options') ?>">Configuration LEA</a></li>
				
				<?php 
				}
				?>
				
				<li id="menu6" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" onclick="javascript:montre();"><a href="<?php echo($LEA_URL.'espace_de_partage/consult_espace.php')?>" onclick="window.open(this.href, 'exemple', 'height=700, width=993, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=yes, status=no'); return false;">Espace de partage</a></li>
				</ul>
		</div>		
		
		<div id="contenu">
    		<div id="contents">			
   		<!-- InstanceBeginEditable name="sous_menu" -->
		<script language="JavaScript" type="text/javascript" src="../../javascript/stdlib.js">
	    </script>
      <?php                                      
		include("sous_menu.php");
		
		if (isset($_REQUEST['cmd'])) $cmd=$_REQUEST['cmd'];
		else 						 $cmd="";			
		
		switch ($cmd) {
		
		case "cons_cours": afficher_sous_menu("cons_cours");
							include('vos_cours.php'); 
							  break;
		case "cons_mat": 	afficher_sous_menu("cons_mat");
							include('cons_mat.php'); 
							  break;					  
		case "cons_mat_det":  afficher_sous_menu("cons_mat");
							  include('cons_mat_det.php'); 
							  break;
		case "nouv_mat":     afficher_sous_menu("cons_mat");
							 include('../../Admin_unite/Gest_mat/nouv_mat.php'); 
							  break;					  
		case "cons_mod_tach":  afficher_sous_menu("cons_mod_tach");
							  include('cons_mod_tach.php'); 
							  break;
		case "cons_chap":   afficher_sous_menu("cons_mat");
							include('cons_chap.php'); 
							  break;
		case "cons_chapitres_vus_cours": include('cons_chapitres_vus_cours.php'); 
							  break;					  					  						
							  					  							  					  					  					  					  					  	
		default             : 
							  break;					  	        		
		
		}
		
		?>

      <!-- InstanceEndEditable --> 
		</div>
				  <div id="bottom_box"> </div>   
		</div>	
	
		<div id="footer">
			<?php include($LEA_REP."footer.php")?>
		</div>
	
	</div>
	
</div>

</body>
<!-- InstanceEnd --></html>
