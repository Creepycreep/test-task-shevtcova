<?php

declare(strict_types=1);

namespace App\Domain\Review\Service;

use App\Domain\Episode\Episode;
use App\Domain\Review\Repository\ReviewRepository;
use App\Domain\Review\Review;
use App\Infrastructure\SentimentAnalyzer\SentimentAnalyzer;

readonly class AddReviewService
{
    public function __construct(private ReviewRepository $repository, private SentimentAnalyzer $analyzer)
    {
    }

    public function add(string $reviewText, Episode $episode): Review
    {
        $sentimentScore = $this->analyzer->analyze($reviewText);

        $review = new Review(
            reviewText: $reviewText,
            episode: $episode,
            sentimentScore: $this->normalizeScore($sentimentScore),
        );

        $this->repository->add($review);

        return $review;
    }

    private function normalizeScore(float $score): float
    {
        return ($score + 1) / 2;
    }
}
