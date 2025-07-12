<?php

declare(strict_types=1);

namespace App\Tests\Functional\Domain\Episode\Service;

use App\Domain\Episode\Service\CreateEpisodeService;
use App\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

#[CoversClass(CreateEpisodeService::class)]
final class CreateEpisodeServiceTest extends BaseTestCase
{
    public function testSuccess(): void
    {
        $externalId = 2;
        $episodeName = 'name';
        $releaseDate = new \DateTimeImmutable();
        $episode = $this->getService(CreateEpisodeService::class)->create($externalId, $episodeName, $releaseDate);

        self::assertSame($episode->externalId, $externalId);
        self::assertSame($episode->episodeName, $episodeName);
        self::assertSame($episode->releaseDate, $releaseDate);
    }
}
