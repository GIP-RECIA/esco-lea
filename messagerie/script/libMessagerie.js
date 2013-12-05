window.onload = function()
{
	if ($('selection'))
	{
		$('selection').onclick = function()
		{
			selection(this);
		}
	}
}

function selection(bouton)
{
	var tab = $$('input');
	for (var i = 1 ; i < tab.length ; i++)
	{
		tab[i].checked = bouton.checked;
	}
}

function selectionDossier(bouton)
{
	var classe = bouton.className;
	var tab = $$('input.'+classe);
	for (var i = 1 ; i < tab.length ; i++)
	{
		tab[i].checked = bouton.checked;
	}
}

function afficherMessages(bouton, classe)
{
	var tab = $$('.'+classe);
	for (var i = 1 ; i < tab.length ; i++)
	{
		var el = tab[i].parentNode.parentNode;
		if (el.style.display == 'none')
		{
			bouton.style.backgroundImage = 'url(\"images/archive.jpg\")';
			el.style.display = "";
		}
		else
		{
			bouton.style.backgroundImage = 'url(\"images/archivef.jpg\")';
			el.style.display = 'none';
		}
	}
}

function deplacer()
{
	var cible = $('cible').options[$('cible').selectedIndex].value
	if (confirm("Voulez-vous vraiment déplacer la sélection dans le dossier " + cible + " ?"))
	{
		var tab = $$('input');
		var envoi = "";
		for (var i = 1 ; i < tab.length ; i++)
		{
			if (tab[i].checked) 
				envoi += (envoi == "" ? "" : "|") + tab[i].parentNode.parentNode.id;
		}
	}
	window.location = '?cible=' + cible + '&msg=' + envoi;
}

function supprimer()
{
	if (confirm("Voulez-vous vraiment envoyer la sélection dans la corbeille ?"))
	{
		var tab = $$('input');
		var envoi = "";
		for (var i = 1 ; i < tab.length ; i++)
		{
			if (tab[i].checked) 
				envoi += (envoi == "" ? "" : "|") + tab[i].parentNode.parentNode.id;
		}
		window.location = '?supp=' + envoi;
	}
}

// On teste si un dossier est vide, et si c'est le cas on le supprime (après confirmation)
function supprimerDossier(element, dossier)
{
	var elemSuivant = element.getParent().getParent().getNext();
	if (elemSuivant == undefined)
		verification = 'fond_dossier';
	else
		verification = elemSuivant.getProperty('class');

	if (verification != 'fond_dossier')
		alert("Vous devez d'abord changer les messages de répertoire pour pouvoir supprimer ce dossier !");
	else
		if (confirm("Voulez-vous vraiment supprimer ce dossier ?"))
			window.location = '?suppDossier=' + dossier;
}

function vider()
{
	if (confirm("Voulez-vous vraiment supprimer définitivement la sélection ?"))
	{
		var tab = $$('input');
		var envoi = "";
		for (var i = 1 ; i < tab.length ; i++)
		{
			if (tab[i].checked) 
				envoi += (envoi == "" ? "" : "|") + tab[i].parentNode.parentNode.id;
		}
		window.location = '?vider=' + envoi;
	}
}

function creerDossier()
{
	var dossier = window.prompt('Nom du dossier (40 caractères max) :');
	if (dossier != null)
	{
		dossier = dossier.substr(0, 40);
		window.location = 'dossiers.php?creer=' + dossier;
	}
}