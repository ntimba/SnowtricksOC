<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use App\Entity\Video;
use App\Repository\TrickRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture
{
    private TrickRepository $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    public function getDependencies()
    {
        return [
            Trick::class
        ];
    }
    
    public function load(ObjectManager $manager): void
    {
        $videosData = [
            [
                "name" => "Le Indy",
                "embedcode" => 'BqDWZ_z4GQw',
            ],
            [
                "name" => "Le Stalefish",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Tail",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Weddle",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Melon",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Method",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Nose",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Wildcat",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Tamedog",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Backflip",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Frontflip",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
            [
                "name" => "Le Rodéo",
                "embedcode" => 'BqDWZ_z4GQw',
            ], 
        ];


        foreach( $videosData as $videoData )
        {
            $video = new Video();
            $video->setEmbedCode($videoData['embedcode']);
            $video->setTrick( $this->getReference($videoData['name']) );

            $manager->persist($video);
        }
        

        $manager->flush();
    }
}
