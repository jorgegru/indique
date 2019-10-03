<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class CadastroCompaniaController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function cadastroCompania($request, $response, $args)
   {
        $message = $this->container->flash->getMessages();
	
        return $this->container->renderer->render($response, 'compania/cadastroCompania.phtml',['message'=>$message]);
   }

   /**
	* Autenticação de usuarios
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function cadastrarCompania($request, $response, $args)
   {
	   	$metadata = $request->getParsedBody();
        $validator = $this->container->validator->validate($request, [
            'name' => [
                'rules' => V::length(6, 100)->notBlank(),
                'messages' => [
                    'length' => 'Nome deve possuir de 6 a 100 caracteres',
                    'notBlank' => 'Nome não pode ser vazio',
                ]
            ],
            'cnpj' => [
                'rules' => V::length(14)->notBlank()->noWhitespace()->numeric(),
                'messages' => [
                    'length' => 'CNPJ deve ter 14 digitos',
                    'notBlank' => 'CNPJ não pode ser vazio',
                    'noWhitespace' => 'CNPJ não pode ter espaçoes vazios',
                    'numeric' => 'Use apenas números para o CNPJ',
                ]
            ],
        ]);

        $uuid = uuid();// && \is_uuid($uuid)
		if ($validator->isValid()) {
            try{

            
            
                $CompaniesModel = new CompaniesModel($this->container);

                $companie = $CompaniesModel->validateCompanie(['cnpj'=>$metadata['cnpj']]);

                if($companie){
                    $this->container->flash->addMessage('error', 'Já existe uma compania com o mesmo CNPJ');
                    return $response->withRedirect($this->container->router->pathFor('cadastroCompania'));
                }
                else{

                    $companie = $CompaniesModel->set([  'uuid'=>$uuid,
                                                        'cnpj'=>$metadata['cnpj'],
                                                        'name'=>$metadata['name']]);

                    if($companie){
                        
                    }
                    else{
                        $errors = $validator->getErrors();
                        $this->container->flash->addMessage('error', 'Falha no cadastro');
                        return $response->withRedirect($this->container->router->pathFor('cadastroCompania'));
                    }

                    $this->container->flash->addMessage('success', 'Cadastrado com sucesso');
                    return $response->withRedirect($this->container->router->pathFor('cadastroCompania'));
                }
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha no Cadastro');
			    return $response->withRedirect($this->container->router->pathFor('cadastroCompania'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('cadastroCompania'));
      	}
   	}
}