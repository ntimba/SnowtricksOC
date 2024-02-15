<?php

namespace App\EventListener;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
class TrickListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if( !$entity instanceof Trick ){
            return;
        }

        if(!$entity->getSlug()){
            $entity->setSlug( $this->slugger->slug($entity->getName())->lower() );
        }

        if(!$entity->getCreatedAt()){
            $entity->setCreatedAt(new \DateTimeImmutable());
        }
    }
}







