<?php

namespace Tests\App\Models;

use Tests\Functional\BaseTestCase;
use \Project\Models\Model;

class ModelTest extends BaseTestCase
{

    public function testAll()
    {
        $conteiner = $this->app()->getContainer();
        
        // $Model = new Model($conteiner);
        $this->assertTrue(true);
        //var_dump($Model);
    }
}