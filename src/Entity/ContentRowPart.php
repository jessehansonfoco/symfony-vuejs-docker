<?php

namespace App\Entity;

use App\Repository\ContentRowPartRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: ContentRowPartRepository::class)]
class ContentRowPart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: "ContentRow", cascade: ["all"], fetch: "EAGER")]
    private ContentRow $contentRow;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $type_code = null;

    #[ORM\Column(type: 'text', length: 65535, nullable: false)]
    private ?string $content;

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

    public function setContentRow(ContentRow $contentRow): static
    {
        $this->contentRow = $contentRow;
        return $this;
    }

    public function getContentRow(): ?ContentRow
    {
        return $this->contentRow;
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

    public function getTypeCode(): ?string
    {
        return $this->type_code;
    }

    public function setTypeCode(string $type_code): static
    {
        $this->type_code = $type_code;

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
