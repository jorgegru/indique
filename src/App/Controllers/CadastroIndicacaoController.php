<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use Project\Models\ServicesModel;
use Project\Models\IndicationsModel;
use Project\Models\ObservationIndicationModel;
use Project\Controllers\CadastroComissaoController;
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
            'telefone' => [
                'rules' => V::length(8, 20)->notBlank(),
                'messages' => [
                    'length' => 'Telefone deve ter de 8 a 20 caracteres',
                    'notBlank' => 'Telefone não pode ser vazio',
                ]
            ],
            'name_responsavel' => [
                'rules' => V::length(6, 100)->notBlank(),
                'messages' => [
                    'notBlank' => 'Nome Responsável não pode ser vazio',
                    'length' => 'Nome Responsável deve ter de 6 a 100 caracteres',
                ]
            ],
            'cargo' => [
                'rules' => V::length(4, 45)->notBlank(),
                'messages' => [
                    'length' => 'O Cargo deve conter de 4 a 45 caracteres',
                    'notBlank' => 'Cargp não pode ser vazio',
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
            // 'commission' => [
            //     'rules' => V::notBlank()->numeric(),
            //     'messages' => [
            //         'numeric' => 'Comissão inválida',
            //         'notBlank' => 'Selecione a Comissão',
            //     ]
            // ],
            // 'value_commission' => [
            //     'rules' => V::numeric(),
            //     'messages' => [
            //         'numeric' => 'Valor inválido',
            //     ]
            // ],
            // 'start_date' => [
            //     'rules' => V::length(9, 10),
            //     'messages' => [
            //         'length' => 'Data inválida',
            //     ]
            // ],
            // 'end_date' => [
            //     'rules' => V::length(9, 10),
            //     'messages' => [
            //         'length' => 'Data inválida',
            //     ]
            // ],
        ]);
        $uuid = uuid();// && \is_uuid($uuid)
		if ($validator->isValid()) {
            try{               
                if($_SESSION['user']['user_type'] == 3 || $_SESSION['user']['user_type'] == 4){
                    $metadata['status'] = 7;
                }

                $metadata['commission'] = 1;

                $metadata['telefone'] = preg_replace('/\D+/', '', $metadata['telefone']);//arrumando o telefone
                $metadata['telefone2'] = preg_replace('/\D+/', '', $metadata['telefone2']);

                $IndicationsModel = new IndicationsModel($this->container);

                if($metadata['cpf_cnpj']){
                    $indication = $IndicationsModel->find(['cpf_cnpj'=>$metadata['cpf_cnpj']]);
                    if($indication){
                        $this->container->flash->addMessage('error', 'Indicação com mesmo CPF_CNPJ já existe');
                        return $response->withRedirect($this->container->router->pathFor('cadastroIndicacao'));
                    }
                }
                else{
                    $metadata['cpf_cnpj']=null;
                }


                // if($metadata['start_date'] == $metadata['end_date']){
                //     $metadata['start_date'] = null;
                //     $metadata['end_date'] = null;
                // }



                $indication = $IndicationsModel->set([  'uuid'=>$uuid,
                                            'name'=>$metadata['name'],
                                            'cpf_cnpj'=>$metadata['cpf_cnpj'], 
                                            'telefone'=>$metadata['telefone'],
                                            'telefone2'=>$metadata['telefone2'],
                                            'name_responsavel'=>$metadata['name_responsavel'],
                                            'cargo'=>$metadata['cargo'],
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
                                            'value_commission'=>"0000",
                                            'start_date'=>null,
                                            'end_date'=> null,
                                            'observation'=>$metadata['observation'],
                                            'user_uuid'=>$metadata['user_uuid'],
                                            'creator_uuid'=>$_SESSION['user']['id']]);
                if($indication){//cadastroComissao
                    // $CadastroComissaoController = new CadastroComissaoController($this->container);
                    // $metadata['uuid'] = $uuid;
                    // $CadastroComissaoController->cadastroComissao($metadata);
                    if($metadata['observation_status']){//adiciona observação status
                        $ObservationIndicationModel = new ObservationIndicationModel($this->container);
                        $observation = $ObservationIndicationModel->set(['uuid_indication'=>$uuid,
                                            'status'=>$metadata['status'],
                                            'observation'=>$metadata['observation_status']]);
                    }
                    $this->container->flash->addMessage('success', 'Cadastrado com sucesso');
                    if($metadata['status'] == 5){
                        return $response->withRedirect($this->container->router->pathFor('cadastroContrato',[
                            'uuid' => $uuid
                        ]));        
                    }
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