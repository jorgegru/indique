<?php

namespace Tests\App\Controllers;

use \Project\Models\UsersModel;
use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class ExcluirUsuarioControllerTests extends BaseTestCase 
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

    public function testExcluirUsuario()
    {
        $_SESSION['user']['id'] = "3c85ebd2-0d01-4910-a34c-2b0e64ab2789";
        $_SESSION['user']['name'] = "teste123";
        $_SESSION['user']['email'] = "anlumira@gmail.com";
        //$_SESSION['user']['company_id'] = "4191e2b5-21be-4afd-95b9-2e364b869bfd";
        $_SESSION['user']['user_type'] = 1;

        $this->container = $this->app()->getContainer();
        $this->usersModel = new UsersModel($this->container);

        $id = uuid();

        $dados = [
            'uuid'=>$id, 
            'user_type'=>'4',
            'name' => 'user Test', 
            'email' => 'teste@gmail.com',
            'password' => '123123',
            'email'=>'testedel@del.com.br', 
            'cpf' => '11111111111',
            'status' => '1',
            'create_time' => '2019-10-24 13:18:47',
        ];

        $rs = $this->usersModel->set($dados);
        $this->assertEquals("boolean", gettype($rs));
        

        $response = $this->runApp('POST', '/excluiUsuario', $dados); 


        $this->assertStringContainsString('true', (string)$response->getBody());
    }
}
