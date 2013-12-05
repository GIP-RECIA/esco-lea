<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 21/09/05
  //Contenu: ce script permet de visualiser la liste des chapitres de la matière 
  //           d'identifiant $id_mat.
/***********************************************************/
include_once("../secure.php");
include_once("../../Modele/classe_matiere.php");
include_once("../../Modele/classe_chapitre.php");
include_once("../../Modele/classe_enseignant.php");
include_once("../../stdlib.php");
/***********************************************************/

if (isset($_REQUEST['id_mat'])) $id_mat=$_REQUEST['id_mat'];
else  html_refresh(" ../../accueil.php");

$matiere=new Matiere($id_mat);
$matiere->set_detail();
$les_chapitres=$matiere->get_les_chapitres(); 

if(isset($_SESSION['id_ens'])) {
      $enseignant= new Enseignant($_SESSION['id_ens']);
	  $est_autorise_maj_mat=$enseignant->est_autorise_maj_matiere($id_mat);
	  $est_responsable=$enseignant->est_responsable($matiere->id_for);
	  
}	  
elseif(isset($_SESSION['id_usager']) || isset($_SESSION['id_app'])){
$est_autorise_maj_mat=0;
$est_responsable=0;
}
else html_refresh($LEA_URL);
?>		
<SCRIPT language="JavaScript">
function verifform(theForm){
	
	var  ModFichier = new RegExp("\.((txt) | (csv) )$");
	var	 nom=theForm.les_chapitres.value;
		 
		if ( nom == "" ) {
			alert("Vous devez attacher un fichier");
			theForm.les_chapitres.focus();
			return false;
		}		
		
		
}//fin de verifform			
</SCRIPT>
			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">

	<table width="103%" height="253" border="0">
 		 <tr>
 		   <td height="21" colspan="3"><span class="titre_page">Les chapitres de la
	       matière </span> <span class="txt_gras"><?php echo"$matiere->libelle"; ?></span> </td>
           <td width="25%" height="21"><?php afficher_boutton_retour(); ?>
           </td>
	  </tr>
 		 <tr>
    		<td height="23" colspan="4">
		   <hr class="trait"></td>
 		 </tr>
 		 <tr>
 		   <td height="40" colspan="4">
		   <?php if (isset($les_chapitres)){ 
		 
		 
		echo "<table width='97%'  align='center' >
                   	
                	<tr class='titre_tableau'>
                  		<td height='21' colspan='2' >Thème/ Chapitres</td>";
   if($est_responsable||$est_autorise_maj_mat )  
   		echo"           <td>Action</td>
						<td>
						  	<img src='../../images/b_drop.png'>
							<a href='maj_chap.php?action=supp_all&id_mat=$id_mat' onClick='return deleteConfirm(\"tous les chapitres de cette matière \")'>
								TOUT supprimer 
							</a>
						 </td>
                    </tr>";
                   
					$old_theme="";
					foreach($les_chapitres as $chapitre) {
					$id_chap=$chapitre->id_chap;
					$theme=$chapitre->theme;
					$libelle=$chapitre->libelle;					

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
if($est_responsable||$est_autorise_maj_mat) {
					echo"<td><img src='../../images/b_edit.png'>
							<a href='#'
							onclick=\"window.open('nouv_chap.php?action=modif&id_chap=$id_chap','','scroling=no, width=400, height=200 top=300 left=350')\">
								Modifier 
							</a>
						</td>
	            	    <td><img src='../../images/b_drop.png'>
							<a href='maj_chap.php?action=supp&id_chap=$id_chap' onClick='return deleteConfirm(\"ce chapitre\")'>
								Supprimer 
							</a>
						</td>";
}						
                echo"</tr>";
							
					}
					echo"</table>";						
			
			}else afficher_msg("Aucun chapitre n'est enregistré");
						  
		?>
		   
		   </td>
      </tr>
 		 <tr>
 		   <td height="45" colspan="4" align="center">&nbsp;</td>
      </tr>
 		 <tr>
 		   <td height="21" colspan="4" align="center">
		   <hr class="trait">
<?php 
	if ($est_responsable || $est_autorise_maj_mat) { 
	$onclick="\"window.open('nouv_chap.php?action=nouv&id_mat=$id_mat','','scroling=no, width=400, height=200 top=300 left=350')\"";
?>
           <table width="89%" border="1">
             <tr>
               <td width="44%" align="center"> <a href='#' onclick=<?php echo"$onclick"; ?> > 
			   <img src='../../images/nouveau_chapitre.png'  border='0'> </a> </td>
               <td width="56%" align="center">
                 <form action="import_les_chapitres_v.php" method="post" 
			  enctype="multipart/form-data" name="form2" onSubmit="return verifform(this)">
                   <?php echo"<input type='hidden' name='id_mat' value='$id_mat'>"; ?>
                   <input type="file" name="les_chapitres">
                   <input type="submit" name="Submit2" value="Importer ">
                   <br>
                   <a href="format_fichier_les_chapitres.htm">(Attacher un fichier
                   texte du format csv) </a>
                                  </form>
               </td>
             </tr>
           </table>
           <?php  
		   
		   }//else echo("Vous n'êtes pas autorisés à  mettre à jour les chapitre de cette matière")
		   
		   					   
           ?>
           </td>
 		 </tr>
</table>
	<br>
			
   </div>