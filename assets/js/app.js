
function verifPassword(chaine){
	var regPassword = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	return (regPassword.test(chaine.trim()));
}

function verifMail(chaine){
	var regMail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');
	return (regMail.test(chaine.trim()));
}

function verifLongueur(chaine, longueurMini, longueurMax){
	if (chaine.trim().length >= longueurMini && chaine.trim().length <= longueurMax ) {
		return true;
	}
	else{
		return false;
	}
}