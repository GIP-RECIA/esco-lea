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
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
/***********************************************************/
$formation = new Formation($_SESSION['id_for']); // la formation sï¿½lectionnï¿½e.

$les_classes =  $formation->get_classes();
$config_lea	= $formation->get_config_lea();
	
if (isset($_REQUEST['id_cla'])) $id_cla_select = $_REQUEST['id_cla'];
else $id_cla_select = 'all';

if($id_cla_select != 'all') { // on  affiche que les apprentis de la classe sï¿½lectionnï¿½e
		$classe_select = new Classe($id_cla_select);
		$classe_select->set_detail();		
		$les_apprentis = $classe_select->get_apprentis(); // les identifiant des apprentis affectï¿½s ï¿½ cette classe
		if($id_cla_select != -1 && $classe_select->id_for != $formation->id_for) exit();
} else {
		$formation_select = new Formation($_SESSION['id_for']);		
		$les_apprentis = $formation_select->get_apprentis();		
}	
 ?>
<script type="text/javascript">
function select_all(ok, acteur){
	var nbchamps=document.forms['msgForm'].elements.length;
 
	for(i=0; i < nbchamps; i++) {
		if (document.forms['msgForm'].elements[i].name=="les_id_usager_dest[]" && document.forms['msgForm'].elements[i].alt== acteur) 
	        document.forms['msgForm'].elements[i].checked=ok;		  		
	}
}
</script>
<div id="top_l"></div>
<div id="top_m">
	<h1><span class="orange">L</span>es personnes &agrave; contacter</h1>
</div>
<div id="top_r"></div>
<div id="m_contenu">
	<form name="theForm" action=""  method="get">
		<div>
			<input type="hidden" name="cmd" value="contact_app" />
			<label><?php echo($config_lea->appelation_classe);?> :</label>
	     	<select name="id_cla" size="1" onChange='this.form.submit()' >
	        <?php		  
				foreach($les_classes as $classe){	
					if($classe->id_cla == $id_cla_select) $selected = "selected";
					else $selected = "";
	
					echo"<option value='$classe->id_cla' $selected > $classe->libelle </option>";
				} 
			?>
	        	<option value='all' <?php if($id_cla_select=='all') echo'selected'?> > 
	        		Toutes les <?php echo($config_lea->appelation_classe);?>s 
	        	</option>
	        </select>
		</div>
	</form>
	<?php if (count($les_apprentis) > 0) { ?>
	<form name="msgForm" action="../../administrateur/contact/ecrire_msg.php" method="post" target="_blank" >	
		<table width="97%">
			<tr>
			  	<th colspan="2" ><?php echo $config_lea->appelation_app ?></th>
			  	<th colspan="2">Son <?php echo $config_lea->appelation_tuteur_cfa ?></th>
	            <th colspan="2">Son <?php echo $config_lea->appelation_ma ?></th>
		   </tr>
			<?php 
				foreach($les_apprentis as $apprenti){
		        $maitre = new Maitre_apprentissage($apprenti->id_ma);
				$maitre->set_detail();							   
		        $enseignant = new Enseignant($apprenti->id_ens);
				$enseignant->set_detail();							   	
			?>	  
	   		<tr>
	   			<td width="2%">
					<input type="checkbox" name="les_id_usager_dest[]" value="<?php echo"$apprenti->id_app" ?>"  alt="app"  
						onClick="if(!this.checked) this.form.all_app.checked=false; " />
				</td>
	        	<td width="31%">
					<a href="../Apprentis/apprentis.php?cmd=cons_coordonnees_app&id_app_select=<?php echo"$apprenti->id_app" ?>">
						<?php echo"$apprenti->nom &nbsp;&nbsp;&nbsp;$apprenti->prenom"; ?>
					</a>			
				</td>        	
	        	<td width="2%">
					<?php if(trim($enseignant->nom) != "" ) { ?>	
						<input type="checkbox" name="les_id_usager_dest[]" value="<?php echo"$apprenti->id_ens" ?>" alt="ens" 
							onClick="if(!this.checked) this.form.all_ens.checked=false; " />
					<?php } ?>			
				</td>			
			    <td width="31%">
					<?php echo"$enseignant->nom &nbsp;&nbsp;&nbsp;$enseignant->prenom"; ?>
				</td>
			    <td width="2%">
					<?php if(trim($maitre->nom)) { ?>	
					<input type="checkbox" name="les_id_usager_dest[]" value="<?php echo"$apprenti->id_ma" ?>" alt="ma" 
						onClick="if(!this.checked) this.form.all_ma.checked=false; " />
					<?php } ?>	
				</td>
		        <td width="31%">
		        	<?php echo"$maitre->nom &nbsp;&nbsp;&nbsp;$maitre->prenom"; ?>
		        </td>
		    </tr>   		
			<?php } ?>
			<tr>	  
			    <th colspan="2">
				  	<a href="#" onClick="select_all(true,'app');return false;"> Tout cocher</a> /				
					<a href="#" onClick="select_all(false,'app');return false;"> Tout d&eacute;cocher</a>				
			    </th>
			    <th colspan="2">
					<a href="#" onClick="select_all(true,'ens');return false;">Tout cocher</a> /				
					<a href="#" onClick="select_all(false,'ens');return false;"> Tout d&eacute;cocher</a>			
				</th>
		      	<th colspan="2">
			  		<a href="#" onClick="select_all(true,'ma');return false;">Tout cocher</a> / 
				 	<a href="#" onClick="select_all(false,'ma');return false;"> Tout d&eacute;cocher</a>
				</th>
	        </tr>
			<tr>
			  	<td colspan="6">
	            	<input type="submit" name="Submit2" value="&Eacute;crire un message &agrave; la(aux) personne(s) s&eacute;lectionn&eacute;e(s)" />
			  	</td>
		  	</tr>	  
		</table>
	</form>
	<?php }elseif($id_cla_select!='-1') echo("<p>Aucun ".$config_lea->appelation_app." n'est affect&eactue; cette ".$config_lea->appelation_classe."</p>"); ?> 
</div>