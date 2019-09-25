<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class LoginControllerTest extends BaseTestCase 
{
    public function testGetLogin()
    {
        $response = $this->runApp('GET', '/login');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Acesso ao sistema', (string)$response->getBody());
    }



}
