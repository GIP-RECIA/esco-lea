// TODO :
// - icone de suppression
// - chargement
// - version formation
// - contraintes

window.onload = function ()
{
	// on récupère les images, et on appelle la fonction gérant le drag
	// le prototype sert à gérer les booléens pour le résultat d'un drag
	var images = $$('.func_img');
	Object.prototype.drop = false;
	Object.prototype.droppable = undefined;
	for (var i = 0 ; i < images.length ; i++)
	{
		addDragOnImage(images[i]);
	}
	
	// on s'occupe de gérer le résultat d'un drag, via les deux nouvelles propriétés d'un objet (drop -> si il est tombé sur l'élément droppable | droppable -> l'élément recepteur)
	// gestion du chargement des fonctionnalités
	var act = $$('.act');
	for (var i = 0 ; i < act.length ; i++)
	{
		act.addEvent('over', function (e) {e.drop = true; e.droppable = this;});
		act.addEvent('leave', function (e) {e.drop = false; e.droppable = undefined;});
		var children = act[i].getChildren();
		for (var j = 0 ; j < children.length ; j++)
		{
			if (children[j].getTag() == 'img')
			{
				if (children[j].getProperty('src').contains('livret'))
				{
					children[j].addEvent('click', function () {this.remove();});
					children[j].setStyle('cursor', 'pointer');
					children[j].addClass('cursor-supp');
				}
				else
					children[j].setStyle('opacity', 0.4);
			}
		}
	}
	
	// gère l'agrandissement d'un bloc de fonctionnalités
	var taille = $$('.func_taille');
	for (var i = 0 ; i < taille.length ; i++)
	{
		taille[i].addEvent('click', function ()
		{
			var tmp = this.getParent().getParent().getChildren();
			var element;
			for (var j = 0 ; j < tmp.length ; j++)
				if (tmp[j].hasClass('func_mid')) 
					element = tmp[j];
			if (element.getSize().size.y <= 30)
			{
				this.setProperty('src', 'param/fermeture.jpg');
				new Fx.Style(element, 'height',  {duration: 250}).start(80);
			}
			else
			{
				this.setProperty('src', 'param/ouverture.jpg');
				new Fx.Style(element, 'height',  {duration: 250}).start(26);
			}
		});
	}
	
	var taille_ens = $$('.act_taille');
	for (var i = 0 ; i < taille_ens.length ; i++)
	{	
		taille_ens[i].addEvent('click', function ()
		{
			var tmp = this.getParent().getParent().getChildren();
			var element;
			for (var j = 0 ; j < tmp.length ; j++)
				if (tmp[j].hasClass('act_name')) 
					element = tmp[j];

			var children = element.getChildren();
			var input = children[children.length - 1];
		
			if (element.getSize().size.y <= 30)
			{
				this.setProperty('src', 'param/fermeture.jpg');
				new Fx.Style(element, 'height',  {duration: 250, onComplete: function () {input.setStyle('display', 'inline');}}).start(44);	
			}
			else
			{
				this.setProperty('src', 'param/ouverture.jpg');
				new Fx.Style(element, 'height',  {duration: 250}).start(20);
				input.setStyle('display', 'none');
			}
		});
	}
	
	var taille_inst = $$('.inst_taille');
	for (var i = 0 ; i < taille_inst.length ; i++)
	{
		taille_inst[i].addEvent('click', function ()
		{
			var tmp = this.getParent().getParent().getChildren();
			var element;
			for (var j = 0 ; j < tmp.length ; j++)
				if (tmp[j].hasClass('inst_detail')) 
					element = tmp[j];
		
			var children = element.getChildren();
			var tab = [children[1], children[2]];
		
			if (element.getSize().size.y <= 30)
			{
				this.setProperty('src', 'param/fermeture.jpg');
				new Fx.Style(element, 'height',  {duration: 250, onComplete: function ()
				{
					for (var j = 0 ; j < tab.length ; j++)
						tab[j].setStyle('display', 'block');
				}}).start(135);	
			}
			else
			{
				this.setProperty('src', 'param/ouverture.jpg');
				new Fx.Style(element, 'height',  {duration: 250}).start(19);
				for (var j = 0 ; j < tab.length ; j++)
					tab[j].setStyle('display', 'none');
			}
		});
	}
	
	// gestion de la suppression
	var suppression = $$('img.suppression');
	for (var i = 0 ; i < suppression.length ; i++)
	{
		suppression[i].addEvent('click', function ()
		{
			deleteElement(this);
		});
	}
	
	// activation de la validation
	$('submit_term').addEvent('click', function ()
	{
		submitTerm();
		this.form.submit();
	});
	
	// par défaut :
	var tab = ['rl', 'suivi_entr'];
	for (var i = 0 ; i < tab.length ; i++)
	{
		if ($('input_supp_' + tab[i]).getProperty('value') == 'false')
		{
			var element = $('supp_' + tab[i]);
			var parent = element.getParent();
			var input = element.getNext();
			element.setProperty('class', 'activation');
			element.setProperty('src', 'param/activation.jpg');
			element.setProperty('alt', 'activer');
			
			parent.setStyle('background-image', 'url("param/bloc_o.jpg")');
			input.setProperty('disabled', true);
			input.setStyles({'opacity': 0.4, 'color': 'black'});
		}
	}
}

