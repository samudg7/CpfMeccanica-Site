
function controlla_inserisci(){
	var titolo=document.getElementById("aggTitolo").value;
	var testo=document.getElementById("message").value;
	if(titolo == "" || testo == ""){
		alert ("Errore: non hai scritto niente.");
		return false;
	}else{
		return true;
	}
}


function controlla_rimuovi(){
	var titolo=document.getElementById("rmTitolo").value;
	var cancella = confirm("Stai per cancellare l'articolo \""+titolo+"\"");
	if(cancella == true){
		return true;
	}else{
		return false;
	}
}


function controlla_commento(){
	var commento=document.getElementById("txtcommento").value;
	if(commento == ""){
		alert ("Errore: non hai scritto niente.");
		return false;
	}else{
		return true;
	}
}


function controlla_newUser(){
	var nome=document.getElementById("regNome").value;
	var utente=document.getElementById("regUser").value;
	var pwd=document.getElementById("regPwd").value;
	
	if(nome == "" || utente == "" || pwd == ""){
		alert ("Errore: hai lasciato qualche campo vuoto.");
		return false;
	}else{
		return true;
	}
}