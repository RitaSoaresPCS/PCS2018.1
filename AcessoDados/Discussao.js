var Discussao = new function() {
	$.ajaxSetup({ cache: false });

	this.controladorURL = "ControleDados/Discussao.php";
	this.nomeEntidade = "Discussao";

    this.listar = function (callback = function(data) {}) {
		return Base.listar(this.controladorURL, this.nomeEntidade, callback);
    }

	this.getById = function (id, callback = function(data) {}) {
		return Base.getById(id, this.controladorURL, this.nomeEntidade, callback);
    }

	// Inativar.
	this.remover = function (id, callback = function(data) {}) {
		var confirmar = confirm('Deseja remover a discussão?');
		if (confirmar) {
			$.post(
			this.controladorURL,
			{ func: "inativarDiscussao", id: id },
			function(data) {
				callback(data);
			},
			"json"
			);
		}
	}


	this.getByTitulo = function (pesquisa, idComunidadePertence, callback = function(data) {}) {
		$.post(
			this.controladorURL,
			{ func: "getByTitulo" + this.nomeEntidade, titulo: pesquisa, idComunidadePertence: idComunidadePertence },
			function(data) {
				callback(data);
			},
			"json"
		);
	}


	this.getByDescricao = function (pesquisa, idComunidadePertence, callback = function(data) {}) {
		$.post(
			this.controladorURL,
			{ func: "getByDescricao" + this.nomeEntidade, descricao: pesquisa, idComunidadePertence: idComunidadePertence },
			function(data) {
				callback(data);
			},
			"json"
		);
	}


	this.adicionar = function (idComunidadePertence, titulo, descricao, publica, userId, callback = function(data) {}) {
		$.post(this.controladorURL, {
			func: "criar" + this.nomeEntidade,
			idComunidadePertence: idComunidadePertence,
			titulo: titulo,
			descricao: descricao,
			publica: publica,
			userId: userId
			},
			function(data) {
				callback(data);
			},
			"json"
		);
	}


	this.editar = function (id, titulo, descricao, publica, callback = function(data) {}) {
		$.post(this.controladorURL, {
			func: "editar" + this.nomeEntidade,
			id: id,
			titulo: titulo,
			descricao: descricao,
			publica: publica
			},
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	this.getDiscussaoDoLab= function(labId, callback= function(data){}){
		$.post(
			this.controladorURL,
			{
				func: 'getDiscussaoDoLab',
				labId: labId
			},
			function(data){
				callback(data);
			},
			"json"
		);
	}
	this.mudarFixo= function(discussaoId, bool, callback = function(data){}){
		$.post(
			this.controladorURL,
			{
				func: 'mudarFixo',
				discussaoId: discussaoId,
				bool: bool
			},
			function(data){
				callback(data);
			},
			"json"
		);
	}


}
