<?php

namespace Project\Models;

//use Project\Models\UsersModel;
use \Psr\Container\ContainerInterface;

class CommissionsModel extends Model
{
    protected $container;
    protected $conn;

    protected $table = 'commissions';

    public function __construct(ContainerInterface $container) 
    {
        $this->container = $container;
        $this->conn = $this->container->get('conn');
    }

}