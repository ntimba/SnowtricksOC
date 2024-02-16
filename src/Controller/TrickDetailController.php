<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TrickDetailController extends AbstractController
{    
    #[Route('/trick/{slug}', name: 'app_trick_detail')]
    public function index(string $slug, TrickRepository $trickRepository): Response
    {
        // $trick = $this->getDoctrine()->getRepository(Article::class)->findOneBy(['slug' => $slug]);
        $trick = $trickRepository->findOneBy(['slug' => $slug]);

        // if (!$trickDetail) {
        //     throw $this->createNotFoundException('Trick not found');
        // }

        // // dd( $trickDetail );
        
        // return $this->render('trick_detail/index.html.twig', [
        //     'trick' => $trickDetail
        // ]);


        $mediaItems = [];

        foreach ($trick->getPhotos() as $photo) {
            $mediaItems[] = ['type' => 'photo', 'path' => $photo->getFilePath()];
        }
        
        foreach ($trick->getVideos() as $video) {
            $mediaItems[] = ['type' => 'video', 'code' => $video->getEmbedCode()];
        }
        
        // Passez cette collection à Twig
        return $this->render('trick_detail/index.html.twig', [
            'trick' => $trick,
            'mediaItems' => $mediaItems,
        ]);
        
    }
}
