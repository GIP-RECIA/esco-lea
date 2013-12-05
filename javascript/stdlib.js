// fonction permer d'afficher une boite de dialogue de confiramtion de la suppresion avec le message msg
function deleteConfirm(msg) {
   msg="Etes-vous sur de vouloir supprimer "+msg+" ?\nCette action est irreversible" 
   
	if (!confirm(msg)) {
	//location.href = "#";
	return false;
	}
	else return true;
}

// fonction permer d'afficher une boite de dialogue de confirmation du vidage de l'arbre
// projet_tut ------------ DEBUT 
function vidageConfirm(msg) {
   msg="Etes-vous sur de vouloir effacer le contenu de "+msg+" ?\nCette action est irreversible"; 
   
	if (!confirm(msg)) {
	//location.href = "#";
	return false;
	}
	else return true;
}
// projet_tut ------------ FIN 
// Controle une date pour savoir si elle est valide ou non.

function checkDate(DateData,DateFormat) {
   correct = true;
  
   if ( (DateData.length == 10) ) {
      if (DateFormat == "FR") {
         j = DateData.substring(0,2);
         m = DateData.substring(3,5);
      sep1 = DateData.substring(2,3); //separateur1
      sep2 = DateData.substring(5,6); //separateur2
      }
      else {
         j = DateData.substring(3,5);
         m = DateData.substring(0,2);
      sep1 = DateData.substring(2,3);
      sep2 = DateData.substring(5,6);
      }
      a = DateData.substring(6,DateData.length);
      bi = ((parseInt(a) % 4) == 0);
	  t = a.length; 
   
   if ((sep1 == "-") && (sep2 == "-") && isNumeric(a) && (t == 4) && isNumeric(t) && (a >= 1900))
   { 
         if (  ( (m == "01") || (m == "03") || (m == "05") || (m == "07") || (m == "08") || (m == "10") || (m == "12") ) && ( (Math.round(j) >= 1) && (Math.round(j) <= 31) ) ) {
            correct = true;
         }
         else {
            if (  ( (m == "04") || (m == "06") || (m == "09") || (m == "11") ) && ( (Math.round(j) >= 1) && (Math.round(j) <= 30) ) ) {
               correct = true;
            }
            else {
               if (bi)  {
                  correct = (  ( (Math.round(j) >= 1) && (Math.round(j) <= 29) ) && (m == "02") );
               }
               else {
                  correct = ( ( (Math.round(j) >= 1) && (Math.round(j) <= 28) ) && (m == "02")  );
               }
            }
         }
      }
      else {
         correct = false;
      }
  } else {
     correct = false;
  }
   return correct;
}

function testDate(Zone,Format,Libelle) {
  
   if (checkDate(Zone.value,Format)) {
        return true;
   }
   else {
      window.alert('Format de ' + Libelle + ' incorrect!\nSVP ressaisissez ce champ.');
      Zone.focus();
   return false;
   }
}



function isNumeric ( valeur )
{
	var ModInt = new RegExp("^[0-9]+$");
	
	
	return(ModInt.test(valeur));
}

function isReal ( valeur )
{
	var ModInt = new RegExp("^[0-9]+[\.]?[0-9]*$");
		
	return(ModInt.test(valeur));
}

function testVide ( Zone, Libelle )
{
   if ( Zone.value == "")
   {
	  var sp=document.createElement("span");

	  // Conversion des codes html du libelle
	  sp.innerHTML=Libelle;
	  Libelle = sp.innerHTML;
	  
      alert("\nLe champ '" + Libelle + "' est vide.\n\nSVP ressaisissez votre " + Libelle + ".");
      Zone.focus();
      return false;
   }
   else return true;
  
}

function verifMotPass ( ZoneMotPass, ZoneConfMotPass )
{
  if ( ZoneMotPass.value == ZoneConfMotPass.value)
   {
       return true;
   }
   else
   {
      alert("\nLe mot de passe est different du mot de passe confirmé.");
      ZoneMotPass.focus();
      return false;
   }
}

