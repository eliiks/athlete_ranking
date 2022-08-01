<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="participation",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="participation_idx", columns={"event","athlete"})
 *     }
 * )
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column
     */
    private ?int $id = null;

    /**
     * @var Event|null
     * @ORM\ManyToOne(targetEntity=Event::class)
     * @ORM\JoinColumn(name="event", nullable=false)
     */
    private ?Event $event = null;

    /**
     * @var Athlete|null
     * @ORM\ManyToOne(targetEntity=Athlete::class)
     * @ORM\JoinColumn(name="athlete", nullable=false)
     */
    private ?Athlete $athlete = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getAthlete(): ?Athlete
    {
        return $this->athlete;
    }

    public function setAthlete(?Athlete $athlete): self
    {
        $this->athlete = $athlete;

        return $this;
    }
}
