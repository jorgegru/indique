<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class CadastroIndicacaoControllerTest extends BaseTestCase 
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

    public function testGetCadastroIndicacao()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/cadastroIndicacao');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());

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
        $this->assertStringContainsString('name="commission"', (string)$response->getBody());
        $this->assertStringContainsString('name="user_uuid"', (string)$response->getBody());
    }

    public function testPostCadastroIndicacao()
    {

        $data['name'] = 'Teste Indicacao';
        $data['cpf_cnpj'] = '53695064000110';
        $data['telefone'] = '11999999999';
        $data['name_responsavel'] = 'Teste Indicacao';
        $data['email'] = 'teste@indicacao.com';
        $data['cep'] = '04184000';
        $data['estado'] = 'SP';
        $data['cidade'] = 'São Paulo';
        $data['bairro'] = 'Jardim Santa Emilia';
        $data['rua'] = 'Rua Professor';
        $data['numero'] = '657';
        $data['complemento'] = 'ap 2';
        $data['service_uuid'] = 'ccf87abc-e91f-11e9-81b4-2a2ae2dbcce4';
        //$data['company_uuid'] = '878b5a1b-de92-11e9-be79-cdc05b889658';
        $data['status'] = '1';
        $data['commission'] = '1';
        $data['start_date'] = '2019-10-02';
        $data['end_date'] = '2019-10-02';
        $data['value_commission'] = '10000';
        $data['user_uuid'] = '130c01d9-5c12-42c4-8ad0-5b6350cad1a9';
        
        $response = $this->runApp('POST', '/cadastroIndicacao', $data);

        $response = $this->runApp('GET', '/cadastroIndicacao');

        $this->assertStringContainsString('Cadastrado com sucesso', (string)$response->getBody());

        // deletar teste
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->delete(['name'=>'Teste Indicacao', 'cpf_cnpj'=>'53695064000110']);

        //$location = $response->getHeader("location");
       // $this->assertStringContainsString('dashboard', current($location));
    }

    public function testGetCEP()
    {
        $data['id'] = "04184000";

        $response = $this->runApp('POST', '/apiViaCEP', $data);
        //var_dump( $response );die;
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertStringContainsString('cep', (string)$response->getBody());
        $this->assertStringContainsString('logradouro', (string)$response->getBody());
        $this->assertStringContainsString('complemento', (string)$response->getBody());
        $this->assertStringContainsString('bairro', (string)$response->getBody());
        $this->assertStringContainsString('localidade', (string)$response->getBody());
        $this->assertStringContainsString('uf', (string)$response->getBody());

    }
}
