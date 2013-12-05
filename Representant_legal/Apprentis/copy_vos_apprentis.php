<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/08/05
/***********************************************************/
include_once('../secure.php');
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");

/***********************************************************/
$parent = new Representant_legal($_SESSION['id_rl']);	

$les_id_apprentis = $parent->get_id_apprentis();

$REP_PHOTOS="../../Apprenti/Photos/";

if(isset($_REQUEST['id_app_select'])) { 
	
	$id_app_select=$_REQUEST['id_app_select'];
}
else $id_app_select=0;

if($id_app_select > 0) {
	
		if(!$parent->est_parent($id_app_select)){ 
			include("../../error.inc.php");
			exit();
		}			
	$apprenti_select = new Apprenti($id_app_select);	
	$apprenti_select->set_detail();
	$classe = $apprenti_select->get_classe();
	
	$id_ma = $apprenti_select->id_ma;
	$maitre = new maitre_apprentissage($id_ma);
	$maitre->set_detail();
    	
	$id_tuteur = $apprenti_select->id_ens;
	$tuteur = new Enseignant($id_tuteur);
	$tuteur->set_detail();
	
	$formation=new Formation($apprenti_select->get_id_for());
	$responsable = $formation->get_responsable(); // le responsable de la formation de l'apprenti
	
}
?>
			<div id="top_l"></div><div id="top_m">
					</div><div id="top_r"></div>
			<div id="m_contenu">
