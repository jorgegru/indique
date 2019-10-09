<?php

namespace Tests\Models;

use \Project\Models\UsersModel;
use Tests\Functional\BaseTestCase;

class UsersModelTest extends BaseTestCase
{
    protected $container;
    protected $UsersModel;

    public function testInsert()
    {
        $this->container = $this->app()->getContainer();
        $this->UsersModel = new UsersModel($this->container);

        $id = uuid();

        $dados = [
            'uuid'=>$id, 
            'name'=>'Jorginho Jesus', 
            'email'=>'jj@jgsite.com.br', 
            'password'=>'joyKd@8dH4a',
            'cpf'=>'36218640834',
            'company_uuid'=>'878b5a1b-de92-11e9-be79-cdc05b889658',
            'user_type'=>'4',
            'status'=>'2',
        ];

        $rs = $this->UsersModel->set($dados);
        $this->assertEquals("boolean", gettype($rs));

        return $dados;
    }   


    /**
     * @depends testInsert
     */
    public function testFind(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->UsersModel = new UsersModel($this->container);

        $rs = $this->UsersModel->find(['uuid'=>$dados['uuid']]);

        $this->assertEquals("array", gettype($rs));
    }

    /**
     * @depends testInsert
     */
    public function testAll(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->UsersModel = new UsersModel($this->container);

        $rs = $this->UsersModel->all(['uuid'=>$dados['uuid']]);

        $this->assertEquals("array", gettype($rs));
    }


    /**
     * @depends testInsert
     */
    public function testUpdate(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->UsersModel = new UsersModel($this->container);

        $rs = $this->UsersModel->update(['name'=>'Alterando Nome User', 'uuid'=>$dados['uuid']]);

        $this->assertEquals("boolean", gettype($rs));
    }


    /**
     * @depends testInsert
     */
    public function testDelete(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->UsersModel = new UsersModel($this->container);
        
        $rs = $this->UsersModel->delete(['uuid'=>$dados['uuid']]);

        $this->assertEquals("boolean", gettype($rs));
    }

}