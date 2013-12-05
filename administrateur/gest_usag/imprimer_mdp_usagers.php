<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 25/09/05
  // Contenu: 
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");

/***********************************************************/

$bdd = new Connexion_BDD_LEA();

if(isset($_REQUEST['profil'])) $profil = $_REQUEST['profil'];
else $profil = '';

if(isset($_REQUEST['mot_cle'])) $mot_cle = $_REQUEST['mot_cle'];
else $mot_cle ='';

$les_usagers = $bdd->get_usagers(0, 10000, $profil, $mot_cle);
$titre ='';
if($profil=='ens') $titre ='Liste des mots de passe '.$config_term->terminologie_ens;
elseif($profil=='ma') $titre ='Liste des mots de passe '.$config_term->terminologie_ma;  
elseif($profil=='rl') $titre ='Liste des mots de passe '.$config_term->terminologie_rl;  
elseif($profil=='app') $titre ='Liste des mots de passe  '.$config_term->terminologie_app;  
 ?>		

<html>
<head> 
<title>LEA Apprenti</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="">

<meta name="special" content="">
<link rel="stylesheet" type="text/css" href="<?php echo($URL_THEME.'apprenti.css');?>" media="print" />

<style>
body{
font-size:14px;
}
td{
font-size:12px;
}
</style>


</head>

<body>


<p>  
	<?php afficher_boutton_retour(); ?>&nbsp;&nbsp;&nbsp;
	 <img src='../../images/print.gif' border=0>
	<a href="#" onClick="window.print()">Imprimer</a>

</p>

<h1>
<?php echo"$titre" ?>
</h1>

<?php	if (count($les_usagers ) > 0) { ?>
			
  <table width="80%" >
                <tr bgcolor="#57bf37" >
                  <td width="21%" >Nom</td>
                  <td width="23%" >Pr&eacute;nom</td>
                  <td width="25%" >Login </td>
                  <td width="31%" >Mot de passe</td>
                </tr>
                <tr>
                  <td colspan="4" >&nbsp;</td>
                </tr>
                <?php
					
					$bgcolor='';
					foreach($les_usagers as $usager){
					
					if($bgcolor=='') $bgcolor="#99CCFF";
					else $bgcolor='';
																
					echo "<tr bgcolor='$bgcolor'>
						  <td width='26%'><p >$usager->nom </p></td>
		                  <td width='22%'><p >$usager->prenom </p></td>
						  <td width='24%'> $usager->login </td>
        		          <td width='24%' >  $usager->mdp </td>
						  </tr>";	
									
					}
				?> 
         		<tr align="center">
         		  <td colspan="4" >&nbsp;</td>
       		  </tr>
  </table>
<?php 
     }else echo" Aucun usager n'est trouvï¿½";
	 				
?>


        
</body>
</html>		  