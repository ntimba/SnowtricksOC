<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Video;
use App\Enumeration\TrickStatus;
use App\Repository\TrickGroupRepository;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddTrickController extends AbstractController
{
    private TrickRepository $trickRepository;
    private EntityManagerInterface $manager;
    private SluggerInterface $slugger;

    public function __construct(TrickRepository $trickRepository, EntityManagerInterface $manager, SluggerInterface $slugger)
    {
        $this->trickRepository = $trickRepository;
        $this->manager = $manager;
        $this->slugger = $slugger;
    }
    
    
    /**
     * This method handles the addition of a trick.
     *
     * @param Request $request
     * @param Security $security
     * @param TrickRepository $trickRepository
     * @param TrickGroupRepository $groupRepository
     * @return Response
     */
    #[Route('/add/trick', name: 'app_add_trick')]
    public function index(Request $request, Security $security , TrickRepository $trickRepository,TrickGroupRepository $groupRepository): Response
    {

        if( $request->isMethod('POST') ){

            $data = $request->request->all();
           
            if( isset( $data['_name'] ) && !empty( $data['_name'] ) && isset( $data['_group'] ) && !empty($data['_group'])){

                $trickName = $request->request->get('_name');
                $trickDescription = $request->request->get('_description');
                $groupName = $request->request->get('_group');
                $group = $groupRepository->findOneBy(['name' => $groupName] );
                $user = $security->getUser();
        
                $trick = new Trick();
                $trick->setName( $trickName );
                $trick->setDescription( $trickDescription );
                $trick->setGroupId( $group );
                $trick->setStatus(TrickStatus::published); 
                $trick->setUserId($user);
        
                /**
                 * adding the trick
                 */
                $options = [
                    "flashMessage" => "Une figure avec ce nom existe déjà",
                    "flahsMessageType" => "error", 
                    "redirectRoute" => "app_add_trick"
                ];
                $this->addTrick($trick, $options);

                // Video
                if ($request->isMethod('POST') && $request->request->has('embed_code')) 
                {
                    $embedCodes = $request->request->all()['embed_code'] ?? null;
                    $this->addVideo( $embedCodes, $trick);
                }

                $this->manager->flush();

            }else{

                $this->addFlash('warning', "Remplissez correctement le formulaire");
                return $this->redirectToRoute('app_add_trick');
            }
        }
                
        /**
         * Displaying the form that allows the creation of a figure.
         */
        $groups = $groupRepository->findAll();
        return $this->render('add_trick/index.html.twig', [
            'groups' => $groups
        ]);
    }

    /**
     * This method allows the addition of a video.
     *
     * @param array $embedCodes
     * @param Trick $trick
     * @return void
     */
    public function addVideo(array $embedCodes, Trick $trick){
        if ($embedCodes !== null) {

            if (!is_array($embedCodes)) {
                $embedCodes = [$embedCodes];
            }

            foreach ($embedCodes as $embedCode) {
                $video = new Video();
                $video->setEmbedCode($embedCode);
                $video->setTrickId( $trick );
    
                $this->manager->persist($video);
            }
        }
    }

    public function addPhoto(){
        // "This method is to be created."
    }
    

    /**
     * This method allows the addition of a figure
     *
     * @param Trick $trick
     * @param array $options
     * @return void
     */
    public function addTrick(Trick $trick, array $options = [] )
    {   
        $trickNameSlug = $this->slugger->slug($trick->getName());
        $trickNameSlugExist = $this->trickRepository->findOneBy(['slug' => $trickNameSlug] );

        if( !$trickNameSlugExist ){
            $this->manager->persist($trick);
        }else{

            $flashMessage = $options['flashMessage'] ?? 'Le titre de cette figure a déjà été créé.';
            $flashMessageType = $options['flashMessageType'] ?? 'warning';
            $this->addFlash($flashMessageType, $flashMessage);

            $redirectRoute = $options['redirectRoute'] ?? null;
            if( $redirectRoute ) {
                return $this->redirectToRoute($redirectRoute);
            }
        }
        return null; 
    }
}
