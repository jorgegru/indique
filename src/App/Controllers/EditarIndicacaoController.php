<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use Project\Models\IndicationsModel;
use Project\Models\ObservationIndicationModel;
use Project\Models\ServicesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class EditarIndicacaoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function editaIndicacao($request, $response, $args)
   {
        //$companiesModel = new CompaniesModel($this->container);
        $indicationsModel = new IndicationsModel($this->container);
        $usersModel = new UsersModel($this->container);
        $servicesModel = new ServicesModel($this->container);

        if($_SESSION['user']['user_type'] == 3){
            $indications = $indicationsModel->all(['user_uuid'=>$_SESSION['user']['id']]);
        }else{
            $indications = $indicationsModel->all(['1'=>'1']);
        }

        $consultores = $usersModel->all(["user_type"=>"3","status"=>"1"]);
        $services = $servicesModel->all(["1"=>"1"]);
        //$companies = $companiesModel->all(["1"=>"1"]);

        $message = $this->container->flash->getMessages();

        if(isset($args['uuid'])) $uuid = $args['uuid'];
        else             $uuid = '';
		
        return $this->container->renderer->render($response, 'indicacao/editaIndicacao.phtml',['message'=>$message/*,'companies'=>$companies*/,'consultores'=>$consultores, 'services'=>$services, 'indications'=>$indications, 'uuid'=>$uuid]);
   }

   /**
	* Autenticação de usuarios
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function editarIndicacao($request, $response, $args)
   {
	   	$metadata = $request->getParsedBody();
        $validator = $this->container->validator->validate($request, [
            'indication_uuid' => [
                'rules' => V::notBlank(),
                'messages' => [
                    'notBlank' => 'Selecione uma indicação',
                ]
            ],
            'name' => [
                'rules' => V::notBlank()->length(6, 100),
                'messages' => [
                    'notBlank' => 'O Nome não pode ser vazio',
                    'length' => 'O Nome deve ter de 6 a 100 caracteres',
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
            'cargo' => [
                'rules' => V::length(4, 45)->notBlank(),
                'messages' => [
                    'length' => 'O Cargo deve conter de 4 a 45 caracteres',
                    'notBlank' => 'Cargp não pode ser vazio',
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
        ]);
       
		if ($validator->isValid()) {
            try{
                $indicationsModel = new IndicationsModel($this->container);

                if($metadata['cpf_cnpj']){
                    $indication = $indicationsModel->validateCompanie(['cpf_cnpj'=>$metadata['cpf_cnpj'], 'uuid'=>$metadata['indication_uuid']]);
                    if($indication){
                        $this->container->flash->addMessage('error', 'Indicação com mesmo CPF_CNPJ já existe');
                        return $response->withRedirect($this->container->router->pathFor('editaIndicacao'));
                    }
                }
                else{
                    $metadata['cpf_cnpj'] =  null;
                }

                $indication = $indicationsModel->update([  'uuid'=>$metadata['indication_uuid'],
                                            'name'=>$metadata['name'],
                                            'cpf_cnpj'=>$metadata['cpf_cnpj'], 
                                            'telefone'=>$metadata['telefone'],
                                            'telefone'=>$metadata['telefone2'],
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
                                            'observation'=>$metadata['observation'],
                                            'service_uuid'=>$metadata['service_uuid'],
                                            //'company_uuid'=>$metadata['company_uuid'],
                                            'status'=>$metadata['status'],
                                            'user_uuid'=>$metadata['user_uuid']]);

                if($indication){
                    if($metadata['observation_status'] && $metadata['observation_status'] != " "){//adiciona observação status
                        $ObservationIndicationModel = new ObservationIndicationModel($this->container);
                        $observation = $ObservationIndicationModel->set(['uuid_indication'=>$metadata['indication_uuid'],
                                                                'status'=>$metadata['status'],
                                                                'observation'=>$metadata['observation_status']]);
                    }
                    $this->container->flash->addMessage('success', 'Alterado com sucesso');
                    if($metadata['status'] == 5){
                        return $response->withRedirect($this->container->router->pathFor('cadastroContrato',[
                            'uuid' => $metadata['indication_uuid']
                        ]));        
                    }
                    return $response->withRedirect($this->container->router->pathFor('editaIndicacao'));    
                }
                else{
                    $errors = $validator->getErrors();
                    $this->container->flash->addMessage('error', 'Falha na alteração');
                    return $response->withRedirect($this->container->router->pathFor('editaIndicacao'));
                }

                                
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha na Alteração');
			    return $response->withRedirect($this->container->router->pathFor('editaIndicacao'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('editaIndicacao'));
      	}
    }
    
    public function carregaEditarIndicacao($request, $response, $args)
    {
        $metadata = $request->getParsedBody();
     
        $ObservationIndicationModel = new ObservationIndicationModel($this->container);
        $indicationsModel = new IndicationsModel($this->container);

        $indication = $indicationsModel->find(['uuid'=>$metadata['uuid']]);

        $indication['observation_status'] = $ObservationIndicationModel->all(['uuid_indication'=>$metadata['uuid']]);

        return json_encode($indication);
    }
}