<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"IDENTITY")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $date = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'albums')]
    private ?Artiste $artiste = null;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Morceau::class)]
    private Collection $morceaux;

    #[ORM\ManyToMany(targetEntity: Style::class, mappedBy: 'albums')]
    private Collection $styles;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Label::class)]
    private Collection $label;

    #[ORM\ManyToOne(inversedBy: 'albums')]
    private ?Labell $labell = null;

    public function __construct()
    {
        $this->morceaux = new ArrayCollection();
        $this->styles = new ArrayCollection();
        $this->label = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setID(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): static
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * @return Collection<int, Morceau>
     */
    public function getMorceaux(): Collection
    {
        return $this->morceaux;
    }

    public function addMorceaux(Morceau $morceaux): static
    {
        if (!$this->morceaux->contains($morceaux)) {
            $this->morceaux->add($morceaux);
            $morceaux->setAlbum($this);
        }

        return $this;
    }

    public function removeMorceaux(Morceau $morceaux): static
    {
        if ($this->morceaux->removeElement($morceaux)) {
            // set the owning side to null (unless already changed)
            if ($morceaux->getAlbum() === $this) {
                $morceaux->setAlbum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    public function addStyle(Style $style): static
    {
        if (!$this->styles->contains($style)) {
            $this->styles->add($style);
            $style->addAlbum($this);
        }

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        if ($this->styles->removeElement($style)) {
            $style->removeAlbum($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Label>
     */
    public function getLabel(): Collection
    {
        return $this->label;
    }


    public function addLabel(Label $label): static
    {
        if (!$this->label->contains($label)) {
            $this->label->add($label);
            $label->setAlbum($this);
        }

        return $this;
    }

    public function removeLabel(Label $label): static
    {
        if ($this->label->removeElement($label)) {
            // set the owning side to null (unless already changed)
            if ($label->getAlbum() === $this) {
                $label->setAlbum(null);
            }
        }

        return $this;
    }

    public function getLabell(): ?Labell
    {
        return $this->labell;
    }

    public function setLabell(?Labell $labell): static
    {
        $this->labell = $labell;

        return $this;
    }
}
