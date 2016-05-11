<?php

class Db
{
    private $instance;
    public function __construct()
    {
        try {
            $this->instance = new PDO(PDO_DSN, DB_LOGIN, DB_PASSWORD);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
    
    public function getInstance(){
        return $this->instance;
    }
    
    public function __destruct()
    {
        $this->instance = null;
    }


}