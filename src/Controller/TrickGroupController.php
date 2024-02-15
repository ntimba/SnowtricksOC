<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TrickGroupController extends AbstractController
{
    #[Route('/trick/group', name: 'app_trick_group')]
    public function index(): Response
    {
        return $this->render('trick_group/index.html.twig', [
            'controller_name' => 'TrickGroupController',
        ]);
    }
}
