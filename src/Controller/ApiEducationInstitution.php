<?php

namespace App\Controller;

use App\Controller\dto\EducationInstitutionDto;
use App\Entity\EducationInstitution;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiEducationInstitution extends AbstractController
{
    #[Route('/api/protected/get-education-institution/{id}', name: 'api_get_education_institution')]
    public function getEducationInstitution($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $educationInstitution = $doctrine->getRepository(EducationInstitution::class)->find($id);

        return $this->json(
            new EducationInstitutionDto($educationInstitution)
        );
    }

    #[Route('/api/protected/create-education-institution', name: 'api_create_education_institution', methods: ['POST'])]
    public function createEducationInstitution(Request $request, ManagerRegistry $doctrine): Response
    {
        $content = $request->getContent();
        $jsonData = json_decode($content, true);

        $educationInstitution = new EducationInstitution();
        $educationInstitution->setName($jsonData['name']);
        $educationInstitution->setAddressNumber($jsonData['addressNumber']);
        $educationInstitution->setAddressStreet($jsonData['addressStreet']);
        $educationInstitution->setAddressCity($jsonData['addressCity']);
        $educationInstitution->setAddressZipCode($jsonData['addressZipCode']);
        $educationInstitution->setAddressCountry($jsonData['addressCountry']);
        $educationInstitution->setEmail($jsonData['email']);
        $educationInstitution->setPhoneNumber($jsonData['phoneNumber']);
        $educationInstitution->addAdmin($this->getUser());
        $this->getUser()->addEducationInstitution($educationInstitution);

        $doctrine->getManager()->persist($educationInstitution);
        $doctrine->getManager()->persist($this->getUser());
        $doctrine->getManager()->flush();

        return $this->json([
            'message' => 'Education Institution created'
        ]);
    }

    #[Route('/api/protected/get-my-education-institutions', name: 'api_get_my_education_institutions')]
    public function getMyEducationInstitutions(Request $request, ManagerRegistry $doctrine): Response
    {
        $educationInstitutions = $this->getUser()->getEducationInstitutions();

        $educationInstitutionDtos = [];
        foreach ($educationInstitutions as $educationInstitution) {
            $educationInstitutionDtos[] = new EducationInstitutionDto($educationInstitution);
        }

        return $this->json($educationInstitutionDtos);
    }

    #[Route('/api/protected/education-institution/set-ethereum-address', name: 'api_set_ethereum_address', methods: ['POST'])]
    public function setEthereumAddress(Request $request, ManagerRegistry $doctrine): Response
    {
        $content = $request->getContent();
        $jsonData = json_decode($content, true);
        $educationInstitution = $doctrine->getRepository(EducationInstitution::class)->find($jsonData['id']);

        $educationInstitution->setEthereumAddress($jsonData['ethereumAddress']);

        $doctrine->getManager()->persist($educationInstitution);
        $doctrine->getManager()->flush();

        return $this->json([
            'message' => 'Ethereum address set'
        ]);
    }
}