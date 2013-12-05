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
if (isset($_REQUEST['id_mat'])) $id_mat=$_REQUEST['id_mat'];
else { html_refresh("../accueil.php"); exit(); }

$matiere=new Matiere($id_mat); $matiere->set_detail();

 ?>		

        			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">

          <table width="100%" height="1%" border="0" cellpadding="0" cellspacing="0" >
            <tr >
              <td width="85%" height="34"><span class="titre_page">Consulter mati&egrave;re</span> </td>
              <td width="15%"><?php afficher_boutton_retour(); ?>
              </td>
            </tr>
            <tr >
              <td height="34" colspan="2"><hr class="trait">
              </td>
            </tr>
            <tr align="center">
              <td height="22" colspan="2">
                <table width="88%" height="1%" border="0" cellpadding="0" cellspacing="0" class="bordure" >
                  <tr >
                      <td height="22" colspan="3" class="titre_tableau" >Détail de la mati&egrave;re</td>
                  </tr>
                  <tr >
                    <td width="50%" height="22" class="txt_gras" >Objectif</td>
                    <td width="19%" align="right" class="txt_gras">Libell&eacute;:</td>
                    <td width="31%"><p class="txt_gras"><?php echo "$matiere->libelle"?></p></td>
                  </tr>
                  <tr >
                    <td rowspan="3" >
					<font color="#CC0066" >
					<?php echo(nl2br($matiere->objectif));?>
					</font>
					
					</td>
                    <td height="22" align="right" class="txt_gras">UE:</td>
                    <td><p class="txt"><?php echo "$matiere->sous_ue"?></p></td>
                  </tr>
                  <tr >
                    <td height="22" align="right" class="txt_gras">Semestre:</td>
                    <td><p class="txt"><?php echo "$matiere->semestre"?></p></td>
                  </tr>
                  <tr >
                    <td height="23" align="right" class="txt_gras">Mise à jour le </td>
                    <td><p class="txt"><?php echo $matiere->date_maj;?></p></td>
                  </tr>
                  <tr>
                    <td height="30" colspan="3" align="left" class="txt_gras"><hr></td>
                  </tr>
                  <tr>
                    <td height="30" colspan="3" align="left" class="txt_gras">Contenu</td>
                  </tr>
                  <tr align="left">
                    <td height="22" colspan="3">
					<p>
					<?php echo(nl2br($matiere->contenu));?>					
					</p> 
					<br>
					</td>
                  </tr>
                  <tr align="left">
                    <td height="22" colspan="3" class="titre_tableau">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
            
          </table>
		  
  </div>