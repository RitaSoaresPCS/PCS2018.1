var Anexo = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/Anexo.php";

	
	this.getAnexoByIdDiscussao = function (idDiscussao, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "getAnexoByIdDiscussao", idDiscussao: idDiscussao }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	
    this.getAnexoByNomeEIdDiscussao = function (nome, idDiscussao, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "getAnexoByNomeEIdDiscussao", nome: nome, idDiscussao: idDiscussao }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	this.getAnexoByNomeEIdComunidade = function (nome, idComunidade, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "getAnexoByNomeEIdComunidade", nome: nome, idComunidade: idComunidade }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	
	this.removerAnexoDiscussao = function (idAnexo, idDiscussao, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "removerAnexoDiscussao", idAnexo: idAnexo, idDiscussao: idDiscussao }, 
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	
	this.uploadFileDiscussao = function(form, callback = function(data){}){
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: this.controladorURL,
			data: form,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
				callback(data);
			}
		});

    }

}
