<?php 
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 05/09/06
  
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	
	<head>
		<title>Format du fichier de donn&eacute;es</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="" />
		<meta name="special" content="" />
		<link rel="stylesheet" type="text/css" 
			href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>" 
		media="screen" />

	</head>

<body>

		<div id="top_l"></div><div id="top_m"><h1><span class="orange">F</span>ormat du fichier de donn&eacute;es</h1></div>
		<p><span class="titre_page"><a href='#' onclick="window.history.back()"><img class="retour" src="../../images/flechePrecedente.gif" border="0" /> Retour</a></span></p>
		<p><br />
		  Le format CSV (Comma Separated Value) qui est configur&eacute; comme suit
      a &eacute;t&eacute; choisi<br />
      comme format d&#8217;importation des donn&eacute;es dans Le LEA.</p>
        <p>&#8226; La premi&egrave;re ligne contient les noms des donn&eacute;es &agrave; importer.</p>
<p>&#8226; Les lignes de donn&eacute;es se terminent par  \r\n</p>
	<p>&#8226; Les champs sont s&eacute;par&eacute;s par  des points-virgule ; </p>
	<table>
					<tr bgcolor="#CC9933">
		                <th width="57%">Les noms  des donn&eacute;es &agrave; importer</td>
        		        <th width="43%">Exemple d'une ligne de donn&eacute;es</td>
	 				 </tr>
		            <tr>
        		        <td>CIVILITE_DU_JEUNE_LONG </td>
                		<td>Monsieur </td>
		            </tr>
        		    <tr>
                		<td>NOM_DU_JEUNE </td>
		                <td>CHAUVEAU </td>
        			</tr>
		            <tr>
        		        <td>PRENOM_DU_JEUNE </td>
                		<td>Anthony </td>
			        </tr>
            		<tr>
                      <td>NUMERO_DU_JEUNE </td>
                      <td>2232 </td>
          		  </tr>
            		<tr>
		                <td>ADRESSE1_DU_JEUNE </td>
        		        <td>La Cour de Filleuron </td>
              		</tr>
		            <tr>
        		        <td>CODE_POSTAL_DU_JEUNE </td>
     			        <td>53170 </td>
		            </tr>
        		    <tr>
                		<td>VILLE_DU_JEUNE </td>
		                <td>BAZOUGERS </td>
        			</tr>
		            <tr>
        		        <td>TELEPHONE_DU_JEUNE </td>
                		<td>02-43-02-36-53</td>
		            </tr>
        		    <tr>
                		<td>TELEPHONE2_DU_JEUNE </td>
		                <td>&nbsp;</td>
 		            </tr>
        		    <tr>
                		<td>EMAIL_JEUNE </td>
		                <td>&nbsp;</td>
        			</tr>
		            <tr>
        		        <td>DATE_DE_NAISSANCE_DU_JEUNE </td>
                		<td>18/06/1987 </td>
		            </tr>
        		    <tr>
                		<td>CIVILITE_TUTEUR_CFA_LONG </td>
		                <td>Monsieur </td>
        			</tr>
		            <tr>
        		        <td>NOM_TUTEUR_CFA </td>
                		<td>CHAUVEL </td>
		            </tr>
        		    <tr>
                		<td>PRENOM_TUTEUR_CFA </td>
		                <td>Christian </td>
        			</tr>
		            <tr>
        		        <td>ADRESSE1_TUTEUR_CFA </td>
                		<td>&nbsp;</td>
		            </tr>
        		    <tr>
                		<td>CODE_POSTAL_TUTEUR_CFA </td>
		                <td>53390 </td>
        			</tr>
		            <tr>
        		        <td>VILLE_TUTEUR_CFA </td>
                		<td>ST. AIGNAN SUR ROE </td>
					</tr>
		            <tr>
        		        <td>TELEPHONE1_TUTEUR_CFA </td>
                		<td>02-43-06-51-80 </td>
					</tr>
		            <tr>
        		        <td>TELEPHONE2_TUTEUR_CFA </td>
                		<td>06-19-40-57-60 </td>
		            </tr>
        		    <tr>
                		<td>EMAIL_TUTEUR_CFA </td>
	    	            <td>&nbsp;</td>
    	          	</tr>
		            <tr>
        		        <td>CIVILITE_DU_REPLEGAL_LONG </td>
                		<td>Monsieur </td>
		            </tr>
        		    <tr>
                		<td>NOM_DU_REPLEGAL </td>
		                <td>CHAUVEAU </td>
        			</tr>
		            <tr>
        		        <td>PRENOM_DU_REPLEGAL </td>
                		<td>Bertrand </td>
		            </tr>
        		    <tr>
                		<td>ADRESSE1_LEGAL </td>
		                <td>La Cour de Filleuron </td>
              		</tr>
		            <tr>
        		        <td>CODE_POSTAL_LEGAL </td>
                		<td>53170 </td>
		           	</tr>
		            <tr>
        		        <td>VILLE_LEGAL </td>
                		<td>BAZOUGERS </td>
					</tr>
		            <tr>
        		        <td>TELEPHONE_LEGAL</td>
                		<td>02-43-02-36-53 </td>
		            </tr>
              		<tr>
		                <td>TELEPHONE2_LEGAL </td>
        		        <td>&nbsp;</td>
		            </tr>
              		<tr>
		                <td>DATE_DEBUT_CONTRAT</td>
                		<td>&nbsp;</td>
			        </tr>
            		<tr>
		                <td>DATE_FIN_CONTRAT</td>
        		        <td>&nbsp;</td>
		            </tr>
        		    <tr>
                		<td>DIPLOME_AV_CTR_DU_JEUNE </td>
		                <td>&nbsp;</td>
             		</tr>
		            <tr>
		              <td>SITUATION_ANNEE_PREC</td>
		              <td>&nbsp;</td>
      </tr>
		            <tr>
                		<td>CIVILITE_TUTEUR_ENT_LONG</td>
		                <td>Monsieur </td>
        		    </tr>
		            <tr>
        		        <td>NOM_TUTEUR_ENT </td>
                		<td>HUBERT</td>
		            </tr>
        		    <tr>
                		<td>PRENOM_TUTEUR_ENT </td>
		                <td>Jean-Pierre</td>
        		    </tr>
		            <tr>
        		        <td>ADRESSE1_TUTEUR_ENT </td>
                		<td> Forveill&eacute; </td>
		            </tr>
        		    <tr>
    	            	<td>CODE_POSTAL_TUTEUR_ENT </td>
	    	            <td>53340 </td>
            		</tr>
		            <tr>
        		        <td>VILLE_TUTEUR_ENT </td>
                		<td>CHEMERE LE ROI </td>
		            </tr>
        			<tr>
	            	    <td>TELEPHONE_TUTEUR_ENT </td>
    	    	        <td>02-43-98-68-02 </td>
        	      	</tr>
		            <tr>
        		        <td>TELEPHONE2_TUTEUR_ENT</td>
                		<td>02-43-98-68-02 </td>
		            </tr>
        		    <tr>
                		<td>EMAIL_TUTEUR_ENT </td>
		                <td>&nbsp;</td>
        		   </tr>
		           <tr>
        		        <td>NOM_DU_RESP </td>
                		<td>HUBERT </td>
		          </tr>
				  <tr>
		                <td>PRENOM_DU_RESP </td>
        		        <td>JEAN-PIERRE	Forveill&eacute; </td>
	              </tr>
    	          <tr>
    	            <td>RAISON_SOCIALE_ENT</td>
    	            <td>HUBERT</td>
  	            </tr>
    	          <tr>
        		        <td>ADRESSE1_ENT </td>
                		<td>&nbsp;</td>
	              </tr>
    	          <tr>
        		        <td>CODE_POSTAL_ENT </td>
                		<td>53340 </td>
	              </tr>
    	          <tr>
        		        <td>VILLE_ENT </td>
                		<td>CHEMERE LE ROI </td>
	              </tr>
    	          <tr>
    	    	        <td>TELEPHONE_ENTREPRISE</td>
        	    	    <td>02-43-98-68-02 </td>
	              </tr>
	              <tr>
    	        	    <td>TELEPHONE2_ENTREPRISE </td>
        	        	<td>02-43-98-68-02 </td>
            	  </tr>
	              <tr>
    		            <td>FAX_ENTREPRISE</td>
            		    <td>&nbsp;</td>
	              </tr>
    	          <tr>
        		        <td>EMAIL_ENTREPRISE </td>
                		<td>&nbsp;</td>
	              </tr>
    	          <tr>
        		        <td>NOMBRE_DE_SALARIES </td>
                		<td>&nbsp;</td>
	              </tr>
</table>

<p><strong>Comment construire un fichier CSV sous EXEL ?</strong></p>
<p></p>
<p><a href="../../documents/import_apprentis.xls" target="_blank"><img src="../../images/mini_captureCSV.jpg" width="633" height="318" border="0" /></a></p>
<p class="legende">1- Cr&eacute;er un fichier de donn&eacute;es comme le montre
  la figure ci-dessus ( Cliquer sur la figure ).</p>
<p class="legende">2- Enregistrer le fichier sous le format CSV.(Boutton Fichier-&gt; Enregister
  sous).</p>
<p><font color="#FF0000"><strong>Attention : </strong></font></p>
<p>- Les noms des donn&eacute;es doivent &ecirc;tre r&eacute;dig&eacute;s enti&egrave;rement
  en majuscule.</p>
<p class="legende">- L'ordre des champs n'est pas important, vous pouvez le changer
   et m&ecirc;me supprimer les champs dont vous n'avez pas besoin.</p>
<p class="legende">- les lignes qui commencent par un champ vide seront ignor&eacute;es.</p>
<p class="legende"><strong>Remarque</strong> : </p>
<p>- Le fichier texte extrait de winCFA est du format
    CSV. </p>
</body>
</html>
</div>