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

        $rs= $this->find(['name'=>'jorge', 'user_uuid'=>'dsdsdsds']);

        //var_dump($rs);
        $this->assertTrue(true);    }
}