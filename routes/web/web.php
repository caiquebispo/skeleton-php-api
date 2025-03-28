<?php


use Skeleton\SkeletonPhpApplication\Controllers\HomeController;

$app['router']->get('/', [HomeController::class, 'index']);
$app['router']->get('/debug', [HomeController::class, 'debug']);
