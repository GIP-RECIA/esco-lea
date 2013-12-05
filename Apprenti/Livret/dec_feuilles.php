<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06
 
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");

/**********************************************************/

if(isset($_REQUEST['id_arbre'])) $id_arbre = $_REQUEST['id_arbre'];
else exit();


if(isset($_REQUEST['les_id_noeud'])) { 
				$_SESSION['les_feuilles_declarees'][$id_arbre] = $_REQUEST['les_id_noeud'];
				echo" 
					<script langage='javascript'>
						window.opener.location.reload();
						window.close();
					</script>					
					";
}				
elseif(isset($_SESSION['les_feuilles_declarees'][$id_arbre]) ) 
	 $les_id_noeud_select = $_SESSION['les_feuilles_declarees'][$id_arbre];
else $les_id_noeud_select = array();

$arbre = new Arbre($id_arbre);
$arbre->set_detail();

$arbre->set_libelles_niveaux(); // recupï¿½rer tous les noms des niveaux de l'arbre
$arbre->tab_noeuds = $arbre->get_noeuds();


// cette fonction affiche les noeus de l'arbre 

function afficher_arbre($id_noeud_racine) {
		
		global $LEA_URL;
		global $les_id_noeud_select; 
		global $arbre;
		global $URL_THEME;
									
			$src_img_arbre  = $URL_THEME."images/picto_arbre.png";											

	  //ballayage du l'arbre
	  echo"<ul>";
    
		  for ($x=0; $x < count($arbre->tab_noeuds); $x++ ) {

    
		    if ($arbre->tab_noeuds[$x]->id_noeud_parent == $id_noeud_racine) {
      
	    	   echo "<li class='arbre'>"; 
			   if( $arbre->tab_noeuds[$x]->type == "feuille") {
			   				
							$id =  $arbre->tab_noeuds[$x]->id_noeud; // l'identifiant de la feuille
								//echo("id=$id <br>");			
							if(in_array ($id, $les_id_noeud_select) ) {
								$checked = "checked"; 
								$style ='feuille_select';
							}	
							else {
									 $checked = "";
									 $style ='feuille';
							}		 
							
							
								
								echo"<div id='$id'  class='$style'>
								     <input type='checkbox' name='les_id_noeud[]' value='$id' 
									 $checked 
									 onClick='select_feuille($id, this.checked)'
									 >
									 
									 ".$arbre->tab_noeuds[$x]->libelle .
									"</div> 
									"; 
				}		
				else echo("<b>".$arbre->tab_noeuds[$x]->libelle."</b>");				
			       
				afficher_arbre($arbre->tab_noeuds[$x]->id_noeud);
							
			   echo"</li>";	   
    		}
 		 }
	  echo"</ul>"; 
  
	}


 ?>
 <html>
<head>
		<link rel="stylesheet" type="text/css" 
		href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'apprenti.css');?>"  />

<title> <?php echo"$arbre->nom "; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
 <style>
 .feuille{
 	color ='#008000';
 }
 .feuille_select{
 	color ='#FFA500';
 }

 
 </style>
<script language="JavaScript">

function select_feuille(id, checked){
	
	var div = document.getElementById(id);
	
	
	if( checked == false ) div.className ='feuille';
							
	else div.className = 'feuille_select';		

}

</script>
</head>
<body>
<div id="conteneur">
	<div id="header">
		<?php require($LEA_REP.'header.php'); ?>
	</div>
	<div id="contenu">
	
<b>
<?php
			if ($arbre->type == "entr") {
			    echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				echo"$arbre->nom";
			}
			elseif($arbre->type == "cfa") {
			echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
			echo"$arbre->nom ";
			}
?>
</b>
 <?php afficher_boutton_fermer(); afficher_boutton_imprimer() ?> 

<form action="?" method="post">
    <?php 
			echo'<input type="hidden" name="id_arbre" value='.$arbre->id_arbre.'> '; ?>         
			   
                  <table>
                    <tr>
                      <th>
					  <?php 
					  echo" Veuillez rep&eacute;rer les ". 
					  	   strtolower($arbre->get_libelle_feuille()) .
						   "(s) &agrave; d&eacute;clarer sur le ".
						   strtolower($arbre->nom); 
					   ?>
					  </th>
                    </tr>
                    <tr>
                      <td width="100%" height="58">
					  <div id="arbre"> 
						  <?php	
					  		
						  		afficher_arbre(0);
			  
					 		 ?>
					 </div>
                      </td>
                    </tr>
                  </table>
                
	         <p> <input type="submit" name='submit' value="Valider"> </p>
</form>  
	</div>

</div>
</body>

</html>