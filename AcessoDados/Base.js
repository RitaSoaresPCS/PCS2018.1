var Base = new function() {
	$.ajaxSetup({ cache: false });

    this.listar = function (controladorURL, callback = function(data) {}) {
		
		// jQuery.post( url [, data ] [, success ] [, dataType ] )
		$.post(
			controladorURL, 
			{ func: "listar" }, 
			function(data) {
				callback(data);
			},
			"json"
		);
		
    }


	this.getById = function (id, controladorURL, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getById", id: id }, 
			function(data) {
				callback(data);
			},
			"json"
		);
    }

	
	this.getByDescricao = function (descricao, controladorURL, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getByDescricao", descricao: descricao }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	

	this.getByNome = function (nome, controladorURL, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getByNome", nome: nome }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}

	
	this.getByNomeIgual = function (nome, controladorURL, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getByNomeIgual", nome: nome }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}


	this.inativar = function (id, controladorURL, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "inativar", id: id }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	
	// Pega os parâmetros de uma URL que tenha GET.
	// Exemplo: laboratorios.html?id=4
	// Base.getUrlParameter("id") retorna o número 4.
	this.getUrlParameter = function (sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	
  }
}
