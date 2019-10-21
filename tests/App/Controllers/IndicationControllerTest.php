<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class IndicationControllerTest extends BaseTestCase 
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

    public function testGetListaIndication()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/listaIndicacoes');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="indication"', (string)$response->getBody());
        $this->assertStringContainsString('name="busca"', (string)$response->getBody());
        $this->assertStringContainsString('name="email"', (string)$response->getBody());
        $this->assertStringContainsString('name="cpf_cnpj"', (string)$response->getBody());
        $this->assertStringContainsString('name="telefone"', (string)$response->getBody());
        $this->assertStringContainsString('name="nome_responsavel"', (string)$response->getBody());
        $this->assertStringContainsString('name="status"', (string)$response->getBody());
        $this->assertStringContainsString('id="tbIndicacaoBody"', (string)$response->getBody());
    }

    public function testFiltroListaIndicacao()
    {
        $data['nome'] = 'email';
        $data['valor'] = 'anlumira@gmail.com';

        //filtroUserLista
        $response = $this->runApp('POST', '/filtroIndicacaoLista', $data);

        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $data2['email'] = 'anlumira@gmail.com';

        $rs = $this->allLike($data2);
        
        $this->assertJsonStringEqualsJsonString(
            (string)$response->getBody(),
            json_encode($rs)
        );
    }

    public function testGetEditaUserLista()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
				$_SESSION['user']['name'] = "teste123";
				$_SESSION['user']['email'] = "anlumira@gmail.com";
                //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
                $_SESSION['user']['user_type'] = 1;

        $response = $this->runApp('GET', '/editaIndicacao/6d9a13fb-a3fe-4bf5-9a53-06cdad5a33bc');
        //var_dump( $response );//die;
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="indication_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="cpf_cnpj"', (string)$response->getBody());
        $this->assertStringContainsString('name="telefone"', (string)$response->getBody());
        $this->assertStringContainsString('name="name_responsavel"', (string)$response->getBody());
        $this->assertStringContainsString('name="cep"', (string)$response->getBody());
        $this->assertStringContainsString('name="estado"', (string)$response->getBody());
        $this->assertStringContainsString('name="cidade"', (string)$response->getBody());
        $this->assertStringContainsString('name="bairro"', (string)$response->getBody());
        $this->assertStringContainsString('name="rua"', (string)$response->getBody());
        $this->assertStringContainsString('name="numero"', (string)$response->getBody());
        $this->assertStringContainsString('name="complemento"', (string)$response->getBody());
        $this->assertStringContainsString('name="service_uuid"', (string)$response->getBody());
        $this->assertStringContainsString('name="status"', (string)$response->getBody());
        $this->assertStringContainsString('name="commission"', (string)$response->getBody());
        $this->assertStringContainsString('name="user_uuid"', (string)$response->getBody());

    }
}
