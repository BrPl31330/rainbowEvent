<?php

namespace App\Entity;

use App\Repository\RenseignementsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RenseignementsRepository::class)
 */
class Renseignements
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "désolé '{{ value }}' n'est pas un email valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tetephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sujet;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sonoEclairage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sonLumiere;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $photoVideo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $autres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTetephone(): ?string
    {
        return $this->tetephone;
    }

    public function setTetephone(string $tetephone): self
    {
        $this->tetephone = $tetephone;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getSonoEclairage(): ?bool
    {
        return $this->sonoEclairage;
    }

    public function setSonoEclairage(?bool $sonoEclairage): self
    {
        $this->sonoEclairage = $sonoEclairage;

        return $this;
    }

    public function getSonLumiere(): ?bool
    {
        return $this->sonLumiere;
    }

    public function setSonLumiere(?bool $sonLumiere): self
    {
        $this->sonLumiere = $sonLumiere;

        return $this;
    }

    public function getPhotoVideo(): ?bool
    {
        return $this->photoVideo;
    }

    public function setPhotoVideo(?bool $photoVideo): self
    {
        $this->photoVideo = $photoVideo;

        return $this;
    }

    public function getAutres(): ?bool
    {
        return $this->autres;
    }

    public function setAutres(?bool $autres): self
    {
        $this->autres = $autres;

        return $this;
    }
}
