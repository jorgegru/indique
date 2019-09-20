<?php

namespace Project\Traits;

trait ModelTrait {

    public function all()
    {
        try{
            if(count($dados)==0)
                return false;
            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $sqlArray[] = "{$key} = :{$key_name}";
            }
            $sql = "SELECT * FROM {$this->table}
            WHERE ". implode(' AND ', $sqlArray);
            
            $stmt = $this->conn->prepare($sql);

            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $stmt->bindValue(":{$key_name}", $row, \PDO::PARAM_STR);
            }
                
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            throw $e;
        }
    }

    public function find(array $dados)
    {
        try{
            if(count($dados)==0)
                return false;
            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $sqlArray[] = "{$key} = :{$key_name}";
            }
            $sql = "SELECT * FROM {$this->table}
            WHERE ". implode(' AND ', $sqlArray);
            
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

    public function delete()
    {
        var_dump($this->conn);
    }

    public function set()
    {
        var_dump($this->conn);
    }

}