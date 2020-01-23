<?php

namespace Tests\App\Controllers;

use \Project\Models\IndicationsModel;
use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class ExcluirIndicacaoControllerTests extends BaseTestCase 
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

    public function testExcluirIndicacao()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
        $_SESSION['user']['user_type'] = 1;


        $this->container = $this->app()->getContainer();
        $this->indicationsModel = new IndicationsModel($this->container);

        $id = uuid();

        $dados = [
            'uuid'=>$id, 
            'name'=>'teste del',
            'cpf_cnpj' => '11111111111', 
            'telefone' => '123456789',
            'name_responsavel' => 'teste',
            'email'=>'testedel@del.com.br', 
            'cep' => '04184000',
            'estado' => 'SP',
            'cidade' => 'São Paulo',
            'bairro' => 'Jardim Santa Emilia',
            'rua' => 'Rua Professor',
            'numero' => '621',
            'complemento' => 'ap 1',
            'service_uuid' => 'ccf87abc-e91f-11e9-81b4-2a2ae2dbcce4',
            'status' => '1',
            'commission' => '1',
            'start_date' => '2019-10-02',
            'end_date' => '2019-10-02',
            'value_commission' => '10000',
            'user_uuid' => '130c01d9-5c12-42c4-8ad0-5b6350cad1a9',
            'creator_uuid' => '130c01d9-5c12-42c4-8ad0-5b6350cad1a9',
        ];

        $rs = $this->indicationsModel->set($dados);
        $this->assertEquals("boolean", gettype($rs));
        
        $response = $this->runApp('POST', '/excluiIndicacao',$dados);

        $this->assertStringContainsString('true', (string)$response->getBody());
    }
}
