<?php

namespace Tests\App\Models;

use Tests\Functional\BaseTestCase;
use \Project\Models\Model;
use Psr\Container\ContainerInterface;

class ModelTest extends BaseTestCase
{

    

    /**
     * Test validando email
     */
    public function testAll()
    {
        $conteiner = $this->app()->getContainer();
        
        
        $Model = new Model($conteiner);

        //var_dump($Model);
    }
}