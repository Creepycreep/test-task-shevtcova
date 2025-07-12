<?php

declare(strict_types=1);

namespace App\Presentation\Http\Common\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/', name: 'health_check', methods: ['GET'])]
class HealthCheck
{
    public function __invoke(): Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
