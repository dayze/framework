<?php
require("Twig.php");

class Generation
{
    private $className;
    private $properties = array();
    private $stopScript = false;
    private $twig;

    public function __construct($withEntity = null)
    {
        if (!is_null($withEntity))
            $this->launchScriptWithEntity($withEntity);
        else
            $this->launchScriptWithoutEntity();
    }

    private function launchScriptWithoutEntity()
    {
        $twig = new Twig(AUTO_CRUD_TEMPLATE_PATH);
        $this->twig = $twig->getTwig();
        echo "Name of the class : \n";
        $handle = fopen("php://stdin", "r");
        $classNameTemp = fgets($handle);
        $this->className = trim($classNameTemp);
        fclose($handle);
        while (!$this->stopScript) {
            echo "Name of attr (:q to quit) : \n";
            $attr = fopen("php://stdin", "r");
            $content = fgets($attr);
            if (trim($content) == ":q") {
                $this->stopScript = true;
            } else {
                $this->properties[] = trim($content);
            }
            fclose($attr);
        }
        $this->createServiceClass();
        $this->createRepositoryClass();
    }

    private function launchScriptWithEntity($withEntity)
    {
        
    }

    private function createServiceClass()
    {
        $name = trim($this->className . "Service.php");
        $name = $name = preg_replace("/[\n\r]/", "", $name);
        $template = $this->twig->render('serviceClass.twig', array("class" => $this->className, "properties" => $this->properties));
        file_put_contents(SERVICE_PATH . $name, $template);
    }

    private function createRepositoryClass()
    {
        $name = trim($this->className . "Repository.php");
        $name = preg_replace("/[\n\r]/", "", $name);
        $template = $this->twig->render('repositoryClass.twig', array("class" => $this->className, "properties" => $this->properties));
        file_put_contents(REPOSITORY_PATH . $name, $template);

    }

}