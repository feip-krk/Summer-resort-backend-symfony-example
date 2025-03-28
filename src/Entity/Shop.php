<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'shops')]
class Shop
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;
    #[ORM\Column(type: 'string', length: 255)]
    private string $address;
    #[ORM\Column(type: 'float', length: 255)]
    private float $latitude;
    #[ORM\Column(type: 'float', length: 255)]
    private float $longitude;

    public function __construct(
        string $title,
        string $address,
        float $latitude,
        float $longitude,
    ) {
        $this->title = $title;
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
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
}
