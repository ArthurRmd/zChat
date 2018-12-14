
var v = new Vue({
	el: '#app',

	data: {
		//Pseudo
		pseudo: '',
		pseudoError: false,

		msgPseudoError: false,
		textePseudoError: "L'adresse mail donné n'est pas compatible",
		msgPseudo: false,
		textePseudo: "Veuillez remplir le champs",

		//Password
		mdp: '',
		mdpError: false,

		msgMdpError: false,
		texteMdpError: "Le mot de passe n'est pas bon",
		msgMdp: false,
		texteMdp: "Veuillez remplir le champs",

		check: true,
	}
})
Vue.config.devtools = true;

$(document).ready(function () {
	$('.ui.checkbox').checkbox();

	$(".btn-envoi").click(function () {
		if (!v.msgPseudoError && !v.msgMdp) {
			connexion_bdd().then(afterConnect);
		}
	});

	$("#pseudo").focusout(function () {
		if (!verifLongueur(v.pseudo, 3, 15)) {
			v.msgPseudoError = true;
			v.pseudoError = true;

		}
		else {
			v.msgPseudoError = false;
			v.pseudoError = false;
		}
	})

	$("#mdp").focusout(function () {
		if (!verifPassword(v.mdp)) {
			v.msgMdpError = true;
			v.mdpError = true;
		}
		else {
			v.msgMdpError = false;
			v.mdpError = false;
		}
	})

})


function connexion_bdd() {
	var content = { pseudo: v.pseudo, mdp: v.mdp }; //object

	return fetch('../../api/controllers/connexion.php', {
		method: 'POST',
		headers: { "Content-type": "application/json" },
		body: JSON.stringify(content)
	})
		.then(res => res.json())
		.then(res => {
			console.log(res)
			return res
		});
}

function afterConnect(res) {
	if (res == "connecter") {
		location.href = "page.php"
	}
	else if (res == "mdp_pas_bon" || res == "pseudo_pas_bon") {
		v.texteMdpError = "L'addresse e-mail ou le mot de passe n'est pas bonne"
		v.msgMdpError = true
	}
	else if (res == false) {
		alert("Merci de remplir")
	}
	v.mdpError = true;
	v.PseudoError = true;
}