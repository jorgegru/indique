<?php

namespace Project\Models;

class Model
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
}