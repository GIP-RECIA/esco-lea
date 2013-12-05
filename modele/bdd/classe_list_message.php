<?php
/***********************************************************/
  // Copyright ? 2008 
  // Auteur : Samzun jérémy
  // Version : 1.0
  // Date: 21/04/08
  //a mettre dans modele/bdd/
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");


require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_usager.php");

class ListeMessage{

	var $id_usager;
	var $bdd;

	function ListeMessage($id_usager) {
        $this->id_usager = $id_usager; 
		$this->bdd = new Connexion_BDD_LEA();
    }
	
	function getListeMessage(){
	  $sql="SELECT id_msg
				 FROM  les_messages_recus_usagers
				 WHERE id_usager='$this->id_usager'";	   		   
			
			$result = $this->bdd->executer($sql);				
			
			$les_id_msg = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
						
			 $les_id_msg[] = $ligne['id_msg'];				
			}
			
			mysql_free_result($result);
			
			return $les_id_msg;	
	
	
	}
	function getMessage($id_msg){
		$sql="Select * from les_messages where id_msg='$id_msg'";
		$mes = new Message($id_msg);
		$mes->set_detail();
		return $mes;
	
	}
	function getListeMessageRempli(){
			$sql="SELECT id_msg
				 FROM  les_messages_recus_usagers
				 WHERE id_usager='$this->id_usager'";	   		   
			
			$result = $this->bdd->executer($sql);				
			
			$les_msg = array();
			
			while ($ligne = mysql_fetch_assoc($result)) {
			$tempmes= new Message($ligne['id_msg']);
			$tempmes->set_detail();
			 $les_msg[] = $tempmes;				
			}
			
			mysql_free_result($result);
			return $les_msg;
	}
	
	function getMessagesEnvoiRempli()
	{
			$sql = "SELECT id_msg FROM les_messages WHERE id_usager='$this->id_usager'";
			$result = $this->bdd->executer($sql);
			
			$les_msg = array();
			
			while ($ligne = mysql_fetch_assoc($result))
			{
				$tempmes = new Message($ligne['id_msg']);
				$tempmes->set_detail();
				$les_msg[] = $tempmes;				
			}
			
			mysql_free_result($result);
			return $les_msg;
	}
	
	function getDossier($id_usager){
		$sql="SELECT dossier FROM les_messages WHERE id_usager = '$id_usager' AND nature = 'dossier' GROUP BY dossier";
		$result = $this->bdd->executer($sql);
		
		$les_dossier = array();
		while ($ligne = mysql_fetch_assoc($result)) {
		if ($ligne['dossier'] != '')
			$les_dossier[] = $ligne['dossier'];				
		}
		
		mysql_free_result($result);
		return $les_dossier;
	}
	
	function getFavoris($profil)
	{
		$id_usager = $this->id_usager;
		$bdd = $this->bdd;
		switch ($profil){
		case 'app' : $sql="select id_ma,id_ens,id_rl from les_apprentis where id_app='$id_usager'";
						$result=$bdd->executer($sql);
						$les_profils = array();
				
								while ($ligne = mysql_fetch_assoc($result)) {
									$tempprof= new Usager($ligne['id_ma']);
									$tempprof->set_detail();
									$les_profils[] = $tempprof;		
									$tempprof= new Usager($ligne['id_ens']);
									$tempprof->set_detail();
									$les_profils[] = $tempprof;		
									$tempprof= new Usager($ligne['id_rl']);
									$tempprof->set_detail();
									$les_profils[] = $tempprof;										
								}			 
							mysql_free_result($result);
							return $les_profils;
							break;
		case 'rl' : $sql="select id_app from les_apprentis where id_rl='$id_usager'";
		$result=$bdd->executer($sql);
						$les_profils = array();
				
								while ($ligne = mysql_fetch_assoc($result)) {
									$tempprof= new Usager($ligne['id_app']);
									$tempprof->set_detail();
									$les_profils[] = $tempprof;									
								}			 
							mysql_free_result($result);
							return $les_profils;
							break;
		case 'ma' :$sql="select id_app from les_apprentis where id_ma='$id_usager'";
						$result=$bdd->executer($sql);
						$les_profils = array();
				
								while ($ligne = mysql_fetch_assoc($result)) {
									$tempprof= new Usager($ligne['id_app']);
									$tempprof->set_detail();
									$les_profils[] = $tempprof;									
								}			 
							mysql_free_result($result);
							return $les_profils;
							break;
		case 'rvs' : $sql="select id_unite from les_responsables_unites_pedagogiques where id_rvs='$id_usager'";
					$result=$bdd->executer($sql);
					while ($ligne = mysql_fetch_assoc($result)) {
						$id_unite=$ligne['id_unite'];
					}
					$sql="select id_ens from les_formations where id_unite='$id_unite'";
					$result=$bdd->executer($sql);
						$les_profils = array();
				
								while ($ligne = mysql_fetch_assoc($result)) {
									$tempprof= new Usager($ligne['id_ens']);
									$tempprof->set_detail();
									$les_profils[] = $tempprof;									
								}			 
							mysql_free_result($result);
					$sql="select id_for from les_formations where id_unite='$id_unite'";
					$result=$bdd->executer($sql);
								while ($ligne = mysql_fetch_assoc($result)) {
									$id_for=$ligne['id_for'];
									$sql2="select id_ens from les_enseignants_formations where id_for='$id_for'";
									$result2=$bdd->executer($sql);
										while ($ligne2 = mysql_fetch_assoc($result)) {
											$tempprof= new Usager($ligne2['id_ens']);
											$tempprof->set_detail();
											$les_profils[] = $tempprof;		
										}
									mysql_free_result($result2);
									$sql2="select id_usager from les_sous_resp where id_for='$id_for'";
									$result2=$bdd->executer($sql);
										while ($ligne2 = mysql_fetch_assoc($result)) {
											$tempprof= new Usager($ligne2['id_usager']);
											$tempprof->set_detail();
											$les_profils[] = $tempprof;		
										}	
									mysql_free_result($result2);								
								}			 
							mysql_free_result($result);
							return $les_profils;
							break;
		case 'admin':$sql="SELECT id_ens from les_formations";
						$result=$bdd->executer($sql);
						$les_profils = array();
				
								while ($ligne = mysql_fetch_assoc($result)) {
									$tempprof= new Usager($ligne['id_ens']);
									$tempprof->set_detail();
									$les_profils[] = $tempprof;									
								}			 
						mysql_free_result($result);
						$sql="SELECT id_rvs from les_responsables_unites_pedagogiques";
						$result=$bdd->executer($sql);
						while ($ligne = mysql_fetch_assoc($result)) {
									$tempprof= new Usager($ligne['id_rvs']);
									$tempprof->set_detail();
									$les_profils[] = $tempprof;									
						}
							mysql_free_result($result);
							return $les_profils;
							break;					
		}
	}
}
?>