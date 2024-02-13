<?php

namespace App\Controller;

use App\Entity\TrickGroup;
use App\Repository\TrickGroupRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddTrickGroupController extends AbstractController
{
    private TrickGroupRepository $groupRepository;
    private SluggerInterface $slugger;

    public function __construct(TrickGroupRepository $groupRepository, SluggerInterface $slugger)
    {
        $this->groupRepository = $groupRepository;
        $this->slugger = $slugger;
    }
    
    /**
     * This method adds a new group to the database if it doesn't exist.
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/add/trick/group', name: 'app_add_trick_group')]
    public function index(Request $request, EntityManagerInterface $manager ): Response
    {
        $trickGroup = new TrickGroup();

        if( 
            $request->isMethod('POST') &&
            $request->request->has('_group_name') &&
            $request->request->has('_group_escription') 
            )
        {
            $groupName = $request->request->get('_group_name');
            $groupDescription = $request->request->get('_group_escription');

            $trickGroup->setName( $groupName );
            $trickGroup->setDescription( $groupDescription );

            $groupSlug = $this->slugger->slug( $groupName );

            $groupExist = $this->groupRepository->findOneBy(['slug' => $groupSlug] );
            if( !$groupExist ){
                try{
                    $manager->persist($trickGroup);
                    $manager->flush();
                } catch( UniqueConstraintViolationException $e ) {
                    $this->addFlash('error', "Impossible d'jouter ce groupe");
                    return $this->redirectToRoute('app_add_trick_group');
                }
            }else{
                $this->addFlash('warning', "Ce groupe existe déjà");
            }   
        }
        
        return $this->render('add_trick_group/index.html.twig', [
            'controller_name' => 'AddTrickGroupController',
        ]);
    }
}
