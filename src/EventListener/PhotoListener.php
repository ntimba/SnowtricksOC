<?php

namespace App\EventListener;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
class PhotoListener
{
    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if( !$entity instanceof Photo ){
            return;
        }

        if(!$entity->getCreatedAt()){
            $entity->setCreatedAt(new \DateTimeImmutable());
        }
    }
}







