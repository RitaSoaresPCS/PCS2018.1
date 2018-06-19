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
}
