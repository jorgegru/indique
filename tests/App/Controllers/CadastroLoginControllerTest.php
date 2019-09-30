<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class CadastroLoginControllerTest extends BaseTestCase 
{
    public function testGetCadastro()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
				$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";

        $response = $this->runApp('GET', '/cadastroLogin');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        //$this->assertStringContainsString('Acesso ao sistema', (string)$response->getBody());
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="email"', (string)$response->getBody());
        $this->assertStringContainsString('name="password"', (string)$response->getBody());
        $this->assertStringContainsString('name="confirm_password"', (string)$response->getBody());
        $this->assertStringContainsString('name="cpf"', (string)$response->getBody());
        $this->assertStringContainsString('name="company_uuid"', (string)$response->getBody());
    }

    public function testPostCadastro()
    {

        $data['name'] = 'Teste Cadastro';
        $data['email'] = 'emailteste@gmail.com';
        $data['password'] = '123123';
        $data['confirm_password'] = '123123';
        $data['cpf'] = '11111111111';
        $data['company_uuid'] = '878b5a1b-de92-11e9-be79-cdc05b889658';
        
        $response = $this->runApp('POST', '/cadastroLogin', $data);

        $response = $this->runApp('GET', '/cadastroLogin');

        //var_dump((string)$response->getBody());die;

        $this->assertStringContainsString('Cadastrado com sucesso', (string)$response->getBody());

        //$location = $response->getHeader("location");
       // $this->assertStringContainsString('dashboard', current($location));
    }
}
