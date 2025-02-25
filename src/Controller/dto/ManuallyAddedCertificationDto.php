<?php

namespace App\Controller\dto;



use App\Entity\ManuallyAddedCertification;

class ManuallyAddedCertificationDto
{
    private ?int $id = null;


    private ?string $title = null;


    private ?string $grade = null;


    private ?string $type = null;


    private ?string $descritpion = null;


    private ?string $curiculum = null;


    private ?string $publicationDate = null;


    private ?string $file = null;

    public function __construct(ManuallyAddedCertification $manuallyAddedCertification)
    {
        $this->id = $manuallyAddedCertification->getId();
        $this->title = $manuallyAddedCertification->getTitle();
        $this->grade = $manuallyAddedCertification->getGrade();
        $this->type = $manuallyAddedCertification->getType();
        $this->descritpion = $manuallyAddedCertification->getDescritpion();
        $this->curiculum = $manuallyAddedCertification->getCuriculum();
        $this->publicationDate = $manuallyAddedCertification->getPublicationDate();
        $this->file = $manuallyAddedCertification->getFile();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade): void
    {
        $this->grade = $grade;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getDescritpion(): ?string
    {
        return $this->descritpion;
    }

    public function setDescritpion(?string $descritpion): void
    {
        $this->descritpion = $descritpion;
    }

    public function getCuriculum(): ?string
    {
        return $this->curiculum;
    }

    public function setCuriculum(?string $curiculum): void
    {
        $this->curiculum = $curiculum;
    }

    public function getPublicationDate(): ?string
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?string $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): void
    {
        $this->file = $file;
    }


}