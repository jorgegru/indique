<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use Project\Models\IndicationsModel;
use Project\Models\CommissionsModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class ExcluirComissaoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function excluiComissao($request, $response, $args)
   {
        $metadata = $request->getParsedBody();

        $commissionsModel = new CommissionsModel($this->container);

        $resposta = $commissionsModel->delete(['uuid'=>$metadata['uuid']]);
		
        return json_encode($resposta);
   }

}