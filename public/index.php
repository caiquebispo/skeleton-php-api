<?php

// Inicializa o autoload do composer
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\RoutingServiceProvider;
use Skeleton\SkeletonPhpApplication\Core\Connection;
use Skeleton\SkeletonPhpApplication\Core\Migration;


require_once  __DIR__ . '/../vendor/autoload.php';

// Configurando Dotenv
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Configurando Eloquent ORM
Connection::getInstance();

//Carregar migrations corretamente
Migration::loadMigrationFiles();

// Configurando Rotas
$app = new Container();
$request = Request::capture();

$app->instance('Illuminate\Http\Request', $request);
$app->instance('Illuminate\Http\Request', $request);

with(new EventServiceProvider($app))->register();
with(new RoutingServiceProvider($app))->register();

require_once __DIR__ . '/../routes/web/web.php';
require_once __DIR__ . '/../routes/api/api.php';

$request = Request::createFromGlobals();
$response = $app['router']->dispatch($request);

$response->send();
