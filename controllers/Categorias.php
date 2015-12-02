<?php

	$app->get('/listar/categorias', function () {
		$cate = new Categoria();
		$cate->getCategorias();
		return "";
	});

	$app->post('/cadastrar/categoria', function (Request $req) {
		$nome = $req->get('nome');

		$cate = new Categoria();
		$cate->addCategoria($nome);
		return "";
	});

	$app->post('/deletar/categoria/{id}', function ($id) {
		$cate = new Categoria();
		$cate->deleteCategoria($id);
		return "";
	});

	$app->post('/alterar/categoria/{id}', function (Request $req, $id) use ($app) {
		$nome = $req->get('nome');

		$cate = new Categoria();
		$cate->updateCategoria($id, $nome);
		return "";
	});