var UsuarioVisualizaComunidade = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/UsuarioVisualizaComunidade.php";
	this.nomeEntidade = "UsuarioVisualizaComunidade";

	this.verificarPermissao = function (idUsuario, idComunidade, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "verificarPermissao" + this.nomeEntidade, idUsuario: idUsuario, idComunidade: idComunidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	this.solicitarAcesso = function (idUsuario, idComunidade, justificativa, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "solicitarAcesso" + this.nomeEntidade, idUsuario: idUsuario, idComunidade: idComunidade, justificativa: justificativa }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}

}
