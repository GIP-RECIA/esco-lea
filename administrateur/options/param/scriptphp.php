<?php
$sql="select * from les_droits";
$result=$bdd->executer($sql);
$droitadmin="";
$droitrvs="";
$droitens="";
$droitma="";
$sr="";
$unite="";
$suivi="";
$parent="";
while($ligne=mysql_fetch_assoc($result)){
if($ligne['id_droit']=="admin")$droitadmin=$ligne['dr_soumis'];
if($ligne['id_droit']=="rvs")$droitrvs=$ligne['dr_soumis'];
if($ligne['id_droit']=="ens")$droitens=$ligne['dr_soumis'];
if($ligne['id_droit']=="ma")$droitma=$ligne['dr_soumis'];
if($ligne['id_droit']=="sr")$sr=$ligne['dr_soumis'];
if($ligne['id_droit']=="unite_peda")$unite=$ligne['dr_soumis'];
if($ligne['id_droit']=="suivi_entr")$suivi=$ligne['dr_soumis'];
if($ligne['id_droit']=="parent")$parent=$ligne['dr_soumis'];

}
?>
