<?php

declare(strict_types=1);

namespace App\Tests\Functional\Domain\Review\Service;

use App\Domain\Review\Service\AddReviewService;
use App\Tests\BaseTestCase;
use App\Tests\Builder\EpisodeBuilder;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AddReviewService::class)]
final class AddReviewServiceTest extends BaseTestCase
{
    public function testSuccess(): void
    {
        $text = 'Bad!';
        $episode = $this->getService(EpisodeBuilder::class)->build();
        $review = $this->getService(AddReviewService::class)->add(reviewText: $text, episode: $episode);

        self::assertSame($text, $review->reviewText);
        self::assertTrue($review->episode->id->equals($episode->id));
    }
}
