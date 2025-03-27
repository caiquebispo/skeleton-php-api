<?php

$app['router']->prefix('api')->group(function ($app) {

    $app->get('/', function () {
        return  'This is API Route';
    });
});