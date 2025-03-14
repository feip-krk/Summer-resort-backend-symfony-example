<?php

declare(strict_types=1);

namespace App\Dto;

readonly class ShopDto
{
    public function __construct(
        public string $title,
        public string $address,
        public float $latitude,
        public float $longitude,
    ) {}
}
