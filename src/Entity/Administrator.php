<?php

namespace App\Entity;

use App\Repository\AdministratorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="administrator")
 * @ORM\Entity(repositoryClass=AdministratorRepository::class)
 */
class Administrator
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
    private ?string $login = null;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private ?string $password = null;

    /**
     * @var Club|null
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="administrators")
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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
