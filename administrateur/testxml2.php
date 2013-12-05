<?php
require_once("./secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("config/config.inc.php"))      require_once("config/config.inc.php");
	function xml2hash ( $string_to_hash , $includetoptag = false , $lowercasetags = true ) 
	{ 
	$p = xml_parser_create() ; 
	xml_parse_into_struct ( $p , $string_to_hash , $vals , $index ) ; 
	xml_parser_free ( $p ) ; 
 
	$xml = array() ; 
	$levels = array() ; 
	$multipledata = array() ; 
	$prevtag = '' ; 
	$currTag = '' ; 
	$toptag = false ; 
 
		foreach ( $vals as $val ) 
		{ 
// Open tag 
			if ( $val['type'] == 'open' ) 
			{ 
				if ( !xml2hashop ( $toptag , $includetoptag , $val , $lowercasetags , $levels , $prevtag , $multipledata , $xml ) ) 
				{ 
				continue ; 
				} 
			} 
 
// Close tag 
			else if ( $val['type'] == 'close' ) 
			{ 
				if ( !xml2hashcl ( $toptag , $includetoptag , $val , $lowercasetags , $levels , $prevtag , $multipledata , $xml ) ) 
				{ 
				continue ; 
				} 
			}
 
// Data tag 
			else if ( $val['type'] == 'complete' && isset ( $val['value'] ) ) 
			{ 
			$loc = &$xml ; 
 
				foreach ( $levels as $level ) 
				{ 
				$temp = &$loc[str_replace ( ':arr#' , '' , $level )] ; 
				$loc = &$temp ; 
				} 
 
			$tag = $val['tag'] ; 
 
				if ( $lowercasetags ) 
				{ 
				$tag = strtolower ( $val['tag'] ) ; 
				} 
 
			$loc[$tag] = str_replace ( '\\n' , '\n' , $val['value'] ) ; 
			} 
 
// Tag without data 
			else if ( $val['type'] == 'complete' ) 
			{ 
			xml2hashop ( $toptag , $includetoptag , $val , $lowercasetags , $levels , $prevtag , $multipledata , $xml ) ; 
			xml2hashcl ( $toptag , $includetoptag , $val , $lowercasetags , $levels , $prevtag , $multipledata , $xml ) ; 
			} 
		} 
	return $xml ; 
	}
 
 
 
	function xml2hashop ( &$toptag , &$includetoptag , &$val , &$lowercasetags , &$levels , &$prevtag , &$multipledata , &$xml ) 
	{ 
// don't include top tag 
		if ( !$toptag && !$includetoptag ) 
		{ 
		$toptag = $val['tag'] ; 
		return false ; 
		} 
 
	$currTag = $val['tag'] ; 
 
		if ( $lowercasetags ) 
		{ 
		$currTag = strtolower ( $val['tag'] ) ; 
		} 
	$levels[] = $currTag ; 
 
// Multiple items w/ same name. Convert to array. 
		if ( $prevtag === $currTag ) 
		{ 
			if ( !array_key_exists ( $currTag , $multipledata ) || !$multipledata[$currTag]['multiple'] ) 
			{ 
			$loc = &$xml ; 
 
				foreach ( $levels as $level ) 
				{ 
				$temp = &$loc[$level] ; 
				$loc = &$temp ; 
				} 
 
			$loc = array ( $loc ) ; 
			$multipledata[$currTag]['multiple'] = true ; 
			$multipledata[$currTag]['multiple_count'] = 0 ; 
			} 
 
		$multipledata[$currTag]['popped'] = false ; 
		$levels[] = ':arr#' . ++$multipledata[$currTag]['multiple_count'] ; 
		} 
 
		else 
		{ 
		$multipledata[$currTag]['multiple'] = false ; 
		} 
	
// Add attributes array 
		if ( array_key_exists ( 'attributes' , $val ) ) 
		{ 
		$loc = &$xml ; 
 
			foreach ( $levels as $level ) 
			{ 
			$temp = &$loc[str_replace ( ':arr#' , '' , $level )] ; 
			$loc = &$temp ; 
			} 
 
		$keys = array_keys ( $val['attributes'] ) ; 
 
			foreach ( $keys as $key ) 
			{ 
			$tag = $key ; 
 
				if ( $lowercasetags ) 
				{ 
				$tag = strtolower ( $tag ) ; 
				} 
 
			$loc['attributes'][$tag] = &$val['attributes'][$key] ; 
			} 
 
		} 
	return true ; 
	} 
 
 
	function xml2hashcl ( &$toptag , &$includetoptag , &$val , &$lowercasetags , &$levels , &$prevtag , &$multipledata , &$xml ) 
	{ 
// don't include top tag 
		if ( $toptag && !$includetoptag && $val['tag'] == $toptag ) 
		{ 
		return false ; 
		} 
 
	$prevtag = array_pop ( $levels ) ; 
 
		if ( strpos ( $prevtag , 'arr#' ) ) 
		{ 
		$prevtag = array_pop ( $levels ) ; 
		} 
 
	return true ; 
	}

	if($_FILES['nom_du_fichier']['type']!="application/octet-stream"){
	echo "Veuillez sï¿½lectionner un fichier XML de configuration";
	exit();
	}
	$string_xml= file_get_contents($_FILES['nom_du_fichier']['tmp_name']);
	$xml = xml2hash ( $string_xml ) ;
	
	/*$value=$xml['admin'];
	echo "pour l'admin <br/>";
	echo "admin".$value['admin']."rvs".$value['rvs']."ens".$value['ens']."ma".$value['ma']."<br/>";
	$value=$xml['rvs'];
	echo "pour l'rvs <br/>";
	echo "admin".$value['admin']."rvs".$value['rvs']."ens".$value['ens']."ma".$value['ma']."<br/>";
	$value=$xml['ens'];
	echo "pour l'ens <br/>";
	echo "admin".$value['admin']."rvs".$value['rvs']."ens".$value['ens']."ma".$value['ma']."<br/>";
	$value=$xml['ma'];
	echo "pour l'ma <br/>";
	echo "admin".$value['admin']."rvs".$value['rvs']."ens".$value['ens']."ma".$value['ma']."<br/>";*/
	
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once ($LEA_REP."modele/bdd/classe_terminologie.php");
require_once ($LEA_REP."lib/stdlib.php");
$termino= new Terminologie();
$termino->set_detail();
if(is_array($xml['acteur'])){
$acteur=$xml['acteur'];
		if(isset($acteur['0'])){
		for($i=0;$i<10;$i++){
			if(isset($acteur[$i])){
			
			$zero=$acteur[$i];
				if(isset($zero['attributes'])){
					$attribut=$zero['attributes'];
					
					if($attribut['xsi:type']=="LEAV2:ADMIN"){
						$terminoadmin=$attribut['terminologie'];
						if(isset($zero['fonction'])){
							
							$fonction=$zero['fonction'];
							if(isset($fonction['attributes'])){
								$fonctionattribut=$fonction['attributes'];
								$droitadmin[]=$fonctionattribut['droit'];
							}
								for($j=0;$j<10;$j++){
									if(isset($fonction[$j])){
										$fonczero=$fonction[$j];
										if(isset($fonczero['attributes'])){
											$foncattribut=$fonczero['attributes'];
											$droitadmin[]=$foncattribut['droit'];
										}
									}
								}
							
						}
					}
					if($attribut['xsi:type']=="LEAV2:RVS"){
						$terminorvs=$attribut['terminologie'];
						if(isset($zero['fonction'])){
							$fonction=$zero['fonction'];
							if(isset($fonction['attributes'])){
								$fonctionattribut=$fonction['attributes'];
								$droitrvs[]=$fonctionattribut['droit'];
							}
								for($j=0;$j<10;$j++){
									if(isset($fonction[$j])){
										$fonczero=$fonction[$j];
										if(isset($fonczero['attributes'])){
											$foncattribut=$fonczero['attributes'];
											$droitrvs[]=$foncattribut['droit'];
										}
									}
								}
							
						}
					}
					if($attribut['xsi:type']=="LEAV2:ENS"){
						$terminoens=$attribut['terminologie'];
						$terminotuteur_cfa=$attribut['terminologie_tcfa'];
						if(isset($zero['fonction'])){
							$fonction=$zero['fonction'];
							if(isset($fonction['attributes'])){
								$fonctionattribut=$fonction['attributes'];
								$droitens[]=$fonctionattribut['droit'];
							}
								for($j=0;$j<10;$j++){
									if(isset($fonction[$j])){
										$fonczero=$fonction[$j];
										if(isset($fonczero['attributes'])){
											$foncattribut=$fonczero['attributes'];
											$droitens[]=$foncattribut['droit'];
										}
									}
								}
							
						}
					}
					if($attribut['xsi:type']=="LEAV2:MA"){
						$terminoma=$attribut['terminologie'];
						if(isset($zero['fonction'])){
							
							$fonction=$zero['fonction'];
							if(isset($fonction['attributes'])){
								$fonctionattribut=$fonction['attributes'];
								$droitma[]=$fonctionattribut['droit'];
							}
								for($j=0;$j<10;$j++){
									if(isset($fonction[$j])){
										$fonczero=$fonction[$j];
										if(isset($fonczero['attributes'])){
											$foncattribut=$fonczero['attributes'];
											$droitma[]=$foncattribut['droit'];
										}
									}
								}
							
						}
					}
					if($attribut['xsi:type']=="LEAV2:APP"){
						$terminoapp=$attribut['terminologie'];
						if(isset($zero['fonction'])){
							
							$fonction=$zero['fonction'];
							if(isset($fonction['attributes'])){
								$fonctionattribut=$fonction['attributes'];
								$droitsr[]="app";
							}
						}
					}
					if($attribut['xsi:type']=="LEAV2:PAR"){
						$terminorl=$attribut['terminologie'];
						$parent="true";
						if(isset($zero['fonction'])){
							$fonction=$zero['fonction'];
							if(isset($fonction['attributes'])){
								$fonctionattribut=$fonction['attributes'];
								$droitsr[]="rl";
							}
						}
					}
					if($attribut['xsi:type']=="LEAV2:RF"){
						$terminorf=$attribut['terminologie'];
					}
				}
			}
		}
		}
		
}

if(is_array($xml['institutions']['institution'])){
$instit=$xml['institutions']['institution'];
	for($o=0;$o<5;$o++){
		if(isset($instit[$o])){		
			$ins=$instit[$o];
			if(isset($ins['attributes'])){
				$in=$ins['attributes'];				
				if($in['xsi:type']=="LEAV2:I_LEA"){
				$terminolea=$in['terminologie'];
				}
				if($in['xsi:type']=="LEAV2:I_CFA"){
				$terminocfa=$in['terminologie'];
				$institcfa=$ins['sousinstitution'];
				$terminofor=$institcfa['attributes']['terminologie'];
					for($l=0;$l<10;$l++){
						if(isset($institcfa[$l])){
							if($institcfa[$l]['attributes']['xsi:type']=="LEAV2:I_PED"){
								$terminoped=$institcfa[$l]['attributes']['terminologie'];
							}
							if($institcfa[$l]['attributes']['xsi:type']=="LEAV2:I_CLA"){
								$terminocla=$institcfa[$l]['attributes']['terminologie'];
							}
							if($institcfa[$l]['attributes']['xsi:type']=="LEAV2:I_SCFA"){
								$terminoscfa=$institcfa[$l]['attributes']['terminologie'];
							}
						}	
					}
				}
				if($in['xsi:type']=="LEAV2:I_ENT"){
				$terminoent=$in['terminologie'];
				if(isset($ins['sousinstitution'])){
				$institent=$ins['sousinstitution'];
					if(isset($institent['attributes']['terminologie'])){
						$terminose=$institent['attributes']['terminologie'];
					}
				}}
			}
		}
	}
}
$admin=$droitadmin[0];
for($k=1;$k<sizeof($droitadmin);$k++){
if($droitadmin[$k]!="sr"){
$admin=$admin.",".$droitadmin[$k];
}else{
$droitsr[]="admin";
}
}
$rvs=$droitrvs[0];
for($k=1;$k<sizeof($droitrvs);$k++){
if($droitrvs[$k]!="sr"){
$rvs=$rvs.",".$droitrvs[$k];
}else{
$droitsr[]="rvs";
}
}
$ens=$droitens[0];
for($k=1;$k<sizeof($droitens);$k++){
if($droitens[$k]!="sr"){
$ens=$ens.",".$droitens[$k];
}else{
$droitsr[]="ens";
}
}
$ma=$droitma[0];
for($k=1;$k<sizeof($droitma);$k++){
if($droitma[$k]!="sr"){
$ma=$ma.",".$droitma[$k];
}else{
$droitsr[]="ma";
}
}
$sr=$droitsr[0];
for($k=1;$k<sizeof($droitsr);$k++){
$sr=$sr.",".$droitsr[$k];
}
if(empty($parent)){
$parent="false";
}

if(!isset($admin) or !isset($rvs) or !isset($ens) or !isset($ma) or !isset($parent)){
echo "Le fichier n'est pas complet";exit();
}
?>

<form action="interface_v.php" id="formhihi" method="POST">
<?php  	echo "	<input type='hidden' name='droitadmin' value='$admin'> ";
echo "	<input type='hidden' name='droitrvs' value='$rvs'> ";
echo "	<input type='hidden' name='droitens' value='$ens'> ";
echo "	<input type='hidden' name='droitma' value='$ma'> ";
echo "	<input type='hidden' name='droitsr' value='$sr'> ";
echo "	<input type='hidden' name='term_admin' value='$terminoadmin'> ";
if(isset($terminorvs))echo "	<input type='hidden' name='term_rvs' value='$terminorvs'> ";
echo "	<input type='hidden' name='term_rf' value='$terminorf'> ";
echo "	<input type='hidden' name='term_ens' value='$terminoens'> ";
echo "	<input type='hidden' name='term_tuteur_cfa' value='$terminotuteur_cfa'> ";
echo "	<input type='hidden' name='term_ma' value='$terminoma'> ";
echo "	<input type='hidden' name='term_app' value='$terminoapp'> ";
if(isset($terminorl))echo "	<input type='hidden' name='term_rl' value='$terminorl'> ";
echo "	<input type='hidden' name='supp_rl' value='$parent'> ";
echo "	<input type='hidden' name='term_lea' value='$terminolea'> ";
echo "	<input type='hidden' name='term_cfa' value='$terminocfa'> ";
echo "	<input type='hidden' name='term_entr' value='$terminoent'> ";
if(isset($terminoped)){echo "	<input type='hidden' name='term_unit_pedag' value='$terminoped'> ";
echo "	<input type='hidden' name='supp_unit_pedag' value='true'> ";
}
if(empty($terminoped))echo "	<input type='hidden' name='supp_unit_pedag' value='false'> ";
echo "	<input type='hidden' name='term_formation' value='$terminofor'> ";
echo "	<input type='hidden' name='term_classe' value='$terminocla'> ";
echo "	<input type='hidden' name='term_suivi_cfa' value='$terminoscfa'> ";
if(isset($terminose)){echo "	<input type='hidden' name='term_suivi_entr' value='$terminose'> ";
echo "	<input type='hidden' name='supp_suivi_entr' value='true'> ";
}
if(empty($terminose))echo "	<input type='hidden' name='supp_suivi_entr' value='false'> ";
echo "</form>";

?>

<script type="text/javascript">
	window.onload = function ()
	{
		document.getElementById('formhihi').submit();
	}
</script>
