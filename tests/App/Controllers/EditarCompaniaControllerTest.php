<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class EditarCompaniaControllerTests extends BaseTestCase 
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

    public function testGetEditarCompania()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                $_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/editaCompania');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="company_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="cnpj"', (string)$response->getBody());
    }

    public function testCarregaEditarCompania()
    {
        $data['uuid'] = '878b5a1b-de92-11e9-be79-cdc05b889658';
        
        $response = $this->runApp('POST', '/carregaEditarCompania', $data);

        $data = array(
            'uuid' => '878b5a1b-de92-11e9-be79-cdc05b889658',
            'name' => 'JGSITE SOLUCOES WEB',
            'cnpj' => '19959019000198', 
            'create_time' => '2019-10-09 08:17:50'
        );

        //var_dump((string)$response->getBody());

        //$newResponse = $response->withJson($data);

        $this->assertJsonStringEqualsJsonString(
           // json_encode($data)

            (string)$response->getBody(),
            json_encode($data)
        );
    }

    public function testPostEditarCompania()
    {
        $data['company_uuid'] = 'edfa7b0d-7934-4541-904b-a245d62ee677';
        $data['name'] = 'Viagens';
        $data['cnpj'] = '61392065000114';
        
        $response = $this->runApp('POST', '/editaCompania', $data);

        $response = $this->runApp('GET', '/editaCompania');

        $this->assertStringContainsString('Alterado com sucesso', (string)$response->getBody());
    }
}
