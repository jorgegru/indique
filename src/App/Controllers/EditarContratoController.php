<?php

namespace Project\Controllers;

use Project\Models\ContractsModel;
use Project\Models\CompaniesModel;
use Project\Models\IndicationsModel;
use Project\Models\ServicesModel;
use Project\Models\FilesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class EditarContratoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function editaContrato($request, $response, $args)
   {
        //$companiesModel = new CompaniesModel($this->container);
        $indicationsModel = new IndicationsModel($this->container);
        $contractsModel = new ContractsModel($this->container);


        $contracts = $contractsModel->all(['1'=>'1']);

        $message = $this->container->flash->getMessages();

        if(isset($args['uuid'])) $uuid = $args['uuid'];
        else             $uuid = '';
		
        return $this->container->renderer->render($response, 'contrato/editaContrato.phtml',['message'=>$message, 'contracts'=>$contracts, 'uuid'=>$uuid]);
   }

   /**
	* Autenticação de Contratos
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function editarContrato($request, $response, $args)
   {
	   	$metadata = $request->getParsedBody();
        $validator = $this->container->validator->validate($request, [
            'contract_uuid' => [
                'rules' => V::notBlank(),
                'messages' => [
                    'notBlank' => 'Selecione um contrato',
                ]
            ],
            'corporate_name' => [
                'rules' => V::notBlank()->length(6, 100),
                'messages' => [
                    'notBlank' => 'O Nome da Empresa não pode ser vazio',
                    'length' => 'O Nome da Empresa deve ter de 6 a 100 caracteres',
                ]
            ],
            'value' => [
                'rules' => V::numeric(),
                'messages' => [
                    'numeric' => 'Valor inválido',
                ]
            ],
            'date' => [
                'rules' => V::length(9, 10),
                'messages' => [
                    'length' => 'Data inválida',
                ]
            ],
            'indentification' => [
                'rules' => V::length(1, 20),
                'messages' => [
                    'length' => 'A Identificação deve ter entre 1 e 20 caracteres',
                ]
            ],
        ]);

		if ($validator->isValid()) {
            try{
                $contractsModel = new ContractsModel($this->container);
                $filesModel = new FilesModel($this->container);

                $contract = $contractsModel->validateUniqueField(['indentification'=>$metadata['indentification'], 'uuid'=>$metadata['contract_uuid']]);

                if($contract){
                    $this->container->flash->addMessage('error', 'Já existe um contrato com esta identificação');
                    return $response->withRedirect($this->container->router->pathFor('editaContrato'));
                }

                //arrumando a data
                $data = substr($metadata['date'], -4)."-".substr($metadata['date'],3, -5)."-".substr($metadata['date'],0, -8);

                $contract = $contractsModel->update([  'uuid'=>$metadata['contract_uuid'],
                                            'corporate_name'=>$metadata['corporate_name'],
                                            'value'=>$metadata['value'], 
                                            'date'=>$data,
                                            'observation'=>$metadata['observation'],
                                            'indentification'=>$metadata['indentification']
                                            ]);

                if($contract){

                    $this->container->flash->addMessage('success', 'Alterado com sucesso');
                    
                    if($metadata['anexo']){
                        //move file
                        if (!defined('REAL_PATH'))
                        {
                            define('REAL_PATH', realpath("../") . "/");
                        }
                        if(mkdir(REAL_PATH . "/files", 0700)){
                            mkdir(REAL_PATH . "/files/contracts", 0700);
                        }
                        $directory = REAL_PATH . '/files/contracts';

                        $uploadedFiles = $metadata['anexo'];
                        $uploadedFiles = $request->getUploadedFiles();

                        
                        foreach ($uploadedFiles['anexo'] as $uploadedFile) {
                            
                            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

                                $uuid_file = uuid();
                                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                                $basename = 'contract'.$uuid_file; // see http://php.net/manual/en/function.random-bytes.php
                                $filename = sprintf('%s.%0.8s', $basename, $extension);
                                
                                $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

                                $file = $filesModel->set(['uuid'=>$uuid_file,
                                                            'name_file'=>$filename,
                                                            'type'=>1,
                                                            'relation_uuid'=>$metadata['contract_uuid']]);
                                if(!$file){
                                    
                                }
                            }
                        }
                        //move_uploaded_file($file,"/Controllers");
                    }
                    return $response->withRedirect($this->container->router->pathFor('editaContrato'));   
                }
                else{
                    $errors = $validator->getErrors();
                    $this->container->flash->addMessage('error', 'Falha na alteração');
                    return $response->withRedirect($this->container->router->pathFor('editaContrato'));
                }

                                
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha na Alteração');
			    return $response->withRedirect($this->container->router->pathFor('editaContrato'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('editaContrato'));
      	}
    }

    public function carregaEditarContrato($request, $response, $args)
    {
        $metadata = $request->getParsedBody();
     
        $contractsModel = new ContractsModel($this->container);
        $filesModel = new FilesModel($this->container);
        

        // $data['uuid'] = '%'.$metadata['uuid'].'%';

        // $join['files']['campo'] = 'relation_uuid';
        // $join['files']['campo2'] = 'contracts.uuid';
        
        // $campos = "contracts.*, files.name_file, files.type as type_file";

        // $contract = $contractsModel->allLikeLeftJoin($data, $join, $campos);

        $contract = $contractsModel->find(['uuid'=>$metadata['uuid']]);

        $contract['files'] = $filesModel->all(['relation_uuid'=>$metadata['uuid']]);

        return json_encode($contract);
    }
}