/*function Estoque ( lista, valorCaixa ) {

	this.caixa = valorCaixa || 0;
	this.produtos = {};

	if( lista )
		this.registrarTudo(lista);
}

Estoque.prototype.registrarTudo = function ( lista ) {
	var self = this;

	lista.forEach(function ( item ) {
		self.registrarProduto(item);
	});
}

Estoque.prototype.existe = function ( pid ) {
	return this.produtos[pid] || false;
}

Estoque.prototype.registrarProduto = function ( prod ) {
	if(this.existe(prod.pid)) throw "Produto existente";

	this.produtos[prod.pid] = prod;
}

var produtos = [
	{pid: 12, nome: "Caderno 200 folhas", quantidade: 20, valorUnitario: 17.20},
	{pid: 13, nome: "Monitor LG 19p", quantidade: 2, valorUnitario: 550},
	{pid: 14, nome: "Estabilizador Hexus Power", quantidade: 6, valorUnitario: 210}
];

var estoque = new Estoque(produtos);*/

var sub = $("#submit");

sub.on('click', function (e) {

	var user = $("#user").val();
	var passwd = $("#passwd").val();

	$.ajax({
		url: "src/data/Login.php",
		method: 'POST',
		data: {user: user, passwd: passwd},
		success: function (response){	
			response = JSON.parse(response);
	
			if(response.success){
			
				 console.log("LOGADO")
	
			} else if(response.error) {
				console.warn('Mysql or Ajax Error ! ' + response.error);
			}
		}
	})
	.fail(function() {
		console.error('Conection lost...');
	});
});