<?php

/**
 * Created by PhpStorm.
 * User: Dez
 * Date: 10/03/2016
 * Time: 07:43
 */
//Cette classe permet de loader toutes nos classes quand on en a besoin, ça permet d'éviter les includes des classes
class Autoloader{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
        require MODELS . $class . '.php';
    }

}