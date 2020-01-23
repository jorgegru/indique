<?php

namespace Project\Controllers;

use Project\Models\UsersModel;
use Project\Models\CommissionsModel;
use Project\Models\IndicationsModel;
use Project\Models\ServicesModel;
use Project\Models\FilesModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class EditarComissaoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function editaComissao($request, $response, $args)
   {
        //$companiesModel = new CompaniesModel($this->container);
        $indicationsModel = new IndicationsModel($this->container);
        $commissionsModel = new CommissionsModel($this->container);

        
        //$companies = $companiesModel->all(["1"=>"1"]);

        $message = $this->container->flash->getMessages();

        $indications = $indicationsModel->all(['status'=>'5']);

        if(isset($args['uuid'])){
            $commission = $commissionsModel->find(["uuid"=>$args['uuid']]);
            $commissions = $commissionsModel->all(["indication_uuid"=>$commission['indication_uuid']],"ORDER BY date");
            $indication_uuid = $commission['indication_uuid'];
            $uuid = $args['uuid'];
        }
        else{
            $uuid = '';
            $indication_uuid = '';
            $commissions = '';
        }
		
        return $this->container->renderer->render($response, 'comissao/editaComissao.phtml',['message'=>$message/*,'companies'=>$companies*/,'commissions'=>$commissions, 'indications'=>$indications, 'indication_uuid'=>$indication_uuid, 'uuid'=>$uuid]);
   }

   /**
	* Autenticação de usuarios
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function editarComissao($request, $response, $args)
   {
	   	$metadata = $request->getParsedBody();
        $validator = $this->container->validator->validate($request, [
            'value' => [
                'rules' => V::notBlank()->numeric(),
                'messages' => [
                    'numeric' => 'Valor inválido',
                    'notBlank' => 'Valor não pode ser vazio',
                ]
            ],
            'date' => [
                'rules' => V::length(9, 10),
                'messages' => [
                    'length' => 'Data inválida',
                ]
            ],
            'update' => [
                'rules' => V::numeric(),
                'messages' => [
                    'length' => 'Campo Atualizar inválido',
                ]
            ],
        ]);
       
		if ($validator->isValid()) {
            try{
                $commissionsModel = new CommissionsModel($this->container);
                $filesModel = new FilesModel($this->container);

                if($metadata['update'] == 1){          
                    //arrumando a data
                    $data = substr($metadata['date'], -4)."-".substr($metadata['date'],3, -5)."-".substr($metadata['date'],0, -8);

                    $commission = $commissionsModel->update(['uuid'=>$metadata['commission_uuid'],
                                            'value_commission'=>$metadata['value'],
                                            'date'=>$data,
                                            'observation'=>$metadata['observation']
                                            ]);
                }
                else if($metadata['update'] == 2){
                    $commissions = $commissionsModel->all(['indication_uuid'=>$metadata['indication_uuid']]);
                    $dia = substr($metadata['date'],0, -8);
                    $mes = substr($metadata['date'],3, -5);
                    $ano = substr($metadata['date'], -4);

                    $data2 = substr($metadata['date'], -4)."-".substr($metadata['date'],3, -5)."-".substr($metadata['date'],0, -8);

                    $commission = $commissionsModel->update(['uuid'=>$metadata['commission_uuid'],
                                            'value_commission'=>$metadata['value'],
                                            'date'=>$data2,
                                            'observation'=>$metadata['observation']
                                            ]);

                    foreach($commissions as $value){
                        $data = explode("-", $value['date']);
                        if((int)$ano < (int)$data[0]){

                            
                            $commission = $commissionsModel->update(['uuid'=>$value['uuid'],
                                            'value_commission'=>$metadata['value'],
                                            'paid'=>$metadata['status'],
                                            'observation'=>$metadata['observation']
                                            ]);
                        }
                        else if((int)$mes < (int)$data[1] && (int)$ano <= (int)$data[0]){

                            $commission = $commissionsModel->update(['uuid'=>$value['uuid'],
                                            'value_commission'=>$metadata['value'],
                                            'paid'=>$metadata['status'],
                                            'observation'=>$metadata['observation']
                                            ]);
                        }
                    }
                }
                else{
                    $commissions = $commissionsModel->all(['indication_uuid'=>$metadata['indication_uuid']]);
                    foreach($commissions as $value){
                        $commission = $commissionsModel->update(['uuid'=>$value['uuid'],
                                            'value_commission'=>$metadata['value'],
                                            'paid'=>$metadata['status'],
                                            'observation'=>$metadata['observation']
                                            ]);
                    }
                }

                if($commission){
                    $this->container->flash->addMessage('success', 'Alterado com sucesso');

                    //move file
                    if (!defined('REAL_PATH'))
                    {
                        define('REAL_PATH', realpath("../") . "/");
                    }
                    if(mkdir(REAL_PATH . "files/commissions", 0700)){
                        mkdir(REAL_PATH . "files/commissions", 0700);
                    }
                    $directory = REAL_PATH . 'files/commissions';

                    $uploadedFiles = $metadata['anexo'];
                    $uploadedFiles = $request->getUploadedFiles();

                    foreach ($uploadedFiles['anexo'] as $uploadedFile) {
                        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

                            $uuid_file = uuid();
                            $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                            $basename = 'commission'.$uuid_file; // see http://php.net/manual/en/function.random-bytes.php
                            $filename = sprintf('%s.%0.8s', $basename, $extension);
                            
                            $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

                            $file = $filesModel->set(['uuid'=>$uuid_file,
                                                        'name_file'=>$filename,
                                                        'type'=>2,
                                                        'relation_uuid'=>$metadata['commission_uuid']]);
                            if(!$file){
                                
                            }
                        }
                    }
                    //move_uploaded_file($file,"/Controllers");

                    return $response->withRedirect($this->container->router->pathFor('editaComissao'));   
                }
                else{
                    $errors = $validator->getErrors();
                    $this->container->flash->addMessage('error', 'Falha na alteração');
                    return $response->withRedirect($this->container->router->pathFor('editaComissao'));
                }

                                
            }catch(\PDOException $e){
                $this->container->flash->addMessage('error', 'Falha na Alteração');
			    return $response->withRedirect($this->container->router->pathFor('editaComissao'));
            }
      	} else {
            $errors = $validator->getErrors();
            $this->container->flash->addMessage('validate', $errors);
			return $response->withRedirect($this->container->router->pathFor('editaComissao'));
      	}
    }
    
    public function carregaEditarComissao($request, $response, $args)
    {
        $metadata = $request->getParsedBody();
     
        $commissionsModel = new CommissionsModel($this->container);
        $filesModel = new FilesModel($this->container);

        $commission = $commissionsModel->find(['uuid'=>$metadata['uuid']]);

        $commission['files'] = $filesModel->all(['relation_uuid'=>$metadata['uuid']]);

        return json_encode($commission);
    }

    public function carregaEditarComissaoIndicacao($request, $response, $args)
    {
        $metadata = $request->getParsedBody();
     
        $commissionsModel = new CommissionsModel($this->container);

        $data['indication_uuid'] = $metadata['uuid'];

        $join['indications']['campo'] = 'uuid';
        $join['indications']['campo2'] = 'indications.uuid';
        
        $campos = "commissions.*";

        $commission = $commissionsModel->allInnerJoin($data,$join,$campos,'ORDER BY commissions.date');

        return json_encode($commission);
    }
}