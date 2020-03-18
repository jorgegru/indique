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

    public function filtroComissao($request, $response, $args) 
   {
		$metadata = $request->getParsedBody();
		
        $indicationsModel = new IndicationsModel($this->container);
        $commissionsModel = new CommissionsModel($this->container);
        
        
        $tipo = $_SESSION['user']['user_type'];
        $filtro = '';
        $condicao = "AND";

        
        $join['indications']['campo'] = 'uuid';
        $join['indications']['campo2'] = 'commissions.indication_uuid';
        $join['contracts']['campo'] = 'indication_uuid';
        $join['contracts']['campo2'] = 'indications.uuid';
        $join['users']['campo'] = 'uuid';
        $join['users']['campo2'] = 'indications.creator_uuid';
        $campos = "commissions.uuid,
        commissions.paid,
        commissions.value_commission/100 value,
        DATE_FORMAT(commissions.date,'%d-%m-%Y') date,
        commissions.observation,
        users.name, 
        users.uuid user_uuid,
        contracts.uuid contract_uuid,
        indications.uuid indication_uuid";

        if($tipo == 4){
            $metadata['creator_uuid'] = $_SESSION['user']['id'];
        }

        //NR CONTRATO
        if($metadata['nr_contrato'] != ""){
            $data['contracts.indentification'] = '%'.$metadata['nr_contrato'].'%';
            //$filtro .= " AND contracts.indentification LIKE '%".$metadata['nr_contrato']."%'";
        }

        //VALOR COMISSAO
        if($metadata['valor'] != ""){
            $data['commissions.value_commission'] = "".$metadata['valor'];
            //$filtro .= " AND commissions.value_commission = ".$metadata['valor'];
        }

        //NOME RESPONSAVEL
        if($metadata['responsavel'] != ""){
            $data['indications.name_responsavel'] = '%'.$metadata['responsavel'].'%';
            //$filtro .= " AND indications.name_responsavel LIKE '%".$metadata['responsavel']."%'";
        }

        //CRIADOR DA INDICACAO
        if($metadata['indicador'] != ""){
            $data['users.name'] = '%'.$metadata['indicador'].'%';
            //$filtro .= " AND users.name LIKE '%".$metadata['indicador']."%'";
        }

        //DATA COMISSAO
        if($metadata['mes'] != "escolha" && $metadata['ano'] != "escolha"){ //date
            $data ["commissions.date"] = '%'.$metadata['ano'].'-'.$metadata['mes'].'%';
            // $filtro .= " AND DATE_FORMAT(commissions.date,'%d-%m-%Y') BETWEEN 
            // ".$metadata['mes']." AND ".$metadata['ano']." ";
        }

        //EMPRESA CONTRATO
        if($metadata['empresa'] != ""){
            $data['contracts.corporate_name'] = '%'.$metadata['empresa'].'%';
            //$filtro .= " AND contracts.corporate_name LIKE '%".$metadata['empresa']."%'";
        }

        //STATUS COMISSAO
        if($metadata['status'] != ""){
            $data['commissions.paid'] = '%'.$metadata['status'].'%';
            //$filtro .= " AND commissions.status LIKE = ".$metadata['status'];
        }

        if($tipo == 3){
            $data2['indications.user_uuid'] = $_SESSION['user']['id'];
            $data2['indications.creator_uuid'] = $_SESSION['user']['id'];
            //$metadata['creator_uuid'] = $_SESSION['user']['id'];
        }
        $debug2 = fopen('data.txt',"w+");
            fwrite($debug2,json_encode($data));
        $commissions = $commissionsModel->allInnerJoin2($data,$join,$campos," ",$data2);
        $debug2 = fopen('teste2.txt',"w+");
            fwrite($debug2,json_encode($commissions));
        

		return json_encode($commissions);
    }
}