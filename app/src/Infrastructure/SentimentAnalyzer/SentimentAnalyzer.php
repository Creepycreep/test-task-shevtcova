<?php

declare(strict_types=1);

namespace App\Infrastructure\SentimentAnalyzer;

use App\Domain\Review\ReviewSentimentAnalyzerInterface;
use Sentiment\Analyzer;

readonly class SentimentAnalyzer implements ReviewSentimentAnalyzerInterface
{
    public function __construct(private Analyzer $analyzer)
    {
    }

    public function analyze(string $text): float
    {
        $outputText = $this->analyzer->getSentiment($text);

        return $outputText['compound'];
    }
}
