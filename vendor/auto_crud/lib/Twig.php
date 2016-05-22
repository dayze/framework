<?php
require ('vendor/autoload.php');
class Twig
{
    private $twig;
    public function __construct($directory)
    {
        $loader = new Twig_Loader_Filesystem($directory); // Dossier contenant les templates
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false,
            'debug' => true
        ));
        $this->twig->addExtension(new Twig_Extension_Debug());
    }

    public function getTwig()
    {
        return $this->twig;
    }
}