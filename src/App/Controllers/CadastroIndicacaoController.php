<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use Project\Models\ServicesModel;
use Project\Models\IndicationsModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class CadastroIndicacaoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function cadastroIndicacao($request, $response, $args)
   {
        //$companiesModel = new CompaniesModel($this->container);
        $usersModel = new UsersModel($this->container);
        $servicesModel = new ServicesModel($this->container);

        $consultores = $usersModel->all(["user_type"=>"3","status"=>"1"]);
        $services = $servicesModel->all(["1"=>"1"]);
        //$companies = $companiesModel->all(["1"=>"1"]);

        $message = $this->container->flash->getMessages();
		
        return $this->container->renderer->render($response, 'indicacao/cadastroIndicacao.phtml',['message'=>$message/*,'companies'=>$companies*/, 'consultores'=>$consultores, 'services'=>$services]);
   }


   /**
	* Autenticação de usuarios
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function cadastrarIndicacao($request, $response, $args)
   {   
        $metadata = $request->getParsedBody();
        $validator = $this->container->validator->validate($request, [
            'name' => [
                'rules' => V::notBlank()->length(6, 100),
                'messages' => [
                    'notBlank' => 'O Nome não pode ser vazio',
                    'length' => 'O Nome devve ter de 6 a 100 caracteres',
                ]
            ],
            'cpf_cnpj' => [
                'rules' => V::numeric()->notBlank()->noWhitespace()->length(11, 14),
                'messages' => [
                    'numeric' => 'Digite apenas números para o CPF_CNPJ',
                    'notBlank' => 'O CPF_CNPJ não pode ser vazio',
                    'noWhitespace' => 'O CPF_CNPJ não pode ter espaço',
                    'length' => 'O CPF_CNPJ deve ter de 11 a 14 caracteres',
                ]
            ],
            'telefone' => [
                'rules' => V::length(8, 20)->notBlank()->noWhitespace(),
                'messages' => [
                    'length' => 'Telefone deve ter de 8 a 20 caracteres',
                    'notBlank' => 'Telefone não pode ser vazio',
                    'noWhitespace' => 'Telefone não pode ter espaços',
                ]
            ],
            'name_responsavel' => [
                'rules' => V::length(6, 100)->notBlank(),
                'messages' => [
                    'notBlank' => 'Nome Responsável não pode ser vazio',
                    'length' => 'Nome Responsável deve ter de 6 a 100 caracteres',
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
            'cep' => [
                'rules' => V::length(8)->noWhitespace()->notBlank(),
                'messages' => [
                    'length' => 'CEP deve conter 8 caracteres',
                    'notBlank' => 'CEP não pode ser vazio',
                    'noWhitespace' => 'CEP não pode ter espaço',
                ]
            ],
            'estado' => [
                'rules' => V::notBlank()->length(2),
                'messages' => [
                    'notBlank' => 'Selecione um Estado',
                    'length' => 'O Estado deve ter 2 caracteres',
                ]
            ],
            'cidade' => [
                'rules' => V::notBlank()->length(6, 100),
                'messages' => [
                    'length' => 'Cidade deve ter de 6 a 100 caracteres',
                    'notBlank' => 'Cidade não pode ser vazio',
                ]
            ],
            'bairro' => [
                'rules' => V::notBlank()->length(6, 100),
                'messages' => [
                    'length' => 'Bairro deve ter de 6 a 100 caracteres',
                    'notBlank' => 'Bairro não pode ser vazio',
                ]
            ],
            'rua' => [
                'rules' => V::notBlank()->length(6, 100),
                'messages' => [
                    'length' => 'Rua deve ter de 6 a 100 caracteres',
                    'notBlank' => 'Rua não pode ser vazio',
                ]
            ],
            'numero' => [
                'rules' => V::notBlank()->length(1, 5)->numeric()->noWhitespace(),
                'messages' => [
                    'length' => 'Número deve ter de 1 a 5 caracteres',
                    'notBlank' => 'Número não pode ser vazio',
                    'noWhitespace' => 'Número não pode ter espaços',
                    'numeric' => 'Número deve ser numérioco',
                ]
            ],
            'complemento' => [
                'rules' => V::length(0, 30),
                'messages' => [
                    'length' => 'Complemento deve ter até 30 caracteres',
                ]
            ],
            'service_uuid' => [
                'rules' => V::notBlank(),
                'messages' => [
                    'notBlank' => 'Selecione o Serviço',
                ]
            ],
            // 'company_uuid' => [
            //     'rules' => V::notBlank(),
            //     'messages' => [
            //         'notBlank' => 'Selecione a Compania',
            //     ]
            // ],
            'status' => [
                'rules' => V::notBlank()->numeric(),
                'messages' => [
                    'notBlank' => 'Selecione o Status',
                    'numeric' => 'Status inválido',            
                ]
            ],
            'commission' => [
                'rules' => V::notBlank()->numeric(),
                'messages' => [
                    'numeric' => 'Comissão inválida',
                    'notBlank' => 'Selecione a Comissão',
                ]
            ],
        ]);
        $uuid = uuid();// && \is_uuid($uuid)
		if ($validator->isValid()) {
            try{               
                if($_SESSION['user']['user_type'] == 3 || $_SESSION['user']['user_type'] == 4){
                    $metadata['commission'] = 1;
                    $metadata['status'] = 7;
                }

                $IndicationsModel = new IndicationsModel($this->container);

                $indication = $IndicationsModel->find(['cpf_cnpj'=>$metadata['cpf_cnpj']]);

                if($indication){
                    $this->container->flash->addMessage('error', 'Indicação com mesmo CPF_CNPJ já existe');
                    return $response->withRedirect($this->container->router->pathFor('cadastroIndicacao'));
                }

                $indication = $IndicationsModel->set([  'uuid'=>$uuid,
                                            'name'=>$metadata['name'],
                                            'cpf_cnpj'=>$metadata['cpf_cnpj'], 
                                            'telefone'=>$metadata['telefone'],
                                            'name_responsavel'=>$metadata['name_responsavel'],
                                            'email'=>$metadata['email'],
                                            'cep'=>$metadata['cep'],
                                            'estado'=>$metadata['estado'],
                                            'cidade'=>$metadata['cidade'],
                                            'bairro'=>$metadata['bairro'],
                                            'rua'=>$metadata['rua'],
                                            'numero'=>$metadata['numero'],
                                            'complemento'=>$metadata['complemento'],
                                            'service_uuid'=>$metadata['service_uuid'],
                                            //'company_uuid'=>$metadata['company_uuid'],
                                            'status'=>$metadata['status'],
                                            'commission'=>$metadata['commission'],
                                            'user_uuid'=>$metadata['user_uuid'],
                                            'creator_uuid'=>$_SESSION['user']['id']]);
                if($indication){
                    $this->container->flash->addMessage('success', 'Cadastrado com sucesso');
                    return $response->withRedirect($this->container->router->pathFor('cadastroIndicacao'));
                }
                else{
                    $errors = $validator->getErrors();
                    $this->container->flash->addMessage('error', 'Falha no cadastro');
                    return $response->withRedirect($this->container->router->pathFor('cadastroIndicacao'));
                }
            
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha no Cadastro');
			    return $response->withRedirect($this->container->router->pathFor('cadastroIndicacao'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('cadastroIndicacao'));
      	}
    }
}