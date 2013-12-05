<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la création d'une modalité de validation du référentiel d'identifiant $id_arbre
/***********************************************************/
require_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."modele/bdd/classe_modalite_numerique_frequence.php");
require_once($LEA_REP."modele/bdd/classe_modalite_numerique_note.php");
require_once($LEA_REP."modele/bdd/classe_modalite_multiple.php");
require_once($LEA_REP."modele/bdd/classe_choix_modalite_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['id_arbre'])) $id_arbre = $_REQUEST['id_arbre'];
else exit();

$arbre = new Arbre($id_arbre);
$arbre->set_detail();

if(isset($_REQUEST['libelle'])) {

	if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='frequence') {
		if(isset($_REQUEST['valider'])) { // le formulaire est soumi par le boutton valider
			$modalite = new Modalite_numerique_frequence(0);
			$modalite->libelle = to_sql($_REQUEST['libelle']);
			$modalite->acteur = to_sql($_REQUEST['acteur']);						
			$modalite->id_arbre = $arbre->id_arbre;
			$modalite->insert();
			echo"<script language='JavaScript'>
			     window.opener.location.reload(); window.close(); 
			   </script>";
		}	
	}
	elseif(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='note'){
		if(isset($_REQUEST['note_max'])) {
			$modalite = new Modalite_numerique_note(0);
			$modalite->libelle = to_sql($_REQUEST['libelle']);
			$modalite->acteur = to_sql($_REQUEST['acteur']);
			$modalite->note_max = to_sql($_REQUEST['note_max']);						
			$modalite->id_arbre = $arbre->id_arbre;
			$modalite->insert();
			echo"<script language='JavaScript'>
			     window.opener.location.reload(); window.close(); 
			   </script>";	
		
		}
	
	}
	elseif (isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix'){

		if(isset($_REQUEST['type_choix']) && isset($_REQUEST['les_choix'])) {
		
			$modalite = new Modalite_multiple(0);
			$modalite->libelle = to_sql($_REQUEST['libelle']);
			$modalite->acteur = to_sql($_REQUEST['acteur']);			
			$modalite->type_choix = to_sql($_REQUEST['type_choix']);
			$modalite->id_arbre = $arbre->id_arbre;
			$modalite->insert();
			
			foreach($_REQUEST['les_choix'] as $libelle_choix) {
				$choix = new Choix_modalite_multiple(0);
				$choix->libelle = to_sql($libelle_choix);
				
				$choix->id_modalite = $modalite->id_modalite;
				if($choix->libelle!='') $choix->insert();
			}
			
			echo"<script language='JavaScript'>
			     window.opener.location.reload(); window.close(); 
			   </script>";
		}	
	}

}
?>		

<html>
<head>
<link rel="stylesheet" href="../../../styles/enseignant.css" type="text/css">
<title>Modalité de saisie</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="../../../javascript/stdlib.js">

</script>		
<script language="JavaScript">

function controleSaisie(theForm){   
		          
   if(testVide(theForm.libelle, "intitulé de la modalité")== false) return false;           
   
   if(theForm.type_reponse[0].checked == false && theForm.type_reponse[1].checked == false
      && theForm.type_reponse[2].checked == false) { 
   			alert("veuillez sélectionner le type de la réponse attendue ");
   			return false;        
	
   }
    
	if(theForm.note_max ) {
		 if( !isNumeric(theForm.note_max.value) || theForm.note_max.value < 1    ) {	
			 alert(theForm.note_max.value + " n'est pas un nombre valide  \n Veuillez saisir un nombresuperieur à 1 ");
			 return false; 
		}	  
	} 
	
    if(theForm.nombre ) {
		 if( !isNumeric(theForm.nombre.value) || theForm.nombre.value < 1    ) {	
			 alert(theForm.nombre.value + " n'est pas un nombre valide  \n Veuillez saisir un nombre  de choix  superieur à 1 ");
			 return false; 
		}	  
	} 
    
	if(theForm.reponses && testVide(theForm.reponses, "choix")== false) return false;           
	    
   return true;
}

</script>		
</head>
<body>
			<div id="top_l"></div><div id="top_m"><h1></h1></div><div id="top_r"></div>
			<div id="m_contenu">

