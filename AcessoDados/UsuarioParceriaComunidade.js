var UsuarioParceriaComunidade = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/UsuarioParceriaComunidade.php";

	this.getByNome = function (nome, idComunidade, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getByNome", nome: nome, idComunidade: idComunidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
}
