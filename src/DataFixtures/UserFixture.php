<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Token;
use App\Enumeration\TokenType;
use App\Repository\UserRepository;

use App\Service\TokenService;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        // Créer d'un nouvel utilisateur 
        $user = new User();

        $user->setFirstname('John');
        $user->setLastname('Doh');
        $user->setEmail('hello@snowtricks.com');
        $user->setEmailVerified(true);

        $plainTextPassword = 'admin';
        $user->setPassword($this->passwordHasher->hashPassword($user, $plainTextPassword));
        $manager->persist($user);
        $manager->flush();
    }
}
