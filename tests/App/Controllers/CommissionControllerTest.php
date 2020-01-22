<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class CommissionControllerTest extends BaseTestCase 
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

    public function testGetCommissionsIndication()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
        $_SESSION['user']['user_type'] = 1;
        
        $response = $this->runApp('GET', '/getCommissionsIndication/2d70a4fa-c939-46de-9791-1f899971022f');
       
        $dados[0]["uuid"] = "3cafd9a5-b265-46b8-8723-3c9959746ead";
        $dados[0]["paid"] = "1";
        $dados[0]["value_commission"] = "10000";
        $dados[0]["date"] = "2020-01-09";
        $dados[0]["observation"] = "Teste Comissao";
        $dados[0]["indication_uuid"] = "2d70a4fa-c939-46de-9791-1f899971022f";
 
        $this->assertJsonStringEqualsJsonString(
            (string)$response->getBody(),
            json_encode($dados)
        );
    }

    public function testPayCommission()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
        $_SESSION['user']['user_type'] = 1;
        
        $response = $this->runApp('GET', '/payCommission/3cafd9a5-b265-46b8-8723-3c9959746ead');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('true', (string)$response->getBody());
    }

    public function testUnpaidCommission()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
        $_SESSION['user']['user_type'] = 1;
        
        $response = $this->runApp('GET', '/unpaidCommission/3cafd9a5-b265-46b8-8723-3c9959746ead');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('true', (string)$response->getBody());
    }
}
