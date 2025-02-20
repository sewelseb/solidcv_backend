<?php

namespace App\Entity;

use App\Repository\CertificateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertificateRepository::class)]
class Certificate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $grade = null;

    #[ORM\Column(length: 1023, nullable: true)]
    private ?string $curiculum = null;

    #[ORM\Column(length: 1023, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $publicationDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ethereumToken = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'certificates')]
    private $user;

    #[ORM\ManyToOne(targetEntity: EducationInstitution::class, inversedBy: 'certificates')]
    private $educationInstitution;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getCuriculum(): ?string
    {
        return $this->curiculum;
    }

    public function setCuriculum(?string $curiculum): static
    {
        $this->curiculum = $curiculum;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPublicationDate(): ?int
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?int $publicationDate): static
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function getEthereumToken(): ?string
    {
        return $this->ethereumToken;
    }

    public function setEthereumToken(?string $ethereumToken): void
    {
        $this->ethereumToken = $ethereumToken;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getEducationInstitution()
    {
        return $this->educationInstitution;
    }

    /**
     * @param mixed $educationInstitution
     */
    public function setEducationInstitution($educationInstitution): void
    {
        $this->educationInstitution = $educationInstitution;
    }


}
