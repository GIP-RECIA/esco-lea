
<table width="100%" height="256" cellspacing="0">
  	<tr bgcolor="#FFCC33">
    	<td width="16%">
    		<img src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($_SESSION['options_lea']['LEA_LOGO_CFA'])) ?>"  height="120" />
    	</td>
		<td width="55%">
			<h1>Livret d'apprentissage </h1>
		</td>
		<td width="29%">
			<?php echo (to_html($unite->nom))."<br>".to_html($unite->adresse)."<br>Tel : ".to_html($unite->tel_fixe1)."<br>Tel : ".to_html($unite->tel_fixe2); ?>
		</td>
  	</tr>
  	<tr>
    	<td colspan="3" class="center" align="center">
			<h3><?php echo"$formation->nom"; ?></h3>			
			<img class="imgAccueil" src="<?php echo ($LEA_URL.'images/charte_graphique/'.urlencode($img_accueil) )?>" width="90%" />	
        </td>
   	</tr>
	<tr>
  		<td height="157" colspan="3" valign="bottom">
  			<table width="100%" height="141" border="0">
    			<tr>
            		<td width="42%" height="28">
            			<b> Nom : </b><?php echo"$apprenti->nom"; ?> 
            		</td>
					<td width="58%">
						<b> Pr&eacute;nom : </b><?php echo"$apprenti->prenom"; ?>
					</td>
				</tr>
				<tr>
	  				<td height="27" colspan="2">
	  					<b>Nom du <?php echo($config_lea->appelation_ma);?> : </b><?php echo"$maitre->nom &nbsp $maitre->prenom "; ?>
	  				</td>
				</tr>
				<tr>
  					<td height="32" colspan="2"> 
  						<b> Adresse : </b><?php echo"$maitre->adresse"; ?>
  					</td>
				</tr>
				<tr>
  					<td height="21" colspan="2">
  						<b> Contrat : </b> Du 10-10-2006 Au 09-10-2008
  					</td>
				</tr>
				<tr>
  					<td height="21" colspan="2">
  						<b> Nom du <?php echo($config_lea->appelation_tuteur_cfa);?> : </b> <?php echo"$tuteur_cfa->nom &nbsp $tuteur_cfa->prenom "; ?>
  					</td>
         		</tr>
       		</table>
       	</td>
  	</tr>
</table>
				