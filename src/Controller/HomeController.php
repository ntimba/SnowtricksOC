<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index( Request $request, TrickRepository $trickRepository, PaginatorInterface $paginator ): Response
    {
        $page = $request->query->get('page', 1);
        $pagination = $paginator->paginate(
            $trickRepository->paginationQuery(),
            $page,
            6
        );

        if( $request->isXmlHttpRequest() ){
            $content = $this->renderView('partials/_tricksList.html.twig', [
                'pagination' => $pagination,
            ]);

            return new JsonResponse([
                'content' => $content,
                'page' => $page,
                'totalPages' => ceil($pagination->getTotalItemCount() / $pagination->getItemNumberPerPage())
            ]);
            
        }
        
        return $this->render('home/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
