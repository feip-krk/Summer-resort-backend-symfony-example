<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\TelegramRequestDto;
use App\Dto\TelegramResponseDto;

class TelegramBotService
{
    public const START_COMMAND = '/start';
    public const HOUSE_LIST_COMMAND = '/house_list_command';

    public function __construct(
        private HomeDataDoctrineService $homeDataDoctrineService,
    ) {}

    public function processWebhookMessage(TelegramRequestDto $requestDto): ?TelegramResponseDto
    {
        if ($requestDto->command === self::START_COMMAND) {
            $responseMessage = 'Welcome to the bot!';

            return new TelegramResponseDto($responseMessage);
        }

        if ($requestDto->command === self::HOUSE_LIST_COMMAND) {
            $shops = $this->homeDataDoctrineService->getAllShops();
        }

        return null;
    }
}
