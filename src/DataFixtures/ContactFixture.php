<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @psalm-suppress UnusedClass
 */
class ContactFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Пример создания нескольких объектов Contact
        $contact1 = new Contact('Contact Title 1', 'https://www.example1.com');
        $contact2 = new Contact('Contact Title 2', 'https://www.example2.com');
        $contact3 = new Contact('Contact Title 3', 'https://www.example3.com');

        // Сохраняем объекты в менеджере
        $manager->persist($contact1);
        $manager->persist($contact2);
        $manager->persist($contact3);

        // Коммитим изменения в базу данных
        $manager->flush();
    }
}

// php bin/console doctrine:fixtures:load
