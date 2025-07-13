<?php

declare(strict_types=1);

namespace App\Presentation\Http\User\Controller;

use App\Domain\Episode\Repository\EpisodeRepository;
use App\Domain\Review\Repository\ReviewRepository;
use App\Domain\Review\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/user/episode', name: 'user')]
class UserGetEpisodeSummaryController extends AbstractController
{
    public function __construct(
        private EpisodeRepository $episodeRepository,
        private ReviewRepository $reviewRepository,
    ) {
    }

    #[Route('/{id}/summary', methods: [Request::METHOD_GET])]
    public function getEpisodeSummary(int $id): JsonResponse
    {
        $episode = $this->episodeRepository->findOneBy(['externalId' => $id]);
        if (null === $episode) {
            throw new NotFoundHttpException();
        }

        $reviews = $this->reviewRepository->findBy(['episode' => $episode], ['createdAt' => 'DESC'], 3);
        $averageScore = $this->reviewRepository->getAverageScore($episode);

        return $this->json([
            'episodeName' => $episode->episodeName,
            'releaseDate' => $episode->releaseDate->format('F j, Y'),
            'averageSentimentScore' => round($averageScore, 3),
            'reviews' => $this->normalizeReviews($reviews),
        ]);
    }

    private function normalizeReviews(array $reviews): array
    {
        return array_map(
            fn (Review $review): array => [
                'id' => $review->id->toRfc4122(),
                'reviewText' => $review->reviewText,
                'sentimentScore' => $review->sentimentScore,
            ],
            $reviews,
        );
    }
}
