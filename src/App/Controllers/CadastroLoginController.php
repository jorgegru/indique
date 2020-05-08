<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class CadastroLoginController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function cadastroLogin($request, $response, $args)
   {
        //$companiesModel = new CompaniesModel($this->container);

        //$companies = $companiesModel->all(["1"=>"1"]);

        $message = $this->container->flash->getMessages();
		
        return $this->container->renderer->render($response, 'login/cadastroLogin.phtml',['message'=>$message/*,'companies'=>$companies*/]);
   }

   public function cadastroLoginDeslogado($request, $response, $args)
   {
        //$companiesModel = new CompaniesModel($this->container);

        //$companies = $companiesModel->all(["1"=>"1"]);

        $message = $this->container->flash->getMessages();
		
        return $this->container->renderer->render($response, 'login/cadastro.phtml',['message'=>$message/*,'companies'=>$companies*/]);
   }

   /**
	* Autenticação de usuarios
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function cadastrarLogin($request, $response, $args)
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
            'telefone' => [
                'rules' => V::length(8, 20)->notBlank(),
                'messages' => [
                    'length' => 'Telefone deve ter de 8 a 20 caracteres',
                    'notBlank' => 'Telefone não pode ser vazio',
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
        $uuid = uuid();// && \is_uuid($uuid)
		if ($validator->isValid()) {
            try{

            
            
                $UsersModel = new UsersModel($this->container);

                $user = $UsersModel->validateUser(['email'=>$metadata['email'], 'cpf'=>$metadata['cpf']]);

                $metadata['telefone'] = preg_replace('/\D+/', '', $metadata['telefone']);//arrumando o telefone

                if($user){
                    $this->container->flash->addMessage('error', 'Usuário já existente');
                    return $response->withRedirect($this->container->router->pathFor('cadastroLogin'));
                }
                else{
                    if($_SESSION['user']['user_type'] == 3 || $_SESSION['user']['user_type'] == 4){
                        $metadata['user_type'] = 4;
                        $metadata['status'] = 1;
                    }
                    $user = $UsersModel->set([  'uuid'=>$uuid,
                                                'user_type'=>$metadata['user_type'],
                                                'email'=>$metadata['email'], 
                                                'telefone'=>$metadata['telefone'], 
                                                'password'=>$metadata['password'],
                                                'cpf'=>$metadata['cpf'],
                                                'name'=>$metadata['name'],
                                                //'company_uuid'=>$metadata['company_uuid'],
                                                'status'=>$metadata['status']]);

                    if($user){
                        
                    }
                    else{
                        $errors = $validator->getErrors();
                        $this->container->flash->addMessage('error', 'Falha no cadastro');
                        return $response->withRedirect($this->container->router->pathFor('cadastroLogin'));
                    }

                    $this->container->flash->addMessage('success', 'Cadastrado com sucesso');
                    //$response->write('Cadastrado com sucesso');
                    return $response->withRedirect($this->container->router->pathFor('cadastroLogin'));
                    //return $response->withRedirect('/cadastroLogin');
                }
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha no Cadastro');
			    return $response->withRedirect($this->container->router->pathFor('cadastroLogin'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('cadastroLogin'));
      	}
       }
       
    public function cadastrarLoginDeslogado($request, $response, $args)
    {
	   	$metadata = $request->getParsedBody();
        $validator = $this->container->validator->validate($request, [
            'email' => [
                'rules' => V::length(6, 100)->contains('@')->noWhitespace()->notBlank(),
                'messages' => [
                    'length' => 'Digite um Email válido',
                    'notBlank' => 'Email não pode ser vazio',
                    'noWhitespace' => 'Email não pode ter espaçoes vazios',
                    'contains' => 'Email inválido',
                ]
            ],
            'telefone' => [
                'rules' => V::length(8, 20)->notBlank(),
                'messages' => [
                    'length' => 'Telefone deve ter de 8 a 20 caracteres',
                    'notBlank' => 'Telefone não pode ser vazio',
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
        ]);
        $uuid = uuid();// && \is_uuid($uuid)
		if ($validator->isValid()) {
            try{
                $UsersModel = new UsersModel($this->container);

                $user = $UsersModel->validateUser(['email'=>$metadata['email'], 'cpf'=>$metadata['cpf']]);

                $metadata['telefone'] = preg_replace('/\D+/', '', $metadata['telefone']);//arrumando o telefone
                
                if($user){
                    $this->container->flash->addMessage('error', 'Usuário já existente');
                    return $response->withRedirect($this->container->router->pathFor('cadastroLoginDeslogado'));
                }
                else{    
                    $metadata['user_type'] = 4;
                    $metadata['status'] = 1;

                    $user = $UsersModel->set([  'uuid'=>$uuid,
                                                'user_type'=>$metadata['user_type'],
                                                'email'=>$metadata['email'], 
                                                'telefone'=>$metadata['telefone'],
                                                'password'=>$metadata['password'],
                                                'cpf'=>$metadata['cpf'],
                                                'name'=>$metadata['name'],
                                                //'company_uuid'=>$metadata['company_uuid'],
                                                'status'=>$metadata['status']]);

                    if($user){
                        $this->container->flash->addMessage('success', 'Cadastrado com sucesso');
                        //$response->write('Cadastrado com sucesso');
                        return $response->withRedirect($this->container->router->pathFor('cadastroLoginDeslogado'));
                        //return $response->withRedirect('/cadastroLogin');   
                    }
                    else{
                        $errors = $validator->getErrors();
                        $this->container->flash->addMessage('error', 'Falha no cadastro');
                        return $response->withRedirect($this->container->router->pathFor('cadastroLoginDeslogado'));
                    }
                }
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha no Cadastro');
			    return $response->withRedirect($this->container->router->pathFor('cadastroLoginDeslogado'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('cadastroLoginDeslogado'));
      	}
   	}
}