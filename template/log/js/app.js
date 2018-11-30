
var v = new Vue ({

	el: '.bloc',

	data: {
		identifiant: '',
		mdp : '',
		identifiantError : false,
		passwordError : true,
	}

})



$(document).ready(function(){

	
		$('.ui.checkbox').checkbox();

		$( ".btn-envoi" ).click(function() {
			// alert(v.identifiant)
		  });
		
})

// v.identifiantError = false;



// v.identifiantError = false;
