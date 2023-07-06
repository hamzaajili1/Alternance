<?php

namespace App\Entity;

use App\Repository\PointageRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Validator as AcmeAssert;

/**
 * @ORM\Entity(repositoryClass=PointageRepository::class)
 */
class Pointage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="pointages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="date")
     * @AcmeAssert\PointageChantier
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     * @AcmeAssert\TempsTravail
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity=Chantier::class, inversedBy="pointages")
     * @ORM\JoinColumn(nullable=false)
     * @AcmeAssert\DateChantier
     */
    private $chantier;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Utilisateur|null
     */
    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    /**
     * @param Utilisateur|null $utilisateur
     * @return $this
     */
    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface $date
     * @return $this
     */
    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getDuree(): ?float
    {
        return $this->duree;
    }

    /**
     * @param float $duree
     * @return $this
     */
    public function setDuree(float $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Chantier|null
     */
    public function getChantier(): ?Chantier
    {
        return $this->chantier;
    }

    /**
     * @param Chantier|null $chantier
     * @return $this
     */
    public function setChantier(?Chantier $chantier): self
    {
        $this->chantier = $chantier;

        return $this;
    }
}