<?php

namespace App\EventListener;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
class VideoListener
{
    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if( !$entity instanceof Video ){
            return;
        }

        if(!$entity->getCreatedAt()){
            $entity->setCreatedAt(new \DateTimeImmutable());
        }
    }
}







