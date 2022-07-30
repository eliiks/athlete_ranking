<?php

namespace App\Entity;

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
     */
    private ?string $first_name = null;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private ?string $last_name = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $nb_points = null;

    /**
     * @var Club|null
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="athletes")
     * @ORM\JoinColumn(
     *     nullable=false,
     *     referencedColumnName="id"
     * )
     */
    private ?Club $club_id = null;

    /**
     * @var Category|null
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="athletes")
     * @ORM\JoinColumn(
     *     nullable=false,
     *     referencedColumnName="id"
     * )
     */
    private ?Category $categorie_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

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

    public function getCategorieId(): ?Category
    {
        return $this->categorie_id;
    }

    public function setCategorieId(?Category $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }
}
