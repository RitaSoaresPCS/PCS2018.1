var Usuario = new function() {
	$.ajaxSetup({ cache: false });
    this.filePath = "../Dados/Usuario.xml";
	this.tagName = "usuario";
	this.controladorURL = "ControleDados/Usuario.php";

    this.listar = function () {
		return Base.listar(this.filePath, this.tagName);
    }
	
	
	this.getById = function (id) {
		return Base.getById(id, this.filePath, this.tagName);
    }
	
	
	this.getByNome = function (pesquisa) {
		return Base.getByNome(pesquisa, this.filePath, this.tagName);
	}
	
	
	
	this.adicionar = function (username, email, instituicaoOrigem, titulo, cpf, nome, idComunidadePertence) {
		var usuarios = this.listar();
		
		// Último id existente:
		var ultimoId = parseInt(usuarios[usuarios.length - 1].children[0].innerHTML);
		
		var id = String(ultimoId + 1);
		
		$.post(this.controladorURL, { 
			func: "adicionar",
			id: id, 
			username: username,
			email: email,
			senha: "",
			urlImagemPerfil: "../Imagens/PerfilPadrao.png",
			ativo: "true",
			instituicaoOrigem: instituicaoOrigem,
			titulo: titulo,
			cpf: cpf,
			nome: nome,
			banidoSistema: "false",
			idComunidadePertence: idComunidadePertence
		}, function(data) {
			data = jQuery.parseJSON(data)
			if (data.erro) {
				alert(data.mensagem);
			}
		} );
	}
	
	
	this.editar = function (id, username, email, instituicaoOrigem, titulo, cpf, nome, idComunidadePertence) {
		var dataUltimaEdicao = moment(new Date()).format('DD/MM/YYYY');
		
		$.post(this.controladorURL, { 
			func: "editar",
			id: id, 
			username: username,
			email: email,
			instituicaoOrigem: instituicaoOrigem,
			titulo: titulo,
			cpf: cpf,
			nome: nome,
			idComunidadePertence: idComunidadePertence
		}, function(data) {
			data = jQuery.parseJSON(data)
			if (data.erro) {
				alert(data.mensagem);
			}
		} );
	}
	
	
	// Inativar.
	this.remover = function (id) {
		Base.inativar(id, this.controladorURL);
	}
	
}
