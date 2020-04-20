<?php

namespace Project\Controllers;

use Project\Models\ObservationIndicationModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class ObservationIndicationController
{
	protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

    public function getObservacao($request, $response, $args){
        $args['uuid'];
        
        $ObservationIndicationModel = new ObservationIndicationModel($this->container);
        
        $observacoes = $ObservationIndicationModel->all(['uuid_indication'=>$args['uuid']]);

        return json_encode($observacoes);
    }
}