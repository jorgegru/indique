<?php

namespace Project\Controllers;

use Project\Models\IndicationsModel;
use Project\Models\ContractsModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;
class ContractController
{
	protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function filtroLista($request, $response, $args)
   {
		$metadata = $request->getParsedBody();
		
        $contractsModel = new ContractsModel($this->container);
        
        
            $tipo = $_SESSION['user']['user_type'];
            $filtro = '';
            
            if(isset($metadata['nome']))$data[$metadata['nome']] = '%'.$metadata['valor'].'%';
            // if(isset($metadata['status']))  $data['status'] = $metadata['status'];
            // if(isset($metadata['filtro']))  $filtro = $metadata['filtro'];
            
            // if(isset($metadata['status'])){   
            //     if($tipo == 1){
                    $join['indications']['campo'] = 'uuid';
                    $join['indications']['campo2'] = 'contracts.indication_uuid';
                    // $join['commissions']['campo'] = 'indication_uuid';
                    // $join['commissions']['campo2'] = 'indications.uuid';
                    // $campos = "contracts.*, users.name as user_name, users.uuid as user_uuid";
                    $join['users']['campo'] = 'uuid';
                    $join['users']['campo2'] = 'indications.user_uuid';
                    
                    $join['files']['campo'] = 'relation_uuid';
                    $join['files']['campo2'] = 'contracts.uuid';

                    $join['commissions']['campo'] = 'indication_uuid';
                    $join['commissions']['campo2'] = 'indications.uuid';
                    
                    $campos = "contracts.*, users.name as consultor";


                    $contracts = $contractsModel->allLikeLeftJoin($data, $join, $campos);
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

		return json_encode($contracts);
    }
}