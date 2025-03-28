<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Contact;
use App\Entity\Shop;
use Doctrine\ORM\EntityManagerInterface;

class HomeDataDoctrineService
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function createStubContact(): Contact
    {
        $contact = new Contact('title', 'mail.com');

        $this->em->persist($contact);

        $this->em->flush();

        return $contact;
    }

    public function getContactByIdQb(int $id): Contact
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('c')
            ->from(Contact::class, 'c')
            ->leftJoin('c.addresses', 'a')
            ->where('c.id = :id')
            ->setParameter('id', 11);
        return $qb->getQuery()->getResult();
    }

    public function getAllContacts(): array
    {
        return $this->em->getRepository(Contact::class)->findAll();
    }

    public function getAllShops(): array
    {
        return $this->em->getRepository(Shop::class)->findAll();
    }
}
