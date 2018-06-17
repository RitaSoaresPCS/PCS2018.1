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


}
