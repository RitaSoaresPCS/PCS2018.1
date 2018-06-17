var MensagemDiscussao = new function() {
	$.ajaxSetup({ cache: false });

	this.controladorURL = "ControleDados/MensagemDiscussao.php";
	this.nomeEntidade = "MensagemDiscussao";

	this.getByIdDiscussao = function (id, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "getByIdDiscussao" + this.nomeEntidade, id: id }, 
			function(data) {
				callback(data);
			},
			"json"
		);
    }
	
	
	this.remover = function (id, callback = function(data) {}) {
		var confirmar = confirm('Deseja realmente remover a mensagem?');
		if (confirmar) {
			$.post(
			this.controladorURL,
			{ func: "removerMensagemDiscussao", id: id },
			function(data) {
				callback(data);
			},
			"json"
			);
		}
	}

	
	this.adicionar = function (idUsuarioCriador, idDiscussao, conteudo, callback = function(data) {}) {
		$.post(
		this.controladorURL,
		{ 
			func: "adicionarMensagemDiscussao", 
			idUsuarioCriador: idUsuarioCriador, 
			idDiscussao: idDiscussao,
			conteudo: conteudo
		},
		function(data) {
			callback(data);
		},
		"json"
		);
	}
	
	
	this.editar = function (id, conteudo, callback = function(data) {}) {
		$.post(
		this.controladorURL,
		{ 
			func: "editarMensagemDiscussao", 
			id: id,
			conteudo: conteudo
		},
		function(data) {
			callback(data);
		},
		"json"
		);
	}
	
}