<table width="100%" height="170" border="0">
  <tr>
    <td width="86%" height="21"> <span class="titre_page">
      <?php
			if ($arbre->type == "ref_entr") {
			    echo"<img src='".$LEA_URL."images/entreprise_dec.png'>";
				echo"Nouvelle modalit&eacute; de validation pour  le suivi en entreprise";
			}
			elseif($arbre->type == "ref_cfa") {
			echo"<img src='".$LEA_URL."images/cfa_dec.png'>";
			echo"Nouvelle modalit&eacute; de validation  pour le suivi au CFA";
			}
			?>
    </span> </td>
    <td width="14%"><?php afficher_boutton_fermer(0); ?>
    </td>
  </tr>
  <tr>
    <td height="23" colspan="2"><hr class="trait">
    </td>
  </tr>
  <tr align="center">
    <td height="118" colspan="2" align="left">
      <form action="" method="post" onSubmit="return controleSaisie(this)">
        <input name="type_suivi" type="hidden" value="<?php echo"$type_suivi" ?>" >
        <table width="99%" height="327" border="0" cellspacing="0">
          <tr>
            <td height="31" class="sous_titre_tableau">L'intitul&eacute; de la
              modalit&eacute;</td>
            <td class="cellule">
              <input name="libelle" type="text" size="60"
		value= "<?php if(isset($_REQUEST['libelle'])) echo($_REQUEST['libelle']); ?>" 
		>
            </td>
          </tr>
          <tr>
            <td height="32" class="sous_titre_tableau">Modalit&eacute; valid&eacute;e
              par</td>
            <td class="cellule">
              <select name="acteur">
                <option value='app'
				<?php
					if(isset($_REQUEST['acteur'])&& $_REQUEST['acteur']=='app') echo"selected";
				?>	
			> APPRENTI </option>
                
				<option value="ma"
				  <?php
					if(isset($_REQUEST['acteur'])&& $_REQUEST['acteur']=='ma') echo"selected";
				?>	
				> <?php echo(strtoupper($config_lea->appelation_ma))?> </option>
                
				<option value="tuteur_cfa"
				<?php
					if(isset($_REQUEST['acteur'])&& $_REQUEST['acteur']=='tuteur_cfa') echo"selected";
				?>
				><?php echo(strtoupper($config_lea->appelation_tuteur_cfa))?> </option>
              </select>
            </td>
          </tr>
          <tr>
            <td width="36%" height="67" class="sous_titre_tableau">Pour la saisie
              des donn&eacute;es, Vous proposez</td>
            <td width="64%" class="cellule">
			<p>
              <input name="type_reponse" type="radio" value="frequence" onClick="this.form.submit()" 
		
			<?php
			if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='frequence') echo"checked";
			?>

		>
              Champ num&eacute;rique pour &eacute;crire une frequence <br>
              <input type="radio" name="type_reponse" value="note" onClick="this.form.submit()" 
  			<?php
			if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='note') echo"checked";
			?>

	  >
              Champ num&eacute;rique pour &eacute;crire un ration<br>
              <input type="radio" name="type_reponse" value="liste_choix" onClick="this.form.submit()" 
  			<?php
			if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix') echo"checked";
			?>

	  >
              Liste de choix             
			</p>
			</td>
          </tr>
          <?php
		if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='note') {
		?>
          <tr>
            <td height="41" class="sous_titre_tableau">Le ration max</td>
            <td class="cellule"> X/
                <input name="note_max" type="text" size="4">
            </td>
          </tr>
          <?php
		}
		elseif(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix') {
  	   ?>
          <tr>
            <td height="31" class="sous_titre_tableau">Nombre de choix &agrave; proposer</td>
            <td class="cellule">
              <?php 
				if(isset($_REQUEST['nombre'])) {
					$nombre = $_REQUEST['nombre']; 
					echo"$nombre";
				}	
				else {
					$nombre = 0;
					echo"<input name='nombre' type='text' size='4' value='$nombre'>";
				}	
		
		?>
            </td>
          </tr>
          <?php 	if($nombre > 0 ) {
				echo"<tr>
					  <td  class='sous_titre_tableau'>&nbsp;</td>	
			           <td  class='sous_titre_tableau'>Liste des choix</td>
				      </tr>";	
				for($i = 1 ; $i <= $nombre; $i++ ) {
					echo" <tr>
        				<td  class='sous_titre_tableau'> &nbsp;</td>
       					<td class='cellule'>
							choix $i : <input name='les_choix[]' type='texte' size='60'>
						</td>
			      		</tr>";
				}
	  ?>
          <tr>
            <td height="32" class="sous_titre_tableau">Vous autorisez le choix</td>
            <td class="cellule">
              <input name="type_choix" type="radio" value="unique" checked>
              Unique
              <input type="radio" name="type_choix" value="multiple">
              multiple </td>
          </tr>
          <?php
	  		}
	   }
	   ?>
          <tr>
            <td height="17" colspan="2" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <?php 
		if(isset($_REQUEST['type_reponse']))
			echo"<input type='submit' name='valider' value='Créer la modalité'>";
		?>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</div>
</body>
</html>

