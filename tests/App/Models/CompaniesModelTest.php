<?php

namespace Tests\Models;

use \Project\Models\CompaniesModel;
use Tests\Functional\BaseTestCase;

class CompaniesModelTest extends BaseTestCase
{
    protected $container;
    protected $CompaniesModel;

    public function testInsert()
    {
        $this->container = $this->app()->getContainer();
        $this->CompaniesModel = new CompaniesModel($this->container);

        $id = uuid();
        $rs = $this->CompaniesModel->set(['uuid'=>$id, 'name'=>'teste', 'cnpj'=>'02040506070000']);
        $this->assertEquals("boolean", gettype($rs));

        $dados['uuid'] = $id;
        $dados['name'] = 'teste';
        return $dados;
    }   


    /**
     * @depends testInsert
     */
    public function testFind(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->CompaniesModel = new CompaniesModel($this->container);

        $rs = $this->CompaniesModel->find(['uuid'=>$dados['uuid']]);

        $this->assertEquals("array", gettype($rs));
    }

    /**
     * @depends testInsert
     */
    public function testAll(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->CompaniesModel = new CompaniesModel($this->container);

        $rs = $this->CompaniesModel->all(['uuid'=>$dados['uuid']]);

        $this->assertEquals("array", gettype($rs));
    }


    /**
     * @depends testInsert
     */
    public function testUpdate(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->CompaniesModel = new CompaniesModel($this->container);

        $rs = $this->CompaniesModel->update(['name'=>'Alterando Empresa', 'uuid'=>$dados['uuid']]);

        $this->assertEquals("boolean", gettype($rs));
    }


    /**
     * @depends testInsert
     */
    public function testDelete(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->CompaniesModel = new CompaniesModel($this->container);
        
        $rs = $this->CompaniesModel->delete(['uuid'=>$dados['uuid']]);

        $this->assertEquals("boolean", gettype($rs));
    }

}