<table width="100%" height="4%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="36" colspan="2"><span class="titre_page"><img src="../../images/apprenti.jpeg" width="100" height="70">Votre
                enfant</span>
              <hr class="trait">
            </td>
          </tr>
          <tr>
            <td height="18" colspan="2" align="center" valign="middle">
		<?php if (isset($les_id_apprentis)) {
	    ?>
            </td>
          </tr>
          <tr>
            <td height="18" colspan="2" align="center" valign="middle">
			<form name="theForm" method="get" action="">
            <select name="id_app_select" 
					onChange="if(document.theForm.id_app_select.selectIndex!=0) document.theForm.submit();">
			<option value='0' selected>---- Sélectionner un apprenti ----</option>
			
			<?php 							
				
			foreach($les_id_apprentis as $id_app){
		         $apprenti=new Apprenti($id_app);	
	    		 $apprenti->set_detail();		  
				if($id_app==$id_app_select) $selected="selected";
				else $selected="";	  
		  echo"<option value='$id_app' $selected> $apprenti->nom &nbsp;&nbsp; $apprenti->prenom</option>";
		  }
		  ?>
						
            </select>
            </form>            
            </td>
          </tr>
<?php 
if($id_app_select > 0) { //si un apprenti est sélectionné 
?>		  
          <tr align="center">
            <td width="44%" height="416" ><table width="93%"  class="bordure">
              <tr>
                <td colspan="2" class="titre_tableau">Son livret d'apprentissage</td>
              </tr>
              <tr>
                <td height="42" colspan="2">
				<a href='<?php echo"apprentis.php?cmd=cons_dec&id_app=$id_app_select&type=cfa"?>'>
					<img src='../../images/cfa_dec.png' border="0">
					Suivi en formation
				</a>
				</td>
              </tr>
              <tr>
                <td height="42" colspan="2">
				<a href='<?php echo"apprentis.php?cmd=cons_dec&id_app=$id_app_select&type=entr"?>' >
				 <img src='../../images/entreprise_dec.png' border="0"> 
			 	Suivi en entreprise
				</a>				</td>
              </tr>
              <tr>
                <td height="20" colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td height="17" colspan="2" class="titre_tableau">Bilan des d&eacute;clarations </td>
              </tr>
              <tr>
                <td height="20" colspan="2">
				<?php 
			
            echo"<a href='../../Apprenti/Suiv_entr/bilan_taches.php?id_app_select=$apprenti_select->id_app' target='_blank'>
                Bilan des t&acirc;ches acquises
				</a>";			
				?>
                </td>
              </tr>
              <tr>
                <td height="20" colspan="2">
				<?php
					echo"<a href='../../Apprenti/Suiv_entr/bilan_classe.php?id_cla=$classe->id_cla&id_app_select=$id_app_select' target='_blank'>
 	    	           Bilan global de la classe de l'apprenti 
					</a>";
				?>				
				
				</td>
              </tr>
              <tr>
                <td height="20" colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="titre_tableau">Communiquer avec </td>
              </tr>
              <tr>
                <td width="43%" height="30" class="sous_titre_tableau">Son tuteur CFA</td>
                <td width="57%">
                  <?php 
				if(isset($tuteur->id_ens))
			 	 echo"<a href='apprentis.php?cmd=cons_coordonnees_ens&id_ens_select=$tuteur->id_ens'>
			  			$tuteur->nom &nbsp;&nbsp; $tuteur->prenom
					 </a>";
					
				?>
                </td>
              </tr>
              <tr>
                <td height="40" class="sous_titre_tableau">Son maitre d'apprentissage</td>
                <td>
                <?php 
				if(isset($maitre->id_ma))
			 	echo"<a href='apprentis.php?cmd=cons_coordonnees_ma&id_ma_select=$maitre->id_ma'>
			  			$maitre->nom &nbsp;&nbsp; $maitre->prenom
					 </a>";
					
				?>
                </td>
              </tr>
              <tr>
                <td height="45" class="sous_titre_tableau">Le responsable de
                  la formation</td>
                <td><?php 
				if(isset($responsable))
			 	 echo"<a href='apprentis.php?cmd=cons_coordonnees_ens&id_ens_select=$responsable->id_ens'>
			  			$responsable->nom &nbsp;&nbsp; $responsable->prenom
					 </a>";
					
				?>
                </td>
              </tr>
              <tr>
                <td height="32" class="sous_titre_tableau">Ses enseignants</td>
                <td><?php 

			 	echo"<a href='apprentis.php?cmd=cons_ens_clas&id_cla=$classe->id_cla'>
			  			Consulter
					 </a>";
					
				?>
                </td>
              </tr>
            </table></td>
            <td width="56%" >
			  <table width="100%" >
                <tr >
                  <td colspan="3"  class="titre_tableau">Informations Apprenti</td>
                </tr>
                <tr >
                  <td width="30%" height="31" class="sous_titre_tableau">Titre</td>
                  <td width="42%"  class="cellule"><p class="txt_gras"><?php echo"$apprenti_select->civilite" ?></td>
                  <td width="28%" rowspan="5" align="center" valign="middle" class="cellule"> 
				  <img src='<?php echo($REP_PHOTOS.$apprenti_select->src_photo) ?>' width="120" height="110"> </td>
                </tr>
                <tr >
                  <td height="32" class="sous_titre_tableau">Nom</td>
                  <td class="cellule"><p class="txt_gras"><?php echo"$apprenti_select->nom" ?></p>
                  </td>
                </tr>
                <tr >
                  <td height="35" class="sous_titre_tableau">Pr&eacute;nom</td>
                  <td  class="cellule"><p class="txt_gras"><?php echo"$apprenti_select->prenom" ?></p>
                  </td>
                </tr>
                <tr >
                  <td  class="sous_titre_tableau">Date de naissance</td>
                  <td class="cellule"><p class="txt_gras"><?php echo"$apprenti_select->date_nais" ?></td>
                </tr>
                <tr>
                  <td class="sous_titre_tableau">T&eacute;l&eacute;phone fixe</td>
                  <td class="cellule"><p class="txt_gras"><?php echo"$apprenti_select->tel_fixe" ?></p>
                  </td>
                </tr>
                <tr >
                  <td  class="sous_titre_tableau">T&eacute;l&eacute;phone portable</td>
                  <td colspan="2" class="cellule"><p class="txt_gras"><?php echo"$apprenti_select->tel_mobile" ?></td>
                </tr>
                <tr >
                  <td height="53"  class="sous_titre_tableau">Adresse</td>
                  <td colspan="2" class="cellule"><p class="txt_gras"><?php echo"$apprenti_select->adresse" ?></td>
                </tr>
                <tr >
                  <td  class="sous_titre_tableau">E-mail</td>
                  <td colspan="2"  class="cellule"> <a href='mailto:<?php echo"$apprenti_select->email" ?>'><?php echo"$apprenti->email" ?></a></td>
                </tr>
                <tr >
                  <td  class="sous_titre_tableau">Diplomes obtenus</td>
                  <td colspan="2" class="cellule"><p class="txt_gras"><?php echo"$apprenti_select->diplomes_obtenus" ?></td>
                </tr>
                <tr >
                  <td colspan="3"  class="titre_tableau">Contrat</td>
                </tr>
                <tr >
                  <td  class="sous_titre_tableau">Date de debut</td>
                  <td colspan="2" class="cellule"><?php echo"$apprenti_select->date_debut_contrat" ?></td>
                </tr>
                <tr >
                  <td  class="sous_titre_tableau">Date de fin</td>
                  <td colspan="2" class="cellule"><?php echo"$apprenti_select->date_fin_contrat" ?></td>
                </tr>
              </table>
			 
		    </td>
          </tr>
          <tr align="center">
            <td height="18" colspan="2" ><?php 			
			echo" 
			<input type='button' value=\"Ecrire un message à cet apprenti\"
			onClick=\"window.open('../../Admin_unite/Contact/ecrire_msg.php?les_id_usager_dest[]=$apprenti_select->id_app','','height=300, width=600, left=150, top=300, scrollbars=no')\">
			";
			?>
            </td>
          </tr>
	<?php }?> 
          <tr align="center">
            <td colspan="2" > 
	<?php 
	}else  echo"Cette annee, vous ne suivez aucun apprenti ";
	
	?>
</td>
          </tr>
</table>		
</div>