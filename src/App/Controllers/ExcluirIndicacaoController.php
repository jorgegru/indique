<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use Project\Models\IndicationsModel;
use Project\Models\ServicesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class ExcluirIndicacaoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function excluiIndicacao($request, $response, $args)
   {
        $metadata = $request->getParsedBody();

        $indicationsModel = new IndicationsModel($this->container);

        $resposta = $indicationsModel->delete(['uuid'=>$metadata['uuid']]);
		
        return json_encode($resposta);
   }

}