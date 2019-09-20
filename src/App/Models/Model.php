<?php

namespace Project\Models;

use \Project\Traits\ModelTrait;
use Psr\Container\ContainerInterface;

abstract class Model
{
    use ModelTrait;

    protected $container;
    protected $conn;
    protected $logger;

    public function __construct(ContainerInterface $container) 
    {
        $this->container = $container;
        $this->conn = $this->container->get('conn');
        $this->logger = $this->container->get('logger');
    }

    
}