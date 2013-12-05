<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/08/05
/***********************************************************/
require_once("../../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();
include_once("../../Modele/classe_formation.php");
include_once("../../Modele/classe_tache.php");
include_once("../../Modele/classe_apprenti.php");
include_once("../../Modele/classe_enseignant.php");
include_once("../../stdlib.php");
/***********************************************************/

$les_id_formations=get_id_formations(); // liste des identifiants des formations enregistré sur la base

if (isset($_REQUEST['id_for'])) $id_for_select=$_REQUEST['id_for'];
else $id_for_select=0;

	
$formation_select=new Formation($id_for_select);
$les_taches=$formation_select->get_modele_taches();

if(isset($_SESSION['id_ens'])) {
	$enseignant= new Enseignant($_SESSION['id_ens']);
	$est_responsable=$enseignant->est_responsable($id_for_select); // tester si l'enseignant est le responsble de la formation
	$est_autorise_maj_modele_taches=$enseignant->est_autorise_maj_modele_taches($id_for_select);

	
}
elseif(isset($_SESSION['id_usager'])){
	// on autorise pas l'adminstrateur de mettre à jour le modèle de tâches de cette formation 
	$est_autorise_maj_modele_taches=0;
	$est_responsable=0; 
}
else exit(); 


?>		
<SCRIPT language="JavaScript">
function verifform(theForm){
	
	var  ModFichier = new RegExp("\.((txt) | (csv) )$");
	var	 nom=theForm.modele_taches.value;
		 
		if ( nom == "" ) {
			alert("Vous devez attacher un fichier");
			theForm.modele_taches.focus();
			return false;
		}
		
}//fin de verifform			
</SCRIPT>
			<div id="top_l"></div><div id="top_m"></div><div id="top_r"></div>
			<div id="m_contenu">


	<table width="102%" height="268" border="0">
 		 <tr>
 		   <td height="21" colspan="4"><span class="titre_page">Mod&egrave;le de t&acirc;ches</span></td>
           <td height="21"><?php afficher_boutton_retour(); ?>
           </td>
	 </tr>
 		 <tr>
 		   <td height="23" colspan="5"><hr class="trait"></td>
      </tr>
		<tr>
		<form name="form1" method="GET" action="cons_mod_tach.php">
		 <input type="hidden"  name="cmd" value="cons_mod_tach">
    		<td width="27%" height="2">&nbsp;
			</td>
	        <td width="11%" height="29" class="sous_titre_tableau">Formation</td>
	        <td width="9%" class="cellule">
              <select name="id_for" size="1">
                <?php
						  			 
			 if (isset($les_id_formations)){
			 	foreach($les_id_formations as $id_for) {				
			 		 $formation=new Formation($id_for);
					 $formation->set_detail();
					 if($id_for==$id_for_select) $selected="selected";
					 else $selected="";
				     echo "<option value='$id_for' $selected >$formation->nom </option>";	 
			 	}
			 }
			 ?>
              </select>
            </td>
	        <td width="26%" >			
	          <input type="submit" name="Submit" value="Valider">
            </td>
		    <td width="27%" >&nbsp;			</td>
		</form>
	  </tr>
		<tr>
		  <td height="29" colspan="5">
		  <?php if (isset($les_taches)){ 
		 
		 
		echo "<table width='97%' height='44%' align='center' >
                   	
                	<tr class='titre_tableau'>
                    	  <td height='21' colspan='2' >Activit&eacute;s/ Taches</td>";
if($est_responsable||$est_autorise_maj_modele_taches) 
		echo"             <td>Action</td>
						  <td>
						  	<img src='../../images/b_drop.png'>
							<a href='maj_tache.php?action=supp_all&id_for=$id_for_select' onClick='return deleteConfirm(\"toutes les tâches de cette formation\")'>
								TOUT supprimer 
							</a>
						  </td>	
                    </tr>";
                   
					$activite_old="";
					foreach($les_taches as $tache) {
					$id_tache=$tache->id_tache;
					$activite=$tache->activite;
					$libelle=$tache->libelle;
					$description=$tache->description;
						if ($activite_old!=$activite){
						$tab_activites[]=$activite; 
						echo " <tr>
						         <td colspan='3'><p>&nbsp;</p></td>
						    </tr>
						    <tr class='sous_titre_tableau'>
		                  		<td height='19' colspan='2'>$activite</td>";
if($est_responsable||$est_autorise_maj_modele_taches) 
						 echo" <td colspan='2' align='center'><p>&nbsp;</p></td>";
	                   echo"</tr>";
						$activite_old=$activite;	  
						}
					
                						
                echo"<tr class='cellule'  >
                		<td width='2%' height='22' align='right' >
							<img src='../../images/pucecarrerougeplein.gif' width='12' height='12'>
						</td>
                  		<td width='61%' ><p  title='$description'> 
						                 $libelle 
										 </p> 
					   </td>";						  		
if($est_responsable||$est_autorise_maj_modele_taches ) 
					echo"<td><img src='../../images/b_edit.png'>
						<a href='#'
				        onclick=\"window.open('nouv_tache.php?action=modif&id_tache=$id_tache','','scroling=no, width=400, height=250 top=300 left=350')\">
								Modifier 
							</a>
						</td>
	            	    <td><img src='../../images/b_drop.png'>
							<a href='maj_tache.php?action=supp&id_tache=$id_tache' onClick='return deleteConfirm(\"cette tâche\")'>
								Supprimer 
							</a>
						</td>";
						
                	echo"</tr>";
							
					}
					echo"</table>";						
			
			}else if ($id_for_select==0) afficher_msg("Sélectionnez une formation");
				  else 	afficher_msg("Aucune tâche n'est enregistrée");
		?>
		  </td>
	  </tr>
		<tr>
		  <td height="29" colspan="5"><hr class="trait" ></td>
	  </tr>
		<tr align="center">
		  <td height="29" colspan="5">
<?php if (($id_for_select !=0)&& ($est_responsable || $est_autorise_maj_modele_taches)) { 
$onclick="\"window.open('nouv_tache.php?action=nouv&id_for=$id_for_select','','scroling=no, width=400, height=250 top=300 left=350')\"";
?>		  
          <table width="89%" border="1">
            <tr>
              <td width="44%" align="center">
		   	  <a href='#' onclick=<?php echo"$onclick"; ?> >
				  <img src='../../images/nouvelle_tache.png'  border='0'>
			  </a>
		 
			   
              </td>
              <td width="56%" align="center">
			  <form action="import_modele_taches_v.php" method="post" 
			  enctype="multipart/form-data" name="form2" onSubmit="return verifform(this)">
			  <?php echo"<input type='hidden' name='id_for' value='$id_for_select'>"; ?>
                <input type="file" name="modele_taches">
                <input type="submit" name="Submit2" value="Importer "><br>
				<a href="format_fichier_modele_taches.htm">(Attacher un fichier
                texte du format csv)
				</a>
                            </form></td>
            </tr>
          </table>
<?php  }					   
?>		  
		  </td>
	  </tr>
</table>
	<br>
		</div>	
