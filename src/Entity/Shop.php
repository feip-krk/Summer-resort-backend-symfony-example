<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'shops')]
class Shop
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[OA\Property(property: 'title', type: 'string')]
    private string $title;
    #[ORM\Column(type: 'float')]
    #[Assert\NotNull]
    #[Assert\Type(type: 'float', message: 'Значение должно быть числом с точкой.')]
    private float $latitude;
    #[ORM\Column(type: 'float')]
    #[Assert\NotNull]
    #[Assert\Type(type: 'float', message: 'Значение должно быть числом с точкой.')]
    private float $longitude;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\ManyToOne(targetEntity: Address::class, inversedBy: 'shops')]
    #[ORM\JoinColumn(name: 'address_id', referencedColumnName: 'id', nullable: true)]
    private ?Address $address = null;

    #[ORM\ManyToMany(targetEntity: Contact::class, inversedBy: 'shops', cascade: ['persist'], fetch: 'LAZY')]
    #[ORM\JoinTable(name: 'shop_contacts')]
    private Collection $contacts;

    #[ORM\Embedded(class: ShopSeo::class, columnPrefix: 'seo_')]
    private ShopSeo $seo;

    public function __construct(
        string $title,
        float $latitude,
        float $longitude,
        string $description,
    ) {
        $this->title = $title;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->description = $description;
        $this->contacts = new ArrayCollection();
        $this->seo = new ShopSeo();
    }

    public function __toString(): string
    {
        return sprintf('%s (ID: %d)', $this->getTitle(), $this->getId());
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function setContacts(Collection $contacts): void
    {
        $this->contacts = $contacts;
    }

    public function addContact(Contact $contact): void
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
        }
    }

    public function removeContact(Contact $contact): void
    {
        $this->contacts->removeElement($contact);
    }

    public function getSeo(): ?ShopSeo
    {
        return $this->seo;
    }

    public function setSeo(?ShopSeo $seo): void
    {
        $this->seo = $seo;
    }
}
