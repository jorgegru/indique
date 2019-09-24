<?php

namespace Project\Traits;

trait ModelTrait {

    public function all(array $dados)
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

    public function delete(array $dados)
    {
        try{
            if(count($dados)==0)
                return false;
            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $sqlArray[] = "{$key} = :{$key_name}";
            }
            $sql = "DELETE FROM {$this->table} 
            WHERE ". implode(' AND ', $sqlArray);

            $stmt = $this->conn->prepare($sql);

            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $stmt->bindValue(":{$key_name}", $row, \PDO::PARAM_STR);
            }
                
            $stmt->execute();

            if($stmt->rowCount()>0)     return true;
            else                        return false;
            
        }catch(\PDOException $e){
            $this->logger->error('ExtensionsModel::get() => '.$e);
            return $e;
        }
    }

    public function set($dados)
    {
        try {
            if(count($dados)==0)
                return false;
            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $sqlField[] = "{$key}";
                $sqlArray[] = ":{$key_name}";
            }
            $sql = "INSERT INTO {$this->table} (".implode(' , ', $sqlField).") 
            VALUES (".implode(' , ', $sqlArray).");";
            $stmt =  $this->conn->prepare($sql);
            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $stmt->bindValue(":{$key_name}", $row, \PDO::PARAM_STR);
            }
            $stmt->execute();
            if($stmt->rowCount())
                return  true;
            return false;
            
        } catch (\PDOException  $e) {
            throw $e;
        }
    }
    public function update($dados)
    {
        try {
            if(count($dados)==0)
                return false;

            $field = '';
            foreach ($dados as $key => $row) {

                $key_name = explode('.',$key);
                $key_name = end($key_name);
                
                if($key!='uuid' && $key!='id') 
                    $sqlArray[] = "{$key} = :{$key_name}";
                else 
                    $field = "{$key} = :{$key_name}";
            }

            if($field == '')
                throw new \PDOException("Error Processing field", 1);
                
            $sql = "UPDATE {$this->table} SET 
                ".implode(' , ', $sqlArray)."
                WHERE  {$field};";

            $stmt =  $this->conn->prepare($sql);
            foreach ($dados as $key => $row) {
                $key_name = explode('.',$key);
                $key_name = end($key_name);
                $stmt->bindValue(":{$key_name}", $row, \PDO::PARAM_STR);
            }
            
            $stmt->execute();

            if($stmt->rowCount())
                return  true;
            return false;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

}