var UsuarioAmizadeUsuario = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/UsuarioAmizadeUsuario.php";
	this.nomeEntidade = "UsuarioAmizadeUsuario";

	this.getAmizade = function (idVisualizador, idPerfil, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "getAmizade", idVisualizador: idVisualizador, idPerfil: idPerfil }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	
	this.remover = function (idVisualizador, idPerfil, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "remover" + this.nomeEntidade, idVisualizador: idVisualizador, idPerfil: idPerfil }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	
	this.adicionar = function (idVisualizador, idPerfil, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "adicionar" + this.nomeEntidade, idVisualizador: idVisualizador, idPerfil: idPerfil }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
}
