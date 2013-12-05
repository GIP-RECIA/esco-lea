<?php
/***********************************************************
 Copyright © 2005-2006 
 CFA des 3 villes
 Web: www.cfa3villes.com.
 Auteur : Faouzi AMIER
 Version : 1.0
 Date: 08/08/05
 Contenu: Ensemble des fonctions communes a tout le site

 /************************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
header('Content-type: text/html; charset=UTF-8');

/* Création d'une redirection vers l'URL donnée en paramêtre */

//print_r($_POST);
//print_r($_GET);

function html_refresh($page) {
	@header("Location:$page");
	exit();
}

// projet_tut ------------ DEBUT

/* Création d'une redirection vers l'URL donnée en parametre *

function get_max_size_upload() {
$MAX_SIZE=2000000; // 2Mo
return $MAX_SIZE;
}
// projet_tut ------------ FIN


/* cette fonction renvoit le code html de la chaine de caractères $txt */

function to_html($txt) {

	return htmlentities($txt, ENT_QUOTES, "UTF-8");
}

/**
 Cette fonction retourne une chaine avec les quotes doubles
 en fonction de la configuaration du serveur
 pour éviter les injections SQL
 */

function to_sql($txt) {

	$mytxt = trim($txt);


	if( get_magic_quotes_gpc() )  	return $mytxt;
	else return addslashes($mytxt);

}

/**
 Cett fonction teste si la chaine de caractères txt se termine par  les mots suivants 
 .php ou .inc
 */

function is_php($txt) {

	$ext = get_extension($txt);

	if (eregi("(inc|php)", strtolower ($ext) ))
	return 1;
	else return 0 ;
}

/**
 Cette fonction renvoit l'extension d'une chaîne de caractères $txt

 */

function get_extension($txt) {
		
	$ok = ereg("^(.+)\.(.+)$", $txt, $items);

	if ($ok) {
		return $items[2]; // retourne l'extention
	}
	else return ""; // le texte ne possede aucune extention.

}

/*
 cette fonction permet de transfomrer une date de la forme JJ-MM-AAAA ou JJ/MM/AAAAA
 en une date de la forme AAAA-MM-JJ. */


function trans_date($date, $sep="-"){

	if( strlen($date)==10 ) {

		if($sep == "-" || $sep == "/" ) {
			list($j,$m,$a)= split ($sep, $date) ;
				
			return "$a-$m-$j" ;
			/* $tok = strtok($date,$sep);
			 $retourdate1=$tok;
			 $tok = strtok($sep);
			 $retourdate2=$tok;
			 $tok = strtok($sep);
			 $retourdate=$retourdate1."-".$retourdate2."-".$tok;
			 return $retourdate;*/
		}
		else return $date;

	}
	else return $date;
}


function trans_date_time($date_time){

	if($date_time!="") {
		if(strlen($date_time)== 14 ) { // utilisé pour les anciens versions de mysql (avant 4.1)
			$date = substr("$date_time", 6, 2).'-'.substr("$date_time", 4, 2).'-'.substr("$date_time", 0, 4) ;
			$time = substr("$date_time", 8, 2).':'.substr("$date_time", 10, 2).':'.substr("$date_time", 12, 2) ;

		}
		else {
			list($date, $time) = split (' ', $date_time);
			$date = trans_date($date);
		}

		return ("$date &nbsp; &nbsp; $time");
	}
	else return $date_time;
}


/*
 Cette fonction  permet de générer un mot de passe alphanumérique avec des majuscules 
 et minuscules en omettant les chiffres 0,1 et les lettres l,i,o qui peuvent se confondre.
 */


function mdp_aleatoire()
{
	$chrs = 6 ;
	$pwd = ""  ;
	mt_srand ((double) microtime() * 1000000);
	while (strlen($pwd)<$chrs)
	{
		$chr = chr(mt_rand (0,255));
		if (eregi("^[a-hj-km-np-z2-9]$", $chr))
		$pwd = $pwd.$chr;
	};
	return $pwd;
}

