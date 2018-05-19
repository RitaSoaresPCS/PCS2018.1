var Comunidade = new function() {
    this.filePath = "../Dados/Comunidade.xml";

    this.listarComunidades = function () {
		var xml = $.ajax(
		{
			type: 'GET',
			async: false,
			url: this.filePath,
		});
		return xml.responseXML.getElementsByTagName("comunidade");
    }
	
	
	this.getComunidadeById = function (id) {
		var xml = $.ajax(
		{
			type: 'GET',
			async: false,
			url: this.filePath,
		});
		var comunidades = xml.responseXML.getElementsByTagName("comunidade");
		for (var i = 0; i < comunidades.length; ++i) {
			if (comunidades[i].children[0].innerHTML == String(id)) {
				return comunidades[i];
			}
		}
    }
	
	this.getComunidadeByNome = function () {}
	this.adicionarComunidade = function () {}
	this.removerComunidade = function () {}
	
}
