<?php

namespace Project\Models;

use Psr\Container\ContainerInterface;

abstract class Model
{
    protected $container;
    protected $conn;
    protected $logger;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->conn = $this->container->get('conn');
        $this->logger = $this->container->get('logger');
    }

    public function all()
    {
        var_dump($this->conn);
    }

    public function find()
    {
        var_dump($this->conn);

        $this->assertCount(0, var_dump($this->conn));
    }

    public function delete()
    {
        var_dump($this->conn);
    }

    public function set()
    {
        var_dump($this->conn);
    }
}