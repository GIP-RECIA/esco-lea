<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/09/05
/***********************************************************/
include_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['type_suivi']) && ( $_REQUEST['type_suivi'] =='entr' || $_REQUEST['type_suivi'] =='cfa') )
	 $type_suivi = $_REQUEST['type_suivi'];
else exit();

$arbre_suivi_cfa =  $config_lea->get_arbre('ref_cfa');
$arbre_suivi_entr = $config_lea->get_arbre('ref_entr');

if($type_suivi=='cfa'){
	if ($arbre_suivi_cfa->id_arbre != 0) html_refresh("maj_referentiel.php?id_arbre=$arbre_suivi_cfa->id_arbre");

	if($arbre_suivi_entr->id_arbre != 0) $dupliquer = 1;
	else $dupliquer = 0;
}
else {
	if($arbre_suivi_entr->id_arbre != 0) html_refresh("maj_referentiel.php?id_arbre=$arbre_suivi_entr->id_arbre"); 
	
	if($arbre_suivi_cfa->id_arbre != 0) $dupliquer = 1;
	else $dupliquer = 0;
}	





?>
<html>
<head>		
<link rel="stylesheet" href="../../../styles/enseignant.css" type="text/css">
<title>Référentiel métier </title>
<script language="JavaScript" src="../../../javascript/stdlib.js">

</script>

<script language="JavaScript">

function afficher_niveaux( val ) {	
		
if (!isNumeric(val) || val < 0) {	
	alert("nombre de niveau invalide");
	return false;
}

if (val > 100) {	
	alert(" le nombre de niveaux ne doit pas dépasser 100  niveaux ");
	return false;
}

		 	  output ="<br><table width='100%' cellspacing='0' >" 
			  		 +	"<tr class='titre_tableau'>"
					 +     "<td colspan='2'> les libellés des niveaux</td>"    
					 +  "</tr>";
           
	  					 	
	for(i=1; i <= val ; i++) {
         
		 output +="<tr class='sous_titre_tableau'>"
		        + "<td>Libellé du Niveau " + i + " </td>"
		        + "<td ><input type='text' name='libelles_niveaux[" + i +"]' size='40'> </td>"
				+ "</tr>";				        
		
     }		 
  output+="</table>";
  
  if(i==val+1) output="";
  
  if (window.document.getElementById)
    {	
    window.document.getElementById("les_niveaux").innerHTML = output;
    }

}


function controleSaisie(theForm, active)
{   
    			    
   if(testVide(theForm.nom, "intitulé du référentiel")==false ) return false; 
   else  return true;

}


</script>

</head>

<body>
<?php require("../../header.php"); ?>	

			<div id="top_l"></div><div id="top_m"><h1></h1></div><div id="top_r"></div>
			<div id="m_contenu">

<table width="100%" height="4%" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="81%" height="36">
			<span class="titre_page">
			    <?php
			if ($type_suivi == "entr") {
			    echo"<img src='".$LEA_URL."images/entreprise_dec.png'>";				
			}
			elseif($type_suivi == "cfa") {
			echo"<img src='".$LEA_URL."images/cfa_dec.png'>";
			
			}
			?>
		    Cr&eacute;ation d'arbre pour le suivi guid&eacute;</span></td>
            <td width="19%"><?php afficher_boutton_fermer(); ?>
</td>
          </tr>
          <tr>
            <td height="36" colspan="2"><hr class="trait"></td>
          </tr>
          <tr align="center">
            <td height="18" colspan="2" valign="middle">
			<form name="theForm" method="post" action="nouv_referentiel_v.php" onSubmit="if(this.meme_ref && this.meme_ref.checked==false) return controleSaisie(this);">
			  <p>
			    <input type="hidden" name="type_suivi" value="<?php echo"$type_suivi"; ?>" >
				</p>
		<div id="nouv_ref" style="hidden" >
			  <table width="81%" cellspacing="0" >
                <tr>
                  <td height="33" colspan="2" class="titre_tableau">Cr&eacute;er
                    un nouvel arbre</td>
                </tr>
                <tr>
                  <td width="29%" height="33" class="sous_titre_tableau">Votre
                    arbre s'intitule</td>
                  <td width="71%" class="cellule">
				  <input name="nom" type="text" size="50" 
				  
				  value=''
				  
				  >
				  <p>
				  (R&eacute;f&eacute;rentiel m&eacute;tiers, Tableau de strat&eacute;gies,
				  programme,......)
				  </p>
                  </td>
                </tr>
                <tr>
                  <td height="40" class="sous_titre_tableau">Il comporte</td>
                  <td class="cellule"><input name="nb_niveaux" type="text" size="4" onKeyUp="afficher_niveaux(this.value)">                  
                    niveaux
                  </td>
                </tr>
                <tr align="left">
                  <td colspan="2">
                    <div id='les_niveaux'> </div>
                  </td>
                </tr>
                <tr align="right">
                  <td colspan="2">&nbsp;                  </td>
                </tr>
              </table>
			  <?php 
				
				if($arbre_suivi_cfa->id_arbre != 0) 
							echo "Un référentiel est déjà créé pour le suivi au CFA,  Voulez-vous le  dupliquer pour ce suivi. 
										<input type='checkbox' name='meme_ref' value='1'> OUI";
				elseif($arbre_suivi_entr->id_arbre != 0)
							echo"Un référentiel est déjà créé pour le suivi en entreprise,  Voulez-vous le  dupliquer pour ce suivi. 
								<input type='checkbox' name='meme_ref' value='1'> OUI";
			    
				?>
		</div>
			
			  <hr class="trait">
              <input type="button"  name="Submit2" value="Pr&eacute;cedent" onClick="window.history.back()">
				&nbsp; &nbsp;&nbsp;&nbsp;
				<input type="submit" name="Submit" value="Suivant">
			</form>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center" >&nbsp;            </td>
          </tr>
</table>		
</div>
</body>
</html>
