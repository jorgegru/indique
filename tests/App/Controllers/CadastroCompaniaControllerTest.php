<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class CadastroCompaniaControllerTest extends BaseTestCase 
{
    use ModelTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    protected $container;
    protected $conn;
    protected $logger;
    
    public function testGetCadastroCompania()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        $_SESSION['user']['user_type'] = "1";
        $_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";

        $response = $this->runApp('GET', '/cadastroCompania');
       
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertStringContainsString('name="name"', (string)$response->getBody());
        $this->assertStringContainsString('name="cnpj"', (string)$response->getBody());
    }

    public function testPostCadastroCompania()
    {
        $data['name'] = 'Teste1';
        $data['cnpj'] = '11111111111111';
        
        $response = $this->runApp('POST', '/cadastroCompania', $data);

        $response = $this->runApp('GET', '/cadastroCompania');

        $this->assertStringContainsString('Cadastrado com sucesso', (string)$response->getBody());


        // deletar teste
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->delete(['name'=>'Teste1', 'cnpj'=>'11111111111111']);
    }
}
