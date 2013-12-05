<?php
require_once("./secure.php");
if (file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))require_once("../config/config.inc.php");
elseif	(file_exists("config/config.inc.php"))   require_once("config/config.inc.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

$config_term = new Terminologie();
$config_term->set_detail();
$bdd = new Connexion_BDD_LEA();
$ouverture = fopen("lea.leav3", "w" );
fputs ($ouverture , "<?xml version=\"1.0\" encoding=\"UTF-8\"?><LEAV3:Map xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:LEAV3=\"LEAV3\">");
$sql="select * from les_droits where id_droit='sr'";
$lt=$bdd->executer($sql);
if($ligne=mysql_fetch_assoc($lt)){
	$sr=$ligne['dr_soumis'];
}
$sql="select * from les_droits";
$result=$bdd->executer($sql);
$term=$config_term->terminologie_app;
if(ereg("app",$sr)){fputs($ouverture,"<Acteur xsi:type=\"LEAV3:APP\" terminologie=\"".$term."\">");fputs ($ouverture, "<Fonction xsi:type=\"LEAV3:F_SR\" nom=\"Conception du suivi\" droit=\"sr\"/></Acteur>");}else{ fputs($ouverture,"<Acteur xsi:type=\"LEAV3:APP\" terminologie=\"".$term."\"/>"); }
$term=$config_term->terminologie_rf;
fputs ($ouverture ,"<Acteur xsi:type=\"LEAV3:RF\" terminologie=\"".$term."\"/>");
while($ligne=mysql_fetch_assoc($result)){
	if($ligne['id_droit']=="admin"){
		$term=$config_term->terminologie_admin;
		fputs ($ouverture ,"<Acteur xsi:type=\"LEAV3:ADMIN\" terminologie=\"".$term."\">");
		fonction($ligne['dr_soumis'],"admin",$ouverture,$sr);
		fputs($ouverture ,"</Acteur>");
	}
	else if($ligne['id_droit']=="rvs"){
		$term=$config_term->terminologie_rvs;
		fputs ($ouverture ,"<Acteur xsi:type=\"LEAV3:RVS\" terminologie=\"".$term."\">");
		fonction($ligne['dr_soumis'],"rvs",$ouverture,$sr);
		fputs($ouverture ,"</Acteur>");
	}
	else if($ligne['id_droit']=="ens"){
		$term=$config_term->terminologie_ens;
		$termcfa=$config_term->terminologie_tuteur_cfa;
		fputs ($ouverture ,"<Acteur xsi:type=\"LEAV3:ENS\" terminologie=\"".$term."\" terminologie_tcfa=\"".$termcfa."\">");
		fonction($ligne['dr_soumis'],"ens",$ouverture,$sr);
		fputs($ouverture ,"</Acteur>");
	}
	else if($ligne['id_droit']=="ma"){
		$term=$config_term->terminologie_ma;
		fputs ($ouverture ,"<Acteur xsi:type=\"LEAV3:MA\" terminologie=\"".$term."\">");
		fonction($ligne['dr_soumis'],"ma",$ouverture,$sr);
		fputs($ouverture ,"</Acteur>");
	}
	else if($ligne['id_droit']=="parent"){
		$term=$config_term->terminologie_rl;
		if($ligne['dr_soumis']=="true"){
			if(ereg("rl",$sr)){fputs($ouverture,"<Acteur xsi:type=\"LEAV3:PAR\" terminologie=\"".$term."\">");fputs ($ouverture, "<Fonction xsi:type=\"LEAV3:F_SR\" nom=\"Conception du suivi\" droit=\"sr\"/></Acteur>");}else{ fputs($ouverture,"<Acteur xsi:type=\"LEAV3:PAR\" terminologie=\"".$term."\"/>"); }
		}
	}
	else if($ligne['id_droit']=="unite_peda")$peda=$ligne['dr_soumis'];
	else if($ligne['id_droit']=="supp_suivi")$suivi=$ligne['dr_soumis'];
}
$term=$config_term->terminologie_lea;
fputs($ouverture,"<Institutions>
  <Institution xsi:type=\"LEAV3:I_LEA\" terminologie=\"".$term."\"/>");
$term=$config_term->terminologie_cfa;
fputs($ouverture,"<Institution xsi:type=\"LEAV3:I_CFA\" terminologie=\"".$term."\">");
$term=$config_term->terminologie_formation;
fputs($ouverture,"<sousInstitution xsi:type=\"LEAV3:I_FOR\" terminologie=\"".$term."\"/>");
$term=$config_term->terminologie_classe;
fputs($ouverture,"<sousInstitution xsi:type=\"LEAV3:I_CLA\" terminologie=\"".$term."\"/>");
$term=$config_term->terminologie_suivi_cfa;
fputs($ouverture,"<sousInstitution xsi:type=\"LEAV3:I_SCFA\" terminologie=\"".$term."\"/>");
$term=$config_term->terminologie_unit_pedag;
if($peda=="true") {
	fputs($ouverture,"<sousInstitution xsi:type=\"LEAV3:I_PED\" terminologie=\"".$term."\"/>");
}
$term=$config_term->terminologie_entr;
fputs($ouverture,"</Institution>");
if($suivi=="true") {
	fputs($ouverture,"<Institution xsi:type=\"LEAV3:I_ENT\" terminologie=\"".$term."\">");
} else { 
	fputs($ouverture,"<Institution xsi:type=\"LEAV3:I_ENT\" terminologie=\"".$term."\"/>");
}
$term=$config_term->terminologie_suivi_entr;
if($suivi=="true"){
	fputs($ouverture,"<sousInstitution xsi:type=\"LEAV3:I_SE\" terminologie=\"".$term."\"/>");
	fputs($ouverture,"</Institution>");
}
fputs($ouverture,"</Institutions>");
fputs ($ouverture ,"</LEAV3:Map>");
//fwrite();
fclose ($ouverture);


function fonction($dr_soumis,$id,$ouverture,$sr){
	$ex=explode(",",$dr_soumis);
	for($i=0;$i<sizeof($ex);$i++){
		$t=$ex[$i];
		if($t == "admin" ) fputs ($ouverture ,"<Fonction xsi:type=\"LEAV3:F_ADMIN\" nom=\"Administration\" droit=\"admin\"/>");
		if($t ==  "rvs" ) fputs ($ouverture ,"<Fonction xsi:type=\"LEAV3:F_SECRETARIAT\" nom=\"SecrÃ©tariat\" droit=\"rvs\"/>");
		if($t ==  "ens" ) fputs ($ouverture, "<Fonction xsi:type=\"LEAV3:F_ENSEIGNEMENT\" nom=\"Enseignement\" droit=\"ens\"/>");
		if($t ==  "ma" ) fputs ($ouverture, "<Fonction xsi:type=\"LEAV3:F_SUIVIAPPRENTIS\" nom=\"Suivi des apprentis\" droit=\"ma\"/>");
	}
	if(ereg($id,$sr))fputs ($ouverture, "<Fonction xsi:type=\"LEAV3:F_SR\" nom=\"Conception du suivi\" droit=\"sr\"/>");
}
?>
