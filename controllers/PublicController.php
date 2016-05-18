<?php
switch ($action) {

    case 'home':
        echo 'home';
        break;

    case 'connection':
        $ajax = new Ajax();
        $userSE = new UserService();
        try{
            $result = $userSE->checkPassword($_POST['login'], $_POST['password']);
        }catch (Exception $e){
            $ajax->isSuccess = false;
            throw new Exception($e->getMessage());
        }
        $ajax->data = $result;
        $c = $ajax->toJSON();
        break;

    case 'inscription':
        $ajax = new Ajax();
        $userSE = new UserService();
        try {
            $userSE->create($_POST['login'], $_POST['password'],$_POST['name'] , $_POST['lastName'], $_POST['email']);
        } catch (Exception $e) {
            $ajax->isSuccess = false;
            throw new Exception($e->getMessage());
        }
        $c = $ajax->toJSON();
        break;

    case 'twig':
        $template = $twig->loadTemplate('index.twig');
        $c = $template->render(array(
            'moteur_name' => 'Twig'
        ));
        break;
}

