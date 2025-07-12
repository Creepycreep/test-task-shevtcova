<?php

declare(strict_types=1);

namespace App\Tests\Functional\Infrastructure\Http\User;

use App\Domain\Episode\Service\AddEpisodeService;
use App\Presentation\Http\User\Controller\UserAddReviewController;
use App\Presentation\Http\User\Controller\UserGetEpisodeSummaryController;
use App\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

#[CoversClass(UserGetEpisodeSummaryController::class)]
final class UserGetEpisodeSummaryTest extends BaseTestCase
{
    public function testAddReviewSuccess(): void
    {
        $reviewText = 'Wow! Great episode';

        $this->request(Request::METHOD_POST, '/user/episode/4/addReview')
            ->withBody([
                'reviewText' => $reviewText,
            ])
            ->execute();

        $this->assertResponseIsSuccessful();
    }

    public function testAddReviewTooShortFail(): void
    {
        $reviewText = 'Wow!';

        $this->request(Request::METHOD_POST, '/user/episode/4/addReview')
            ->withBody([
                'reviewText' => $reviewText,
            ])
            ->execute();

        $this->assertResponseStatusCodeSame(422);
    }

    public function testGetEpisodeSummarySuccess(): void
    {
        $this->request(Request::METHOD_GET, '/user/episode/4/summary')->execute();

        $this->assertResponseIsSuccessful();
    }
}
