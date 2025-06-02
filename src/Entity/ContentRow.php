<?php

namespace App\Entity;

use App\Repository\ContentRowRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Index;

#[ORM\Entity(repositoryClass: ContentRowRepository::class)]
#[Index(name:"IDX_CONTENT_ROW_TITLE", columns: ["title"])]
#[Index(name:"IDX_CONTENT_ROW_SORT_ORDER", columns: ["sort_order"])]
class ContentRow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: "Content", cascade: ["all"], fetch: "EAGER")]
    private Content $content;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $css_classes = null;

    #[ORM\Column]
    private ?int $sort_order = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setContent(Content $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function getContent(): ?Content
    {
        return $this->content;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCssClasses(): ?string
    {
        return $this->css_classes;
    }

    public function setCssClasses(?string $css_classes): static
    {
        $this->css_classes = $css_classes;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sort_order;
    }

    public function setSortOrder(int $sort_order): static
    {
        $this->sort_order = $sort_order;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
