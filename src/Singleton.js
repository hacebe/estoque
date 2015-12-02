
// PLEASE INCLUDE JQUERY FILE FOR TEST CASES

// EXTJS VERSION
/*var req = function (method, url, params, callbacks) {

	callbacks = callbacks || {};
	callbacks.onSuccess = callbacks.success || function () {};
	callbacks.onFailure = callbacks.failure || function () {};

	var host = "http://192.168.0.32/api/index.php";

	Ext.Ajax.request({
		url: host + url,
		params: params,
		method: method,
		success: callbacks.onSuccess,
		failure: callbacks.onFailure
	});
}*/

var req = function (method, url, params, callbacks) {

	callbacks = callbacks || {};
	callbacks.onSuccess = callbacks.success || function () {};
	callbacks.onFailure = callbacks.failure || function () {};

	var host = "http://localhost/api/index.php";

	$.ajax({
		url: host + url,
		data: params,
		method: method
	})
	.done(callbacks.onSuccess)
	.fail(callbacks.onFailure);
}

var Requests = {
	alterar: {
		categoria: function (id, params, callbacks) {
			req('POST', "/alterar/categoria/" + id, params, callbacks);
		},

		produto: function (id, params, callbacks) {
			req('POST', "/alterar/produto/" + id, params, callbacks);
		}
	},

	cadastrar: {
		categoria: function (params, callbacks) {
			req('POST', "/cadastrar/categoria/", params, callbacks);
		},

		produto: function (params, callbacks) {
			req('POST', "/cadastrar/produto/", params, callbacks);
		}
	},

	deletar: {
		categoria: function (id, callbacks) {
			req('POST', "/deletar/categoria/" + id, {}, callbacks);
		},

		produto: function (id, callbacks) {
			req('POST', "/deletar/produto/" + id, {}, callbacks);
		}
	},

	listar: {
		categorias: function ( callbacks ) {
			req('GET', "/listar/categorias", {}, callbacks);
		},

		produtos: function ( callbacks ) {
			req('GET', "/listar/produtos", {}, callbacks);
		}
	},
}

/*

var produto = {
	nome: "Estabilizador 220w Asus Tech",
	categoria: 1,
	estoque_minimo: 5,
	estoque_atual: 30
}

var alteracoesProduto = {
	nome: "Pasta eletrica 550w AOC world",
	categoria: 2,
	estoque_minimo: 4,
	estoque_atual: 10
}

Requests.cadastrar.produto(produto, {
	success: function (response) {
		produto.id = response.data.id;
	}
});

Requests.alterar.produto(produto.id, alteracoesProduto, {
	success: function (response) {
		console.log(response);
	}
});

Requests.deletar.produto(produto.id, {
	success: function (response) {
		console.log(response);
	}
});

Requests.listar.produtos({
	success: function (response) {
		console.log(response);
	}
});

Requests.cadastrar.categoria(categoria, {
	success: function (response) {
		categoria.id = response.data.id;
	}
});

Requests.alterar.categoria(categoria.id, alteracoesProduto, {
	success: function (response) {
		console.log(response);
	}
});

Requests.deletar.categoria(categoria.id, {
	success: function (response) {
		console.log(response);
	}
});

Requests.listar.categorias({
	success: function (response) {
		console.log(response);
	}
});

*/