// TODO :
// - icone de suppression
// - chargement
// - version formation
// - contraintes

window.onload = function ()
{
	// on r�cup�re les images, et on appelle la fonction g�rant le drag
	// le prototype sert � g�rer les bool�ens pour le r�sultat d'un drag
	var images = $$('.func_img');
	//Object.prototype.drop = false;
	//Object.prototype.droppable = undefined;
	for (var i = 0 ; i < images.length ; i++)
	{
		if(images[i].getProperty('src')!='param/logo_rf.png'){addDragOnImage(images[i]);}
	}
	
	// on s'occupe de g�rer le r�sultat d'un drag, via les deux nouvelles propri�t�s d'un objet (drop -> si il est tomb� sur l'�l�ment droppable | droppable -> l'�l�ment recepteur)
	// gestion du chargement des fonctionnalit�s
	var act = $$('.act');
	act.each(function (e)
	{
		e.drop = false;
		e.droppable = undefined;
	});
	for (var i = 0 ; i < act.length ; i++)
	{
		act.addEvent('over', function (e) {e.drop = true; e.droppable = this;});
		act.addEvent('leave', function (e) {e.drop = false; e.droppable = undefined;});
		var children = act[i].getChildren();
		for (var j = 0 ; j < children.length ; j++)
		{
			if (children[j].getTag() == 'img')
			{
				children[j].addEvent('click', function () {this.remove();});
				children[j].setStyle('cursor', 'pointer');
				children[j].addClass('cursor-supp');
			}
		}
	}
	
	// g�re l'agrandissement d'un bloc de fonctionnalit�s
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
			var tab = [children[1], children[2], children[3]];
		
			if (element.getSize().size.y <= 30)
			{
				this.setProperty('src', 'param/fermeture.jpg');
				new Fx.Style(element, 'height',  {duration: 250, onComplete: function ()
				{
					for (var i = 0 ; i < tab.length ; i++)
						tab[i].setStyle('display', 'block');
				}}).start(195);	
			}
			else
			{
				this.setProperty('src', 'param/ouverture.jpg');
				new Fx.Style(element, 'height',  {duration: 250}).start(19);
				for (var i = 0 ; i < tab.length ; i++)
					tab[i].setStyle('display', 'none');
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
	
	// par d�faut :
	var tab = ['rvs', 'rl', 'unit_pedag', 'suivi_entr'];
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
	// On cr�e un drag & drop sur l'image pass� en argument, puis on g�re la fin du drag (suppression de l'�l�ment, ajout dans son bloc de d�part, et ajout dans le bloc droppable si le drag tombe dessus
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
					if (id == 'act_rf')
						addFunction(element, $('act_ens'));
					else if (id == 'act_ens')
						addFunction(element, $('act_rf'));
				}
			}
			element.remove();
		}
	});
}

function addFunction(element, role)
{
	// On cherche la div avec la classe "act_func", afin de v�rifier que l'�l�ment que l'on veut ajouter n'existe pas d�j�
	// Pour �viter la redondance de fonctionnalit�s
	var droppable = (role == undefined) ? element.droppable : role;
	var children = droppable.getChildren();
	var exist = false;
	
	var	src = element.getProperty('src');
	var eltTxt = src.substring(src.indexOf('logo_') + 5, src.indexOf('.png'));
	for (var i = 0 ; i < children.length ; i++)
	{
		if (children[i].getTag() == 'img')
		{
			// d�coupage des urls
			src = children[i].getProperty('src');
			var childTxt = src.substring(src.indexOf('petit_logo_') + 11, src.indexOf('.png'));
			
			if (childTxt == eltTxt)
				exist = true;
		}
	}
	
	if (!exist)
	{
		var id = droppable.getProperty('id');
		var idTxt = id.substring(id.indexOf('act_') + 4, id.length);
		if (eltTxt == idTxt)
			exist = true;
		if (idTxt == 'rf' && eltTxt == 'ens' || idTxt == 'ens' && eltTxt == 'rf')
			exist = true;
	}
	
	// On cr�e l'�l�ment et on l'ajoute a la div "act"
	if (!exist)
	{
		var littleElement = new Element('img', {'src': 'param/petit_' + element.getProperty('src').substr(6), 'alt': element.getProperty('alt')});
		littleElement.addClass('cursor-supp');
		littleElement.setProperty('title', 'Supprimer');
		littleElement.addEvent('click', function () 
		{
			var id = this.getParent().getProperty('id');
			if (id == 'act_ens' || id == 'act_rf')
			{
				var children = (id == 'act_ens') ? $('act_rf').getChildren() : $('act_ens').getChildren();
				for (var i = 0 ; i < children.length ; i++)
					if (children[i].getTag() == 'img' && children[i].getProperty('src') == this.getProperty('src'))
						children[i].remove();
			}
			this.remove();
		});
		droppable.adopt(littleElement);
	}
}

function deleteElement(element)
{
	var parent = element.getParent();
	var input = element.getNext();
	if (element.getProperty('class') == 'suppression')
	{
		// D�sactivation (et l'ic�ne devient celui de l'activation)
		element.setProperty('class', 'activation');
		element.setProperty('src', 'param/activation.jpg');
		element.setProperty('alt', 'activer');
		
		parent.setStyle('background-image', 'url("param/bloc_o.jpg")');
		input.setProperty('disabled', true);
		input.setStyles({'opacity': 0.4, 'color': 'black'});
	}
	else
	{
		// Activation (inversement pour l'ic�ne)
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
	var tab = ['admin', 'rvs', 'ens', 'ma'];
	for (var j = 0 ; j < tab.length ; j++)
	{
		var droit = $('droit' + tab[j]);
		switch (tab[j])
		{
			case 'admin':
				droit.setProperty('value', 'admin');
				break;
			case 'rvs':
				droit.setProperty('value', 'rvs');
				break;
			case 'ens':
				droit.setProperty('value', 'ens');
				break;
			case 'ma':
				droit.setProperty('value', 'ma');
				break;
		}
		var children = $('act_' + tab[j]).getChildren();
		for (var i = 0 ; i < children.length ; i++)
		{
			if (children[i].getTag() == 'img')
			{
				// attention : on ajoute le droit en fonction du src de l'image, le nom de l'image doit donc �tre du type "logo_droit.extension"
				// il ne doit pas y avoir de "_" ou de "." en plus du logo"_"droit"."extension
				var src = children[i].getProperty('src');
				// taille de petit_logo_ -> 11
				var txt = src.substring(src.indexOf('petit_logo_') + 11, src.indexOf('.'));
				if (txt != 'livret')
				{
					var value = droit.getProperty('value');
					droit.setProperty('value', value == '' ? value + txt : value + ',' + txt);
				}
			}
		}
	}
	
	if ($('input_supp_rvs').getProperty('value') == 'false')
		$('droitrvs').setProperty('value', '');
	
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