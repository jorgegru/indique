<?php

namespace Project\Models;

//use Project\Models\UsersModel;
use \Psr\Container\ContainerInterface;

class CompaniesModel extends Model
{
    protected $container;
    protected $conn;

    protected $table = 'companies';

    public function __construct(ContainerInterface $container) 
    {
        $this->container = $container;
        $this->conn = $this->container->get('conn');
    }

    public function validateCompanie(array $dados)
    {
        try{
            if(count($dados)==0)
                return false;
            $field = false;        
            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                
                if($key!='uuid' && $key!='id') 
                    $sqlArray[] = "{$key} = :{$key_name}";
                else{
                    $sqlArray2[] = "{$key} != :{$key_name}";
                    $field = true;
                }
            }
            
            if($field){
                $sql = "SELECT * FROM {$this->table}
                WHERE (". implode(' OR ', $sqlArray) .") && ". implode(' && ', $sqlArray2);
            }else{
                $sql = "SELECT * FROM {$this->table}
                WHERE ". implode(' OR ', $sqlArray);
            }
            
            $stmt = $this->conn->prepare($sql);

            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $stmt->bindValue(":{$key_name}", $row, \PDO::PARAM_STR);
            }
                
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            throw $e;
        }
    }

}