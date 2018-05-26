var Base = new function() {
	$.ajaxSetup({ cache: false });

    this.listar = function (filePath, tagName) {
		var xml = $.ajax(
		{
			type: 'GET',
			async: false,
			url: filePath,
			dataType: "xml"
		});
		return xml.responseXML.getElementsByTagName(tagName);
    }


	this.getById = function (id, filePath, tagName) {
		var xml = $.ajax(
		{
			type: 'GET',
			async: false,
			url: filePath,
			dataType: "xml"
		});
		var nos = xml.responseXML.getElementsByTagName(tagName);
		for (var i = 0; i < nos.length; ++i) {
			if (nos[i].children[0].innerHTML == String(id)) {
				return nos[i];
			}
		}
    }


	this.getByNome = function (pesquisa, filePath, tagName) {
		var xml = $.ajax(
		{
			type: 'GET',
			async: false,
			url: filePath,
			dataType: "xml"
		});
		pesquisa = pesquisa.toLowerCase();
		var nos = xml.responseXML.getElementsByTagName(tagName);
		var resultado = [];
		for (var i = 0; i < nos.length; ++i) {
			if (nos[i].children[1].innerHTML.toLowerCase().includes(pesquisa) == true) {
				resultado.push(nos[i]);
			}
		}
		return resultado;

	}

	this.getByNomeVerdadeiro = function (pesquisa, filePath, tagName) {
		var xml = $.ajax(
		{
			type: 'GET',
			async: false,
			url: filePath,
			dataType: "xml"
		});
		pesquisa = pesquisa.toLowerCase();
		var nos = xml.responseXML.getElementsByTagName(tagName);
		var resultado= null;
		for (var i = 0; i < nos.length; ++i) {
			if (nos[i].children[1].innerHTML.toLowerCase()== pesquisa) {
				resultado= nos[i];
			}
		}
		return resultado;

	}


	this.inativar = function (id, serverURL) {
		$.post(serverURL, {
			func: "inativar",
			id: id
		} );
	}
	
	
	this.getUrlParameter = function (sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	
  }
}
