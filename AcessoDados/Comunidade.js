var Comunidade = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/Comunidade.php";

    this.listar = function (callback = function(data) {}) {
		return Base.listar(this.controladorURL, callback);
    }

	this.getById = function (id, callback = function(data) {}) {
		return Base.getById(id, this.controladorURL, callback);
    }

	this.getByNome = function (pesquisa, callback = function(data) {}) {
		return Base.getByNome(pesquisa, this.controladorURL, callback);
	}
	
	this.getByDescricao = function (pesquisa, callback = function(data) {}) {
		return Base.getByDescricao(pesquisa, this.controladorURL, callback);
	}
	
	
	// Inativar.
	this.remover = function (id, callback = function(data) {}) {
		return Base.inativar(id, this.controladorURL, callback);
	}
	
	this.desativarLaboratorio = function (id) {
		var confirmou = confirm("Deseja realmente desativar a comunidade?");
		if (confirmou) {
			this.remover(id, function(data) {
				if (data.erro == false) {
					window.location.assign('laboratorios.html');
				}
			});
		} 
	}
	

	this.adicionar = function (nome, descricao, tema, usernameAdmin, callback = function(data) {} ) {
		$.post(this.controladorURL, {
			func: "adicionar",
			nome: nome,
			descricao: descricao,
			tema: tema,
			usernameAdmin: usernameAdmin
			},
			function(data) {
				callback(data);
			},
			"json" 
		);
	}



	this.editar = function (id, nome, descricao, tema, usernameAdmin, callback = function(data) {} ) {		
		$.post(this.controladorURL, {
			func: "editar",
			id: id,
			nome: nome,
			descricao: descricao,
			tema: tema,
			usernameAdmin: usernameAdmin
			},
			function(data) {
				callback(data);
			},
			"json"
		);
	}

}
