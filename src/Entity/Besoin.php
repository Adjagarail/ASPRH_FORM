<?php

namespace App\Entity;

use App\Repository\BesoinRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BesoinRepository::class)
 */
class Besoin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Priorite;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     */
    private $Cadre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     */
    private $Agent;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     */
    private $Employer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Observation;

    /**
     * @ORM\ManyToOne(targetEntity=Structure::class, inversedBy="Besoin")
     */
    private $structure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPriorite(): ?string
    {
        return $this->Priorite;
    }

    public function setPriorite(string $Priorite): self
    {
        $this->Priorite = $Priorite;

        return $this;
    }

    public function getCadre(): ?int
    {
        return $this->Cadre;
    }

    public function setCadre(int $Cadre): self
    {
        $this->Cadre = $Cadre;

        return $this;
    }

    public function getAgent(): ?int
    {
        return $this->Agent;
    }

    public function setAgent(int $Agent): self
    {
        $this->Agent = $Agent;

        return $this;
    }

    public function getEmployer(): ?int
    {
        return $this->Employer;
    }

    public function setEmployer(int $Employer): self
    {
        $this->Employer = $Employer;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->Observation;
    }

    public function setObservation(?string $Observation): self
    {
        $this->Observation = $Observation;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }
}