/* cette fonction permet de créer un login du format $format 
 $format = 1 	//  $str = jean pierre AMIER ==> return  jpAMIER
 $format = 2     //  $str = jean pierre AMIER ==> return jean_pierre_AMIER

 à partir de chaine $str
 */

function create_login ( $format = 2, $str = "") {

	$sans_accent = str_replace(
			array(
				'à', 'â', 'ä', 'á', 'ã', 'å',
				'î', 'ï', 'ì', 'í', 
				'ô', 'ö', 'ò', 'ó', 'õ', 'ø', 
				'ù', 'û', 'ü', 'ú', 
				'é', 'è', 'ê', 'ë', 
				'ç', 'ÿ', 'ñ',
				'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
				'Î', 'Ï', 'Ì', 'Í', 
				'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø', 
				'Ù', 'Û', 'Ü', 'Ú', 
				'É', 'È', 'Ê', 'Ë', 
				'Ç', 'Ÿ', 'Ñ', 
			),
			array(
				'a', 'a', 'a', 'a', 'a', 'a', 
				'i', 'i', 'i', 'i', 
				'o', 'o', 'o', 'o', 'o', 'o', 
				'u', 'u', 'u', 'u', 
				'e', 'e', 'e', 'e', 
				'c', 'y', 'n', 
				'A', 'A', 'A', 'A', 'A', 'A', 
				'I', 'I', 'I', 'I', 
				'O', 'O', 'O', 'O', 'O', 'O', 
				'U', 'U', 'U', 'U', 
				'E', 'E', 'E', 'E', 
				'C', 'Y', 'N', 
			), $str);
	$tab_mots = str_word_count($sans_accent,1);
	$nb_mots = count($tab_mots);
	$login = "";

	switch ($format) {

		case "1": //jean pierre AMIER ==> jpAMIER

			for($i= 0 ; $i < $nb_mots -1 ; $i++) {
				$login.=$tab_mots[$i]{0};
			}
			if($nb_mots > 0) $login.= $tab_mots[$nb_mots-1];

			break;

		case "2": //jean pierre AMIER ==> jean_pierre_AMIER
				
			for($i= 0 ; $i < $nb_mots-1 ; $i++) {
					
				$login .= $tab_mots[$i]."_";
			}
			if($nb_mots > 0) $login.= $tab_mots[$nb_mots-1];
		default  :
			break;
	}
	return $login;
}

/* Cette fonction permet de créer un mot de passe à partir du login 
 $format = 1 => return  $login
 $format = 2 => return  motde passe aleatoire.
 */

function create_mdp ( $format=2, $login="") {


	$mdp = "";

	switch ($format) {

		case "1": $mdp = $login;
		break;

		case "2": $mdp = mdp_aleatoire();
		break;
	}

	return $mdp;

}

/*
 Cette fonction renvoit une chaine de caractères crées à partir de  la chaine $nom 
 en séparant  tous ses mots  par le séparateur _
 exemple : $nom = 'fichier de test.pdf' => renvoit  'fichier_de_test_.pdf'
 */


function  changer_nom_fichier($nom) {

	$tab_mots = str_word_count($nom,1);
	$nb_mots = count($tab_mots);
	$chaine = "";

		
	for($i= 0 ; $i < $nb_mots-1 ; $i++) {

		$chaine .= $tab_mots[$i]."_";
	}

	if($nb_mots > 0) $chaine.= ".". $tab_mots[$nb_mots-1];

	return $chaine;
}

/*
 * Fonction permettant de prefixer, la chaine de caractere passee en parametre,
 * avec la date du jour.
 */
function prefixer_date($chaine_originale) {
	return date("dmY-His") . "_" . $chaine_originale;
}


/***********************************************************
 cette fonction permet d'afficher le message d'erreur  $msg dans un tableau
 ***********************************************************/

function afficher_msg_erreur($msg){

	global $LEA_URL;

	echo "<div id=\"erreur\">
			
			<p>$msg</p>			  
			
     </div>";
}

