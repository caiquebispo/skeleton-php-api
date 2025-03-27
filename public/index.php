<?php

// Inicializa o autoload do composer
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\RoutingServiceProvider;

require_once  __DIR__ . '/../vendor/autoload.php';

// Configurando Dotenv
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

//Configurando Database
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => $_ENV['DB_CONNECTION'],
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_DATABASE'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
    'charset'   => $_ENV['DB_CHARSET'],
    'collation' => $_ENV['DB_COLLATION'],
    'prefix'    => $_ENV['DB_PREFIX'],
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

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
