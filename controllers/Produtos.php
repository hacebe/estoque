<?php

	$app->get('/listar/produtos', function () {
		$prod = new Produto();

		return $prod->getProdutos();
	});

	$app->post('/cadastrar/produto', function (Request $req) {
		$nome 		= $req->get('nome');
		$categoria 	= $req->get('categoria');
		$est_minimo	= $req->get('estoque_minimo');
		$est_atual	= $req->get('estoque_atual');

		$prod = new Produto();

		return $prod->addProduto($nome, $categoria, $est_minimo, $est_atual);
	});

	$app->post('/deletar/produto/{id}', function ($id) {
		$prod = new Produto();
		return $prod->deleteProduto($id);
	});

	$app->post('/alterar/produto/{id}', function (Request $req, $id) use ($app) {
		$nome 		= $req->get('nome');
		$categoria 	= $req->get('categoria');
		$est_minimo	= $req->get('estoque_minimo');

		$prod = new Produto();
		return $prod->updateProduto($id, $nome, $categoria, $est_minimo);
	});