/***********************************************************
 cette fonction permet d'afficher le lien qui permet d'ouvrir un calendrier
 pour sélectionner une date. 
 la cible de cette date sera le champ de nom theDate de formulaire theForm
 ***********************************************************/

function afficher_lien_calendrier($theForm, $theDate){

	global $LEA_URL;

	$img = $LEA_URL."images/b_calendar.png";
	$url = $LEA_URL."lib/calendrier/calendar.php";
	$script = $LEA_URL."lib/calendrier/libraries/tbl_change.js";

	echo"<script language='javascript' src='$script'  ></script>";
	echo"<a title='Calendrier' href=\"javascript:openCalendar('$url', '$theForm', '$theDate', 'date')\">
			<img class='calendar' src='$img' border='0' />
	</a>";
}

/***********************************************************
 cette fonction permet d'afficher le  bouton de retour
 ***********************************************************/

function afficher_boutton_retour($page=""){

	global $LEA_URL;

	$img = $LEA_URL."images/flechePrecedente.gif";

	if($page=="") $onClick="window.history.back()";
	else $onClick = "window.location.replace('$page')";

	echo "<a href=\"#\" onClick=\"$onClick\">
		<img src=\"$img\" border=\"0\"> 
		Retour
	 </a>";
}

/***********************************************************
 cette fonction permet d'afficher l'image de source src_img si elle existe
 ***********************************************************/

function afficher_image($src_img = "", $width_max = "100", $height_max = "100", $border = 0){

		
	$size = getimagesize ($src_img);
	$width = $size[0];
	$height = $size[1];

	if($width > $width_max ) $width = $width_max;
	if($height > $height_max ) $height = $height_max;

	echo("<img src=\"$src_img\" width=\"$width\"  height=\"$height\" border=\"$border\"> ");

}

/***********************************************************
 cette fonction permet d'afficher un boutton pour écrire un message
 ***********************************************************/

function afficher_boutton_ecrire_msg($libelle, $id_usager){

	global $LEA_URL;

	$url = $LEA_URL."administrateur/contact/ecrire_msg.php?les_id_usager_dest[]=$id_usager";
	$src_img = $LEA_URL."images/new_msg.gif";

	echo"
	<a href='#' onClick=\"window.open('$url','','height=400, width=600, left=150, top=300, scrollbars=no')\"> 
	<img src='$src_img' border='0'>	
	$libelle
	</a>
	";

}


/***********************************************************
 Cette fonction permet d'afficher le  bouton fermer
 ***********************************************************/

function afficher_boutton_fermer($reload_opener=1){

	global $URL_THEME;

	$img = $URL_THEME."images/ico_fermer.png";

	if($reload_opener) $onclick = "window.opener.location.reload(); window.close();";
	else $onclick = "window.close();";

	echo "<a href=\"#\" onclick=\"$onclick\">
	<img src='$img' border='0'> 
	Fermer
	</a>
	
	";
}

/***********************************************************
 cette fonction permet d'afficher le  bouton de retour
 ***********************************************************/

function afficher_boutton_imprimer(){

	global $LEA_URL;

	$img = $LEA_URL."images/print.gif";

	echo "<a href='#' onClick='window.print()'>
		<img src='$img' border='0'> 
		Imprimer
	 </a>";
}


/* Cette fonction renvoit une chaine de caractère représentant la bare de pagination 
 parametre:
 page: le numéro de la page sélectionnée; 
 url: le lien vers  lequel pointent les pages
 nb : le nombre total d'enregistrement
 plage: le nombre d'enregestrements affichés par page

 */

