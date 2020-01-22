<?php namespace Tests\App\Controllers; 
    use \Project\Traits\ModelTrait; 
    use \Project\Models\ContractsModel;
    use Project\Controllers\CadastroComissaoController;
    use Tests\Functional\BaseTestCase; 

    class CadastroCommissionsControllerTest extends BaseTestCase 
    { 
        use ModelTrait; 
        /*
        * 
        * The table associated with the model. 
        * 
        * @var string 
        */ 
        protected $table = 'commissions'; 
        protected $container; 
        protected $conn; 
        protected $logger; 
        protected $contractsModel;
        protected $commissionsModel; 

        public function testCadastroComissiao()
        {
            $this->container = $this->app()->getContainer();
            $cadastroComissaoController = new CadastroComissaoController($this->container);

            $dados['indication_uuid'] = "dfdd90aa-5959-43b0-9c66-d9aa58bb306d"; 
            $dados['value_commission'] = "10000"; 
            $dados['start_date'] = '2020-01-01'; 
            $dados['end_date'] = '2020-02-01'; 
            $dados['date'] = '2020-01-08'; 
            $dados['commission'] = "2"; 
            $dados['day'] = '01'; 
            $dados['observation_commissions'] = "teste unitario";

            

            $cadastroComissaoController->cadastroComissao($dados);

            $this->container = $this->app()->getContainer(); 
            $this->conn = $this->container->get('conn'); 
            $rs = $this->all(['indication_uuid'=>'dfdd90aa-5959-43b0-9c66-d9aa58bb306d','observation'=>'teste unitario']); 

            // var_dump($rs);die;

            $this->assertEquals("array", gettype($rs));
            $this->assertStringContainsString('"indication_uuid":"dfdd90aa-5959-43b0-9c66-d9aa58bb306d"', json_encode($rs));
            $this->assertStringContainsString('"value_commission":"10000"', json_encode($rs));
            $this->assertStringContainsString('"date":"2020-01-01"', json_encode($rs));
            $this->assertStringContainsString('"observation":"teste unitario"', json_encode($rs));
            //$this->assertStringContainsString('name="name"', json_encode($rs));

            $rs = $this->delete(['indication_uuid'=>'dfdd90aa-5959-43b0-9c66-d9aa58bb306d','observation'=>'teste unitario']);
        }
    }