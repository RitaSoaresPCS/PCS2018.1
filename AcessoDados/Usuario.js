var Usuario = new function() {
	$.ajaxSetup({ cache: false });
    this.filePath = "../Dados/Usuario.xml";
	this.tagName = "usuario";

    this.listar = function () {
		return Base.listar(this.filePath, this.tagName);
    }
	
	
	this.getById = function (id) {
		return Base.getById(id, this.filePath, this.tagName);
    }
	
	
	this.getByNome = function (pesquisa) {
		return Base.getByNome(pesquisa, this.filePath, this.tagName);
	}
	
	
	this.adicionar = function () {}
	this.remover = function () {}
	
}
