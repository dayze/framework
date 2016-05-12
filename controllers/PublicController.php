<?php
//PRINCIPE DU CONTROLLER
/* Le controller doit contenir le minimum de code m�tier possible. Son r�le est d'appeller le bon mod�le et ses fonctions,
de recevoir le r�sultat puis de le transmettre � la vue. */

switch ($action) {

    case 'home':
        echo 'home';
        break;

    case 'connection':
        $login = $_POST['login'];
        $password = $_POST['password'];
        $user = new User();
        $varArray = $user->connection($login, $password);
        if ($varArray) {
            $_SESSION['user'] = $varArray[0];
            $c = json_encode(array("data" => true));
        } else {
            $c = json_encode(array("data" => false));
        }

        break;

    case 'inscription':
        $ajax = new Ajax();
        $user = new User();
        $team = new Team();
        try {
            $user->createUser($_POST['login'], $_POST['password'], $_POST['lastName'], $_POST['name']);
        } catch (Exception $e) {
            $ajax->data = $e->getMessage();
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

