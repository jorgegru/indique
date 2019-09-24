<?php

namespace Tests\App\Traits;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class ModelTraitTest extends BaseTestCase 
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



    // public function testAll()
    // {


    //     //$this->find();
    //     //$Model = new Model($conteiner);
    //     // $this->assertTrue(true);
    //     //var_dump($Model);
    // }

    public function testInsert()
    {
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');
        
        $id = uuid();
        $rs = $this->set(['uuid'=>$id, 'name'=>'teste', 'cnpj'=>'00.000.000/0000-00']);

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
        $this->conn = $this->container->get('conn');

        $rs = $this->find(['name'=>$dados['name'], 'uuid'=>$dados['uuid']]);

        $this->assertEquals("array", gettype($rs));//("boolean", gettype($rs));
    }

    /**
     * @depends testInsert
     */
    public function testAll(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->all(['name'=>$dados['name'], 'uuid'=>$dados['uuid']]);

        //$this->assertCount(0, $rs);
        $this->assertEquals("array", gettype($rs));
    }


    /**
     * @depends testInsert
     */
    public function testUpdate(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->update(['name'=>$dados['name'], 'uuid'=>$dados['uuid']]);

        $this->assertEquals("boolean", gettype($rs));
    }


    /**
     * @depends testInsert
     */
    public function testDelete(array $dados)
    {
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->delete(['name'=>$dados['name'], 'uuid'=>$dados['uuid']]);

        $this->assertEquals("boolean", gettype($rs));
    }
}