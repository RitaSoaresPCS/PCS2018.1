var UsuarioParceriaComunidade = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/UsuarioParceriaComunidade.php";
	this.nomeEntidade = "UsuarioParceriaComunidade";

	this.getByNome = function (nome, idComunidade, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "getByNome" + this.nomeEntidade, nome: nome, idComunidade: idComunidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	this.getParceiroByIdComunidade = function (idComunidade, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "getParceiroByIdComunidade", idComunidade: idComunidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	
	this.remover = function (idUsuario, idComunidade, callback = function(data) {}) {
		var confirmar = confirm('Deseja realmente remover este parceiro?');
		if (confirmar) {
			$.post(
				this.controladorURL, 
				{ func: "remover" + this.nomeEntidade, idUsuario: idUsuario, idComunidade: idComunidade }, 
				function(data) {
					callback(data);
				},
				"json"
			);
		}
	}
	
	this.enviarConviteParceiro = function (idComunidade, email, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "enviarConviteParceiro", idComunidade: idComunidade, email: email }, 
			function(data) {
				callback(data);
			},
			"json"
		);

	}

}
