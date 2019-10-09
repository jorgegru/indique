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
    // Cadastro Login
        $app->group('/cadastroLogin', function () {
            $this->get('', Project\Controllers\CadastroLoginController::class . ':cadastroLogin')->setName('cadastroLogin');
            $this->post('', Project\Controllers\CadastroLoginController::class . ':cadastrarLogin')->setName('cadastrarLogin');
        });

    // Editar Login
        $app->group('/EditaLogin', function () {
            $this->get('', Project\Controllers\EditarLoginController::class . ':EditaLogin')->setName('EditaLogin');
            $this->post('', Project\Controllers\EditarLoginController::class . ':EditarLogin')->setName('EditarLogin');
        });
        
    // Cadastro Compania
        $app->group('/cadastroCompania', function () {
            $this->get('', Project\Controllers\CadastroCompaniaController::class . ':cadastroCompania')->setName('cadastroCompania');
            $this->post('', Project\Controllers\CadastroCompaniaController::class . ':cadastrarCompania')->setName('cadastrarCompania');
        });  



    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};
