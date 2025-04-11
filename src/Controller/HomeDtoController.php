<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ContactDto;
use App\Dto\ShopDto;
use App\Service\HomeDataCsvService;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HomeDtoController extends AbstractController
{
    public function __construct(
        private readonly HomeDataCsvService $homeDataService,
    ) {}

    #[Route(path: '/api/csv/home', name: 'home_csv', options: ['deprecated' => true], methods: ['GET'])]
    public function homePage(): JsonResponse
    {
        $contacts = $this->homeDataService->getContactDtos();
        $shops = $this->homeDataService->getShopDtos();
        $bannerUrl = $this->homeDataService->getBannerUrl();

        $formattedContacts = $this->formatContact($contacts);
        $formattedShops = $this->formatShop($shops);

        return $this->json([
            'title' => 'Home Page',
            'bannerUrl' => $bannerUrl,
            'contacts' => $formattedContacts,
            'shops' => $formattedShops,
        ]);
    }

    /** @param array<ContactDto> $contacts */
    private function formatContact(array $contacts): array
    {
        $result = [];
        foreach ($contacts as $contact) {
            $result[] = [
                'title' => $contact->title,
                'url' => $contact->url,
            ];
        }
        return $result;
    }

    /** @param array<ShopDto> $shops */
    private function formatShop(array $shops): array
    {
        $result = [];
        foreach ($shops as $shop) {
            $result[] = [
                'title' => $shop->title,
                'address' => $shop->address,
                'latitude' => $shop->latitude,
                'longitude' => $shop->longitude,
            ];
        }

        return $result;
    }
}
