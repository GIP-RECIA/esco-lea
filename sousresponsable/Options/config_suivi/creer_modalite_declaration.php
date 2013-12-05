<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: Script pemettant la crï¿½ation d'une modalitï¿½ de saisie pour un suivi libre en entreprise ou au CFA
/***********************************************************/
require_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_modalite_reponse_libre.php");
require_once ($LEA_REP."modele/bdd/classe_modalite_reponse_choix.php");
require_once ($LEA_REP."modele/bdd/classe_choix_reponse.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
/***********************************************************/
include("../../test_responsable.php");
include($LEA_REP.'espace_de_partage/aide.php');

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

if(isset($_REQUEST['type_suivi'])) $type_suivi = $_REQUEST['type_suivi'];
else exit();

$les_periodes = $formation->get_periodes($type_suivi);

if(isset($_REQUEST['acteur'])) $acteur = $_REQUEST['acteur'];
else  $acteur ="";

if(isset($_REQUEST['les_id_periode'])) $les_id_periode = $_REQUEST['les_id_periode'];
else  $les_id_periode = array();

if(isset($_REQUEST['libelle']) && isset($_REQUEST['valider']) ) {

	if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='champ_libre') {
		
		$modalite_reponse_libre = new Modalite_reponse_libre(0);
		$modalite_reponse_libre->libelle = to_sql($_REQUEST['libelle']);
		$modalite_reponse_libre->acteur = to_sql($_REQUEST['acteur']);
		$modalite_reponse_libre->type_suivi = $type_suivi;			
		$modalite_reponse_libre->id_config = $config_lea->id_config;
		$modalite_reponse_libre->insert();
		$modalite_reponse_libre->update_periodes($les_id_periode);
		echo"<script language='JavaScript'>window.opener.location.reload(); window.close();</script>";	
	}
	elseif (isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix'){
			
		if( isset($_REQUEST['type_choix']) &&
			isset($_REQUEST['reponses'])) {
			$modalite_reponse_choix = new Modalite_reponse_choix(0);
			$modalite_reponse_choix->libelle = to_sql($_REQUEST['libelle']);
			$modalite_reponse_choix->acteur = to_sql($_REQUEST['acteur']);
			$modalite_reponse_choix->type_suivi = $type_suivi;
			$modalite_reponse_choix->type_choix = to_sql($_REQUEST['type_choix']);
			$modalite_reponse_choix->id_config = $config_lea->id_config;
			$modalite_reponse_choix->insert(); 
			$modalite_reponse_choix->update_periodes($les_id_periode);
			
			foreach($_REQUEST['reponses'] as $reponse) {
				$rep = new Choix_reponse(0);
				$rep->reponse = to_sql($reponse);
				
				$rep->id_modalite = $modalite_reponse_choix->id_modalite;
				if($rep->reponse!='') $rep->insert();
			}
			echo"<script language='JavaScript'>window.opener.location.reload(); window.close();</script>";
		}	
	}
}
?>		

<html>
<head>
		<link rel="stylesheet" type="text/css" href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignantSuivi.css');?>" />
	<title>LEA : Modalit&eacute; de saisie</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/stdlib.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/mootools.js')?>"></script>
		<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>	
	<script language="JavaScript">
	function controleSaisie(theForm){   
			          
		if(testVide(theForm.libelle, "intitul&eacute; de la modalit&eacute;")== false) return false;           
	    
		if(theForm.type_reponse[0].checked == false && theForm.type_reponse[1].checked == false) { 
	   			alert("veuillez s&eacute;lectionner le type de la r&eacute;ponse attendue ");
	   			return false;
	   }
		if(theForm.nombre ) {
			if( !isNumeric(theForm.nombre.value) || theForm.nombre.value < 1    ) {	
				alert(theForm.nombre.value + " n'est pas un nombre valide  \n Veuillez saisir un nombre de choix superieur ï¿½ 1 ");	
				return false; 
			}	  
		} 
		return true; 
	}
	</script>		
</head>
<body>
<?php
		// Listes des boites d'aide
		// $fp_aide = fopen($LEA_URL."espace_de_partage/aide.csv","r"); 	
		for($i=0; $i<50; $i++) {
			$i_tmp = (strlen($i) == 1) ? "0".$i : $i;
			echo "
		<div id=\"aide_".$i_tmp."\" class=\"boxaide\" style=\"display:none\">
			".afficher_aide($i)."
		</div>";
		}
		//fclose($fp_aide);
		?>
