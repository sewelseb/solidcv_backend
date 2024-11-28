<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\dto\CompanyDto;
use App\Entity\Company;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiCompanyController extends AbstractController
{
    #[Route('/api/protected/get-company/{id}', name: 'api_get_company')]
    public function getCompany($id, Request $request, ManagerRegistry $doctrine): Response
    {
        //get company by id
        $company = $doctrine->getRepository(Company::class)->find($id);

        return $this->json([
            $company
        ]);
    }

    /*#[Route('/api/protected/update-company', name: 'api_update_company', methods: ['POST'])]
    public function updateCompany(): Response
    {

        return $this->json([
            'message' => 'Company updated'
        ]);
    }*/

    /*#[Route('/api/protected/delete-company', name: 'api_delete_company', methods: ['DELETE'])]
    public function deleteCompany(): Response
    {
        return $this->json([
            'message' => 'Company deleted'
        ]);
    }*/

    #[Route('/api/protected/create-company', name: 'api_create_company', methods: ['POST'])]
    public function createCompany(Request $request, ManagerRegistry $doctrine): Response
    {
        $content = $request->getContent();
        $jsonData = json_decode($content, true);

        $company = new Company();
        $company->setName($jsonData['name']);
        $company->setAddressNumber($jsonData['addressNumber']);
        $company->setAddressStreet($jsonData['addressStreet']);
        $company->setAddressCity($jsonData['addressCity']);
        $company->setAddressZipCode($jsonData['addressZipCode']);
        $company->setAddressCountry($jsonData['addressCountry']);
        $company->setEmail($jsonData['email']);
        $company->setPhoneNumber($jsonData['phoneNumber']);
        $company->addAdmin($this->getUser());
        $this->getUser()->addCompany($company);

        $em = $doctrine->getManager();
        $em->persist($company);
        $em->persist($this->getUser());
        $em->flush();


        return $this->json([
            'message' => 'Company created'
        ]);
    }

    #[Route('/api/protected/get-my-companies', name: 'api_get_companies', methods: ['GET'])]
    public function getCompanies(Request $request, ManagerRegistry $doctrine): Response
    {
        $companies = $this->getUser()->getCompanies();

        $companiesAsDto = [];
        foreach ($companies as $company) {
            $companiesAsDto[] = new CompanyDto($company);
        }

        return $this->json(
            $companiesAsDto
        );
    }
}
