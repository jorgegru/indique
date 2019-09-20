<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();



    //Logout
       $app->get('/logout', Project\Controllers\LoginController::class . ':logout');

    //Check Auth
        $app->add(new Project\Middleware\AuthMiddleware());

    // Login 
        $app->group('/login', function () {
            $this->get('', Project\Controllers\LoginController::class . ':login')->setName('login');
            $this->post('', Project\Controllers\LoginController::class . ':logar')->setName('logar');
        });



    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};
