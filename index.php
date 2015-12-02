<?php

	require_once __DIR__.'/vendor/autoload.php';

	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	require "src/Connection.php";
	require "src/Produto.php";
	require "src/Categoria.php";

	$app = new Silex\Application();

	$app['debug'] = true;

	// Middleware to allow CORS
	$app->after(function (Request $request, Response $response) {

	    $response->headers->set('Access-Control-Allow-Origin', '*');
	});

	$app->get('/', function () use ($app) {

		return $app["Responses"][0];
	});

	require_once "responses/Responses.php";

	require_once "controllers/Produtos.php";
	require_once "controllers/Categorias.php";

	$app->run();