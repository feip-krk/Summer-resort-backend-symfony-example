<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Shop;
use App\Service\HomeDataDoctrineService;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[OA\Tag(name: 'Home')]
class HomeController extends AbstractController
{
    public function __construct(
        private readonly HomeDataDoctrineService $homeDataDoctrineService,
    ) {}

    #[Route('/api/{cityId}/home', name: 'home', methods: ['GET'])]
    #[OA\Get(
        path: '/api/{cityId}/home',
        summary: 'Получает данные для домашней страницы',
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'Home Page of summer camp'),
                    new OA\Property(property: 'bannerUrl', type: 'string', example: 'https://some.site/banner.jpg'),
                ],
                type: 'object'
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Данные домашней страницы',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'title', type: 'string', example: 'Home Page of summer camp'),
                        new OA\Property(property: 'bannerUrl', type: 'string', example: 'https://some.site/banner.jpg'),
                        new OA\Property(
                            property: 'contacts',
                            type: 'array',
                            items: new OA\Items(ref: new Model(type: Contact::class))
                        ),
                        new OA\Property(
                            property: 'shops',
                            type: 'array',
                            items: new OA\Items(ref: new Model(type: Shop::class))
                        ),
                    ],
                    type: 'object'
                )
            ),
        ],
    )]
    #[OA\Parameter(
        name: 'title',
        description: 'Title of the home page',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'string', example: 'Home Page of summer camp')
    )]
    #[OA\Parameter(
        name: 'cityId',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'string')
    )]
    public function homePage(): JsonResponse
    {
        $contacts = $this->homeDataDoctrineService->getAllContacts();
        $shops = $this->homeDataDoctrineService->getAllShops();

        return $this->json([
            'title' => 'Home Page',
            'bannerUrl' => '$bannerUrl',
            'contacts' => $contacts,
            'shops' => $shops,
        ]);
    }
}
