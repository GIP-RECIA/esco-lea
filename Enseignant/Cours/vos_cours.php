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
//include_once ("../secure.php");
include_once ("../../Modele/classe_classe.php");
include_once ("../../Modele/classe_matiere.php");
include_once ("../../Modele/classe_cours.php");
include_once ("../../Modele/classe_enseignant.php");
include_once ("../../stdlib.php");
/***********************************************************/

$session= get_current_session();
$enseignant= new Enseignant($_SESSION['id_ens']);
$les_id_cours=$enseignant->get_id_cours($session); 

 ?>		
 			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">


        <table width="100%" height="50%" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td height="36" colspan="2"><span class="titre_page"> 
		    <img src="../../images/cours.jpeg" width="100" height="70"></span>            </td>
            <td width="88%" height="36"><span class="titre_page">Vos cours</span>
              <hr class="trait"></td>
          </tr>
          <tr>
            <td colspan="3" >&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td height="240" colspan="3" >
		<?php if (isset($les_id_cours)) { 		 
		 ?>  
		  	<table width='90%' border='0'>                
                <tr class='sous_titre_tableau'>
                  <td width='30%'>Classe</td>
                  <td width='60%' colspan=2>Mati&egrave;re</td>
				  
                </tr>
		<?php		
				foreach($les_id_cours as $id_cours) {
					$cours=new Cours($id_cours);
					$cours->set_detail();
					$classe=new Classe($cours->id_cla); $classe->set_detail();
					$matiere=new Matiere($cours->id_mat); $matiere->set_detail();
					
						$link_mat="";
		?>			
					
				<tr class='cellule'>
					 <td >
					 <a href='<?php echo"../Formations/formations.php?cmd=cons_clas&id_for=$classe->id_for" ?>' >
					 	<?php echo"$classe->libelle"?> 
					 </a>	
					 </td>
        		   	 <td >
					 	<a href='<?php echo"cours.php?cmd=cons_mat_det&id_mat=$matiere->id_mat" ?>' >
						<?php echo"$matiere->libelle" ?>
						</a>
					</td>
					 <td>
						 <img src='../../images/b_browse.png'>
					   	<a href='<?php echo"cours.php?cmd=cons_chapitres_vus_cours&id_cours=$cours->id_cours"?>'>
							Consulter les chapitres 
						</a>
					 </td>
                </tr>
		 <?php 		
                 } 
		 ?>		 				
               </table>
		<?php	   
			    }else { echo" Cette annee, aucun cours ne vous a était attribué ";      					 
					 }  
		?>  
            </td>
          </tr>
        </table>
		

	</div>	