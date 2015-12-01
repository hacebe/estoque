<?php
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//require_once "autoload.php";
require "src/Connection.php";
require "src/Produto.php";
require "src/Categoria.php";
//use Produto;

$app = new Silex\Application();

$app['debug'] = true;

$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
});

$app->get('/', function () {
	return "";
});

$app->get('/listar/produtos', function () {
	$prod = new Produto();
	$prod->getProdutos();
	return "";
});

$app->post('/cadastrar/produto', function (Request $req) {
	$nome 		= $req->get('nome');
	$categoria 	= $req->get('categoria');
	$est_minimo	= $req->get('estoque_minimo');
	$est_atual	= $req->get('estoque_atual');

	$prod = new Produto();
	$prod->addProduto($nome, $categoria, $est_minimo, $est_atual);
	return "";
});

$app->post('/deletar/produto/{id}', function ($id) {
	$prod = new Produto();
	$prod->deleteProduto($id);
	return "";
});

$app->post('/alterar/produto/{id}', function (Request $req, $id) use ($app) {
	$nome 		= $req->get('nome');
	$categoria 	= $req->get('categoria');
	$est_minimo	= $req->get('estoque_minimo');

	$prod = new Produto();
	$prod->updateProduto($id, $nome, $categoria, $est_minimo);
	return "";
});




##########################################################

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

$app->run();