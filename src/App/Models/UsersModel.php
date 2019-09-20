<?php

namespace Project\Models;

use Psr\Container\ContainerInterface;

class UsersModel extends Model
{
    protected $container;
    protected $conn;
    protected $logger;
    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        //var_dump($container->get('conn'));die;
        $this->container = $container;
        $this->conn = $this->container->get('conn');
        $this->logger = $this->container->get('logger');
    }



    public function deleteUsers(array $dados) {
        try{
            if(count($dados)==0)
                return false;
            foreach ($dados as $key => $row) {
                $table = "{$key} = :{$key}";
            }
            $sql = "DELETE FROM users WHERE ". $table;
            $stmt = $this->conn->prepare($sql);
            foreach ($dados as $key => $row) {
                $stmt->bindValue(":{$key}", $row, \PDO::PARAM_INT);
            }
                
            $stmt->execute();


            if($stmt->rowCount()>0)     return true; 
            else                        return false;
            
        }catch(\PDOException $e){
            $this->logger->error('ExtensionsModel::get() => '.$e);
            return $e;
        }
    }

    public function findAll(array $dados){
        
    }

}