function addDragOnImage(element)
{
	// On crée un drag & drop sur l'image passé en argument, puis on gère la fin du drag (suppression de l'élément, ajout dans son bloc de départ, et ajout dans le bloc droppable si le drag tombe dessus
	var drag = new Drag.Move(element, 
	{
		droppables: $$('.act'),
		onStart: function () 
		{	
			var image = new Element('img', 
			{
				'class': element.getProperty('class'),
				'src': element.getProperty('src'),
				'alt': element.getProperty('alt')
			});
			element.getParent().adopt(image);
			addDragOnImage(image);
			
			element.addClass('dessus');
			element.setStyle('opacity', 0.6);
		},
		onComplete: function ()
		{
			element.removeClass('dessus');
			if (element.drop)
			{
				var id = element.droppable.getProperty('id');
				var livret = element.getProperty('src').contains('livret'); 
				
				// Contraintes : Impossible de mettre une fonction sur l'apprenti, le parent et le responsable de formation, hormis la conception du LEA pour l'apprenti et le parent
				if ((id != 'act_rl' && id != 'act_app') || (id == 'act_rl' && livret) || (id == 'act_app' && livret))
				{
					addFunction(element);
				}
			}
			element.remove();
		}
	});
}

function addFunction(element, role)
{
	// On cherche la div avec la classe "act_func", afin de vérifier que l'élément que l'on veut ajouter n'existe pas déjà
	// Pour éviter la redondance de fonctionnalités
	var droppable = (role == undefined) ? element.droppable : role;
	var children = droppable.getChildren();
	var exist = false;
	
	var	src = element.getProperty('src');
	// Test pour savoir si l'élément est déjà présent
	var eltTxt = src.substring(src.indexOf('logo_') + 5, src.indexOf('.png'));
	for (var i = 0 ; i < children.length ; i++)
	{
		if (children[i].getTag() == 'img')
		{
			// découpage des urls
			src = children[i].getProperty('src');
			var childTxt = src.substring(src.indexOf('petit_logo_') + 11, src.indexOf('.png'));
			
			if (childTxt == eltTxt)
				exist = true;
		}
	}
	
	// Test pour savoir si la fonction n'est pas celle du rôle (pour ne pas donner le droit de Gestion Web à l'admin, par exemple)
	if (!exist)
	{
		var id = droppable.getProperty('id');
		var idTxt = id.substring(id.indexOf('act_') + 4, id.length);
		if (eltTxt == idTxt)
			exist = true;
		if (idTxt == 'rf' && eltTxt == 'ens' || idTxt == 'ens' && eltTxt == 'rf')
			exist = true;
		if (!$('droitsradmin').getProperty('value').contains(idTxt))
			exist = true;
	}
	

	
	// On crée l'élément et on l'ajoute a la div "act"
	if (!exist)
	{
		var littleElement = new Element('img', {'src': 'param/petit_' + element.getProperty('src').substr(6), 'alt': element.getProperty('alt')});
		littleElement.addClass('cursor-supp');
		littleElement.setProperty('title', 'Supprimer');
		littleElement.addEvent('click', function () {this.remove();});
		droppable.adopt(littleElement);
	}
}

function deleteElement(element)
{
	var parent = element.getParent();
	var input = element.getNext();
	if (element.getProperty('class') == 'suppression')
	{
		// Désactivation (et l'icône devient celui de l'activation)
		element.setProperty('class', 'activation');
		element.setProperty('src', 'param/activation.jpg');
		element.setProperty('alt', 'activer');
		
		parent.setStyle('background-image', 'url("param/bloc_o.jpg")');
		input.setProperty('disabled', true);
		input.setStyles({'opacity': 0.4, 'color': 'black'});
	}
	else
	{
		// Activation (inversement pour l'icône)
		element.setProperty('class', 'suppression');
		element.setProperty('src', 'param/suppression.jpg');
		element.setProperty('alt', 'supprimer');
		
		parent.setStyle('background-image', 'url("param/bloc.jpg")');
		input.setProperty('disabled', false);
		input.setStyle('opacity', 1);
	}
	$('input_' + element.getProperty('id')).setProperty('value', !input.getProperty('disabled'));	
}

function submitTerm()
{
	var sr = $$('.act');
	$('droitsr').setProperty('value', '');
	for (var j = 0 ; j < sr.length ; j++)
	{
		var children = sr[j].getChildren();
		for (var i = 0 ; i < children.length ; i++)
		{
			if (children[i].getTag() == 'img' && children[i].getProperty('src').contains('livret'))
			{
				var id = children[i].getParent().getProperty('id');
				var txt = id.substring(id.indexOf('_') + 1, id.length);
				var value = $('droitsr').getProperty('value');
				if (!txt.contains('rf'))
					$('droitsr').setProperty('value', value == '' ? value + txt : value + ',' + txt);
			}
		}
	}
}