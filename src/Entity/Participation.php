<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="participation",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="participation_idx", columns={"event_id","athlete_id"})
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
     * @ORM\JoinColumn(name="event_id", nullable=false)
     */
    private ?Event $event_id = null;

    /**
     * @var Athlete|null
     * @ORM\ManyToOne(targetEntity=Athlete::class)
     * @ORM\JoinColumn(name="athlete_id", nullable=false)
     */
    private ?Athlete $athlete_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventId(): ?Event
    {
        return $this->event_id;
    }

    public function setEventId(?Event $event_id): self
    {
        $this->event_id = $event_id;

        return $this;
    }

    public function getAthleteId(): ?Athlete
    {
        return $this->athlete_id;
    }

    public function setAthleteId(?Athlete $athlete_id): self
    {
        $this->athlete_id = $athlete_id;

        return $this;
    }
}
