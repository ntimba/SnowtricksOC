<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class AccountValidationController extends AbstractController
{
    /**
     * This method validates the user's email address.
     */
    #[Route('/account/validation/{token}', name: 'app_account_validation')]
    public function index(string $token, EntityManagerInterface $manager): Response
    {
        if(!$token){
            $this->addFlash('error', 'Token manquant.');
            return $this->redirectToRoute('app_signup');
        }

        $user = $manager->getRepository(User::class)->findOneBy(['token' => $token ]);
        if( !$user ) {
            $this->addFlash('error', 'Le token est invalide ou a déjà été utilisé.');        
            return $this->redirectToRoute('app_signup');
        }

        $user->setEmailVerified(true);
        $user->removeToken(); // vérifier le fonctionnement
        $manager->flush();
        
        return $this->render('account_validation/index.html.twig', [
            'controller_name' => 'AccountValidationController',
        ]);
    }
}
