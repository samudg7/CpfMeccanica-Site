
function checkNome(name){
	var pattern = /^[a-zA-Z0-9\s]{3,}$/i;//Almeno 3 caratteri alfanumerici, case insensitive
	if(pattern.test(name)){
		return true;
	}else{
		return false;
	}
}

function checkMail(email){
	var pattern = /\w+@\w+\.\w{2,4}/i;//qualcosa @ qualcosa . qualcosa(2-4 caratteri)
	if(pattern.test(email)){
		return true;
	}else{
		return false;
	}
}

function validazioneForm(){
	var isNomeOk = checkNome(document.getElementById("name").value);
	var isMailOk = checkMail(document.getElementById("email").value);
	
	if(isNomeOk == true){
		if(isMailOk == true){
			return true;
		}else{
			alert ("Mail errata: forse hai sbagliato a digitare, controlla");
			return false;
		}
	}else{
		alert ("Nome errato: deve contenere almeno 3 caratteri");
		return false;
	}
}
