<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\FilesModel;
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
        $filesModel = new FilesModel($this->container);


        $resposta = $commissionsModel->delete(['uuid'=>$metadata['uuid']]);

        if($resposta){
            $files = $filesModel->all(["relation_uuid"=>$metadata["uuid"]]);
            $return = $filesModel->delete(["relation_uuid"=>$metadata["uuid"]]);
                
            if (!defined('REAL_PATH'))
            {
                define('REAL_PATH', realpath("../") . "/");
            }
        
            $directory = REAL_PATH . 'files/commissions/';

            foreach($files as $file){
                unlink($directory.$file['name_file']);
            }
        }
        return json_encode($resposta);
   }
}