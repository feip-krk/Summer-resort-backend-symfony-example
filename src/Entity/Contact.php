<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'contacts')]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;
    #[ORM\Column(type: 'string', length: 255)]
    private string $title;
    #[ORM\Column(type: 'string', length: 255)]
    private string $url;
    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'contact', fetch: 'LAZY')]
    private Collection $addresses;

    public function __construct(
        string $title,
        string $url,
    ) {
        $this->title = $title;
        $this->url = $url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
