<?php

namespace Tests\App\Models;

use Tests\Functional\BaseTestCase;

class ModelTest extends BaseTestCase
{

    /**
     * Test validando email
     */
    public function testAll()
    {
        $conteiner = $this->app()->getContainer();
        
        $Model = new \Project\Models\Model($conteiner);

        var_dump($Model);
    }
}