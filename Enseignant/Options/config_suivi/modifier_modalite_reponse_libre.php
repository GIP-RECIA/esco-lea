<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la mise  ï¿½ jour du modele  de tï¿½che 
/***********************************************************/
require_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_modalite_reponse_libre.php");
require_once ($LEA_REP."modele/bdd/classe_modalite_reponse_choix.php");
require_once ($LEA_REP."modele/bdd/classe_choix_reponse.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if( isset($_REQUEST['id_modalite'])) { 

	$modalite = new modalite_reponse_libre($_REQUEST['id_modalite']);
	$modalite->set_detail();
	$type_suivi = $modalite->type_suivi;
	$les_id_periode = $modalite->get_id_periodes();
	
	$les_periodes = $formation->get_periodes($type_suivi);
	
}else exit();

?>		

<html>
<head>
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>" />

<title>LEA : Modalit&eacute;</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="../../../javascript/stdlib.js">

</script>		
<script language="JavaScript">

function controleSaisie(theForm){   
		          
   if(testVide(theForm.libelle, "intitul&eacute; de la modalit&eacute; ")== false) return false;                   
        
   return true;
}

</script>		
</head>
<body>

<div id="contenu">
				<div id="top_l"></div><div id="top_m"><h1>
  <?php
			if ($type_suivi == "entr") {
					
			    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				echo"Modifier modalit&eacute; de saisie ";
			}
			else {
			 echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			 echo"Modifier modalit&eacute; de saisie ";
			}
			?>
  </h1></div><div id="top_r"></div>
			<div id="m_contenu">

  
   <p> <?php afficher_boutton_fermer(); ?> </p>
   <form action="modifier_modalite_reponse_libre_v.php" method="post" onSubmit="return controleSaisie(this)">
     <input type="hidden" name="id_modalite" value="<?php echo"$modalite->id_modalite" ?>">
     <input type="hidden" name="action" value="modif">
     <table width="99%" height="169" border="0">
       <tr>
         <td width="43%" height="31" class="sous_titre_tableau">L'intitul&eacute; de
           la modalit&eacute;</td>
         <td width="57%" class="cellule">
           <input name="libelle" type="text" size="60"
		value= "<?php echo($modalite->libelle); ?>" 
		>
         </td>
       </tr>
       <tr>
         <td height="32" class="sous_titre_tableau">Modalit&eacute; se valide
           par</td>
         <td class="cellule"><?php
						$array_values = array(											 
							 'app'		  => strtoupper($config_lea->appelation_app), 
							 'tuteur_cfa' => strtoupper($config_lea->appelation_tuteur_cfa),
							 'ma'		  => strtoupper($config_lea->appelation_ma),
							 'ens'        => strtoupper($config_lea->appelation_ens),
							 'rl'		  => strtoupper($config_lea->appelation_rl), 
							 'rf'         => strtoupper($config_lea->appelation_rf));
						$selected_value = $modalite->acteur;
						$attr ='';
						$name= 'acteur';
						
						echo liste_deroulante ( $name , $array_values , $selected_value , $attr,  $multiple = 0 , $size = 1 );
						
						?>
         </td>
       </tr>
       <tr>
         <td height="57" class="sous_titre_tableau">Modalit&eacute; se valide
           aux p&eacute;riodes suivantes</td>
         <td class="cellule">
           <select name="les_id_periode[]" multiple size="5">
             <?php

		foreach($les_periodes as $periode ){
			if(in_array($periode->id_periode, $les_id_periode) ) $selected = "selected";
			else $selected = "";
			
			echo("<option value=\"$periode->id_periode\" $selected >". to_html($periode->libelle)."</option>");		
		}
		?>
           </select>
           <p>Appuyer sur la touche CTRL pour s&eacute;lectionner plusieurs p&eacute;riodes</p>
         </td>
       </tr>
       <?php
		if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='champ_libre') {
	?>
       <?php
		}
		elseif(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix') {
  	   ?>
       <?php 	if($nombre > 0 ) 
				echo"<tr>
			           <td  colspan='2' class='sous_titre_tableau'>Liste des choix</td>
				      </tr>";	
			for($i = 1 ; $i <= $nombre; $i++ ) {
			echo" <tr>
        		<td  class='sous_titre_tableau'> choix $i</td>
       			<td class='cellule'>
				<input name='reponses[]' type='texte' size='60'>
		
				</td>
      		</tr>";
			}
	
	   }
	   ?>
     </table>
     
     <p>
       <input type='submit' name='Submit' value='Valider'>
         </p>
   </form>
</div>   
</div>
   </body>
</html>


