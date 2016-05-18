<?php

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
            ->where('1=1');
        if (!is_null($byId)) {
            $qb->andWhere('u.id = :id')
                ->setParameter('id', $byId);
        }
        if (!is_null($byName)) {
            $qb->andWhere('u.name = :name')
                ->setParameter('name', $byName);
        }
        return $qb->getQuery()->getResult();

    }

    public function save($login, $password, $name, $lastName, $email, $id = null)
    {
        if (is_null($id)) {
            try {
                $user = new User();
                $user->setLogin($login);
                $user->setPassword($password);
                $user->setName($name);
                $user->setLastName($lastName);
                $user->setEmail($email);
                $this->em->persist($user);
                $this->em->flush();
                $this->em->close();
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else {
            $qb = $this->em->createQueryBuilder();
            $qb->update('User', 'u');
            if (!is_null($login)) {
                $qb->set('u.login', ':login')
                    ->setParameter(':login', $login);
            }
            if (!is_null($password)) {
                $qb->set('u.password', ':password')
                    ->setParameter(':password', $password);
            }
            if (!is_null($name)) {
                $qb->set('u.name', ':name')
                    ->setParameter(':name', $name);
            }
            if (!is_null($lastName)) {
                $qb->set('u.lastName', ':lastName')
                    ->setParameter(':lastName', $lastName);
            }
            if (!is_null($email)) {
                $qb->set('u.email', ':email')
                    ->setParameter(':email', $email);
            }
            $qb->where('u.id = :id')
                ->setParameter('id', $id);
            $qb->getQuery()->getResult();
        }
        return true;
    }

    public function delete($id)
    {
        $qb = $this->em->createQueryBuilder();
        try {
            $qb->delete('User', 'u')
                ->where('u.id = :id')
                ->setParameter('id', $id)
                ->getQuery()->getResult();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return true;

    }


}