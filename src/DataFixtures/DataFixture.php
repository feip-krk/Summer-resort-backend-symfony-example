<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Contact;
use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

/**
 * @psalm-suppress UnusedClass
 */
class DataFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Пример создания нескольких объектов Contact
        $contact1 = new Contact('Contact Title 1', 'https://www.example1.com');
        $contact2 = new Contact('Contact Title 2', 'https://www.example2.com');
        $contact3 = new Contact('Contact Title 3', 'https://www.example3.com');
        $contact4 = new Contact('Contact Title 4', 'https://www.example4.com');
        $contact5 = new Contact('Contact Title 5', 'https://www.example5.com');

        $street1 = new Address('Pushkin street');
        $street2 = new Address('Gorky street');

        $minimalShop1 = new Shop('Minimal Shop 1', 0, 0, 'This is a shop with minimal data');
        $minimalShop2 = new Shop('Minimal Shop 2', 0, 0, 'Another shop with minimal data');

        $maximalShop1 = new Shop('Maximal Shop 1', 0, 0, 'This is a shop with maximum data');
        $maximalShop1->setContacts(new ArrayCollection([$contact1, $contact2]));
        $maximalShop1->setAddress($street1);

        $maximalShop2 = new Shop('Maximal Shop 2', 0, 0, 'Another shop with maximum data');
        $maximalShop2->setContacts(new ArrayCollection([$contact3]));
        $maximalShop2->setAddress($street2);

        $manager->persist($minimalShop1);
        $manager->persist($minimalShop2);
        $manager->persist($maximalShop1);
        $manager->persist($maximalShop2);

        $manager->persist($contact4);
        $manager->persist($contact5);

        $manager->persist($street1);
        $manager->persist($street2);

        $manager->flush();
    }
}

// php bin/console doctrine:fixtures:load
