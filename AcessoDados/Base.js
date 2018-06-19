var Base = new function() {
	$.ajaxSetup({ cache: false });

    this.listar = function (controladorURL, nomeEntidade = "", callback = function(data) {}) {
		
		// jQuery.post( url [, data ] [, success ] [, dataType ] )
		$.post(
			controladorURL, 
			{ func: "listar" + nomeEntidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
		
    }


	this.getById = function (id, controladorURL, nomeEntidade = "", callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getById" + nomeEntidade, id: id }, 
			function(data) {
				callback(data);
			},
			"json"
		);
    }

	
	this.getByDescricao = function (descricao, controladorURL, nomeEntidade = "", callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getByDescricao" + nomeEntidade, descricao: descricao }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	

	this.getByNome = function (nome, controladorURL, nomeEntidade = "", callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getByNome" + nomeEntidade, nome: nome }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}

	
	this.getByNomeIgual = function (nome, controladorURL, nomeEntidade = "", callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getByNomeIgual" + nomeEntidade, nome: nome }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}


	this.inativar = function (id, controladorURL, nomeEntidade = "", callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "inativar" + nomeEntidade, id: id }, 
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
