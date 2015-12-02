<?php

	$app->post('/listar/categorias', function () {

		$cate = new Categoria();
		return $cate->getCategorias();
	});

	$app->post('/cadastrar/categoria', function (Request $req) {

		$nome = $req->get('nome');

		$cate = new Categoria();
		return $cate->addCategoria($nome);
	});

	$app->post('/deletar/categoria/{id}', function ($id) {

		$cate = new Categoria();
		return $cate->deleteCategoria($id);
	});

	$app->post('/alterar/categoria/{id}', function (Request $req, $id) use ($app) {

		$nome = $req->get('nome');

		$cate = new Categoria();
		return $cate->updateCategoria($id, $nome);
	});