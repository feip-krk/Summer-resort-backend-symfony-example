<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Shop;
use App\Service\HomeDataDoctrineService;
use App\Service\HomeDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly HomeDataDoctrineService $homeDataDoctrineService,
    ) {}

    #[Route('/api/home', name: 'home', methods: ['GET'])]
    public function homePage(): JsonResponse
    {

        $contacts = $this->homeDataDoctrineService->getAllContacts();
        $shops = $this->homeDataDoctrineService->getAllShops();

        $formattedContacts = $this->formatContacts($contacts);
        $formattedShops = $this->formatShops($shops);

        return $this->json([
            'title' => 'Home Page',
            'bannerUrl' => '$bannerUrl',
            'contacts' => $formattedContacts,
            'shops' => $formattedShops,
        ]);
    }

    /** @param array<Contact> $contacts */
    private function formatContacts(array $contacts): array
    {
        $result = [];
        foreach ($contacts as $contact) {
            $result[] = [
                'title' => $contact->getTitle(),
                'url' => $contact->getUrl(),
            ];
        }
        return $result;
    }

    /** @param array<Shop> $shops */
    private function formatShops(array $shops): array
    {
        $result = [];
        foreach ($shops as $shop) {
            $result[] = [
                'title' => $shop->getTitle(),
                'address' => $shop->getAddress(),
                'latitude' => $shop->getLatitude(),
                'longitude' => $shop->getLongitude(),
            ];
        }

        return $result;
    }
}
