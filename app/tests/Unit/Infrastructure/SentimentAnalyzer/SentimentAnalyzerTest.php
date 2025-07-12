<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\SentimentAnalyzer;

use App\Infrastructure\SentimentAnalyzer\SentimentAnalyzer;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

#[CoversClass(SentimentAnalyzer::class)]
final class SentimentAnalyzerTest extends WebTestCase
{
    public function testNegativeSuccess(): void
    {
        $test = "It's so bad, i don't like it!";
        $service = static::getContainer()->get(SentimentAnalyzer::class)->analyze($test);

        self::assertTrue($service < 0);
    }

    public function testPositiveSuccess(): void
    {
        $test = 'Episode is great, i like it! Wanna see it again';
        $service = static::getContainer()->get(SentimentAnalyzer::class)->analyze($test);

        self::assertTrue($service > 0);
    }
}
