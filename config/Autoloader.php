<?php

Class Autoloader
{
    private $startDirectory = MODELS;
    private $fileIterator = null;

    public function __construct()
    {
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader()
    {
        $directory = new RecursiveDirectoryIterator($this->startDirectory);
        $this->fileIterator = new RecursiveIteratorIterator($directory);
        foreach ($this->fileIterator as $it) {
            if (!(substr($it, -2) == '/.' || substr($it, -2) == '..') && file_exists($it)) {
                include_once($it);
            }

        }
    }
}