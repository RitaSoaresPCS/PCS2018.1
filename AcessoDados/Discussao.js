var Discussao = new function() {
	$.ajaxSetup({ cache: false });
    this.filePath = "../Dados/Discussao.xml";
	this.tagName = "discussao";
	this.controladorURL = "ControleDados/Discussao.php";

    this.listar = function () {
		return Base.listar(this.filePath, this.tagName);
    }


	this.getById = function (id) {
		return Base.getById(id, this.filePath, this.tagName);
    }


	this.getByNome = function (pesquisa) {
		return Base.getByNome(pesquisa, this.filePath, this.tagName);
	}


	this.adicionar = function (titulo, descricao) {
		var discussoes = this.listar();

		// Último id existente:
		var ultimoId = parseInt(discussoes[discussoes.length - 1].children[0].innerHTML);

		var id = String(ultimoId + 1);
		var dataCriacao = moment(new Date()).format('DD/MM/YYYY');

		$.post(this.controladorURL, {
			func: "adicionar",
			id: id,
			titulo: titulo,
			descricao: descricao,
			dataCriacao: dataCriacao,
			dataUltimaEdicao: "",
			ativo: "true"
		} );
	}



	this.editar = function (id, nome, descricao) {
		var dataUltimaEdicao = moment(new Date()).format('DD/MM/YYYY');

		$.post(this.controladorURL, {
			func: "editar",
			id: id,
			nome: nome,
			descricao: descricao,
			dataUltimaEdicao: dataUltimaEdicao,
		} );
	}


	// Inativar.
	this.remover = function (id) {
		Base.inativar(id, this.controladorURL);
	}

}
