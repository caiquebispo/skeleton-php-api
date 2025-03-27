<?php


use Skeleton\SkeletonPhpApplication\Controllers\HomeController;

$app['router']->get('/', [HomeController::class, 'index']);
