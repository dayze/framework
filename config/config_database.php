<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

function GetEntityManager(){
    $paths = array(ENTITY_PATH);
    $isDevMode = false;

// the connection configuration
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => 'dsi',
        'dbname'   => 'framework',
    );

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    return EntityManager::create($dbParams, $config);
}
