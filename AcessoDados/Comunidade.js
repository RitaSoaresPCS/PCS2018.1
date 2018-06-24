var Comunidade = new function() {
	$.ajaxSetup({ cache: false });

	this.controladorURL = "ControleDados/Comunidade.php";
	this.nomeEntidade = "Comunidade";

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

	this.getByDescricao = function (pesquisa, callback = function(data) {}) {
		return Base.getByDescricao(pesquisa, this.controladorURL, this.nomeEntidade, callback);
	}

	// Inativar.
	this.remover = function (id, callback = function(data) {}) {
		return Base.inativar(id, this.controladorURL, this.nomeEntidade, callback);
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
			func: "adicionar" + this.nomeEntidade,
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
			func: "editar" + this.nomeEntidade,
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

	this.getLabsDisponiveis= function(callback= function(data){}){
		$.post(
			this.controladorURL,
			{func: 'getLabsDisponiveis'},
			function(data){
				callback(data);
			},
			"json"
		);
	}
	
	this.setAdm= function(labName, admId, callback= function(data){}){
		$.post(
			this.controladorURL, {
				func: 'setAdm',
				labName: labName,
				admId: admId
			 },
			function(data){
				callback(data);
			},
			"json"
		);
	}
	
	this.removeAdm= function(admId, callback= function(data){}){
		$.post(
			this.controladorURL,
			{
				func: 'removeAdm',
				admId: admId
			},
			function(data){
				callback(data);
			},
			"json"
		);
	}
	
	
	this.getByNomeOuDescricao = function(nome, descricao, callback= function(data){}){
		$.post(
			this.controladorURL,
			{
				func: 'getByNomeOuDescricao' + this.nomeEntidade,
				nome: nome,
				descricao: descricao
			},
			function(data){
				callback(data);
			},
			"json"
		);
	}

	this.getMembros = function(id, callback = function(data) {} ){
		$.post(
			this.controladorURL,
			{
				func: 'getMembros' + this.nomeEntidade,
				id: id
			},
			function(data){
				callback(data);
			},
			"json"
		);
	}
	
	
}
