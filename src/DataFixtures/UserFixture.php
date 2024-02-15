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

        $usersData = [
            [
                'firstname' => 'John',
                'lastname' => 'Doh',
                'email' => 'john.doh@snowtricks.com',
                'emailverified' => true,
                'password' => 'admin'
            ],
            [
                'firstname' => 'Patrick',
                'lastname' => 'Poivre',
                'email' => 'patrick.poivre@snowtricks.com',
                'emailverified' => true,
                'password' => 'admin'
            ],
            [
                'firstname' => 'Julien',
                'lastname' => 'Bernard',
                'email' => 'julien.bernard@snowtricks.com',
                'emailverified' => true,
                'password' => 'admin'
            ],
            [
                'firstname' => 'Bernard',
                'lastname' => 'Thomas',
                'email' => 'bernard.thomas@snowtricks.com',
                'emailverified' => true,
                'password' => 'admin'
            ],
            [
                'firstname' => 'Hans',
                'lastname' => 'Müller',
                'email' => 'hans.mueller@snowtricks.com',
                'emailverified' => true,
                'password' => 'admin'
            ],

        ];
        
        foreach ($usersData as $userData) {
            $user = new User();
            $user->setFirstname($userData['firstname']);
            $user->setLastname($userData['lastname']);
            $user->setEmail($userData['email']);
            $user->setEmailVerified($userData['emailverified']);
    
            $plainTextPassword = $userData['password'];
            $user->setPassword($this->passwordHasher->hashPassword($user, $plainTextPassword));

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
