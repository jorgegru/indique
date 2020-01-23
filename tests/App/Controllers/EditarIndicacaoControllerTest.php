<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class EditarIndicacaoControllerTests extends BaseTestCase 
{
    use ModelTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'indications';

    protected $container;
    protected $conn;
    protected $logger;

    public function testGetEditarIndicacao()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/editaIndicacao');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="indication_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="cpf_cnpj"', (string)$response->getBody());
        $this->assertStringContainsString('name="telefone"', (string)$response->getBody());
        $this->assertStringContainsString('name="name_responsavel"', (string)$response->getBody());
        $this->assertStringContainsString('name="email"', (string)$response->getBody());
        $this->assertStringContainsString('name="cep"', (string)$response->getBody());
        $this->assertStringContainsString('name="estado"', (string)$response->getBody());
        $this->assertStringContainsString('name="cidade"', (string)$response->getBody());
        $this->assertStringContainsString('name="bairro"', (string)$response->getBody());
        $this->assertStringContainsString('name="rua"', (string)$response->getBody());
        $this->assertStringContainsString('name="complemento"', (string)$response->getBody());
        $this->assertStringContainsString('name="service_uuid"', (string)$response->getBody());
       // $this->assertStringContainsString('name="company_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="status"', (string)$response->getBody());
        $this->assertStringContainsString('name="user_uuid"', (string)$response->getBody());
    }

    public function testCarregaEditarIndicacao()
    {
        $data['uuid'] = 'c13b77c2-0ade-4733-9e42-dc3782ba40a7';

        
        $response = $this->runApp('POST', '/carregaEditarIndicacao', $data);

        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->find(['uuid'=>'c13b77c2-0ade-4733-9e42-dc3782ba40a7']);

        $this->assertJsonStringEqualsJsonString(
            (string)$response->getBody(),
            json_encode($rs)
        );
    }

    public function testPostEditarIndicacao()
    {
        $data['indication_uuid'] = 'c13b77c2-0ade-4733-9e42-dc3782ba40a7';
        $data['cpf_cnpj'] = '76380601000139';
        $data['name'] = 'Teste Indicacao';
        $data['telefone'] = '1112341234';
        $data['name_responsavel'] = 'Teste Indicacao2';
        $data['email'] = 'teste@teste.com';
        $data['cep'] = '04184000';
        $data['estado'] = 'SP';
        $data['cidade'] = 'São Paulo';
        $data['bairro'] = 'Bairro teste';
        $data['rua'] = 'Rua de Teste';
        $data['numero'] = '524';
        $data['status'] = '1';
        $data['commission'] = '1';
        $data['start_date'] = '2019-10-02';
        $data['end_date'] = '2019-10-02';
        $data['value_commission'] = '10000';
        $data['complemento'] = 'ap 85';
        $data['service_uuid'] = 'ccf876d4-e91f-11e9-81b4-2a2ae2dbcce4';
        $data['user_uuid'] = '39e6b74d-f081-43d2-ac4b-c50810754d18';
        
        $response = $this->runApp('POST', '/editaIndicacao', $data);

        $response = $this->runApp('GET', '/editaIndicacao');

        $this->assertStringContainsString('Alterado com sucesso', (string)$response->getBody());
    }
}
