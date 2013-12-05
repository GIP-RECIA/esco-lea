<?php
/***********************************************************/
  // CFA des 3 villes
  // Web: www.cfa3villes.com.
    
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.1
  // Date: 04/04/07
/***********************************************************/
require_once('../secure.php');

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

/***********************************************************/
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
?>
<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/menu.js')?>"></script>
<script type="text/javascript" src="<?php echo($LEA_URL.'lib/xhr.class.js')?>"></script>
<script type="text/javascript">				
	function countsmiley() {
		var i = document.getElementById("nbsmiley").value;
		if(i!=0) {
			var ajax = new XHR();
			ajax.appendData('nbsmileys', i);
			ajax.appendData('nbvalue', '100');
			ajax.send('config_suivi/nbsmiley.php');
			ajax.complete = function (xhr) {
				actualiser('parametrage',xhr.responseText);
			}
		}
	}
	
	function loadsmiley(i) {
		if(i!=0) {
			var ajax = new XHR();
			var value = ''+i+'';
			ajax.appendData('nbsmileys', value);
			ajax.appendData('nbvalue', '100');
			ajax.send('config_suivi/nbsmiley.php');
			ajax.complete = function (xhr) {
				actualiser('parametrage',xhr.responseText);
			}
		}
	}
	
	function alignvalue(bloc, nbsmile) {
		var select = parseInt(document.getElementById("bloc"+bloc).value);
		for(var y = bloc+1; y <(nbsmile*2); y++) {
			if((y%2) != 0) {
				document.getElementById("bloc"+y).innerHTML = select+y-bloc;
			} else {
				var max = parseInt(document.getElementById("bloc"+(nbsmile*2)).innerHTML)-((nbsmile*2)-y);
				document.getElementById("bloc"+y).options.length = 0;
				for(var x = (select+y)-bloc; x<=max; x++) {
					if (x == (select+2)) {
						document.getElementById("bloc"+y).options[document.getElementById("bloc"+y).length] = new Option(x,x,true,true);
					} else {
						document.getElementById("bloc"+y).options[document.getElementById("bloc"+y).length] = new Option(x,x);
					}
				}
			}
		}
	}
</script>
<style type="text/css" media="screen">
	div#select_nb {
		margin: 10px;
		text-align: center;
	}
	div#parametrage {
		 text-align: center;
		 margin-right: auto; 
		 margin-left: auto;
		 width: 50%;
	}
	div#parametrage table tr td{
		 text-align: center;
	}
</style>
<div id="select_nb">
	Nombre de smiley :<select id="nbsmiley" onchange="countsmiley()">
		<?php
			echo '<option value="0">Nombre de smileys</option>';
			if(isset($_SESSION['nb_smiley']) && $_SESSION['nb_smiley'] == 3){
				echo '<option value="3" selected="selected" >3</option>';
			} else{
				echo '<option value="3">3</option>';
			}
			if(isset($_SESSION['nb_smiley']) && $_SESSION['nb_smiley'] == 4){
				echo '<option value="4" selected="selected" >4</option>';
			} else{
				echo '<option value="4">4</option>';
			}
			if(isset($_SESSION['nb_smiley']) && $_SESSION['nb_smiley'] == 5){
				echo '<option value="5" selected="selected" >5</option>';
			} else{
				echo '<option value="5">5</option>';
			}
		?>
	</select>
</div>
<div id="parametrage"></div>	