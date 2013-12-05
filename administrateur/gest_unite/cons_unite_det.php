<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  // Contenu: ce script permet d'afficher toutes les coordonnï¿½es d'une unite donnï¿½e
/*******************************************************/
include_once("../secure.php");

require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
/*******************************************************/

if (isset($_REQUEST['id_unite'])) $id_unite = $_REQUEST['id_unite'];
else exit();

$unite = new Unite_pedagogique($id_unite);
$unite->set_detail();

?>		
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">C</span>onsulter : <?php echo $config_term->terminologie_unit_pedag; ?></h1>
</div>
<div id="top_r"></div>
<div id="m_contenu"> 
	<table border="0" cellpadding="0" cellspacing="0" >
    	<tr>
          	<th height="28" colspan="2">Informations</th>
       	</tr>
        <tr>
          	<td width="43%" height="18" >Nom</td>
          	<td width="57%" class="nom" ><?php echo to_html($unite->nom); ?></td>
        </tr>
        <tr>
          	<td height="59" >Adresse</td>
          	<td class="nom" ><?php echo to_html($unite->adresse); ?> </td>
        </tr>
        <tr>
          	<td height="20">T&eacute;l&eacute;phone 1</td>
            <td class="nom" ><?php echo $unite->tel_fixe1; ?></td>
        </tr>
        <tr>
          	<td height="18">T&eacute;l&eacute;phone 2 </td>
          	<td class="nom" ><?php echo $unite->tel_fixe2; ?></td>
        </tr>
        <tr>
          	<td height="24">Fax</td>
          	<td class="nom" ><?php echo $unite->fax; ?></td>
        </tr>
        <tr>
          	<td height="18">E-mail </td>
          	<td class="nom" ><?php echo $unite->email; ?></td>
        </tr>
        <tr>
          	<td height="18">Site web(url)</td>
          	<td class="nom" ><?php echo "<a href='".$unite->url_site."' target='_blank'>".$unite->url_site."</a>"; ?></td>
        </tr>
        <tr>
          	<th height="22" colspan="2" >Contact</th>
        </tr>
        <tr>
          	<td height="22">Nom</td>
          	<td class="nom" ><?php echo $unite->nom_contact; ?></td>
        </tr>
        <tr>
	        <td height="18">Pr&eacute;nom</td>
	        <td class="nom" ><?php echo $unite->prenom_contact; ?></td>
        </tr>
        <tr>
          	<th height="18" colspan="2"><?php echo $config_term->terminologie_rvs; ?></th>
        </tr>
        <tr>
	        <td height="18" >Nom / Pr&eacute;nom</td>
	        <td height="18" class='nom'>
	        <?php 
				$les_id_responsables = $unite->get_id_responsables(); 										 
					
				$liste_rvs = "
				<ul>"; // liste des responsables vie scolaire de cette unitï¿½
					 
			 	foreach($les_id_responsables as $id_rvs ){
			 		$rvs = new Usager($id_rvs);
					$rvs->set_detail();
					$liste_rvs .= "
					<li>
						<a href=\"../gest_usag/gest_usag.php?cmd=cons_coordonnees_usager&profil=ens&id_ens=".$rvs->id_usager."\">
							".$rvs->nom."&nbsp;&nbsp;".$rvs->prenom."
						</a>
					</li>";
			 	}
				$liste_rvs .= "
				</ul>";
				echo $liste_rvs;
			?>
            </td>
    	</tr>
	</table> 
    <?php
		echo"
	<img src='".$LEA_URL."images/b_edit.png'>
	<a href='gest_unite.php?cmd=modif_unite&id_unite=$unite->id_unite' class='txt_grand'>
		Modifier la fiche d'information
	</a>";
	?>
    <img src='../../images/b_browse.png'>
    <a href="<?php echo"gest_unite.php?cmd=cons_form&id_unite_select=$unite->id_unite" ?>"> 
    	Consulter <?php echo $config_term->terminologie_formation; ?> de ce ou cette <?php echo $config_term->terminologie_unit_pedag; ?> 
    </a>
</div>