<?php

/**
 * Created by PhpStorm.
 * User: mlaine
 * Date: 16/05/16
 * Time: 16:07
 */
class UserRepository
{
    private $em;

    public function __construct()
    {
        $this->em = getEntityManager();
    }

    /************************************
     * LSD
     ************************************/

    public function load($byId = null, $byName = null)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('u')
            ->from('User', 'u')
            ->where('1=1')
            ->andWhere('');

    }

    public function save($login, $password, $name, $lastName, $email, $id = null)
    {
        $user = new User();
        $user->setLogin($login);
        $user->setPassword($password);
        $user->setName($name);
        $user->setLastName($lastName);
        $user->setEmail($email);
        if (is_null($id)) {
            try {
                $this->em->persist($user);
                $this->em->flush();
                $this->em->close();
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else {

        }


        return true;
    }

    public function delete()
    {

    }


}