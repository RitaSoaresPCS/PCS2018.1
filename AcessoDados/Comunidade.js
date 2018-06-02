var Comunidade = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/Comunidade.php";

    this.listar = function (callback = function() {}) {
		return Base.listar(this.controladorURL, callback);
    }

	this.getById = function (id) {
		return Base.getById(id, this.controladorURL);
    }

	this.getByNome = function (pesquisa) {
		return Base.getByNome(pesquisa, this.controladorURL);
	}
	
	// Inativar.
	this.remover = function (id, callback = function() {}) {
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
	

	this.adicionar = function (nome, descricao, tema, usernameAdmin) {
		$.post(this.controladorURL, {
			func: "adicionar",
			nome: nome,
			descricao: descricao,
			tema: tema,
			usernameAdmin: usernameAdmin
		} );
	}



	this.editar = function (id, nome, descricao, tema, usernameAdmin) {
		$.post(this.controladorURL, {
			func: "editar",
			id: id,
			nome: nome,
			descricao: descricao,
			tema: tema,
			usernameAdmin: usernameAdmin
		} );
	}

}