function get_string_pages($page, $url, $nb, $PLAGE ) {


	$nb_pages=ceil($nb/$PLAGE);  // le nombre de pages en arrondi

	$string_pages= "";
	 
	if($page > 1) {
		$string_pages.="<a href='$url&page=".($page-1)."'>";
		$string_pages.="<img src='../../images/flechePrecedente.gif' border='0'> Pr&eacute;c&eacute;dente</a><br>";
	}
		
	$i=1;
	while ($i<=$nb_pages){

		if($i==$page) $string_pages.="<b>[$i]</b>&nbsp;&nbsp;";
		else          $string_pages.="<a href='$url&page=$i'>[$i]</a>&nbsp;&nbsp;";
			
		$i++;
			
		if($i%20 == 0)    $string_pages.="<br>";

	}
	if($page < $nb_pages) {
		$string_pages.="<br><a href='$url&page=".($page+1)."'>";
		$string_pages.="Suivante <img src='../../images/flecheSuivante.gif' border='0'> </a>";
	}
		
	$string_pages = "<table width='90%'><tr><td class='center'> $string_pages </td> </tr> </table>";

	return $string_pages;
}

/*
 Cette fonction permet d'afficher la bare de recherche des noms par les lettres alphabitiques.
 params est un  tableau associatif contenants les parametres a passer avec l'url ainsi leurs valeurs
 */

function Afficher_recherche($url, $select_lettre, $params=array()) {
	 

	$les_lettres = array("A", "B","C","D","E","F","G","H","I","J","K","L","M","N","O",
		   						 "P","Q","R","S","T","U","V","W","X","Y","Z");
	$string_link ="";
		
	$str_params="";
		
	foreach($params as $name => $value){

		$str_params .="$name=$value"."&";
	}
		
	foreach($les_lettres as $lettre) {
			
		if($lettre == $select_lettre ) $string_link .= "$lettre" ;
		else 						   $string_link .= "<a href=\"$url?$str_params&lettre=$lettre\">$lettre</a>";

		$string_link .= "&nbsp; &nbsp;" ;
	}
	if($select_lettre=="") $string_link .= "Afficher tout" ;
	else 				   $string_link .= "<a href=\"$url?$str_params&lettre=\"><strong>Afficher tout</strong></a>";

	$html_code = "<div id=\"search\">
							<span>$string_link</span>
								<form action=\"$url\" method=\"get\">
									";
	foreach($params as $name => $value){
		$html_code .="<input type=\"hidden\" name=\"$name\" value=\"$value\" />";
	}
	$html_code .="<input type=\"text\" name=\"mot_cle\" value=\"$select_lettre\" />
								<input type=\"submit\" value=\"Rechercher\" /> 
									
								</form>
							</div>";

	echo" $html_code";

}

/*

Cette fonction renvois le code html de la  liste déroulant du nom 
$name
$array_value : les options de ce menu (tableau associatif);
$array_selected : les options pré-selectionnée de ce menu.

*/

function liste_deroulante ( $name , $array_value = array() , $array_selected ,  $attr='', $multiple = 0 , $size = 1)
{
	$select = '<select' . ( ( $multiple == 1 ) ? ' multiple name="' . $name . '[]"' : ' name="' . $name . '"' ) .
					' size="' . $size . '"  '.$attr.' >' . "\n" ;

	foreach ( $array_value as $key => $value )
	{
		$select .= '<option value="' . $key . '"' .
		( ( $multiple == 1 ) ? ( in_array ( $key , $array_selected ) ? ' selected="selected"' : '' ) :
		( $key == $array_selected ? ' selected="selected"' : '' ) ) .
                '>' . $value . '</option>' . "\n" ;
	}

	$select .= '</select>' ;

	return $select ;
}

function svM($var) {
	if (PHPVERSION == 4) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	} else {
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}
}

/* 
 * Cette fonction decale la date $date passée en parametre de $nbJours jours
 * 
 */
function decaler_dateAAAAMMDD($date, $nbJours) {
	if ($nbJours == 0) {
		return $date;
	}
	list($annee, $mois, $jour) = split('-', $date);
	$ts = mktime(0, 0, 0, $mois , $jour + $nbJours, $annee);
	$dateConv = date("Y-m-d", $ts); 
	return $dateConv;
}
?>
