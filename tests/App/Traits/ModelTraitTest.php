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
    protected $table = 'users';

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

        

    public function testFind()
    {
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->find(['name'=>'jorgehjkhjkjh', 'uuid'=>'56572bdc-dfdfgdfbd7-11e9-be79-cdc05b889658']);

        $this->assertEquals("boolean", gettype($rs));
    }

    public function testAll()
    {
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->all(['name'=>'jorgehjkhjkjh', 'uuid'=>'56572bdc-dfdfgdfbd7-11e9-be79-cdc05b889658']);

        $this->assertCount(0, $rs);
        $this->assertEquals("array", gettype($rs));
    }



    public function testUpdate()
    {
        $this->container = $this->app()->getContainer();
        $this->conn = $this->container->get('conn');

        $rs = $this->update(['name'=>'Jorge Goulart', 'uuid'=>'56572bdc-dfdfgdfbd7-11e9-be79-cdc05b889658']);

        $this->assertEquals("boolean", gettype($rs));
    }
}