<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use Project\Models\IndicationsModel;
use Project\Models\ServicesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class ExcluirUsuarioController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function excluiUsuario($request, $response, $args)
   {
        $metadata = $request->getParsedBody();

        $usersModel = new UsersModel($this->container);

        $resposta = $usersModel->delete(['uuid'=>$metadata['uuid']]);
		
        return json_encode($resposta);
   }

}