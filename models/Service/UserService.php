<?php

class UserService
{
    private $em;

    public function __construct()
    {
        $this->em = GetEntityManager();
    }

    /*******************************
     * CRUD
     *******************************/

    public function create($login, $password, $name, $lastName, $email)
    {
        $user = new User();
        $user->setLogin($login);
        $user->setPassword($password);
        $user->setName($name);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $this->em->persist($user);
        $this->em->flush();
        $this->em->close();
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

    private function setSession(User $user)
    {
        $_SESSION[USER_SESSION] = $user;
    }


}