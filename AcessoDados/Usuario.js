var Usuario = new function() {
	$.ajaxSetup({ cache: false });

	this.controladorURL = "ControleDados/Usuario.php";
	this.nomeEntidade = "Usuario";

    this.listar = function (callback = function(data) {}) {
		return Base.listar(this.controladorURL, this.nomeEntidade, callback);
    }

	this.getById = function (id, callback = function(data) {}) {
		return Base.getById(id, this.controladorURL, this.nomeEntidade, callback);
    }

	this.getByNome = function (pesquisa, callback = function(data) {}) {
		return Base.getByNome(pesquisa, this.controladorURL, this.nomeEntidade, callback);
	}

	this.getByNomeIgual = function(pesquisa, callback = function(data) {}) {
		return Base.getByNomeIgual(pesquisa, this.controladorURL, this.nomeEntidade, callback);
	}

	// Inativar.
	this.remover = function (id, callback = function(data) {}) {
		return Base.inativar(id, this.controladorURL, this.nomeEntidade, callback);
	}

	this.listarUsuariosPermissao = function(callback = function(data){}){
		$.post(
			this.controladorURL,
			{func: 'listarUsuariosPermissao'},
			function(data){
				callback(data);
			},
			'json'

		);
	}

	this.adicionar = function (username, email, instituicaoOrigem, titulo, cpf, nome, idComunidadePertence, callback = function(data) {}) {
		$.post(
			this.controladorURL,
			{
				func: "adicionar" + this.nomeEntidade,
				username: username,
				email: email,
				instituicaoOrigem: instituicaoOrigem,
				titulo: titulo,
				cpf: cpf,
				nome: nome,
				idComunidadePertence: idComunidadePertence
			},
			function(data) {
				callback(data);
			},
			"json"
		);
	}


	this.editar = function (id, username, email, instituicaoOrigem, titulo, cpf, nome, idComunidadePertence, callback = function(data) {}) {
		$.post(
			this.controladorURL,
			{
				func: "editar" + this.nomeEntidade,
				id: id,
				username: username,
				email: email,
				instituicaoOrigem: instituicaoOrigem,
				titulo: titulo,
				cpf: cpf,
				nome: nome,
				idComunidadePertence: idComunidadePertence
			},
			function(data) {
				callback(data);
			},
			"json"
		);
	}
	
	
	this.enviarConviteMembro = function (idComunidade, email, callback = function(data) {}) {
		$.post(
			this.controladorURL, 
			{ func: "enviarConviteMembro", idComunidade: idComunidade, email: email }, 
			function(data) {
				callback(data);
			},
			"json"
		);

	}

}
