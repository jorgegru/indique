<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;
class UserController
{
	protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function filtroLista($request, $response, $args)
   {
		$metadata = $request->getParsedBody();
		
        $usersModel = new UsersModel($this->container);
        
        
            $tipo = $_SESSION['user']['user_type'];

            
            if(isset($metadata['nome']))$data[$metadata['nome']] = $metadata['valor'];
            if(isset($metadata['status']))  $data['status'] = $metadata['status'];
            
            if(isset($metadata['status'])){   
                if($tipo == 1){
                    $users = $usersModel->allLikeUser($data, ["user_type"=>array("2","3","4")]);
                }
                else if($tipo == 2){
                    $users = $usersModel->allLikeUser($data, ["user_type"=>array("3","4")]);
                }
            }
            else{
                if($tipo == 1){
                    $users = $usersModel->allLikeUser([$metadata['nome']=>$metadata['valor']], ["user_type"=>array("2","3","4")]);
                }
                else if($tipo == 2){
                    $users = $usersModel->allLikeUser([$metadata['nome']=>$metadata['valor']], ["user_type"=>array("3","4")]);
                }
            }

		return json_encode($users);
    }
}