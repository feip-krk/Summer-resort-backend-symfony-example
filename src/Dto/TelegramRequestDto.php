<?php

declare(strict_types=1);

namespace App\Dto;

class TelegramRequestDto
{
    public function __construct(
        public int $id,
        public int $chatId,
        public ?string $rawText,
        public ?string $command,
        /** @var string[]|null */
        public ?array $commandArgs,
    ) {}

    public static function parseMessageData(array $messageData): self
    {
        $rawText = $messageData['text'] ?? null;

        $command = null;
        $commandArgs = null;
        if ($rawText !== null) {
            $parsedTextArray = explode(' ', $rawText);
            $command = array_shift($parsedTextArray);
            $commandArgs = $parsedTextArray;
        }

        return new self(
            id: $messageData['message_id'],
            chatId: $messageData['chat']['id'],
            rawText: $rawText,
            command: $command,
            commandArgs: $commandArgs,
        );
    }
}
