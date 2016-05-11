<?php

/**
 * Created by PhpStorm.
 * User: Dez
 * Date: 10/03/2016
 * Time: 07:34
 */
class User_DAO
{
    public static function saveUser($login, $password, $lastName, $name, $type,$id_team){
        try {
            $db = Connection::getInstance();
            $sth = $db->prepare('INSERT INTO user (login, password, name, lastName, role, id_team) VALUES (?, ?, ?, ?, ?, ?)');
            $sth->execute(array($login, $password, $name, $lastName, $type, $id_team));
            return true;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public static function readAll()
    {
        $varArray = array();
        $db = Connection::getInstance();
        $sth = $db->query("SELECT * from user");
        while($r = $sth->fetch()){
            $o = new User();
            $o->id = $r['id'];
            $o->login = $r['login'];
            $o->password = $r['password'];
            $o->name = $r['name'];
            $o->lastName = $r['lastName'];
            $o->role = $r['role'];
            $varArray[] = $r;
        }
        return $varArray;
    }

    public static function read($login, $password)
    {
        $varArray = array();
        $db = Connection::getInstance();
        $sth = $db->prepare('SELECT user.id, user.login, user.password, user.name,
                             user.lastName, user.role, user.id_team, team.name as team_name FROM user INNER JOIN team on
                             user.id_team = team.id WHERE login = ? and password = ?');
        $sth->execute(array($login, $password));
        if (!is_null($sth)) {
            while($r = $sth->fetch()){
                $o = new User();
                $o->id = $r['id'];
                $o->login = $r['login'];
                $o->password = $r['password'];
                $o->name = $r['name'];
                $o->lastName = $r['lastName'];
                $o->role = $r['role'];
                $o->idTeam = $r['id_team'];
                $o->nameTeam = $r['team_name'];
                $varArray[] = $o;
            }
        }
        else{
            $varArray = false;
        }
        return $varArray;
    }

    public static function getUserByID($id)
    {
        $varArray = array();
        $db = Connection::getInstance();
        $sth = $db->prepare('SELECT * FROM USER WHERE id = ?');
        $sth->execute(array($id));
        if (!is_null($sth))
        {
            while($r = $sth->fetch())
            {
                $o = new User();
                $o->id = $r['id'];
                $o->login = $r['login'];
                $o->password = $r['password'];
                $o->name = $r['name'];
                $o->lastName = $r['lastName'];
                $o->role = $r['role'];
                $varArray[] = $r;
            }
        }
        else
        {
            $varArray = false;
        }
        return $varArray;
    }

    public static function loadUserByTeam($idTeam){
        $varArray = array();
        $db = Connection::getInstance();
        $sth = $db->prepare('SELECT * FROM user WHERE id_team = ?');
        $sth->execute(array($idTeam));
        if (!is_null($sth)) {
            while($r = $sth->fetch()){
                $o = new User();
                $o->id = $r['id'];
                $o->login = $r['login'];
                $o->name = $r['name'];
                $o->lastName = $r['lastName'];
                $o->role = $r['role'];
                $o->idTeam = $r['id_team'];
                $varArray[] = $o;
            }
        }
        else{
            $varArray = false;
        }
        return $varArray;
    }

    public static function loadUsersByProject($idProject){
        $varArray = array();
        $db = Connection::getInstance();
        $sth = $db->prepare('select distinct user.id, user.login, user.name, user.lastName,
                             user.role, user.id_team from user inner join task_affectation
                             on task_affectation.id_user = user.id inner join task on
                             task.id = task_affectation.id_task where task.id_proj = ?');
        $sth->execute(array($idProject));
        if (!is_null($sth)) {
            while($r = $sth->fetch()){
                $o = new User();
                $o->id = $r['id'];
                $o->login = $r['login'];
                $o->name = $r['name'];
                $o->lastName = $r['lastName'];
                $o->role = $r['role'];
                $o->idTeam = $r['id_team'];
                $o->readTasksFromUser($idProject);
                $varArray[] = $o;
            }
        }
        else{
            $varArray = false;
        }
        return $varArray;
    }
}