<?php

namespace Tests\App\Controllers;

use Project\Models\FilesModel;
use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class EditarContratoControllerTests extends BaseTestCase 
{
    use ModelTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts';

    protected $container;
    protected $conn;
    protected $logger;

    public function testGetEditarContrato()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
        $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/editaContrato');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="contract_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="corporate_name"', (string)$response->getBody());
        $this->assertStringContainsString('name="value"', (string)$response->getBody());
        $this->assertStringContainsString('name="value2"', (string)$response->getBody());
        $this->assertStringContainsString('name="date"', (string)$response->getBody());
        $this->assertStringContainsString('name="indentification"', (string)$response->getBody());
        $this->assertStringContainsString('name="observation"', (string)$response->getBody());
        $this->assertStringContainsString('name="anexo[]"', (string)$response->getBody());
        $this->assertStringContainsString('id="div_contrato"', (string)$response->getBody());
    }

    public function testCarregaEditarContrato()
    {
        $this->container = $this->app()->getContainer();
        $filesModel = new FilesModel($this->container);

        $data['uuid'] = 'e9f0b295-184c-46ee-911d-8265817c5d9e';
        
        $response = $this->runApp('POST', '/carregaEditarContrato', $data);

        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->find(['uuid'=>"e9f0b295-184c-46ee-911d-8265817c5d9e"]);

        $rs['files'] = $filesModel->all(['relation_uuid'=>"e9f0b295-184c-46ee-911d-8265817c5d9e"]);

        $this->assertJsonStringEqualsJsonString(
            (string)$response->getBody(),
            json_encode($rs)
        );
    }

    public function testPostEditarContrato()
    {
        $data['contract_uuid'] = 'e9f0b295-184c-46ee-911d-8265817c5d9e';
        $data['corporate_name'] = 'Teste Contrato';
        $data['value2'] = '100,00';
        $data['value'] = '10000';
        $data['date'] = '2020-01-09';
        $data['indentification'] = '00000000';
        $data['observation'] = 'teste';
        $data['anexo'] = '';
        
        $response = $this->runApp('POST', '/editaContrato', $data);
        
        $response = $this->runApp('GET', '/editaContrato');
        
        $this->assertStringContainsString('Alterado com sucesso', (string)$response->getBody());
    }
}
