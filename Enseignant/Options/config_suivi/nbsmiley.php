<?php
require_once('../../secure.php');
if 		(file_exists("../../../config/config.inc.php")) require_once("../../../config/config.inc.php");
elseif 	(file_exists("../../config/config.inc.php"))  	require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  	require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      	require_once("./config/config.inc.php");

if(isset($_POST['nbsmileys']) && isset($_POST['nbvalue'])) {

	$nbsmiley = intval($_POST['nbsmileys']);
	$nbvalue =  intval($_POST['nbvalue']);
	if(isset($_SESSION['nb_smiley'])){
		if($nbsmiley != $_SESSION['nb_smiley']){
			unset($_SESSION['nb_smiley']);
			unset($_SESSION['bloc2']);
			unset($_SESSION['bloc4']);
			unset($_SESSION['bloc6']);
			unset($_SESSION['bloc8']);
		}
	}
	echo '<table>
		<tr>
			<th>Smiley</th>
			<th>D&eacute;but</th>
			<th>Fin</th>
		</tr>';
	switch($nbsmiley) {
		case 3 :
			for($i=0; $i < $nbsmiley; $i++) {
				echo '<tr>';
				for($j=0; $j < 3; $j++) {
					echo '<td>';
					switch($j) {
						case 0 :
							switch($i) {
								case 0 :
									echo '<img src="'.$LEA_URL.'lib/pdf/sad.jpg" width="25px" height="25px"/>';
									break;
								case 1 :
									echo '<img src="'.$LEA_URL.'lib/pdf/bof.jpg" width="25px" height="25px"/>';
									break;
								case 2 :
									echo '<img src="'.$LEA_URL.'lib/pdf/happy.jpg" width="25px" height="25px"/>';
									break;
							}
							break;
						case 1 :
							switch($i) {
								case 0:
									echo '<p id="bloc1">0</p>';
									break;
								case 1:
									if(isset($_SESSION['bloc2'])){
										echo '<p id="bloc3">'.($_SESSION['bloc2']+1).'</p>';
									} else{
										echo '<p id="bloc3">'.($nbvalue-3).'</p>';
									}
									break;
								case 2:
									if(isset($_SESSION['bloc4'])){
										echo '<p id="bloc5">'.($_SESSION['bloc4']+1).'</p>';
									} else{
										echo '<p id="bloc5">'.($nbvalue-1).'</p>';
									}
									break;
							}
							break;
						case 2 :
							switch($i) {
								case 0:
									echo '<select name="bloc2" id="bloc2" onchange="alignvalue(2,3)">';
									for($x=1; $x < $nbvalue-3; $x++) {
										if($x == $_SESSION['bloc2']){
											echo '<option value="'.$_SESSION['bloc2'].'" selected="selected" >'.$_SESSION['bloc2'].'</option>';
										} else{
											echo '<option value="'.$x.'">'.$x.'</option>';
										}
									}
									echo '</select>';
									break;
								case 1:
									echo '<select name="bloc4" id="bloc4" onchange="alignvalue(4,3)">';
									if(isset($_SESSION['bloc4'])){
										echo'<option>'.$_SESSION['bloc4'].'</option></select>';
									} else{
										echo'<option>'.($nbvalue-2).'</option></select>';
									}
										
									break;
								case 2:
									echo '<p id="bloc6">'.$nbvalue.'</p>';
									break;
							}
							break;
					}
					echo '</td>';
				}
				echo '</tr>';
			}
			
			break;
		case 4 :
			for($i=0; $i < $nbsmiley; $i++) {
				echo '<tr>';
				for($j=0; $j < 3; $j++) {
					echo '<td>';
					switch($j) {
						case 0 :
							switch($i) {
								case 0 :
									echo '<img src="'.$LEA_URL.'lib/pdf/sad.jpg" width="25px" height="25px"/>';
									break;
								case 1 :
									echo '<img src="'.$LEA_URL.'lib/pdf/grognon.jpg" width="25px" height="25px"/>';
									break;
								case 2 :
									echo '<img src="'.$LEA_URL.'lib/pdf/cool.jpg" width="25px" height="25px"/>';
									break;
								case 3 :
									echo '<img src="'.$LEA_URL.'lib/pdf/happy.jpg" width="25px" height="25px"/>';
									break;
							}
							break;
						case 1 :
							switch($i) {
								case 0:
									echo '<p id="bloc1">0</p>';
									break;
								case 1:
									if(isset($_SESSION['bloc2'])){
										echo '<p id="bloc3">'.($_SESSION['bloc2']+1).'</p>';
									} else{
										echo '<p id="bloc3">'.($nbvalue-5).'</p>';
									}
									break;
								case 2:
									if(isset($_SESSION['bloc4'])){
										echo '<p id="bloc5">'.($_SESSION['bloc4']+1).'</p>';
									} else{
										echo '<p id="bloc5">'.($nbvalue-3).'</p>';
									}
									break;
								case 3:
									if(isset($_SESSION['bloc6'])){
										echo '<p id="bloc7">'.($_SESSION['bloc6']+1).'</p>';
									} else{
										echo '<p id="bloc7">'.($nbvalue-1).'</p>';
									}
									break;
							}
							break;
						case 2 :
							switch($i) {
								case 0:
									echo '<select name="bloc2" id="bloc2" onchange="alignvalue(2,4)">';
									for($x=1; $x < $nbvalue-5; $x++) {
										if(isset($_SESSION['bloc2']) && $_SESSION['bloc2'] == $x){
											echo '<option value="'.$_SESSION['bloc2'].'" selected="selected">'.$_SESSION['bloc2'].'</option>';
										} else{
											echo '<option value="'.$x.'">'.$x.'</option>';
										}
									}
									echo '</select>';
									
									break;
								case 1:
									echo '<select name="bloc4" id="bloc4" onchange="alignvalue(4,4)">';
									if(isset($_SESSION['bloc4'])){
										echo'<option>'.$_SESSION['bloc4'].'</option></select>';
									} else{
										echo'<option>'.($nbvalue-4).'</option></select>';
									}
								
									break;
								case 2:
									echo '<select name="bloc6" id="bloc6" onchange="alignvalue(6,4)">';
									if(isset($_SESSION['bloc6'])){
										echo '<option>'.$_SESSION['bloc6'].'</option></select>';
									} else{
										echo '<option>'.($nbvalue-2).'</option></select>';
									}
									break;
								case 3:
									echo '<p id="bloc8">'.$nbvalue.'</p>';
									break;
							}
							break;
					}
					echo '</td>';
				}
				echo '</tr>';
			}
			break;
		case 5 :
			for($i=0; $i < $nbsmiley; $i++) {
				echo '<tr>';
				for($j=0; $j < 3; $j++) {
					echo '<td>';
					switch($j) {
						case 0 :
							switch($i) {
								case 0 :
									echo '<img src="'.$LEA_URL.'lib/pdf/sad.jpg" width="25px" height="25px"/>';
									break;
								case 1 :
									echo '<img src="'.$LEA_URL.'lib/pdf/grognon.jpg" width="25px" height="25px"/>';
									break;
								case 2 :
									echo '<img src="'.$LEA_URL.'lib/pdf/bof.jpg" width="25px" height="25px"/>';
									break;
								case 3 :
									echo '<img src="'.$LEA_URL.'lib/pdf/cool.jpg" width="25px" height="25px"/>';
									break;
								case 4 :
									echo '<img src="'.$LEA_URL.'lib/pdf/happy.jpg" width="25px" height="25px"/>';
									break;
							}
							break;
						case 1 :
							switch($i) {
								case 0:
									echo '<p id="bloc1">0</p>';
									break;
								case 1:
									if(isset($_SESSION['bloc2'])){
										echo '<p id="bloc3">'.($_SESSION['bloc2']+1).'</p>';
									} else{
										echo '<p id="bloc3">'.($nbvalue-7).'</p>';
									}
									break;
								case 2:
									if(isset($_SESSION['bloc4'])){
										echo '<p id="bloc5">'.($_SESSION['bloc4']+1).'</p>';
									} else{
										echo '<p id="bloc5">'.($nbvalue-5).'</p>';
									}
									break;
								case 3:
									if(isset($_SESSION['bloc6'])){
										echo '<p id="bloc7">'.($_SESSION['bloc6']+1).'</p>';
									} else{
										echo '<p id="bloc7">'.($nbvalue-3).'</p>';
									}
									break;
								case 4:
							if(isset($_SESSION['bloc8'])){
										echo '<p id="bloc9">'.($_SESSION['bloc8']+1).'</p>';
									} else{
										echo '<p id="bloc9">'.($nbvalue-1).'</p>';
									}
									break;
							}
							break;
						case 2 :
							switch($i) {
								case 0:
									echo '<select name="bloc2" id="bloc2" onchange="alignvalue(2,5)">';
									for($x=1; $x < $nbvalue-7; $x++) {
										if(isset($_SESSION['bloc2']) && $_SESSION['bloc2'] == $x){
											echo '<option value="'.$_SESSION['bloc2'].'" selected="selected">'.$_SESSION['bloc2'].'</option>';
										} else{
											echo '<option value="'.$x.'">'.$x.'</option>';
										}
									}
									echo '</select>';
									break;
								case 1:
									echo '<select name="bloc4" id="bloc4" onchange="alignvalue(4,5)">';
									if(isset($_SESSION['bloc4'])){
										echo'<option>'.$_SESSION['bloc4'].'</option></select>';
									} else{
										echo'<option>'.($nbvalue-6).'</option></select>';
									}
									break;
								case 2:
									echo '<select name="bloc6" id="bloc6" onchange="alignvalue(6,5)">';
									if(isset($_SESSION['bloc6'])){
										echo'<option>'.$_SESSION['bloc6'].'</option></select>';
									} else{
										echo'<option>'.($nbvalue-4).'</option></select>';
									}
									break;
								case 3:
									echo '<select name="bloc8" id="bloc8" onchange="alignvalue(8,5)">';
									if(isset($_SESSION['bloc8'])){
										echo'<option>'.$_SESSION['bloc8'].'</option></select>';
									} else{
										echo'<option>'.($nbvalue-2).'</option></select>';
									}
									break;
								case 4:
									echo '<p id="bloc10">'.$nbvalue.'</p>';
									break;
							}
							break;
					}
					echo '</td>';
				}
				echo '</tr>';
			}
			break;
	}
	echo '</table>';
	//echo '<input type="submit" value="Valider" />';
}
?>
