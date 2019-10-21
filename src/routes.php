<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();


    // Cadastro usuario
    // $app->get('/cadastro', function (Request $request, Response $response, array $args) use ($container) {
    //     // Sample log message
    //     $container->get('logger')->info("Slim-Skeleton '/' route");

    //     // Render index view
    //     return $container->get('renderer')->render($response, 'login/cadastro.phtml', $args);
    // });
    //Cadastro usuario
    //$app->get('/cadastro', Project\Controllers\CadastroLoginController::class . ':cadastroLoginDeslogado');

    $app->group('/cadastroLoginDeslogado', function () {
        $this->get('', Project\Controllers\CadastroLoginController::class . ':cadastroLoginDeslogado')->setName('cadastroLoginDeslogado');
        $this->post('', Project\Controllers\CadastroLoginController::class . ':cadastrarLoginDeslogado')->setName('cadastrarLoginDeslogado');
    });
    //Logout
       $app->get('/logout', Project\Controllers\LoginController::class . ':logout');

    //API ViaCEP
        $app->post('/apiViaCEP', Project\Services\APICep::class . ':getCEP');

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
        $app->group('/editaLogin', function () {
            $this->get('', Project\Controllers\EditarLoginController::class . ':editaLogin')->setName('editaLogin');
            $this->post('', Project\Controllers\EditarLoginController::class . ':editarLogin')->setName('editarLogin');
            //$this->get('/{uuid}', Project\Controllers\EditarLoginController::class . ':editaLogin')->setName('editaLogin');

        });
        $app->post('/carregaEditarLogin', Project\Controllers\EditarLoginController::class . ':carregaEditarLogin')->setName('carregaEditarLogin');
        $app->get('/editaLogin/{uuid}', Project\Controllers\EditarLoginController::class . ':editaLogin')->setName('editaLogin');
        
    // Listar usuarios
        $app->get('/listaUsers', function (Request $request, Response $response, array $args) use ($container) {
            // Sample log message
            $container->get('logger')->info("Slim-Skeleton '/' route");

            // Render index view
            return $container->get('renderer')->render($response, 'login/listaUser.phtml', $args);
        });

    // Filto Login Lista
        $app->post('/filtroUserLista', Project\Controllers\UserController::class . ':filtroLista')->setName('filtroUserLista');

    // Cadastro Compania
        $app->group('/cadastroCompania', function () {
            $this->get('', Project\Controllers\CadastroCompaniaController::class . ':cadastroCompania')->setName('cadastroCompania');
            $this->post('', Project\Controllers\CadastroCompaniaController::class . ':cadastrarCompania')->setName('cadastrarCompania');
        });  

    // Cadastro Indicacao
        $app->group('/cadastroIndicacao', function () {
            $this->get('', Project\Controllers\CadastroIndicacaoController::class . ':cadastroIndicacao')->setName('cadastroIndicacao');
            $this->post('', Project\Controllers\CadastroIndicacaoController::class . ':cadastrarIndicacao')->setName('cadastrarIndicacao');
        });
        
    // Editar Indicacao
        $app->group('/editaIndicacao', function () {
            $this->get('', Project\Controllers\EditarIndicacaoController::class . ':editaIndicacao')->setName('editaIndicacao');
            $this->post('', Project\Controllers\EditarIndicacaoController::class . ':editarIndicacao')->setName('editarIndicacao');
        });
        $app->post('/carregaEditarIndicacao', Project\Controllers\EditarIndicacaoController::class . ':carregaEditarIndicacao')->setName('carregaEditarIndicacao');
        
    // Listar Indicacao
        $app->get('/listaIndicacoes', function (Request $request, Response $response, array $args) use ($container) {
            // Sample log message
            $container->get('logger')->info("Slim-Skeleton '/' route");

            // Render index view
            return $container->get('renderer')->render($response, 'indicacao/listaIndicacao.phtml', $args);
        });
    // Filto Indicacao Lista
        $app->post('/filtroIndicacaoLista', Project\Controllers\IndicationController::class . ':filtroLista')->setName('filtroUserLista');

    // Editar Compania
        $app->group('/editaCompania', function () {
            $this->get('', Project\Controllers\EditarCompaniaController::class . ':editaCompania')->setName('editaCompania');
            $this->post('', Project\Controllers\EditarCompaniaController::class . ':editarCompania')->setName('editarCompania');
        });
        $app->post('/carregaEditarCompania', Project\Controllers\EditarCompaniaController::class . ':carregaEditarCompania')->setName('carregaEditarCompania');


    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};
