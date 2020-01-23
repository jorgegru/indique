<?php

namespace Project\Files;

use Project\Models\IndicationsModel;
use Project\Models\CommissionsModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;
class FilesController
{
	protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function getFile($request, $response, $args)
   {
    $file = 'monkey.gif';
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment;filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
}