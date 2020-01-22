<?php namespace Tests\App\Controllers; 
    use \Project\Traits\ModelTrait; 
    use \Project\Models\CommissionsModel;
    use Tests\Functional\BaseTestCase; 

    class CadastroContratoControllerTest extends BaseTestCase 
    { 
        use ModelTrait; 
        /*
        * 
        * The table associated with the model. 
        * 
        * @var string 
        */ 
        protected $table = 'contracts'; 
        protected $container; 
        protected $conn; 
        protected $logger; 
        public function testGetCadastroContrato() { 
            $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789"; 
            //0f081502-43c1-4dde-8f37-ac50f7a69c6f 
            $_SESSION['user']['name'] = "teste123"; 
            $_SESSION['user']['email'] = "anlumira@gmail.com"; 
            $_SESSION['user']['user_type'] = 1; 
            $response = $this->runApp('GET', '/cadastroContrato/dfdd90aa-5959-43b0-9c66-d9aa58bb306d'); 
            //var_dump( $response );die; 
            $this->assertEquals(200, $response->getStatusCode()); 
            $this->assertStringContainsString('name="corporate"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="value_contract2"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="date"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="observation"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="indentification"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="commission"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="start_data_m"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="start_data_y"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="end_data_m"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="end_data_y"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="day"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="value_commission2"', (string)$response->getBody()); 
            // $this->assertStringContainsString('name="company_uuid"', (string)$response->getBody()); 
            $this->assertStringContainsString('name="anexo[]"', (string)$response->getBody()); 
        
            
        } 
        public function testPostCadastroContrato() { 
            $data['corporate'] = 'Teste Contrato'; 
            $data['value_contract'] = '10000'; 
            $data['date'] = '2020-01-08'; 
            $data['user_uuid'] = $_SESSION['user']['id']; 
            $data['observation'] = 'teste'; 
            $data['indentification'] = '123456'; 
            $data['indication_uuid'] = "dfdd90aa-5959-43b0-9c66-d9aa58bb306d"; 
            $data['value_commission'] = '10000'; 
            $data['start_date'] = '2020-01-01'; 
            $data['end_date'] = '2020-01-01'; 
            $data['day'] = '01'; 
            $data['commission'] = '1'; 
            $data['service_uuid'] = 'ccf87abc-e91f-11e9-81b4-2a2ae2dbcce4'; 
            $data['observation_commissions'] = "";
            //$data['company_uuid'] = '878b5a1b-de92-11e9-be79-cdc05b889658'; 
            $data['status'] = '1';
            $response = $this->runApp('POST', '/cadastrarContrato', $data); 
            
            $location = $response->getHeader("location");
            $this->assertStringContainsString('/index/success', current($location));
            
            //$response = $this->runApp('GET', '/cadastroContrato/dfdd90aa-5959-43b0-9c66-d9aa58bb306d'); 
            //$this->assertStringContainsString('Cadastrado com sucesso', (string)$response->getBody()); 
            
            // deletar teste 
            $this->container = $this->app()->getContainer(); 
            $this->conn = $this->container->get('conn'); 
            $rs = $this->delete(['corporate_name'=>'Teste Contrato', 'indication_uuid'=>'dfdd90aa-5959-43b0-9c66-d9aa58bb306d']); 
            
            $this->container = $this->app()->getContainer();
            $this->commissionsModel = new CommissionsModel($this->container);
            $rs = $this->commissionsModel->delete(['indication_uuid'=>'dfdd90aa-5959-43b0-9c66-d9aa58bb306d']);
            //$location = $response->getHeader("location"); 
            // $this->assertStringContainsString('dashboard', current($location)); 
        } 
    }