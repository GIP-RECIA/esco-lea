<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
include("../secure.php");
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

/***********************************************************/	
$bdd= new Connexion_BDD_LEA();
if (isset($_REQUEST['profil'])) $profil=$_REQUEST['profil']; // le profil de l'usager qu'on veut ajouter ou modifier
else $profil="";

if(isset($_REQUEST['action'])) $action=$_REQUEST['action']; // l'action demandï¿½e : mofier ou ajouter un nouvel usager
else $action="";

if($action!="modif"){
$login = to_sql($_REQUEST['login']);
$sql="select login from les_usagers where login='$login'";
$res=$bdd->executer($sql);
if(mysql_num_rows($res)>0){
echo " le login existe dÃ©jÃ  ";
exit();
}
}

if ($action=="modif") $id_usager=$_REQUEST['id_usager'];
else $id_usager=0;

switch($profil){

case "app": $usager = new Apprenti($id_usager); // on crï¿½e un nouvel usager de type  apprenti
            $usager->set_detail();
			$old_src_photo = $usager->src_photo;
			break;			
case "ens": $usager = new Enseignant($id_usager); // on crï¿½e un nouvel usager de type  enseignant
			$usager->set_detail();
			break;
case "ma": $usager = new Maitre_apprentissage($id_usager); // on crï¿½e un nouvel usager de type  maitre d'apprentissage
			$usager->set_detail();
			break;			
case "rl": $usager = new Representant_legal($id_usager); // on crï¿½e un nouvel usager de type  reprï¿½sentant lï¿½gal
			$usager->set_detail();
			break;
default		: break;

}

if ( $profil=="app" || $profil=="ens" || $profil=="ma" || $profil=="rl" || $profil=="rvs" || $profil=="admin" ){
				
			$usager->civilite = to_sql($_REQUEST['civilite']);
			$usager->nom = to_sql($_REQUEST['nom']);
			$usager->prenom = to_sql($_REQUEST['prenom']);
			$usager->adresse = to_sql($_REQUEST['adresse']);
			$usager->tel_fixe = to_sql($_REQUEST['tel_fixe']);
			$usager->tel_mobile = to_sql($_REQUEST['tel_mobile']);
			$usager->email = to_sql($_REQUEST['email']);
			$usager->url_site = to_sql($_REQUEST['url_site']);	
			$sql="SELECT * from les_droits where id_droit='$profil'";
			$result=$bdd->executer($sql);
			if(isset($_REQUEST['droit']))$les_droits=$_REQUEST['droit'];
			else $les_droits[0]="";
			if(ereg("ens",$les_droits[0]))$dd="ens";
			else if(ereg("ma",$les_droits[0]))$dd="ma";
			else $dd="";
			if($action!="modif"){
			while($ligne = mysql_fetch_assoc($result)){
				if($dd!=""){
				if(!ereg($dd,$ligne['dr_soumis'])){
				if($dd=="ens"){$usager=new Enseignant($id_usager);
				$usager->civilite = to_sql($_REQUEST['civilite']);
				$usager->nom = to_sql($_REQUEST['nom']);
				$usager->prenom = to_sql($_REQUEST['prenom']);
				$usager->adresse = to_sql($_REQUEST['adresse']);
				$usager->tel_fixe = to_sql($_REQUEST['tel_fixe']);
				$usager->tel_mobile = to_sql($_REQUEST['tel_mobile']);
				$usager->email = to_sql($_REQUEST['email']);
				$usager->url_site = to_sql($_REQUEST['url_site']);}
				$usager->profil=$ligne['dr_soumis'].','.$dd;
				if($dd=="ens"){$usager->insert();
				$action="modif";
				$id_usager=$usager->id_usager;}
				}else $usager->profil=$ligne['dr_soumis'];
				}
				else $usager->profil=$ligne['dr_soumis'];
			}
			if($profil=="rl"||$profil=="app"){
				$usager->profil=$profil;
			}
			}else{
			$sql="select dr_soumis from les_droits where id_droit='$profil'";
			$result=$bdd->executer($sql);
				while($ligne = mysql_fetch_assoc($result)){
					$profil=$ligne['dr_soumis'];
				}
					if($dd!=""){
						if(!ereg($dd,$profil)){
						$usager->profil=$profil.','.$dd;
						if($dd=="ens"){$sql="insert into les_enseignants values('$id_usager','')";
						$bdd->executer($sql);}
						}else $usager->profil=$profil;
						}
					else $usager->profil=$profil;
			if($dd!="ens" and !ereg("ens",$profil)){
			$sql="update les_formations set id_ens='' where id_ens='$id_usager'";
			$bdd->executer($sql);
			$sql="delete from les_enseignants_formations where id_ens='$id_usager'";
			$bdd->executer($sql);
			$sql="delete from les_enseignants where id_ens='$id_usager'";
			$bdd->executer($sql);
			}
			}
			if($usager->nom !="") $lettre = $usager->nom{0}; // la premiï¿½re lettre du nom
			
}															

