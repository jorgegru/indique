<?php

namespace Project\Controllers;

use Project\Models\ObservationIndicationModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class AdicionarObservacaoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function addObservacao($request, $response, $args)
   {
        $metadata = $request->getParsedBody();
        // $uuid           = $data['uuid'];
        // $status         = $data['status'];
        // $observation    = $data['observation'];

        // $start_date."-/-".
        // $end_date."-/-".
        // $indication_uuid."-/-".
        // $commission."-/-".
        // $meses."-/-\n\n".
        // json_encode($data)
        // );

    
        $ObservationIndicationModel = new ObservationIndicationModel($this->container);
            $uuid = uuid();
        $result = $ObservationIndicationModel->set(["uuid_indication"=>$metadata["uuid"],  
                                    "status"=>$metadata['status'],
                                    "observation"=>$metadata['observation']]);
        if($result){
            $retorno['data'] = date("d/m/Y - H:i:s");
            switch ($metadata['status']) {
                case "1":
                    $retorno['status'] = 'Pendente';
                    break;
                case "2":
                    $retorno['status'] = 'Cliente contatado';
                    break;
                case "3":
                    $retorno['status'] = 'Visita Realizada';
                    break;
                case "4":
                    $retorno['status'] = 'Proposta Enviada';
                    break;
                case "5":
                    $retorno['status'] = 'Negocio ganho';
                    break;
                case "6":
                    $retorno['status'] = 'Negocio perdido';
                    break;
                case "7":
                    $retorno['status'] = 'Sem Consultor';
                    break;
                default:
                    break;
            }
            $retorno['observacao'] = $metadata['observation'];
            return json_encode($retorno);
        }   
        else{
            return json_encode(false);
        }                        
        //return json_encode($result);
        // if($result){
        //     return true;
        // }
        // else{
        //     return false;
        // }
    } 
}
