<?php

namespace App\Entity;

use App\Repository\LessonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonsRepository::class)]
class Lessons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $last = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    private ?Matter $matter = null;

    /**
     * @var Collection<int, Resources>
     */
    #[ORM\OneToMany(targetEntity: Resources::class, mappedBy: 'lessons')]
    private Collection $resources;

    public function __construct()
    {
        $this->resources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getLast(): ?\DateTime
    {
        return $this->last;
    }

    public function setLast(\DateTime $last): static
    {
        $this->last = $last;

        return $this;
    }

    public function getMatter(): ?Matter
    {
        return $this->matter;
    }

    public function setMatter(?Matter $matter): static
    {
        $this->matter = $matter;

        return $this;
    }

    /**
     * @return Collection<int, Resources>
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resources $resource): static
    {
        if (!$this->resources->contains($resource)) {
            $this->resources->add($resource);
            $resource->setLessons($this);
        }

        return $this;
    }

    public function removeResource(Resources $resource): static
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getLessons() === $this) {
                $resource->setLessons(null);
            }
        }

        return $this;
    }
}
