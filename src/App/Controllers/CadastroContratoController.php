<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CompaniesModel;
use Project\Models\ServicesModel;
use Project\Models\IndicationsModel;
use Project\Models\CommissionsModel;
use Project\Models\ContractsModel;
use Project\Models\FilesModel;
use Project\Controllers\CadastroComissaoController;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class CadastroContratoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function cadastroContrato($request, $response, $args)
   {
        //$companiesModel = new CompaniesModel($this->container);
        
        if(isset($args['success'])){
            return $this->container->renderer->render($response, 'index.phtml',['validate'=>$args['return']['message']]);
        }

        $contractsModel = new ContractsModel($this->container);
        $indicationsModel = new IndicationsModel($this->container);
        $userModel = new UsersModel($this->container);

        $uuid = $args['uuid'];

        $valida = $contractsModel->find(['indication_uuid'=>$uuid]);
        if($valida){
            $this->container->flash->addMessage('error', 'Já existe um contrato para essa indicação');
            return $response->withRedirect($this->container->router->pathFor('editaIndicacao'));
        }

        $indication = $indicationsModel->find(["uuid"=>$uuid]);
        if($indication["status"] != 5){
            $this->container->flash->addMessage('error', 'A indicação deve ser ganha para se cadastrar o contrato!');
            return $response->withRedirect($this->container->router->pathFor('editaIndicacao'));
        }

        $consultores = $userModel->all(["1"=>"1"]);

        $usersModel = new UsersModel($this->container);
        $servicesModel = new ServicesModel($this->container);

        $message = $this->container->flash->getMessages();
        if(isset($args['return'])) {
            $message = $args['return']['message'];
            $uuid = $args['return']['uuid'];
        }


        if(isset($args['uuid'])) $uuid = $args['uuid'];

		
        return $this->container->renderer->render($response, 'contrato/cadastroContrato.phtml',['message'=>$message/*,'companies'=>$companies*/, 'consultores'=>$consultores, 'indication'=>$indication]);
   }


   /**
	* Autenticação de contrato
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function cadastrarContrato($request, $response, $args)
   {   
        $metadata = $request->getParsedBody();
        
        $validator = $this->container->validator->validate($request, [
            'corporate' => [
                'rules' => V::notBlank()->length(6, 100),
                'messages' => [
                    'notBlank' => 'O Nome não pode ser vazio',
                    'length' => 'A Razão Social deve ter de 6 a 100 caracteres',
                ]
            ],
            'value_contract' => [
                'rules' => V::numeric()->notBlank()->noWhitespace(),
                'messages' => [
                    'numeric' => 'Digite apenas números para o valor do Contrato',
                    'notBlank' => 'O Valor do Contrato não pode ser vazio',
                    'noWhitespace' => 'O valor do contrato não pode ter espaços',
                ]
            ],
            'date' => [
                'rules' => V::length(10)->notBlank()->noWhitespace(),
                'messages' => [
                    'length' => 'Digite uma Data válida',
                    'notBlank' => 'A Data não pode ser vazia',
                    'noWhitespace' => 'A Data não pdoe ter espaços',
                ]
            ],
            'observation' => [
                'rules' => V::length(0, 255)->notBlank(),
                'messages' => [
                    'length' => 'A Observação deve ter até 255 caracteres',
                ]
            ],
            'indentification' => [
                'rules' => V::noWhitespace()->notBlank(),
                'messages' => [
                    'notBlank' => 'A identificação não pode ser vazia',
                    'noWhitespace' => 'A identificação não deve ter espaços',
                ]
            ],
            'value_commission' => [
                'rules' => V::noWhitespace()->notBlank(),
                'messages' => [
                    'notBlank' => 'Digite um valor para comissão',
                    'noWhitespace' => 'A Comissão não deve ter espaço',
                ]
            ],
        ]);
        $uuid = uuid();// && \is_uuid($uuid)
		if ($validator->isValid()) {
            try{               
                $indicationsModel = new IndicationsModel($this->container);
                $contractsModel = new ContractsModel($this->container);
                $commissionsModel = new CommissionsModel($this->container);
                $filesModel = new FilesModel($this->container);
                $cadastroComissaoController = new CadastroComissaoController($this->container);



                if($metadata['start_date'] == $metadata['end_date']){
                    $metadata['start_date'] = null;
                    $metadata['end_date'] = null;
                }

                //arrumando a data
                $data = substr($metadata['date'], -4)."-".substr($metadata['date'],3, -5)."-".substr($metadata['date'],0, -8);

                $contract = $contractsModel->set([  'uuid'=>$uuid,
                                                    'corporate_name'=>$metadata['corporate'],
                                                    'value'=>$metadata['value_contract'],
                                                    'date'=>$data,
                                                    'user_uuid'=>$_SESSION['user']['id'],
                                                    'observation'=>$metadata['observation'],
                                                    'indentification'=>$metadata['indentification'],
                                                    'indication_uuid'=>$metadata['indication_uuid']
                ]);

                $indication = $indicationsModel->update([   'uuid'=>$metadata['indication_uuid'],
                                                            'value_commission'=>$metadata['value_commission'], 
                                                            'start_date'=>$metadata['start_date'],
                                                            'end_date'=>$metadata['end_date'],
                ]);

                $cadastroComissaoController->cadastroComissao($metadata);

                if($contract){//cadastroComissao
                   
                    $this->container->flash->addMessage('success', 'Cadastrado com sucesso');
                    $message['message']['validate'][0]['success'][0] = 'Cadastrado com sucesso';
                    //$this->cadastroContrato($request, $response, ['return'=>$message,'success'=>true]);
                    //return $response->withRedirect($this->container->router->pathFor('index'));
                    
                    //move arquivo
                    if(isset($metadata['anexo'])){
                        if (!defined('REAL_PATH'))
                        {
                            define('REAL_PATH', realpath("../") . "/");
                        }
                        
                        mkdir(REAL_PATH . "files", 0700);
                        mkdir(REAL_PATH . "files/contracts", 0700);
                        
                        $directory = REAL_PATH . 'files/contracts';

                        $uploadedFiles = $metadata['anexo'];
                        $uploadedFiles = $request->getUploadedFiles();

                        foreach ($uploadedFiles['anexo'] as $uploadedFile) {
                            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

                                $uuid_file = uuid();
                                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                                $basename = 'contract_'.$uuid_file; // see http://php.net/manual/en/function.random-bytes.php
                                $filename = sprintf('%s.%0.8s', $basename, $extension);

                                $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

                                $file = $filesModel->set(['uuid'=>$uuid_file,
                                                            'name_file'=>$filename,
                                                            'type'=>1,
                                                            'relation_uuid'=>$uuid]);
                                if(!$file){
                                    
                                }
                            }
                        }
                    }
                    //move_uploaded_file($file,"/Controllers");

                    return $response->withRedirect($this->container->router->pathFor('index',[
                        'status' => "success"
                    ]));
                }
                else{
                    $errors = $validator->getErrors();
                    $this->container->flash->addMessage('error', 'Falha no cadastro');
                    $message['uuid'] = $metadata['indication'];
                    $message['message']['validate'][0] = $errors;
                    $this->cadastroContrato($request, $response, ['uuid'=>$metadata['indication'], 'return'=>$message]);
                    //return $response->withRedirect($this->container->router->pathFor('cadastroContrato/('.$metadata['indication'].')'));
                }
            
            }catch(\PDOException $e){
                $errors = $validator->getErrors();
                $this->container->flash->addMessage('error', 'Falha no Cadastro');
                $message['uuid'] = $metadata['indication'];
                $message['message']['validate'][0] = $errors;
                $this->cadastroContrato($request, $response, ['uuid'=>$metadata['indication'], 'return'=>$message]);
			    //return $response->withRedirect($this->container->router->pathFor('cadastroContrato/'.$metadata['indication']));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
            $message['uuid'] = $metadata['indication'];
            $message['message']['validate'][0] = $errors;
            $this->cadastroContrato($request, $response, ['uuid'=>$metadata['indication'], 'return'=>$message]);
            //return $this->$container->get('renderer')->render($response, 'cadastroContrato/'.$metadata['indication'], $args);
			//return $response->withRedirect($this->container->router->pathFor('cadastroContrato/'.$metadata['indication']));
      	}
    }
}