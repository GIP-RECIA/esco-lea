<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la crï¿½ation d'une modalitï¿½ de validation du rï¿½fï¿½rentiel d'identifiant $id_arbre
/***********************************************************/
require_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."modele/bdd/classe_modalite_va_unique.php");
require_once($LEA_REP."modele/bdd/classe_modalite_va_multiple.php");
require_once($LEA_REP."modele/bdd/classe_choix_modalite_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../../test_responsable.php");
include($LEA_REP.'espace_de_partage/aide.php');
$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();


if(isset($_REQUEST['id_arbre'])) $id_arbre = $_REQUEST['id_arbre'];
else exit();

$arbre = new Arbre($id_arbre);
$arbre->set_detail();

$type_suivi = $arbre->type;

$les_periodes = $formation->get_periodes($type_suivi);

if(isset($_REQUEST['les_id_periode'])) $les_id_periode = $_REQUEST['les_id_periode'];
else  $les_id_periode = array();


if(isset($_REQUEST['libelle'])) {

	if(isset($_REQUEST['type_reponse'])&& (
		$_REQUEST['type_reponse']=='frequence' ||
		$_REQUEST['type_reponse']=='note'	   ||
		$_REQUEST['type_reponse']=='texte'     
		
		) 
	  ) {
		if(isset($_REQUEST['valider'])) { // le formulaire est soumi par le boutton valider
			$modalite = new Modalite_va_unique(0);
			$modalite->libelle = to_sql($_REQUEST['libelle']);
			$modalite->acteur  = to_sql($_REQUEST['acteur']);
			$modalite->type_reponse  = to_sql($_REQUEST['type_reponse']);						
			$modalite->id_arbre = $arbre->id_arbre;
			$modalite->insert();
			$modalite->update_periodes($les_id_periode);
			
			echo"<script language='JavaScript'>
			     window.opener.location.reload(); window.close(); 
			   </script>";
		}	
	}
	
	elseif (isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix'){

		if(isset($_REQUEST['type_choix']) && isset($_REQUEST['les_choix'])) {
		
			$modalite = new Modalite_va_multiple(0);
			$modalite->libelle = to_sql($_REQUEST['libelle']);
			$modalite->acteur = to_sql($_REQUEST['acteur']);			
			$modalite->type_choix = to_sql($_REQUEST['type_choix']);
			$modalite->id_arbre = $arbre->id_arbre;
			$modalite->insert();
			$modalite->update_periodes($les_id_periode);
			
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
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>"  />

<title>LEA : Modalit&eacute; de saisie</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>

</script>		
<script language="JavaScript">

function controleSaisie(theForm){   
		          
   if(testVide(theForm.libelle, "intitul&eacute; de la modalit&eacute;")== false) return false;                    	
	
    if(theForm.nombre ) {
		 if( !isNumeric(theForm.nombre.value) || theForm.nombre.value < 1    ) {	
			 alert(theForm.nombre.value + " n'est pas un nombre valide  \n Veuillez saisir un nombre  de choix  superieur ï¿½ 1 ");
			 return false; 
		}	  
	} 
    
	if(theForm.reponses && testVide(theForm.reponses, "choix")== false) return false;           
	    
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
<div id="contenu">
			<div id="top_l"></div><div id="top_m"><h1><?php
			if ($type_suivi == "entr") {
					
			    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				echo"Nouvelle modalit&eacute; de saisie ";
			}
			else {
			 echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			 echo"Nouvelle modalit&eacute; de saisie ";
			}
 ?></h1></div><div id="top_r"></div>
			<div id="m_contenu">
	
 <p> <?php afficher_boutton_fermer(); ?> </p>

   <form action="" method="post" onSubmit="return controleSaisie(this)">
     <input name="type_suivi" type="hidden" value="<?php echo"$type_suivi" ?>" >
     <table width="99%" height="373" border="0" cellspacing="0">
       <tr>
         <td>L'intitul&eacute; de la modalit&eacute;</td>
         <td>
           <input name="libelle" type="text" size="60"
		value= "<?php if(isset($_REQUEST['libelle'])) echo(stripslashes($_REQUEST['libelle'])); ?>" 
		>
         </td>
       </tr>
       <tr>
         <td height="32" class="sous_titre_tableau">Modalit&eacute; se valide
           par</td>
         <td class="cellule">
           <?php
				$array_values = array(											 
				 'app'		  => strtoupper($config_lea->appelation_app), 
				 'tuteur_cfa' => strtoupper($config_lea->appelation_tuteur_cfa),
				 'ma'		  => strtoupper($config_lea->appelation_ma),
				 'ens'        => strtoupper($config_lea->appelation_ens),
				 'rl'		  => strtoupper($config_lea->appelation_rl), 
				 'rf'         => strtoupper($config_lea->appelation_rf));
				$selected_value = (isset($_REQUEST['acteur']) ) ? $_REQUEST['acteur']:'app';
				$attr ='';
				$name= 'acteur';
				
				echo liste_deroulante ( $name , $array_values , $selected_value , $attr,  $multiple = 0 , $size = 1 );
				
			?>
         </td>
       </tr>
       <tr>
         <td height="143" class="sous_titre_tableau">Modalit&eacute; se valide
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
       <tr>
         <td width="36%" height="67" class="sous_titre_tableau">Pour la saisie
           des donn&eacute;es, Vous proposez</td>
         <td width="64%" class="cellule">
           
             <input name="type_reponse" type="radio" value="frequence" onClick="this.form.submit()" 
		
			<?php
			if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='frequence') echo"checked";
			?>

		>
          Champ num&eacute;rique pour &eacute;crire une fréquence <br>
          <input type="radio" name="type_reponse" value="note" onClick="this.form.submit()" 
  			<?php
			if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='note') echo"checked";
			?>

			  >
          Champ num&eacute;rique pour &eacute;crire un ratio<br>
          <input type="radio" name="type_reponse" value="texte" onClick="this.form.submit()" 
  			<?php
			if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='texte') echo"checked";
			?>

			  >
          Champ de texte<br>
          <input type="radio" name="type_reponse" value="liste_choix" onClick="this.form.submit()" 
  			<?php
			if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix') echo"checked";
			?>

	  >
          Liste de choix 
         </td>
       </tr>
       <?php
		if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='note') {
		?>
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
					  <td  class='sous_titre_tableau'>&nbsp;</th>	
			           <th>Liste des choix</td>
				      </tr>";	
				for($i = 1 ; $i <= $nombre; $i++ ) {
					echo" <tr>
        				<td> &nbsp;</td>
       					<td>
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
        multiple 
		</td>
       </tr>
       <?php
	  		}
	   }
	   ?>
     </table>
	 <p>
     <?php 
		if(isset($_REQUEST['type_reponse']))
			echo"<input type='submit' name='valider' value='Valider'>";
		?>
   </form>
    </p>
</div>
</div>
</body>
</html>

