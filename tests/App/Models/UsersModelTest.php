<?php

namespace Tests\App\Models;

use Tests\Functional\BaseTestCase;

class UsersModelTest extends BaseTestCase
{
    /**
     * Test deletando usuario
     */
    public function testDeleteUser(){

        $conteiner = $this->app()->getContainer();
        
        $Model = new \Project\Models\UsersModel($conteiner);

        $dados["user_uuid"] = 1;
        $this->assertTrue($Model->deleteUsers($dados));
        $dados["user_uuid"] = 2;
        $this->assertFalse($Model->deleteUsers($dados));
    }

    public function testFindAllUser(){

        $conteiner = $this->app()->getContainer();
        
        $Model = new \Project\Models\UsersModel($conteiner);

        $tabela = "users";
        $this->assertIsArray($Model->findAllUsers($tabela));
        
    }
}