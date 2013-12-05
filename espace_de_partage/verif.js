// JavaScript Document
function valide(frm){
	//Verification que le titre n'est pas vide
	if(frm.elements["nom_espace"].value==''){
		alert("Veuillez Saisir un nom pour votre espace");
		return false;
	};
};

function valider(frm){
	if(frm.elements["commentaire"].value=='' && frm.elements["fichier"].value==''){
		alert("Veuillez Saisir un commentaire et/ou un fichier");
		return false;
	};
}