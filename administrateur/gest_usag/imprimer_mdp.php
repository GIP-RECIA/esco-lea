<?php
/***********************************************************/
  // Copyright © 2005-2006 
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
require_once($LEA_REP."modele/bdd/classe_classe.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();


/***********************************************************/

if (isset($_REQUEST['id_cla'])) $id_cla_select=$_REQUEST['id_cla'];
else exit();


	$classe_select= new Classe($id_cla_select);
	$classe_select->set_detail();
	$les_id_apprentis = $classe_select->get_id_apprentis(); // les identifiant des apprentis affectés à cette classe
	
	if(isset($_SESSION['id_admin']));
	elseif(isset($_SESSION['id_rvs']) ){	
		$unite = new Unite_pedagogique($_SESSION['id_unite']);
		$les_id_formation = $unite->get_id_formations();
	
		if(! in_array ($classe_select->id_for, $les_id_formation) ) exit(); 
	
	}
	else exit();	 	
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

<div id="contenu">

<p>  
	<?php afficher_boutton_retour(); ?>&nbsp;&nbsp;&nbsp;
	<a href="#" onClick="window.print()">Imprimer</a>

</p>

<h1>
Liste des <?php echo($config_term->terminologie_app); ?> de la <?php echo($config_term->terminologie_classe); ?> <?php echo "$classe_select->libelle" ?></h1>

<?php	if (count($les_id_apprentis) > 0) { ?>
			
  <table width="80%">
                <tr bgcolor="#57bf37" >
                  <td width="29%" >Nom</td>
                  <td width="24%" >Pr&eacute;nom</td>
                  <td width="21%" >Login </td>
                  <td width="26%" >Mot de passe</td>
                </tr>
                <tr>
                  <td colspan="4" >&nbsp;</td>
                </tr>
                <?php
					
					$bgcolor='';
					foreach($les_id_apprentis as $id_app){
					$apprenti = new Apprenti($id_app);
					$apprenti->set_detail();																										
					
					if($bgcolor=='') $bgcolor="#99CCFF";
					else $bgcolor='';
																
					echo "<tr bgcolor='$bgcolor'>
						  <td width='26%'><p >$apprenti->nom </p></td>
		                  <td width='22%'><p >$apprenti->prenom </p></td>
						  <td width='24%'>$apprenti->login</td>
        		          <td width='24%' >$apprenti->mdp</td>
						  </tr>";	
									
					}
				?> 
         		<tr align="center">
         		  <td colspan="4" >&nbsp;</td>
       		  </tr>
  </table>
<?php 
     }else echo" Aucun ".$config_term->terminologie_app." n'est affecté à cette classe";
	 				
?>

</div>
        
</body>
</html>		  