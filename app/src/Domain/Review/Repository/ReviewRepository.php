<?php

declare(strict_types=1);

namespace App\Domain\Review\Repository;

use App\Domain\Episode\Episode;
use App\Domain\Review\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Types\UuidType;

class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct(registry: $registry, entityClass: Review::class);
    }

    public function add(Review $review): void
    {
        $this->getEntityManager()->persist($review);
    }

    public function getAverageScore(Episode $episode): float
    {
        $avg = $this->createQueryBuilder('r')
            ->select('AVG(r.sentimentScore)')
            ->where('r.episode = :episodeId')
            ->setParameter('episodeId', $episode->id, UuidType::NAME)
            ->getQuery()
            ->getSingleScalarResult();

        return (float) $avg;
    }
}
