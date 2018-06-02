var Discussao = new function() {
	$.ajaxSetup({ cache: false });
	
	this.controladorURL = "ControleDados/Discussao.php";

    this.listar = function () {
		return Base.listar(this.controladorURL);
    }

	this.getById = function (id) {
		return Base.getById(id, this.controladorURL);
    }

	this.getByTitulo = function (pesquisa) {
		$.post(
			this.controladorURL, 
			{ func: "getByTitulo", titulo: pesquisa }, 
			function(data) {
				alert(data);
			},
			"json"
		);
	}

	// Inativar.
	this.remover = function (id) {
		return Base.inativar(id, this.controladorURL);
	}


	this.adicionar = function (idComunidadePertence, titulo, descricao, publica) {
		$.post(this.controladorURL, {
			func: "criar",
			idComunidadePertence: idComunidadePertence,
			titulo: titulo,
			descricao: descricao,
			publica: publica
		} );
	}


	this.editar = function (id, titulo, descricao, publica) {
		$.post(this.controladorURL, {
			func: "editar",
			id: id,
			titulo: titulo,
			descricao: descricao,
			publica: publica
		} );
	}

}
