<?php

namespace App\Entity;

use App\Controller\dto\EducationInstitutionDto;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(nullable: true)]
    private ?string $biography = null;

    #[ORM\Column(nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\Column(nullable: true)]
    private ?string $cv = null;

    #[ORM\Column(nullable: true)]
    private ?string $linkedin = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    private $apiToken;

    //one user can be the admin of many companies and many companies can have many admins
    #[ORM\ManyToMany(targetEntity: Company::class, inversedBy: 'admins', cascade: ["persist"])]
    #[ORM\JoinTable(name: 'company_admins')]
    private $companies;

    #[ORM\ManyToMany(targetEntity: EducationInstitution::class, inversedBy: 'admins', cascade: ["persist"])]
    #[ORM\JoinTable(name: 'education_institution_admins')]
    private $educationInstitutions;

    #[ORM\ManyToMany(targetEntity: Company::class, inversedBy: 'employees', cascade: ["persist"])]
    #[ORM\JoinTable(name: 'company_employees')]
    private $workExperiences;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->educationInstitutions = new ArrayCollection();
        $this->workExperiences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }


    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): void
    {
        $this->biography = $biography;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): void
    {
        $this->profilePicture = $profilePicture;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): void
    {
        $this->cv = $cv;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): void
    {
        $this->linkedin = $linkedin;
    }



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function addRole(string $role) {
        if(in_array($role, $this->roles)) return;

        $this->roles[] = $role;
    }

    public function removeRole(string $role) {
        if(!in_array($role, $this->roles)) return;

        $index = array_search($role, $this->roles);
        if($index !== FALSE){
            unset($this->roles[$index]);
        }
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param mixed $apiToken
     */
    public function setApiToken($apiToken): void
    {
        $this->apiToken = $apiToken;
    }

    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if($this->companies === null) {
            $this->companies = new ArrayCollection();
        }
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        $this->companies->removeElement($company);

        return $this;
    }

    public function getWorkExperiences(): Collection
    {
        return $this->workExperiences;
    }

    public function addWorkExperience(Company $company): self
    {
        if (!$this->workExperiences->contains($company)) {
            $this->workExperiences[] = $company;
        }

        return $this;
    }

    public function removeWorkExperience(Company $company): self
    {
        $this->workExperiences->removeElement($company);

        return $this;
    }

    public function getEducationInstitutions(): Collection
    {
        return $this->educationInstitutions;
    }

    public function setCompanies(ArrayCollection $companies): void
    {
        $this->companies = $companies;
    }

    /**
     * @param mixed $educationInstitutions
     */
    public function setEducationInstitutions($educationInstitutions): void
    {
        $this->educationInstitutions = $educationInstitutions;
    }

    public function setWorkExperiences(ArrayCollection $workExperiences): void
    {
        $this->workExperiences = $workExperiences;
    }

    public function addEducationInstitution(EducationInstitution $educationInstitution): self
    {
        if (!$this->educationInstitutions->contains($educationInstitution)) {
            $this->educationInstitutions[] = $educationInstitution;
        }

        return $this;
    }

    public function removeEducationInstitution(EducationInstitution $educationInstitution): self
    {
        $this->educationInstitutions->removeElement($educationInstitution);

        return $this;
    }




}
