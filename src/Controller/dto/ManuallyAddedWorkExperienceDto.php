<?php

namespace App\Controller\dto;

use App\Entity\ManuallyAddedWorkExperience;

class ManuallyAddedWorkExperienceDto
{
    private ?int $id;
    private ?string $title;
    private ?string $location;
    private ?int $startDate;
    private ?int $endDate;
    private ?string $description;

    private ?string $company;


    public function __construct(ManuallyAddedWorkExperience $manuallyAddedWorkExperience)
    {
        $this->id = $manuallyAddedWorkExperience->getId();
        $this->title = $manuallyAddedWorkExperience->getTitle();
        $this->location = $manuallyAddedWorkExperience->getLocation();
        $this->startDate = $manuallyAddedWorkExperience->getStartDate();
        $this->endDate = $manuallyAddedWorkExperience->getEndDate();
        $this->description = $manuallyAddedWorkExperience->getDescription();
        $this->company = $manuallyAddedWorkExperience->getCompany();
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    public function getStartDate(): ?int
    {
        return $this->startDate;
    }

    public function setStartDate(?int $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?int
    {
        return $this->endDate;
    }

    public function setEndDate(?int $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }


}