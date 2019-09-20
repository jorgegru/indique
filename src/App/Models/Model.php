<?php

namespace Project\Models;

class Model
{
    protected $container;
    protected $conn;
    protected $logger;

    public function __construct($container) {

        var_dump($container->get('conn'));die;
        $this->container = $container;


        // $this->conn = $this->container->get('conn');
        // $this->logger = $this->container->get('logger');
    }

    // public function all()
    // {
    //     var_dump($this->conn);
    // }
}