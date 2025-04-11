<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Service\HomeDataCsvService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomePage(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/home');

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        $responseArray = json_decode($client->getResponse()->getContent(), true);
    }

    /** @dataProvider homePageProvider */
    public function testMockedHomePageMethod(string $banner): void
    {
        $client = static::createClient();

        $dataMockService = $this->createMock(HomeDataCsvService::class);
        $dataMockService->method('getBannerUrl')->willReturn($banner);

        $client->getContainer()->set(HomeDataCsvService::class, $dataMockService);

        $client->request('GET', '/api/csv/home');

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        $responseArray = json_decode($client->getResponse()->getContent(), true);

        self::assertEquals($banner, $responseArray['bannerUrl']);
    }

    public static function homePageProvider(): array
    {
        return [
            [
                'banner' => 'https://www.dvfu.ru/html/svg/logos/logo_eng_1899.svg',
            ],
            [
                'banner' => 'https://www.dvfu.ru/html/svg/logos/logo_eng_1899.svg',
            ],
            [
                'banner' => 'https://www.dvfu.ru/html/svg/logos/logo_eng_1899.svg',
            ],
            [
                'banner' => 'https://www.dvfu.ru/html/svg/logos/logo_eng_1899.svg',
            ],
        ];
    }
}
