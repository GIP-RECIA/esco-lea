<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 15/12/05

/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
/***********************************************************/

if (isset($_SESSION['id_admin'])) { 
		$id_usager=$_SESSION['id_admin'];
		$href_det_msg="../../administrateur/contact/contact.php";
}		
elseif (isset($_SESSION['id_ens'])){
	$id_usager=$_SESSION['id_ens'];
	$href_det_msg="../../Enseignant/Contact/contact.php";
}	
elseif (isset($_SESSION['id_app'])) {
	$id_usager=$_SESSION['id_app'];
	$href_det_msg="../../Apprenti/Contact/contact.php";
}	 
elseif (isset($_SESSION['id_ma'])){
	$id_usager=$_SESSION['id_ma'];
	$href_det_msg="../../Maitre_apprentissage/Contact/contact.php";
}	 
elseif (isset($_SESSION['id_rl'])) {
	$id_usager=$_SESSION['id_rl'];
	$href_det_msg="../../Representant_legal/Contact/contact.php";
}
elseif (isset($_SESSION['id_rvs'])) {
	$id_usager=$_SESSION['id_rvs'];
	$href_det_msg="../../Responsable_vie_scolaire/Contact/contact.php";
}	 		 
else html_refresh($LEA_URL);

if (isset($_REQUEST['page']) && $_REQUEST['page'] >0 ) $page=$_REQUEST['page']; // le numï¿½ro de page ï¿½ afficher
else $page=1;

$pos=($page-1)*$PLAGE;	 // la varible PLAGE est dï¿½finie dans le fichier de configuration config.inc.php

$usager=new Usager($id_usager);
$les_messages=$usager->get_messages_recus($pos,$PLAGE);
		
$nb=$usager->get_nb_messages_recus(); 
		   
         $string_pages=get_string_pages($page, $href_det_msg."?cmd=cons_msg", $nb, $PLAGE );
		 								 
if(!isset($les_messages) && $page >1) {
	$page=1;
	html_refresh($href_det_msg."?cmd=cons_msg&page=".$page);
}	

?>
<script language="JavaScript">

function selection_message( value, checked){

 if (window.document.getElementById){	
	
	if (checked==true) 
		document.getElementById(value).className='cellule';
		
	else document.getElementById(value).className=''; 
 }	
 
}

function supprimer_msg(){

 var nbchamps=document.forms['suppForm'].elements.length;
 
	 for(i=0;i<nbchamps;i++) {
	    if ((document.forms['suppForm'].elements[i].name=="les_id_msg[]")&& 
           (document.forms['suppForm'].elements[i].checked) ){
		   return deleteConfirm('ses messages');
		}
 	}
	
	alert("Aucun message n'est s&eacute;lectionn&eacute;"); return false
}

function select_all(ok){

 var nbchamps=document.forms['suppForm'].elements.length;
 
	 for(i=0;i<nbchamps;i++) {
	    if (document.forms['suppForm'].elements[i].name=="les_id_msg[]") 
          document.forms['suppForm'].elements[i].checked=ok;		  		
 	 }	
}
</script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">M</span>essages re&ccedil;us</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
<form name="suppForm" action="<?php echo($LEA_URL.'administrateur/contact/supp_msg.php') ?>" method="post" onsubmit="return supprimer_msg();">
<?php 		
	if(isset($les_messages)) {
?>
<table>
	<tr>
		<th width="38">&nbsp;</th>
		<th width="233">Exp&eacute;diteur</th>
		<th width="122">Objet</th>
		<th width="33">Date</th>
	</tr>
	<?php 
		foreach ($les_messages as $msg) {
			$expediteur = new Usager($msg->id_usager);
			$expediteur->set_detail();
		
	?>		
	<tr id="<?php echo"$msg->id_msg"?>" >
		<td>
			<input type="checkbox" name="les_id_msg[]" value="<?php echo"$msg->id_msg" ?>" onclick="selection_message(this.value, this.checked);" />
		</td>
		<td>			
			<?php 
				if( $msg->reponse=="OUI") echo"<img src=\"".$URL_THEME."images/reply.gif\" alt=\"Vous avez r&eacute;pondu &agrave; ce message\" />";
				else echo"&nbsp;";
				echo ( to_html( $expediteur->nom)."&nbsp;". to_html($expediteur->prenom) );
			?>
		</td>
		<td>
			<a href="<?php echo"$href_det_msg?cmd=cons_msg_det&id_msg=$msg->id_msg"?>" title="<?php echo(substr($msg->message,0,200)." ...") ?>">
			<?php 
				if($msg->lecture=="NON") echo "<strong>". to_html($msg->objet)."</strong>";
					else echo(to_html($msg->objet) );
			?>
			</a>
		</td>
		<td><?php echo ( trans_date_time ($msg->date_creation) ); ?></td>
	</tr>
        
<?php } // fin foreach ?>    
	<tr id="<?php echo( to_html($msg->id_msg) )?>" >
		<td><?php echo"<img src=\"".$URL_THEME."images/arrow_ltr.png\"/>"; ?></td>
		<td colspan="2">
			<a href="#" onclick="select_all(true); return false;">Tout cocher</a> / <a href="#" onclick="select_all(false); return false;">Tout d&eacute;cocher </a> pour la s&eacute;lection :
			<input type="submit" name="Submit2" value="Supprimer" />
		</td>
	 </tr>   
</table>
<?php 
	echo" $string_pages ";
	}elseif($page==1) echo"<p>Vous n'avez aucun message</p>"; 	  
?>
</form>
</div>