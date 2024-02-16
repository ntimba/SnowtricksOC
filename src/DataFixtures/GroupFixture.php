<?php

namespace App\DataFixtures;

use App\Entity\TrickGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $trickGroups = [
                [
                    "groupName" => "Les Grabs",
                    "description" => "Les Grabs sont la colonne vertébrale des figures de snowboard. Stylé et classe, c'est en attrapant la planche en plein vol, à une ou deux mains, que le freestyle est né."
                ],
                [
                    "groupName" => "Les rotations",
                    "description" => "es rotations verticales sont des flips. Le principe est d'effectuer une rotation horizontale pendant le saut, puis d'attérir en position switch ou normal. La nomenclature se base sur le nombre de degrés de rotation effectués."
                ],
                [
                    "groupName" => "Les flips",
                    "description" => "Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière."
                ],
                [
                    "groupName" => "Les rotations désaxées",
                    "description" => "Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu'initialement horizontales, font passer la tête en bas."
                ],
                [
                    "groupName" => "Les slides",
                    "description" => "Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé."
                ],
                [
                    "groupName" => "Les one foot tricks",
                    "description" => "Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception."
                ],
                [
                    "groupName" => "Old school",
                    "description" => "Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school)"
                ],
            ];

        foreach($trickGroups as $group){
            $trickGroup = new TrickGroup();
            $trickGroup->setName($group['groupName']);
            $trickGroup->setDescription($group['description']);
   
            $manager->persist($trickGroup);

            $this->addReference( $group['groupName'], $trickGroup );
        }
        $manager->flush();
    }
}
