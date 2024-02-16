<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use App\Entity\Video;
use App\Enumeration\TrickStatus;
use App\Repository\TrickGroupRepository;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrickFixtures extends Fixture
{
    private TrickGroupRepository $groupRepository;
    private UserRepository $userRepository;
    private VideoRepository $videoRepository;
    
    public function __construct(TrickGroupRepository $groupRepository, UserRepository $userRepository, VideoRepository $videoRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->userRepository = $userRepository;
        $this->videoRepository = $videoRepository;
    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
            GroupFixture::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        // Tricks
        $tricksData = [
            [
                "name" => "Le Indy",
                "description" => "Passe la main derrière ton genou arrière et attrape le carre de ta planche entre les fixations, côté talon, avec ta main arrière.",
                "status" => TrickStatus::published,
                "group" => "Les Grabs",
                "user" => "hello@snowtricks.com"
            ],
            [
                "name" => "Le Stalefish",
                "description" => "Attrape le carre des orteils de ta planche, entre les fixations, avec ta main arrière.",
                "status" => TrickStatus::published,
                "group" => "Les Grabs",
                "user" => "hello@snowtricks.com"
            ], 
            [
                "name" => "Le Tail",
                "description" => "Attrape le talon de ta planche avec ta main arrière (juste à l'extrémité, pas sur les côtés).",
                "status" => TrickStatus::published,
                "group" => "Les Grabs",
                "user" => "patrick.poivre@snowtricks.com"
            ], 
            [
                "name" => "Le Weddle",
                "description" => "(anciennement appelé Mute Grab) - Du nom de Chris Weddle, l'inventeur, attrape le carre des orteils entre les fixations avec ta main avant.",
                "status" => TrickStatus::published,
                "group" => "Les Grabs",
                "user" => "patrick.poivre@snowtricks.com"
            ], 
            [
                "name" => "Le Melon",
                "description" => "À partir de la prise du Melon, étends tes jambes de façon à ce que ton corps ait presque la forme de la queue d'un scorpion, puis cherche à atteindre le ciel avec ta main arrière. C'est la figure la plus stylée, et chacun a sa propre version.",
                "status" => TrickStatus::published,
                "group" => "Les Grabs",
                "user" => "julien.bernard@snowtricks.com"
            ], 
            [
                "name" => "Le Method",
                "description" => "Attrape le carre des orteils de ta planche, entre les fixations, avec ta main arrière.",
                "status" => TrickStatus::published,
                "group" => "Les Grabs",
                "user" => "julien.bernard@snowtricks.com"
            ], 
            [
                "name" => "Le Nose",
                "description" => "Attrape l'extrémité avant de ta planche avec ta main avant.",
                "status" => TrickStatus::published,
                "group" => "Les Grabs",
                "user" => "bernard.thomas@snowtricks.com"
            ], 
            [
                "name" => "Le Wildcat",
                "description" => "Un Wildcat est un Backflip qui garde la planche parallèle à la trajectoire, tu fais donc une sorte de Flip 'latéral' sans perte de vitesse.",
                "status" => TrickStatus::published,
                "group" => "Les flips",
                "user" => "bernard.thomas@snowtricks.com"
            ], 
            [
                "name" => "Le Tamedog",
                "description" => "L'exact opposé d'un Wildcat est un Tamedog. C'est un Frontflip qui garde la planche parallèle à la trajectoire. Un hard Nollie utilise le nez comme tremplin pour amorcer la rotation.",
                "status" => TrickStatus::published,
                "group" => "Les flips",
                "user" => "hans.mueller@snowtricks.com"
            ], 
            [
                "name" => "Le Backflip",
                "description" => "Un Backflip fait tourner la planche perpendiculairement à la neige, tu fais donc un Flip directement en arrière, en stabilisant la planche lors de l'atterrissage.",
                "status" => TrickStatus::published,
                "group" => "Les flips",
                "user" => "hans.mueller@snowtricks.com"
            ], 
            [
                "name" => "Le Frontflip",
                "description" => "Tout comme le Tamedog, le Frontflip te demande de faire un Nose-Press et un Nollie sur un bord. Tu tends ensuite les deux mains vers l'avant pour amorcer le saut périlleux et remettre la planche en place pour l'atterrissage.",
                "status" => TrickStatus::published,
                "group" => "Les flips",
                "user" => "hello@snowtricks.com"
            ], 
            [
                "name" => "Le Rodéo",
                "description" => "Un Rodéo est un Frontflip avec un twist. Littéralement. Lorsque tu arrives sur le rebord du saut, déclenche un virage Frontside. Puis, décolle la carre des orteils de ta planche, en continuant la rotation, de façon à effectuer un Frontflip avec un Frontside 180, puis atterris en Switch.",
                "status" => TrickStatus::published,
                "group" => "Les flips",
                "user" => "hello@snowtricks.com"
            ], 
        ];

        foreach( $tricksData as $trickData ){

            $trick = new Trick();
            $trick->setName( $trickData['name'] );
            $trick->setDescription( $trickData['description'] );
            $trick->setStatus( $trickData['status'] );
            $trick->setGroup( $this->getReference($trickData['group']) );
            $trick->setUser( $this->getReference($trickData['user']  ) );

            $manager->persist($trick); 

            $this->addReference(  $trickData['name'], $trick);

        }
        
        $manager->flush();
    }
}
