<?php

declare(strict_types=1);

namespace App\Presentation\Http\User\Dto;

use Symfony\Component\Validator\Constraints as Assert;
class AddReviewDto
{
    public function __construct(#[Assert\NotBlank] #[Assert\Length(min: 10, max: 2000)] public string $reviewText) {}
}
