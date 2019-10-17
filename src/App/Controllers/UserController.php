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

		$users = $usersModel->all([$metadata['nome']=>$metadata['valor']]);

		return json_encode($users);
    }
}