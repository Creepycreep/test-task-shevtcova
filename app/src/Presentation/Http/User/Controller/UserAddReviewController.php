<?php

declare(strict_types=1);

namespace App\Presentation\Http\User\Controller;

use App\Domain\Episode\Repository\EpisodeRepository;
use App\Domain\Episode\Service\AddEpisodeService;
use App\Domain\Review\Service\AddReviewService;
use App\Presentation\HTTP\User\Dto\AddReviewDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/user/episode', name: 'user')]
class UserAddReviewController extends AbstractController
{
    public function __construct(
        private EpisodeRepository $episodeRepository,
        private AddEpisodeService $addEpisodeService,
        private AddReviewService $addReviewService,
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/{id}/addReview', methods: [Request::METHOD_POST])]
    public function addReview(int $id, #[MapRequestPayload] AddReviewDto $addReviewDto): JsonResponse
    {
        if ('' === $addReviewDto->reviewText) {
            throw new \InvalidArgumentException('Review text cannot be empty');
        }

        $episode = $this->episodeRepository->findOneBy(['externalId' => $id]);
        if (null === $episode) {
            $episode = $this->addEpisodeService->add($id);
        }

        $review = $this->addReviewService->add(reviewText: $addReviewDto->reviewText, episode: $episode);
        $this->entityManager->flush();

        return $this->json(
            [
                'episodeExternalId' => $episode->externalId,
                'reviewId' => $review->reviewText,
            ],
            201,
        );
    }
}
