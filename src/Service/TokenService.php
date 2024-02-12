<?php

namespace App\Service;

use App\Entity\Token;
use App\Enum\TokenType;
use Doctrine\ORM\EntityManagerInterface;

class TokenService
{
    private EntityManagerInterface $manager;
    private Token $token;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function createToken(TokenType $type, $user): Token
    {
        $token = new Token();
        $token->setToken( bin2hex(random_bytes(32)) );
        $token->setType($type);
        $token->setUserId($user);
        $token->setExpireDate(new \DateTimeImmutable('+1 day'));

        $this->manager->persist($token);
        $this->manager->flush();

        return $token;
    }
}
