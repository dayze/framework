<?php
switch ($action) {

    case 'home':
        $template = $twig->loadTemplate('home.html.twig');
        $c = $template->render(array());
        break;

    case 'connection':
        $userSE = new UserService();
        try{
            $_POST['login'] = 'dez';
            $_POST['password'] = 'dez';
            $result = $userSE->checkPassword($_POST['login'], $_POST['password']);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
        if($result){
            header("Location: index.php");
        }
        break;

    case 'inscription':
        $ajax = new Ajax();
        $userSE = new UserService();
        try {
            $userSE->create($_POST['login'], $_POST['password'],$_POST['name'] , $_POST['lastName'], $_POST['email'], USER);
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

