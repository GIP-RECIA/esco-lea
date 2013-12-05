<?php
/***********************************************************/
  // Copyright © 2005-2006
  // CFA des 3 villes
  // Web: www.cfa3villes.com.
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Formulaire pour modifier les options de LEA
  //
/***********************************************************/

if            (file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif        (file_exists("../config/config.inc.php"))           require_once("../config/config.inc.php");
elseif        (file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
/***********************************************************/
session_name("LEA_$RNE_ETAB");
session_start();

if (isset($_SESSION['id_admin']))   $id_usager   = $_SESSION['id_admin'];
elseif (isset($_SESSION['id_rvs'])) $id_usager = $_SESSION['id_rvs'];
elseif (isset($_SESSION['id_ens'])) $id_usager = $_SESSION['id_ens'];
elseif (isset($_SESSION['id_app'])) $id_usager = $_SESSION['id_app'];
elseif (isset($_SESSION['id_ma']))  $id_usager  = $_SESSION['id_ma'];
elseif (isset($_SESSION['id_rl']))  $id_usager  = $_SESSION['id_rl'];
else html_refresh($LEA_URL);

?>
<html>
<head>
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'commun.css');?>"/>

</head>

<body>
<div id="contenu">				
    		<div id="contents">
            <form action='modif_img_accueil_usager_v.php' method='post' enctype="multipart/form-data" name='theForm'>
              <table width="100%" height="137" border="0" cellspacing="0">
                <tr>
                  <th height="40" > 
					  Modifier l'image de la page d'accueil
				  </th>
                </tr>
                <tr>
                  <td height="17" align="center">
                    <p> Veuillez attacher un fichier image du format JPG, JPEG,
                      PNG, GIF ou BMP (Taille : 600 * 400 px)

                    </p>
                    <input type="file" name="img_accueil">
                    <p>
                      <input type="submit" name="Submit" value="Valider">
                    </p>
                  </td>
                </tr>
              </table>
            </form>

    		</div>
</div>

</body>
</html>