switch($profil){

case "app": 			
			$usager->login = to_sql($_REQUEST['login']);
			$usager->mdp = to_sql($_REQUEST['mdp']);
			$usager->date_nais = trans_date($_REQUEST['date_nais']);
			$usager->no_insc = to_sql($_REQUEST['no_insc']);
			$usager->no_secu = to_sql($_REQUEST['no_secu']);
			$usager->dern_classe_freq = to_sql($_REQUEST['dern_classe_freq']);
			$usager->diplomes_obtenus = to_sql($_REQUEST['diplomes_obtenus']);
			$usager->adresse_perso = to_sql($_REQUEST['adresse_perso']);
			$usager->tel_perso = to_sql($_REQUEST['tel_perso']);
			$usager->email_perso = to_sql($_REQUEST['email_perso']);
			$usager->date_debut_contrat = trans_date($_REQUEST['date_debut_contrat']);
			$usager->date_fin_contrat = trans_date($_REQUEST['date_fin_contrat']);
			$usager->id_cla = to_sql($_REQUEST['id_cla']); // l'identifiant de la classe de l'apprenti
			$usager->id_ens = to_sql($_REQUEST['id_ens']); 
			$usager->id_ma = to_sql($_REQUEST['id_ma']); 
			$usager->id_rl = to_sql($_REQUEST['id_rl']); 

			$src=$_FILES['src_photo']['tmp_name']; 
			$nom=$_FILES['src_photo']['name']; // le nom de la photo telechargï¿½
		
   			$repertoireDestination = "../../Apprenti/Photos/";
              
			  		
			   $filename = "$repertoireDestination"."$old_src_photo";
			   			
			if (file_exists($filename)&& $old_src_photo!="" && $nom!="") {
				unlink($filename);
			}   
				$dest = "";  
				          				
				$nb = date("dmy-His"); 
     		    if ($nom!="") $dest = "photo_".$nb.".".get_extension($nom);  				
										
		     if  (move_uploaded_file($src, $repertoireDestination.$dest)) 			 			 
			 $usager->src_photo = to_sql($dest);			 			 																									
																					
			if($action == "modif") 
					$usager->update();			
			
			else    $usager->insert(); 		
			
			html_refresh("gest_usag.php?cmd=cons_liste_app&id_cla=$usager->id_cla");			
			break;

case "ens": 			
			$usager->discipline = to_sql($_REQUEST['discipline']);
							
			
			if($action=="modif") $usager->update(); 
			else {
					$usager->login = addslashes(create_login(2, "$usager->prenom $usager->nom"));
					$usager->mdp = addslashes(create_mdp(2));					
					$usager->insert();						
			}		
			 			
			html_refresh("gest_usag.php?cmd=cons_liste_ens&lettre=$lettre");
			break;
			
case "ma":  
			$usager->id_entr = to_sql($_REQUEST['id_entr']);

			if($action == "modif") 
				 $usager->update(); 
			else {
					$usager->login = addslashes(create_login(2, "$usager->prenom $usager->nom"));
					$usager->mdp = addslashes(create_mdp(2));
					$usager->insert(); 
			}		
			
			html_refresh("gest_usag.php?cmd=cons_liste_ma&lettre=$lettre");
			break;
			
case "rl":  
				
				$usager->profession = to_sql($_REQUEST['profession']);
				$usager->adresse_prof = to_sql($_REQUEST['adresse_prof']);
						
			if($action == "modif") 
					$usager->update(); 
			else {
				$usager->login = addslashes(create_login(2, "$usager->prenom $usager->nom"));
				$usager->mdp = addslashes(create_mdp(2));
				$usager->insert(); 
				
			}	
			
			html_refresh("gest_usag.php?cmd=cons_liste_rl&lettre=$lettre");			
			break;

default     : 
			break;			
}


 ?>		