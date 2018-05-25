var Comunidade = new function() {
	$.ajaxSetup({ cache: false });
    this.filePath = "../Dados/Comunidade.xml";
	this.tagName = "comunidade";
	this.controladorURL = "ControleDados/Comunidade.php";

    this.listar = function () {
		return Base.listar(this.filePath, this.tagName);
    }
	
	
	this.getById = function (id) {
		return Base.getById(id, this.filePath, this.tagName);
    }
	
	
	this.getByNome = function (pesquisa) {
		return Base.getByNome(pesquisa, this.filePath, this.tagName);
	}
	
	
	this.adicionar = function (nome, descricao, tema, idUsuarioAdministrador) {
		var comunidades = this.listar();
		
		// Último id existente:
		var ultimoId = parseInt(comunidades[comunidades.length - 1].children[0].innerHTML);
		
		var id = String(ultimoId + 1);
		var dataCriacao = moment(new Date()).format('DD/MM/YYYY');
		
		$.post(this.controladorURL, { 
			func: "adicionar",
			id: id, 
			nome: nome,
			descricao: descricao,
			dataCriacao: dataCriacao,
			dataUltimaEdicao: "",
			tema: tema,
			ativa: "true",
			idUsuarioAdministrador: idUsuarioAdministrador
		} );
	}
	
	
	
	this.editar = function (id, nome, descricao, tema, idUsuarioAdministrador) {
		var dataUltimaEdicao = moment(new Date()).format('DD/MM/YYYY');
		
		$.post(this.controladorURL, { 
			func: "editar",
			id: id, 
			nome: nome,
			descricao: descricao,
			dataUltimaEdicao: dataUltimaEdicao,
			tema: tema,
			idUsuarioAdministrador: idUsuarioAdministrador
		} );
	}
	
	
	// Inativar.
	this.remover = function (id) {
		Base.inativar(id, this.controladorURL);
	}
	
	this.desativarLaboratorio = function (id) {
		var confirmou = confirm("Deseja realmente desativar a comunidade?");
		if (confirmou) {
			this.remover(id);
			window.location.assign('laboratorios.html');
		} 
	}
}
