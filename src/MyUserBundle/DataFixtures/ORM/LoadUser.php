<?php
namespace MyUserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyUserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $listNames = array
        (
            'admin'      =>  array('role' => array('ROLE_ADMIN')),
            'auteur'     =>  array('role' => array('ROLE_AUTEUR')),
            'user'       =>  array('role' => array('ROLE_USER')),
        );
        $pass = 'local';

        foreach($listNames as $name => $info)
        {
            $user = new User();
            $user
                ->setUsername($name)
                ->setEmail($name.'@mindsymfony.dev')
                ->setPlainPassword($pass)
                ->setRoles($info['role'])
                ->setEnabled(true);

            $manager->persist($user);
        }

        $manager->flush();
    }
}