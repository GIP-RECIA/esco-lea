<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Formulaire de modifier les options de LEA
  //          
/***********************************************************/
include_once("../secure.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
/***********************************************************/	

$themes = array();

$rep = opendir($LEA_REP.'themes');

while ($file = readdir($rep)){ 
	if($file != '..' && $file !='.' && $file !=''){ 		
			$themes[] = $file;
	}
}

closedir($rep);


 ?>	
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">M</span>odifier la charte graphique</h1>
</div>
<div id="top_r"></div>

<div id="m_contenu"> 
 <p>Veuillez attacher des fichiers au format JPG, JPEG, PNG, GIF ou BMP </p>
 <form action='modif_options_v.php' method='post' enctype="multipart/form-data" name='theForm'
		onSubmit=" return confirm('Êtes-vous sûr de vouloir modifier votre logo')"
		>
   <table width="94%" height="128" border="0" cellspacing="0">
     <tr> 
      <th height="21" colspan="2" >Logo du <?php echo($config_term->terminologie_cfa); ?> (taille maxi 100px*100px) :</th>
     </tr>
     <tr>
       <td width="25%" rowspan="2" align="center"> <img src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($_SESSION['options_lea']['LEA_LOGO_CFA'])) ?>" class="imggrand"> </td>
       <td width="75%" align="right">
       	<input type="button" onclick="window.open('selection_img.php?type_img=LEA_LOGO_CFA','','width=800, height=600, scrollbars=yes, resizable=yes')" value="Parcourir la biblioth&egrave;que de logos" />
       	<br /><br /><input type="file" name="LEA_LOGO_CFA">
       </td>
     </tr>
     <tr class="cellule">
       <td width="75%" height="17" align="right">
         <input type="submit" name="Submit" value="Valider"> 
       </td>
     </tr>
   </table>
 </form>
 <form action='modif_options_v.php' method='post' enctype="multipart/form-data" name='theForm'
				onSubmit="return confirm('Êtes-vous sûr de vouloir modifier votre arrière-plan')"
				>
   <table width="94%" height="128" border="0" cellspacing="0">
     <tr> 
      <th height="21" colspan="2">Bandeau (taille maxi 950px*130px) :</th>
     </tr>
     <tr>
       <td width="25%" rowspan="2" align="center"> <img src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($_SESSION['options_lea']['LEA_BACKGROUND_HEAD'])) ?>" class="imggrand"> </td>
       <td width="75%" align="right">
       <input type="button" onclick="window.open('selection_img.php?type_img=LEA_BACKGROUND_HEAD','','width=800, height=600, scrollbars=yes, resizable=yes')" value="Parcourir la biblioth&egrave;que de bandeaux" />
       <br /><br /><input type="file" name="LEA_BACKGROUND_HEAD">
       </td>
     </tr>
     <tr class="cellule">
       <td width="75%" height="34" align="right">
       	<input type="submit" name="Submit22" value="Valider">
       </td>
     </tr>
   </table>
 </form>
 <form action='modif_options_v.php' method='post' enctype="multipart/form-data" name='theForm'
				onSubmit="return confirm('&ecirc;tre-vous sur de vouloir modifier votre theme')"
				>
   <table width="94%" height="103" border="0" cellspacing="0">
     <tr>
       <th height="21" colspan="2">THEME</th>
     </tr>
     <tr>
       <td width="25%" rowspan="2" align="center">Th&egrave;me</td>
       <td width="75%" align="right">
         <?php 
	   echo'<select name="THEME">';
		   foreach($themes as $theme){ 
		   		if($theme == $_SESSION['options_lea']['LEA_THEME']) $selected='selected';
				else $selected='';
				
	   			echo('<option value="'.$theme.'"'.$selected.' >'.$theme.'</option>');
		   }
	   echo'</select>';
	   ?>
       </td>
     </tr>
     <tr class="cellule">
       <td width="75%" height="34" align="right"><input type="submit" name="Submit222" value="Valider">
       </td>
     </tr>
   </table>
 </form>
 <table width="94%" height="103" border="0" cellspacing="0">
   <tr>
     <th height="21">Mise &agrave; jour de biblioth&egrave;ques d'images</th>
   </tr>
   <tr>
     <td width="75%"> <p><a href="#" onclick="window.open('maj_img.php?type_img=bandeau','','width=800, height=600, scrollbars=yes, resizable=yes')">Biblioth&egrave;que 
           des bandeaux</a> </p>
       <p><a href="#" onclick="window.open('maj_img.php?type_img=logo','','width=800, height=600, scrollbars=yes, resizable=yes')">Biblioth&egrave;que des
           logos</a></p>
       <p> <a href="#" onclick="window.open('maj_img.php?type_img=img_accueil','','width=800, height=600, scrollbars=yes, resizable=yes')">Biblioth&egrave;que 
           des images d'accueil</a></p>
       <p>&nbsp;</p>       <p>&nbsp;</p></td>
   </tr>
 </table>
 <p>&nbsp;</p>
</div>