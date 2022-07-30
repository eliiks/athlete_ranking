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
    private ?int $nb_points = null;

    /**
     * @var Club|null
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="events")
     * @ORM\JoinColumn(
     *     nullable=false,
     *     referencedColumnName="id"
     * )
     */
    private ?Club $club_id = null;

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
        return $this->nb_points;
    }

    public function setNbPoints(int $nb_points): self
    {
        $this->nb_points = $nb_points;

        return $this;
    }

    public function getClubId(): ?Club
    {
        return $this->club_id;
    }

    public function setClubId(?Club $club_id): self
    {
        $this->club_id = $club_id;

        return $this;
    }
}
