<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use App\Repository\TrickRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PhotoFixtures extends Fixture
{
    private TrickRepository $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    public function load(ObjectManager $manager): void
    {

        $photosData = [
            [
                "trick" => "Le Indy",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ],
            [
                "trick" => "Le Indy",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ],
            [
                "trick" => "Le Indy",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ],
            [
                "trick" => "Le Indy",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ],
            [
                "trick" => "Le Indy",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ],
            [
                "trick" => "Le Indy",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ],
            [
                "trick" => "Le Stalefish",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Stalefish",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Stalefish",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Stalefish",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Stalefish",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Stalefish",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Tail",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Tail",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Tail",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Tail",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Tail",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Tail",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Weddle",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Weddle",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Weddle",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Weddle",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Weddle",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Melon",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Method",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Nose",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Wildcat",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Tamedog",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Backflip",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Frontflip",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
            [
                "trick" => "Le Rodéo",
                "filepath" => "https://bit.ly/4bGN3nK",
                "description" => "",
            ], 
        ];
        
        foreach( $photosData as $photoData )
        {
            $photo = new Photo();
            $photo->setFilePath($photoData['filepath']);
            $photo->setDescription($photoData['description']);
            $photo->setTrickId( $this->trickRepository->findOneBy(['name' =>$photoData['trick'] ]) );

            $manager->persist( $photo );
        }

        $manager->flush();
    }
}
