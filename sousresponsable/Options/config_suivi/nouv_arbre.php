<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/09/05
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
include($LEA_REP."sousresponsable/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();


$les_arbres = $config_lea->get_arbres($_GET['type_suivi']);
?>
<script language="JavaScript" src="../../../javascript/stdlib.js"></script>
<script language="JavaScript">
	function afficher_niveaux(v) {
		var val = parseInt(v);
		
		if (isNaN(val) || val < 0) {	
			alert("nombre de niveaux invalide");
			return false;
		}
		
		if (val > 100) {	
			alert(" le nombre de niveaux ne doit pas d&eacute;passer 100  niveaux ");
			return false;
		}
		output ="<br><table width='100%' cellspacing='0' >" 
				+	"<tr>"
				+     "<th colspan='2'> les libell&eacute;s des niveaux</th>"    
				+  "</tr>";	  					 	
		for(i=1; i <= val ; i++) {
			output +="<tr >"
				   + "<td>Libell&eacute; du Niveau " + i + " </td>"
				   + "<td ><input type='text' name='libelles_niveaux[" + i +"]' size='40'/> </td>"
				   + "</tr>";				        		
		}		 
		output += "</table>";
		
		if (window.document.getElementById){	
		    window.document.getElementById("les_niveaux").innerHTML = output;
		}
	}
	
	function controleSaisie(theForm)
	{   	    			    
	   	if(testVide(theForm.nom, "intitul&eacute; de l'arbre")==false ) return false; 
	   	
	   	v = theForm.nb_niveaux.value;
	
	   	if(testVide(theForm.nb_niveaux, "nombre de niveaux ")==false ) return false; 
	   
	   	if (isNaN(v) || v < 0) {	
			alert("nombre de niveau invalide");
			return false;
		}	   
	   return true;	
	}
</script>
<div id="contenu">
	<div id="top_l"></div>
	<div id="top_m"> 
		<h1>
  			<?php
			if ($_GET['type_suivi'] == "entr") {
					
			    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				echo'Cr&eacute;er un arbre : le suivi guid&eacute en '.$config_lea->appelation_entr;
			?>
			<a href="#" onclick="lightbox('aide_23', '<?php echo $LEA_URL?>')"> 
				<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
			</a>			
			<?php
			} else {
				echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
				echo'Cr&eacute;ation d\'un arbre pour le suivi guid&eacute en '.$config_term->terminologie_cfa;
			}?>
  		</h1>
  	</div>
  	<div id="top_r"></div>
	<div id="m_contenu">
		<form name="theForm" method="post" action="./config_suivi/nouv_arbre_v.php?type_suivi=<?php echo $_GET['type_suivi']; ?>&suivi=<?php echo $_GET['suivi']; ?>&selmenu=<?php echo $_GET['selmenu']; ?>" onSubmit="if(this.meme_ref && this.meme_ref.checked==false) return controleSaisie(this);">
			<p>
			 	<input type="hidden" name="type_suivi" value="<?php echo"$type_suivi"; ?>" >
			</p>
   			<div id="nouv_ref" style="hidden" >
     			<table width="695" cellspacing="0" >
       				<tr>
         				<th height="26" colspan="2">Cr&eacute;er un nouvel arbre</th>
					</tr>
        			<tr>
      					<td width="29%" height="43" class="sous_titre_tableau">
      						Votre arbre s'intitule
      					</td>
          				<td>
             				<input name="nom" type="text" size="50" value='' >
             				<br>(R&eacute;f&eacute;rentiel m&eacute;tiers, programme,....)
          				</td>
        			</tr>
        			<tr>
						<td height="42" class="sous_titre_tableau">Il comporte</td>
						<td class="cellule">
							<input name="nb_niveaux" type="text" size="4" onKeyUp="afficher_niveaux(this.value)">niveau(x)
							<a href="#" onclick="lightbox('aide_25', '<?php echo $LEA_URL?>')">
							<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" /></a>
		  				</td>
        			</tr>
					<tr align="left">
					  	<td height="32"></td>
					  	<td>
					  		<div id='les_niveaux'></div>
					  	</td>
					</tr>
        			<tr align="left">
          				<td height="31"></td>
          				<td>
          					<input type="submit" name="Submit" value="Cr&eacute;er cet arbre">
          				</td>
        			</tr>
     			</table>
   			</div>
  		</form>		
		<table width="50%" cellspacing="0" >
   			<tr>
   				<th>Liste des arbres d&eacute;j&agrave; cr&eacute;&eacute;s 
					<a href="href="#" onclick="lightbox('aide_24', '<?php echo $LEA_URL?>')">
						<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
					</a>
				</th>
   			</tr>
   			<tr>
     			<td>
     			<?php
					if(count($les_arbres) > 0 ) {
						foreach($les_arbres as $arbre){
							echo'<p>';						
							echo'<img src="'.$LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_arbre.png'.'">
								 <a href ="./options.php?cmd=maj_arbre&id_arbre='.$arbre->id_arbre.'&type_suivi='.$_GET['type_suivi'].'&suivi='.$_GET['suivi'].'&selmenu='.$_GET['selmenu'].'" >Mettre &agrave; jour : '.$arbre->nom.'</a>';
							echo'</p>';	
						}
					} else echo'<br><br> Aucun arbre n\'est cr&eacute;&eacute; <br> <br>';
				?>
     			</td>
   			</tr>
   			<tr>
   				<th>
			  		<!-- <a href="./config_suivi/dupliquer_arbre.php?<?php //echo('type_suivi='.$type_suivi ) ?>">
			  		Parcourir la biblioth&egrave;que d'arbre</a> -->
			  		<?php echo "<a href='./options.php?cmd=bibliotheque&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']."'>Parcourir la biblioth&egrave;que d'arbre</a>"; ?>
			  	</th>
   			</tr>
		</table>
  		</div>
</div>
