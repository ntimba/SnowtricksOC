<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddTrickGroupController extends AbstractController
{
    #[Route('/add/trick/group', name: 'app_add_trick_group')]
    public function index(): Response
    {
        return $this->render('add_trick_group/index.html.twig', [
            'controller_name' => 'AddTrickGroupController',
        ]);
    }
}
