<?php

declare(strict_types=1);

namespace App\Presentation\Http\User\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class AddReviewDto
{
    public function __construct(#[Assert\NotBlank] public string $reviewText) {}
}
