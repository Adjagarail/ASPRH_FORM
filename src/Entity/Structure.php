<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StructureRepository::class)
 */
class Structure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\ManyToOne(targetEntity=Activite::class, inversedBy="structures")
     */
    private $SecteurActivite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Membre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Cfce;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomNomReferent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FonctionReferent;

    /**
     * @ORM\Column(type="integer")
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $Email;

    /**
     * @ORM\OneToMany(targetEntity=Besoin::class, mappedBy="structure", cascade={"persist"})
     */
    private $Besoin;

    public function __construct()
    {
        $this->Besoin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getSecteurActivite(): ?Activite
    {
        return $this->SecteurActivite;
    }

    public function setSecteurActivite(?Activite $SecteurActivite): self
    {
        $this->SecteurActivite = $SecteurActivite;

        return $this;
    }

    public function getMembre(): ?string
    {
        return $this->Membre;
    }

    public function setMembre(string $Membre): self
    {
        $this->Membre = $Membre;

        return $this;
    }

    public function getCfce(): ?string
    {
        return $this->Cfce;
    }

    public function setCfce(string $Cfce): self
    {
        $this->Cfce = $Cfce;

        return $this;
    }

    public function getPrenomNomReferent(): ?string
    {
        return $this->PrenomNomReferent;
    }

    public function setPrenomNomReferent(string $PrenomNomReferent): self
    {
        $this->PrenomNomReferent = $PrenomNomReferent;

        return $this;
    }

    public function getFonctionReferent(): ?string
    {
        return $this->FonctionReferent;
    }

    public function setFonctionReferent(string $FonctionReferent): self
    {
        $this->FonctionReferent = $FonctionReferent;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(int $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return Collection|Besoin[]
     */
    public function getBesoin(): Collection
    {
        return $this->Besoin;
    }

    public function addBesoin(Besoin $besoin): self
    {
        if (!$this->Besoin->contains($besoin)) {
            $this->Besoin[] = $besoin;
            $besoin->setStructure($this);
        }

        return $this;
    }

    public function removeBesoin(Besoin $besoin): self
    {
        $this->Besoin->removeElement($besoin);
        // if ($this->Besoin->removeElement($besoin)) {
            // set the owning side to null (unless already changed)
        //    if ($besoin->getStructure() === $this) {
        //        $besoin->setStructure(null);
        //    }
       // }

        return $this;
    }
    public function __toString()
    {
        return $this->Nom;
    }
}
