var Usuario = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/Usuario.php";

    this.listar = function () {
		return Base.listar(this.controladorURL);
    }

	this.getById = function (id) {
		return Base.getById(id, this.controladorURL);
    }

	this.getByNome = function (pesquisa) {
		return Base.getByNome(pesquisa, this.controladorURL);
	}

	this.getByNomeIgual = function(pesquisa)
	{
		return Base.getByNomeIgual(pesquisa, this.controladorURL);
	}
	
	
	// Inativar.
	this.remover = function (id) {
		return Base.inativar(id, this.controladorURL);
	}

	this.adicionar = function (username, email, instituicaoOrigem, titulo, cpf, nome, idComunidadePertence) {
		$.post(
			this.controladorURL, 
			{ 
				func: "adicionar", 
				username: username, 
				email: email,
				instituicaoOrigem: instituicaoOrigem,
				titulo: titulo,
				cpf: cpf,
				nome: nome,
				idComunidadePertence: idComunidadePertence
			}, 
			function(data) {
				if (data.erro) {
					alert(data.mensagem);
				}
			}, 
			"json" 
		);
	}


	this.editar = function (id, username, email, instituicaoOrigem, titulo, cpf, nome, idComunidadePertence) {
		$.post(
			this.controladorURL, 
			{ 
				func: "editar", 
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
				if (data.erro) {
					alert(data.mensagem);
				}
			}, 
			"json" 
		);
	}

}
