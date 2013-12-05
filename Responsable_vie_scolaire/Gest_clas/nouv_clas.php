<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  // Contenu: Cette page contient le formulaire de création d'une nouvelle classe
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
/***********************************************************/

if (isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="nouv";

switch ($action) {

case "nouv" : 
			 $titre_page="Nouvelle classe";
			 $action_formulaire="nouv_clas_v.php?action=nouv";
             if (isset($_REQUEST['id_for_select'])) $id_for_select=$_REQUEST['id_for_select']; //si la formation est fournie comme paramètre			 
			 else $id_for_select=0;
	   		 $libelle="";
			 $niveau_etude="";
			 $id_ens_select="";  
			  ;
			 break;
case "modif":
			$titre_page="Modifier la classe";
			$id_cla=$_REQUEST['id_cla'];
			$action_formulaire="nouv_clas_v.php?action=modif&id_cla=$id_cla";			 
			$classe=new Classe($id_cla); 
			$classe->set_detail();
			$id_for_select=$classe->id_for;
			$libelle=$classe->libelle;
			$niveau_etude=$classe->niveau_etude;
			$id_ens_select=$classe->get_id_prof_principal(); //l'identifiant du prof  principal de la classe 
			 break;
}


if ($action=="nouv" || $action=="modif" ){

$bdd = new Connexion_BDD_LEA();
 
$les_enseignants = $bdd->get_usagers(0,10000,'ens');

$unite = new Unite_pedagogique($_SESSION['id_unite']); // l'unite auquelle l'usager connecté est responsable
$les_id_formations = $unite->get_id_formations();


if (count($les_id_formations)==0){
 echo" Aucune formation  n'est enregistrée : 
       <a href='../Gest_clas/gest_clas.php?cmd=nouv_form'> Créer une nouvelle formation </a>";

}

 ?>		

<SCRIPT language=JavaScript>
						
	function verifform(theForm){															
		
		if ( theForm.id_for && theForm.id_for.selectedIndex ==0)  {
			alert("Vous devez  sélectionner une formation ");
			return false;
	   }	
		if (theForm.libelle.value == "") {
			alert("Vous devez saisir le libellé de la classe ");
			theForm.libelle.focus();
			return false;	   		
		}
		
      	
	}//fin de verifform					
</SCRIPT>
 			<div id="top_l"></div><div id="top_m">
			  <h1><?php echo"$titre_page" ?> </h1>
			</div><div id="top_r"></div>
			<div id="m_contenu">

<?php echo"<form name='theForm' action='$action_formulaire' method='post' 
             onSubmit='return verifform(this)'>" ?>
     
        <table width="100%" height="53%" border="0" cellpadding="0" cellspacing="0" >
          <tr >
            <td height="36">Formation </td>
            <td width="53%">
			<select name="id_for" size="1">
			 <option value='0' selected>---- Sélectionnez une formation ------</option>";
             <?php
			 if (isset($les_id_formations)){
			 	foreach($les_id_formations as $id_for) {
			 		 $formation=new Formation($id_for);
					 $formation->set_detail();
				if($id_for==$id_for_select) $selected="selected";
				else $selected="";
					 
			  echo "<option value='$id_for' $selected>$formation->nom </option>";	 
			 	}
			 }
			 ?> 
            </select><sup class="etoile">*</sup></td>
          </tr>
          <tr >
            <td width="20%">Libell&eacute; de
              la classe </td>
            <td height="37">
             <input name="libelle" type="text" size="38" value="<?php echo"$libelle" ?>">
            <sup class="etoile">*</sup></td>
          </tr>
          <tr>
            <td height="34">Niveau d'&eacute;tude</td>
            <td height="34">
			<select name="niveau_etude" size="1">
			<?php
			
			$selected1=""; $selected2=""; $selected3="";
			switch($niveau_etude){ 
			case 1:$selected1="selected";
      			 break; 
			case 2:$selected2="selected";
    			   break; 
			case 3:$selected3="selected";
       			   break; 
			default: break;
			}
			echo"
              <option value='1' $selected1>Première année</option>
              <option value='2' $selected2>Deuxième année</option>
              <option value='3' $selected3>Troisième année</option>
			 "; 
			?> 
            </select><sup class="etoile">*</sup></td>
          </tr>
          <tr>
            <td height="34">&nbsp;</td>
            <td height="34"><input type="submit" name="Submit" value='Valider'></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <?php 
  }

?>
</div>