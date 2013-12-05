<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/11/05
  //Contenu : 
/***********************************************************/
include_once("../secure.php");
include_once("../../Modele/classe_chapitre.php");
include_once("../../stdlib.php");
/***********************************************************/

if(isset($_REQUEST['id_mat'])) $id_mat=$_REQUEST['id_mat'];
else { html_refresh("../accueil.php"); exit(); }


$src=$_FILES['les_chapitres']['tmp_name']; 
$nom=$_FILES['les_chapitres']['name'];


$fp =fopen ("$src","r");

$data=array();

$ligne1= fgetcsv ($fp, 10000, ";"); // les noms des données importées

$row =0; 

while ($ligne= fgetcsv ($fp, 10000, ";")) {    		
    if(isset($ligne)&& $ligne[0]!=NULL) { 
	    $nb=count($ligne);
		for($j=0; $j<$nb; $j++ ) {
	        $key=$ligne1[$j];
			$data[$row][$key]=$ligne[$j];
		}	
		$row++;
	}
		
}

fclose ($fp);


$nbl=count($data); //le nombre de lignes

$chap=new Chapitre(0);
$chap->id_mat=$id_mat;

// parcours de la table data: chaque ligne correspond à un apprenti

for($i=0; $i<$nbl; $i++)
{ 

	$ligne=$data[$i];
if(get_magic_quotes_gpc()) {
			
		if(isset($ligne["LIBELLE"])) $chap->libelle=$ligne["LIBELLE"];
		if(isset($ligne["THEME"])) $chap->theme=$ligne["THEME"];	
}else {
		if(isset($ligne["LIBELLE"])) $chap->libelle=addslashes($ligne["LIBELLE"]);
		if(isset($ligne["THEME"])) $chap->theme=addslashes($ligne["THEME"]);
}	
		
	if ($chap->libelle!="" ) {
			if($chap->existe() )	$chap->update();
			else $chap->insert();
	}
	
}//fin  foreach

html_refresh("cours.php?cmd=cons_chap&id_mat=$id_mat"); 
?>
