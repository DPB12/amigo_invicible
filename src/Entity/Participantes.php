<?php

namespace App\Entity;

use App\Repository\ParticipantesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantesRepository::class)]
class Participantes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $amigo = null;

    #[ORM\ManyToOne(inversedBy: 'participantes')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'participantes')]
    private ?Sorteo $sorteo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmigo(): ?int
    {
        return $this->amigo;
    }

    public function setAmigo(?int $amigo): static
    {
        $this->amigo = $amigo;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getSorteo(): ?Sorteo
    {
        return $this->sorteo;
    }

    public function setSorteo(?Sorteo $sorteo): static
    {
        $this->sorteo = $sorteo;

        return $this;
    }
}
