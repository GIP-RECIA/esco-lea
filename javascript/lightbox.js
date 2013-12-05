/**
 * 
 * @param div Div cachée que l'on veut faire apparaitre dans la LightBox
 * @param boolean closeOnBg Un clic sur le fond noir ferme la lightbox
 * @param boolean closeButton Une croix apparait en haut à gauche pour fermer la lightbox
 */
function lightbox(div, root, closeOnBg, closeButton){
	var lightbox = new Element('div',
		{
			'id': 'lightbox',
			'styles': {
				'position': 'absolute',
				'height': window.getHeight(),
				'width': window.getWidth(),
				'z-index': 98,
				'top': 0,
				'left': 0,
				'opacity': 0.6,
				'background-color': '#000'
			}
		});
		var clone = $(div).clone();
		var a=$(document.body);		// Rustine pour IE...
		document.body.adopt(lightbox);
		document.body.adopt(clone);
		
		clone.setStyles({
			'display': '',
			'position':'absolute',
			'z-index': '99',
			'width': window.getWidth()/2,
			'left': window.getWidth()/4,
			'opacity': 1,
			'background-color': '#FFF',
			'border': '2px solid #000'
		});
		var height = window.getHeight()/2 - (clone.getSize().size.y/2);
		clone.setStyle('top', height);
		
		if (closeOnBg == true || closeOnBg == null) {
			lightbox.addEvent('click', function(){
				this.remove();
				clone.remove();
			});
		}

		if (closeButton == true || closeButton == null){
			var close = new Element('img', {
				'src': root + '/javascript/croix.jpg',
				'styles': {
					'float': 'right',
					'cursor': 'pointer',
					'margin': '2px'
				},
				'events': {
					'click': function(){
						lightbox.remove();
						clone.remove();
					},
					'mouseover': function(){
						this.setProperty('src', root + '/javascript/croixOver.jpg');
					},
					'mouseout': function(){
						this.setProperty('src', root + '/javascript/croix.jpg');
					}
				}
			}).inject(clone, 'top');
		}
}
