<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class EditarLoginController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function editaLogin($request, $response, $args)
   {
        //$companiesModel = new CompaniesModel($this->container);
        $usersModel = new UsersModel($this->container);

        if($_SESSION['user']['user_type'] == 1){
            $users = $usersModel->allOr(["user_type"=>array("2","3","4")]);
        }
        else if($_SESSION['user']['user_type'] == 2){
            $users = $usersModel->allOr(["user_type"=>array("3","4")]);
        }

        //$companies = $companiesModel->all(["1"=>"1"]);

        $message = $this->container->flash->getMessages();
		
        return $this->container->renderer->render($response, 'login/editaLogin.phtml',['message'=>$message/*,'companies'=>$companies*/, 'users'=>$users]);
   }

   /**
	* Autenticação de usuarios
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function editarLogin($request, $response, $args)
   {
	   	$metadata = $request->getParsedBody();
        $validator = $this->container->validator->validate($request, [
            'user_type' => [
                'rules' => V::numeric(),
                'messages' => [
                    'numeric' => 'Selecione um tipo de usuário',
                ]
            ],
            'email' => [
                'rules' => V::length(6, 100)->contains('@')->noWhitespace()->notBlank(),
                'messages' => [
                    'length' => 'Digite um Email válido',
                    'notBlank' => 'Email não pode ser vazio',
                    'noWhitespace' => 'Email não pode ter espaçoes vazios',
                    'contains' => 'Email inválido',
                ]
            ],
            'password' => [
                'rules' => V::length(6, 25)->noWhitespace()->notBlank(),
                'messages' => [
                    'length' => 'Senha deve conter de 6 à 25 caracteres',
                    'notBlank' => 'Senha não pode ser vazio',
                    'noWhitespace' => 'Senha não pode ter espaçoes vazios',
                ]
            ],
            'confirm_password' => [
                'rules' => V::identical($metadata["password"]),
                'messages' => [
                    'identical' => 'Confirmar Senha deve ser igual a Senha',
                ]
            ],
            'name' => [
                'rules' => V::length(6, 100)->notBlank(),
                'messages' => [
                    'length' => 'Nome deve conter de 6 à 100 caracteres',
                    'notBlank' => 'Nome não pode ser vazio',
                ]
            ],
            'cpf' => [
                'rules' => V::length(11)->notBlank()->noWhitespace()->numeric()->cpf(),
                'messages' => [
                    'cpf' => 'CPF inválido',
                    'length' => 'CPF inválido',
                    'notBlank' => 'CPF não pode ser vazio',
                    'noWhitespace' => 'CPF não deve conter espaços',
                    'numeric' => 'Digite apenas números para o CPF',
                ]
            ],
            // 'company_uuid' => [
            //     'rules' => V::notBlank(),
            //     'messages' => [
            //         'notBlank' => 'Selecione uma compania',
            //     ]
            // ],
            'status' => [
                'rules' => V::notBlank(),
                'messages' => [
                    'notBlank' => 'Selecione o status',
                ]
            ],
        ]);
       
		if ($validator->isValid()) {
            try{

            
            
                $UsersModel = new UsersModel($this->container);

                $user = $UsersModel->validateUser(['email'=>$metadata['email'], 'cpf'=>$metadata['cpf'], 'uuid'=>$metadata['user_uuid']]);

                if($user){
                    if($user['email'] == $metadata['email']){
                        $this->container->flash->addMessage('error', 'Usuário já existente com o mesmo Email');
                    }
                    else{
                        $this->container->flash->addMessage('error', 'Usuário já existente com o mesmo CPF');
                    }
                    return $response->withRedirect($this->container->router->pathFor('editaLogin'));
                }
                else{
                    if($_SESSION['user']['user_type'] == 3 || $_SESSION['user']['user_type'] == 4){
                        $metadata['user_type'] = 4;
                        $metadata['status'] = 2;
                    }
                    $user = $UsersModel->update(['uuid'=>$metadata['user_uuid'],
                                                'user_type'=>$metadata['user_type'],
                                                'email'=>$metadata['email'], 
                                                'password'=>$metadata['password'],
                                                'cpf'=>$metadata['cpf'],
                                                'name'=>$metadata['name'],
                                                //'company_uuid'=>$metadata['company_uuid'],
                                                'status'=>$metadata['status']]);

                    if($user){
                        
                    }
                    else{
                        $errors = $validator->getErrors();
                        $this->container->flash->addMessage('error', 'Falha na alteração');
                        return $response->withRedirect($this->container->router->pathFor('editaLogin'));
                    }

                    $this->container->flash->addMessage('success', 'Alterado com sucesso');
                    return $response->withRedirect($this->container->router->pathFor('editaLogin'));
                }
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha na Alteração');
			    return $response->withRedirect($this->container->router->pathFor('editaLogin'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('editaLogin'));
      	}
    }
    
    public function carregaEditarLogin($request, $response, $args)
    {
        $metadata = $request->getParsedBody();
     
        $UsersModel = new UsersModel($this->container);

        $user = $UsersModel->find(['uuid'=>$metadata['uuid']]);

        return json_encode($user);
    }
}