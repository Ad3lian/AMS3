<?php
// src/OC/UserBundle/DataFixtures/ORM/LoadUser.php

namespace OC\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AM\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Le nom d'utilisateur à créer
        $name = "Martin";
        $firstname = "Adrien";
        $email = "adrien-martin@hotmail.fr";
        $password = "Martin_a4";

        // On crée l'utilisateur
        $user = new User;

        // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
        $user->setName($name);
        $user->setFirstname($firstname);
        $user->setUsername($email);
        $user->setEmail($email);
        $user->setPassword($password);

//        // On ne se sert pas du sel pour l'instant
//        $user->setSalt('');
        // On définit uniquement le role ROLE_USER qui est le role de base
        $user->setRoles(array('ROLE_USER'));

        // On le persiste
        $manager->persist($user);

        // On déclenche l'enregistrement
        $manager->flush();
    }
}