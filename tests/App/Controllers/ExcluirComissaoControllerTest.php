<?php

namespace Tests\App\Controllers;

use \Project\Models\CommissionsModel;
use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class ExcluirComissaoControllerTests extends BaseTestCase 
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

    public function testExcluirComissao()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
        $_SESSION['user']['user_type'] = 1;


        $this->container = $this->app()->getContainer();
        $this->commissionsModel = new CommissionsModel($this->container);

        $id = uuid();

        $dados = [
            'uuid'=>$id, 
            'paid'=>'1',
            'value_commission' => '10000', 
            'date' => '2020-04-01',
            'observation' => 'teste excluir',
            'indication_uuid'=>'2d70a4fa-c939-46de-9791-1f899971022f',
        ];

        $rs = $this->commissionsModel->set($dados);
        $this->assertEquals("boolean", gettype($rs));
        
        $response = $this->runApp('POST', '/excluiComissao',$dados);

        $this->assertStringContainsString('true', (string)$response->getBody());
    }
}
