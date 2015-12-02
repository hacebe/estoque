<?php

	require_once __DIR__.'/vendor/autoload.php';

	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	use Symfony\Component\HttpKernel\Exception\HttpException;
	use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

	$app = new Silex\Application();

	require_once "src/Connection.php";
	require_once "responses/Responses.php";

	require_once "src/Produto.php";
	require_once "src/Categoria.php";

	$app['debug'] = true;

	// Middleware to allow CORS
	$app->after(function (Request $request, Response $response) {

	    $response->headers->set('Access-Control-Allow-Origin', '*');
	});

	$app->before(function (Request $req, $app) {

		$currentRoute = $app["request"]->getRequestUri();

		if($currentRoute != "/" && $currentRoute != "/login") {
			if(!$req->get("key")) {
				$app->abort(401, "");
			}
		}
	});

	$app->error(function (\Exception $e) use ($app) {

	    $code = ($e instanceof HttpException) ? $e->getStatusCode() : 500;

		if ($e instanceof NotFoundHttpException)
			return $app["Responses"][0];

		if(isset($code) && $code == 401)
			return $app["Responses"][6];

    	return new Response('We are sorry, but something went terribly wrong.', $code);
	});

	$app->get('/', function () use ($app) {

		return $app["Responses"][0];
	});

	require_once "controllers/Produtos.php";
	require_once "controllers/Categorias.php";

	$app->run();