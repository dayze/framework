<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

function getEntityManager(){
    $paths = array(ENTITY_PATH);
    $isDevMode = false;
    
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => 'dsi',
        'dbname'   => 'framework',
    );

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    return EntityManager::create($dbParams, $config);
}
