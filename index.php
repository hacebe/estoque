<?php

	require_once __DIR__.'/vendor/autoload.php';

	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	use Symfony\Component\HttpKernel\Exception\HttpException;
	use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

	require_once "src/Connection.php";
	require_once "src/Login.php";
	require_once "src/Produto.php";
	require_once "src/Categoria.php";

	$app = new Silex\Application();

	$app['debug'] = true;

	// Middleware to allow CORS
	$app->after(function (Request $request, Response $response) {

	    $response->headers->set('Access-Control-Allow-Origin', '*');
	});

	$app->before(function (Request $request, $app) {

		$currentRoute = $app['request']->getRequestUri();
		if($currentRoute != "/" && $currentRoute != "/login"){
		    if (!$request->get('__token')) {
		        //return $app['Responses'][2];
		        $app->abort(201, "Not authenticated");
		    }
		}
	});
	
	$app->error(function (\Exception $e) use ($app) {

		if ($e instanceof NotFoundHttpException)
			return $app["Responses"][0];

		

	    $code = ($e instanceof HttpException) ? $e->getStatusCode() : 500;
    	return new Response('We are sorry, but something went terribly wrong.', $code);
	});


	$app->get('/', function () use ($app) {
		return $app["Responses"][0];
	});

	require_once "responses/Responses.php";

	$app->post('/login', function(Request $req){
		$user = $req->get('user');
		$pass = $req->get('pass');

		$login = new Login();
		$login->login($user, $pass);

		return "";
	});

	require_once "controllers/Produtos.php";
	require_once "controllers/Categorias.php";

	$app->run();