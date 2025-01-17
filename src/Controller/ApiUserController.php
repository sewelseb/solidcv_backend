<?php

namespace App\Controller;
use App\Controller\dto\UserDto;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiUserController extends AbstractController
{
    #[Route('/api/protected/get-current-user', name: 'api_get_current_user')]
    public function getCurrentUser(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();

        return $this->json(
            new UserDto($user)
        );
    }

    #[Route('/api/protected/search-user', name: 'api_search_user', methods: ['POST'])]
    public function searchUser(Request $request, ManagerRegistry $doctrine): Response
    {
        $content = $request->getContent();
        $jsonData = json_decode($content, true);

        $users = $doctrine->getRepository(User::class)->searchUser($jsonData['searchTherms']);

        $usersDto = [];

        foreach ($users as $user) {
            $usersDto[] = new UserDto($user);
        }

        return $this->json(
            $usersDto
        );
    }

    #[Route('/api/protected/set-ethereum-wallet', name: 'api_set_ethereum_wallet', methods: ['POST'])]
    public function setEthereumWallet(Request $request, ManagerRegistry $doctrine): Response
    {
        $content = $request->getContent();
        $jsonData = json_decode($content, true);
        $user = $this->getUser();

        $user->setEthereumAddress($jsonData['address']);

        $doctrine->getManager()->persist($user);
        $doctrine->getManager()->flush();

        return $this->json([
            'message' => 'Ethereum wallet set'
        ]);
    }
}