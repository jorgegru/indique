<?php

namespace Tests\App\Controllers;

use Project\Models\FilesModel;
use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class EditarComissaoControllerTest extends BaseTestCase 
{
    use ModelTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commissions';

    protected $container;
    protected $conn;
    protected $logger;

    public function testGetEditarComissao()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
        $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/editaComissao');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="indication_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="commission_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="value"', (string)$response->getBody());
        $this->assertStringContainsString('name="value2"', (string)$response->getBody());
        $this->assertStringContainsString('name="date"', (string)$response->getBody());
        $this->assertStringContainsString('id="div_status"', (string)$response->getBody());
        $this->assertStringContainsString('name="observation"', (string)$response->getBody());
        $this->assertStringContainsString('name="update"', (string)$response->getBody());
        $this->assertStringContainsString('name="anexo[]"', (string)$response->getBody());
        $this->assertStringContainsString('id="div_anexo"', (string)$response->getBody());
    }

    public function testCarregaEditarComissao()
    {
        $this->container = $this->app()->getContainer();
        $filesModel = new FilesModel($this->container);

        $data['uuid'] = '3cafd9a5-b265-46b8-8723-3c9959746ead';
        
        $response = $this->runApp('POST', '/carregaEditarComissao', $data);

        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->find(['uuid'=>"3cafd9a5-b265-46b8-8723-3c9959746ead"]);

        $rs['files'] = $filesModel->all(['relation_uuid'=>"3cafd9a5-b265-46b8-8723-3c9959746ead"]);

        $this->assertJsonStringEqualsJsonString(
            (string)$response->getBody(),
            json_encode($rs)
        );
    }

    public function testPostEditarComissao()
    {
        $data['commission_uuid'] = '3cafd9a5-b265-46b8-8723-3c9959746ead';
        $data['indication_uuid'] = '2d70a4fa-c939-46de-9791-1f899971022f';
        $data['value2'] = '100,00';
        $data['value'] = '10000';
        $data['date'] = '09/01/2020';
        $data['status'] = '1';
        $data['observation'] = 'Teste Comissao';
        $data['update'] = '1';
        $data['anexo'] = '';
        
        $response = $this->runApp('POST', '/editaComissao', $data);

        $response = $this->runApp('GET', '/editaComissao');

        $this->assertStringContainsString('Alterado com sucesso', (string)$response->getBody());

        // $response = $this->runApp('GET', '/editaIndicacao');

        // $this->assertStringContainsString('Alterado com sucesso', (string)$response->getBody());
    }
}
