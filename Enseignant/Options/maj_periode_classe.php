<?php
/***********************************************************/
// Copyright © 2005-2006 
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
include($LEA_REP.'espace_de_partage/aide.php');

$formation = new Formation($_SESSION['id_for']);
$config_lea = $formation->get_config_lea();


$id_cla = 	$_REQUEST['id_cla'];
$id_periode = $_REQUEST['id_periode'];

$classe = new Classe($id_cla);
$classe->set_detail();

$periode = new Periode($id_periode);
$periode->set_detail();

$tab_dates = $periode->get_calendrier($id_cla);

$titre_page = "Modifier le calendrier";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>LEA: M&agrave;j P&eacute;riode</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css"
	href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>" />

<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>

<script language="JavaScript">

function controleSaisie(theForm, suivi_cfa, suivi_entr){   
	if(suivi_cfa==1) { 		                     
	
	   if(testDate(theForm.date_debut_cfa, "FR", "la date de debut de la période passée au CFA")== false) return false;    
	   if(testDate(theForm.date_fin_cfa, "FR" ,"la date de fin de la période  passée au CFA")== false) return false;       
	   
	  jd_cfa = theForm.date_debut_cfa.value.substring(0,2);
	  md_cfa = theForm.date_debut_cfa.value.substring(3,5);
	  ad_cfa = theForm.date_debut_cfa.value.substring(6,theForm.date_debut_cfa.value.length);
	  jf_cfa = theForm.date_fin_cfa.value.substring(0,2);
	  mf_cfa = theForm.date_fin_cfa.value.substring(3,5);
	  af_cfa = theForm.date_fin_cfa.value.substring(6,theForm.date_fin_cfa.value.length);
	  
	  
	  var date_debut_cfa = new Date(ad_cfa, md_cfa-1, jd_cfa);
	  var date_fin_cfa =  new Date(af_cfa, mf_cfa-1, jf_cfa);
	  
	  if ( date_debut_cfa.getTime() >= date_fin_cfa.getTime())  { 
	  alert(" Péridode saisie incorrecte :\nla date de début de la période passée au cfa doit être antérieure à la date de fin de la période");
	  return false;
	 }	
	
	
	}   

	if(suivi_cfa==1) { 		              
	
	   if(testDate(theForm.date_debut_entr, "FR", "la date de debut de la période passée en entreprise ")== false) return false;    
	   if(testDate(theForm.date_fin_entr, "FR" ,"la date de fin de la période  passée en entreprise")== false) return false;       
	
	    
	  jd_entr = theForm.date_debut_entr.value.substring(0,2);
	  md_entr = theForm.date_debut_entr.value.substring(3,5);
	  ad_entr = theForm.date_debut_entr.value.substring(6,theForm.date_debut_entr.value.length);
	  jf_entr = theForm.date_fin_entr.value.substring(0,2);
	  mf_entr = theForm.date_fin_entr.value.substring(3,5);
	  af_entr = theForm.date_fin_entr.value.substring(6,theForm.date_fin_entr.value.length);
	  
	
	  var date_debut_entr = new Date(ad_entr, md_entr-1, jd_entr);
	  var date_fin_entr =  new Date(af_entr, mf_entr-1, jf_entr);
	  
	  if ( date_debut_entr.getTime() >= date_fin_entr.getTime())  { 
		  alert(" Péridode saisie incorrecte : la date de début de la période passée en entreprise doit être antérieure à la date de fin de la période");
	  	return false;
	  }	

	}  

   return true;
}

</script>


</head>

<body>
<?php
// Listes des boites d'aide
// $fp_aide = fopen($LEA_URL."espace_de_partage/aide.csv","r");
for($i=0; $i<50; $i++) {
	$i_tmp = (strlen($i) == 1) ? "0".$i : $i;
	echo "
		<div id=\"aide_".$i_tmp."\" class=\"boxaide\" style=\"display:none\">
			".afficher_aide($i)."
		</div>";
}
//fclose($fp_aide);
?>

<div id="contenu" style="width: 350px;">
	<div id="contents">
	
		<form name="theForm" method="post" action="maj_periode_classe_v.php"
			onSubmit="return controleSaisie(this, <?php echo($periode->suivi_cfa) ?>, <?php echo($periode->suivi_cfa) ?>)">
		<input type="hidden" name="action"
			value="<?php if($id_periode > 0) echo"modif"; else echo"nouv";  ?>"> <input
			type="hidden" name="id_periode" value="<?php echo"$id_periode" ?>"> <input
			type="hidden" name="id_cla" value="<?php echo"$id_cla" ?>">
			<table width="100%" height="276" border="0" cellspacing="0">
				<tr>
					<th height="23" colspan="3"><?php echo"$titre_page  " ?></th>
				</tr>
				<tr>
					<td width="37%">P&eacute;riode</td>
					<td height="21" colspan="2"><?php
					echo"<b> $periode->libelle </b>";
					?></td>
				</tr>
				<tr>
					<td><?php echo $config_lea->appelation_classe; ?></td>
					<td height="21" colspan="2"><?php
					echo"<b> $classe->libelle </b>";
					?></td>
				</tr>
				<?php if($periode->suivi_cfa==1) { ?>
				<tr class="titre">
					<td height="29" colspan="3">P&eacute;riode en <?php echo $config_term->terminologie_cfa;?>
					</td>
				</tr>
				<tr>
					<td>Date de d&eacute;but</td>
					<td height="29" colspan="2"><input name="date_debut_cfa" type="text"
						value="<?php echo(trans_date($tab_dates['date_debut_cfa'])) ?>"> <?php afficher_lien_calendrier("theForm", "date_debut_cfa"); ?>
					</td>
				</tr>
				<tr>
					<td>Date de fin</td>
					<td height="35" colspan="2"><input name="date_fin_cfa" type="text"
						value="<?php echo(trans_date($tab_dates['date_fin_cfa'])) ?>"> <?php afficher_lien_calendrier("theForm", "date_fin_cfa"); ?>
					</a></td>
				</tr>
			
				<?php }
				if($periode->suivi_entr==1) {
					?>
				<tr class="titre">
					<td height="24" colspan="3">P&eacute;riode en <?php echo $config_lea->appelation_entr;?>
					</td>
				</tr>
				<tr>
					<td>Date de d&eacute;but</td>
					<td height="29" colspan="2"><input name="date_debut_entr" type="text"
						value="<?php echo(trans_date($tab_dates['date_debut_entr'])) ?>"> <?php afficher_lien_calendrier("theForm", "date_debut_entr"); ?>
					</td>
				</tr>
				<tr>
					<td>Date de fin</td>
					<td height="39" colspan="2"><input name="date_fin_entr" type="text"
						value="<?php echo(trans_date($tab_dates['date_fin_entr'])) ?>"> <?php afficher_lien_calendrier("theForm", "date_fin_entr"); ?>
					</a></td>
				</tr>
			
				<?php }?>
			
				<tr>
					<td height="23" colspan="3" class="center"><input type="submit"
						name="Submit" value="Valider"></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
