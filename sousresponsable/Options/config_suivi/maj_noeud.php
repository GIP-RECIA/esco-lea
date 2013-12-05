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


require_once ($LEA_REP."modele/bdd/classe_noeud.php");
require_once ($LEA_REP."modele/bdd/classe_modalite_va_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/

include("../../test_responsable.php");
include($LEA_REP.'espace_de_partage/aide.php');

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];

$config_lea = $formation->get_config_lea();


$id_noeud = $_REQUEST['id_noeud'] ;
$id_arbre = $_REQUEST['id_arbre'] ;

$arbre = new Arbre($id_arbre);
$arbre->set_detail();

$libelle_feuille = $arbre->get_libelle_feuille();

$noeud = new Noeud($id_noeud, $id_arbre);
$noeud->set_detail();
$noeud->niveau = $noeud->get_niveau(); 

$libelle_niveau = $arbre->get_libelle_niveau($noeud->niveau);

$nb_niveau = $arbre->get_nb_niveaux();

$src_img_feuille =  $URL_THEME."images/picto_feuille.png";



function evaluation_modalite($modalite){
		
		global $LEA_URL;
		global $id_noeud;
		global $noeud;
		global $id_arbre;
			
				
		// la classe de cette modalite
		
		$classe = strtolower(get_class($modalite)); 
			
		switch($classe){
		
		case "modalite_va_unique" : 
			$action = "eval_valeur";
			$value = $noeud->get_evaluation_modalite_va_unique($modalite->id_modalite);
			
			if( $modalite->type_reponse == 'frequence') {
					
					 $output = 'Au moins <input  type="text" name="evaluation_max" size="4" value="'.$value.'"> fois sur l\'ensembre des p&eacute;riodes ';
			}
			elseif( $modalite->type_reponse == 'note') {
					if($value==0) $value =20;
					$output = '/ <input  type="text" name="evaluation_max" size="4" value="'.$value.'"> ';
			}			
			else return ; // aucun critï¿½te de peroformance ne peut ï¿½tre defini pour une modalitï¿½ ï¿½ reponse texte											
			
			break;																				
											
		case "modalite_va_multiple"		   :								
			$action = "eval_choix";
			$les_choix = $modalite->get_choix();									

			$output = "";
			foreach($les_choix as $choix) 			
			$output.=' au moins <input type="text"  size="4" name="les_choix['.$choix->id_choix.']"  
						value="'.$noeud->get_evaluation_choix($choix->id_choix) .'" >
						fois  : '.$choix->libelle.' sur l\'ensembre des p&eacute;riodes<br>';
			
			break;		
		}
											 
		 	echo"
			<form name='theForm'  action='maj_noeud_v.php' method='post' >"			
		     ."
			 	<input type='hidden' name='action'  value='$action'>
				<input type='hidden' name='id_noeud' value='$id_noeud'>
				<input type='hidden' name='id_arbre' value='$id_arbre'>
				<input type='hidden' name='id_modalite' value='$modalite->id_modalite'>
			 
			 <table width ='100%' cellspacing='0' >			 
			 	<tr>
					 <th colspan='2'>
					 $modalite->libelle 					
			 		</th>													 		
	           </tr>
   			 <tr>
			 		<td>
					 <p> Se d&eacute;clare  </p>
			 		</td>
					<td>
					 $output
			 		</td>
	           </tr>
			   <tr>
					 <td colspan='2' class='right'>
					 <input type='submit' name='Submit' value='valider'>
					 
			 		</td>
	           </tr>

			</table>
			</form>
			";  	

	
	} 

?>		

<html>
<head>
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>"  />


<title>LEA : R&eacute;f&eacute;rentiel m&eacute;tier </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>
">
</script>
<script type="text/javascript" src="

<?php echo($LEA_URL.'javascript/stdlib.js')?>
">
</script>
<script type="text/javascript" src="

<?php echo($LEA_URL.'javascript/mootools.js')?>
">
</script>
<script type="text/javascript" src="

<?php echo($LEA_URL.'javascript/lightbox.js')?>
">
</script></head>
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
<div id="contenu">
			<div id="top_l"></div><div id="top_m">
			  <h1><?php
			if ($arbre->type == "entr") {
			    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				echo"Mise &agrave; jour  : $arbre->nom";
			}
			elseif($arbre->type == "cfa") {
			echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			echo"Mise &agrave; jour :  $arbre->nom ";
			}
			?>
			<a href="#" onclick="lightbox('aide_28', '<?php echo $LEA_URL?>')">
			<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a></h1></div>
			<div id="top_r"></div>
			<div id="m_contenu">
<p>
  <?php afficher_boutton_fermer(); ?>
</p>
<form name='theForm' action="maj_noeud_v.php" method="post">
  <input type="hidden" name="action" value="modif">
  <input type="hidden" name="id_noeud" value="<?php echo"$id_noeud "?>">
  <input type="hidden" name="id_arbre" value="<?php echo"$id_arbre "?>">
  <table width="100%" border="0" cellspacing="0">
    <tr>
      <th colspan="2">Vous voulez modifier le Libell&eacute; de le(a) <?php echo"$libelle_feuille"; ?>
	  		<a href="#" onclick="lightbox('aide_29', '<?php echo $LEA_URL?>')"><img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>

	  </th>
    </tr>
    <tr>
      <td width="11%" class="cellule">libell&eacute;</td>
      <td width="89%" class="cellule">
        <input name="libelle" type="text" value="<?php echo"$noeud->libelle" ?>" size="40">
        <img src='<?php echo"$src_img_feuille" ?>' border='0' title='est feuille' >
        <?php
			if( $noeud->niveau == $nb_niveau ) 
				 echo"<input type='hidden' name='type' value='feuille'>";	
			else {
					if($noeud->type =='feuille' ) $checked ="checked";
					else $checked="";
					echo"<input type='checkbox'  name='type' value='feuile' $checked >";
			}		
			?>
est	feuille <a href="#" onclick="lightbox('aide_27', '<?php echo $LEA_URL?>')"><img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a> </td>
    </tr>
    <tr>
      <td>&nbsp;      </td>
      <td><input type="submit" name="Submit" value="valider"></td>
    </tr>
  </table>
</form>

</div>
</div>				
</body>
</html>
