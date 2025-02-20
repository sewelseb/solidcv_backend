<?php

namespace App\Controller\dto;

use App\Entity\Company;
use App\Entity\EducationInstitution;

class EducationInstitutionDto
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $addressStreet = null;
    private ?string $addressNumber = null;
    private ?string $addressCity = null;
    private ?string $addressZipCode = null;
    private ?string $addressCountry = null;
    private ?string $email = null;
    private ?string $phoneNumber = null;
    private ?string $ethereumAddress = null;

    public function __construct(EducationInstitution $educationInstitution) {
        $this->id = $educationInstitution->getId();
        $this->name = $educationInstitution->getName();
        $this->addressStreet = $educationInstitution->getAddressStreet();
        $this->addressNumber = $educationInstitution->getAddressNumber();
        $this->addressCity = $educationInstitution->getAddressCity();
        $this->addressZipCode = $educationInstitution->getAddressZipCode();
        $this->addressCountry = $educationInstitution->getAddressCountry();
        $this->email = $educationInstitution->getEmail();
        $this->phoneNumber = $educationInstitution->getPhoneNumber();
        $this->ethereumAddress = $educationInstitution->getEthereumAddress();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAddressStreet(): ?string
    {
        return $this->addressStreet;
    }

    public function setAddressStreet(?string $addressStreet): void
    {
        $this->addressStreet = $addressStreet;
    }

    public function getAddressNumber(): ?string
    {
        return $this->addressNumber;
    }

    public function setAddressNumber(?string $addressNumber): void
    {
        $this->addressNumber = $addressNumber;
    }

    public function getAddressCity(): ?string
    {
        return $this->addressCity;
    }

    public function setAddressCity(?string $addressCity): void
    {
        $this->addressCity = $addressCity;
    }

    public function getAddressZipCode(): ?string
    {
        return $this->addressZipCode;
    }

    public function setAddressZipCode(?string $addressZipCode): void
    {
        $this->addressZipCode = $addressZipCode;
    }

    public function getAddressCountry(): ?string
    {
        return $this->addressCountry;
    }

    public function setAddressCountry(?string $addressCountry): void
    {
        $this->addressCountry = $addressCountry;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getEthereumAddress(): ?string
    {
        return $this->ethereumAddress;
    }

    public function setEthereumAddress(?string $ethereumAddress): void
    {
        $this->ethereumAddress = $ethereumAddress;
    }
}