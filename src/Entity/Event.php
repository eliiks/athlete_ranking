<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $nbPoints = null;

    /**
     * @var Club|null
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="events")
     * @ORM\JoinColumn(
     *     name="club",
     *     nullable=false
     * )
     */
    private ?Club $club = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNbPoints(): ?int
    {
        return $this->nbPoints;
    }

    public function setNbPoints(int $nbPoints): self
    {
        $this->nbPoints = $nbPoints;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }
}
