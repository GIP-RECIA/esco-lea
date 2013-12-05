<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 21/09/05
  //Contenu: ce script permet de visualiser la liste des chapitres déjà vus du cours 
  //           d'identifiant $id_cours.
/***********************************************************/
include_once("../secure.php");
include_once("../../Modele/classe_cours.php");
include_once("../../Modele/classe_matiere.php");
include_once("../../Modele/classe_chapitre.php");
include_once("../../stdlib.php");
/***********************************************************/

if (isset($_REQUEST['id_cours'])) $id_cours=$_REQUEST['id_cours'];
else  html_refresh(" ../../accueil.php");

$cours=new Cours($id_cours);
$cours->set_detail();
$matiere=new Matiere($cours->id_mat);
$matiere->set_detail();
$classe=new Classe($cours->id_cla);
$classe->set_detail();


$les_chapitres=$matiere->get_les_chapitres(); // les chapitres de la matière 

if(isset($les_chapitres)) $nb_chapitres=count($les_chapitres);
else 	$nb_chapitres=0;


$les_id_chapitres_vus=$cours->get_id_chapitres_vus(); // les chapitres vus de la matière 

if(isset($les_id_chapitres_vus)) $nb_chapitres_vus=count($les_id_chapitres_vus);
else 	$nb_chapitres_vus=0;


if(isset($_SESSION['id_ens'])) { // L'usager connecté est un enseignant

	// si l'enseignnat connceté est le chargé du cours $cours, il a le droit de mettre à jour les chapitres vus
	// de ce cours
	if($_SESSION['id_ens']==$cours->id_ens ) $maj_chapitres_vus=1;
	else $maj_chapitres_vus=0;
	
	 $enseignant= new Enseignant($_SESSION['id_ens']);
     $est_autorise_maj_mat=$enseignant->est_autorise_maj_matiere($matiere->id_mat) || $enseignant->est_responsable($matiere->id_for) ;

}elseif(isset($_SESSION['id_ma'])) { // L'usager connecté est un maitre d'apprentissage
		$maj_chapitres_vus=0;
		$est_autorise_maj_mat=0;
}
elseif(isset($_SESSION['id_rl'])) { // L'usager connecté est un représentant légal
		$maj_chapitres_vus=0;
		$est_autorise_maj_mat=0;

}
elseif(isset($_SESSION['id_usager'])) { // L'usager connecté est un administrateur
		$maj_chapitres_vus=0;
		$est_autorise_maj_mat=0;

}
elseif(isset($_SESSION['id_app'])) { // L'usager connecté est un apprenti
		$maj_chapitres_vus=0; 
		$est_autorise_maj_mat=0;

}

else html_refresh("../../accueil.php");

?>		
			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">

	<table width="100%" height="191" border="0">
 		 <tr>
    		<td height="61">
			<span class="titre_page">Les chapitres vus du cours </span>
		   <span class="txt_gras"><?php echo"$matiere->libelle"; ?></span>
		   <span class="titre_page"> de la classe </span> <span class="txt_gras"><?php echo"$classe->libelle"; ?></span>	        <hr class="trait"></td>
 		 </tr>
<?php 
	if($maj_chapitres_vus &&  isset($les_chapitres)) {
?>	
 		 <tr>
 		   <td height="40">

			<p> Cochez les chapitres d&eacute;j&agrave; vus dans votre cours
 			    puis valider par le boutton modifier. 
			</p>		 			 
		   </td>		 
      	</tr>
<?php
}
?>				 	  
 		<tr>
 		   <td height="40">
		   <?php if (isset($les_chapitres)){ 
		 		 
		echo "
		<form action='modif_chapitres_vus_cours_v.php' method='post'>
		<input type='hidden' name='id_cours' value='$id_cours'>
			<table width='60%'  align='left' >
                   	
                	<tr class='titre_tableau'>
                  		<td height='21' colspan='2' >Thème/ Chapitres</td>
   			            <td>";
	if($maj_chapitres_vus)	echo"<input type='submit' value='Modifier'>";
	
				echo"  </td>						
                    </tr>";
                   
					$old_theme="";
					foreach($les_chapitres as $chapitre) {
					$id_chap=$chapitre->id_chap;
					$theme=$chapitre->theme;
					$libelle=$chapitre->libelle;
					if(isset($les_id_chapitres_vus) && in_array($id_chap, $les_id_chapitres_vus))  
							$checked="checked";
					else 	$checked="";
					 
						if ($old_theme!=$theme){
						
						echo " <tr>
						    	     <td colspan='3'><p>&nbsp;</p></td>
						       </tr>
						       <tr class='sous_titre_tableau'>
							   	    <td height='19' colspan='3'>$theme</td>

	                          </tr>";
						$old_theme=$theme;	  
						}
					
                						
                echo"<tr class='cellule' >
                		<td width='2%' height='22' align='right' >
							<img src='../../images/puce1.gif' width='12' height='12'>
						</td>
                  		<td width='61%' ><p class='txt_gras' > 
						                 $libelle 
										 </p> 
					  </td>	";
					echo"<td>";					
					
if($maj_chapitres_vus)	echo"<input name='les_id_chapitres_vus[]' type='checkbox' value='$id_chap' $checked>";
					
					if($checked!="") echo"<img src='../../images/vr.gif'>"; 
						
					echo"</td>
	            	   	</tr>";
							
					}
	
			echo"	</table>
			     </form>
				
				 ";						
			
			}else afficher_msg("Aucun chapitre n'est enregistré");
						  
		?>
		   
		   </td>
      </tr>
 		 <tr>
 		   <td height="40" align="center">
		   <?php 
if($maj_chapitres_vus) {
	  if($est_autorise_maj_mat) {
		   echo"<a href='cours.php?cmd=cons_chap&id_mat=$matiere->id_mat'> ";
		   echo"Mettre à jours les chapitres ";		   
		   echo"<a>";
	 }else {	 		 
				  
	        echo"<a href='#' onClick=\" alert('Espace réservé aux enseignants autorisés: Contactez le responsable de la formation ') \">
		    	Mettre à jours les chapitres 
		    	<a>";
	 
	 } 		   
}		   
		   ?>
		   </td>
      </tr>
</table>
	<br>
			</div>
   