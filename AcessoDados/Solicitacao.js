var Usuario = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/Solicitacao.php";

    this.listarSolicitacaoComunidade = function (idComunidade, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "listarSolicitacaoComunidade", idComunidade: idComunidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
    }
	
	this.getSolicitacaoComunidadeByNomeUsuario = function (nome, idComunidade, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getSolicitacaoComunidadeByNomeUsuario", nome: nome, idComunidade: idComunidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}

}
