var Anexo = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/Anexo.php";

    this.getAnexoByNomeEIdDiscussao = function (nome, idDiscussao, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getAnexoByNomeEIdDiscussao", nome: nome, idDiscussao: idDiscussao }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	this.getAnexoByNomeEIdComunidade = function (nome, idComunidade, callback = function(data) {}) {
		$.post(
			controladorURL, 
			{ func: "getAnexoByNomeEIdComunidade", nome: nome, idComunidade: idComunidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}

}
