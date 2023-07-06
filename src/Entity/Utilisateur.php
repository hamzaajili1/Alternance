<?php

namespace App\Entity;

use App\Repository\PointageRepository;
use App\Repository\UtilisateurRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity("matricule")
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $prenom;


    /**
     * @ORM\Column(type="string", length=10)
     */
    private $matricule;

    /**
     * @ORM\OneToMany(targetEntity=Pointage::class, mappedBy="utilisateur", orphanRemoval=true)
     */
    private $pointages;

    /**
     * Utilisateur constructor.
     */
    public function __construct()
    {
        $this->pointages = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return $this
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return $this
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    /**
     * @param string $matricule
     * @return $this
     */
    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * @return Collection|Pointage[]
     */
    public function getPointages(): Collection
    {
        return $this->pointages;
    }

    /**
     * @return Pointage|false
     */
    public function getDernierPointage()
    {
        if ($this->pointages->count())
            return array_reverse($this->pointages->toArray())[0];
        return false;
    }

    /**
     * @param string $date
     * @return Collection|Pointage[]
     * @throws Exception
     */
    public function getPointagesSemaine(string $date)
    {
        $criteria = PointageRepository::semaineCriteria($date);
        return $this->pointages->matching($criteria);
    }

    /**
     * @param DateTimeInterface $date
     * @return Collection|Pointage[]
     */
    public function getPointagesJour(DateTimeInterface $date)
    {
        $criteria = PointageRepository::jourCriteria($date);
        return $this->pointages->matching($criteria);
    }

    /**
     * @param Pointage $pointage
     * @return $this
     */
    public function addPointage(Pointage $pointage): self
    {
        if (!$this->pointages->contains($pointage)) {
            $this->pointages[] = $pointage;
            $pointage->setUtilisateur($this);
        }

        return $this;
    }

    /**
     * @param Pointage $pointage
     * @return $this
     */
    public function removePointage(Pointage $pointage): self
    {
        if ($this->pointages->removeElement($pointage)) {
            // set the owning side to null (unless already changed)
            if ($pointage->getUtilisateur() === $this) {
                $pointage->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getNomComplet()
    {
        return mb_strtoupper($this->nom) . ' ' . $this->prenom;
    }
}