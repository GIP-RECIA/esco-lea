<?php  if(!isset($_REQUEST['imprimer'])) { ?>
<script type="text/javascript" src="<?php echo($LEA_URL.'javascript/lightbox.js')?>"></script>
<div id="footer">
   <div id="creditTexte">
	  <div id="texteFooter" >
	  	<div style="float:left">
	  		<img id="creditLogo" src="<?php echo($LEA_URL.'images/dialog-information.png')?>" />
	  	</div>
		<div id='popup_aide'>
			<div id="creditTitre"><h1>Crédits</h1></div>
			<p>
			Issu du programme de recherche LEA, men&eacute; au sein de l'&eacute;quipe REDiM
			(<a href="http://www-lium.univ-lemans.fr/redim.html" target="_blank">R&eacute;ing&eacute;nierie des EIAH Dirig&eacute;e par les Mod&egrave;les</a>) 
			du LIUM (<a href="http://www-lium.univ-lemans.fr" target="_blank">Laboratoire d'Informatique de l'Universit&eacute; du Maine</a>) 
			en collaboration avec <a href="http://www.cfa3villes.com" target="_blank">le CFA des 3 Villes de la Mayenne </a>. 
			Application con&ccedil;ue dans le cadre du projet de recherche LEA, subventionn&eacute; par le Minist&egrave;re de la recherche,
			Direction de la technologie, puis ANR.
			Adaptation dans le cadre de l'ENT subventionn&eacute;e par <a href="http://www.loiret.pref.gouv.fr" target="_blank">l'&eacute;tat</a>, <a href="http://www.regioncentre.fr" target="_blank">la r&eacute;gion centre</a>, le <a href="http://www.europe-centre.eu" target="_blank">Feder</a> et <a href="http://www.recia.fr" target="_blank">le GIP Recia</a>.
			</p>
			<div align="center">
				<a href="http://www.loiret.pref.gouv.fr" target="_blank"><img src="<?php echo($LEA_URL.'images/prefecture.gif')?>"/></a>
				<a href="http://www.regioncentre.fr" target="_blank"><img src="<?php echo($LEA_URL.'images/regioncentre.gif')?>"/></a>
				<a href="http://www.europe-centre.eu" target="_blank"><img src="<?php echo($LEA_URL.'images/feder-centre.jpeg')?>"/></a>
				<a href="http://www.recia.fr" target="_blank"><img src="<?php echo($LEA_URL.'images/recia.jpeg')?>"/></a>
			</div>
		</div>
	  </div>
	</div>
	<div id="creditsFooter">
		<a href="#" onclick="lightbox('texteFooter', '<?php echo $LEA_URL?>')">Crédits...</a>
	</div>
</div>

<?php } ?>
		
       