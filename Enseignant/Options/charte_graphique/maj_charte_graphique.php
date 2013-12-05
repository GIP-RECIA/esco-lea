<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Formulaire pour mettre ï¿½ jour la charte graphique de la formation stockï¿½e en session
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
/***********************************************************/	
include("../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
 ?>		
<div id="top_l"></div><div id="top_m">
	<h1><span class="orange">C</span>harte graphique</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<p>
		Veuillez attacher UNIQUEMENT des fichiers aux formats JPG, JPEG, PNG, GIF ou BMP
	</p>
	<form action="./charte_graphique/maj_charte_graphique_v.php" method="post" enctype="multipart/form-data" name="theForm">
		<table width="94%" height="128" border="0" cellspacing="0">
        	<tr>
            	<th height="21" colspan="2" >
            		Logo de la formation (taille maxi 100px*100px) :
        		</th>
            </tr>
            <tr>
            	<td width="25%" rowspan="2" align="center"> 
            		<img class="imggrand" src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($_SESSION['options_lea']['LEA_LOGO_FORMATION'])) ?>" /> 
            	</td>
                <td width="75%" >
                	<input type="button" onClick="window.open('charte_graphique/selection_img.php?type_img=logo','','width=800, height=600, scrollbars=yes, resizable=yes')" value="Parcourir la biblioth&egrave;que de logos" /> 
                	<br><br>
                	Choisissez l'un de vos logos:<br>
                	<input type="file" name="logo" /><br>
                    <input type="checkbox" name="ajout_bib" value="1"> 
				 		Mettre le fichier joint dans la biblioth&egrave;que d'images
				</td>
            </tr>
            <tr>
               	<td width="75%" height="17" align="right">
                	<input type="submit" name="Submit3" value="Valider">
				</td>
			</tr>
		</table>
    </form>
	<form action="./charte_graphique/maj_charte_graphique_v.php" method="post" enctype="multipart/form-data" name="theForm">
		<table width="94%" height="128" border="0" cellspacing="0">
        	<tr>
              	<th height="21" colspan="2" >
			  		Bandeau (taille maxi 950px*130px) :
              	</th>
            </tr>
            <tr>
              	<td width="25%" rowspan="2" align="center"> <img class="imggrand" src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($_SESSION['options_lea']['LEA_BACKGROUND_HEAD'])) ?>" /> </td>
              	<td width="75%" >
              		<input type="button" onclick="window.open('charte_graphique/selection_img.php?type_img=bandeau','','width=800, height=600, scrollbars=yes, resizable=yes')" value="Parcourir la biblioth&egrave;que de bandeaux" /> 
                	<br><br>Choisissez l'un de vos bandeaux:<br>
			  		<input type="file" name="bandeau" />
					<br>
					<input type="checkbox" name="ajout_bib" value="1"> 
			 			Mettre le fichier joint dans la biblioth&egrave;que d'images</td>
            </tr>
            <tr>
              	<td width="75%" height="17" align="right">
                	<input type="submit" name="Submit322" value="Valider">
              	</td>
            </tr>
		</table>
	</form>
	<form action="./charte_graphique/maj_charte_graphique_v.php" method="post" enctype="multipart/form-data" name="theForm">
		<table width="94%" height="128" border="0" cellspacing="0">
        	<tr>
              	<th height="21" colspan="2" >
                	Logo de votre CFA (taille maxi 100px*100px) :
                </th>
           	</tr>
            <tr>
				<td width="25%" rowspan="2" align="center"> 
					<img class="imggrand" src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($_SESSION['options_lea']['LEA_LOGO_CFA'])) ?>" /> 
				</td>
				<td width="75%" >
					<input type="button" onclick="window.open('charte_graphique/selection_img.php?type_img=logo_cfa','','width=800, height=600, scrollbars=yes, resizable=yes')" value="Parcourir la biblioth&egrave;que de logos" /> 
                	<br><br>Choisissez l'un de vos logos:<br>
					<input type="file" name="logo_cfa" />
					<br>
					<input type="checkbox" name="ajout_bib" value="1"> 
					 	Mettre le fichier joint dans la biblioth&egrave;que d'images</td>
            </tr>
            <tr>
             	<td width="75%" height="17" align="right">
                 	<input type="submit" name="Submit2" value="Valider" />
                </td>
           	</tr>
		</table>
  	</form>
	<form action="./charte_graphique/maj_charte_graphique_v.php" method="post" enctype="multipart/form-data" name="theForm">
       	<table width="94%" height="128" border="0" cellspacing="0">
         	<tr>
             	<th height="21" colspan="2" >Image d'accueil :</th>
            </tr>
            <tr>
              	<td width="25%" rowspan="2" align="center"> 
              		<img class="imggrand" src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($_SESSION['options_lea']['LEA_IMAGE_ACCUEIL'])) ?>" /> 
              	</td>
                <td width="75%" >
                <input type="button" onclick="window.open('charte_graphique/selection_img.php?type_img=img_accueil','','width=800, height=600, scrollbars=yes, resizable=yes')" value="Parcourir la biblioth&egrave;que d'images d'accueil" /> 
                	<br><br>Choisissez l'une de vos images d'accueil:<br>
				  	<input type="file" name="img_accueil" />
				  	<br>
					<input type="checkbox" name="ajout_bib" value="1"> 
						Mettre le fichier joint dans la biblioth&egrave;que d'images</td>
          	</tr>
            <tr class="cellule">
              	<td width="75%" height="17" align="right">
                	<input type="submit" name="Submit32" value="Valider">
               	</td>
            </tr>
    	</table>
  	</form>
	<form action='./charte_graphique/maj_charte_graphique_v.php' method='post' enctype="multipart/form-data" name='theForm'
				onSubmit="return confirm('&ecirc;tes-vous sur de vouloir modifier votre th&egrave;me')"
				>
              <table width="94%" height="103" border="0" cellspacing="0">
                <tr>
                  <th height="21" colspan="2">THEME</th>
                </tr>
                <tr>
                  <td width="25%" rowspan="2" align="center">Th&egrave;me</td>
                  <td width="75%" >
       <?php 
	   $themes = array();

		$rep = opendir($LEA_REP.'themes');

		while ($file = readdir($rep)){ 
			if($file != '..' && $file !='.' && $file !=''){ 		
				$themes[] = $file;
			}
		}

		closedir($rep);
		
	   echo'<select name="theme">';
		   foreach($themes as $theme){ 
		   		if($theme == $_SESSION['options_lea']['LEA_THEME']) $selected = 'selected';
				else $selected='';
				
	   			echo('<option value="'.$theme.'"'.$selected.' >'.$theme.'</option>');
		   }
	   echo'</select>';
	   ?>
                  </td>
                </tr>
                <tr>
                  <td width="75%" height="34" align="right"><input type="submit" name="Submit222" value="Valider">
                  </td>
                </tr>
              </table>
  </form>
</div>				