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
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ],
            [
                "name" => "Le Stalefish",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Tail",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Weddle",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Melon",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Method",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Nose",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Wildcat",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Tamedog",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Backflip",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Frontflip",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ], 
            [
                "name" => "Le Rodéo",
                "embedcode" => '<iframe width="560" height="315" src="https://www.youtube.com/embed/EzGPmg4fFL8?si=-m_4WJNxEtbFCrZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
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
