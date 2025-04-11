<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use OpenApi\Attributes as OA;

#[ORM\Entity]
#[ORM\Table(name: 'contacts')]
class Contact implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;
    #[OA\Property(property: 'title', type: 'string', example: 'cbeams')]
    #[ORM\Column(type: 'string', length: 255)]
    private string $title;
    #[OA\Property(property: 'url', type: 'string', format: 'https://chris.beams.io/posts/git-commit/'),]
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

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->getTitle(),
            'url' => $this->getUrl(),
        ];
    }
}
