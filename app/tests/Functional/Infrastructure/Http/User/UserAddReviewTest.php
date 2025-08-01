<?php

declare(strict_types=1);

namespace App\Tests\Functional\Infrastructure\Http\User;

use App\Presentation\Http\User\Controller\UserAddReviewController;
use App\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\HttpFoundation\Request;

#[CoversClass(UserAddReviewController::class)]
final class UserAddReviewTest extends BaseTestCase
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
        $reviewText = '';

        $this->request(Request::METHOD_POST, '/user/episode/4/addReview')
            ->withBody([
                'reviewText' => $reviewText,
            ])
            ->execute();

        $this->assertResponseStatusCodeSame(422);
    }
}
