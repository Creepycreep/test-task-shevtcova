<?php

declare(strict_types=1);

namespace App\Tests\Functional\Domain\Episode\Service;

use App\Domain\Episode\Service\AddEpisodeService;
use App\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

#[CoversClass(AddEpisodeService::class)]
final class AddEpisodeServiceTest extends BaseTestCase
{
    public function testSuccess(): void
    {
        $externalId = 2;
        $episode = $this->getService(AddEpisodeService::class)->add($externalId);

        self::assertSame($episode->externalId, $externalId);
    }
}
