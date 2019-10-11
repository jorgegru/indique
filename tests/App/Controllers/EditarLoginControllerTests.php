<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class EditarLoginControllerTests extends BaseTestCase 
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

    public function testGetEditar()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                $_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/editaLogin');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="user_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="email"', (string)$response->getBody());
        $this->assertStringContainsString('name="password"', (string)$response->getBody());
        $this->assertStringContainsString('name="confirm_password"', (string)$response->getBody());
        $this->assertStringContainsString('name="cpf"', (string)$response->getBody());
        $this->assertStringContainsString('name="company_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="user_type"', (string)$response->getBody());
        $this->assertStringContainsString('name="status"', (string)$response->getBody());
    }

    public function testCarregaEditarLogin()
    {
        $data['uuid'] = '1325a489-3d1c-4e91-9565-aa1824e91b47';
        
        $response = $this->runApp('POST', '/carregaEditarLogin', $data);
        //var_dump((string)$response->getBody());die;

        $data = array('company_uuid' => '1176d247-d2b4-43b6-9f75-5421a0459cb9',
        'cpf' => '257.797.261-11', 
        'create_time' => '2019-10-09 08:17:52',
        'email' => 'fe@gmail.com',
        'name' => 'Fernando',
        'password' => '781349',
        'status' => '1',
        'user_type' => '2',
        'uuid' => '1325a489-3d1c-4e91-9565-aa1824e91b47');

        //var_dump((string)$response->getBody());

        //$newResponse = $response->withJson($data);

        $this->assertJsonStringEqualsJsonString(
           // json_encode($data)

            (string)$response->getBody(),
            json_encode($data)
        );
    }

    public function testPostEditar()
    {
        $data['user_uuid'] = '39e6b74d-f081-43d2-ac4b-c50810754d18';
        $data['name'] = 'Arnaldo';
        $data['email'] = 'arnold@gmail.com';
        $data['password'] = str_replace(' ', '',date("Y-m-d H:i:s"));
        $data['confirm_password'] = str_replace(' ', '',date("Y-m-d H:i:s"));
        $data['cpf'] = '82476675091';
        $data['company_uuid'] = '0c6ee8cf-eea4-4036-bdbe-0d2d0de1b823';
        $data['user_type'] = '3';
        $data['status'] = '1';
        
        $response = $this->runApp('POST', '/editaLogin', $data);

        $response = $this->runApp('GET', '/editaLogin');

        $this->assertStringContainsString('Alterado com sucesso', (string)$response->getBody());
    }
}
