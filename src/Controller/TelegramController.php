<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\TelegramRequestDto;
use App\Service\TelegramBotService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TelegramController extends AbstractController
{
    public function __construct(
        private TelegramBotService $telegramBotService,
    ) {}

    #[Route('/api/telegram/webhook', methods: ['POST'])]
    public function webhook(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $data = json_decode($content, true);

        $messageParameters = $data['message'] ?? $data['channel_post'] ?? null;

        $responseData = [];
        if ($messageParameters !== null) {
            $requestDto = TelegramRequestDto::parseMessageData($messageParameters);
            $responseMessage = $this->telegramBotService->processWebhookMessage($requestDto);

            if ($responseMessage !== null) {
                $responseData = [
                    'method' => 'sendMessage',
                    'chat_id' => $requestDto->chatId,
                    'reply_to_message_id' => $requestDto->id,
                    'text' => $responseMessage->message,
                ];
            }
        }

        return $this->json($responseData);
    }
}
