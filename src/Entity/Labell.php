<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LabellRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: LabellRepository::class)]
class Labell
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, )]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $anneeCreation = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\OneToMany(mappedBy: 'labell', targetEntity: Album::class)]
    private Collection $albums;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAnneeCreation(): ?int
    {
        return $this->anneeCreation;
    }

    public function setAnneeCreation(int $anneeCreation): static
    {
        $this->anneeCreation = $anneeCreation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): static
    {
        if (!$this->albums->contains($album)) {
            $this->albums->add($album);
            $album->setLabell($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getLabell() === $this) {
                $album->setLabell(null);
            }
        }

        return $this;
    }
}
