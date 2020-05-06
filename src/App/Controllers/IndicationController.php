<?php

namespace Project\Controllers;

use Project\Models\IndicationsModel;
use Project\Models\UsersModel;
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
        $usersModel = new UsersModel($this->container);
        
        
        $tipo = $_SESSION['user']['user_type'];
        $filtro = '';
        
        if(isset($metadata['nome']))$data[$metadata['nome']] = '%'.$metadata['valor'].'%';
        if(isset($metadata['status']))  $data['status'] = $metadata['status'];
        if(isset($metadata['filtro']))  $filtro = $metadata['filtro'];
        if($metadata['status'] == 0 && isset($metadata['status'])){
            $data['status'] = 1;
            $data2['indications.status'] = 7;
        }

        if(isset($data2['indications.status'])){
            if($tipo == 4){
                $fields = " creator_uuid = '".$_SESSION['user']['id']."' AND (indications.status = 1 OR indications.status = 7) ";
            }
            else if($tipo == 3){
                $fields = " users.uuid = '".$_SESSION['user']['id']."' AND (indications.status = 1 OR indications.status = 7) ";
            }
            else{
                $fields = " indications.status = 1 OR indications.status = 7 ";
            }
            // $join['users']['campo'] = 'uuid';
            // $join['users']['campo2'] = 'indications.creator_uuid';
            $join = "LEFT JOIN users ON users.uuid=indications.creator_uuid OR users.uuid=indications.user_uuid";
            $campos = "indications.*, users.name as user_name";
            $indication = $indicationsModel->allJoinFields($join,$campos,$fields, $filtro);
            for($i=0;$i<count($indication);$i++){
                $busca['uuid'] = $indication[$i]['user_uuid'];
                $nome = $usersModel->find($busca);
                $indication[$i]['user_name'] = $nome['name'];
            }
            return json_encode($indication);
        }
        
        if($tipo == 4){
            $data['creator_uuid'] = '%'.$_SESSION['user']['id'].'%';
        }

        if($tipo == 3){
            if(isset($metadata['join'])){
                $data2['indications.user_uuid'] = '%'.$_SESSION['user']['id'].'%';
                $data2['indications.creator_uuid'] = '%'.$_SESSION['user']['id'].'%';
                $join['users']['campo'] = 'uuid';
                $join['users']['campo2'] = 'indications.creator_uuid';
                $campos = "indications.*, users.name as user_name";
                $indication = $indicationsModel->allLikeOrLeftJoin2($data,$data2,$join,$campos, $filtro);
                for($i=0;$i<count($indication);$i++){
                    $busca['uuid'] = $indication[$i]['user_uuid'];
                    $nome = $usersModel->find($busca);
                    $indication[$i]['user_name'] = $nome['name'];
                }
            }else{
                $data2['user_uuid'] = '%'.$_SESSION['user']['id'].'%';
                $data2['creator_uuid'] = '%'.$_SESSION['user']['id'].'%';
                $join['users']['campo'] = 'uuid';
                $join['users']['campo2'] = 'indications.user_uuid';
                $campos = "indications.*, users.name as user_name, users.uuid as user_uuid";
                $indication = $indicationsModel->allLikeOrLeftJoin($data,$data2,$join,$campos, $filtro);
            }
            return json_encode($indication);
        }
        
        
        if(isset($metadata['join'])){
            $join['users']['campo'] = 'uuid';
            $join['users']['campo2'] = 'indications.creator_uuid';
            $campos = "indications.*, users.name as user_name";
            $indication = $indicationsModel->allLikeLeftJoin2($data,$join,$campos, $filtro);
            for($i=0;$i<count($indication);$i++){
                $busca['uuid'] = $indication[$i]['user_uuid'];
                $nome = $usersModel->find($busca);
                $indication[$i]['user_name'] = $nome['name'];
            }
        }    
        else{
            $join['users']['campo'] = 'uuid';
            $join['users']['campo2'] = 'indications.user_uuid';
            $campos = "indications.*, users.name as user_name, users.uuid as user_uuid";
            $indication = $indicationsModel->allLikeLeftJoin($data,$join,$campos, $filtro);
        }

		return json_encode($indication);
    }
}