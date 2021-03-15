var immagine=1;

function Avanti(){
	console.log("avanti");
    immagine++;
	if (immagine > 4)
		immagine = 1;
	document.getElementById("immagine").src = "../img/fotochi/foto(" + immagine + ").jpg";
}

function Indietro(){
	immagine--;
	if (immagine < 1)
	    immagine = 4;
	document.getElementById("immagine").src = "../img/fotochi/foto(" + immagine + ").jpg";
}