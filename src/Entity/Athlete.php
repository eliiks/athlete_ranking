<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\AthleteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="athlete")
 * @ORM\Entity(repositoryClass=AthleteRepository::class)
 */
class Athlete
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\Length(min=2, max=45)
     */
    private ?string $firstName = null;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private ?string $lastName = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $nb_points = 0;

    /**
     * @var Club|null
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="athletes")
     * @ORM\JoinColumn(
     *     name="club",
     *     nullable=false
     * )
     */
    private ?Club $club = null;

    /**
     * @var Category|null
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="athletes")
     * @ORM\JoinColumn(
     *     name="category",
     *     nullable=false
     * )
     */
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
