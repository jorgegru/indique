<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class UserControllerTest extends BaseTestCase 
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

    public function testGetListaUser()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/listaUsers');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="dado"', (string)$response->getBody());
        $this->assertStringContainsString('name="busca"', (string)$response->getBody());
        $this->assertStringContainsString('name="status"', (string)$response->getBody());
        $this->assertStringContainsString('id="tbUsuarioBody"', (string)$response->getBody());
    }

    public function testFiltroLista()
    {
        $data['nome'] = 'email';
        $data['valor'] = 'sergio@gmail.com';

        //filtroUserLista
        $response = $this->runApp('POST', '/filtroUserLista', $data);

        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->allLikeUser(['email'=>'sergio@gmail.com'], ["user_type"=>array("2","3","4")]);
        
        $this->assertJsonStringEqualsJsonString(
            (string)$response->getBody(),
            json_encode($rs)
        );
    }

    public function testGetEditaUserLista()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/editaLogin/130c01d9-5c12-42c4-8ad0-5b6350cad1a9');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="user_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="email"', (string)$response->getBody());
        $this->assertStringContainsString('name="password"', (string)$response->getBody());
        $this->assertStringContainsString('name="confirm_password"', (string)$response->getBody());
        $this->assertStringContainsString('name="cpf"', (string)$response->getBody());
        //$this->assertStringContainsString('name="company_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="user_type"', (string)$response->getBody());
        $this->assertStringContainsString('name="status"', (string)$response->getBody());

    }
}
