<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: 
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_periode.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
include("../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$les_classes = $formation->get_classes();
$config_lea = $formation->get_config_lea(); 

if(isset($_REQUEST['id_periode']) && $_REQUEST['id_periode'] > 0) {
		$id_periode = $_REQUEST['id_periode'];
		$periode = new Periode($id_periode);
		$periode->set_detail();
		$titre_page = "Modifier la  p&eacute;riode";
}		
else {
	$id_periode = 0;
	$periode = new Periode($id_periode);
	
	if(isset($_REQUEST['rang_max'])) 
		  $periode->rang = $_REQUEST['rang_max'] +1; 
	else  $periode->rang = 1;	
	
	$periode->id_for = $_SESSION['id_for']; 	
	$titre_page = "Cr&eacute;er une nouvelle p&eacute;riode";
}	

$les_id_classes = $periode->get_id_classes(); // les identifiant des classes devront dï¿½clarer cette pï¿½riode.



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>LEA: M&agrave;j des p&eacute;riodes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>"  />



<script language="JavaScript" src="../../javascript/stdlib.js"></script>		


<script language="JavaScript">

function controleSaisie(theForm){   
		    
   if(testVide(theForm.libelle, "libell&eacute; de la p&eacute;riode ")== false) return false;
   if(testNumeric(theForm.rang, "rang de la p&eacute;riode ")== false) return false;           

   if(!theForm.suivi_cfa.checked && !theForm.suivi_entr.checked){
   		alert("La p&eacute;riode doit &egrave;tre appliqu&eacute;e &agrave; l'un des suivis cfa ou entreprise");
		return false;		
   } 
	return true;
}

</script>		


</head>

<body>
<div id="contenu" style="width:550px;">
    		<div id="contents" >
<form name="theForm" method="post" action="maj_periode_v.php" onSubmit="return controleSaisie(this); ">

		   <input type="hidden" name="action" 
		   value="<?php if($id_periode > 0) echo"modif"; else echo"nouv";  ?>"
		   >
		   <input type="hidden" name="id_periode" 
		   value="<?php echo"$id_periode" ?>"
		   >
		   <input type="hidden" name="id_for" 
		   value="<?php echo"$periode->id_for" ?>"
		   >
             <table width="100%" height="505" border="0" cellspacing="0">
               <tr>
                 <th height="20" colspan="3">
                   <?php echo"$titre_page  " ?>
                 </th>
               </tr>
               <tr>
                 <td width="37%">Libell&eacute; de la p&eacute;riode</td>
                 <td height="54" colspan="2">
                   <input name="libelle" type="text" size="40"
				   value="<?php echo(to_html($periode->libelle)) ?>">
                   <br>
                 Exemple: p&eacute;riode1, groupement1, d&eacute;claration 1&eacute;re ann&eacute;e:mois de juin, .......                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                	</td>
               </tr>
               <tr>
                 <td>Rang</td>
                 <td height="54" colspan="2">
				 
				 <input name="rang" type="text" size="4"
				   value="<?php echo(to_html($periode->rang)) ?>"> 
				Tapez un nombre superieur  &agrave; 0</td>
               </tr>
               <tr class="titre">
                 <td height="21" colspan="3">Cette
                   p&eacute;riode concerne
				   </td>
               </tr>
               <tr>
                 <td height="38" colspan="3">
				 <input name="suivi_cfa" type="checkbox" value="1" <?php if($periode->suivi_cfa) echo"checked" ?> >                   
                   <?php echo $config_lea->appelation_suivi_cfa; ?> 
                     <?php
$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_suivi from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
		$suivi="false";
		}else{
		$suivi="true";
		}
if($suivi!="false"){
?>
<input name="suivi_entr" type="checkbox" value="1" <?php if($periode->suivi_entr) echo"checked" ?>>
                 <?php echo $config_lea->appelation_suivi_entr; ?><?php } ?></td>
               </tr>
               <tr class="titre">
                 <td height="21" colspan="3">Vous autorisez les usagers suivants &agrave; consulter cette p&eacute;riode
				   </td>
               </tr>
               <tr>
                 <td height="54" colspan="3"><p>
      <input name="consult_app" type="checkbox" id="consult_app" value="1" <?php if($periode->consult_app) echo"checked" ?> >
  <?php echo"$config_lea->appelation_app" ?></p>
                 <p>
                   <input name="consult_ma" type="checkbox" id="consult_ma" value="1" <?php if($periode->consult_ma) echo"checked" ?> >
<?php echo"$config_lea->appelation_ma" ?></p>
                 <p>
                   <input name="consult_tuteur_cfa" type="checkbox" id="consult_tuteur_cfa" value="1" <?php if($periode->consult_tuteur_cfa) echo"checked" ?> >
<?php echo"$config_lea->appelation_tuteur_cfa" ?></p>
                 <p>
                   <input name="consult_ens" type="checkbox" id="consult_ens" value="1" <?php if($periode->consult_ens) echo"checked" ?> >
<?php echo $config_lea->appelation_ens; ?></p>
                 
                    <?php
$id_for = $_SESSION['id_for'];
		require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
		$bdd=new Connexion_BDD_LEA();
		$sql="select id_for_without_parent from les_droits_formations where id_for_without_suivi='$id_for'";
		$res=$bdd->executer($sql);
		if(mysql_num_rows($res)==1){
		$suivi="false";
		}else{
		$suivi="true";
		}
if($suivi!="false"){ ?> <p>
                   <input name="consult_rl" type="checkbox" id="consult_rl" value="1" <?php if($periode->consult_rl) echo"checked" ?> >
<?php echo $config_lea->appelation_rl; ?> </p> <?php  }   ?></td>
               </tr>
               <tr class="titre">
                 <td height="21" colspan="3">Cette p&eacute;riode s'applique à  </td>
               </tr>
               <tr>
                 <td height="54" colspan="3">
				 
				   <?php
		   if (count($les_classes) >  0){
		   						
				   foreach($les_classes as $classe){
				   if(in_array($classe->id_cla, $les_id_classes))
				    	$checked = "checked";
				   else $checked = "";
				   	 
					  echo"
					 
					  <input type='checkbox' name='les_id_cla[]' value='$classe->id_cla' $checked > $classe->libelle
					  <br>
					  ";
				   
				    }				
				
			   }
			   else afficher_msg_erreur("Aucune ".$config_lea->appelation_classe." n'est cr&eacute;&eacute;");
		   		   
		   
			   ?>
				 </td>
               </tr>
               <tr>
                 <td height="23" colspan="3" class="center"><input type="submit" name="Submit" value="Valider">
                 </td>
               </tr>
              
  </table>
</form>
		<div>
	</div>

</body>
</html>
