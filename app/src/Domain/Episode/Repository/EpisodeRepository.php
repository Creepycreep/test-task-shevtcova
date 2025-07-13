<?php

declare(strict_types=1);

namespace App\Domain\Episode\Repository;

use App\Domain\Episode\Episode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EpisodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct(registry: $registry, entityClass: Episode::class);
    }

    public function add(Episode $episode): void
    {
        $this->getEntityManager()->persist($episode);
    }
}
