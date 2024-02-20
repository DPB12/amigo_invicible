<?php

namespace App\Entity;

use App\Repository\SorteoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SorteoRepository::class)]
class Sorteo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $presupuesto = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\OneToMany(targetEntity: Participantes::class, mappedBy: 'sorteo')]
    private Collection $participantes;

    public function __construct()
    {
        $this->participantes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresupuesto(): ?int
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(int $presupuesto): static
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return Collection<int, Participantes>
     */
    public function getParticipantes(): Collection
    {
        return $this->participantes;
    }

    public function addParticipante(Participantes $participante): static
    {
        if (!$this->participantes->contains($participante)) {
            $this->participantes->add($participante);
            $participante->setSorteo($this);
        }

        return $this;
    }

    public function removeParticipante(Participantes $participante): static
    {
        if ($this->participantes->removeElement($participante)) {
            // set the owning side to null (unless already changed)
            if ($participante->getSorteo() === $this) {
                $participante->setSorteo(null);
            }
        }

        return $this;
    }
}
