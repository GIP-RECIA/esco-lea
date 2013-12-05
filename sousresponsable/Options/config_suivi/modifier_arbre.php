<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la mise  ï¿½ jour du l'intitulï¿½ d'un arbre arbre  ainsi les intitulï¿½s de ses niveaux
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."sousresponsable/secure.php");

require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if( isset($_REQUEST['id_arbre'])) { 

	$arbre = new Arbre($_REQUEST['id_arbre']);
	$arbre->set_detail();
	$arbre->set_libelles_niveaux(); 
}else exit();

if($arbre->id_config != $config_lea->id_config) exit(); 

?>
<script language="JavaScript" src="../../../javascript/stdlib.js">

</script>		
<script language="JavaScript">

function controleSaisie(theForm){   
		          
   if(testVide(theForm.nom, "intitulï¿½")== false) return false;           


   return true;
}
</script>		
<?php 
  	include("menu_maj_arbre.php");
	afficher_menu_maj_arbre('modifier_niveaux');
?>
<div id="top_l"></div>
<div id="top_m">
	<h1>
		<?php
			if ($arbre->type == "entr") {
			    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
			}
			elseif($arbre->type == "cfa") {
				echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			}
			echo"<span class='orange'>M</span>odifier votre arbre :  $arbre->nom ";
			?>
	</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
		<div id="m_contenuArbre">
		  

<form action="./config_suivi/nouv_arbre_v.php?type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>"  method="post" onSubmit="return controleSaisie(this)">
  <input type="hidden" name="id_arbre" value="<?php echo"$arbre->id_arbre" ?>">
  <table width="100%" height="93" border="0" cellspacing="0">
    <tr>
<a href="#" onclick="lightbox('aide_36', '<?php echo $LEA_URL?>')"><img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>
	  
	  <td width="14%" height="31" class="sous_titre_tableau">Intitul&eacute;      </td>
      <td width="86%" class="sous_titre_tableau"><input name="nom" type="text" size="60"
		value= "<?php echo($arbre->nom); ?>" 
		></td>
    </tr>
    <tr>
      <td height="31" colspan="2">
		<?php 
				echo"<table cellspacing='0'> 
						
						<tr>
						           <th colspan=\"2\">Les intitul&eacute;s des niveaux</th>
				      </tr>";
			$i=1;		  	
			foreach($arbre->libelles_niveaux as $libelle) {
			
			echo" <tr>        		
					<td>
					Niveau $i	
					</td>
       				<td>
					<input name='libelles_niveaux[$i]' type='texte'  value='$libelle' size='60'>		
					</td>
	      		</tr>";
			$i++;
			}
			echo"</table>";
	   ?>
      </td>
    </tr>
    <tr>
      <td height="31" colspan="2" class="center">
      	<input type='submit' name='Submit' value='Valider'>
      </td>
    </tr>
  </table> 
  <p>&nbsp;    </p>
</form>
	</div>
</div>
