<?php

namespace Project\Controllers;

use Project\Models\IndicationsModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;
class IndicationController
{
	protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function filtroLista($request, $response, $args)
   {
		$metadata = $request->getParsedBody();
		
        $indicationsModel = new IndicationsModel($this->container);
        
        
            $tipo = $_SESSION['user']['user_type'];

            
            if(isset($metadata['nome']))$data[$metadata['nome']] = '%'.$metadata['valor'].'%';
            if(isset($metadata['status']))  $data['status'] = $metadata['status'];
            
            // if(isset($metadata['status'])){   
            //     if($tipo == 1){
                    $join['users']['campo'] = 'uuid';
                    $join['users']['campo2'] = 'indications.user_uuid';
                    $campos = "indications.*, users.name as user_name";
                    $indication = $indicationsModel->allLikeLeftJoin($data,$join,$campos);
            //     }
            //     else if($tipo == 2){
            //         $indication = $indicationsModel->allLike($data, ["user_type"=>array("3","4")]);
            //     }
            // }
            // else{
            //     if($tipo == 1){
            //         $indication = $indicationsModel->allLike([$metadata['nome']=>$metadata['valor']], ["user_type"=>array("2","3","4")]);
            //     }
            //     else if($tipo == 2){
            //         $indication = $indicationsModel->allLike([$metadata['nome']=>$metadata['valor']], ["user_type"=>array("3","4")]);
            //     }
            // }

		return json_encode($indication);
    }
}