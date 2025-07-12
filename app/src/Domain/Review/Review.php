<?php

declare(strict_types=1);

namespace App\Domain\Review;

use App\Domain\Episode\Episode;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Review
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    public Uuid $id;

    #[ORM\Column(type: Types::TEXT)]
    public string $reviewText;

    #[ORM\Column(type: Types::FLOAT)]
    public float $sentimentScore;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: Episode::class, inversedBy: 'episode')]
    public Episode $episode;

    public function __construct(string $reviewText, Episode $episode, float $sentimentScore)
    {
        $this->id = Uuid::v4();
        $this->createdAt = new \DateTimeImmutable();

        $this->reviewText = $reviewText;
        $this->episode = $episode;
        $this->sentimentScore = $sentimentScore;

        $episode->episodeReviews->add($this);
    }
}
