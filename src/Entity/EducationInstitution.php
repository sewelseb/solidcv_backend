<?php

namespace App\Entity;

use App\Repository\EducationInstitutionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EducationInstitutionRepository::class)]
class EducationInstitution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressStreet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressCity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressZipCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressCountry = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    //one user can be the admin of many companies and many companies can have many admins
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'educationInstitutions')]
    private $admins;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAdmins()
    {
        return $this->admins;
    }

    /**
     * @param mixed $admins
     */
    public function setAdmins($admins): void
    {
        $this->admins = $admins;
    }

    public function addAdmin(User $user): void
    {
        if($this->getAdmins() == null) {
            $this->admins = new ArrayCollection();
        }
        if ($this->admins->contains($user)) {
            return;
        }
        $this->admins[] = $user;
    }

    public function removeAdmin(User $user): void
    {
        $this->admins->removeElement($user);
    }
}
