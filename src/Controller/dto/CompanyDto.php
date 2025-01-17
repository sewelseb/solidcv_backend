<?php

namespace App\Controller\dto;

use App\Entity\Company;

class CompanyDto
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

    public function __construct(Company $company) {
        $this->id = $company->getId();
        $this->name = $company->getName();
        $this->addressStreet = $company->getAddressStreet();
        $this->addressNumber = $company->getAddressNumber();
        $this->addressCity = $company->getAddressCity();
        $this->addressZipCode = $company->getAddressZipCode();
        $this->addressCountry = $company->getAddressCountry();
        $this->email = $company->getEmail();
        $this->phoneNumber = $company->getPhoneNumber();
        $this->ethereumAddress = $company->getEthereumAddress();
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