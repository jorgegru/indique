<?php

namespace Project\Controllers;

use Project\Models\IndicationsModel;
use Project\Models\CommissionsModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;
class CommissionController
{
	protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function getCommissionsIndication($request, $response, $args)
   {
        $uuid = $args['uuid'];
		
        $commissionsModel = new CommissionsModel($this->container);
        $tipo = $_SESSION['user']['user_type'];
        $filtro = 'ORDER BY commissions.date';

        $data = ['indication_uuid'=>$uuid];
        $join['indications']['campo'] = 'uuid';
        $join['indications']['campo2'] = 'commissions.indication_uuid';
        $campos = "commissions.*";
        $commissions = $commissionsModel->allLikeLeftJoin($data,$join,$campos, $filtro);

		return json_encode($commissions);
    }
    
    public function payCommission($request, $response, $args){
        $uuid = $args['uuid'];
			
        $commissionsModel = new CommissionsModel($this->container);
        
        $data = ['uuid'=>$uuid,'paid'=>2];

        $commissions = $commissionsModel->update($data);

		return json_encode($commissions);
    }

    public function unpaidCommission($request, $response, $args){
        $uuid = $args['uuid'];
			
        $commissionsModel = new CommissionsModel($this->container);
        
        $data = ['uuid'=>$uuid,'paid'=>1];

        $commissions = $commissionsModel->update($data);

		return json_encode($commissions);
    }

    public function getMyCommission($request, $response, $args){
        $uuid = $args['uuid'];
			
        
        $indicationsModel = new IndicationsModel($this->container);

        $data = ['creator_uuid'=>$uuid];
        $join['commissions']['campo'] = 'indication_uuid';
        $join['commissions']['campo2'] = 'indications.uuid';
        $campos = "commissions.*";

        $commissions = $indicationsModel->allInnerJoin($data,$join,$campos);
        
		return json_encode($commissions);
    }
}