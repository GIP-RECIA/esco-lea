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
include_once("../../Modele/classe_tache.php");
include_once("../../stdlib.php");
/***********************************************************/

if(isset($_REQUEST['id_for'])) $id_for=$_REQUEST['id_for'];
else { html_refresh("../accueil.php"); exit(); }


$src=$_FILES['modele_taches']['tmp_name']; 
$nom=$_FILES['modele_taches']['name'];

//if (! is_uploaded_file($src)) { echo("Fichier attaché invalide"); exit();}

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
/*
$row=1;
echo"<table>";
foreach ($data as $ligne) {

    $num = count ($ligne);
	print "<p> $num champs dans la ligne".($row)." <br>\n";
  echo"<tr>";
    $row++;
	$c=0;
    foreach ($ligne as $key => $value) {
		$c++;
		$field="$key <br> $value";
		if($c%2) $color="#000000";
		else $color="#A45C99";
        
		echo"<td >";
		 echo("<font color='$color'> $field &nbsp; </font>");
		
		echo"</td>";
    }
  echo"</tr>";	
}
echo"</table><br>";
*/


$nbl=count($data); //le nombre de lignes

$tache=new Tache(0);

// parcours de la table data: chaque ligne correspond à un apprenti

for($i=0; $i<$nbl; $i++)
{ 

	$ligne=$data[$i];
	
if(get_magic_quotes_gpc()) {			

	if(isset($ligne["LIBELLE"])) $tache->libelle=$ligne["LIBELLE"];
	if(isset($ligne["ACTIVITE"])) $tache->activite=$ligne["ACTIVITE"];
	if(isset($ligne["DESCRIPTION"])) $tache->description=$ligne["DESCRIPTION"];

}else {

	if(isset($ligne["LIBELLE"])) $tache->libelle=addslashes($ligne["LIBELLE"]);
	if(isset($ligne["ACTIVITE"])) $tache->activite=addslashes($ligne["ACTIVITE"]);
	if(isset($ligne["DESCRIPTION"])) $tache->description=addslashes($ligne["DESCRIPTION"]);


}	
		
	if ($tache->libelle!="" ) {
			if($tache->existe($id_for) )  	$tache->update($id_for); 
			else $tache->insert($id_for);
	}
	
}//fin  foreach

html_refresh("cours.php?cmd=cons_mod_tach&id_for=$id_for"); 

?>