<div id="contenu">
	<div id="top_l"></div>
	<div id="top_m">
		<h1>  
		<?php
			if ($type_suivi == "entr") {
				echo'<img src="'.$URL_THEME.'images/picto_suivi_entreprise.png">';
				echo"Nouvelle modalit&eacute; de saisie ";
			}else {
				echo'<img src="'.$URL_THEME.'images/picto_suivi_cfa.png">';
				echo"Nouvelle modalit&eacute; de saisie ";
			}
		?>
		</h1>
	</div>
	<div id="top_r"></div>
	<div id="m_contenu">
		<p><?php afficher_boutton_fermer(); ?></p>
	<form action="?" method="post" onSubmit="return controleSaisie(this)">
    	<input name="type_suivi" type="hidden" value="<?php echo"$type_suivi" ?>" >
    	<table width="99%" height="302" border="0" cellspacing="0">
      		<tr>
        		<td height="31" class="sous_titre_tableau">L'intitul&eacute; de la modalit&eacute; 
					<a href="#" onclick="lightbox('aide_15', '<?php echo $LEA_URL?>')">
						<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
					</a>
				</td>
				<td>
          			<input	name="libelle" type="text" size="60"
							value= "<?php if(isset($_REQUEST['libelle'])) echo(stripslashes($_REQUEST['libelle'])); ?>" >
        		</td>
     		</tr>
      		<tr>
        		<td height="32" class="sous_titre_tableau">Modalit&eacute; se valide par
					<a href="#" onclick="lightbox('aide_16', '<?php echo $LEA_URL?>')">
						<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
					</a>		 
				</td>
				<td>
				<?php
					$array_values = array(											 
						'app'			=> strtoupper($config_lea->appelation_app), 
						'tuteur_cfa' 	=> strtoupper($config_lea->appelation_tuteur_cfa),
						'ma'		  	=> strtoupper($config_lea->appelation_ma),
						'ens'			=> strtoupper($config_lea->appelation_ens),
						'rl'			=> strtoupper($config_lea->appelation_rl), 
						'rf'			=> strtoupper($config_term->terminologie_rf));
					$selected_value = (isset($_REQUEST['acteur']) ) ? $_REQUEST['acteur']:'app';
					$attr ='';
					$name= 'acteur';
					echo liste_deroulante ( $name , $array_values , $selected_value , $attr,  $multiple = 0 , $size = 1 );
				?>
				</td>
			</tr>
			<tr>
        		<td height="57" class="sous_titre_tableau">Modalit&eacute; se valide aux p&eacute;riodes suivantes
					<a href="#" onclick="lightbox('aide_17', '<?php echo $LEA_URL?>')">
						<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
					</a>
		  		</td>
        		<td class="cellule">
					<select name="les_id_periode[]" multiple size="5">
						<?php
							foreach($les_periodes as $periode ){
								if(in_array($periode->id_periode, $les_id_periode) ) $selected = "selected";
								else $selected = "";
								echo("<option value=\"$periode->id_periode\" $selected >". to_html($periode->libelle)."</option>");		
							}
						?>
					</select>
          			<p>Appuyer sur la touche CTRL pour s&eacute;lectionner plusieurs p&eacute;riodes</p>
        		</td>
      		</tr>
      		<tr>
        		<td width="36%" height="57" class="sous_titre_tableau">Pour la saisie des donn&eacute;es, Vous proposez</td>
        		<td width="64%" class="cellule">       
            		<input name="type_reponse" type="radio" value="champ_libre" onClick="this.form.submit()" 
						<?php if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='champ_libre') echo"checked";?>	>
          				Champ libre ( Zone de texte )
          			<input type="radio" name="type_reponse" value="liste_choix" onClick="this.form.submit()" 
			  			<?php if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix') echo"checked";?>	>
		          		Liste de choix (cases &agrave; cocher)
        		</td>
      		</tr>
      <?php if(isset($_REQUEST['type_reponse'])&& $_REQUEST['type_reponse']=='liste_choix') { ?>
      		<tr>
        		<td height="31" class="sous_titre_tableau">Nombre de choix &agrave; proposer
					<a href="#" onclick="lightbox('aide_19', '<?php echo $LEA_URL?>')">
						<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
					</a>
				</td>
        		<td class="cellule">
				<?php 
					if(isset($_REQUEST['nombre'])) {
						$nombre = $_REQUEST['nombre']; 
						echo"$nombre";
					}else {
						$nombre = 0;
						echo"<input name='nombre' type='text' size='4' value='$nombre'>";
					}
				?>
        		</td>
      		</tr>
      		<?php 	
      			if($nombre > 0 ) {
					echo '<tr>  <td >&nbsp;</td>';
			?>	
			<th >Liste des choix 
				<a href="#" onclick="lightbox('aide_20', '<?php echo $LEA_URL?>')">
					<img src="<?php echo $LEA_URL."themes/".$_SESSION['options_lea']['LEA_THEME']."/images/ico_aide.gif"; ?>" border="0" />
				</a>
			</th>
			<?php  
				echo' </tr>';	
				for($i = 1 ; $i <= $nombre; $i++ ) {
					echo" <tr> <td  class='sous_titre_tableau'> &nbsp;</td>
       					<td> choix $i : <input name='reponses[]' type='texte' size='60'></td></tr>";
				}
			?>
      		<tr>
        		<td height="32" class="sous_titre_tableau">Autorisez le choix</td>
        		<td class="cellule">
            		<input name="type_choix" type="radio" value="unique" checked>
          				Unique
					<a href="#" onclick="lightbox('aide_21', '<?php echo $LEA_URL?>')">
						<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
					</a>
          			<input type="radio" name="type_choix" value="multiple">
						Multiple 
					<a href="#" onclick="lightbox('aide_22', '<?php echo $LEA_URL?>')">
						<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/ico_aide.gif'); ?>" border="0" />
					</a>
        		</td>
      		</tr>
			<?php
				}
			}
			?>
  		</table>
  		<p>
		<?php 
			if(isset($_REQUEST['type_reponse']))echo"<input type='submit' name='valider' value='Valider'>";
		?>
		</p>
	</form>
	</div>
</div>
</body>
</html>


