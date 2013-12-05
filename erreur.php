<?php
/***********************************************************
   Copyright ï¿½ 2005-2006 
   CFA des 3 villes
   Web: www.cfa3villes.com.   
   Auteur : Faouzi AMIER
   Version : 1.0
   Date: 18/12/05
   Contenu: Page est innaccï¿½ssible.

/***********************************************************/
include_once ("config/config.inc.php");
/***********************************************************/
?>
<html>
<head>
<link rel="stylesheet" type="text/css" 
			href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>" 
			media="screen" />

<title>R&eacute;f&eacute;rentiel m&eacute;tier</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="../../javascript/stdlib.js">

</script>	
</head>
<body>

 <table width="100%" height="2%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="96">   
			<h1>Vous ne pouvez pas consulter cette page 
			</h1>

            </td>
          </tr>
          <tr align="center">
            <td height="304"><p align="center">La page demand&eacute;e est inaccessible
                car elle demande une <b>authentification</b>. <br>
              <br>
  <i>Si vous &ecirc;tes d&eacute;j&agrave; authentifi&eacute;, votre compte ne
  vous permet pas de visiter cette partie du site.</i> <br>
            </p>
              <p align="center"> <i>Si vous pensez pouvoir acc&eacute;der &agrave; cette
                  page, vous pouvez en informer le webmaster</i> <a href='mailto:<?php echo"$EMAIL_ADMIN" ?>'><font size="3"><i>par
                  courrier &eacute;lectronique</i></font></a>. </p>
              <br>
              <p align="center"> <a href="#" onClick="window.history.back()">Retourner &agrave; la
                  page pr&eacute;c&eacute;dente</a> </p>
              <br>
            </td>
          </tr>
</table>




<p class="titres">&nbsp;
</body>
</html>
