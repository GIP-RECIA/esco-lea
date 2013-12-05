<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 25/08/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");
include_once ("../../Modele/classe_formation.php");
include_once ("../../Modele/classe_matiere.php");
include_once("../../Modele/classe_enseignant.php");
include_once ("../../stdlib.php");
/***********************************************************/

$enseignant=new Enseignant($_SESSION['id_ens']);
$les_id_formations=$enseignant->get_id_formations(); 

	if (isset($_REQUEST['id_for'])) $id_for_select=$_REQUEST['id_for'];			
	if (!isset($id_for_select)) $id_for_select=0;
	
$formation_select=new Formation($id_for_select);
$formation_select->set_detail();
$les_id_matieres=$formation_select->get_id_matieres();

$enseignant= new Enseignant($_SESSION['id_ens']);
$est_responsable=$enseignant->est_responsable($id_for_select);	


if (isset($les_id_formations)){		
 ?>	
 			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">
	

        <form action="cours.php?cmd=cons_mat" method="get" >
		<input type='hidden' name='cmd' value='cons_mat'>
        <table width="96%"  border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td height="24" colspan="2"><span class="titre_page">Consulter les
            matières</span> </td>
            <td height="24"><?php afficher_boutton_retour(); ?>
            </td>
          </tr>
          <tr>
            <td height="21" colspan="3"><hr class="trait">
            </td>
          </tr>
          <tr>
            <td width="28%" height="20">&nbsp;</td>
            <td width="54%" class='sous_titre_tableau'>Formation
              <select name="id_for" size="1">
                <?php			  			  			  			  									  			  

			 	foreach($les_id_formations as $id_for) {				
				
						if ($id_for==$id_for_select) $selected="selected";
						else $selected="";
			 		 $formation=new Formation($id_for);
					 $formation->set_detail();
				     echo "<option value='$id_for' $selected>$formation->nom </option>";	 
			 	}
			 
			 ?>
              </select>
            <input type="submit" name="Submit" value="Valider"></td>
            <td width="18%">&nbsp;</td>
          </tr>
          <tr>
            <td height="19" colspan="3">&nbsp;</td>
          </tr>
          <tr align="center">
            <td height="19" colspan="3"><table width="709" >
              <?php
			if (isset($les_id_matieres)) { 
			?>
              <tr>
                <td colspan="6" class="titre_tableau">Formation : <?php echo " $formation_select->nom"; ?></td>
              </tr>
              <tr>
                <td width="187" class="sous_titre_tableau">Mati&egrave;re</td>
                <td width="201" class="sous_titre_tableau">Semestre</td>
                <td width="267" colspan="3" class="sous_titre_tableau">Action </td>
              </tr>
              <?php			  
				  foreach($les_id_matieres as $id_mat){
				  	$matiere=new Matiere($id_mat);
				  	$matiere->set_detail();
					$est_autorise_maj_mat=$enseignant->est_autorise_maj_matiere($id_mat);				  
    	            echo"<tr>";
					echo"<td width='30%'>
							<a href='cours.php?cmd=cons_mat_det&id_mat=$id_mat'>
								$matiere->libelle 
							</a>
						</td>";
					echo"<td width='20%'>							
								<p> $matiere->semestre 							
						</td>";	
        	        echo"<td><img src='../../images/b_browse.png'>
								<a href='cours.php?cmd=cons_chap&id_mat=$matiere->id_mat'>
								Consulter les chapitres 
							</a>
						</td>";	
if($est_responsable ||
   $est_autorise_maj_mat) echo"<td><img src='../../images/b_edit.png'>
								<a href='cours.php?cmd=nouv_mat&id_mat=$matiere->id_mat&id_for_select=$id_for_select'>
								Modifier
							</a>
						</td>";	
						   	            	                    
if($est_responsable) echo"<td><img src='../../images/b_drop.png'>
								<a href='../../Admin_unite/Gest_mat/supp_mat.php?id_mat=$matiere->id_mat' onClick='return deleteConfirm(\"cette matière\")'>
								Supprimer
							</a>
						</td>";		
						
    				 echo"</tr>";

				   }
				}elseif ($id_for_select!=0)
						echo "<tr>
							 <td>Pas de matières pour cette formation </td>
		        			</tr>";    	
			  ?>
            </table></td>
          </tr>
          <tr align="center">
            <td height="19" colspan="3">&nbsp;</td>
          </tr>
          <tr align="center">
            <td height="19" colspan="3">
			<?php 
		   if ($id_for_select!=0 && $est_responsable) { 
			echo"<a href='cours.php?cmd=nouv_mat&id_for_select=$id_for_select'>
			<img src='../../images/nouvelle_matiere.png' border='0'></a>";
		  }		 	
			?>
            </td>
          </tr>         
         
        </table>
        </form>

<?php 
}

else  echo" Aucune formation n'est enregistrée: Contactez l'administrateur LEA ";
 	 

?>

</div>
