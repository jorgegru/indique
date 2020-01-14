<?php

namespace Project\Controllers;

use Project\Models\FilesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;
class FileController
{
	protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function deleteFile($request, $response, $args)
   {
        $metadata = $request->getParsedBody();
        
        $caminho = __DIR__ . '/files';

        if (!defined('REAL_PATH'))
        {
            define('REAL_PATH', realpath("../") . "/");
        }
       
        if($metadata["type"] == 1){
            $directory = REAL_PATH . 'files/contracts';    
        }
        else{
            $directory = REAL_PATH . 'files/commissions';
        }

        $directory .= "/".$metadata["name"];

        $filesModel = new FilesModel($this->container);

        $dados["name"] = $metadata["name"];

        $resposta = $filesModel->delete(['name_file'=>$metadata['name']]);
        
        if($resposta){
            unlink($directory);
            return json_encode(true);
        }
        else{
            return json_encode(false);
        }

    }
}