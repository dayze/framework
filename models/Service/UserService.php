<?php

class UserService
{

    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /*******************************
     * CRUD
     *******************************/

    public function create($login, $password, $name, $lastName, $email)
    {
        return $this->userRepository->save($login, $this->hashPassword($password), $name, $lastName, $email);
    }

    public function read($byId = null, $byLogin = null, $byName = null)
    {
        return $this->userRepository->load($byId, $byLogin, $byName);
    }

    public function update($id, $login, $password, $name, $lastName, $email)
    {
        return $this->userRepository->save($login, $this->hashPassword($password), $name, $lastName, $email, $id);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    /*******************************
     * OTHER
     *******************************/

    public function checkPassword($login, $password)
    {
        $user = $this->read(null, $login);
        if (!$user) {
            return false;
        } else {
            $user = $user[0];
            if ($this->verifyPassword($password, $user->getPassword())) {
                $this->setSession($user);
                return true;
            } else
                return false;
        }
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    private function setSession(User $user)
    {
        $_SESSION[USER_SESSION] = $user;
    }


}