// JavaScript Document


/*Menu */

function menu(id){
	document.getElementById(id).className= "hover";
}

function menuoff(id){
   document.getElementById(id).className= "onglet";
}


/*sous menu*/

function sousmenu(id){
	document.getElementById(id).className= "ssmenu_hover";
}

function sousmenuoff(id){
   document.getElementById(id).className= "ssmenu";
}

/*window.onload=cacherTout;

function cacherTout(id) {
var d = document.getElementById(id);

for (var i = 1; i<=10; i++) {
		if (document.getElementById('smenu'+i)) {document.getElementById('smenu'+i).style.display='none';}
	}
}

function montre(id) {
var d = document.getElementById(id);
if (d){


	if(d.style.display=='none'){
		d.style.display='block'
		d.style.height="0px!important"
		d.style.overflowY="hidden"
		
		 var nb=0;
 
			 for (var i = 1; i<=10; i++) {
					
				if (document.getElementById('s'+id+i)) {nb+=1}
				
			}
		var taille=nb*23;
		taille+=10;
		boite_agrandir(id,10,taille)
		

	}	else  {
	
		
		 var nb=0;
 
			 for (var i = 1; i<=10; i++) {
					
				if (document.getElementById('s'+id+i)) {nb+=1}
				
			}
		var taille=nb*23;
		taille+=10;
		d.style.overflowY="hidden"
		boite_reduire(id,taille)


		}

}


}

function boite_agrandir(id,compteur,taille) {


 var d = document.getElementById(id);
 




if (compteur<=taille) {
	
compteur+=5;


	d.style.height=compteur+"px!important"

	//alert(compteur+"px!important");
	setTimeout("boite_agrandir('"+id+"',"+compteur+","+taille+")",50);
} else {
	d.style.display='block'
		d.style.height="100%!important"
		d.style.overflowY="auto"
}
}

function boite_reduire(id,compteur) {


 var d = document.getElementById(id);
 
	if (compteur>=0) {
	
		compteur-=5;
	
	
		d.style.height=compteur+"px!important"
	
		//alert(compteur+"px!important");
		setTimeout("boite_reduire('"+id+"',"+compteur+")",50);
	} else {
		d.style.display='none'
			d.style.height=""
			d.style.overflowY="hidden"
	}
}

function boite_alerte_deplace()
     {
     
	 if (boite_alerte_box2<boite_alerte_hauteur){
		largeur_debut=0;
	 } else {
		largeur_debut=10;
	 }
     document.getElementById("boite_alerte").style.left = (boite_alerte_posX-(boite_alerte_box/2)-5)+'px';
     document.getElementById("boite_alerte").style.width = (boite_alerte_box+largeur_debut)+'px';
	 document.getElementById("boite_alerte").style.top = (boite_alerte_posY-(boite_alerte_box2/2)-5)+'px';
     document.getElementById("boite_alerte").style.height = (boite_alerte_box2)+'px';
	 if (boite_alerte_box2<boite_alerte_hauteur){
    	 boite_alerte_box += 0;
	 } else {
    	 boite_alerte_box += 10;
	 }
	 
	 if (boite_alerte_box2<boite_alerte_hauteur){
	 	boite_alerte_box2 +=8;
	 } 
	 
     if((boite_alerte_box<boite_alerte_largeur))
         setTimeout("boite_alerte_deplace()",10);
     else
         {
         document.getElementById("boite_alerte").innerHTML = '<div style="padding:10px"><h3>Essai de panier</h3><div class="txt_alerte">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Panier à restyliser.</div><a href="javascript:boite_alerte_close()">Fermer</a></div>';
         }
     }
*/
