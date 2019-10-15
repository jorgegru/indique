<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class EditarCompaniaController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function editaCompania($request, $response, $args)
   {
        
        $companiesModel = new CompaniesModel($this->container);

        $companies = $companiesModel->all(["1"=>"1"]);

        $message = $this->container->flash->getMessages();
		
        return $this->container->renderer->render($response, 'compania/editaCompania.phtml',['message'=>$message,'companies'=>$companies]);
   }

   /**
	* Autenticação de usuarios
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function editarCompania($request, $response, $args)
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
                'rules' => V::length(14)->notBlank()->noWhitespace()->numeric()->cnpj(),
                'messages' => [
                    'length' => 'CNPJ deve ter 14 digitos',
                    'notBlank' => 'CNPJ não pode ser vazio',
                    'noWhitespace' => 'CNPJ não pode ter espaçoes vazios',
                    'numeric' => 'Use apenas números para o CNPJ',
                    'cnpj' => 'CNPJ inválido',
                ]
            ],
        ]);
        
		if ($validator->isValid()) {
            try{

                $companiesModel = new CompaniesModel($this->container);

                $companie = $companiesModel->validateCompanie(['cnpj'=>$metadata['cnpj'], 'uuid'=>$metadata['company_uuid']]);

                if($companie){   
                    $this->container->flash->addMessage('error', 'Compania já existente com o mesmo CNPJ');
                    return $response->withRedirect($this->container->router->pathFor('editaCompania'));
                }
                else{
                    $companie = $companiesModel->update(['uuid'=>$metadata['company_uuid'],
                                                'cnpj'=>$metadata['cnpj'],
                                                'name'=>$metadata['name']]);
                    if($companie){
                        $this->container->flash->addMessage('success', 'Alterado com sucesso');
                        return $response->withRedirect($this->container->router->pathFor('editaCompania'));
                    }
                    else{
                        $errors = $validator->getErrors();
                        $this->container->flash->addMessage('error', 'Falha na alteração');
                        return $response->withRedirect($this->container->router->pathFor('editaCompania'));
                    }
                }
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha na Alteração');
			    return $response->withRedirect($this->container->router->pathFor('editaCompania'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('editaCompania'));
      	}
    }
    
    public function carregaEditarCompania($request, $response, $args)
    {
        $metadata = $request->getParsedBody();
     
        $companiesModel = new CompaniesModel($this->container);

        $companie = $companiesModel->find(['uuid'=>$metadata['uuid']]);

        return json_encode($companie);
    }
}