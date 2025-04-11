<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\ContactDto;
use App\Dto\ShopDto;
use Symfony\Component\Filesystem\Path;

class HomeDataCsvService
{
    public function __construct(
        private string $baseUrl,
        private string $resourceDir,
    ) {}

    public function getBannerUrl(): string
    {
        $path = Path::join('storage', 'banner.jpg');
        return $this->baseUrl . $path;
    }

    /** @return ContactDto[]|null */
    public function getContactDtos(): ?array
    {
        $contactsFile = $this->resourceDir . '/contacts.csv';
        $contactData = $this->parseCsvFile($contactsFile);

        $result = [];
        foreach ($contactData as $item) {
            $result[] = new ContactDto(
                title: $item['title'],
                url: $item['link'],
            );
        }
        return $result;
    }

    /** @return ShopDto[] */
    public function getShopDtos(): array
    {
        $shopsFile = $this->resourceDir . '/shops.csv';
        $shopsData = $this->parseCsvFile($shopsFile);

        $result = [];
        foreach ($shopsData as $item) {
            $result[] = new ShopDto(
                title: $item['title'],
                address: $item['address'],
                latitude: (float)$item['latitude'],
                longitude: (float)$item['longitude'],
            );
        }
        return $result;
    }

    private function parseCsvFile(string $file): array
    {
        $data = [];

        if (!file_exists($file) || !is_readable($file)) {
            return $data;
        }

        if (($handle = fopen($file, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
