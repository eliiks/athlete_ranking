<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
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
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private ?string $description = null;

    /**
     * @ORM\Column(type="string", length=45, unique=true)
     */
    private ?string $admin_code = null;

    /**
     * @var Collection|ArrayCollection
     * @ORM\OneToMany(targetEntity=Athlete::class, mappedBy="club_id", orphanRemoval=true)
     */
    private Collection $athletes;

    /**
     * @var Collection|ArrayCollection
     * @ORM\OneToMany(targetEntity=Administrator::class, mappedBy="club_id", orphanRemoval=true)
     */
    private Collection $administrators;

    /**
     * @var Collection|ArrayCollection
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="club_id", orphanRemoval=true)
     */
    private Collection $events;

    public function __construct()
    {
        $this->athletes = new ArrayCollection();
        $this->administrators = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdminCode(): ?int
    {
        return $this->admin_code;
    }

    public function setAdminCode(int $admin_code): self
    {
        $this->admin_code = $admin_code;

        return $this;
    }

    /**
     * @return Collection<int, Athlete>
     */
    public function getAthletes(): Collection
    {
        return $this->athletes;
    }

    public function addAthlete(Athlete $athlete): self
    {
        if (!$this->athletes->contains($athlete)) {
            $this->athletes->add($athlete);
            $athlete->setClubId($this);
        }

        return $this;
    }

    public function removeAthlete(Athlete $athlete): self
    {
        if ($this->athletes->removeElement($athlete)) {
            // set the owning side to null (unless already changed)
            if ($athlete->getClubId() === $this) {
                $athlete->setClubId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Administrator>
     */
    public function getAdministrators(): Collection
    {
        return $this->administrators;
    }

    public function addAdministrator(Administrator $administrator): self
    {
        if (!$this->administrators->contains($administrator)) {
            $this->administrators->add($administrator);
            $administrator->setClubId($this);
        }

        return $this;
    }

    public function removeAdministrator(Administrator $administrator): self
    {
        if ($this->administrators->removeElement($administrator)) {
            // set the owning side to null (unless already changed)
            if ($administrator->getClubId() === $this) {
                $administrator->setClubId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setClubId($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getClubId() === $this) {
                $event->setClubId(null);
            }
        }

        return $this;
    }
}
