<?php

declare(strict_types=1);

namespace App\Dto;

class TelegramResponseDto
{
    public function __construct(
        public string $message,
    ) {}
}