function testEmail( Zone, Libelle )
{
// vérification de la présence des expressions régulières" ".
    
  var maReg = new RegExp ( "^[_a-z0-9-]+([\.][_a-z0-9-]+)*@([a-z0-9-_]+[\.]+)+[a-z]{2,}$", "gi" ) ;

   if (Zone.value.search( maReg ) == -1 )
   {
      alert("\nLe champ '" + Libelle + "' est incorrect.\n\nSVP resaisissez votre " + Libelle + ".");
      
      Zone.select();
      Zone.focus();
      return false;
   }
   else
   {
      return true;
   }
}
function testNumeric(Zone, Libelle)
{

   if ( isNumeric (Zone.value) )
   {
      return true;
   }
   else
   {
      alert("\nLe champ '" + Libelle + "' n'accepte que les chiffres 0-9.\n\nSVP ressaisissez votre " + Libelle + ".");
      //Zone.value='';
      Zone.select();
      Zone.focus();
      return false;
   }
}



function testNom (Zone, Libelle)
{
	
	
	if (Zone.value =="")
   {
      alert("Veuillez saisir un " + Libelle + " valide");
      Zone.focus();
	  return false;
   }
   else return true;
}

function testCivilite (Zone){
	
	if ((Zone[0].checked == false) &&  (Zone[1].checked == false)
							 &&  (Zone[2].checked == false)) {
			alert("Vous n'avez pas indiqué votre civilité");
			return false;
	}
	else return true;
	
}	

function testAdresse (Zone, Libelle)
{
	var Modadresse = new RegExp("^[0-9a-zA-Z ]*$");
	
	if (Modadresse.test(Zone.value)==false)
   {
      alert("Veuillez saisir une " + Libelle + " valide");
      Zone.focus();
	  return false;
   }
   else return true;
}

function testTelephone(Zone, Libelle)
{
	var Modtel = new RegExp("^[0-9 -]+$");
	
   
   if (Modtel.test(Zone.value)==false)
   {
      alert("\nLe champ '" + Libelle + "' doit comporter des chiffres.\n\nSVP ressaisissez votre " + Libelle + ".");
      Zone.focus();
	  return false;
   }
   else return true;
}

function testLongueur(Zone, Libelle, Longueur)
{
   if (Zone.value =='' || Zone.value.length < Longueur ) 
   {
	   alert("\nLe champ '" + Libelle + "' doit contenir plus de  " + Longueur + " caractères.\n\nSVP ressaisissez votre " + Libelle + ".");
       Zone.select();
       Zone.focus();
       return false;
	   
    }
     else return true;
   
}

function auto_login(theForm){
theForm.login.value=(theForm.prenom.value).charAt() + theForm.nom.value; 
}

function afficher_date_courante(){

var MonthsList = new Array("Mois_Vide", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
					Today = new Date;
					Jour = Today.getDate();
					Mois = Today.getMonth()+1;
					Annee = Today.getFullYear();
					Message = Jour + " " + MonthsList[Mois] + " " + Annee;
					document.write(Message);
}

/***********************************************************/   
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.1
  // Date: 25/05/07
/***********************************************************/

function GEBID(e) {
	if(typeof(e) == 'string') {
		if(document.getElementById)	{
			e = document.getElementById(e);
		} else if(document.all) {
			e = document.all[e];
		} else {
			e = null;
		}
	}
	return e;
}

function dHide(id) {
	if(typeof(id) == 'string') {
		GEBID(id).style.display = "none";
	}
}

function dShow(id) {
	if(typeof(id) == 'string') {
		GEBID(id).style.display = "block";
	}
}

function isShow(id) {
	if(typeof(id) == 'string') {
		if(GEBID(id).style.display == "block" || GEBID(id).style.display != "none") {
			return true;
		} else if(GEBID(id).style.display == "none"){
			return false;
		}
	}
}

function afficherMasquer(id) {
	if(typeof(id) == 'string') {
		if(isShow(id) == false) {
			dShow(id);
		} else if(isShow(id) == true) {
			dHide(id);
		} else {
			dShow(id);
		}
	}
}


function GereChkbox(chp ,from, to, todo) {
	var blnEtat = null;
	for(i=from; i<to; i++) {
		blnEtat = (todo == '0') ? false : (todo == '1') ? true : (GEBID("" + chp + i + "").checked) ? false : true;
		GEBID("" + chp + i + "").checked = blnEtat;
	}
}

function backup_mod_imp_chps() {
	afficherMasquer("backup_mod_name");
	afficherMasquer("backup_mod_Y");
	afficherMasquer("backup_mod_N");
}

