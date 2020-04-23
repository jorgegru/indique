<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();
    $container['upload_directory'] = __DIR__ . '/files';


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

    //Excluir Usuário
        $app->post('/excluiUsuario', Project\Controllers\ExcluirUsuarioController::class . ':excluiUsuario')->setName('excluiUsuario');

    // Filto Login Lista
        $app->post('/filtroUserLista', Project\Controllers\UserController::class . ':filtroLista')->setName('filtroUserLista');

    //Get Creators
        $app->get('/getCreators', Project\Controllers\UserController::class . ':getCreators')->setName('getCreators');

    // Cadastro Compania
        $app->group('/cadastroCompania', function () {
            $this->get('', Project\Controllers\CadastroCompaniaController::class . ':cadastroCompania')->setName('cadastroCompania');
            $this->post('', Project\Controllers\CadastroCompaniaController::class . ':cadastrarCompania')->setName('cadastrarCompania');
        });  

    // Adicionar Observaco    
        $app->post('/addObservacao', Project\Controllers\AdicionarObservacaoController::class . ':addObservacao')->setName('addObservacao');
    
    //Get observacoes
        $app->get('/getObservacao/{uuid}', Project\Controllers\ObservationIndicationController::class . ':getObservacao')->setName('getObservacao');

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
        $app->get('/editaIndicacao/{uuid}', Project\Controllers\EditarIndicacaoController::class . ':editaIndicacao')->setName('editaIndicacao');
        
    //Excluir Indicacao
        $app->post('/excluiIndicacao', Project\Controllers\ExcluirIndicacaoController::class . ':excluiIndicacao')->setName('excluiIndicacao');

    // Listar Indicacao
        $app->get('/listaIndicacoes', function (Request $request, Response $response, array $args) use ($container) {
            // Sample log message
            $container->get('logger')->info("Slim-Skeleton '/' route");

            // Render index view
            return $container->get('renderer')->render($response, 'indicacao/listaIndicacao.phtml', $args);
        });
    // Filto Indicacao Lista
        $app->post('/filtroIndicacaoLista', Project\Controllers\IndicationController::class . ':filtroLista')->setName('filtroIndicationLista');

    //Cadastrar Contrato 
        $app->get('/cadastroContrato/{uuid}', Project\Controllers\CadastroContratoController::class . ':cadastroContrato')->setName('cadastroContrato');    
        $app->post('/cadastrarContrato', Project\Controllers\CadastroContratoController::class . ':cadastrarContrato')->setName('cadastrarContrato');    

    // Editar Contrato
    $app->group('/editaContrato', function () {
        $this->get('', Project\Controllers\EditarContratoController::class . ':editaContrato')->setName('editaContrato');
        $this->post('', Project\Controllers\EditarContratoController::class . ':editarContrato')->setName('editarContrato');
    });
    $app->post('/carregaEditarContrato', Project\Controllers\EditarContratoController::class . ':carregaEditarContrato')->setName('carregaEditarContrato');
    $app->get('/editaContrato/{uuid}', Project\Controllers\EditarContratoController::class . ':editaContrato')->setName('editaContrato');

    //Get Commission
    $app->get('/getCommissionsIndication/{uuid}', Project\Controllers\CommissionController::class . ':getCommissionsIndication')->setName('getCommissionsIndication');
    
    //Excluir Comissao 
    $app->post('/excluiComissao', Project\Controllers\ExcluirComissaoController::class . ':excluiComissao')->setName('excluiComissao');

    //Editar Comissão
        $app->group('/editaComissao', function () {
            $this->get('', Project\Controllers\EditarComissaoController::class . ':editaComissao')->setName('editaComissao');
            $this->post('', Project\Controllers\EditarComissaoController::class . ':editarComissao')->setName('editarComissao');
        });
        $app->post('/carregaEditarComissao', Project\Controllers\EditarComissaoController::class . ':carregaEditarComissao')->setName('carregaEditarComissao');
        $app->post('/carregaEditarComissaoIndicacao', Project\Controllers\EditarComissaoController::class . ':carregaEditarComissaoIndicacao')->setName('carregaEditarComissaoIndicacao');
       // $app->get('/editaComissao/{uuid}', Project\Controllers\EditarComissaoController::class . ':editaComissao')->setName('editaComissao');
        $app->group('/editaComissao/{uuid}', function () {
            $this->get('', Project\Controllers\EditarComissaoController::class . ':editaComissao')->setName('editaComissao');
            $this->post('', Project\Controllers\EditarComissaoController::class . ':editaComissao')->setName('editaComissao');
        });

    // Listar comissoes
    $app->get('/listaComissoes', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'comissao/listaComissoes.phtml', $args);
    });

    // Filto Comissoes Lista
    $app->post('/filtroComissaoLista', Project\Controllers\CommissionController::class . ':filtroComissao')->setName('filtrocomissaoLista');

    //Pay Commission
    $app->get('/payCommission/{uuid}', Project\Controllers\CommissionController::class . ':payCommission')->setName('payCommission');

    //Unpaid Commission
    $app->get('/unpaidCommission/{uuid}', Project\Controllers\CommissionController::class . ':unpaidCommission')->setName('unpaidCommission');

    //Get My Commissions
    $app->get('/getMyCommission/{uuid}', Project\Controllers\CommissionController::class . ':getMyCommission')->setName('getMyCommission');

    //Listar Contratos
        $app->get('/listaContratos', function (Request $request, Response $response, array $args) use ($container) {
            // Sample log message
            $container->get('logger')->info("Slim-Skeleton '/' route");

            // Render index view
            return $container->get('renderer')->render($response, 'contrato/listaContrato.phtml', $args);
        });

    // Filto Indicacao Lista
        $app->post('/filtroContratoLista', Project\Controllers\ContractController::class . ':filtroLista')->setName('filtroContractLista');

    // Editar Compania
        $app->group('/editaCompania', function () {
            $this->get('', Project\Controllers\EditarCompaniaController::class . ':editaCompania')->setName('editaCompania');
            $this->post('', Project\Controllers\EditarCompaniaController::class . ':editarCompania')->setName('editarCompania');
        });
        $app->post('/carregaEditarCompania', Project\Controllers\EditarCompaniaController::class . ':carregaEditarCompania')->setName('carregaEditarCompania');


        $app->get('/index/{status}', function ($request, $response, $args) use ($container) {


            return $container->get('renderer')->render($response, 'index.phtml', ['message'=>$args['status']]);
        })->setName('index');
       
    //Download File
        $app->get('/download/{type}/{file}/{extension}', function($req, $res, $args) {
            $file = '../files/'.$args['type'].'/'.$args['file'].'.'.$args['extension'];

            $response = $res->withHeader('Content-Description', 'File Transfer')
           ->withHeader('Content-Type', 'application/octet-stream')
           ->withHeader('Content-Disposition', 'attachment;filename="'.basename($file).'"')
           ->withHeader('Expires', '0')
           ->withHeader('Cache-Control', 'must-revalidate')
           ->withHeader('Pragma', 'public')
           ->withHeader('Content-Length', filesize($file));
        
        readfile($file);
        return $response;
        });

    //Delete File
        $app->post('/deleteFile', Project\Controllers\FileController::class . ':deleteFile')->setName('deleteFile');

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};
