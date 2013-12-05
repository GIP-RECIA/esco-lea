<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: 
/***********************************************************/
require_once("./secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("config/config.inc.php"))      require_once("config/config.inc.php");


require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_terminologie.php");
require_once ($LEA_REP."lib/stdlib.php");
$termino= new Terminologie();
$termino->set_detail();
/***********************************************************/
$bdd = new Connexion_BDD_LEA();
$sql="select dr_soumis from les_droits";
$res=$bdd->executer($sql);
$i=0;
//print_r($_POST);
while($ligne2 = mysql_fetch_assoc($res)){
if($i==0)$adm=$ligne2['dr_soumis'];
if($i==1)$rvs=$ligne2['dr_soumis'];
if($i==2)$ens=$ligne2['dr_soumis'];
if($i==3)$ma=$ligne2['dr_soumis'];
$i++;
}

$sql="Delete from les_droits";
$bdd->executer($sql);
if(isset($_REQUEST['droitadmin'])){
$ad=explode(",",$_REQUEST['droitadmin']);
$droitlinead=$ad[0];
for($i=1;$i<sizeof($ad);$i++){
$droitlinead=$droitlinead.",".$ad[$i];
}
$sql="INSERT INTO les_droits VALUES ('admin','$droitlinead')";
$bdd->executer($sql);
}else{
$droitlinead="admin";
$sql="INSERT INTO les_droits VALUES ('admin','admin')";
$bdd->executer($sql);
}
if(isset($_REQUEST['droitrvs'])){
$ad=explode(",",$_REQUEST['droitrvs']);
$droitlinervs=$ad[0];
for($i=1;$i<sizeof($ad);$i++){
$droitlinervs=$droitlinervs.",".$ad[$i];
}
$droitlinervs=reorganiser($droitlinervs,"rvs");
$sql="INSERT INTO les_droits VALUES ('rvs','$droitlinervs')";
$bdd->executer($sql);
}else{
$droitlinervs="";
$sql="INSERT INTO les_droits VALUES ('rvs','$droitlinervs')";
$bdd->executer($sql);

}
if(isset($_REQUEST['droitens'])){
$ad=explode(",",$_REQUEST['droitens']);
$droitlineens=$ad[0];
for($i=1;$i<sizeof($ad);$i++){
$droitlineens=$droitlineens.",".$ad[$i];
}
$droitlineens=reorganiser($droitlineens,"ens");
$sql="INSERT INTO les_droits VALUES ('ens','$droitlineens')";
$bdd->executer($sql);
}else{
$droitlineens="ens";
$sql="INSERT INTO les_droits VALUES ('ens','$droitlineens')";
$bdd->executer($sql);

}
if(isset($_REQUEST['droitma'])){
$ad=explode(",",$_REQUEST['droitma']);
$droitlinema=$ad[0];
for($i=1;$i<sizeof($ad);$i++){
$droitlinema=$droitlinema.",".$ad[$i];
}
$droitlinema=reorganiser($droitlinema,"ma");
$sql="INSERT INTO les_droits VALUES ('ma','$droitlinema')";
$bdd->executer($sql);
}else{
$droitlinema="ma";
$sql="INSERT INTO les_droits VALUES ('ma','$droitlinema')";
$bdd->executer($sql);

}
$sql="select * from les_usagers";
$result=$bdd->executer($sql);
while($ligne = mysql_fetch_assoc($result)){
$id=$ligne['id_usager'];
if($ligne['profil']==$adm){
$sql="update les_usagers set profil='$droitlinead' where id_usager='$id'";
$bdd->executer($sql);
}
else if($ligne['profil']==$rvs){
$sql="update les_usagers set profil='$droitlinervs' where id_usager='$id'";
$bdd->executer($sql);
}
else if($ligne['profil']==$ens){
$sql="update les_usagers set profil='$droitlineens' where id_usager='$id'";
$bdd->executer($sql);
}
else if($ligne['profil']==$ma){
$sql="update les_usagers set profil='$droitlinema' where id_usager='$id'";
$bdd->executer($sql);
}
else if($ligne['profil']==$adm.",sr"){
$sql="update les_usagers set profil='$droitlinead,sr' where id_usager='$id'";
$bdd->executer($sql);
}
else if($ligne['profil']==$rvs.",sr"){
$sql="update les_usagers set profil='$droitlinervs,sr' where id_usager='$id'";
$bdd->executer($sql);
}
else if($ligne['profil']==$ens.",sr"){
$sql="update les_usagers set profil='$droitlineens,sr' where id_usager='$id'";
$bdd->executer($sql);
}
else if($ligne['profil']==$ma.",sr"){
$sql="update les_usagers set profil='$droitlinema,sr' where id_usager='$id'";
$bdd->executer($sql);
}
else{
$tok = strtok($ligne['profil'],",");
$profil=$tok;
if($profil=='admin')$profil=$droitlinead;
else if($profil=='rvs')$profil=$droitlinervs;
else if($profil=='ens')$profil=$droitlineens;
else if($profil=='ma')$profil=$droitlinema;
$tok = strtok(",");
	while ($tok != false) {
		if(!ereg($tok,$profil))$profil=$profil.",".$tok;
		$tok = strtok(",");
		} 
$id=$ligne['id_usager'];
$sql="update les_usagers set profil='$profil' where id_usager='$id'";
$bdd->executer($sql);

}

}
$sql="select id_usager,profil from les_usagers";
$result=$bdd->executer($sql);
while($ligne = mysql_fetch_assoc($result)){
$prof=$ligne['profil'];
$id=$ligne['id_usager'];

if(ereg("ens",$prof)){
$sql2="select * from les_enseignants where id_ens='$id'";
$res=$bdd->executer($sql2);
if (mysql_num_rows($res)==0){
$s="INSERT INTO les_enseignants VALUES ('$id','')";
$bdd->executer($s);
}

}
else{
$s="Delete from les_enseignants where id_ens='$id'";
$bdd->executer($s);
$sql="update les_formations set id_ens='' where id_ens='$id'";
$bdd->executer($sql);
$sql="delete from les_enseignants_formations where id_ens='$id'";
$bdd->executer($sql);
}
if(ereg("ma",$prof)){
$sql2="select * from les_maitres_apprentissage where id_ma='$id'";
$res=$bdd->executer($sql2);

if (mysql_num_rows($res)==0){
$s="INSERT INTO les_maitres_apprentissage VALUES ('$id','')";
$bdd->executer($s);
}

}else{

$s="Delete from les_maitres_apprentissage where id_ma='$id'";
$bdd->executer($s);


}

}
if($_REQUEST['supp_unit_pedag']=="false"){
$sql="insert into les_unites_pedagogiques values ('','default','','','','','','','','')";
$bdd->executer($sql);
$sql="select id_unite from les_unites_pedagogiques where nom='default'";
$result=$bdd->executer($sql);
if ($ligne = mysql_fetch_assoc($result)) {
$id=$ligne['id_unite'];
}
$sql="update les_formations set id_unite='$id'";
$bdd->executer($sql);
$sql="SELECT id_rvs, COUNT( id_rvs ) FROM `les_responsables_unites_pedagogiques` GROUP BY id_rvs";
$resul=$bdd->executer($sql);
while($ligne=mysql_fetch_assoc($resul)){
if($ligne['COUNT( id_rvs )']>1){
echo "yes";
$id=$ligne['id_rvs'];
$sql="delete from les_responsables_unites_pedagogiques where id_rvs='$id' LIMIT 1";
$bdd->executer($sql);
}

}
$sql="update les_responsables_unites_pedagogiques set id_unite='$id'";
$bdd->executer($sql);
$sql="delete from les_unites_pedagogiques where id_unite!='$id'";
$bdd->executer($sql);
$sql="insert into les_droits values ('unite_peda','false')";
$bdd->executer($sql);
}else{
$sql="insert into les_droits values ('unite_peda','true')";
$bdd->executer($sql);
}

if($_REQUEST['supp_suivi_entr']=="false"){
$sql="insert into les_droits values ('supp_suivi_entr','false')";
$bdd->executer($sql);
}else{
$sql="insert into les_droits values ('supp_suivi_entr','true')";
$bdd->executer($sql);
}
if($_REQUEST['supp_rl']=="false"){
$sql="insert into les_droits values ('parent','false')";
$bdd->executer($sql);
$sql="delete from les_usagers where profil='rl'";
$bdd->executer($sql);
}else{
$sql="insert into les_droits values ('parent','true')";
$bdd->executer($sql);
}

if(isset($_REQUEST['droitsr'])){
$drsr=$_REQUEST['droitsr'];
$sql="insert into les_droits values ('sr','$drsr')";
$bdd->executer($sql);
}


if(isset($_REQUEST['term_admin']))$termino->terminologie_admin = $_REQUEST['term_admin'];
if(isset($_REQUEST['term_rvs']))$termino->terminologie_rvs = $_REQUEST['term_rvs'];
if(isset($_REQUEST['term_rf']))$termino->terminologie_rf = $_REQUEST['term_rf'];
if(isset($_REQUEST['term_ens']))$termino->terminologie_ens = $_REQUEST['term_ens'];
if(isset($_REQUEST['term_tuteur_cfa']))$termino->terminologie_tuteur_cfa = $_REQUEST['term_tuteur_cfa'];
if(isset($_REQUEST['term_ma']))$termino->terminologie_ma = $_REQUEST['term_ma'];
if(isset($_REQUEST['term_rl']))$termino->terminologie_rl = $_REQUEST['term_rl'];
if(isset($_REQUEST['term_app']))$termino->terminologie_app = $_REQUEST['term_app'];
if(isset($_REQUEST['term_lea']))$termino->terminologie_lea = $_REQUEST['term_lea'];
if(isset($_REQUEST['term_cfa']))$termino->terminologie_cfa = $_REQUEST['term_cfa'];
if(isset($_REQUEST['term_entr']))$termino->terminologie_entr = $_REQUEST['term_entr'];
if(isset($_REQUEST['term_unit_pedag']))$termino->terminologie_unit_pedag = $_REQUEST['term_unit_pedag'];
if(isset($_REQUEST['term_formation']))$termino->terminologie_formation = $_REQUEST['term_formation'];
if(isset($_REQUEST['term_classe']))$termino->terminologie_classe = $_REQUEST['term_classe'];
if(isset($_REQUEST['term_suivi_cfa']))$termino->terminologie_suivi_cfa = $_REQUEST['term_suivi_cfa'];
if(isset($_REQUEST['term_suivi_entr']))$termino->terminologie_suivi_entr = $_REQUEST['term_suivi_entr'];

$termino->update();

html_refresh("options/terminologie.php");


function reorganiser($tout,$truc){
if(ereg($truc,$tout)){
$retour=$truc;
$tok = strtok($tout,",");
while ($tok != false) {
	if($tok!=$truc)$retour=$retour.','.$tok;
	$tok = strtok(",");
	} 		
return $retour;
}

}

?>		
