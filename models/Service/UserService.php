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
        return $this->userRepository->save($login, $password, $name, $lastName, $email);
    }

    /*******************************
     * Other
     *******************************/

    public function checkPassword($login, $password)
    {
        $qb = $this->em->createQueryBuilder();
        $user = $qb->select('u')
            ->from('User', 'u')
            ->where('u.login = :login')
            ->andWhere('u.password = :password')
            ->setParameter('login', $login)
            ->setParameter('password', $password)
            ->setMaxResults(1)
            ->getQuery()->getResult();
        if (!$user) {
            return false;
        } else {
            $this->setSession($user[0]);
        }
        return true;
    }

    public function returnAll()
    {
        $qb = $this->em->getRepository('User');
        $users = $qb->findAll();
        foreach ($users as $user) {
            echo $user->getEmail();
        }
    }

    private function setSession(User $user)
    {
        $_SESSION[USER_SESSION] = $user;
    }


}