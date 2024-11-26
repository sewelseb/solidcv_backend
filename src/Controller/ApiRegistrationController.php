<?php

namespace App\Controller;

use App\BusinessLayer\NotificationService;
use App\Entity\User;
use App\Security\ApiKeyAuthenticator;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class ApiRegistrationController extends AbstractController
{
    /*private NotificationService $notificationService;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }*/

    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, ApiKeyAuthenticator $authenticator, UserAuthenticatorInterface $userAuthenticator, EntityManagerInterface $entityManager):Response
    {
        //try{
            $credentials = $this->getCredentials($request);

            $user = $this->createUser($credentials, $userPasswordHasher, $entityManager);

            $content = $request->getContent();
            $sentData = json_decode($content, true);

            /*$this->notificationService->registrationNotification($user);

            // send email to administrators
            $admins = $entityManager->getRepository(User::class)->findUsersByRole('ROLE_ADMIN');
            try {
                foreach ($admins as $admin) {
                    $this->notificationService->notifyAdminAboutNewUser($admin, $user);
                }
            } catch (\Exception $exception) {

            }*/


            return $this->json([
                'email'  => $user->getUserIdentifier(),
                'token' => $user->getApiToken()
            ]);
        /*} catch (\Exception $exception) {
            return new JsonResponse([
                'error' => 'user creation error',
            ], 500);
        }*/
    }

    #[Route('/api/request-password-reset', name: 'api_request_password_reset', methods: ['POST'])]
    public function requestPasswordReset(Request $request, EntityManagerInterface $entityManager): Response
    {
        $content = $request->getContent();
        $sentData = json_decode($content, true);

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $sentData['email']]);

        if($user === null) {
            return new JsonResponse([
                'error' => 'user not found',
            ], 404);
        }

        $token = sha1(rand());
        $user->setPasswordResetToken($token);
        $entityManager->persist($user);
        $entityManager->flush();

        $this->notificationService->passwordResetRequest($user);

        return new JsonResponse([
            'message' => 'password reset request sent',
        ], 200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getCredentials(Request $request): mixed
    {
        $content = $request->getContent();
        $credentials = json_decode($content, true);

        if ($credentials['password'] === null && $credentials['email'] === null) {
            $credentials = $this->getPlainTextCredentials($request, $credentials);
        }
        return $credentials;
    }

    /**
     * @param Request $request
     * @param mixed $credentials
     * @return mixed
     */
    public function getPlainTextCredentials(Request $request, mixed $credentials): mixed
    {
        $credentials["email"] = $request->request->get('email');
        $credentials["password"] = $request->request->get('password');
        return $credentials;
    }

    /**
     * @param mixed $credentials
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param EntityManagerInterface $entityManager
     * @return User
     */
    public function createUser(mixed $credentials, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): User
    {
        $user = new User();
        $user->setEmail($credentials["email"]);
        // encode the plain password
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $credentials["password"]
            )
        );

        if(isset($credentials["firstName"])) {
            $user->setFirstName($credentials["firstName"]);
        }
        if(isset($credentials["lastName"])) {
            $user->setLastName($credentials["lastName"]);
        }


        //var_dump($user);

        $entityManager->persist($user);
        $entityManager->flush();

        $token = sha1(rand());
        $user->setApiToken($token);
        $entityManager->persist($user);
        $entityManager->flush();

        return $user;
    }

    private function associateProviderToExistingQuotes(User $user, EntityManagerInterface $entityManager): void
    {
        $quotes = $entityManager->getRepository('App\Entity\QuoteForProviderRequest')->findBy(['providerEmail' => $user->getEmail()]);

        foreach ($quotes as $quote) {
            $quote->setProvider($user);
            $quote->setIsProvideRegistered(true);
            $quote->setProviderName(null);
            $quote->setProviderEmail(null);
            $entityManager->persist($quote);
            $entityManager->flush();
        }
    }
}