<?php

declare(strict_types=1);

namespace App\Domain\Review;

interface ReviewSentimentAnalyzerInterface
{
    public function analyze(string $text): float;
}
