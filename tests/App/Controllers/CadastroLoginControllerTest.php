<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class CadastroLoginControllerTest extends BaseTestCase 
{
    use ModelTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $container;
    protected $conn;
    protected $logger;

    public function testGetCadastroDeslogado()
    {
        $response = $this->runApp('GET', '/cadastroLoginDeslogado');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        //$this->assertStringContainsString('Acesso ao sistema', (string)$response->getBody());
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="email"', (string)$response->getBody());
        $this->assertStringContainsString('name="password"', (string)$response->getBody());
        $this->assertStringContainsString('name="confirm_password"', (string)$response->getBody());
        $this->assertStringContainsString('name="cpf"', (string)$response->getBody());
        //$this->assertStringContainsString('name="company_uuid"', (string)$response->getBody());
    }

    public function testPostCadastroDeslogado()
    {
        $data['name'] = 'Teste Cadastro2';
        $data['email'] = 'emailteste2@gmail.com';
        $data['password'] = '123123';
        $data['confirm_password'] = '123123';
        $data['cpf'] = '88761565008';
        //$data['company_uuid'] = '878b5a1b-de92-11e9-be79-cdc05b889658';
        
        $response = $this->runApp('POST', '/cadastroLoginDeslogado', $data);

        $response = $this->runApp('GET', '/cadastroLoginDeslogado');

        $this->assertStringContainsString('Cadastrado com sucesso', (string)$response->getBody());

        // deletar teste
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->delete(['name'=>'Teste Cadastro2', 'cpf'=>'88761565008']);

        //$location = $response->getHeader("location");
       // $this->assertStringContainsString('dashboard', current($location));
    }

    public function testGetCadastro()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/cadastroLogin');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        //$this->assertStringContainsString('Acesso ao sistema', (string)$response->getBody());
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="email"', (string)$response->getBody());
        $this->assertStringContainsString('name="password"', (string)$response->getBody());
        $this->assertStringContainsString('name="confirm_password"', (string)$response->getBody());
        $this->assertStringContainsString('name="cpf"', (string)$response->getBody());
        //$this->assertStringContainsString('name="company_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="user_type"', (string)$response->getBody());
        $this->assertStringContainsString('name="status"', (string)$response->getBody());
    }

    public function testPostCadastro()
    {

        $data['name'] = 'Teste Cadastro';
        $data['email'] = 'emailteste@gmail.com';
        $data['password'] = '123123';
        $data['confirm_password'] = '123123';
        $data['cpf'] = '78719080069';
        //$data['company_uuid'] = '878b5a1b-de92-11e9-be79-cdc05b889658';
        $data['user_type'] = '1';
        $data['status'] = '1';
        
        $response = $this->runApp('POST', '/cadastroLogin', $data);

        $response = $this->runApp('GET', '/cadastroLogin');

        $this->assertStringContainsString('Cadastrado com sucesso', (string)$response->getBody());

        // deletar teste
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->delete(['name'=>'Teste Cadastro', 'cpf'=>'78719080069']);

        //$location = $response->getHeader("location");
       // $this->assertStringContainsString('dashboard', current($location));
    }
}
