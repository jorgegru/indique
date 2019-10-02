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
        $companiesModel = new CompaniesModel($this->container);

        $companies = $companiesModel->all(["1"=>"1"]);

        $message = $this->container->flash->getMessages();
		
        return $this->container->renderer->render($response, 'login/cadastroLogin.phtml',['message'=>$message,'companies'=>$companies]);
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
		$validator  = $this->container->validator->validate($request, [
			'email' => V::length(6, 100)->alnum('@.:')->noWhitespace()->notBlank(),
            'password' => V::length(6, 25)->noWhitespace()->notBlank(),
            'confirm_password' => V::length(6, 25)->noWhitespace()->notBlank()->identical($metadata["password"]),
            'name' => V::length(6, 100)->notBlank(),
            'cpf' => V::length(11)->notBlank()->noWhitespace()->numeric(),
            'company_uuid' => V::length(11)->notBlank()->noWhitespace(),
        ]);
        $uuid = uuid();// && \is_uuid($uuid)
		if ($validator->isValid()) {
            try{

            
            
                $UsersModel = new UsersModel($this->container);

                $user = $UsersModel->validateUser(['email'=>$metadata['email'], 'cpf'=>$metadata['cpf']]);

                if($user){
                    $this->container->flash->addMessage('error', 'Usuário já existente');
                    return $response->withRedirect($this->container->router->pathFor('cadastroLogin'));
                }
                else{

                    $user = $UsersModel->set([  'uuid'=>$uuid,
                                                'email'=>$metadata['email'], 
                                                'password'=>$metadata['password'],
                                                'cpf'=>$metadata['cpf'],
                                                'name'=>$metadata['name'],
                                                'company_uuid'=>$metadata['company_uuid']]);

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
			$this->container->flash->addMessage('error', 'Campos inválidos');
			return $response->withRedirect($this->container->router->pathFor('cadastroLogin'));
      	}
   	}
}