<?php

class User
{
    public $id;
    public $login;
    public $password;
    public $name;
    public $lastName;
    
    public function createUser($login, $password, $lastName, $name){
        try{
            return User_DAO::saveUser($login, $password, $lastName, $name, $type,$id_team);
        }
        catch(Exception $e){
            throw new Exception($e);
        }
    }

    public function connection($login, $password)
    {
        try{
           return User_DAO::read($login, $password);
        }
        catch(Exception $e){
            throw new Exception($e);
        }
    }

    public function getAlluser()
    {
        try {
            return User_DAO::readAll();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function readUserByTeam($idTeam){
        try {
            return User_DAO::loadUserByTeam($idTeam);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function readTasksFromUser($id_proj){ //n
        try {
            $this->tasks =  Task_DAO::loadTaskFromUser($this->id, $id_proj);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }


}